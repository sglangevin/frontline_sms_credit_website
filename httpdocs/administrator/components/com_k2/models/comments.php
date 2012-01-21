<?php
/**
 * @version		$Id: comments.php 551 2010-09-06 11:57:40Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelComments extends JModel {

    function getData() {

        $mainframe = &JFactory::getApplication();
        $option = JRequest::getCmd('option');
        $view = JRequest::getCmd('view');
        $db = &JFactory::getDBO();
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
        $filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', 'c.id', 'cmd');
        $filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', 'DESC', 'word');
        $filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
        $filter_category = $mainframe->getUserStateFromRequest($option.$view.'filter_category', 'filter_category', 0, 'int');
        $filter_author = $mainframe->getUserStateFromRequest($option.$view.'filter_author', 'filter_author', 0, 'int');
        $search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
        $search = JString::strtolower($search);

        $query = "SELECT c.*, i.title , i.catid,  i.alias AS itemAlias, i.created_by,  cat.alias AS catAlias, cat.name as catName FROM #__k2_comments AS c LEFT JOIN #__k2_items AS i ON c.itemID=i.id LEFT JOIN #__k2_categories AS cat ON cat.id=i.catid WHERE c.id>0";

        if ($filter_state > - 1) {
            $query .= " AND c.published={$filter_state}";
        }

        if ($filter_category) {
            $query .= " AND i.catid={$filter_category}";
        }

        if ($filter_author) {
            $query .= " AND i.created_by={$filter_author}";
        }

        if ($search) {
            $query .= " AND LOWER( c.commentText ) LIKE ".$db->Quote('%'.$db->getEscaped($search, true).'%', false);
        }

        if (!$filter_order) {
            $filter_order = "c.commentDate";
        }

        $query .= " ORDER BY {$filter_order} {$filter_order_Dir}";
        $db->setQuery($query, $limitstart, $limit);
        $rows = $db->loadObjectList();
        return $rows;
    }

    function getTotal() {

        $mainframe = &JFactory::getApplication();
        $option = JRequest::getCmd('option');
        $view = JRequest::getCmd('view');
        $db = &JFactory::getDBO();
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
        $filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', 1, 'int');
        $filter_category = $mainframe->getUserStateFromRequest($option.$view.'filter_category', 'filter_category', 0, 'int');
        $filter_author = $mainframe->getUserStateFromRequest($option.$view.'filter_author', 'filter_author', 0, 'int');
        $search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
        $search = JString::strtolower($search);

        $query = "SELECT COUNT(*) FROM #__k2_comments AS c LEFT JOIN #__k2_items AS i ON c.itemID=i.id WHERE c.id>0";

        if ($filter_state > - 1) {
            $query .= " AND c.published={$filter_state}";
        }

        if ($filter_category) {
            $query .= " AND i.catid={$filter_category}";
        }

        if ($filter_author) {
            $query .= " AND i.created_by={$filter_author}";
        }

        if ($search) {
            $query .= " AND LOWER( c.commentText ) LIKE ".$db->Quote('%'.$db->getEscaped($search, true).'%', false);
        }

        $db->setQuery($query);
        $total = $db->loadresult();
        return $total;
    }

    function publish() {

        $mainframe = &JFactory::getApplication();
        $cid = JRequest::getVar('cid');
        $row = &JTable::getInstance('K2Comment', 'Table');
        foreach ($cid as $id) {
            $row->load($id);
            $row->publish($id, 1);
        }
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $mainframe->redirect('index.php?option=com_k2&view=comments');
    }

    function unpublish() {

        $mainframe = &JFactory::getApplication();
        $cid = JRequest::getVar('cid');
        $row = &JTable::getInstance('K2Comment', 'Table');
        foreach ($cid as $id) {
            $row->load($id);
            $row->publish($id, 0);
        }
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $mainframe->redirect('index.php?option=com_k2&view=comments');
    }

    function remove() {

        $mainframe = &JFactory::getApplication();
        $db = &JFactory::getDBO();
        $cid = JRequest::getVar('cid');
        $row = &JTable::getInstance('K2Comment', 'Table');
        foreach ($cid as $id) {
            $row->load($id);
            $row->delete($id);
        }
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $mainframe->redirect('index.php?option=com_k2&view=comments', JText::_('Delete completed'));
    }

    function deleteUnpublished() {

        $mainframe = &JFactory::getApplication();
        $db = &JFactory::getDBO();
        $query = "DELETE FROM #__k2_comments WHERE published=0";
        $db->setQuery($query);
        $db->query();
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $mainframe->redirect('index.php?option=com_k2&view=comments', JText::_('Delete completed'));
    }

    function save() {

        $mainframe = &JFactory::getApplication();
        $db = &JFactory::getDBO();
        $id = JRequest::getInt('commentID');
        $row = &JTable::getInstance('K2Comment', 'Table');
        $row->load($id);
        $row->commentText = JRequest::getVar('commentText', '', 'default', 'string', 4);
		$row->store();
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $response = new JObject;
        $response->comment = $row->commentText;
        $response->message = JText::_('Comment saved');
        unset($response->_errors);
        require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'JSON.php');
        $json = new Services_JSON;
       	echo $json->encode($response);
        $mainframe->close();
    }

}
