<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'browse.base.php' );

class MyblogTagTask extends MyblogBrowseBase
{
	var $category;
	
	function MyblogTagTask()
	{
		parent::MyblogBrowseBase();
		$this->toolbar = MY_TOOLBAR_HOME;
	}
	
	
	function _header()
	{
		echo parent::_header();
		
		$category		= JRequest::getVar( 'category' , '' , 'REQUEST' );

		if(is_numeric($category))
		{
			// Category is an integer. We know its Joomla's category
			$this->category = intval(urldecode( $category ));
	
			// Set main tag pathway
			myAddPathway( JText::_('Category') , JRoute::_('index.php?option=com_myblog&task=categories&Itemid='.myGetItemId()));
			
			// Set page title
			myAddPageTitle(htmlspecialchars(myGetJoomlaCategoryName($this->category)));
			
			// @todo: add to standard breadcrumb
			myAddPathway(htmlspecialchars(myGetJoomlaCategoryName($this->category)));

		}
		else
		{
			// Category is not an integer. We know its the tags.
			$this->category = strval(urldecode( $category ) );
			$this->category = str_replace("+", " ", $category);

			// Set main tag pathway
			myAddPathway( JText::_('Tags') , JRoute::_('index.php?option=com_myblog&task=categories&Itemid='.myGetItemId()));
			
			// Set page title
			myAddPageTitle(htmlspecialchars(myGetTagName($this->category)));
			
			// @todo: add to standard breadcrumb
			myAddPathway(htmlspecialchars(myGetTagName($this->category)));
		}
	}
	
	function setData()
	{
		$searchby = array();
		
		if(is_numeric($this->category))
			$searchby['jcategory'] = $this->category;
		else
			$searchby['category'] = $this->category;
		
		$this->filters = $searchby;	
	}
	
}
