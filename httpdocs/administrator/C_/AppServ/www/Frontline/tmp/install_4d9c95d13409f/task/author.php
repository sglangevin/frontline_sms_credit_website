<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'browse.base.php' );

class MyblogAuthorTask extends MyblogBrowseBase
{
	var $author = null;
	var $authorId = 0;
	
	function MyblogAuthorTask()
	{
		parent::MyblogBrowseBase();
		$this->toolbar = MY_TOOLBAR_BLOGGER;

		$authorId	= JRequest::getVar( 'blogger' , '' , 'REQUEST' );
		$authorId	= is_string($authorId) ? myGetAuthorId(urldecode($authorId)) : intval($authorId); 
		
		$this->authorId = $authorId;
		
		$this->author	=& JTable::getInstance( 'Blogger' , 'Myblog' );
		$this->author->load($authorId);
	}
	
	function _header()
	{
		$html = parent::_header();

		return $html;
	}
		
	function setData()
	{
		$searchby = array(); 
		$searchby['authorid'] = $this->authorId;
		
		// Request might contain 'category'
		$category	= JRequest::getVar( 'category' , '' , 'REQUEST' );
		if( !empty( $category ) )
		{
			$category = strval(urldecode( $category ));
			$category = str_replace("+", " ", $category);
			$searchby['category'] = $category;
		}
		
		$this->filters = $searchby;		
	}
}
