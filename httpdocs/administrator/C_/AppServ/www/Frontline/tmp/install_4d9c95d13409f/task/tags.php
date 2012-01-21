<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'browse.base.php' );

class MyblogTagsTask extends MyblogBrowseBase
{
	function MyblogTagsTask()
	{
		parent::MyblogBrowseBase();
		$this->toolbar = MY_TOOLBAR_HOME;
	}
	
	function setData()
	{
		$searchby = array(); 
		
		$category	= JRequest::getVar( 'category' , '' , 'REQUEST' );

		// Request might contain 'category'
		if( !empty( $category ) )
		{
			$category	= strval( urldecode( $category ) );
			$category	= str_replace("+", " ", $category);

			$searchby['category'] = $category;
		}
		
		$this->filters = $searchby;	
	}
	
}
