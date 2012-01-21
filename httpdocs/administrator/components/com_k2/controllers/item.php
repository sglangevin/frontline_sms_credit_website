<?php
/**
 * @version		$Id: item.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class K2ControllerItem extends JController
{

	function display() {
		JRequest::setVar('view', 'item');
		parent::display();
	}

	function save() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('item');
		$model->save();
	}

	function apply() {
		$this->save();
	}

	function cancel() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('item');
		$model->cancel();
	}

	function deleteAttachment() {
		$model = & $this->getModel('item');
		$model->deleteAttachment();
	}

	function tag() {
		$model = & $this->getModel('tag');
		$model->addTag();
	}

	function download(){
		$model = & $this->getModel('item');
		$model->download();
	}

	function extraFields(){
		$mainframe = &JFactory::getApplication();
		$itemID=JRequest::getInt('id',NULL);
		$categoryModel = & $this->getModel('category');
		$category=$categoryModel->getData();
		$extraFieldModel = & $this->getModel('extraField');
		$extraFields = $extraFieldModel->getExtraFieldsByGroup($category->extraFieldsGroup);

		$output='<table class="admintable" id="extraFields">';
		$counter=0;
		if (count($extraFields)){
			foreach ($extraFields as $extraField){
				$output.='<tr><td align="right" class="key">'.$extraField->name.'</td>';
				$output.='<td>'.$extraFieldModel->renderExtraField($extraField,$itemID).'</td></tr>';
				$counter++;
			}
		}
		$output.='</table>';

		if ($counter==0) $output=JText::_("This category doesn't have assigned extra fields");

		echo $output;

		$mainframe->close();
	}

	function resetHits(){
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('item');
		$model->resetHits();

	}

	function resetRating(){
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('item');
		$model->resetRating();

	}

	function filebrowser(){
		$view = & $this->getView('item', 'html');
		$view->setLayout('filebrowser');
		$view->filebrowser();

	}

}
