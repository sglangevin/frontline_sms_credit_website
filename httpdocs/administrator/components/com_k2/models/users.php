<?php
/**
 * @version		$Id: users.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelUsers extends JModel
{

	function getData() {

		$mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$db = & JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', '', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$filter_status = $mainframe->getUserStateFromRequest($option.$view.'filter_status', 'filter_status', -1, 'int');
		$filter_group = $mainframe->getUserStateFromRequest($option.$view.'filter_group', 'filter_group', '', 'string');
		$filter_group_k2 = $mainframe->getUserStateFromRequest($option.$view.'filter_group_k2', 'filter_group_k2', '', 'string');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);

		$query = "SELECT juser.*, k2user.group, k2group.name as groupname FROM #__users as juser ".
		"LEFT JOIN #__k2_users as k2user ON juser.id=k2user.userID ".
		"LEFT JOIN #__k2_user_groups as k2group ON k2user.group=k2group.id ".
		" WHERE juser.id>0";

		if ($filter_status > -1) {
			$query .= " AND juser.block = {$filter_status}";
		}

		if ($filter_group) {
			switch($filter_group)
			{
				case 'Public Frontend':
				$query .= " AND juser.usertype IN ('Registered', 'Author', 'Editor', 'Publisher')";
				break;

				case 'Public Backend':
				$query .= " AND juser.usertype IN ('Manager', 'Administrator', 'Super Administrator')";
				break;

				default:
				$filter_group=strtolower(trim($filter_group));
				$query .= " AND juser.usertype = ".$db->Quote($filter_group);
			}
		}

		if ($filter_group_k2) {
			$query .= " AND k2user.group = ".$db->Quote($filter_group_k2);
		}

		if ($search) {
			$query .= " AND LOWER( juser.name ) LIKE ".$db->Quote('%'.$db->getEscaped($search, true).'%', false);
		}

		if (!$filter_order) {
			$filter_order = "juser.name";
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
		$db = & JFactory::getDBO();
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.'.limitstart', 'limitstart', 0, 'int');
		$filter_status = $mainframe->getUserStateFromRequest($option.$view.'filter_status', 'filter_status', -1, 'int');
		$filter_group = $mainframe->getUserStateFromRequest($option.$view.'filter_group', 'filter_group', '', 'string');
		$filter_group_k2 = $mainframe->getUserStateFromRequest($option.$view.'filter_group_k2', 'filter_group_k2', '', 'string');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);

		$query = "SELECT COUNT(juser.id) FROM #__users as juser ".
		"LEFT JOIN #__k2_users as k2user ON juser.id=k2user.userID ".
		"LEFT JOIN #__k2_user_groups as k2group ON k2user.group=k2group.id ".
		" WHERE juser.id>0";

		if ($filter_status > -1) {
			$query .= " AND juser.block = {$filter_status}";
		}

		if ($filter_group) {
			switch($filter_group)
			{
				case 'Public Frontend':
				$query .= " AND juser.usertype IN ('Registered', 'Author', 'Editor', 'Publisher')";
				break;

				case 'Public Backend':
				$query .= " AND juser.usertype IN ('Manager', 'Administrator', 'Super Administrator')";
				break;

				default:
				$filter_group=strtolower(trim($filter_group));
				$query .= " AND juser.usertype = ".$db->Quote($filter_group);
			}
		}

		if ($filter_group_k2) {
			$query .= " AND k2user.group = ".$db->Quote($filter_group_k2);
		}

		if ($search) {
			$query .= " AND LOWER( juser.name ) LIKE ".$db->Quote('%'.$db->getEscaped($search, true).'%', false);
		}

		$db->setQuery($query);
		$total = $db->loadResult();
		return $total;
	}

	function remove() {

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2User', 'Table');
		foreach ($cid as $id) {
			$row->load($id);
			$row->delete($id);
		}
		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		$mainframe->redirect('index.php?option=com_k2&view=users', JText::_('User profile deleted'));
	}

	function getUserGroups($type='joomla'){

		$db = & JFactory::getDBO();

		if ($type=='joomla'){

			$query = 'SELECT (lft - 3) AS lft, name AS value, name AS text'
				. ' FROM #__core_acl_aro_groups'
				. ' WHERE name != "ROOT"'
				. ' AND name != "USERS"'
				. ' ORDER BY `lft` ASC'
			;
			$db->setQuery( $query );
			$groups = $db->loadObjectList();
			$userGroups = array();

			foreach ($groups as $group) {
				if ($group->lft >= 10) $group->lft = (int)$group->lft - 10;
				$group->text = $this->indent($group->lft).$group->text;
				array_push($userGroups,$group);
			}

		}
		else {
			$query = "SELECT * FROM #__k2_user_groups";
			$db->setQuery($query);
			$userGroups = $db->loadObjectList();

		}

		return $userGroups;
	}

	function indent($times, $char = '&nbsp;&nbsp;&nbsp;&nbsp;', $start_char = '', $end_char = '') {
		$return = $start_char;
		for ($i = 0; $i < $times; $i++) $return .= $char;
		$return .= $end_char;
		return $return;
	}

	function checkLogin($id){

		$db = & JFactory::getDBO();
		$query = "SELECT COUNT(s.userid) FROM #__session AS s WHERE s.userid = ".(int)$id;
		$db->setQuery( $query );
		$result = $db->loadResult();
		return $result;
	}

	function hasProfile($id){

		$db = & JFactory::getDBO();
		$query = "SELECT id FROM #__k2_users WHERE userID = ".(int)$id;
		$db->setQuery( $query );
		$result = $db->loadResult();
		return $result;
	}

	function enable(){

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$db = & JFactory::getDBO();
		$query = "SELECT userID FROM #__k2_users WHERE id IN(".implode(',',$cid).")";
		$db->setQuery( $query );
		$joomlaIds = $db->loadResultArray();
		$query = "UPDATE #__users SET block=0 WHERE id IN(".implode(',',$joomlaIds).")";
		$db->setQuery( $query );
		$db->query();
		$mainframe->redirect('index.php?option=com_k2&view=users', JText::_('Users enabled'));
	}

	function disable(){

		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$db = & JFactory::getDBO();
		$query = "SELECT userID FROM #__k2_users WHERE id IN(".implode(',',$cid).")";
		$db->setQuery( $query );
		$joomlaIds = $db->loadResultArray();
		$query = "UPDATE #__users SET block=1 WHERE id IN(".implode(',',$joomlaIds).")";
		$db->setQuery( $query );
		$db->query();
		$mainframe->redirect('index.php?option=com_k2&view=users', JText::_('Users disabled'));
	}

	function delete(){
		$mainframe = &JFactory::getApplication();
		$user = &JFactory::getUser();
		$cid = JRequest::getVar('cid');
		$db = & JFactory::getDBO();
		$query = "SELECT userID FROM #__k2_users WHERE id IN(".implode(',',$cid).")";
		$db->setQuery( $query );
		$joomlaIds = $db->loadResultArray();
		if(in_array($user->id, $joomlaIds))
			$mainframe->enqueueMessage(JText::_('You cannot delete yourself'), 'notice');
		$query = "SELECT * FROM #__users WHERE id IN(".implode(',',$joomlaIds).") AND gid<={$user->gid}";
		$db->setQuery( $query );
		$IDsToDelete = $db->loadResultArray();

		$query = "DELETE FROM #__users WHERE id IN(".implode(',',$IDsToDelete).") AND id!={$user->id}";
		$db->setQuery( $query ); echo $query;
		$db->query();

		$query = "DELETE FROM #__k2_users WHERE userID IN(".implode(',',$IDsToDelete).") AND userID!={$user->id}";
		$db->setQuery( $query ); echo $query;
		$db->query();

		$mainframe->redirect('index.php?option=com_k2&view=users', JText::_('Delete completed'));
	}

	function saveMove(){
		$mainframe = &JFactory::getApplication();
		$db = & JFactory::getDBO();
		$cid = JRequest::getVar('cid');
		$group = JRequest::getVar('group');
		$k2group = JRequest::getInt('k2group');

		if($group){
			$query = "SELECT id FROM #__core_acl_aro_groups WHERE name=".$db->Quote($group);
			$db->setQuery($query);
			$gid = $db->loadResult();
			$query = "UPDATE #__users SET gid={$gid}, usertype=".$db->Quote($group)." WHERE id IN(".implode(',',$cid).")";
			$db->setQuery( $query );
			$db->query();
		}

		if($k2group){
			$query = "UPDATE #__k2_users SET `group`={$k2group} WHERE userID IN(".implode(',',$cid).")";
			$db->setQuery( $query );
			$db->query();
		}
		$mainframe->redirect('index.php?option=com_k2&view=users', JText::_('Move completed'));

	}

	function import() {

		$mainframe = &JFactory::getApplication();
		$db = &JFactory::getDBO();
		$acl =& JFactory::getACL();
        $frontEndGroups = $acl->_getBelow( '#__core_acl_aro_groups', 'g1.id, g1.name, COUNT(g2.name) AS level', 'g1.name', false, 'Public Frontend', false );
        $backEndGroups = $acl->_getBelow( '#__core_acl_aro_groups', 'g1.id, g1.name, COUNT(g2.name) AS level', 'g1.name', false, 'Public Backend', false );
		$usergroups = array_merge($frontEndGroups, $backEndGroups);

		$xml = new JSimpleXML;
		$xml->loadFile(JPATH_COMPONENT.DS.'models'.DS.'userGroup.xml');
		$permissions = new JParameter('');
		foreach ($xml->document->params as $paramGroup) {
			foreach ($paramGroup->param as $param) {
				if ($param->attributes('type') != 'spacer') {
					$permissions->set($param->attributes('name'), $param->attributes('default'));
				}
			}
		}
		$permissions->set('inheritance',0);
		$permissions->set('categories', 'all');
		$permissions = $permissions->toString();

		foreach($usergroups as $usergroup){
			$K2UserGroup = &JTable::getInstance('K2UserGroup', 'Table');
			$K2UserGroup->name = JString::trim($usergroup->name)." (Imported from Joomla!)";
			$K2UserGroup->permissions = $permissions;
			$K2UserGroup->store();

			$query = "SELECT * FROM #__users WHERE gid={$usergroup->id}";
			$db->setQuery($query);
			$users = $db->loadObjectList();

			foreach ($users as $user){

				$query = "SELECT COUNT(*) FROM #__k2_users WHERE userID={$user->id}";
				$db->setQuery($query);
				$result = $db->loadResult();
				if(!$result){
					$K2User = &JTable::getInstance('K2User', 'Table');
					$K2User->userID = $user->id;
					$K2User->group = $K2UserGroup->id;
					$K2User->store();
				}
			}
		}

		$mainframe->redirect('index.php?option=com_k2&view=users', JText::_('Import Completed'));

	}

}
