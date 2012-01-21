<?php

(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

include_once(MY_COM_PATH . '/task/base.php');
/***
 * Show the search page
 */
 
class MyblogBloggersTask extends MyblogBaseController{
	
	function MyblogBloggersTask(){
		$this->toolbar = MY_TOOLBAR_BLOGGER;
	}
	
	function display(){
		return "List of all current bloggers";
	}
	
}
