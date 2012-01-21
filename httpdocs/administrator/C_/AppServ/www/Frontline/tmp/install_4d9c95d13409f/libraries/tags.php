<?php
/**
 * MyBlog
 * @package MyBlog
 * @copyright (C) 2006 - 2008 by Azrul Rahim - All rights reserved!
 * @license Copyrighted Commercial Software
 **/
 
(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

class MYTags {
	
	var $_errMsg;
	var $tags; // array of tag
	var $insertId;
	
	
	/**
	 * Transform the new tag so that it is suitable to become a tag, remove
	 * invalid char etc..	 
	 */	 	
	function _prepNewtag($newtag)
	{
		
		# UTF8 to ISO 8859
		//$newtag = preg_replace("/([\xC2\xC3])([\x80-\xBF])/e", "chr(ord('\\1')<<6&0xC0|ord('\\2')&0x3F)", $newtag);
		$newtag = trim($newtag);

		return $newtag;
	}
	
	/**
	 * Fix tag to not contain any special characters
	 **/	 	
	function strip( $tag )
	{
		$tag = preg_replace('/[`~!@#$%\^&*\(\)\+=\{\}\[\]|\\<">,\\/\^\*;:\?\'\\\]/', '', $tag);
		
		return $tag;
	}
	
	function getTagCloud(){
	}
	
	/**
	 * Add a new tag. Return false if tag cannot be added
	 */	 	
	function add(&$newtag)
	{
		$addOk  = false;
		
		$db		=& JFactory::getDBO();
			
		// Tag can contain any words.
		$newtag	= $db->getEscaped( $newtag );
		
		// Slug should need to contain proper naming
		$slug	= $this->_prepNewTag($newtag);
		$slug	= $this->strip($slug);
		
		// Check if tag is valid.
		if($newtag == '' || $slug == '')
			return false;

		// Lookup the database to check if there are any existing same tag
		$strSQL     = "SELECT COUNT(*) FROM `#__myblog_categories` WHERE `name`='{$newtag}' OR `slug`='{$slug}'";
		$db->setQuery( $strSQL );
		$totalMatch = $db->loadResult();
	
		if($totalMatch == 0)
		{
		    // Do something;
			 
		    $strSQL = "INSERT INTO `#__myblog_categories` (`name`,`slug`) VALUES ('{$newtag}','{$slug}')";
		    $db->setQuery($strSQL);
		    $db->query();
		    
		    $this->insertId = $db->insertId();
		    $addOk = true;
		}
		else
		{
			// Set the insertId for existing tag.
			$strSQL	= "SELECT `id` FROM `#__myblog_categories` WHERE `name`='{$newtag}'";
			$db->setQuery($strSQL);
			$this->insertId	= $db->loadResult();
		}
		
		return $addOk;
	}
	
	/***
	 * Return the id of the last inserted
	 */	 	
	function getInsertId()
	{
		return $this->insertId;
	}
}
