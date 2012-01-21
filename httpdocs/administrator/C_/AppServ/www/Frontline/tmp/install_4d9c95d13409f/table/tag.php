<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class myblogTag extends JTable
{
	var $id = 0;
	var $name;
	var $slug;
	var $default;
	
	function __construct( &$db )
	{
		parent::__construct('#__myblog_categories','id', $db);
	}
	
	// a tag might be loaded via id, name or the slug, in that order
	function load($tag){
		
		if(is_numeric($tag)){
			parent::load($tag);
		} else {
			// search via the name 
			
			// search their slug
		}
	}
	
	// Store the tag in db
	function store(){
		// If the slug is empty, create it
		if(empty($this->slug)){
			$this->getSlug();
		}
		parent::store();
	}
	
	// Return the tag slug. If it is empty, create one and return the correct
	// one
	function getSlug(){
		if(empty($this->slug)){
			$this->slug = $this->_prepSlug($this->getName());
			
			// If this is existing slug, we need to update the database
			if($this->id != 0){
				//$this->store();
				parent::store();
			}
		}
		
		return $this->slug;
	}
	
	
	// Return slug name
	function getName(){
		return $this->name;
	}
	
	// Set the new slug name, make sure no duplicates
	// return false if it fails
	function setSlug($slug)
	{
		$db			=& JFactory::getDBO();
		$newslug = $this->_prepSlug($slug);
		
		if($newslug == '')
			return false;
		
		$strSQL	= "SELECT COUNT(*) FROM `#__myblog_categories` WHERE `slug`='{$newslug}'";
		$db->setQuery( $strSQL );
		
		if( $db->loadResult() <= 0)
		{
			$this->slug = $newslug;
			return true;
		}
		
		return false;
	}	
	
	// Set the tag name,
	// return true if succeed
	function setName($name)
	{
		$db		=& JFactory::getDBO();
		$strSQL	= "SELECT COUNT(*) FROM `#__myblog_categories` WHERE `name`='{$name}'";
		$db->setQuery( $strSQL );
		
		if($db->loadResult() <= 0)
		{
			$strSQL	= "UPDATE #__myblog_categories SET `name`='{$name}' WHERE `id`='{$this->id}'";
			$db->setQuery( $strSQL );
			$db->query();
			$this->name = $name;

			return true;
		}
		return false;
	}
	
	/**
	 * Set the tag as the default tag
	 **/	 	
	function setDefault($status = '1')
	{
		$this->default = $status;
		return true;
	}
	
	// Prep the given slug. If slug is not yet available, use the tagname,
	// static 
	function _prepSlug($newtag)
	{
		$db	=& JFactory::getDBO();

		# Remove unwanted characters
		$newtag = preg_replace('/[`~!@#$%\^&*\(\)\+=\{\}\[\]|\\<">,\\/\^\*;:\?\'\\\]/', '', $newtag);

		# UTF8 to ISO 8859
// 		$newtag = preg_replace("/([\xC2\xC3])([\x80-\xBF])/e", "chr(ord('\\1')<<6&0xC0|ord('\\2')&0x3F)", $newtag);
		$newtag = trim($newtag);

		return $newtag;
	}
}
