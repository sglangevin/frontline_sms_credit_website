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

jimport('joomla.application.component.controller');

class K2ControllerUsers extends JController
{

	function display() {
		JRequest::setVar('view', 'users');
		parent::display();
	}

	function edit() {
		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$mainframe->redirect('index.php?option=com_k2&view=user&cid='.$cid[0]);
	}

	function remove() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('users');
		$model->remove();
	}
	
	function element() {
		JRequest::setVar('view', 'users');
		JRequest::setVar('layout', 'element');
		parent::display();
	}

	function enable() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('users');
		$model->enable();
	}
	
	function disable() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('users');
		$model->disable();
	}
	
	function delete(){	
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('users');
		$model->delete();
	}
	
	function move(){
		$view = & $this->getView('users', 'html');
		$view->setLayout('move');
		$model = & $this->getModel('users');
		$view->setModel($model);
		$view->move();
	}
	
	function saveMove(){	
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('users');
		$model->saveMove();
	}

	function import(){
		$model = & $this->getModel('users');
		$model->import();
	}
}
