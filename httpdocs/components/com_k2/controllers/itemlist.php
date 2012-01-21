<?php
/**
 * @version		$Id: itemlist.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class K2ControllerItemlist extends JController
{

	function display() {
	
		$model=&$this->getModel('item');
		$format=JRequest::getWord('format','html');
		$document =& JFactory::getDocument();
		$viewType = $document->getType();
		$view = &$this->getView('itemlist', $viewType);
		$view->setModel($model);
		$user = &JFactory::getUser();
		if ($user->guest){
			parent::display(true);
		}
		else {
			parent::display(false);
		}
		
	}
	
	function calendar(){
		
		require_once (JPATH_SITE.DS.'modules'.DS.'mod_k2_tools'.DS.'includes'.DS.'calendarClass.php');
		require_once (JPATH_SITE.DS.'modules'.DS.'mod_k2_tools'.DS.'helper.php');
		$mainframe = &JFactory::getApplication();
		$month = JRequest::getInt('month');
		$year = JRequest::getInt('year');
		
		$months = array (JText::_('JANUARY'), JText::_('FEBRUARY'), JText::_('MARCH'), JText::_('APRIL'), JText::_('MAY'), JText::_('JUNE'), JText::_('JULY'), JText::_('AUGUST'), JText::_('SEPTEMBER'), JText::_('OCTOBER'), JText::_('NOVEMBER'), JText::_('DECEMBER'), );
		$days = array (JText::_('SUN'), JText::_('MON'), JText::_('TUE'), JText::_('WED'), JText::_('THU'), JText::_('FRI'), JText::_('SAT'), );
		
		$cal = new MyCalendar;
		$cal->setMonthNames($months);
		$cal->setDayNames($days);
		$cal->category = JRequest::getInt('catid');
		$cal->setStartDay(1);
		
		if (($month) && ($year)) {
			echo $cal->getMonthView($month, $year);
		}
		else {
			echo $cal->getCurrentMonthView();
		}
		
		$mainframe->close();
	}
	
	function module(){
		
		$document =& JFactory::getDocument();
		$view = &$this->getView('itemlist', 'raw');
		$model=&$this->getModel('itemlist');
		$view->setModel($model);
		$model=&$this->getModel('item');
		$view->setModel($model);
		$view->module();

	}
	
}
