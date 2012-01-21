<?php
/**
 * @version		$Id: comments.php 559 2010-09-22 12:01:36Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');

class K2ModelComments extends JModel {

    function getUserComments($userID) {
        $mainframe = &JFactory::getApplication();
        $db = &JFactory::getDBO();
        $option = JRequest::getCmd('option');
        $view = JRequest::getCmd('view');
        $limit = $mainframe->getUserStateFromRequest($option.$view.'.limit', 'limit', 10, 'int');
        $limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
        $filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', 'c.id', 'cmd');
        $filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', 'DESC', 'word');
        $filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
        $filter_category = $mainframe->getUserStateFromRequest($option.$view.'filter_category', 'filter_category', 0, 'int');
        $search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
        $search = JString::strtolower($search);
        $query = "SELECT c.*, i.title , i.catid,  i.alias AS itemAlias, cat.alias AS catAlias FROM #__k2_comments AS c
		LEFT JOIN #__k2_items AS i ON c.itemID=i.id
		LEFT JOIN #__k2_categories AS cat ON cat.id=i.catid
		WHERE i.created_by = {$userID}";

        if ($filter_category) {
            $query .= " AND i.catid={$filter_category}";
        }

        if ($filter_state > - 1) {
            $query .= " AND c.published={$filter_state}";
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


    function countUserComments($userID) {

        $mainframe = &JFactory::getApplication();
        $db = &JFactory::getDBO();
        $option = JRequest::getCmd('option');
        $view = JRequest::getCmd('view');


        $filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', 0, 'int');
        $filter_category = $mainframe->getUserStateFromRequest($option.$view.'filter_category', 'filter_category', 0, 'int');
        $search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
        $search = JString::strtolower($search);
        $query = "SELECT COUNT(*) FROM #__k2_comments AS c
		LEFT JOIN #__k2_items AS i ON c.itemID=i.id
		LEFT JOIN #__k2_categories AS cat ON cat.id=i.catid
		WHERE i.created_by = {$userID}";

        if ($filter_category) {
            $query .= " AND i.catid={$filter_category}";
        }


        if ($filter_state > - 1) {
            $query .= " AND c.published={$filter_state}";
        }

        if ($search) {
            $query .= " AND LOWER( c.commentText ) LIKE ".$db->Quote('%'.$db->getEscaped($search, true).'%', false);
        }

        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;


    }

    function publish() {

        $mainframe = &JFactory::getApplication();
        $cid = JRequest::getVar('cid');
		$user = &JFactory::getUser();
        $row = &JTable::getInstance('K2Comment', 'Table');
        $item = &JTable::getInstance('K2Item', 'Table');
        foreach ($cid as $id) {
            $row->load($id);
			$item->load($row->itemID);
	        if ($item->created_by != $user->id) {
	            JError::raiseError(403, JText::_("ALERTNOTAUTH"));
				$mainframe->close();
	        }
            $row->publish($id, 1);
        }
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $mainframe->redirect('index.php?option=com_k2&view=comments&tmpl=component');
    }

    function unpublish() {

        $mainframe = &JFactory::getApplication();
        $cid = JRequest::getVar('cid');
		$user = &JFactory::getUser();
        $row = &JTable::getInstance('K2Comment', 'Table');
        $item = &JTable::getInstance('K2Item', 'Table');
        foreach ($cid as $id) {
            $row->load($id);
			$item->load($row->itemID);
	        if ($item->created_by != $user->id) {
	            JError::raiseError(403, JText::_("ALERTNOTAUTH"));
				$mainframe->close();
	        }
            $row->publish($id, 0);
        }
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $mainframe->redirect('index.php?option=com_k2&view=comments&tmpl=component');
    }

    function remove() {

        $mainframe = &JFactory::getApplication();
        $db = &JFactory::getDBO();
        $cid = JRequest::getVar('cid');
		$user = &JFactory::getUser();
        $row = &JTable::getInstance('K2Comment', 'Table');
        $item = &JTable::getInstance('K2Item', 'Table');
        foreach ($cid as $id) {
            $row->load($id);
			$item->load($row->itemID);
	        if ($item->created_by != $user->id) {
	            JError::raiseError(403, JText::_("ALERTNOTAUTH"));
				$mainframe->close();
	        }
            $row->delete($id);
        }
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $mainframe->redirect('index.php?option=com_k2&view=comments&tmpl=component', JText::_('Delete Completed'));
    }

    function deleteUnpublished() {

        $mainframe = &JFactory::getApplication();
        $db = &JFactory::getDBO();
		$query = "SELECT c.id FROM #__k2_comments AS c
		LEFT JOIN #__k2_items AS i ON c.itemID=i.id
		WHERE i.created_by = {$userID} AND c.published=0";
		$db->setQuery($query);
        $ids = $db->loadResultArray();
		if (count($ids)){
			$query = "DELETE FROM #__k2_comments WHERE id IN(".implode(',', $ids).")";
	        $db->setQuery($query);
	        $db->query();
	        $cache = &JFactory::getCache('com_k2');
	        $cache->clean();
		}
        $mainframe->redirect('index.php?option=com_k2&view=comments&tmpl=component', JText::_('Delete Completed'));
    }


    function save() {

        $mainframe = &JFactory::getApplication();
        $db = &JFactory::getDBO();
        $id = JRequest::getInt('commentID');
        $row = &JTable::getInstance('K2Comment', 'Table');
        $row->load($id);
        $user = &JFactory::getUser();
        $item = &JTable::getInstance('K2Item', 'Table');
        $item->load($row->itemID);
        if ($item->created_by != $user->id) {
            JError::raiseError(403, JText::_("ALERTNOTAUTH"));
        }
        $row->commentText = JRequest::getVar('commentText', '', 'default', 'string', 4);
        $row->store();
        $cache = &JFactory::getCache('com_k2');
        $cache->clean();
        $response = new JObject;
        $response->comment = $row->commentText;
        $response->message = JText::_('Save completed');
        unset($response->_errors);
        require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'JSON.php');
        $json = new Services_JSON;
       	echo $json->encode($response);
        $mainframe->close();
    }

    function checkLogin() {

        $user = &JFactory::getUser();
        if ($user->guest) {
            JError::raiseError(403, JText::_("ALERTNOTAUTH"));
        }

    }


}
