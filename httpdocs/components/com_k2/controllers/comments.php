<?php
/**
 * @version		$Id: comments.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class K2ControllerComments extends JController {
    function display() {
        $model = &$this->getModel('comments');
        $model->checkLogin();
       	JRequest::setVar('tmpl','component');
        parent::display();
    }
    function publish() {

        $model = &$this->getModel('comments');
        $model->checkLogin();
        JRequest::checkToken() or jexit('Invalid Token');
        $model->publish();
    }

    function unpublish() {


        $model = &$this->getModel('comments');
        $model->checkLogin();
        JRequest::checkToken() or jexit('Invalid Token');
        $model->unpublish();
    }

    function remove() {

        $model = &$this->getModel('comments');
        $model->checkLogin();
        JRequest::checkToken() or jexit('Invalid Token');
        $model->remove();
    }

    function deleteUnpublished() {
        $model = &$this->getModel('comments');
        $model->checkLogin();
        JRequest::checkToken() or jexit('Invalid Token');
        $model->deleteUnpublished();
    }

    function save() {
    	$model = &$this->getModel('comments');
        $model->checkLogin();
		JRequest::checkToken() or jexit('Invalid Token');
		$model->save();
		$mainframe->close();
    }


}
