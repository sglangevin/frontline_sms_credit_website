<?php
/**
 * @version		$Id: weblinks.php 10579 2008-07-22 14:54:24Z ircmaxell $
 * @package		com_blog
 * @copyright	Copyright (C) 2005 - 2009. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
  */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$mainframe->registerEvent( 'onSearch', 'plgSearchBlog' );
$mainframe->registerEvent( 'onSearchAreas', 'plgSearchBlogAreas' );

#JPlugin::loadLanguage( 'plg_search_Company' );

/**
 * @return array An array of search areas
 */
function &plgSearchBlogAreas() {
	static $areas = array(
		'blog' => 'Blog'
	);
	return $areas;
}

function plgSearchBlog( $text, $phrase='', $ordering='', $areas=null )
{
	$db		=& JFactory::getDBO();
	$user	=& JFactory::getUser();

	$searchText = $text;


	if (is_array( $areas )) {
		if (!array_intersect( $areas, array_keys( plgSearchBlogAreas() ) )) {
			return array();
		}
	}

	// load plugin params info
 	$plugin =& JPluginHelper::getPlugin('search', 'blog');
 	$pluginParams = new JParameter( $plugin->params );

	$limit = $pluginParams->def( 'search_limit', 50 );

	$text = trim( $text );
	if ($text == '') {
		return array();
	}
	$section 	= JText::_( 'Blog' );
	
	$wheres 	= array();
	switch ($phrase)
	{
		case 'exact':
			$text		= $db->Quote( $db->getEscaped( $text, true ), false );
			$wheres2 	= array();
			$wheres2[] 	= 'a.post_title  = '.$text;
 			$wheres2[] 	= 'a.post_desc  = '.$text;
			$wheres2[] 	= 'b.comment_title  = '.$text;
 			$wheres2[] 	= 'b.comment_desc  = '.$text;
			$where 		= '(' . implode( ') OR (', $wheres2 ) . ')';
			break;

		case 'all':
		case 'any':
		default:
			$words 	= explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word)
			{
				$word		= $db->Quote( '%'.$db->getEscaped( $word, true ).'%', false );
				$wheres2 	= array();
				$wheres2[] 	= 'a.post_title LIKE '.$word;
				$wheres2[] 	= 'a.post_desc LIKE '.$word;
				$wheres2[] 	= 'b.comment_title LIKE '.$word;
				$wheres2[] 	= 'b.comment_desc LIKE '.$word;
   				$wheres[] 	= implode( ' OR ', $wheres2 );
			}
			$where 	= '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
			break;
	}

	switch ( $ordering )
	{
		case 'oldest':
			$order = 'a.post_date ASC';
			break;

		case 'popular':
			$order = 'a.page_hits DESC';
			break;

		case 'alpha':
			$order = 'a.post_title ASC';
			break;

		case 'category':
			$order = 'a.post_title ASC';
			break;

		case 'newest':
		default:
			$order = 'a.post_date DESC';
	}

	$query = 'SELECT a.id, a.post_title AS title, a.post_date AS created, '
	. ' CONCAT_WS( " - ", b.comment_title, b.comment_desc) AS text,'
	. ' CONCAT_WS( " / ", '.$db->Quote($section).', a.post_title) AS section,'
	. ' "1" AS browsernav'
	. ' FROM #__blog_postings AS a LEFT JOIN #__blog_comment AS b ON a.id = b.post_id AND b.published = 1 '
	. ' WHERE ('. $where .')'
	. ' AND a.published = 1'
 	. ' ORDER BY '. $order
	;
	$db->setQuery( $query, 0, $limit );
	$rows = $db->loadObjectList();
	foreach($rows as $key => $row) {
		$rows[$key]->href = JRoute::_('index.php?option=com_blog&view=comments&pid='.$row->id, false);
 	}
	
	$return = array();
	foreach($rows AS $key => $weblink) {
		$return[] = $weblink;
	}
	return $return;
}
?>