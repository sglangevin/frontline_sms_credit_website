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

class K2ViewCpanel extends JView
{

	function display($tpl = null) {

		$model = &$this->getModel();

		$latestItems = $model->getLatestItems();
		$this->assignRef('latestItems',$latestItems);

		$latestComments = $model->getLatestComments();
		$this->assignRef('latestComments',$latestComments);

		$numOfItems = $model->countItems();
		$this->assignRef('numOfItems',$numOfItems);

		$numOfTrashedItems = $model->countTrashedItems();
		$this->assignRef('numOfTrashedItems',$numOfTrashedItems);

		$numOfFeaturedItems = $model->countFeaturedItems();
		$this->assignRef('numOfFeaturedItems',$numOfFeaturedItems);

		$numOfComments = $model->countComments();
		$this->assignRef('numOfComments',$numOfComments);

		$numOfCategories = $model->countCategories();
		$this->assignRef('numOfCategories',$numOfCategories);

		$numOfTrashedCategories = $model->countTrashedCategories();
		$this->assignRef('numOfTrashedCategories',$numOfTrashedCategories);

		$numOfUsers = $model->countUsers();
		$this->assignRef('numOfUsers',$numOfUsers);

		$numOfUserGroups = $model->countUserGroups();
		$this->assignRef('numOfUserGroups',$numOfUserGroups);

		$numOfTags = $model->countTags();
		$this->assignRef('numOfTags',$numOfTags);

		$params = &JComponentHelper::getParams('com_k2');
		$frontEditConflict = false;
		if (count(JPluginHelper::getPlugin('system','jfdatabase')) && JPluginHelper::isEnabled('system','jfdatabase') && $params->get('frontendEditing'))
			$frontEditConflict = true;

		$this->assignRef('frontEditConflict',$frontEditConflict);

		$user = & JFactory::getUser();

		JToolBarHelper::title(JText::_('Dashboard'), 'k2.png');
		JToolBarHelper::preferences('com_k2', '500', '600');
		$params = &JComponentHelper::getParams('com_k2');
		if ($user->gid > 23 && !$params->get('hideImportButton')){
			$toolbar=&JToolBar::getInstance('toolbar');
			$toolbar->prependButton('Link', 'archive', 'Import Joomla! content', JURI::base().'index.php?option=com_k2&amp;view=items&amp;task=import');
		}

		JSubMenuHelper::addEntry(JText::_('Dashboard'), 'index.php?option=com_k2', true);
		JSubMenuHelper::addEntry(JText::_('Items'), 'index.php?option=com_k2&view=items');
		JSubMenuHelper::addEntry(JText::_('Categories'), 'index.php?option=com_k2&view=categories');
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

		parent::display($tpl);
	}

}
