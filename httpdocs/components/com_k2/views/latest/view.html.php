<?php
/**
 * @version		$Id: view.html.php 495 2010-06-17 15:06:47Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewLatest extends JView {

	function display($tpl = null) {
		$mainframe = &JFactory::getApplication();
		$params = &JComponentHelper::getParams('com_k2');
		$user = &JFactory::getUser();
		$cache = &JFactory::getCache('com_k2_extended');
		$limit = $params->get('latestItemsLimit',3);
		$limitstart = JRequest::getInt('limitstart');
		$model = &$this->getModel('itemlist');
		$itemModel = &$this->getModel('item');

		if($params->get('source')){
			$categoryIDs = $params->get('categoryIDs');
			if(is_string($categoryIDs) && !empty($categoryIDs)){
				$categoryIDs = array();
				$categoryIDs[]=$params->get('categoryIDs');
			}
			$categories = array();
			JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
			if(is_array($categoryIDs)){
				foreach($categoryIDs as $categoryID){
					$category = & JTable::getInstance('K2Category', 'Table');
					$category->load($categoryID);
					if ($category->published && ($category->access <= $user->get('aid', 0))) {

						//Merge params
						$cparams = new JParameter($category->params);
						if ($cparams->get('inheritFrom')) {
						    $masterCategory = &JTable::getInstance('K2Category', 'Table');
						    $masterCategory->load($cparams->get('inheritFrom'));
						    $cparams = new JParameter($masterCategory->params);
						}
						$params->merge($cparams);

						//Category image
						if (! empty($category->image)) {
						    $category->image = JURI::root().'media/k2/categories/'.$category->image;
						} else {
						    if ($params->get('catImageDefault')) {
						        $category->image = JURI::root().'components/com_k2/images/placeholder/category.png';
						    }
						}

						//Category plugins
						$dispatcher = &JDispatcher::getInstance();
						JPluginHelper::importPlugin('content');
						$category->text = $category->description;
						$dispatcher->trigger('onPrepareContent', array ( & $category, &$params, $limitstart));
						$category->description = $category->text;

						//Category K2 plugins
						$category->event->K2CategoryDisplay = '';
						JPluginHelper::importPlugin('k2');
						$results = $dispatcher->trigger('onK2CategoryDisplay', array(&$category, &$params, $limitstart));
						$category->event->K2CategoryDisplay = trim(implode("\n", $results));
						$category->text = $category->description;
						$dispatcher->trigger('onK2PrepareContent', array ( & $category, &$params, $limitstart));
						$category->description = $category->text;

						//Category link
						$link = urldecode(K2HelperRoute::getCategoryRoute($category->id.':'.urlencode($category->alias)));
						$category->link = JRoute::_($link);
						$category->feed = JRoute::_($link.'&format=feed');

						JRequest::setVar('view', 'itemlist');
						JRequest::setVar('task', 'category');
						JRequest::setVar('id', $category->id);
						JRequest::setVar('featured', 1);
						JRequest::setVar('limit', $limit);
						JRequest::setVar('clearFlag', true);

						$category->name = htmlspecialchars($category->name, ENT_QUOTES);
						$category->items = $model->getData('rdate');


						JRequest::setVar('view', 'latest');
						JRequest::setVar('task', '');

						for ($i = 0; $i < sizeof($category->items); $i++) {

							if ($user->guest){
								$hits = $category->items[$i]->hits;
								$category->items[$i]->hits = 0;
								$category->items[$i] = $cache->call(array('K2ModelItem', 'prepareItem'), $category->items[$i], 'latest', '');
								$category->items[$i]->hits = $hits;
							}
							else {
								$category->items[$i] = $itemModel->prepareItem($category->items[$i], 'latest', '');
							}

							$category->items[$i] = $itemModel->execPlugins($category->items[$i], 'latest', '');
							
							//Trigger comments counter event
        					$dispatcher = &JDispatcher::getInstance();
							JPluginHelper::importPlugin ('k2');
							$results = $dispatcher->trigger('onK2CommentsCounter', array ( & $category->items[$i], &$params, $limitstart));
							$category->items[$i]->event->K2CommentsCounter = trim(implode("\n", $results));

						}
						$categories[]=$category;
					}


				}
			}
			$source = 'categories';
			$this->assignRef('blocks', $categories);

		} else {
			$usersIDs = $params->get('userIDs');
			if(is_string($usersIDs) && !empty($usersIDs)){
				$usersIDs = array();
				$usersIDs[]=$params->get('userIDs');
			}

			$users = array();
			if(is_array($usersIDs)){
				foreach($usersIDs as $userID){

					$userObject = JFactory::getUser($userID);
					if (!$userObject->block) {

						//User profile
						$userObject->profile = $model->getUserProfile($userID);

						//User image
						$userObject->avatar = K2HelperUtilities::getAvatar($userObject->id, $userObject->email, $params->get('userImageWidth'));

						//User K2 plugins
						$userObject->event->K2UserDisplay = '';
						if (is_object($userObject->profile) && $userObject->profile->id > 0) {

							$dispatcher = &JDispatcher::getInstance();
							JPluginHelper::importPlugin('k2');
							$results = $dispatcher->trigger('onK2UserDisplay', array(&$userObject->profile, &$params, $limitstart));
							$userObject->event->K2UserDisplay = trim(implode("\n", $results));

						}
						$link = K2HelperRoute::getUserRoute($userObject->id);
						$userObject->link = JRoute::_($link);
						$userObject->feed = JRoute::_($link.'&format=feed');
						$userObject->name = htmlspecialchars($userObject->name, ENT_QUOTES);
						$userObject->items = $model->getAuthorLatest(0,$limit,$userID);

						for ($i = 0; $i < sizeof($userObject->items); $i++) {

							if ($user->guest){
								$hits = $userObject->items[$i]->hits;
								$userObject->items[$i]->hits = 0;
								$userObject->items[$i] = $cache->call(array('K2ModelItem', 'prepareItem'), $userObject->items[$i], 'latest', '');
								$userObject->items[$i]->hits = $hits;
							}
							else {
								$userObject->items[$i] = $itemModel->prepareItem($userObject->items[$i], 'latest', '');
							}

							//Plugins
							$userObject->items[$i] = $itemModel->execPlugins($userObject->items[$i], 'latest', '');
							
							
							//Trigger comments counter event
        					$dispatcher = &JDispatcher::getInstance();
							JPluginHelper::importPlugin ('k2');
							$results = $dispatcher->trigger('onK2CommentsCounter', array ( & $userObject->items[$i], &$params, $limitstart));
							$userObject->items[$i]->event->K2CommentsCounter = trim(implode("\n", $results));
							

						}

						$users[]=$userObject;
					}

				}
			}
			$source = 'users';
			$this->assignRef('blocks', $users);
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

		//Assign params
		$this->assignRef('params', $params);
		$this->assignRef('source', $source);

		//Set layout
		$this->setLayout('latest');

		//Display
		parent::display($tpl);
	}

}
