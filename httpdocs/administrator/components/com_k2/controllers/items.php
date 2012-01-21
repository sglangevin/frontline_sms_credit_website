<?php
/**
 * @version		$Id: items.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class K2ControllerItems extends JController
{

	function display() {
		JRequest::setVar('view', 'items');
		parent::display();
	}

	function publish() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->publish();
	}

	function unpublish() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->unpublish();
	}

	function saveorder() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->saveorder();
	}

	function orderup() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->orderup();
	}

	function orderdown() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->orderdown();
	}

	function savefeaturedorder() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->savefeaturedorder();
	}

	function featuredorderup() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->featuredorderup();
	}

	function featuredorderdown() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->featuredorderdown();
	}

	function accessregistered() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->accessregistered();
	}

	function accessspecial() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->accessspecial();
	}

	function accesspublic() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->accesspublic();
	}

	function featured() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->featured();
	}

	function trash() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->trash();
	}

	function restore() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->restore();
	}

	function remove() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->remove();
	}

	function add() {
		$mainframe = &JFactory::getApplication();
		$mainframe->redirect('index.php?option=com_k2&view=item');
	}

	function edit() {
		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$mainframe->redirect('index.php?option=com_k2&view=item&cid='.$cid[0]);
	}

	function copy() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('items');
		$model->copy();
	}

	function element() {
		JRequest::setVar('view', 'items');
		JRequest::setVar('layout', 'element');
		parent::display();
	}
	
	function import(){
		$model = & $this->getModel('items');
		$model->import();
	}
	
	function move(){
		$view = & $this->getView('items', 'html');
		$view->setLayout('move');
		$view->move();
	}
	
	function saveMove(){
		$model = & $this->getModel('items');
		$model->move();
	}

}
