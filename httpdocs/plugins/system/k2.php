<?php
/**
 * @version		$Id: k2.php 532 2010-08-04 10:14:55Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemK2 extends JPlugin {

	function plgSystemK2(&$subject, $config) {

		parent::__construct($subject, $config);
	}

	function onAfterRoute() {

		$mainframe = &JFactory::getApplication();
		if ($mainframe->isAdmin()) {
			return;
		}
		JHTML::_('behavior.mootools');
		JHTML::_('behavior.modal');
		$params = &JComponentHelper::getParams('com_k2');

		// Add related Javascript to the <head>
		$document = &JFactory::getDocument();
		$js = "var K2RatingURL = '".JURI::root()."';";
		$document->addScriptDeclaration($js);
		$document->addScript(JURI::root().'components/com_k2/js/k2.js');

		if(JRequest::getCmd('task')=='search' && $params->get('googleSearch')){
			$language = &JFactory::getLanguage();
			$lang = $language->getTag();
			$document->addScript('http://www.google.com/jsapi');
			$js = '
			//<![CDATA[
			google.load("search", "1", {"language" : "'.$lang.'"});

			function OnLoad(){
				var searchControl = new google.search.SearchControl();
				var siteSearch = new google.search.WebSearch();
				siteSearch.setUserDefinedLabel("'.$mainframe->getCfg('sitename').'");
				siteSearch.setUserDefinedClassSuffix("k2");
				options = new google.search.SearcherOptions();
				options.setExpandMode(google.search.SearchControl.EXPAND_MODE_OPEN);
				siteSearch.setSiteRestriction("'.JURI::root().'");
				searchControl.addSearcher(siteSearch, options);
				searchControl.setResultSetSize(google.search.Search.LARGE_RESULTSET);
				searchControl.setLinkTarget(google.search.Search.LINK_TARGET_SELF);
				searchControl.draw(document.getElementById("'.$params->get('googleSearchContainer', 'k2Container').'"));
				searchControl.execute("'.JRequest::getString('searchword').'");
			}
			
			google.setOnLoadCallback(OnLoad);
			//]]>
       ';
			$document->addScriptDeclaration($js);
		}

		// Add related CSS to the <head>
		if ($document->getType() == 'html' && $params->get('enable_css')) {
			jimport('joomla.filesystem.file');
			// k2.css
			if(JFile::exists(JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'css'.DS.'k2.css'))
				$document->addStyleSheet(JURI::root().'templates/'.$mainframe->getTemplate().'/css/k2.css');
			else
				$document->addStyleSheet(JURI::root().'components/com_k2/css/k2.css');
		}

	}

	// Extend user forms with K2 fields
	function onAfterDispatch() {

		$mainframe = &JFactory::getApplication();

		if($mainframe->isAdmin()) return;

		JPlugin::loadLanguage('com_k2');
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('K2UserProfile'))
		return;
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$task = JRequest::getCmd('task');
		$layout = JRequest::getCmd('layout');
		$user = &JFactory::getUser();

		if ($option == 'com_user' && $view == 'register') {

			if(!$user->guest){
				$mainframe->redirect(JURI::root(),JText::_('You are already registered as a member.'),'notice');
				$mainframe->close();
			}
			require_once (JPATH_SITE.DS.'components'.DS.'com_user'.DS.'controller.php');
			$controller = new UserController;
			$view = $controller->getView('register', 'html');
			$view->_addPath('template', JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'templates');
			$view->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates');
			$view->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2');
			$view->setLayout('register');

			$K2User = new JObject;

			$K2User->description = '';
			$K2User->gender = 'm';
			$K2User->image = '';
			$K2User->url = '';
			$K2User->plugins = '';

			$wysiwyg = &JFactory::getEditor();
			$editor = $wysiwyg->display('description', $K2User->description, '100%', '250', '40', '5', false);
			$view->assignRef('editor', $editor);

			$lists = array();
			$genderOptions[] = JHTML::_('select.option', 'm', JText::_('Male'));
			$genderOptions[] = JHTML::_('select.option', 'f', JText::_('Female'));
			$lists['gender'] = JHTML::_('select.radiolist', $genderOptions, 'gender', '', 'value', 'text', $K2User->gender);

			$view->assignRef('lists', $lists);

			JPluginHelper::importPlugin('k2');
			$dispatcher = &JDispatcher::getInstance();
			$K2Plugins = $dispatcher->trigger('onRenderAdminForm', array(&$K2User, 'user'));
			$view->assignRef('K2Plugins', $K2Plugins);

			$view->assignRef('K2User', $K2User);

			$pathway = &$mainframe->getPathway();
			$pathway->setPathway(NULL);

			ob_start();
			$view->display();
			$contents = ob_get_clean();
			$document = &JFactory::getDocument();
			$document->setBuffer($contents, 'component');

		}

		if ($option == 'com_user' && $view == 'user' && ($task == 'edit' || $layout=='form')) {

			require_once (JPATH_SITE.DS.'components'.DS.'com_user'.DS.'controller.php');
			$controller = new UserController;
			$view = $controller->getView('user', 'html');
			$view->_addPath('template', JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'templates');
			$view->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates');
			$view->_addPath('template', JPATH_SITE.DS.'templates'.DS.$mainframe->getTemplate().DS.'html'.DS.'com_k2');
			$view->setLayout('profile');

			require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'itemlist.php');
			$model = new K2ModelItemlist;
			$K2User = $model->getUserProfile($user->id);
			if (!is_object($K2User)) {
				$K2User = new Jobject;
				$K2User->description = '';
				$K2User->gender = 'm';
				$K2User->url = '';
				$K2User->image = NULL;
			}
			$wysiwyg = &JFactory::getEditor();
			$editor = $wysiwyg->display('description', $K2User->description, '100%', '250', '40', '5', false);
			$view->assignRef('editor', $editor);

			$lists = array();
			$genderOptions[] = JHTML::_('select.option', 'm', JText::_('Male'));
			$genderOptions[] = JHTML::_('select.option', 'f', JText::_('Female'));
			$lists['gender'] = JHTML::_('select.radiolist', $genderOptions, 'gender', '', 'value', 'text', $K2User->gender);

			$view->assignRef('lists', $lists);

			JPluginHelper::importPlugin('k2');
			$dispatcher = &JDispatcher::getInstance();
			$K2Plugins = $dispatcher->trigger('onRenderAdminForm', array(&$K2User, 'user'));
			$view->assignRef('K2Plugins', $K2Plugins);

			$view->assignRef('K2User', $K2User);

			ob_start();
			$view->_displayForm();
			$contents = ob_get_clean();
			$document = &JFactory::getDocument();
			$document->setBuffer($contents, 'component');

		}

	}

	// For Joom!Fish
	function onAfterInitialise() {
		$mainframe = &JFactory::getApplication();

		/*
		if(JRequest::getCmd('option')=='com_k2' && JRequest::getCmd('task')=='save' && !$mainframe->isAdmin()){
			$dispatcher = &JDispatcher::getInstance();
			foreach($dispatcher->_observers as $observer){
				if($observer->_name=='jfdatabase' || $observer->_name=='jfrouter' || $observer->_name=='missing_translation'){
					$dispatcher->detach($observer);
				}
			}
		}
		*/

		jimport('joomla.filesystem.file');

		if (!$mainframe->isAdmin()) {
			return;
		}

		$option = JRequest::getCmd('option');
		$task = JRequest::getCmd('task');
		$type = JRequest::getCmd('catid');

		if ($option!='com_joomfish')
			return;

		if (!JFile::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'JSON.php')) {
			return;
		}

		JPlugin::loadLanguage('com_k2', JPATH_ADMINISTRATOR);

		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'JSON.php');

		if ($option == 'com_joomfish' && ($task == 'translate.apply' || $task == 'translate.save') && $type == 'k2_items') {

			$language_id = JRequest::getInt('select_language_id');
			$reference_id = JRequest::getInt('reference_id');
			$objects = array();
			$variables = JRequest::get('post');

			foreach ($variables as $key=>$value) {
				if (( bool )JString::stristr($key, 'K2ExtraField_')) {
					$object = new JObject;
					$object->set('id', JString::substr($key, 13));
					$object->set('value', $value);
					unset($object->_errors);
					$objects[] = $object;
				}
			}

			$json = new Services_JSON;
			$extra_fields = $json->encode($objects);

			$extra_fields_search = '';

			foreach ($objects as $object) {
				$extra_fields_search .= $this->getSearchValue($object->id, $object->value);
				$extra_fields_search .= ' ';
			}

			$user = &JFactory::getUser();

			$db = &JFactory::getDBO();

			$query = "SELECT COUNT(*) FROM #__jf_content WHERE reference_field = 'extra_fields' AND language_id = {$language_id} AND reference_id = {$reference_id} AND reference_table='k2_items'";
			$db->setQuery($query);
			$result = $db->loadResult();

			if ($result > 0) {
				$query = "UPDATE #__jf_content SET value=".$db->Quote($extra_fields)." WHERE reference_field = 'extra_fields' AND language_id = {$language_id} AND reference_id = {$reference_id} AND reference_table='k2_items'";
				$db->setQuery($query);
				$db->query();
			} else {
				$modified = date("Y-m-d H:i:s");
				$modified_by = $user->id;
				$published = JRequest::getVar('published', 0);
				$query = "INSERT INTO #__jf_content (`id`, `language_id`, `reference_id`, `reference_table`, `reference_field` ,`value`, `original_value`, `original_text`, `modified`, `modified_by`, `published`) VALUES (NULL, {$language_id}, {$reference_id}, 'k2_items', 'extra_fields', ".$db->Quote($extra_fields).", '','', ".$db->Quote($modified).", {$modified_by}, {$published} )";
				$db->setQuery($query);
				$db->query();
			}

			$query = "SELECT COUNT(*) FROM #__jf_content WHERE reference_field = 'extra_fields_search' AND language_id = {$language_id} AND reference_id = {$reference_id} AND reference_table='k2_items'";
			$db->setQuery($query);
			$result = $db->loadResult();

			if ($result > 0) {
				$query = "UPDATE #__jf_content SET value=".$db->Quote($extra_fields_search)." WHERE reference_field = 'extra_fields_search' AND language_id = {$language_id} AND reference_id = {$reference_id} AND reference_table='k2_items'";
				$db->setQuery($query);
				$db->query();
			} else {
				$modified = date("Y-m-d H:i:s");
				$modified_by = $user->id;
				$published = JRequest::getVar('published', 0);
				$query = "INSERT INTO #__jf_content (`id`, `language_id`, `reference_id`, `reference_table`, `reference_field` ,`value`, `original_value`, `original_text`, `modified`, `modified_by`, `published`) VALUES (NULL, {$language_id}, {$reference_id}, 'k2_items', 'extra_fields_search', ".$db->Quote($extra_fields_search).", '','', ".$db->Quote($modified).", {$modified_by}, {$published} )";
				$db->setQuery($query);
				$db->query();
			}

		}

		if ($option == 'com_joomfish' && ($task == 'translate.edit' || $task == 'translate.apply') && $type == 'k2_items') {

			if ($task == 'translate.edit') {
				$cid = JRequest::getVar('cid');
				$array = explode('|', $cid[0]);
				$reference_id = $array[1];
			}

			if ($task == 'translate.apply') {
				$reference_id = JRequest::getInt('reference_id');
			}

			$item = &JTable::getInstance('K2Item', 'Table');
			$item->load($reference_id);
			$category_id = $item->catid;
			$language_id = JRequest::getInt('select_language_id');

			$category = &JTable::getInstance('K2Category', 'Table');
			$category->load($category_id);
			$group = $category->extraFieldsGroup;
			$db = &JFactory::getDBO();
			$query = "SELECT * FROM #__k2_extra_fields WHERE `group`=".$db->Quote($group)." AND published=1 ORDER BY ordering";
			$db->setQuery($query);
			$extraFields = $db->loadObjectList();

			$json = new Services_JSON;
			$output = '';
			if (count($extraFields)) {
				$output .= '<h1>'.JText::_('K2 Extra fields').'</h1>';
				$output .= '<h2>'.JText::_('Original').'</h2>';
				foreach ($extraFields as $extrafield) {
					$extraField = $json->decode($extrafield->value);
					$output .= trim($this->renderOriginal($extrafield, $reference_id));

				}
			}

			if (count($extraFields)) {
				$output .= '<h2>'.JText::_('Translation').'</h2>';
				foreach ($extraFields as $extrafield) {
					$extraField = $json->decode($extrafield->value);
					$output .= trim($this->renderTranslated($extrafield, $reference_id));
				}
			}

			$pattern = '/\r\n|\r|\n/';
			$js = "
			window.addEvent('domready', function(){
				var target = $$('table.adminform');
				target.setProperty('id', 'adminform');
				var div = new Element('div', {'id': 'K2ExtraFields'}).setHTML('".preg_replace($pattern, '', $output)."').injectInside($('adminform'));
			});
			";

			JHTML::_('behavior.mootools');
			$document = &JFactory::getDocument();
			$document->addScriptDeclaration($js);
			$document->addCustomTag('
			<style type="text/css" media="all">
				#K2ExtraFields { color:#000; font-size:11px; padding:6px 2px 4px 4px; text-align:left; }
				#K2ExtraFields h1 { font-size:16px; height:25px; }
				#K2ExtraFields h2 { font-size:14px; }
				#K2ExtraFields strong { font-style:italic; }
			</style>
			');
		}

		if ($option == 'com_joomfish' && ($task == 'translate.apply' || $task == 'translate.save') && $type == 'k2_extra_fields') {

			$language_id = JRequest::getInt('select_language_id');
			$reference_id = JRequest::getInt('reference_id');
			$extraFieldType = JRequest::getVar('extraFieldType');

			$objects = array();
			$values = JRequest::getVar('option_value');
			$names = JRequest::getVar('option_name');
			$target = JRequest::getVar('option_target');

			for ($i = 0; $i < sizeof($values); $i++) {
				$object = new JObject;
				$object->set('name', $names[$i]);

				if ($extraFieldType == 'select' || $extraFieldType == 'multipleSelect' || $extraFieldType == 'radio') {
					$object->set('value', $i + 1);
				} elseif ($extraFieldType == 'link') {
					if (substr($values[$i], 0, 7) == 'http://') {
						$values[$i] = $values[$i];
					} else {
						$values[$i] = 'http://'.$values[$i];
					}
					$object->set('value', $values[$i]);
				} else {
					$object->set('value', $values[$i]);
				}

				$object->set('target', $target[$i]);
				unset($object->_errors);
				$objects[] = $object;
			}

			$json = new Services_JSON;
			$value = $json->encode($objects);

			$user = &JFactory::getUser();

			$db = &JFactory::getDBO();

			$query = "SELECT COUNT(*) FROM #__jf_content WHERE reference_field = 'value' AND language_id = {$language_id} AND reference_id = {$reference_id} AND reference_table='k2_extra_fields'";
			$db->setQuery($query);
			$result = $db->loadResult();

			if ($result > 0) {
				$query = "UPDATE #__jf_content SET value=".$db->Quote($value)." WHERE reference_field = 'value' AND language_id = {$language_id} AND reference_id = {$reference_id} AND reference_table='k2_extra_fields'";
				$db->setQuery($query);
				$db->query();
			} else {
				$modified = date("Y-m-d H:i:s");
				$modified_by = $user->id;
				$published = JRequest::getVar('published', 0);
				$query = "INSERT INTO #__jf_content (`id`, `language_id`, `reference_id`, `reference_table`, `reference_field` ,`value`, `original_value`, `original_text`, `modified`, `modified_by`, `published`) VALUES (NULL, {$language_id}, {$reference_id}, 'k2_extra_fields', 'value', ".$db->Quote($value).", '','', ".$db->Quote($modified).", {$modified_by}, {$published} )";
				$db->setQuery($query);
				$db->query();
			}

		}

		if ($option == 'com_joomfish' && ($task == 'translate.edit' || $task == 'translate.apply') && $type == 'k2_extra_fields') {

			if ($task == 'translate.edit') {
				$cid = JRequest::getVar('cid');
				$array = explode('|', $cid[0]);
				$reference_id = $array[1];
			}

			if ($task == 'translate.apply') {
				$reference_id = JRequest::getInt('reference_id');
			}

			$extraField = &JTable::getInstance('K2ExtraField', 'Table');
			$extraField->load($reference_id);
			$language_id = JRequest::getInt('select_language_id');

			if ($extraField->type == 'multipleSelect' || $extraField->type == 'select' || $extraField->type == 'radio') {
				$subheader = '<strong>'.JText::_('Options').'</strong>';
			} else {
				$subheader = '<strong>'.JText::_('Default value').'</strong>';
			}

			$json = new Services_JSON;
			$objects = $json->decode($extraField->value);
			$output = '<input type="hidden" value="'.$extraField->type.'" name="extraFieldType" />';
			if (count($objects)) {
				$output .= '<h1>'.JText::_('K2 Extra fields').'</h1>';
				$output .= '<h2>'.JText::_('Original').'</h2>';
				$output .= $subheader.'<br />';

				foreach ($objects as $object) {
					$output .= '<p>'.$object->name.'</p>';
					if ($extraField->type == 'textfield' || $extraField->type == 'textarea')
					$output .= '<p>'.$object->value.'</p>';
				}
			}

			$db = &JFactory::getDBO();
			$query = "SELECT `value` FROM #__jf_content WHERE reference_field = 'value' AND language_id = {$language_id} AND reference_id = {$reference_id} AND reference_table='k2_extra_fields'";
			$db->setQuery($query);
			$result = $db->loadResult();

			$translatedObjects = $json->decode($result);

			if (count($objects)) {
				$output .= '<h2>'.JText::_('Translation').'</h2>';
				$output .= $subheader.'<br />';
				foreach ($objects as $key=>$value) {
					if (isset($translatedObjects[$key]))
					$value = $translatedObjects[$key];

					if ($extraField->type == 'textarea')
					$output .= '<p><textarea name="option_name[]" cols="30" rows="15"> '.$value->name.'</textarea></p>';
					else
					$output .= '<p><input type="text" name="option_name[]" value="'.$value->name.'" /></p>';
					$output .= '<p><input type="hidden" name="option_value[]" value="'.$value->value.'" /></p>';
					$output .= '<p><input type="hidden" name="option_target[]" value="'.$value->target.'" /></p>';
				}
			}

			$pattern = '/\r\n|\r|\n/';
			$js = "	window.addEvent('domready', function(){
						var target = $$('table.adminform');
						target.setProperty('id', 'adminform');
						var div = new Element('div', {'id': 'K2ExtraFields'}).setHTML('".preg_replace($pattern, '', $output)."').injectInside($('adminform'));
					})";

			JHTML::_('behavior.mootools');
			$document = &JFactory::getDocument();
			$document->addScriptDeclaration($js);
			$document->addStyleSheet(JURI::root().'/plugins/system/k2_joomfish/style.css');
		}

		if ($option == 'com_joomfish' && ($task == 'translate.edit' || $task == 'translate.apply') && $type == 'k2_users') {

			$js = "	window.addEvent('domready', function(){
						var value = $('original_value_userName').getText();
						$$('tr.row0').each(function(el) {
							el.setStyle('display', 'none');
						});
						$$('input[name=refField_userName]').setProperty('value', value.trim());
					})";

			JHTML::_('behavior.mootools');
			$document = &JFactory::getDocument();
			$document->addScriptDeclaration($js);

		}

		return;
	}

	function getSearchValue($id, $currentValue) {

		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		$row = &JTable::getInstance('K2ExtraField', 'Table');
		$row->load($id);

		require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'JSON.php');
		$json = new Services_JSON;
		$jsonObject = $json->decode($row->value);

		$value = '';
		if ($row->type == 'textfield' || $row->type == 'textarea') {
			$value = $currentValue;
		} else if ($row->type == 'multipleSelect' || $row->type == 'link') {
			foreach ($jsonObject as $option) {
				if (@in_array($option->value, $currentValue))
				$value .= $option->name.' ';
			}
		} else {
			foreach ($jsonObject as $option) {
				if ($option->value == $currentValue)
				$value .= $option->name;
			}
		}
		return $value;

	}

	function renderOriginal($extraField, $itemID) {

		$mainframe = &JFactory::getApplication();
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'JSON.php');
		$json = new Services_JSON;
		$item = &JTable::getInstance('K2Item', 'Table');
		$item->load($itemID);

		$defaultValues = $json->decode($extraField->value);

		foreach ($defaultValues as $value) {
			if ($extraField->type == 'textfield' || $extraField->type == 'textarea')
			$active = $value->value;
			else if ($extraField->type == 'link') {
				$active[0] = $value->name;
				$active[1] = $value->value;
				$active[2] = $value->target;
			} else
			$active = '';
		}

		if (isset($item)) {
			$currentValues = $json->decode($item->extra_fields);
			if (count($currentValues)) {
				foreach ($currentValues as $value) {
					if ($value->id == $extraField->id) {
						$active = $value->value;
					}

				}
			}

		}

		$output = '';

		switch ($extraField->type) {

			case 'textfield':
				$output = '<div><strong>'.$extraField->name.'</strong><br /><input type="text" disabled="disabled" name="OriginalK2ExtraField_'.$extraField->id.'" value="'.$active.'"/></div><br /><br />';
				break;

			case 'textarea':
				$output = '<div><strong>'.$extraField->name.'</strong><br /><textarea disabled="disabled" name="OriginalK2ExtraField_'.$extraField->id.'" rows="10" cols="40">'.$active.'</textarea></div><br /><br />';
				break;

			case 'link':
				$output = '<div><strong>'.$extraField->name.'</strong><br />';
				$output .= '&nbsp;<input disabled="disabled"  type="text" name="OriginalK2ExtraField_'.$extraField->id.'[]" value="'.$active[0].'"/><br />';
				$output .= '<br /><br /></div>';
				break;

		}

		return $output;

	}

	function renderTranslated($extraField, $itemID) {

		$mainframe = &JFactory::getApplication();
		require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'JSON.php');
		$json = new Services_JSON;

		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		$item = &JTable::getInstance('K2Item', 'Table');
		$item->load($itemID);

		$defaultValues = $json->decode($extraField->value);

		foreach ($defaultValues as $value) {
			if ($extraField->type == 'textfield' || $extraField->type == 'textarea')
			$active = $value->value;
			else if ($extraField->type == 'link') {
				$active[0] = $value->name;
				$active[1] = $value->value;
				$active[2] = $value->target;
			} else
			$active = '';
		}

		if (isset($item)) {
			$currentValues = $json->decode($item->extra_fields);
			if (count($currentValues)) {
				foreach ($currentValues as $value) {
					if ($value->id == $extraField->id) {
						$active = $value->value;
					}

				}
			}

		}

		$language_id = JRequest::getInt('select_language_id');
		$db = &JFactory::getDBO();
		$query = "SELECT `value` FROM #__jf_content WHERE reference_field = 'extra_fields' AND language_id = {$language_id} AND reference_id = {$itemID} AND reference_table='k2_items'";
		$db->setQuery($query);
		$result = $db->loadResult();
		$currentValues = $json->decode($result);
		if (count($currentValues)) {
			foreach ($currentValues as $value) {
				if ($value->id == $extraField->id) {
					$active = $value->value;
				}

			}
		}

		$output = '';

		switch ($extraField->type) {

			case 'textfield':
				$output = '<div><strong>'.$extraField->name.'</strong><br /><input type="text" name="K2ExtraField_'.$extraField->id.'" value="'.$active.'"/></div><br /><br />';
				break;

			case 'textarea':
				$output = '<div><strong>'.$extraField->name.'</strong><br /><textarea name="K2ExtraField_'.$extraField->id.'" rows="10" cols="40">'.$active.'</textarea></div><br /><br />';
				break;

			case 'select':
				$output = '<div style="display:none">'.JHTML::_('select.genericlist', $defaultValues, 'K2ExtraField_'.$extraField->id, '', 'value', 'name', $active).'</div>';
				break;

			case 'multipleSelect':
				$output = '<div style="display:none">'.JHTML::_('select.genericlist', $defaultValues, 'K2ExtraField_'.$extraField->id.'[]', 'multiple="multiple"', 'value', 'name', $active).'</div>';
				break;

			case 'radio':
				$output = '<div style="display:none">'.JHTML::_('select.radiolist', $defaultValues, 'K2ExtraField_'.$extraField->id, '', 'value', 'name', $active).'</div>';
				break;

			case 'link':
				$output = '<div><strong>'.$extraField->name.'</strong><br />';
				$output .= '<input type="text" name="K2ExtraField_'.$extraField->id.'[]" value="'.$active[0].'"/><br />';
				$output .= '<input type="hidden" name="K2ExtraField_'.$extraField->id.'[]" value="'.$active[1].'"/><br />';
				$output .= '<input type="hidden" name="K2ExtraField_'.$extraField->id.'[]" value="'.$active[2].'"/><br />';
				$output .= '<br /><br /></div>';
				break;
		}

		return $output;

	}

}
