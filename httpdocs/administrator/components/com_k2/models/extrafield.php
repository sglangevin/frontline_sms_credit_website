<?php
/**
 * @version		$Id: extrafield.php 536 2010-08-04 11:56:59Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelExtraField extends JModel
{

	function getData() {

		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		$row->load($cid);
		return $row;
	}

	function save() {

		$mainframe = &JFactory::getApplication();
		$row = & JTable::getInstance('K2ExtraField', 'Table');
		if (!$row->bind(JRequest::get('post'))) {
			$mainframe->redirect('index.php?option=com_k2&view=extraFields', $row->getError(), 'error');
		}


		$isNewGroup = JRequest::getInt('isNew');

		if ($isNewGroup){

			$group = & JTable::getInstance('K2ExtraFieldsGroup', 'Table');
			$group->set('name', JRequest::getVar('group'));
			$group->store();
			$row->group = $group->id;
		}

		if(!$row->id){
			$row->ordering = $row->getNextOrder("`group` = {$row->group}");
		}

		$objects = array ();
		$values = JRequest::getVar('option_value');
		$names = JRequest::getVar('option_name');
		$target = JRequest::getVar('option_target');
		$editor = JRequest::getVar('option_editor');
		for ($i = 0; $i < sizeof($values); $i++) {
			$object = new JObject;
			$object->set('name',$names[$i]);

			if ($row->type=='select' || $row->type=='multipleSelect' || $row->type=='radio'){
				$object->set('value', $i+1);
			}
			elseif ($row->type=='link'){
				if (substr($values[$i], 0, 7) == 'http://'){$values[$i] = $values[$i];}
				else {$values[$i] = 'http://'.$values[$i];}
				$object->set('value', $values[$i]);
			}
			elseif ($row->type=='csv'){
					$file = JRequest::getVar('csv_file', NULL, 'FILES');
					$csvFile = $file['tmp_name'];
					if(!empty($csvFile) && JFile::getExt($file['name'])=='csv'){
						$handle = @fopen($csvFile, 'r');
						$csvData=array();
						while (($data = fgetcsv($handle, 1000)) !== FALSE) {
							$csvData[]=$data;
						}
						fclose($handle);
						$object->set('value', $csvData);
					}
					else {
						require_once(JPATH_COMPONENT.DS.'lib'.DS.'JSON.php');
						$json=new Services_JSON;
						$object->set('value', $json->decode($values[$i]));
						if(JRequest::getBool('K2ResetCSV'))
							$object->set('value', null);
					}

			}
			elseif ($row->type=='textarea'){
				$object->set('value', $values[$i]);
				$object->set('editor', $editor[$i]);
			}
			else {
				$object->set('value', $values[$i]);
			}


			$object->set('target', $target[$i]);
			unset($object->_errors);
			$objects[] = $object;
		}


		require_once(JPATH_COMPONENT.DS.'lib'.DS.'JSON.php');
		$json=new Services_JSON;
		$row->value=$json->encode($objects);

		if (!$row->check()) {
			$mainframe->redirect('index.php?option=com_k2&view=extraField&cid='.$row->id, $row->getError(), 'error');
		}

		if (!$row->store()) {
			$mainframe->redirect('index.php?option=com_k2&view=extraFields', $row->getError(), 'error');
		}

		$params = &JComponentHelper::getParams('com_k2');
		if(!$params->get('disableCompactOrdering'))
			$row->reorder("`group` = {$row->group}");

		$cache = & JFactory::getCache('com_k2');
		$cache->clean();

		switch(JRequest::getCmd('task')) {
			case 'apply':
			$msg = JText::_('Changes to Extra Field saved');
			$link = 'index.php?option=com_k2&view=extraField&cid='.$row->id;
			break;
			case 'save':
			default:
			$msg = JText::_('Extra Field Saved');
			$link = 'index.php?option=com_k2&view=extraFields';
			break;
		}

		$mainframe->redirect($link, $msg);
	}

	function getExtraFieldsByGroup($group){

		$db = & JFactory::getDBO();
		$group = (int)$group;
		$query = "SELECT * FROM #__k2_extra_fields WHERE `group`={$group} AND published=1 ORDER BY ordering";
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return $rows;
	}

	function renderExtraField($extraField,$itemID=NULL){

		$mainframe = &JFactory::getApplication();
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'JSON.php');
		$json=new Services_JSON;

		if (!is_null($itemID)){
			$item = & JTable::getInstance('K2Item', 'Table');
			$item->load($itemID);
		}

		$defaultValues=$json->decode($extraField->value);

		foreach ($defaultValues as $value){
			if ($extraField->type=='textfield' || $extraField->type=='csv' || $extraField->type=='labels')
				$active=$value->value;
			else if ($extraField->type=='textarea'){
				$active[0]=$value->value;
				$active[1]=$value->editor;
			}
			else if($extraField->type=='link'){
				$active[0]=$value->name;
				$active[1]=$value->value;
				$active[2]=$value->target;
			}
			else
				$active='';
		}

		if (isset($item)){
			$currentValues=$json->decode($item->extra_fields);
			if (count($currentValues)){
				foreach ($currentValues as $value){
					if ($value->id==$extraField->id){
						if($extraField->type=='textarea'){
							$active[0]=$value->value;
						}
						else
							$active=$value->value;
					}

				}
			}

		}

		switch ($extraField->type){

			case 'textfield':
			$output='<input type="text" name="K2ExtraField_'.$extraField->id.'" value="'.$active.'"/>';
			break;

			case 'labels':
			$output='<input type="text" name="K2ExtraField_'.$extraField->id.'" value="'.$active.'"/> '.JText::_('Comma separated values');
			break;			
			
			case 'textarea':
			if($active[1]){
				$output='<textarea name="K2ExtraField_'.$extraField->id.'" id="K2ExtraField_'.$extraField->id.'" rows="10" cols="40" class="k2ExtraFieldEditor">'.$active[0].'</textarea>';
			}
			else{
				$output='<textarea name="K2ExtraField_'.$extraField->id.'" rows="10" cols="40">'.$active[0].'</textarea>';
			}

			break;

			case 'select':
			$output=JHTML::_('select.genericlist', $defaultValues, 'K2ExtraField_'.$extraField->id, '', 'value', 'name',$active);
			break;

			case 'multipleSelect':
			$output=JHTML::_('select.genericlist', $defaultValues, 'K2ExtraField_'.$extraField->id.'[]', 'multiple="multiple"', 'value', 'name',$active);
			break;

			case 'radio':
			$output=JHTML::_('select.radiolist', $defaultValues, 'K2ExtraField_'.$extraField->id, '', 'value', 'name',$active);
			break;

			case 'link':
			$output='<label>'.JText::_('Text').'</label>';
			$output.='<input type="text" name="K2ExtraField_'.$extraField->id.'[]" value="'.$active[0].'"/>';
			$output.='<label>'.JText::_('URL').'</label>';
			$output.='<input type="text" name="K2ExtraField_'.$extraField->id.'[]" value="'.$active[1].'"/>';
			$output.='<label for="K2ExtraField_'.$extraField->id.'">'.JText::_('Open in').'</label>';
			$targetOptions[]=JHTML::_('select.option', 'same', JText::_('Same window'));
			$targetOptions[]=JHTML::_('select.option', 'new', JText::_('New window'));
			$targetOptions[]=JHTML::_('select.option', 'popup', JText::_('Classic javascript popup'));
			$targetOptions[]=JHTML::_('select.option', 'lightbox', JText::_('Lightbox popup'));
			$output.=JHTML::_('select.genericlist', $targetOptions, 'K2ExtraField_'.$extraField->id.'[]', '', 'value', 'text', $active[2]);
			break;

			case 'csv':
				$output = '<input type="file" name="K2ExtraField_'.$extraField->id.'[]"/>';

				if(is_array($active) && count($active)){
					$output.= '<input type="hidden" name="K2CSV_'.$extraField->id.'" value="'.htmlspecialchars($json->encode($active)).'"/>';
					$output.='<table class="csvTable">';
					foreach($active as $key=>$row){
						$output.='<tr>';
						foreach($row as $cell){
							$output.=($key>0)?'<td>'.$cell.'</td>':'<th>'.$cell.'</th>';
						}
						$output.='</tr>';
					}
					$output.='</table>';
					$output.='<label>'.JText::_('Delete CSV data').'</label>';
					$output.='<input type="checkbox" name="K2ResetCSV_'.$extraField->id.'"/>';
				}
			break;

		}

		return $output;

	}

	function getExtraFieldInfo($fieldID){

		$db = & JFactory::getDBO ();
		$fieldID = (int) $fieldID;
		$query="SELECT * FROM #__k2_extra_fields WHERE published=1 AND fieldID = ".$fieldID;
		$db->setQuery ($query,0,1);
		$row = $db->loadObject ();
		return $row;
	}

	function getSearchValue($id, $currentValue){

		$row = & JTable::getInstance('K2ExtraField', 'Table');
		$row->load($id);

		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'JSON.php');
		$json=new Services_JSON;
		$jsonObject=$json->decode($row->value);

		$value='';
		if ( $row->type=='textfield'|| $row->type=='textarea' || $row->type=='labels'){
			$value=$currentValue;
		}
		else if ($row->type=='multipleSelect'){
			foreach ($jsonObject as $option){
				if (in_array($option->value,$currentValue))
				$value.=$option->name.' ';
			}
		}
		else if ($row->type=='link'){
			$value.=$currentValue[0].' ';
			$value.=$currentValue[1].' ';
		}
		else {
			foreach ($jsonObject as $option){
				if ($option->value==$currentValue)
				$value.=$option->name;
			}
		}
		return $value;
	}

}
