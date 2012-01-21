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

class K2ViewCategories extends JView
{

	function display($tpl = null)
	{

		$mainframe = &JFactory::getApplication();
		$user = & JFactory::getUser();
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = $mainframe->getUserStateFromRequest($option.$view.'.limitstart', 'limitstart', 0, 'int');
		$filter_order = $mainframe->getUserStateFromRequest($option.$view.'filter_order', 'filter_order', 'c.ordering', 'cmd');
		$filter_order_Dir = $mainframe->getUserStateFromRequest($option.$view.'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$filter_trash = $mainframe->getUserStateFromRequest($option.$view.'filter_trash', 'filter_trash', 0, 'int');
		$filter_category = $mainframe->getUserStateFromRequest($option.$view.'filter_category', 'filter_category', 0, 'int');
		$filter_state = $mainframe->getUserStateFromRequest($option.$view.'filter_state', 'filter_state', -1, 'int');
		$search = $mainframe->getUserStateFromRequest($option.$view.'search', 'search', '', 'string');
		$search = JString::strtolower($search);
		$model = & $this->getModel();

		$categories = $model->getData();
		require_once(JPATH_COMPONENT.DS.'models'.DS.'category.php');
		$categoryModel= new K2ModelCategory;

		$params = & JComponentHelper::getParams('com_k2');
		$this->assignRef('params', $params);
		if ($params->get('showItemsCounterAdmin')){
			for ($i=0; $i<sizeof($categories); $i++){
				$categories[$i]->numOfItems=$categoryModel->countCategoryItems($categories[$i]->id);
			}
		}

		$this->assignRef('rows', $categories);
		$total = $model->getTotal();

		jimport('joomla.html.pagination');
		$pageNav = new JPagination($total, $limitstart, $limit);
		$this->assignRef('page', $pageNav);

		$lists = array ();
		$lists['search'] = $search;
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

		$filter_trash_options[] = JHTML::_('select.option', 0, JText::_('Current'));
		$filter_trash_options[] = JHTML::_('select.option', 1, JText::_('Trashed'));
		$lists['trash'] = JHTML::_('select.genericlist', $filter_trash_options, 'filter_trash', 'onchange="this.form.submit();"', 'value', 'text', $filter_trash);

		$filter_state_options[] = JHTML::_('select.option', -1, JText::_('-- Select State --'));
		$filter_state_options[] = JHTML::_('select.option', 1, JText::_('Published'));
		$filter_state_options[] = JHTML::_('select.option', 0, JText::_('Unpublished'));
		$lists['state'] = JHTML::_('select.genericlist', $filter_state_options, 'filter_state', 'onchange="this.form.submit();"', 'value', 'text', $filter_state);

		$this->assignRef('lists', $lists);

		JToolBarHelper::title(JText::_('Categories'), 'k2.png');

		if ($filter_trash == 1) {
			JToolBarHelper::custom('restore','restore.png','restore_f2.png','Restore', true);
			JToolBarHelper::deleteList('Are you sure you want to delete selected categories?', 'remove', 'Delete');
		}
		else {
			JToolBarHelper::publishList();
			JToolBarHelper::unpublishList();
			JToolBarHelper::customX( 'move', 'move.png', 'move_f2.png', 'Move' );
			JToolBarHelper::editList();
			JToolBarHelper::addNew();
			JToolBarHelper::trash('trash');
		}


		JToolBarHelper::preferences('com_k2', '500', '600');

		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_k2');
		JSubMenuHelper::addEntry(JText::_('Items'), 'index.php?option=com_k2&view=items');
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_k2&view=categories', true);
		if( !$params->get('lockTags') || $user->gid>23)
			JSubMenuHelper::addEntry(JText::_('Tags'), 'index.php?option=com_k2&view=tags');
		JSubMenuHelper::addEntry(JText::_('Comments'), 'index.php?option=com_k2&view=comments');

		if ($user->gid > 23) {
			JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_k2&view=users');
			JSubMenuHelper::addEntry(JText::_('User Groups'), 'index.php?option=com_k2&view=userGroups');
			JSubMenuHelper::addEntry(JText::_('Extra Fields'), 'index.php?option=com_k2&view=extraFields');
			JSubMenuHelper::addEntry(JText::_('Extra Field Groups'), 'index.php?option=com_k2&view=extraFieldsGroups');
			JSubMenuHelper::addEntry(JText::_('Information'), 'index.php?option=com_k2&view=info');
		}

		$this->assignRef('filter_trash', $filter_trash);
		parent::display($tpl);

	}

	function move(){

		$mainframe = &JFactory::getApplication();
		JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
		$cid = JRequest::getVar('cid');

		foreach ($cid as $id) {
			$row = & JTable::getInstance('K2Category', 'Table');
			$row->load($id);
			$rows[]=$row;
		}

		require_once(JPATH_COMPONENT.DS.'models'.DS.'categories.php');
		$categoriesModel= new K2ModelCategories;
		$categories_option[]=JHTML::_('select.option', 0, JText::_('None'));
		$categories = $categoriesModel->categoriesTree(NULL, true);
		$categories_options=@array_merge($categories_option, $categories);
		foreach($categories_options as $option){
			if(in_array($option->value, $cid))
				$option->disable = true;
		}
		$lists['categories'] = JHTML::_('select.genericlist', $categories_options, 'category', 'class="inputbox" size="8"', 'value', 'text');

		$this->assignRef('rows',$rows);
		$this->assignRef('lists',$lists);

		JToolBarHelper::title( JText::_('Move categories'), 'k2.png' );

		JToolBarHelper::custom('saveMove','save.png','save_f2.png','Save', false);
		JToolBarHelper::cancel();

		parent::display();
	}

}
