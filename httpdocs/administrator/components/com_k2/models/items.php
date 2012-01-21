<?php
/**
 * @version		$Id: items.php 528 2010-08-03 15:36:23Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelItems extends JModel {

	function getData() {

		$mainframe = &JFactory::getApplication();
		$params = &JComponentHelper::getParams('com_k2');
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = &JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', 'i.id', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', 'DESC', 'word');
		$filter_trash = $mainframe->getUserStateFromRequest($option.$view.'filter_trash', 'filter_trash', 0, 'int');
		$filter_featured = $mainframe->getUserStateFromRequest($option.$view.'filter_featured', 'filter_featured', -1, 'int');
		$filter_category = $mainframe->getUserStateFromRequest($option.$view.'filter_category', 'filter_category', 0, 'int');
		$filter_author = $mainframe->getUserStateFromRequest($option.$view.'filter_author', 'filter_author', 0, 'int');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);

		$query = "SELECT i.*, g.name AS groupname, c.name AS category, v.name AS author, w.name as moderator, u.name AS editor FROM #__k2_items as i";

		$query .= " LEFT JOIN #__k2_categories AS c ON c.id = i.catid"." LEFT JOIN #__groups AS g ON g.id = i.access"." LEFT JOIN #__users AS u ON u.id = i.checked_out"." LEFT JOIN #__users AS v ON v.id = i.created_by"." LEFT JOIN #__users AS w ON w.id = i.modified_by";

		$query .= " WHERE i.trash={$filter_trash}";

		if ($search) {

			$search = JString::str_ireplace('*', '', $search);
			$words = explode(' ', $search);
			for($i=0; $i<count($words); $i++){
				$words[$i]= '+'.$words[$i];
				$words[$i].= '*';
			}
			$search = implode(' ', $words);
			$search = $db->Quote($db->getEscaped($search, true), false);

			if($params->get('adminSearch')=='full')
			$query .= " AND MATCH(i.title, i.introtext, i.`fulltext`, i.extra_fields_search, i.image_caption,i.image_credits,i.video_caption,i.video_credits,i.metadesc,i.metakey)";
			else
			$query .= " AND MATCH( i.title )";

			$query.= " AGAINST ({$search} IN BOOLEAN MODE)";
		}

		if ($filter_state > - 1) {
			$query .= " AND i.published={$filter_state}";
		}

		if ($filter_featured > - 1) {
			$query .= " AND i.featured={$filter_featured}";
		}

		if ($filter_category > 0) {
			if ($params->get('showChildCatItems')) {
				require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'itemlist.php');
				$categories = K2ModelItemlist::getCategoryChilds($filter_category);
				$categories[] = $filter_category;
				JArrayHelper::toInteger($categories);
				$categories = @array_unique($categories);
				$sql = @implode(',', $categories);
				$query .= " AND i.catid IN ({$sql})";
			} else {
				$query .= " AND i.catid={$filter_category}";
			}

		}

		if ($filter_author > 0) {
			$query .= " AND i.created_by={$filter_author}";
		}

		if ($filter_order == 'i.ordering') {
			$query .= " ORDER BY i.catid, i.ordering {$filter_order_Dir}";
		} else {
			$query .= " ORDER BY {$filter_order} {$filter_order_Dir} ";
		}

		$db->setQuery($query, $limitstart, $limit);
		$rows = $db->loadObjectList();
		return $rows;

	}

	function getTotal() {

		$mainframe = &JFactory::getApplication();
		$params = &JComponentHelper::getParams('com_k2');
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = &JFactory::getDBO();
		$filter_trash = $mainframe->getUserStateFromRequest($option.$view.'filter_trash', 'filter_trash', 0, 'int');
		$filter_featured = $mainframe->getUserStateFromRequest($option.$view.'filter_featured', 'filter_featured', -1, 'int');
		$filter_category = $mainframe->getUserStateFromRequest($option.$view.'filter_category', 'filter_category', 0, 'int');
		$filter_author = $mainframe->getUserStateFromRequest($option.$view.'filter_author', 'filter_author', 0, 'int');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);

		$query = "SELECT COUNT(*) FROM #__k2_items WHERE trash={$filter_trash}";

		if ($search) {

			$search = JString::str_ireplace('*', '', $search);
			$words = explode(' ', $search);
			for($i=0; $i<count($words); $i++){
				$words[$i]= '+'.$words[$i];
				$words[$i].= '*';
			}
			$search = implode(' ', $words);
			$search = $db->Quote($db->getEscaped($search, true), false);

			if($params->get('adminSearch')=='full')
			$query .= " AND MATCH(title, introtext, `fulltext`, extra_fields_search, image_caption, image_credits, video_caption, video_credits, metadesc, metakey)";
			else
			$query .= " AND MATCH( title )";

			$query.= " AGAINST ({$search} IN BOOLEAN MODE)";
		}

		if ($filter_state > - 1) {
			$query .= " AND published={$filter_state}";
		}

		if ($filter_featured > - 1) {
			$query .= " AND featured={$filter_featured}";
		}

		if ($filter_category > 0) {
			if ($params->get('showChildCatItems')) {
				require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'itemlist.php');
				$categories = K2ModelItemlist::getCategoryChilds($filter_category);
				$categories[] = $filter_category;
				JArrayHelper::toInteger($categories);
				$categories = @array_unique($categories);
				$sql = @implode(',', $categories);
				$query .= " AND catid IN ({$sql})";
			} else {
				$query .= " AND catid={$filter_category}";
			}

		}

		if ($filter_author > 0) {
			$query .= " AND created_by={$filter_author}";
		}

		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;

	}

	function publish() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->publish($id, 1);
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=items');
	}

	function unpublish() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->publish($id, 0);
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=items');
	}

	function saveorder() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$cid = JRequest::getVar('cid', array(0), 'post', 'array');
		$total = count($cid);
		$order = JRequest::getVar('order', array(0), 'post', 'array');
		JArrayHelper::toInteger($order, array(0));
		$row = &JTable::getInstance('K2Item', 'Table');
		$groupings = array();
		for ($i = 0; $i < $total; $i++) {
			$row->load((int) $cid[$i]);
			$groupings[] = $row->catid;
			if ($row->ordering != $order[$i]) {
				$row->ordering = $order[$i];
				if (!$row->store()) {
					JError::raiseError(500, $db->getErrorMsg());
				}
			}
		}
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering')){
			$groupings = array_unique($groupings);
			foreach ($groupings as $group) {
				$row->reorder('catid = '.(int) $group.' AND trash=0');
			}
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function orderup() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		$row->load($cid[0]);
		$row->move(-1, 'catid = '.(int) $row->catid.' AND trash=0');
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering'))
		$row->reorder('catid = '.(int) $row->catid.' AND trash=0');
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function orderdown() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		$row->load($cid[0]);
		$row->move(1, 'catid = '.(int) $row->catid.' AND trash=0');
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering'))
		$row->reorder('catid = '.(int) $row->catid.' AND trash=0');
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function savefeaturedorder() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$cid = JRequest::getVar('cid', array(0), 'post', 'array');
		$total = count($cid);
		$order = JRequest::getVar('order', array(0), 'post', 'array');
		JArrayHelper::toInteger($order, array(0));
		$row = &JTable::getInstance('K2Item', 'Table');
		$groupings = array();
		for ($i = 0; $i < $total; $i++) {
			$row->load((int) $cid[$i]);
			$groupings[] = $row->catid;
			if ($row->featured_ordering != $order[$i]) {
				$row->featured_ordering = $order[$i];
				if (!$row->store()) {
					JError::raiseError(500, $db->getErrorMsg());
				}
			}
		}
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering')){
			$groupings = array_unique($groupings);
			foreach ($groupings as $group) {
				$row->reorder('featured = 1 AND trash=0', 'featured_ordering');
			}
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New featured ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function featuredorderup() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		$row->load($cid[0]);
		$row->move(-1, 'featured=1 AND trash=0', 'featured_ordering');
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering'))
		$row->reorder('featured=1 AND trash=0', 'featured_ordering');
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function featuredorderdown() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		$row->load($cid[0]);
		$row->move(1, 'featured=1 AND trash=0', 'featured_ordering');
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering'))
		$row->reorder('featured=1 AND trash=0', 'featured_ordering');
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function accessregistered() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$row = &JTable::getInstance('K2Item', 'Table');
		$cid = JRequest::getVar('cid');
		$row->load($cid[0]);
		$row->access = 1;
		if (!$row->check()) {
			return $row->getError();
		}
		if (!$row->store()) {
			return $row->getError();
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New access setting saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function accessspecial() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$row = &JTable::getInstance('K2Item', 'Table');
		$cid = JRequest::getVar('cid');
		$row->load($cid[0]);
		$row->access = 2;
		if (!$row->check()) {
			return $row->getError();
		}
		if (!$row->store()) {
			return $row->getError();
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New access setting saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function accesspublic() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$row = &JTable::getInstance('K2Item', 'Table');
		$cid = JRequest::getVar('cid');
		$row->load($cid[0]);
		$row->access = 0;
		if (!$row->check()) {
			return $row->getError();
		}
		if (!$row->store()) {
			return $row->getError();
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New access setting saved');
		$mainframe->redirect('index.php?option=com_k2&view=items', $msg);
	}

	function copy() {

		$mainframe = &JFactory::getApplication();
		jimport('joomla.filesystem.file');
		require_once (JPATH_COMPONENT.DS.'models'.DS.'item.php');
		$params = &JComponentHelper::getParams('com_k2');
		$itemModel = new K2ModelItem;
		$db = &JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		JArrayHelper::toInteger($cid);
		$row = &JTable::getInstance('K2Item', 'Table');

		$nullDate = $db->getNullDate();

		foreach ($cid as $id) {

			//Load source item
			$item = &JTable::getInstance('K2Item', 'Table');
			$item->load($id);
			$item->id = (int) $item->id;

			//Source images
			$sourceImage = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'src'.DS.md5("Image".$item->id).'.jpg';
			$sourceImageXS = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_XS.jpg';
			$sourceImageS = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_S.jpg';
			$sourceImageM = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_M.jpg';
			$sourceImageL = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_L.jpg';
			$sourceImageXL = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_XL.jpg';
			$sourceImageGeneric = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_Generic.jpg';

			//Source gallery
			$sourceGallery = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries'.DS.$item->id;
			$sourceGalleryTag = $item->gallery;

			//Source video
			preg_match_all("#^{(.*?)}(.*?){#", $item->video, $matches, PREG_PATTERN_ORDER);
			$videotype = $matches[1][0];
			$videofile = $matches[2][0];

			if ($videotype == 'flv' || $videotype == 'swf' || $videotype == 'wmv' || $videotype == 'mov' || $videotype == 'mp4' || $videotype == '3gp' || $videotype == 'divx') {
				if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$videofile.'.'.$videotype)) {
					$sourceVideo = $videofile.'.'.$videotype;
					//$row->video='{'.$videotype.'}'.$row->id.'{/'.$videotype.'}';
				}
			}

			//Source tags
			$query = "SELECT * FROM #__k2_tags_xref WHERE itemID={$item->id}";
			$db->setQuery($query);
			$sourceTags = $db->loadObjectList();

			//Source Attachments
			$sourceAttachments = $itemModel->getAttachments($item->id);

			//Save target item
			$row = &JTable::getInstance('K2Item', 'Table');
			$row = $item;
			$row->id = NULL;
			$row->title = JText::_('[Copy of]').' '.$item->title;
			$row->hits = 0;
			$datenow = &JFactory::getDate();
			$row->created = $datenow->toMySQL();
			$row->modified = $nullDate;
			$row->store();

			//Target images
			if (JFile::exists($sourceImage))
			JFile::copy($sourceImage, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'src'.DS.md5("Image".$row->id).'.jpg');
			if (JFile::exists($sourceImageXS))
			JFile::copy($sourceImageXS, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_XS.jpg');
			if (JFile::exists($sourceImageS))
			JFile::copy($sourceImageS, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_S.jpg');
			if (JFile::exists($sourceImageM))
			JFile::copy($sourceImageM, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_M.jpg');
			if (JFile::exists($sourceImageL))
			JFile::copy($sourceImageL, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_L.jpg');
			if (JFile::exists($sourceImageXL))
			JFile::copy($sourceImageXL, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_XL.jpg');
			if (JFile::exists($sourceImageGeneric))
			JFile::copy($sourceImageGeneric, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_Generic.jpg');

			//Target gallery
			if ($sourceGalleryTag){
				$row->gallery = '{gallery}'.$row->id.'{/gallery}';
				if (JFolder::exists($sourceGallery))
				JFolder::copy($sourceGallery, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries'.DS.$row->id);
			}

			//Target video
			if (isset($sourceVideo) && JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$sourceVideo)) {
				JFile::copy(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$sourceVideo, JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$row->id.'.'.$videotype);
				$row->video = '{'.$videotype.'}'.$row->id.'{/'.$videotype.'}';
			}

			//Target attachments
			$path = $params->get('attachmentsFolder', NULL);
			if (is_null($path))
			$savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments';
			else
			$savepath = $path;

			foreach ($sourceAttachments as $attachment) {
				if (JFile::exists($savepath.DS.$attachment->filename)) {
					JFile::copy($savepath.DS.$attachment->filename, $savepath.DS.$row->id.'_'.$attachment->filename);
					$attachmentRow = &JTable::getInstance('K2Attachment', 'Table');
					$attachmentRow->itemID = $row->id;
					$attachmentRow->title = $attachment->title;
					$attachmentRow->titleAttribute = $attachment->titleAttribute;
					$attachmentRow->filename = $row->id.'_'.$attachment->filename;
					$attachmentRow->hits = 0;
					$attachmentRow->store();
				}
			}

			//Target tags
			foreach ($sourceTags as $tag) {
				$query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {intval($tag->tagID)}, {intval($row->id)})";
				$db->setQuery($query);
				$db->query();
			}

			$row->store();
		}

		$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Copy completed'));
	}

	function featured() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			if ($row->featured == 1)
			$row->featured = 0;
			else {
				$row->featured = 1;
				$row->featured_ordering = 1;
			}
			$row->store();
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Items changed'));
	}

	function trash() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		JArrayHelper::toInteger($cid);
		$row = &JTable::getInstance('K2Item', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->trash = 1;
			$row->store();
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Items moved to trash'));

	}

	function restore() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		$warning = false;
		foreach ($cid as $id) {
			$row->load($id);
			$query = "SELECT COUNT(*) FROM #__k2_categories WHERE id=".(int)$row->catid." AND trash = 0";
			$db->setQuery($query);
			$result = $db->loadResult();
			if ($result) {
				$row->trash = 0;
				$row->store();
			} else {
				$warning = true;
			}

		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		if ($warning)
		$mainframe->enqueueMessage(JText::_('Some of the items have not been restored because they belong to a category which is in trash.'), 'notice');
		$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Items restored'));

	}

	function remove() {

		$mainframe = &JFactory::getApplication();
		jimport('joomla.filesystem.file');
		$params = &JComponentHelper::getParams('com_k2');
		require_once (JPATH_COMPONENT.DS.'models'.DS.'item.php');
		$itemModel = new K2ModelItem;
		$db = &JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = &JTable::getInstance('K2Item', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->id = (int) $row->id;
			//Delete images
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'src'.DS.md5("Image".$row->id).'.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'src'.DS.md5("Image".$row->id).'.jpg');
			}
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_XS.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_XS.jpg');
			}
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_S.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_S.jpg');
			}
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_M.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_M.jpg');
			}
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_L.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_L.jpg');
			}
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_XL.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_XL.jpg');
			}
			if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_Generic.jpg')) {
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$row->id).'_Generic.jpg');
			}

			//Delete gallery
			if (JFolder::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries'.DS.$row->id))
			JFolder::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'galleries'.DS.$row->id);

			//Delete video
			preg_match_all("#^{(.*?)}(.*?){#", $row->video, $matches, PREG_PATTERN_ORDER);
			$videotype = $matches[1][0];
			$videofile = $matches[2][0];

			if ($videotype == 'flv' || $videotype == 'swf' || $videotype == 'wmv' || $videotype == 'mov' || $videotype == 'mp4' || $videotype == '3gp' || $videotype == 'divx') {
				if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$videofile.'.'.$videotype))
				JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'videos'.DS.$videofile.'.'.$videotype);
			}

			//Delete attachments
			$path = $params->get('attachmentsFolder', NULL);
			if (is_null($path))
			$savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'attachments';
			else
			$savepath = $path;

			$attachments = $itemModel->getAttachments($row->id);

			foreach ($attachments as $attachment) {
				if (JFile::exists($savepath.DS.$attachment->filename))
				JFile::delete($savepath.DS.$attachment->filename);
			}

			$query = "DELETE FROM #__k2_attachments WHERE itemID={$row->id}";
			$db->setQuery($query);
			$db->query();

			//Delete tags
			$query = "DELETE FROM #__k2_tags_xref WHERE itemID={$row->id}";
			$db->setQuery($query);
			$db->query();

			$row->delete($id);
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Delete Completed'));
	}

	function import() {

		$mainframe = &JFactory::getApplication();
		jimport('joomla.filesystem.file');
		$db = &JFactory::getDBO();
		$query = "SELECT * FROM #__sections";
		$db->setQuery($query);
		$sections = $db->loadObjectList();

		$query = "SELECT COUNT(*) FROM #__k2_items";
		$db->setQuery($query);
		$result = $db->loadResult();
		if($result)
		$preserveItemIDs = false;
		else
		$preserveItemIDs = true;

		$xml = new JSimpleXML;
		$xml->loadFile(JPATH_COMPONENT.DS.'models'.DS.'category.xml');
		$categoryParams = new JParameter('');

		foreach ($xml->document->params as $paramGroup) {
			foreach ($paramGroup->param as $param) {
				if ($param->attributes('type') != 'spacer') {
					$categoryParams->set($param->attributes('name'), $param->attributes('default'));
				}
			}
		}
		$categoryParams = $categoryParams->toString();

		$xml = new JSimpleXML;
		$xml->loadFile(JPATH_COMPONENT.DS.'models'.DS.'item.xml');
		$itemParams = new JParameter('');

		foreach ($xml->document->params as $paramGroup) {
			foreach ($paramGroup->param as $param) {
				if ($param->attributes('type') != 'spacer') {
					$itemParams->set($param->attributes('name'), $param->attributes('default'));
				}
			}
		}
		$itemParams = $itemParams->toString();

		$query = "SELECT id, name FROM #__k2_tags";
		$db->setQuery($query);
		$tags = $db->loadObjectList();

		if(is_null($tags))
		$tags = array();

		foreach ($sections as $section) {
			$K2Category = &JTable::getInstance('K2Category', 'Table');
			$K2Category->name = $section->title;
			$K2Category->alias = $section->title;
			$K2Category->description = $section->description;
			$K2Category->parent = 0;
			$K2Category->published = $section->published;
			$K2Category->access = $section->access;
			$K2Category->ordering = $section->ordering;
			$K2Category->image = $section->image;
			$K2Category->trash = 0;
			$K2Category->params = $categoryParams;
			$K2Category->check();
			$K2Category->store();
			if (JFile::exists(JPATH_SITE.DS.'images'.DS.'stories'.DS.$section->image)) {
				JFile::copy(JPATH_SITE.DS.'images'.DS.'stories'.DS.$section->image, JPATH_SITE.DS.'media'.DS.'k2'.DS.'categories'.DS.$K2Category->image);
			}
			$query = "SELECT * FROM #__categories WHERE section = ".(int)$section->id;
			$db->setQuery($query);
			$categories = $db->loadObjectList();

			foreach ($categories as $category) {
				$K2Subcategory = &JTable::getInstance('K2Category', 'Table');
				$K2Subcategory->name = $category->title;
				$K2Subcategory->alias = $category->title;
				$K2Subcategory->description = $category->description;
				$K2Subcategory->parent = $K2Category->id;
				$K2Subcategory->published = $category->published;
				$K2Subcategory->access = $category->access;
				$K2Subcategory->ordering = $category->ordering;
				$K2Subcategory->image = $category->image;
				$K2Subcategory->trash = 0;
				$K2Subcategory->params = $categoryParams;
				$K2Subcategory->check();
				$K2Subcategory->store();
				if (JFile::exists(JPATH_SITE.DS.'images'.DS.'stories'.DS.$category->image)) {
					JFile::copy(JPATH_SITE.DS.'images'.DS.'stories'.DS.$category->image, JPATH_SITE.DS.'media'.DS.'k2'.DS.'categories'.DS.$K2Subcategory->image);
				}

				$query = "SELECT * FROM #__content WHERE catid = ".(int)$category->id;
				$db->setQuery($query);
				$items = $db->loadObjectList();

				foreach ($items as $item) {

					$K2Item = &JTable::getInstance('K2Item', 'Table');
					$K2Item->title = $item->title;
					$K2Item->alias = $item->title;
					$K2Item->catid = $K2Subcategory->id;
					if ($item->state < 0) {
						$K2Item->trash = 1;
					} else {
						$K2Item->trash = 0;
						$K2Item->published = $item->state;
					}
					$K2Item->introtext = $item->introtext;
					$K2Item->fulltext = $item->fulltext;
					$K2Item->created = $item->created;
					$K2Item->created_by = $item->created_by;
					$K2Item->created_by_alias = $item->created_by_alias;
					$K2Item->modified = $item->modified;
					$K2Item->modified_by = $item->modified_by;
					$K2Item->publish_up = $item->publish_up;
					$K2Item->publish_down = $item->publish_down;
					$K2Item->access = $item->access;
					$K2Item->ordering = $item->ordering;
					$K2Item->hits = $item->hits;
					$K2Item->metadesc = $item->metadesc;
					$K2Item->metadata = $item->metadata;
					$K2Item->metakey = $item->metakey;
					$K2Item->params = $itemParams;
					$K2Item->check();
					if($preserveItemIDs){
						$K2Item->id = $item->id;
						$db->insertObject('#__k2_items', $K2Item);
					}
					else {
						$K2Item->store();
					}


					if(!empty($item->metakey)){
						$itemTags = explode(',', $item->metakey);
						foreach($itemTags as $itemTag){
							$itemTag = JString::trim($itemTag);
							if(in_array($itemTag ,JArrayHelper::getColumn($tags, 'name'))){

								$query = "SELECT id FROM #__k2_tags WHERE name=".$db->Quote($itemTag);
								$db->setQuery($query);
								$id = $db->loadResult();
								$query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {$id}, {$K2Item->id})";
								$db->setQuery($query);
								$db->query();
							}
							else {
								$K2Tag = &JTable::getInstance('K2Tag', 'Table');
								$K2Tag->name = $itemTag;
								$K2Tag->published = 1;
								$K2Tag->store();
								$tags[]=$K2Tag;
								$query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {$K2Tag->id}, {$K2Item->id})";
								$db->setQuery($query);
								$db->query();
							}
						}
					}
				}

			}

		}

		//Handle Uncategorized items
		$query = "SELECT * FROM #__content WHERE sectionid = 0";
		$db->setQuery($query);
		$items = $db->loadObjectList();

		if($items){
			$K2Uncategorised = &JTable::getInstance('K2Category', 'Table');
			$K2Uncategorised->name = 'Uncategorized';
			$K2Uncategorised->alias = 'Uncategorized';
			$K2Uncategorised->parent = 0;
			$K2Uncategorised->published = 1;
			$K2Uncategorised->access = 0;
			$K2Uncategorised->ordering = 0;
			$K2Uncategorised->trash = 0;
			$K2Uncategorised->params = $categoryParams;
			$K2Uncategorised->check();
			$K2Uncategorised->store();

			foreach ($items as $item) {

				$K2Item = &JTable::getInstance('K2Item', 'Table');
				$K2Item->title = $item->title;
				$K2Item->alias = $item->title;
				$K2Item->catid = $K2Uncategorised->id;
				if ($item->state < 0) {
					$K2Item->trash = 1;
				} else {
					$K2Item->trash = 0;
					$K2Item->published = $item->state;
				}
				$K2Item->introtext = $item->introtext;
				$K2Item->fulltext = $item->fulltext;
				$K2Item->created = $item->created;
				$K2Item->created_by = $item->created_by;
				$K2Item->created_by_alias = $item->created_by_alias;
				$K2Item->modified = $item->modified;
				$K2Item->modified_by = $item->modified_by;
				$K2Item->publish_up = $item->publish_up;
				$K2Item->publish_down = $item->publish_down;
				$K2Item->access = $item->access;
				$K2Item->ordering = $item->ordering;
				$K2Item->hits = $item->hits;
				$K2Item->metadesc = $item->metadesc;
				$K2Item->metadata = $item->metadata;
				$K2Item->metakey = $item->metakey;
				$K2Item->params = $itemParams;
				$K2Item->check();
				if($preserveItemIDs){
					$K2Item->id = $item->id;
					$db->insertObject('#__k2_items', $K2Item);
				}
				else {
					$K2Item->store();
				}

				if(!empty($item->metakey)){
					$itemTags = explode(',', $item->metakey);
					foreach($itemTags as $itemTag){
						$itemTag = JString::trim($itemTag);
						if(in_array($itemTag ,JArrayHelper::getColumn($tags, 'name'))){

							$query = "SELECT id FROM #__k2_tags WHERE name=".$db->Quote($itemTag);
							$db->setQuery($query);
							$id = $db->loadResult();
							$query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {$id}, {$K2Item->id})";
							$db->setQuery($query);
							$db->query();
						}
						else {
							$K2Tag = &JTable::getInstance('K2Tag', 'Table');
							$K2Tag->name = $itemTag;
							$K2Tag->published = 1;
							$K2Tag->store();
							$tags[]=$K2Tag;
							$query = "INSERT INTO #__k2_tags_xref (`id`, `tagID`, `itemID`) VALUES (NULL, {$K2Tag->id}, {$K2Item->id})";
							$db->setQuery($query);
							$db->query();
						}
					}
				}
			}
		}
		$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Import Completed'));
	}

	function move() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$catid = JRequest::getInt('category');
		$row = &JTable::getInstance('K2Item', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->catid = $catid;
			$row->ordering = $row->getNextOrder('catid = '.$row->catid.' AND published = 1');
			$row->store();
		}
		$cache = &JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=items', JText::_('Move completed'));

	}

}
