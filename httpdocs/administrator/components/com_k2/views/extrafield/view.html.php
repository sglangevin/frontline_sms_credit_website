<?php
/**
 * @version		$Id: view.html.php 565 2010-09-23 11:48:48Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewExtraField extends JView
{

	function display($tpl = null)
	{
	
		JRequest::setVar('hidemainmenu', 1);
		$model = & $this->getModel();
		$extraField = $model->getData();
		if(!$extraField->id)
			$extraField->published=1;
		$this->assignRef('row', $extraField);
	
		$lists = array ();
		$lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"', $extraField->published);
		
		
		$groups[] = JHTML::_('select.option', 0, JText::_('Create new group'));
		
		require_once (JPATH_COMPONENT.DS.'models'.DS.'extrafields.php');
		$extraFieldModel= new K2ModelExtraFields;
		$uniqueGroups= $extraFieldModel->getGroups();
		foreach ($uniqueGroups as $group){
			$groups[] = JHTML::_('select.option', $group->id, $group->name);
		}
		
		$lists['group'] = JHTML::_('select.genericlist', $groups, 'groups', '', 'value', 'text', $extraField->group);
		
		$typeOptions[] = JHTML::_('select.option', 0, JText::_('-- Select Type --'));
		$typeOptions[] = JHTML::_('select.option', 'textfield', JText::_('Text field'));
		$typeOptions[] = JHTML::_('select.option', 'textarea', JText::_('Textarea'));
		$typeOptions[] = JHTML::_('select.option', 'select', JText::_('Drop-down selection'));
		$typeOptions[] = JHTML::_('select.option', 'multipleSelect', JText::_('Multi-select list'));
		$typeOptions[] = JHTML::_('select.option', 'radio', JText::_('Radio buttons'));
		$typeOptions[] = JHTML::_('select.option', 'link', JText::_('Link'));
		$typeOptions[] = JHTML::_('select.option', 'csv', JText::_('CSV Data'));
		$typeOptions[] = JHTML::_('select.option', 'labels', JText::_('Searchable Labels'));
		$lists['type'] = JHTML::_('select.genericlist', $typeOptions, 'type', '', 'value', 'text', $extraField->type);
		
		$this->assignRef('lists', $lists);
		(JRequest::getInt('cid'))? $title = JText::_('Edit extra field') : $title = JText::_('Add extra field');
		JToolBarHelper::title($title, 'k2.png');
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel();
	
		parent::display($tpl);
	}

}
