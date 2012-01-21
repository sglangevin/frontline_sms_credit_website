<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

function MyblogBuildRoute( &$query )
{
	global $mainframe, $option;
	$segments = array();
	$admintask = array(
		'adminhome',
		'bloggerpref',
		'bloggerstats',
		'showcomments',
		'delete');
		
	$endWithSlash = array(
		'rss', 'feed', 'tags', 'search', 'archive');

	// default article view
	if (isset($query['show'])) {
		$query['task'] = $query['show'];
		unset($query['show']);
	}
	
	if (isset($query['task']) && $query['task'] != 'tag') {
		// For task == categories, we rename it as 'tags' to get a nicer
		// url
		if($query['task'] == 'categories'){
			$query['task'] = 'tags';
		}
		
		if($query['task'] == 'rss'){
			$query['task'] = 'feed';
		}
		
		/** front-end admin **/
		// Adminhome
		if(in_array($query['task'], $admintask)){	
			if (isset($query['amp;Itemid'])) {
				unset($query['amp;Itemid']);
			}
		}
		
		// If 'Add suffix to URLs' is enabled in Joomla 1.5, remove the
		// .html in the permalink
		if($mainframe->getCfg('sef') && $mainframe->getCfg('sef_suffix')){
			if(strlen($query['task']) > 5 && (substr($query['task'], -5) == '.html')){
				$query['task'] = substr($query['task'], 0, -5);
			}
		}
		
		if(in_array($query['task'], $endWithSlash) || 
			in_array($query['task'], $admintask)){
			
			$query['task'] .= '/';
		}
		
		$segments[] = $query['task'];
		unset($query['task']);
		
		// any additonal param?
		
	} else
	
	// Tags view
	if (isset($query['category'])) {
		$segments[] = 'tags';
		// Convert all spaces to + sign
		$query['category'] = str_replace(' ', '-', $query['category']);
		$segments[] = $query['category'] . '/';
		unset($query['category']);
		if(isset($query['task'])) unset($query['task']);
	} else
	
	// Archive view
	if (isset($query['archive'])) {
		$segments[] = 'archive';
		$segments[] = $query['archive'] .'/';
		unset($query['archive']);
	} else
	
	// Blogger
	if (isset($query['blogger'])) {
		$segments[] = 'blogger';
		$segments[] = $query['blogger'] .'/';
		unset($query['blogger']);
	}
	
	
	// Additional 2nd segment parameters
	if(in_array('delete', $segments)){
		$segments[] = $query['id'];
		unset($query['id']);
	}
	
// 	if(isset($query['start'])){
// 	    $segments[] = 'cpage/' . $query['start'];
// 	    unset($query['start']);
// 	}
	
	return $segments;
}

/**
 * @param	array
 * @return	array
 */
function MyblogParseRoute( $segments )
{
	$vars = array();
	//print_r($segments);

	$admintask = array(
		'adminhome',
		'bloggerpref',
		'bloggerstats',
		'showcomments');
	
	$actions    = array(
	                        'cpage',
	                        'tags',
	                        'archive',
	                        'feed',
	                        'search',
						);
	if(isset($segments[0])){
		for($i = 0; $i < count($segments); $i++){
			if(strlen($segments[$i]) > 5 && substr($segments[$i], -5) == '.html'){
				$segments[$i] = substr($segments[$i], 0, -5);
			}
		}
		
		if($segments[0] == 'tags' && !isset($segments[1])){
			$vars['task'] = 'categories';
		} else
		
		if($segments[0] == 'tags' && isset($segments[1])){
			$vars['task']	= 'tag';
			$segments[1] = str_replace(':', '-', $segments[1]); // J1.5
			$segments[1] = str_replace('-', ' ', $segments[1]);
			$vars['category'] = $segments[1];
		} else
		
		if($segments[0] == 'archive' && isset($segments[1])){
			$vars['archive'] = $segments[1];
		} else 
		
		if($segments[0] == 'delete'){
			$vars['task'] = 'delete';
		} else 
		
		if($segments[0] == 'blogger' && isset($segments[1])){
			$vars['blogger'] = $segments[1];
		} else
		
		if($segments[0] == 'feed'){
			$vars['task'] = 'rss';
		}else
		
		if($segments[0] == 'search'){
			$vars['task'] = 'search';
		} else if(myIsPermalink($segments[0])){
            // default show view
			$vars['show'] = $segments[0];
		} 
		
		/** front-admin **/
		if(in_array($segments[0], $admintask) || empty($vars)){
			$vars['task'] = $segments[0];
		} 
		
	}

	return $vars;
}

// Check if the given url is a permalink or not
function myIsPermalink(&$inUrl)
{
	$db		=& JFactory::getDBO();
	
	$inUrl	= str_replace( ' ' , '+' , $inUrl );
	$url = $inUrl;

	if(!strpos($url, '.html')){
		$url .= '.html';
	}

	
	$url = $db->getEscaped($url);
	checkRedirect( $url );
	$db->setQuery("SELECT count(*) from #__myblog_permalinks WHERE `permalink`='$url'");
	$isexist = $db->loadResult();
	
	if(!$isexist )
	{
		// Somehow Joomla tries to convert the first - to : 
		$pos = strpos($url, ':');
		if($pos)
		{
			$url[$pos] = '-';
		}
		checkRedirect( $url );
				
		$db->setQuery("SELECT count(*) from #__myblog_permalinks WHERE `permalink`='$url'");
		$isexist = $db->loadResult();
	}
	
	if($isexist)
	{
		$inUrl = $url;
	}
	
	return $isexist;
}

/**
 * Checks if the current url is set in the #__myblog_redirect table to redirect old
 * urls.
 **/ 
function checkRedirect( $url )
{
	$mainframe	=& JFactory::getApplication();
	$db		=& JFactory::getDBO();
	
	$query	= 'SELECT * FROM ' . $db->nameQuote( '#__myblog_redirect' ) . ' '
			. 'WHERE ' . $db->nameQuote( 'permalink' ) . '=' . $db->Quote( $url );
	
	$db->setQuery( $query );
	
	$permalink	= $db->loadObject();

	// If its an older permalink, then we should do a 301 redirect.
	if( $permalink )
	{
		$id			= $permalink->contentid;
		
		$query	= 'SELECT ' . $db->nameQuote( 'permalink' ) . ' FROM ' . $db->nameQuote( '#__myblog_permalinks' )
				. 'WHERE ' . $db->nameQuote('contentid') . '=' . $db->Quote( $permalink->contentid );
		$db->setQuery( $query );
		
		$link	= $db->loadResult();
		
		$url		= JRoute::_('index.php?option=com_myblog&show=' . $link , false );
		$mainframe->redirect( $url );
		exit;
	}
}
