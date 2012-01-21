<?php
/**
 * @version		$Id: view.feed.php 531 2010-08-04 10:01:26Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewItemlist extends JView {

    function display($tpl = null) {

        $mainframe = &JFactory::getApplication();
        $params = &JComponentHelper::getParams('com_k2');
        $document = &JFactory::getDocument();
        $model = &$this->getModel('itemlist');
        $limitstart = JRequest::getInt('limitstart');

        $moduleID = JRequest::getInt('moduleID');
        if ($moduleID) {

            $result = $model->getModuleItems($moduleID);
            $items = $result->items;
            $title = $result->title;

        }
        else {

            //Get data depending on task
            $task = JRequest::getCmd('task');
            switch ($task) {

                case 'category':
                    //Get category
                    $id = JRequest::getInt('id');
                    JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');
                    $category = &JTable::getInstance('K2Category', 'Table');
                    $category->load($id);

                    //Access check
                    $user = &JFactory::getUser();
                    if ($category->access > $user->get('aid', 0)) {
                        JError::raiseError(403, JText::_("ALERTNOTAUTH"));
                    }
                    if (!$category->published || $category->trash) {
                        JError::raiseError(404, JText::_("Category not found"));
                    }

                    //Merge params
                    $cparams = new JParameter($category->params);
                    if ($cparams->get('inheritFrom')) {
                        $masterCategory = &JTable::getInstance('K2Category', 'Table');
                        $masterCategory->load($cparams->get('inheritFrom'));
                        $cparams = new JParameter($masterCategory->params);
                    }
                    $params->merge($cparams);

                    //Category link
                    $category->link = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($category->id.':'.urlencode($category->alias))));

                    //Set featured flag
                    JRequest::setVar('featured', $params->get('catFeaturedItems'));

                    //Set title
                    $title = $category->name;
                    break;

                case 'user':
                    //Get user
                    $id = JRequest::getInt('id');
                    $user = &JFactory::getUser($id);

                    //Check user status
                    if ($user->block) {
                        JError::raiseError(404, JText::_('User not found'));
                    }

                    //Set title
                    $title = $user->name;

                    break;

                case 'tag':
                    //set title
                    $title = JText::_('Displaying items by tag:').' '.JRequest::getVar('tag');
                    if(JRequest::getCmd('type')!='atom'){
                    	$title = JFilterOutput::ampReplace($title);
                    }
                    break;

                case 'search':
                    //Set title
                    $title = JText::_('Search results for:').' '.JRequest::getVar('searchword');
                    break;

                case 'date':
                    //Set title
                    if (JRequest::getInt('day')) {
                        $date = strtotime(JRequest::getInt('year').'-'.JRequest::getInt('month').'-'.JRequest::getInt('day'));
                        $title = JText::_('Items filtered by date:').' '.JHTML::_('date', $date, '%A, %d %B %Y');
                    } else {
                        $date = strtotime(JRequest::getInt('year').'-'.JRequest::getInt('month'));
                        $title = JText::_('Items filtered by date:').' '.JHTML::_('date', $date, '%B %Y');
                    }
                    break;

                default:

                    //Set featured flag
                    JRequest::setVar('featured', $params->get('catFeaturedItems'));

                    //Set title
                    $title = $params->get('page_title');

                    break;

            }

            //Get ordering
	        if($task=='tag')
	        	$ordering = $params->get('tagOrdering');
	        else
	        	$ordering = $params->get('catOrdering');

            //Get items
            $items = $model->getData($ordering);


        }

        //Prepare feed items
        $model = &$this->getModel('item');
        foreach ($items as $item) {

            $item = $model->prepareFeedItem($item);
            $item->title = $this->escape($item->title);
            $item->title = html_entity_decode($item->title);
            $feedItem = new JFeedItem();
            $feedItem->title = $item->title;
            $feedItem->link = $item->link;
            $feedItem->description = $item->description;
            $feedItem->date = $item->created;
            $feedItem->category = $item->category->name;
            $feedItem->author = $item->author->name;

            //Add item
            $document->addItem($feedItem);
        }

        //Set title
        $document = &JFactory::getDocument();
        $menus = &JSite::getMenu();
        $menu = $menus->getActive();
        if (is_object($menu)) {
            $menu_params = new JParameter($menu->params);
            if (!$menu_params->get('page_title'))
                $params->set('page_title', $title);
        } else {
            $params->set('page_title', $title);
        }
        $document->setTitle($params->get('page_title'));

    }

}
