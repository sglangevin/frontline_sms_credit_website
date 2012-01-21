<?php
/**
 * @version		$Id: view.html.php 519 2010-07-23 11:23:53Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewItem extends JView {

	function display($tpl = null) {
		$mainframe = &JFactory::getApplication();
		$user = &JFactory::getUser();
		$document = &JFactory::getDocument();
		$params = &JComponentHelper::getParams('com_k2');
		$limitstart = JRequest::getInt('limitstart', 0);
		$view = JRequest::getWord('view');
		$task = JRequest::getWord('task');

		$db = &JFactory::getDBO();
		$jnow = &JFactory::getDate();
		$now = $jnow->toMySQL();
		$nullDate = $db->getNullDate();

		$this->setLayout('item');

		//Add link
		if (K2HelperPermissions::canAddItem())
		$addLink = JRoute::_('index.php?option=com_k2&view=item&task=add&tmpl=component');
		$this->assignRef('addLink', $addLink);

		//Get item
		$model = &$this->getModel();
		$item = $model->getData();

		//Prepare item
		if ($user->guest){
			$cache = &JFactory::getCache('com_k2_extended');
			$hits = $item->hits;
			$item->hits = 0;
			$item = $cache->call(array('K2ModelItem', 'prepareItem'), $item, $view, $task);
			$item->hits = $hits;
		} else {
			$item = $model->prepareItem($item, $view, $task);
		}

		//Plugins
		$item = $model->execPlugins($item, $view, $task);

		//User K2 plugins
		$item->event->K2UserDisplay = '';
		if (is_object($item->author->profile) && isset($item->author->profile->id)) {
			$dispatcher = &JDispatcher::getInstance();
			JPluginHelper::importPlugin('k2');
			$results = $dispatcher->trigger('onK2UserDisplay', array(&$item->author->profile, &$params, $limitstart));
			$item->event->K2UserDisplay = trim(implode("\n", $results));
		}

		//Access check
		if ($this->getLayout() == 'form') {
			JError::raiseError(403, JText::_("ALERTNOTAUTH"));
		}
		if ($item->access > $user->get('aid', 0) || $item->category->access > $user->get('aid', 0)) {
			JError::raiseError(403, JText::_("ALERTNOTAUTH"));
		}

		//Published check
		if (!$item->published || $item->trash) {
			JError::raiseError(404, JText::_("Item not found"));
		}

		if ($item->publish_up != $nullDate && $item->publish_up > $now) {
			JError::raiseError(404, JText::_("Item not found"));
		}

		if ($item->publish_down != $nullDate && $item->publish_down < $now) {
			JError::raiseError(404, JText::_("Item not found"));
		}

		if (!$item->category->published || $item->category->trash) {
			JError::raiseError(404, JText::_("Item not found"));
		}

		//Increase hits counter
		$model->hit($item->id);

		//Set default image
		K2HelperUtilities::setDefaultImage($item, $view);

		//Comments
		$item->event->K2CommentsCounter = '';
		$item->event->K2CommentsBlock = '';
		if ($item->params->get('itemComments')) {
			//Trigger comments events
			$dispatcher = &JDispatcher::getInstance();
			JPluginHelper::importPlugin ('k2');
			$results = $dispatcher->trigger('onK2CommentsCounter', array ( & $item, &$params, $limitstart));
			$item->event->K2CommentsCounter = trim(implode("\n", $results));
			$results = $dispatcher->trigger('onK2CommentsBlock', array ( & $item, &$params, $limitstart));
			$item->event->K2CommentsBlock = trim(implode("\n", $results));

			//Load K2 native comments system only if there are no plugins overriding it
			if(empty($item->event->K2CommentsCounter) && empty($item->event->K2CommentsBlock)){

				//Load reCAPTCHA script
				if (!JRequest::getInt('print') && ($item->params->get('comments') == '1' || ($item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($item->catid)))) {
					if ($item->params->get('recaptcha') && $user->guest) {
						$document->addScript('http://api.recaptcha.net/js/recaptcha_ajax.js');
						$js = '
	                 	function showRecaptcha(){
									    Recaptcha.create("'.$item->params->get('recaptcha_public_key').'", "recaptcha", {
									        theme: "'.$item->params->get('recaptcha_theme', 'clean').'"
									    });
										}
										window.addEvent(\'load\', function(){
											showRecaptcha();
										});
										';
						$document->addScriptDeclaration($js);
					}

					//Auto complete some fields for registered users
					if (!$user->guest) {
						$js = "
										window.addEvent('domready', function(){
											$('userName').setProperty('value','".$user->name."');
											$('userName').setProperty('disabled','disabled');
											$('commentEmail').setProperty('value','".$user->email."');
											$('commentEmail').setProperty('disabled','disabled');
										});
										";
						$document->addScriptDeclaration($js);
					}

				}

				$limit = $params->get('commentsLimit');
				$comments = $model->getItemComments($item->id, $limitstart, $limit);
				$pattern = "@\b(https?://)?(([0-9a-zA-Z_!~*'().&=+$%-]+:)?[0-9a-zA-Z_!~*'().&=+$%-]+\@)?(([0-9]{1,3}\.){3}[0-9]{1,3}|([0-9a-zA-Z_!~*'()-]+\.)*([0-9a-zA-Z][0-9a-zA-Z-]{0,61})?[0-9a-zA-Z]\.[a-zA-Z]{2,6})(:[0-9]{1,4})?((/[0-9a-zA-Z_!~*'().;?:\@&=+$,%#-]+)*/?)@";

				for ($i = 0; $i < sizeof($comments); $i++) {
					$comments[$i]->commentText = nl2br($comments[$i]->commentText);
					$comments[$i]->commentText = preg_replace($pattern, '<a target="_blank" rel="nofollow" href="\0">\0</a>', $comments[$i]->commentText);
					$comments[$i]->userImage = K2HelperUtilities::getAvatar($comments[$i]->userID, $comments[$i]->commentEmail, $params->get('commenterImgWidth'));
					if ($comments[$i]->userID>0)
					$comments[$i]->userLink = K2HelperRoute::getUserRoute($comments[$i]->userID);
					else
					$comments[$i]->userLink = $comments[$i]->commentURL;
				}

				$item->comments = $comments;

				jimport('joomla.html.pagination');
				$total = $item->numOfComments;
				$pagination = new JPagination($total, $limitstart, $limit);

			}

		}

		//Author's latest items
		if ($params->get('itemAuthorLatest') && $item->created_by_alias == '') {
			$model = &$this->getModel('itemlist');
			$authorLatestItems = $model->getAuthorLatest($item->id, $params->get('itemAuthorLatestLimit'), $item->created_by);
			if (count($authorLatestItems)) {
				for ($i = 0; $i < sizeof($authorLatestItems); $i++) {
					$authorLatestItems[$i]->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($authorLatestItems[$i]->id.':'.urlencode($authorLatestItems[$i]->alias), $authorLatestItems[$i]->catid.':'.urlencode($authorLatestItems[$i]->categoryalias))));
				}
				$this->assignRef('authorLatestItems', $authorLatestItems);
			}
		}

		//Related items
		if ($params->get('itemRelated') && isset($item->tags) && count($item->tags)) {
			$model = &$this->getModel('itemlist');
			$relatedItems = $model->getRelatedItems($item->id, $item->tags, $params->get('itemRelatedLimit'));
			if (count($relatedItems)) {
				for ($i = 0; $i < sizeof($relatedItems); $i++) {
					$relatedItems[$i]->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($relatedItems[$i]->id.':'.urlencode($relatedItems[$i]->alias), $relatedItems[$i]->catid.':'.urlencode($relatedItems[$i]->categoryalias))));
				}
				$this->assignRef('relatedItems', $relatedItems);
			}

		}

		//Navigation (previous and next item)
		if ($params->get('itemNavigation')) {
			$model = &$this->getModel('item');

			$nextItem = $model->getNextItem($item->id, $item->catid, $item->ordering);
			if (!is_null($nextItem)) {
				$item->nextLink = urldecode(JRoute::_(K2HelperRoute::getItemRoute($nextItem->id.':'.urlencode($nextItem->alias), $nextItem->catid.':'.urlencode($item->category->alias))));
				$item->nextTitle = $nextItem->title;
			}

			$previousItem = $model->getPreviousItem($item->id, $item->catid, $item->ordering);
			if (!is_null($previousItem)) {
				$item->previousLink = urldecode(JRoute::_(K2HelperRoute::getItemRoute($previousItem->id.':'.urlencode($previousItem->alias), $previousItem->catid.':'.urlencode($item->category->alias))));
				$item->previousTitle = $previousItem->title;
			}

		}

		//Absolute URL
		$uri = &JURI::getInstance();
		$item->absoluteURL = $uri->_uri;

		//Email link
		$item->emailLink = JRoute::_('index.php?option=com_mailto&tmpl=component&link='.base64_encode($item->absoluteURL));

		//Twitter link
		if ($params->get('itemTwitterLink') && $params->get('twitterUsername')) {
			$itemURLForTwitter = ($params->get('tinyURL')) ? @file_get_contents('http://tinyurl.com/api-create.php?url='.$item->absoluteURL) : $item->absoluteURL;
			$item->twitterURL = 'http://twitter.com/home/?status='.urlencode('Reading @'.$params->get('twitterUsername').' '.$item->title.' '.$itemURLForTwitter);
		}

		//Social link
		$item->socialLink = urlencode($item->absoluteURL);


		//Set page title
		$menus = &JSite::getMenu();
		$menu = $menus->getActive();
		if (is_object($menu) && isset($menu->query['view']) && $menu->query['view'] == 'item' && isset($menu->query['id']) && $menu->query['id'] == $item->id) {
			$menu_params = new JParameter($menu->params);
			if (!$menu_params->get('page_title')) {
				$params->set('page_title', $item->cleanTitle);
			}
		} else {
			$params->set('page_title', $item->cleanTitle);
		}
		$document->setTitle($params->get('page_title'));

		//Set pathway
		$menus = &JSite::getMenu();
		$menu = $menus->getActive();
		$pathway = &$mainframe->getPathWay();
		if($menu) {
			if($menu->query['view']!='item' || $menu->query['id']!= $item->id){
				if(!isset($menu->query['task']) || $menu->query['task']!='category' || $menu->query['id']!= $item->catid)
				$pathway->addItem($item->category->name, $item->category->link);
				$pathway->addItem($item->title, '');
			}
		}

		//Set metadata
		if ($item->metadesc) {
			$document->setDescription($item->metadesc);
		}
		else {
			$metaDescItem = preg_replace("#{(.*?)}(.*?){/(.*?)}#s", '', $item->introtext.' '.$item->fulltext);
			$metaDescItem = K2HelperUtilities::characterLimit($metaDescItem, $params->get('metaDescLimit', 150));
			$document->setDescription($metaDescItem);
		}
		if ($item->metakey) {
			$document->setMetadata('keywords', $item->metakey);
		}
		else {
			if(isset($item->tags) && count($item->tags)){
				$tmp = array();
				foreach($item->tags as $tag){
					$tmp[]=$tag->name;
				}
				$document->setMetadata('keywords', implode(',', $tmp));
			}
		}

		if ($mainframe->getCfg('MetaTitle') == '1') {
			$mainframe->addMetaTag('title', $item->title);
		}
		if ($mainframe->getCfg('MetaAuthor') == '1' && isset($item->author->name)) {
			$mainframe->addMetaTag('author', $item->author->name);
		}
		$mdata = new JParameter($item->metadata);
		$mdata = $mdata->toArray();
		foreach ($mdata as $k=>$v) {
			if ($k == 'robots' || $k == 'author') {
				if ($v)
				$document->setMetadata($k, $v);
			}
		}

		//Look for template files in component folders
		$this->_addPath('template', JPATH_COMPONENT.DS.'templates');
		$this->_addPath('template', JPATH_COMPONENT.DS.'templates'.DS.'default');

		//Look for overrides in template folder (K2 template structure)
		$this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates');
		$this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates'.DS.'default');

		//Look for overrides in template folder (Joomla! template structure)
		$this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'default');
		$this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2');

		//Look for specific K2 theme files
		if ($item->params->get('theme')) {
			$this->_addPath('template', JPATH_COMPONENT.DS.'templates'.DS.$item->params->get('theme'));
			$this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates'.DS.$item->params->get('theme'));
			$this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.$item->params->get('theme'));
		}

		//Assign data
		$this->assignRef('item', $item);
		$this->assignRef('user', $user);
		$this->assignRef('params', $item->params);
		$this->assignRef('pagination', $pagination);

		parent::display($tpl);
	}

	function edit() {

		$mainframe = &JFactory::getApplication();
		jimport('joomla.filesystem.file');
		jimport('joomla.html.pane');
		$db = &JFactory::getDBO();
		JHTML::_('behavior.mootools');
		JHTML::_('behavior.keepalive');
		$document = &JFactory::getDocument();

		$document->addScript(JURI::root().'administrator/components/com_k2/lib/Autocompleter.js');
		$document->addScript(JURI::root().'administrator/components/com_k2/lib/observer.js');

		$document->addScript(JURI::root().'administrator/components/com_k2/lib/simpletabs_1.3.js');
		//$document->addScript(JURI::root().'administrator/components/com_k2/lib/simpletabs_1.3.packed.js');
		//$document->addScript(JURI::root().'administrator/components/com_k2/js/k2.js'); // Core JS
		$document->addScript(JURI::root().'administrator/components/com_k2/js/k2.mootools.js'); // Mootools based JS

		$document->addCustomTag('

<!-- K2 by JoomlaWorks (start) -->

	<!-- Load Khepri styling -->
	<link rel="stylesheet" href="'.JURI::root().'administrator/templates/system/css/system.css" type="text/css" />
	<link href="'.JURI::root().'administrator/templates/khepri/css/template.css" rel="stylesheet" type="text/css" />
	<!--[if IE 7]>
	<link href="'.JURI::root().'administrator/templates/khepri/css/ie7.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--[if lte IE 6]>
	<link href="'.JURI::root().'administrator/templates/khepri/css/ie6.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="'.JURI::root().'administrator/templates/khepri/css/rounded.css" />

	<!-- Load K2 styling -->
	<link href="'.JURI::root().'administrator/components/com_k2/css/k2.css" rel="stylesheet" type="text/css" />

<!-- K2 by JoomlaWorks (end) -->

		');

		$document->addScript(JURI::root().'administrator/components/com_k2/lib/nicEdit.js');
		$js =
		"function initExtraFieldsEditor(){
			$$('.k2ExtraFieldEditor').each(function(element) {
				var id = element.id;
				if (typeof JContentEditor != 'undefined') {
					if (tinyMCE.get(id)) {
						tinymce.EditorManager.remove(tinyMCE.get(id));
					}
					tinyMCE.execCommand('mceAddControl', false, id);
				} else {
					new nicEditor({fullPanel: true, maxHeight: 180, iconsPath: '".JURI::root()."administrator/components/com_k2/images/system/nicEditorIcons.gif'}).panelInstance(element.getProperty('id'));
				}
			});
		}
		function syncExtraFieldsEditor(){
			$$('.k2ExtraFieldEditor').each(function(element){
				editor = nicEditors.findEditor(element.getProperty('id'));
				if(typeof editor != 'undefined'){
					editor.saveContent();
				}
    		});
		}
		";
		$document->addScriptDeclaration($js);

		JRequest::setVar('tmpl', 'component');

		require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'item.php');
		$model = new K2ModelItem;

		$task = JRequest::getCmd('task');
		$user = &JFactory::getUser();

		if ($task == 'edit') {
			$item = $model->getData();
			JFilterOutput::objectHTMLSafe( $item, ENT_QUOTES, 'video' );
			if (!K2HelperPermissions::canEditItem($item->created_by, $item->catid)) {
				JError::raiseError(403, JText::_("ALERTNOTAUTH"));
			}

			if (JTable::isCheckedOut($user->get('id'), $item->checked_out)) {
				$msg = JText::sprintf('DESCBEINGEDITTED', JText::_('The item'), $item->title);
				$mainframe->redirect('index.php?option=com_k2&view=item&id='.$item->id.'&tmpl=component', $msg);
			}


		}
		elseif ($task == 'add') {

			if (!K2HelperPermissions::canAddItem()) {
				JError::raiseError(403, JText::_("ALERTNOTAUTH"));
			}
			JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
			$item = &JTable::getInstance('K2Item', 'Table');

			$createdate = &JFactory::getDate();
			$item->published = 1;
			$item->publish_up = $createdate->toUnix();
			$item->publish_down = JText::_('Never');
			$item->created = $createdate->toUnix();
			$item->modified = $db->getNullDate();

		}

		if ($item->id) {
			$item->checkout($user->get('id'));
		}

		$item->created = JHTML::_('date', $item->created, '%Y-%m-%d %H:%M:%S');
		$item->publish_up = JHTML::_('date', $item->publish_up, '%Y-%m-%d %H:%M:%S');

		if (JHTML::_('date', $item->publish_down, '%Y') <= 1969 || $item->publish_down == $db->getNullDate()) {
			$item->publish_down = JText::_('Never');
		} else {
			$item->publish_down = JHTML::_('date', $item->publish_down, '%Y-%m-%d %H:%M:%S');
		}

		$params = &JComponentHelper::getParams('com_k2');
		$wysiwyg = &JFactory::getEditor();

		if ($params->get("mergeEditors")) {

			if (JString::strlen($item->fulltext) > 1) {
				$textValue = $item->introtext."<hr id=\"system-readmore\" />".$item->fulltext;
			} else {
				$textValue = $item->introtext;
			}
			$text = $wysiwyg->display('text', $textValue, '100%', '400', '40', '5');
			$this->assignRef('text', $text);
		}
		else {
			$introtext = $wysiwyg->display('introtext', $item->introtext, '100%', '400', '40', '5', array('readmore'));
			$this->assignRef('introtext', $introtext);
			$fulltext = $wysiwyg->display('fulltext', $item->fulltext, '100%', '400', '40', '5', array('readmore'));
			$this->assignRef('fulltext', $fulltext);
		}

		$lists = array();
		$lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $item->published);
		$lists['access'] = JHTML::_('list.accesslevel', $item);

		$query = "SELECT ordering AS value, title AS text FROM #__k2_items WHERE catid={$item->catid}";
		$lists['ordering'] = JHTML::_('list.specificordering', $item, $item->id, $query);

		require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'categories.php');
		$categoriesModel = new K2ModelCategories;
		$categories = $categoriesModel->categoriesTree();
		$lists['catid'] = JHTML::_('select.genericlist', $categories, 'catid', 'class="inputbox"', 'value', 'text', $item->catid);

		$lists['checkSIG'] = $model->checkSIG();
		$lists['checkAllVideos'] = $model->checkAllVideos();

		$remoteVideo = false;
		$providerVideo = false;
		$embedVideo = false;
		$options['startOffset'] = 0;

		if (stristr($item->video, 'remote}') !== false) {
			$remoteVideo = true;
			$options['startOffset'] = 1;
		}

		$providers = $model->getVideoProviders();
		if (count($providers)) {
			foreach ($providers as $provider) {
				$providersOptions[] = JHTML::_('select.option', $provider, $provider);
				if (stristr($item->video, "{{$provider}}") !== false) {
					$providerVideo = true;
					$options['startOffset'] = 2;
				}
			}
		}

		if (JString::substr($item->video, 0, 1) !== '{') {
			$embedVideo = true;
			$options['startOffset']= 3;
		}

		$lists['uploadedVideo'] = (!$remoteVideo && !$providerVideo && !$embedVideo) ? true : false;

		if ($lists['uploadedVideo']) {
			$options['startOffset'] = 0;
		}

		$lists['remoteVideo'] = ($remoteVideo) ? preg_replace('%\{[a-z0-9-_]*\}(.*)\{/[a-z0-9-_]*\}%i', '\1', $item->video) : '';
		$lists['remoteVideoType'] = ($remoteVideo) ? preg_replace('%\{([a-z0-9-_]*)\}.*\{/[a-z0-9-_]*\}%i', '\1', $item->video) : '';
		$lists['providerVideo'] = ($providerVideo) ? preg_replace('%\{[a-z0-9-_]*\}(.*)\{/[a-z0-9-_]*\}%i', '\1', $item->video) : '';
		$lists['providerVideoType'] = ($providerVideo) ? preg_replace('%\{([a-z0-9-_]*)\}.*\{/[a-z0-9-_]*\}%i', '\1', $item->video) : '';
		$lists['embedVideo'] = ($embedVideo)?$item->video:'';

		if (count($providers)) {
			$lists['providers'] = JHTML::_('select.genericlist', $providersOptions, 'videoProvider', '', 'value', 'text', $lists['providerVideoType']);
		}

		JPluginHelper::importPlugin('content', 'jw_sigpro');
		JPluginHelper::importPlugin('content', 'jw_sig');
		JPluginHelper::importPlugin('content', 'jw_allvideos');
		$dispatcher = &JDispatcher::getInstance();

		$params->set('galleries_rootfolder', 'media/k2/galleries');
		$params->set('thb_width', '150');
		$params->set('thb_height', '120');
		$params->set('popup_engine', 'mootools_slimbox');
		$params->set('enabledownload', '0');
		$item->text = $item->gallery;
		$dispatcher->trigger('onPrepareContent', array(&$item, &$params, null));
		$item->gallery = $item->text;

		if(!$embedVideo){
			$params->set('vfolder', 'media/k2/videos');
			if(JString::strpos($item->video, 'remote}')){
				preg_match("#}(.*?){/#s",$item->video, $matches);
				if(!JString::strpos($matches[1], 'http://}')){
					$item->video = str_replace($matches[1], JURI::root().$matches[1], $item->video);
				}
			}
			$item->text = $item->video;
			$dispatcher->trigger('onPrepareContent', array(&$item, &$params, null));
			$item->video = $item->text;
		} else {
			// do nothing
		}

		if (isset($item->created_by)) {
			$author = &JUser::getInstance($item->created_by);
			$item->author = $author->name;
		}
		if (isset($item->modified_by)) {
			$moderator = &JUser::getInstance($item->modified_by);
			$item->moderator = $moderator->name;
		}

		if ($task == 'edit')
		$item->editor = $item->author;
		else
		$item->editor = $user->name;


		require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'categories.php');
		$categoriesModel = new K2ModelCategories;
		$categories_option[] = JHTML::_('select.option', 0, '- '.JText::_('Select category').' -');
		$categories = $categoriesModel->categoriesTree();

		if (($task == 'add' || $task =='edit') && !$user->authorize('com_k2', 'add', 'category', 'all')) {

			for ($i = 0; $i < sizeof($categories); $i++) {
				if (!$user->authorize('com_k2', 'add', 'category', $categories[$i]->value))
				$categories[$i]->disable = true;
			}
		}

		$categories_options = @array_merge($categories_option, $categories);

		$lists['categories'] = JHTML::_('select.genericlist', $categories_options, 'catid', '', 'value', 'text', $item->catid);

		JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
		$category = &JTable::getInstance('K2Category', 'Table');
		$category->load($item->catid);

		require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'extrafield.php');
		$extraFieldModel = new K2ModelExtraField;

		if ($category->extraFieldsGroup)
		$extraFields = $extraFieldModel->getExtraFieldsByGroup($category->extraFieldsGroup);
		else
		$extraFields = NULL;

		for ($i = 0; $i < sizeof($extraFields); $i++) {
			$extraFields[$i]->element = $extraFieldModel->renderExtraField($extraFields[$i], $item->id);
		}


		if($item->id){
			$item->attachments=$model->getAttachments($item->id);
			$rating = $model->getRating();
			if(is_null($rating)){
				$item->ratingSum = 0;
				$item->ratingCount = 0;
			}
			else{
				$item->ratingSum = (int)$rating->rating_sum;
				$item->ratingCount = (int)$rating->rating_count;
			}
		}
		else {
			$item->attachments = NULL;
			$item->ratingSum = 0;
			$item->ratingCount = 0;
		}


		if($user->gid<24 && $params->get('lockTags'))
		$params->set('taggingSystem',0);

		$tags = $model->getAvailableTags($item->id);
		$lists['tags'] = JHTML::_('select.genericlist', $tags, 'tags', 'multiple="multiple" size="10" ', 'id', 'name');

		if (isset($item->id)) {
			$item->tags = $model->getCurrentTags($item->id);
			$lists['selectedTags'] = JHTML::_('select.genericlist', $item->tags, 'selectedTags[]', 'multiple="multiple" size="10" ', 'id', 'name');
		} else {
			$lists['selectedTags'] = '<select size="10" multiple="multiple" id="selectedTags" name="selectedTags[]"></select>';
		}

		if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_L.jpg'))
		$item->image = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_L.jpg';

		if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->id).'_S.jpg'))
		$item->thumb = JURI::root().'media/k2/items/cache/'.md5("Image".$item->id).'_S.jpg';

		$lists['metadata'] = new JParameter($item->metadata);

		JPluginHelper::importPlugin('k2');
		$dispatcher = &JDispatcher::getInstance();

		$K2PluginsItemContent = $dispatcher->trigger('onRenderAdminForm', array(&$item, 'item', 'content'));
		$this->assignRef('K2PluginsItemContent', $K2PluginsItemContent);

		$K2PluginsItemImage = $dispatcher->trigger('onRenderAdminForm', array(&$item, 'item', 'image'));
		$this->assignRef('K2PluginsItemImage', $K2PluginsItemImage);

		$K2PluginsItemGallery = $dispatcher->trigger('onRenderAdminForm', array(&$item, 'item', 'gallery'));
		$this->assignRef('K2PluginsItemGallery', $K2PluginsItemGallery);

		$K2PluginsItemVideo = $dispatcher->trigger('onRenderAdminForm', array(&$item, 'item', 'video'));
		$this->assignRef('K2PluginsItemVideo', $K2PluginsItemVideo);

		$K2PluginsItemExtraFields = $dispatcher->trigger('onRenderAdminForm', array(&$item, 'item', 'extra-fields'));
		$this->assignRef('K2PluginsItemExtraFields', $K2PluginsItemExtraFields);

		$K2PluginsItemAttachments = $dispatcher->trigger('onRenderAdminForm', array(&$item, 'item', 'attachments'));
		$this->assignRef('K2PluginsItemAttachments', $K2PluginsItemAttachments);

		$K2PluginsItemOther = $dispatcher->trigger('onRenderAdminForm', array(&$item, 'item', 'other'));
		$this->assignRef('K2PluginsItemOther', $K2PluginsItemOther);

		$form = new JParameter('', JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'item.xml');
		$form->loadINI($item->params);
		$this->assignRef('form', $form);

		$this->assignRef('extraFields', $extraFields);
		$this->assignRef('options', $options);
		$this->assignRef('row', $item);
		$this->assignRef('lists', $lists);
		$this->assignRef('params', $params);
		$this->assignRef('user', $user);

		parent::display();
	}

}
