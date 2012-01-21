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

class K2ViewExtraFields extends JView
{

	function display($tpl = null)
	{

		$mainframe = &JFactory::getApplication();
		$user = & JFactory::getUser();
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', 'groupname', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', 'ASC', 'word');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$filter_type = $mainframe->getUserStateFromRequest($option.$view.'filter_type', 'filter_type', '', 'string');
		$filter_group = $mainframe->getUserStateFromRequest($option.$view.'filter_group', 'filter_group', '', 'string');

		$model = & $this->getModel();

		$extraFields = $model->getData();

		$this->assignRef('rows', $extraFields);
		$total = $model->getTotal();

		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);
		$this->assignRef('page', $pageNav);

		$lists = array ();
		$lists['search'] = $search;
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		$filter_state_options[] = JHTML::_('select.option', -1, JText::_('-- Select State --'));
		$filter_state_options[] = JHTML::_('select.option', 1, JText::_('Published'));
		$filter_state_options[] = JHTML::_('select.option', 0, JText::_('Unpublished'));
		$lists['state'] = JHTML::_('select.genericlist', $filter_state_options, 'filter_state', 'onchange="this.form.submit();"', 'value', 'text', $filter_state);

		$extraFieldGroups = $model->getGroups();
		$groups[] = JHTML::_('select.option', '0', JText::_('-- Select Group --'));

		foreach ($extraFieldGroups as $extraFieldGroup) {
			$groups[] = JHTML::_('select.option', $extraFieldGroup->id, $extraFieldGroup->name);
		}
		$lists['group'] = JHTML::_('select.genericlist', $groups, 'filter_group', 'onchange="this.form.submit();"', 'value', 'text', $filter_group);

		$filter_type_options[] = JHTML::_('select.option', 0, JText::_('-- Select Type --'));
		$filter_type_options[] = JHTML::_('select.option', 'textfield', JText::_('Text Field'));
		$filter_type_options[] = JHTML::_('select.option', 'textarea', JText::_('Textarea'));
		$filter_type_options[] = JHTML::_('select.option', 'select_dd', JText::_('Drop-down selection'));
		$filter_type_options[] = JHTML::_('select.option', 'select_m', JText::_('Multi-select list'));
		$filter_type_options[] = JHTML::_('select.option', 'radio', JText::_('Radio buttons'));
		$lists['type'] = JHTML::_('select.genericlist', $filter_type_options, 'filter_type', 'onchange="this.form.submit();"', 'value', 'text', $filter_type);

		$this->assignRef('lists', $lists);

		JToolBarHelper::title(JText::_('Extra Fields'), 'k2.png');

		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::deleteList('Are you sure you want to delete selected extra fields?', 'remove', 'Delete');
		JToolBarHelper::editList();
		JToolBarHelper::addNew();
		JToolBarHelper::preferences('com_k2', '500', '600');

		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_k2');
		JSubMenuHelper::addEntry(JText::_('Items'), 'index.php?option=com_k2&view=items');
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_k2&view=categories');
		JSubMenuHelper::addEntry(JText::_('Tags'), 'index.php?option=com_k2&view=tags');
		JSubMenuHelper::addEntry(JText::_('Comments'), 'index.php?option=com_k2&view=comments');
		JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_k2&view=users');
		JSubMenuHelper::addEntry(JText::_('User Groups'), 'index.php?option=com_k2&view=userGroups');

		if ($user->gid > 23) {
			JSubMenuHelper::addEntry(JText::_('Extra Fields'), 'index.php?option=com_k2&view=extraFields', true);
			JSubMenuHelper::addEntry(JText::_('Extra Field Groups'), 'index.php?option=com_k2&view=extraFieldsGroups');
		}

		JSubMenuHelper::addEntry(JText::_('Information'), 'index.php?option=com_k2&view=info');

		parent::display($tpl);
	}

}
