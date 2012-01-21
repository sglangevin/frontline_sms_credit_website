<?php

(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

include_once(MY_COM_PATH . '/task/base.php');
/***
 * Show the search page
 */
 
class MyblogUsertagTask extends MyblogBaseController{
	function MyblogUsertagTask(){
	}
	
	function display(){
		return "<h1>List all entry with the given tag from the given user</h1>";
	}
}
