<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class MyblogAjaxuploadTask
{
	
	function display()
	{
		$this->myxAjaxUpload();
	}

	function myxAjaxUpload()
	{
		global $_MY_CONFIG;
		
		require_once( MY_LIBRARY_PATH . DS . 'imagebrowser.php' );
		
		$retVal	= array('error' => '', 'msg' => '' , 'source' => '');
		$resize	= JRequest::getVar( 'resize' , false , 'GET' );
		
		//check if there are files uploaded
		if( (isset($_FILES['fileToUpload']['error']) && $_FILES['fileToUpload'] == 0) 
		|| (!empty($_FILES['fileToUpload']['tmp_name']) && $_FILES['fileToUpload']['tmp_name'] != 'none'))
		{
			$browser	= new MYMediaBrowser();
			
			$retVal		= $browser->upload($_FILES['fileToUpload'], $resize);
		}
		else
		{
			$retVal['error'] = "No file has been uploaded.";
		}

		// Display JSON string to the caller
		echo "{";
		echo				"error: '" . $retVal['error'] . "',\n";


		// Test if 'source' index is set
		if( isset($retVal['source']) && !empty($retVal['source']))
		{
			echo				"msg: '" . $retVal['msg'] . "',\n";
			echo 				"source: '" . $retVal['source'] . "'\n";
		}
		else
		{
			echo				"msg: '" . $retVal['msg'] . "'\n";
		}
		
		echo "}";
		exit;
	}
	
	function execute()
	{
		$this->myxAjaxUpload();
	}
}
