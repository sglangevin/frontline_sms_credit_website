<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

include_once(MY_COM_PATH . '/task/base.php');

class MyblogCategoriesTask extends MyblogBaseController
{	
	function MyblogCategoriesTask()
	{
		$this->toolbar = MY_TOOLBAR_TAGS;
	}
	
	function display($styleid = '', $wrapTag = 'div')
	{
		$mainframe	=& JFactory::getApplication();
		
		if(empty($styleid))
		{
			myAddPageTitle( JText::_('SHOW TAGS TITLE') );
		}
		
		$subWrap = 'li';
		if($wrapTag == 'ul')
		{
			$subWrap= 'li';
		}
		else
		{
			$subWrap = '';
		}

		$blogger	= JRequest::getVar( 'blogger' , '' , 'GET' );
		$mbItemid	= myGetItemId();
		$content = '<'.$wrapTag.' class="blog-tags" '.$styleid.'>';
		$query = "SELECT c.slug, c.name, count(c.name) frequency FROM #__myblog_categories c,#__myblog_content_categories c2 where c.id=c2.category GROUP BY c.name ORDER BY frequency ASC";
		$categoriesArray = myGetTagClouds($query, 8);
		$categories = "";
		
		if ($categoriesArray)
		{
			foreach ($categoriesArray as $category)
			{
				$catclass = "tag" . $category['cloud'];
				$catname = $category['name'];
				$tagSlug	= $category['slug'];
				$tagSlug	= ($tagSlug == '') ? $category['name'] : $category['slug'];
				$tagSlug	= urlencode($tagSlug);
			
				if(!empty($subWrap))
				{
					$categories .= "<{$subWrap} class=\"$catclass\">";
					
					if(isset($blogger) && !empty($blogger))
					{
						$categories .= "<a href=\"" . JRoute::_("index.php?option=com_myblog&category=" . $tagSlug . "&blogger=$blogger&Itemid=$mbItemid") . "\">$catname</a> ";
					} else {
						$categories .= "<a href=\"" . JRoute::_("index.php?option=com_myblog&task=tag&category=" . $tagSlug . "&Itemid=$mbItemid") . "\">$catname</a> ";
					}			
					$categories .= "</$subWrap>";
				}
				else
				{
					if(isset($blogger) && !empty($blogger))
					{
						$categories .= "<a class=\"$catclass\" href=\"" . JRoute::_("index.php?option=com_myblog&category=" . $tagSlug . "&blogger=$blogger&Itemid=$mbItemid") . "\">$catname</a> ";
					}
					else
					{
						$categories .= "<a class=\"$catclass\" href=\"" . JRoute::_("index.php?option=com_myblog&task=tag&category=" . $tagSlug . "&Itemid=$mbItemid") . "\">$catname</a> ";
					}
					
				}
			}
		}

		$content .= trim($categories, ",");
		$content .= "</{$wrapTag}>";
		return $content;
	}
	
}
