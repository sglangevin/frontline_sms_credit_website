<?php
/**
 * @version		$Id: item.php 567 2010-09-23 11:50:09Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelItem extends JModel {

    function getData() {

        $cid = JRequest::getVar('cid');
        $row = &JTable::getInstance('K2Item', 'Table');
        $row->load($cid);
        return $row;
    }

    function save($front = false) {

        $mainframe = &JFactory::getApplication();
        jimport('joomla.filesystem.file');
        jimport('joomla.filesystem.archive');
        require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'class.upload.php');
        $db = &JFactory::getDBO();
        $user = &JFactory::getUser();
        $row = &JTable::getInstance('K2Item', 'Table');
        $params = &JComponentHelper::getParams('com_k2');
        $nullDate = $db->getNullDate();

        if (!$row->bind(JRequest::get('post'))) {
            $mainframe->redirect('index.php?option=com_k2&view=items', $row->getError(), 'error');
        }

        if ($front && $row->id == NULL) {
            if (!$user->authorize('com_k2', 'add', 'category', $row->catid) && !$user->authorize('com_k2', 'add', 'category', 'all')) {
                $mainframe->redirect('index.php?option=com_k2&view=item&task=add&tmpl=component', JText::_('You are not allowed to post to this category. Save failed.'), 'error');
            }
        }

        ($row->id) ? $isNew = false : $isNew = true;


        if ($params->get('mergeEditors')) {
            $text = JRequest::getVar('text', '', 'post', 'string', 2);
            if($params->get('xssFiltering')){
                $filter = new JFilterInput(array(), array(), 1, 1, 0);
                $text = $filter->clean( $text );
            }
            $pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';
            $tagPos = preg_match($pattern, $text);
            if ($tagPos == 0) {
                $row->introtext = $text;
                $row->fulltext = '';
            } else
            list($row->introtext, $row->fulltext) = preg_split($pattern, $text, 2);
        } else {
            $row->introtext = JRequest::getVar('introtext', '', 'post', 'string', 2);
            $row->fulltext = JRequest::getVar('fulltext', '', 'post', 'string', 2);
            if($params->get('xssFiltering')){
                $filter = new JFilterInput(array(), array(), 1, 1, 0);
                $row->introtext = $filter->clean( $row->introtext );
                $row->fulltext = $filter->clean( $row->fulltext );
            }
        }

        if ($row->id) {
            $datenow = &JFactory::getDate();
            $row->modified = $datenow->toMySQL();
            $row->modified_by = $user->get('id');
        } else {
            $row->ordering = $row->getNextOrder("catid = {$row->catid} AND trash = 0");
            if (JRequest::getInt('featured'))
            $row->featured_ordering = $row->getNextOrder("featured = 1 AND trash = 0", 'featured_ordering');
        }

        if ($front) {
            if (!$row->id)
            $row->created_by = $user->get('id');
        } else {
            $row->created_by = $row->created_by ? $row->created_by : $user->get('id');
        }

        if ($row->created && strlen(trim($row->created)) <= 10) {
            $row->created .= ' 00:00:00';
        }

        $config = &JFactory::getConfig();
        $tzoffset = $config->getValue('config.offset');
        $date = &JFactory::getDate($row->created, $tzoffset);
        $row->created = $date->toMySQL();

        if (strlen(trim($row->publish_up)) <= 10) {
            $row->publish_up .= ' 00:00:00';
        }

        $date = &JFactory::getDate($row->publish_up, $tzoffset);
        $row->publish_up = $date->toMySQL();

        if (trim($row->publish_down) == JText::_('Never') || trim($row->publish_down) == '') {
            $row->publish_down = $nullDate;
        } else {
            if (strlen(trim($row->publish_down)) <= 10) {
                $row->publish_down .= ' 00:00:00';
            }
            $date = &JFactory::getDate($row->publish_down, $tzoffset);
            $row->publish_down = $date->toMySQL();
        }

        $metadata = JRequest::getVar('meta', null, 'post', 'array');
        if (is_array($metadata)) {
            $txt = array();
            foreach ($metadata as $k=>$v) {
                if ($k == 'description') {
                    $row->metadesc = $v;
                } elseif ($k == 'keywords') {
                    $row->metakey = $v;
                } else {
                    $txt[] = "$k=$v";
                }
            }
            $row->metadata = implode("\n", $txt);
        }

        $row->featured = JRequest::getInt('featured');

        if (!$row->check()) {
            $mainframe->redirect('index.php?option=com_k2&view=item&cid='.$row->id, $row->getError(), 'error');
        }

        $dispatcher = &JDispatcher::getInstance();
        JPluginHelper::importPlugin('k2');
        $result = $dispatcher->trigger('onBeforeK2Save', array(&$row, $isNew));
        if (in_array(false, $result, true)) {
            JError::raiseError(500, $row->getError());
            return false;
        }

        if (version_compare(phpversion(), '5.0') < 0) {
            $tmpRow = $row;
        }
        else {
            $tmpRow = clone($row);
        }

        if (!$row->store()) {
            $mainframe->redirect('index.php?option=com_k2&view=items', $row->getError(), 'error');
        }
        $itemID = $row->id;
        $row = $tmpRow;
        $row->id = $itemID;

        if(!$params->get('disableCompactOrdering'))
        $row->reorder("catid = {$row->catid} AND trash = 0");

        if (JRequest::getInt('featured') && !$params->get('disableCompactOrdering'))
        $row->reorder("featured = 1 AND trash = 0", 'featured_ordering');

        $files = JRequest::get('files');

        //Image
        $existingImage = JRequest::getVar('existingImage');
        if ( ($files['image']['error'] === 0 || $existingImage) && !JRequest::getBool('del_image')) {

            if($files['image']['error'] === 0){
                $image = $files['image'];
            }
            else{
                $image = JPATH_SITE.DS.JPath::clean($existingImage);
            }


            $handle = new Upload($image);
            $handle->allowed = array('image/*');

            if ($handle->uploaded) {

                //Image params
                $category = &JTable::getInstance('K2Category', 'Table');
                $category->load($row->catid);
                $cparams = new JParameter($category->params);

                if ($cparams->get('inheritFrom')) {
                    $masterCategoryID = $cparams->get('inheritFrom');
                    $query = "SELECT * FROM #__k2_categories WHERE id=".(int)$masterCategoryID;
                    $db->setQuery($query, 0, 1);
                    $masterCategory = $db->loadObject();
                    $cparams = new JParameter($masterCategory->params);
                }

                $params->merge($cparams);

                //Original image
                $savepath = JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'src';
                $handle->image_convert = 'jpg';
                $handle->jpeg_quality = 100;
                $handle->file_auto_rename = false;
                $handle->file_overwrite = true;
                $handle->file_new_name_body = md5("Image".$row->id);
                $handle->Process($savepath);

                $filename = $handle->file_dst_name_body;
                $savepath = JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache';

                //XLarge image
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_convert = 'jpg';
                $handle->jpeg_quality = $params->get('imagesQuality');
                $handle->file_auto_rename = false;
                $handle->file_overwrite = true;
                $handle->file_new_name_body = $filename.'_XL';
                if (JRequest::getInt('itemImageXL')) {
                    $imageWidth = JRequest::getInt('itemImageXL');
                } else {
                    $imageWidth = $params->get('itemImageXL', '800');
                }
                $handle->image_x = $imageWidth;
                $handle->Process($savepath);

                //Large image
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_convert = 'jpg';
                $handle->jpeg_quality = $params->get('imagesQuality');
                $handle->file_auto_rename = false;
                $handle->file_overwrite = true;
                $handle->file_new_name_body = $filename.'_L';
                if (JRequest::getInt('itemImageL')) {
                    $imageWidth = JRequest::getInt('itemImageL');
                } else {
                    $imageWidth = $params->get('itemImageL', '600');
                }
                $handle->image_x = $imageWidth;
                $handle->Process($savepath);

                //Medium image
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_convert = 'jpg';
                $handle->jpeg_quality = $params->get('imagesQuality');
                $handle->file_auto_rename = false;
                $handle->file_overwrite = true;
                $handle->file_new_name_body = $filename.'_M';
                if (JRequest::getInt('itemImageM')) {
                    $imageWidth = JRequest::getInt('itemImageM');
                } else {
                    $imageWidth = $params->get('itemImageM', '400');
                }
                $handle->image_x = $imageWidth;
                $handle->Process($savepath);

                //Small image
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_convert = 'jpg';
                $handle->jpeg_quality = $params->get('imagesQuality');
                $handle->file_auto_rename = false;
                $handle->file_overwrite = true;
                $handle->file_new_name_body = $filename.'_S';
                if (JRequest::getInt('itemImageS')) {
                    $imageWidth = JRequest::getInt('itemImageS');
                } else {
                    $imageWidth = $params->get('itemImageS', '200');
                }
                $handle->image_x = $imageWidth;
                $handle->Process($savepath);

                //XSmall image
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_convert = 'jpg';
                $handle->jpeg_quality = $params->get('imagesQuality');
                $handle->file_auto_rename = false;
                $handle->file_overwrite = true;
                $handle->file_new_name_body = $filename.'_XS';
                if (JRequest::getInt('itemImageXS')) {
                    $imageWidth = JRequest::getInt('itemImageXS');
                } else {
                    $imageWidth = $params->get('itemImageXS', '100');
                }
                $handle->image_x = $imageWidth;
                $handle->Process($savepath);

                //Generic image
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_convert = 'jpg';
                $handle->jpeg_quality = $params->get('imagesQuality');
                $handle->file_auto_rename = false;
                $handle->file_overwrite = true;
                $handle->file_new_name_body = $filename.'_Generic';
                $imageWidth = $params->get('itemImageGeneric', '300');
                $handle->image_x = $imageWidth;
                $handle->Process($savepath);

                if($files['image']['error'] === 0)
                $handle->Clean();

            } else {
                $mainframe->redirect('index.php?option=com_k2&view=items', $handle->error, 'error');
            }

        }

        if (JRequest::getBool('del_image')) {

            $current = &JTable::getInstance('K2Item', 'Table');
            $current->load($row->id);
            $filename = md5("Image".$current->id);

            if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'src'.DS.$filename.'.jpg')) {
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'src'.DS.$filename.'.jpg');
            }

            if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_XS.jpg')) {
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_XS.jpg');
            }

            if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_S.jpg')) {
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_S.jpg');
            }

            if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_M.jpg')) {
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_M.jpg');
            }

            if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_L.jpg')) {
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_L.jpg');
            }

            if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_XL.jpg')) {
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_XL.jpg');
            }

            if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_Generic.jpg')) {
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.$filename.'_Generic.jpg');
            }

            $row->image_caption = '';
            $row->image_credits = '';

        }

        //Attachments
        $attachments = JRequest::getVar('attachment_file', NULL, 'FILES', 'array');
        $attachments_names = JRequest::getVar('attachment_name', '', 'POST', 'array');
        $attachments_titles = JRequest::getVar('attachment_title', '', 'POST', 'array');
        $attachments_title_attributes = JRequest::getVar('attachment_title_attribute', '', 'POST', 'array');

        $attachmentFiles = array();

        if (count($attachments)) {

            foreach ($attachments as $k=>$l) {
                foreach ($l as $i=>$v) {
                    if (!array_key_exists($i, $attachmentFiles))
                    $attachmentFiles[$i] = array();
                    $attachmentFiles[$i][$k] = $v;
                }

            }

            $path = $params->get('attachmentsFolder', NULL);
            if (is_null($path)) {
                $savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments';
            } else {
                $savepath = $path;
            }

            $counter = 0;

            foreach ($attachmentFiles as $file) {

                if($file["tmp_name"]){

                    $handle = new Upload($file);

                    if ($handle->uploaded) {
                        $handle->file_auto_rename = true;
                        $handle->allowed[] = 'application/x-zip';
                        $handle->Process($savepath);
                        $filename = $handle->file_dst_name;
                        $handle->Clean();
                        $attachment = &JTable::getInstance('K2Attachment', 'Table');
                        $attachment->itemID = $row->id;
                        $attachment->filename = $filename;
                        $attachment->title = ( empty($attachments_titles[$counter])) ? $filename : $attachments_titles[$counter];
                        $attachment->titleAttribute = ( empty($attachments_title_attributes[$counter])) ? $filename : $attachments_title_attributes[$counter];
                        $attachment->store();
                    } else {
                        $mainframe->redirect('index.php?option=com_k2&view=items', $handle->error, 'error');
                    }
                }
                $counter++;
            }

        }

        //Gallery
        if (isset($files['gallery']) && $files['gallery']['error'] == 0 && !JRequest::getBool('del_gallery')) {
            $handle = new Upload($files['gallery']);
            $handle->file_auto_rename = true;
            $savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries';
            $handle->allowed = array("application/download", "application/rar", "application/x-rar-compressed", "application/arj", "application/gnutar", "application/x-bzip", "application/x-bzip2", "application/x-compressed", "application/x-gzip", "application/x-zip-compressed", "application/zip", "multipart/x-zip", "multipart/x-gzip", "application/x-unknown", "application/x-zip");

            if ($handle->uploaded) {

                $handle->Process($savepath);
                $handle->Clean();

                if (JFolder::exists($savepath.DS.$row->id)) {
                    JFolder::delete($savepath.DS.$row->id);
                }

                if (!JArchive::extract($savepath.DS.$handle->file_dst_name, $savepath.DS.$row->id)) {
                    $mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Gallery upload error: Cannot extract archive!'), 'error');
                } else {
                    $row->gallery = '{gallery}'.$row->id.'{/gallery}';
                }
                JFile::delete($savepath.DS.$handle->file_dst_name);
                $handle->Clean();

            } else {
                $mainframe->redirect('index.php?option=com_k2&view=items', $handle->error, 'error');
            }
        }

        if (JRequest::getBool('del_gallery')) {

            $current = &JTable::getInstance('K2Item', 'Table');
            $current->load($row->id);

            if (JFolder::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries'.DS.$current->id)) {
                JFolder::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries'.DS.$current->id);
            }
            $row->gallery = '';
        }

        //Video
        if (!JRequest::getBool('del_video')) {
            if (isset($files['video']) && $files['video']['error'] == 0) {

                $validExtensions = array('flv', 'swf', 'wmv', 'mov', 'mp4', '3gp', 'avi', 'divx');

                $savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos';

                $filetype = JFile::getExt($files['video']['name']);

                if (!in_array($filetype, $validExtensions)) {
                    $mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Invalid video file'), 'error');
                }

                $filename = JFile::stripExt($files['video']['name']);

                JFile::upload($files['video']['tmp_name'], $savepath.DS.$row->id.'.'.$filetype);
                $filetype = JFile::getExt($files['video']['name']);
                $row->video = '{'.$filetype.'}'.$row->id.'{/'.$filetype.'}';

            } else {

                if (JRequest::getVar('remoteVideo')) {
                    $fileurl = JRequest::getVar('remoteVideo');
                    $filetype = JFile::getExt($fileurl);
                    $row->video = '{'.$filetype.'remote}'.$fileurl.'{/'.$filetype.'remote}';
                }

                if (JRequest::getVar('videoID')) {
                    $provider = JRequest::getWord('videoProvider');
                    $videoID = JRequest::getVar('videoID');
                    $row->video = '{'.$provider.'}'.$videoID.'{/'.$provider.'}';
                }

                if (JRequest::getVar('embedVideo', '', 'post', 'string', JREQUEST_ALLOWRAW)) {
                    $row->video = JRequest::getVar('embedVideo', '', 'post', 'string', JREQUEST_ALLOWRAW);
                }

            }

        } else {

            $current = &JTable::getInstance('K2Item', 'Table');
            $current->load($row->id);

            preg_match_all("#^{(.*?)}(.*?){#", $current->video, $matches, PREG_PATTERN_ORDER);
            $videotype = $matches[1][0];
            $videofile = $matches[2][0];

            if ($videotype == 'flv' || $videotype == 'swf' || $videotype == 'wmv' || $videotype == 'mov' || $videotype == 'mp4' || $videotype == '3gp' || $videotype == 'divx') {

                if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$videofile.'.'.$videotype))
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$videofile.'.'.$videotype);
            }

            $row->video = '';
            $row->video_caption = '';
            $row->video_credits = '';
        }

        //Extra fields
        $objects = array();
        $variables = JRequest::get('post', 4);
        foreach ($variables as $key=>$value) {
            if (( bool )JString::stristr($key, 'K2ExtraField_')) {
                $object = new JObject;
                $object->set('id', JString::substr($key, 13));
                $object->set('value', $value);
                unset($object->_errors);
                $objects[] = $object;
            }
        }

        $csvFiles = JRequest::get('files');
        foreach ($csvFiles as $key=>$file) {
            if (( bool )JString::stristr($key, 'K2ExtraField_')) {
                $object = new JObject;
                $object->set('id', JString::substr($key, 13));
                $csvFile = $file['tmp_name'][0];
                if(!empty($csvFile) && JFile::getExt($file['name'][0])=='csv'){
                    $handle = @fopen($csvFile, 'r');
                    $csvData=array();
                    while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                        $csvData[]=$data;
                    }
                    fclose($handle);
                    $object->set('value', $csvData);
                }
                else {
                    require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'JSON.php');
                    $json = new Services_JSON;
                    $object->set('value', $json->decode(JRequest::getVar('K2CSV_'.$object->id)));
                    if(JRequest::getBool('K2ResetCSV_'.$object->id))
                    $object->set('value', null);
                }
                unset($object->_errors);
                $objects[] = $object;
            }
        }


        require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'JSON.php');
        $json = new Services_JSON;
        $row->extra_fields = $json->encode($objects);

        require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'extrafield.php');
        $extraFieldModel = new K2ModelExtraField;
        $row->extra_fields_search = '';

        foreach ($objects as $object) {
            $row->extra_fields_search .= $extraFieldModel->getSearchValue($object->id, $object->value);
            $row->extra_fields_search .= ' ';
        }

        //Tags
        if($user->gid<24 && $params->get('lockTags'))
        $params->set('taggingSystem',0);
        $db = &JFactory::getDBO();
        $query = "DELETE FROM #__k2_tags_xref WHERE itemID={intval($row->id)}";
        $db->setQuery($query);
        $db->query();

        if($params->get('taggingSystem')){

            if($user->gid<24 && $params->get('lockTags'))
            JError::raiseError(403, JText::_("ALERTNOTAUTH"));

            $tags = JRequest::getVar('tags', NULL, 'POST', 'array');
            if (count($tags)) {
                $tags = array_unique($tags);
                foreach ($tags as $tag) {
                    $tag = str_replace('-','',$tag);
                    $query = "SELECT id FROM #__k2_tags WHERE name=".$db->Quote($tag);
                    $db->setQuery($query);
                    $tagID = $db->loadResult();
                    if($tagID){
                        $query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {intval($tagID)}, {intval($row->id)})";
                        $db->setQuery($query);
                        $db->query();
                    }
                    else {
                        $K2Tag = &JTable::getInstance('K2Tag', 'Table');
                        $K2Tag->name = $tag;
                        $K2Tag->published = 1;
                        $K2Tag->check();
                        $K2Tag->store();
                        $query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {intval($K2Tag->id)}, {intval($row->id)})";
                        $db->setQuery($query);
                        $db->query();
                    }
                }
            }

        }
        else {
            $tags = JRequest::getVar('selectedTags', NULL, 'POST', 'array');
            if (count($tags)) {
                foreach ($tags as $tagID) {
                    $query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {intval($tagID)}, {intval($row->id)})";
                    $db->setQuery($query);
                    $db->query();
                }
            }

        }

        if ($front) {
            if (!K2HelperPermissions::canPublishItem($row->catid) && $row->published == 1) {
                $row->published = 0;
                $mainframe->enqueueMessage(JText::_("You don't have the permission to publish items."), 'notice');
            }
        }

        if (!$row->store()) {
            $mainframe->redirect('index.php?option=com_k2&view=items', $row->getError(), 'error');
        }

        $row->checkin();

        $cache = &JFactory::getCache('com_k2');
        $cache->clean();

        $dispatcher->trigger('onAfterK2Save', array(&$row, $isNew));

        switch (JRequest::getCmd('task')) {
            case 'apply':
                $msg = JText::_('Changes to Item saved');
                $link = 'index.php?option=com_k2&view=item&cid='.$row->id;
                break;
            case 'saveAndNew':
                $msg = JText::_('Item saved');
                $link = 'index.php?option=com_k2&view=item';
                break;
            case 'save':
            default:
                $msg = JText::_('Item Saved');
                if ($front)
                $link = 'index.php?option=com_k2&view=item&task=edit&cid='.$row->id.'&tmpl=component';
                else
                $link = 'index.php?option=com_k2&view=items';
                break;
        }
        $mainframe->redirect($link, $msg);
    }

    function cancel() {

        $mainframe = &JFactory::getApplication();
        $cid = JRequest::getInt('id');
        $row = &JTable::getInstance('K2Item', 'Table');
        $row->load($cid);
        $row->checkin();
        $mainframe->redirect('index.php?option=com_k2&view=items');
    }

    function getVideoProviders() {

        jimport('joomla.filesystem.file');
        if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_allvideos'.DS.'includes'.DS.'sources.php')) {
            require JPATH_PLUGINS.DS.'content'.DS.'jw_allvideos'.DS.'includes'.DS.'sources.php';
            $thirdPartyProviders = array_slice($tagReplace, 18);
            $providersTmp = array_keys($thirdPartyProviders);
            $providers = array();
            foreach ($providersTmp as $providerTmp) {

                if (stristr($providerTmp, 'google|google.co.uk|google.com.au|google.de|google.es|google.fr|google.it|google.nl|google.pl') !== false) {
                    $provider = 'google';
                } elseif (stristr($providerTmp, 'spike|ifilm') !== false) {
                    $provider = 'spike';
                } else {
                    $provider = $providerTmp;
                }
                $providers[] = $provider;
            }
            return $providers;
        } else {
            return;
        }

    }

    function download($front = false) {

        $mainframe = &JFactory::getApplication();
        jimport('joomla.filesystem.file');
        $params = &JComponentHelper::getParams('com_k2');
        $id = JRequest::getInt('id');

        JPluginHelper::importPlugin('k2');
        $dispatcher = &JDispatcher::getInstance();

        $attachment = &JTable::getInstance('K2Attachment', 'Table');
        $attachment->load($id);

        $dispatcher->trigger('onK2BeforeDownload',  array(&$attachment, &$params));

        $path = $params->get('attachmentsFolder', NULL);
        if (is_null($path)) {
            $savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments';
        } else {
            $savepath = $path;
        }
        $file = $savepath.DS.$attachment->filename;

        if (JFile::exists($file)) {
            require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'class.upload.php');
            $handle = new Upload($file);
            $dispatcher->trigger('onK2AfterDownload',  array(&$attachment, &$params));
            if ($front)
            $attachment->hit();
            $len = filesize($file);
            $filename = basename($file);
            JResponse::clearHeaders();
            JResponse::setHeader('Pragma', 'public', true);
            JResponse::setHeader('Expires', '0', true);
            JResponse::setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
            JResponse::setHeader('Content-Type', $handle->file_src_mime, true);
            JResponse::setHeader('Content-Disposition', 'attachment; filename='.$filename.';', true);
            JResponse::setHeader('Content-Transfer-Encoding', 'binary', true);
            JResponse::setHeader('Content-Length', $len, true);
            JResponse::sendHeaders();
           	echo JFile::read($file);

        } else {
            echo JText::_('File does not exist');
        }
        $mainframe->close();
    }

    function getAttachments($itemID) {

        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_attachments WHERE itemID=".(int)$itemID;
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        return $rows;

    }

    function deleteAttachment() {

        $mainframe = &JFactory::getApplication();
        $params = &JComponentHelper::getParams('com_k2');
        jimport('joomla.filesystem.file');
        $id = JRequest::getInt('id');
        $itemID = JRequest::getInt('cid');

        $db = &JFactory::getDBO();
        $query = "SELECT COUNT(*) FROM #__k2_attachments WHERE itemID={$itemID} AND id={$id}";
        $db->setQuery($query);
        $result = $db->loadResult();

        if (!$result) {
            $mainframe->close();
        }

        $row = &JTable::getInstance('K2Attachment', 'Table');
        $row->load($id);

        $path = $params->get('attachmentsFolder', NULL);
        if (is_null($path)) {
            $savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments';
        } else {
            $savepath = $path;
        }

        if (JFile::exists($savepath.DS.$row->filename)) {
            JFile::delete($savepath.DS.$row->filename);
        }

        $row->delete($id);
        $mainframe->close();
    }

    function getAvailableTags($itemID = NULL) {

        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_tags as tags";
        if (!is_null($itemID))
        $query .= " WHERE tags.id NOT IN (SELECT tagID FROM #__k2_tags_xref WHERE itemID=".(int)$itemID.")";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        return $rows;
    }

    function getCurrentTags($itemID) {

        $db = &JFactory::getDBO();
        $itemID = (int) $itemID;
        $query = "SELECT * FROM #__k2_tags as tags WHERE tags.id IN (SELECT tagID FROM #__k2_tags_xref WHERE itemID={$itemID})";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        return $rows;
    }

    function resetHits(){
        $mainframe = &JFactory::getApplication();
        $id = JRequest::getInt('id');
        $db = &JFactory::getDBO();
        $query = "UPDATE #__k2_items SET hits=0 WHERE id={$id}";
        $db->setQuery($query);
        $db->query();
        if($mainframe->isAdmin())
        $url = 'index.php?option=com_k2&view=item&cid='.$id;
        else
        $url = 'index.php?option=com_k2&view=item&task=edit&cid='.$id.'&tmpl=component';
        $mainframe->redirect($url, JText::_('Successfully reset item hits' ));
    }

    function resetRating(){
        $mainframe = &JFactory::getApplication();
        $id = JRequest::getInt('id');
        $db = &JFactory::getDBO();
        $query = "DELETE FROM #__k2_rating WHERE itemID={$id}";
        $db->setQuery($query);
        $db->query();
        if($mainframe->isAdmin())
        $url = 'index.php?option=com_k2&view=item&cid='.$id;
        else
        $url = 'index.php?option=com_k2&view=item&task=edit&cid='.$id.'&tmpl=component';
        $mainframe->redirect($url, JText::_('Successfully reset item rating'));
    }

    function getRating(){
        $id = JRequest::getInt('cid');
        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_rating WHERE itemID={$id}";
        $db->setQuery($query, 0, 1);
        $row = $db->loadObject();
        return $row;
    }

    function checkSIG() {
        $mainframe = &JFactory::getApplication();
        if ( JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_sigpro.php') ) {
            return true;
        } else {
            return false;
        }
    }

    function checkAllVideos() {
        $mainframe = &JFactory::getApplication();
        if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_allvideos.php')) {
            return true;
        } else {
            return false;
        }
    }

}
