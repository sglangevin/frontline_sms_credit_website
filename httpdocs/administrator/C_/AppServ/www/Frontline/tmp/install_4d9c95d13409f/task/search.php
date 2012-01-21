<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'base.php' );
require_once( MY_LIBRARY_PATH . DS . 'plugins.php' );

/***
 * Show the search page
 */ 
class MyblogSearchTask extends MyblogBaseController
{
	var $_resultLength	= 250;
	var $_plugins		= null;
	
	function MyblogSearchTask()
	{
		$this->toolbar	= MY_TOOLBAR_SEARCH;
		$this->_plugins	= new MYPlugins();
	}
	
	function display()
	{
		global $Itemid,$MYBLOG_LANG, $_MY_CONFIG;
		
		$mainframe	=& JFactory::getApplication();
		$my			=& JFactory::getUser();
		myAddPageTitle( JText::_( 'SEARCH BLOG ENTRY TITLE') );

		$template	= new AzrulJXCachedTemplate(time() . $my->usertype . $_MY_CONFIG->get('template'));
		
		$blogger		= JRequest::getVar('blogger','','POST');
		$keyword		= JRequest::getVar('keyword','','POST');
		$tags			= JRequest::getVar('tags','','POST');

		// Display form for user
		$searchURL	= JRoute::_('index.php?option=com_myblog&task=search&Itemid=' . myGetItemId());
		
		$template->set('searchURL', $searchURL);
		$template->set('Itemid', myGetItemId());
		$results	= false;
		if((!empty($blogger) && isset($blogger))|| (!empty($keyword) && isset($keyword)) || (!empty($tags) && isset($tags)) )
		{
			// Post action, perform search
			$results	= $this->_search(array('blogger' => $blogger, 'keyword' => $keyword, 'tags' => $tags));
		}
		$template->set('blogger', $blogger);
		$template->set('keyword', $keyword);
		$template->set('tags', $tags);
		$template->set('results', $results);
		$content	= $template->fetch($this->_getTemplateName('search'));
		
		return $content;
	}
	
	/**
	 * _search
	 * params: $filter (assoc array)
	 **/	 	 	
	function _search($filter)
	{
		global $_MY_CONFIG;
		
		$db			=& JFactory::getDBO();
		$sections	= $_MY_CONFIG->get('managedSections');
		$query		= "SELECT DISTINCT a.* FROM #__content AS a, #__myblog_content_categories AS b";

		$blogger	= isset( $filter['blogger'] ) ? $db->getEscaped( $filter['blogger'] ) : '';
		$keyword	= isset( $filter['keyword'] ) ? $db->getEscaped( $filter['keyword'] ) : '';
		$tag		= isset( $filter['tags'] ) ? $db->getEscaped( $filter['tags'] ) : '';
		
		$query		.= (!empty( $filter['blogger']) || !empty( $filter['keyword']) || !empty( $filter['tags']) ) ? ' WHERE ' : '';
		


		if(!empty( $tag ))
		{
			$tagId	= myGetTagId( $tag );
			
			$query	.= ' b.category="' . $tagId . '" AND a.id=b.contentid';
		}
		
		if(!empty($blogger))
		{
			if( !empty( $tag ) )
			{
				$query	.= "AND a.created_by='" . myGetAuthorId($blogger) ."'";
			}
			else
			{
				$query	.= "a.created_by='" . myGetAuthorId($blogger) ."'";
			}
		}

		if(!empty($keyword))
		{
			if(!empty($blogger) || !empty( $tag ) )
			{
				$query		.= " AND (a.title LIKE '%{$keyword}%' "
							 . "OR a.introtext LIKE '%{$keyword}%' "
							 . "OR a.fulltext LIKE '%{$keyword}%')";
			}
			else
			{
				$query		.= "a.title LIKE '%{$keyword}%' "
							 . "OR (a.introtext LIKE '%{$keyword}%' "
							 . "OR a.fulltext LIKE '%{$keyword}%')";
			}
		}


		$query	.= " AND `sectionid` IN ({$sections})";
		$db->setQuery( $query );
		$results	= $db->loadObjectList();
		$this->_format($results);

		return $results;
	}
	
	function _format(&$rows)
	{
		global $_MY_CONFIG;

		// Load Plugins
		$this->_plugins->load();
		
		// Format results
		for($i =0; $i < count($rows); $i++){
			$row    =& $rows[$i];
			
			// Merge introtext and fulltext.
			$row->text		= $row->introtext . $row->fulltext;
			$row->text		= JString::substr($row->text, 0, $this->_resultLength) . '...';
			
			$row->user		= myGetAuthorName($row->created_by, $_MY_CONFIG->get('useFullName'));
			$row->user		= $row->user;
			$row->link		= myGetPermalinkURL($row->id);
			$row->userlink	= JRoute::_('index.php?option=com_myblog&blogger=' . myGetAuthorName($row->created_by));
			
			$date			=& JFactory::getDate( $row->created );
			$date->setOffSet( $_MY_CONFIG->get('dateFormat') );
			$row->date		= $date->toFormat();
		}
	}
}
