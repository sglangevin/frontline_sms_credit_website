<?php
/**
 * @version		$Id: view.html.php 549 2010-08-30 15:39:45Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewUsers extends JView
{

	function display($tpl = null) {

		$mainframe = &JFactory::getApplication();
		$params = &JComponentHelper::getParams('com_k2');
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', '', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$filter_status = $mainframe->getUserStateFromRequest($option.$view.'filter_status', 'filter_status', -1, 'int');
		$filter_group = $mainframe->getUserStateFromRequest($option.$view.'filter_group', 'filter_group', 1, 'filter_group');
		$filter_group_k2 = $mainframe->getUserStateFromRequest($option.$view.'filter_group_k2', 'filter_group_k2', '', 'filter_group_k2');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$model = & $this->getModel();

		$users = $model->getData();

		for ($i=0; $i<sizeof($users); $i++){

			$users[$i]->loggedin = $model->checkLogin($users[$i]->id);
			$users[$i]->profileID = $model->hasProfile($users[$i]->id);

			if ($users[$i]->lastvisitDate == "0000-00-00 00:00:00") {
				$users[$i]->lvisit = JText::_('Never');
			}
			else {
				$users[$i]->lvisit = JHTML::_('date', $users[$i]->lastvisitDate, '%Y-%m-%d %H:%M:%S');
			}

			if ($users[$i]->profileID) {
				$users[$i]->link = JRoute::_('index.php?option=com_k2&view=user&cid='.$users[$i]->profileID);
			}
			else {
				$users[$i]->link = JRoute::_('index.php?option=com_k2&view=user&userID='.$users[$i]->id);
			}

		}

		$this->assignRef('rows', $users);
		$total = $model->getTotal();

		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);
		$this->assignRef('page', $pageNav);

		$lists = array ();
		$lists['search'] = $search;
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

		$filter_status_options[] = JHTML::_('select.option', -1, JText::_('-- Select State --'));
		$filter_status_options[] = JHTML::_('select.option', 0, JText::_('Enabled'));
		$filter_status_options[] = JHTML::_('select.option', 1, JText::_('Blocked'));
		$lists['status'] = JHTML::_('select.genericlist', $filter_status_options, 'filter_status', 'onchange="this.form.submit();"', 'value', 'text', $filter_status);

		$userGroups = $model->getUserGroups();
		$groups[] = JHTML::_('select.option', '0', JText::_('-- Select Joomla! Group --'));

		foreach ($userGroups as $userGroup) {
			$groups[] = JHTML::_('select.option', $userGroup->value, JText::_($userGroup->text));
		}

		$lists['filter_group'] = JHTML::_('select.genericlist', $groups, 'filter_group', 'onchange="this.form.submit();"', 'value', 'text', $filter_group);


		$K2userGroups = $model->getUserGroups('k2');
		$K2groups[] = JHTML::_('select.option', '0', JText::_('-- Select K2 Group --'));

		foreach ($K2userGroups as $K2userGroup) {
			$K2groups[] = JHTML::_('select.option', $K2userGroup->id, $K2userGroup->name);
		}

		$lists['filter_group_k2'] = JHTML::_('select.genericlist', $K2groups, 'filter_group_k2', 'onchange="this.form.submit();"', 'value', 'text', $filter_group_k2);

		$this->assignRef('lists', $lists);

		JToolBarHelper::title(JText::_('Users'), 'k2.png');
		JToolBarHelper::customX( 'move', 'move.png', 'move_f2.png', 'Move' );
		JToolBarHelper::deleteList('WARNING: You are about to delete the selected users permanently from the system!', 'delete', 'Delete');
		JToolBarHelper::publishList('enable', 'Enable');
		JToolBarHelper::unpublishList('disable', 'Disable');
		JToolBarHelper::editList();
		JToolBarHelper::deleteList('Are you sure you want to reset selected users?', 'remove', 'Reset User Details');
		JToolBarHelper::preferences('com_k2', '500', '600');

		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_k2');
		JSubMenuHelper::addEntry(JText::_('Items'), 'index.php?option=com_k2&view=items');
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_k2&view=categories');
		JSubMenuHelper::addEntry(JText::_('Tags'), 'index.php?option=com_k2&view=tags');
		JSubMenuHelper::addEntry(JText::_('Comments'), 'index.php?option=com_k2&view=comments');
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_k2&view=users', true);
		JSubMenuHelper::addEntry(JText::_('User Groups'), 'index.php?option=com_k2&view=userGroups');

		$user = & JFactory::getUser();
		if ($user->gid > 23) {
			JSubMenuHelper::addEntry(JText::_('Extra Fields'), 'index.php?option=com_k2&view=extraFields');
			JSubMenuHelper::addEntry(JText::_('Extra Field Groups'), 'index.php?option=com_k2&view=extraFieldsGroups');
			if (!$params->get('hideImportButton')){
				$toolbar=&JToolBar::getInstance('toolbar');
				$toolbar->prependButton('Link', 'archive', 'Import Joomla! users', JURI::base().'index.php?option=com_k2&amp;view=users&amp;task=import');
			}
		}

		JSubMenuHelper::addEntry(JText::_('Information'), 'index.php?option=com_k2&view=info');

		parent::display($tpl);
	}

	function move(){

		$mainframe = &JFactory::getApplication();
		JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
		$cid = JRequest::getVar('cid');
		$db = & JFactory::getDBO();
		$query = "SELECT userID FROM #__k2_users WHERE id IN(".implode(',',$cid).")";
		$db->setQuery( $query );
		$joomlaIds = $db->loadResultArray();

		foreach ($joomlaIds as $id) {
			$row = &JFactory::getUser($id);
			$rows[]=$row;
		}
		$this->assignRef('rows',$rows);

		$model = & $this->getModel('users');
		$lists = array ();
		$userGroups = $model->getUserGroups();
		$groups[] = JHTML::_('select.option', '', JText::_('-- Do not change --'));
		foreach ($userGroups as $userGroup) {
			$groups[] = JHTML::_('select.option', $userGroup->value, JText::_($userGroup->text));
		}
		$lists['group'] = JHTML::_('select.genericlist', $groups, 'group', 'size="10"', 'value', 'text', '');

		$K2userGroups = $model->getUserGroups('k2');
		$K2groups[] = JHTML::_('select.option', '0', JText::_('-- Do not change --'));
		foreach ($K2userGroups as $K2userGroup) {
			$K2groups[] = JHTML::_('select.option', $K2userGroup->id, $K2userGroup->name);
		}
		$lists['k2group'] = JHTML::_('select.genericlist', $K2groups, 'k2group', 'size="10"', 'value', 'text', 0);

		$this->assignRef('lists', $lists);

		JToolBarHelper::title( JText::_('Move users'), 'k2.png' );
		JToolBarHelper::custom('saveMove','save.png','save_f2.png','Save', false);
		JToolBarHelper::cancel();

		parent::display();
	}

}
