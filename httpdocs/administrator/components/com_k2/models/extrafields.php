<?php
/**
 * @version		$Id: extrafields.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelExtraFields extends JModel
{

	function getData() {

		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = & JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', 'groupname', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', 'ASC', 'word');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$filter_type = $mainframe->getUserStateFromRequest($option.$view.'filter_type', 'filter_type', '', 'string');
		$filter_group = $mainframe->getUserStateFromRequest($option.$view.'filter_group', 'filter_group', 0, 'int');

		$query = "SELECT exf.*, exfg.name as groupname FROM #__k2_extra_fields AS exf LEFT JOIN #__k2_extra_fields_groups exfg ON exf.group=exfg.id  WHERE exf.id>0";

		if ($filter_state > -1) {
			$query .= " AND published={$filter_state}";
		}

		if ($search) {
			$query .= " AND LOWER( exf.name ) LIKE ".$db->Quote('%'.$db->getEscaped($search, true).'%', false);
		}

		if ($filter_type) {
			$query .= " AND `type`=".$db->Quote($filter_type);
		}

		if ($filter_group) {
			$query .= " AND `group`={$filter_group}";
		}

		if (!$filter_order) {
			$filter_order = '`group`';
		}

		if ($filter_order == 'ordering') {
			$query .= " ORDER BY `group`, ordering {$filter_order_Dir}";
		}
		else {
			$query .= " ORDER BY {$filter_order} {$filter_order_Dir}, `group`, ordering";
		}

		$db->setQuery($query, $limitstart, $limit);
		$rows = $db->loadObjectList();
		return $rows;
	}

	function getTotal() {

		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = & JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', 1, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$filter_type = $mainframe->getUserStateFromRequest($option.$view.'filter_type', 'filter_type', '', 'string');
		$filter_group = $mainframe->getUserStateFromRequest($option.$view.'filter_group', 'filter_group', '', 'string');

		$query = "SELECT COUNT(*) FROM #__k2_extra_fields WHERE id>0";

		if ($filter_state > -1) {
			$query .= " AND published={$filter_state}";
		}

		if ($search) {
			$query .= " AND LOWER( name ) LIKE ".$db->Quote('%'.$db->getEscaped($search, true).'%', false);
		}

		if ($filter_type) {
			$query .= " AND `type`=".$db->Quote($filter_type);
		}

		if ($filter_group) {
			$query .= " AND `group`=".$db->Quote($filter_group);
		}

		$db->setQuery($query);
		$total = $db->loadresult();
		return $total;
	}

	function publish() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->publish($id, 1);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=extraFields');
	}

	function unpublish() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->publish($id, 0);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=extraFields');
	}

	function saveorder() {

		$mainframe = &JFactory::getApplication();
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid', array (0), 'post', 'array');
		$total = count($cid);
		$order = JRequest::getVar('order', array (0), 'post', 'array');
		JArrayHelper::toInteger($order, array (0));
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		$groupings = array ();
		for ($i = 0; $i < $total; $i++) {
			$row->load((int)$cid[$i]);
			$groupings[] = $row->group;
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
				$row->reorder("`group` = {$group}");
			}
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=extraFields', $msg);
	}

	function orderup() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		$row->load($cid[0]);
		$row->move(-1, "`group` = '{$row->group}'");
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering'))
			$row->reorder("`group` = '{$row->group}'");
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=extraFields', $msg);
	}

	function orderdown() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		$row->load($cid[0]);
		$row->move(1, "`group` = '{$row->group}'");
		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering'))
			$row->reorder("`group` = '{$row->group}'");
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$msg = JText::_('New ordering saved');
		$mainframe->redirect('index.php?option=com_k2&view=extraFields', $msg);
	}

	function remove() {

		$mainframe = &JFactory::getApplication();
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->delete($id);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=extraFields', JText::_('Delete Completed'));
	}

	function getExtraFieldsGroup() {

		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraFieldsGroup', 'Table');
		$row->load($cid);
		return $row;
	}

	function getGroups() {

		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__k2_extra_fields_groups ORDER BY `name`";
		$db->setQuery($query, $limitstart, $limit);
		$rows = $db->loadObjectList();
		for ($i=0;$i<sizeof($rows);$i++){
			$query = "SELECT name FROM #__k2_categories WHERE extraFieldsGroup=".(int)$rows[$i]->id;
			$db->setQuery($query);
			$categories = $db->loadResultArray();
			$rows[$i]->categories = implode(', ', $categories);
		}
		return $rows;
	}

	function getTotalGroups() {

		$db = & JFactory::getDBO();
		$query = "SELECT COUNT(*) FROM #__k2_extra_fields_groups";
		$db->setQuery($query);
		$total = $db->loadResult();
		return $total;
	}

	function saveGroup(){

		$mainframe = &JFactory::getApplication();
		$id = JRequest::getInt('id');
		$row = & JTable::getInstance('K2ExtraFieldsGroup', 'Table');
		if (!$row->bind(JRequest::get('post'))) {
			$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroups', $row->getError(), 'error');
		}

		if (!$row->check()) {
			$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroup&cid='.$row->id, $row->getError(), 'error');
		}

		if (!$row->store()) {
			$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroup', $row->getError(), 'error');
		}

		switch(JRequest::getCmd('task')) {
			case 'apply':
			$msg = JText::_('Changes to Group saved');
			$link = 'index.php?option=com_k2&view=extraFieldsGroup&cid='.$row->id;
			break;
			case 'save':
			default:
			$msg = JText::_('Group Saved');
			$link = 'index.php?option=com_k2&view=extraFieldsGroups';
			break;
		}

		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect($link, $msg);
	}

	function removeGroups(){

		$mainframe = &JFactory::getApplication();
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		JArrayHelper::toInteger($cid);
		$row = & JTable::getInstance('K2ExtraFieldsGroup', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$query = "DELETE FROM #__k2_extra_fields WHERE `group`={$id}";
			$db->setQuery($query);
			$db->query();
			$row->delete($id);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroups', JText::_('Delete Completed'));
	}

}
