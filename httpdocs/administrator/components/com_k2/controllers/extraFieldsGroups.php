<?php
/**
 * @version		$Id: extraFieldsGroups.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class K2ControllerExtraFieldsGroups extends JController
{

	function display() {
		JRequest::setVar('view', 'extraFieldsGroups');
		$model = & $this->getModel('extraFields');
		$view = & $this->getView('extraFieldsGroups', 'html');
		$view->setModel($model, true);
		parent::display();
	}
	
	function add() {
		$mainframe = &JFactory::getApplication();
		$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroup');
	}

	function edit() {
		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$mainframe->redirect('index.php?option=com_k2&view=extraFieldsGroup&cid='.$cid[0]);
	}
	
	function remove() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('extraFields');
		$model->removeGroups();
	}

}
