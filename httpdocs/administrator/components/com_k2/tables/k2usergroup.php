<?php
/**
 * @version		$Id: k2usergroup.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableK2UserGroup extends JTable {

	var $id = null;
	var $name = null;
	var $permissions = null;

	function __construct( & $db) {
	
		parent::__construct('#__k2_user_groups', 'id', $db);
	}

	function check() {
	
		if (trim($this->name) == '') {
			$this->setError(JText::_('Group cannot be empty'));
			return false;
		}
		return true;
	}

	function bind($array, $ignore = '') {
		
		if (key_exists('params', $array) && is_array($array['params'])) {
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			if(JRequest::getVar('categories')=='all' || JRequest::getVar('categories')=='none')
			$registry->setValue('categories',JRequest::getVar('categories'));
			$array['permissions'] = $registry->toString();
		}
		return parent::bind($array, $ignore);
	}

}
