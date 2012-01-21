<?php
/**
* @version		$Id: router.php 10752 2008-08-23 01:53:31Z eddieajau $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

function blogBuildRoute(&$query)
{
	$segments = array();

	if(isset($query['view']))
	{
		if(empty($query['Itemid'])) {
			$segments[] = $query['view'];
		} else {
			$menu = &JSite::getMenu();
			$menuItem = &$menu->getItem( $query['Itemid'] );
			if(!isset($menuItem->query['view']) || $menuItem->query['view'] != $query['view']) {
				$segments[] = $query['view'];
			}
		}
		unset($query['view']);
	}
	if(isset($query['task'])) {
 		if(!empty($query['Itemid'])) {
			$segments[] = $query['task'];
			unset($query['task']);
		}
	};
	
	if(isset($query['bn'])) {
 		if(!empty($query['Itemid'])) {
			$segments[] = $query['bn'];
			unset($query['bn']);
		}
	};
	
	if(isset($query['pid'])) {
 		if(!empty($query['Itemid'])) {
			$segments[] = $query['pid'];
			unset($query['pid']);
		}
	};
	if(isset($query['st'])) {
 		if(!empty($query['Itemid'])) {
			$segments[] = $query['st'];
			unset($query['st']);
		}
	};
	
   	return $segments;
}

function blogParseRoute($segments)
{
	$vars = array();

	//Get the active menu item
	$menu =& JSite::getMenu();
	$item =& $menu->getActive();
 	$count = count($segments);
 	
  	if( $segments[0] == 'comments'){
		$vars['view'] = $segments[0];
		$vars['pid'] = $segments[$count-1];
  	}
	
	if( $segments[0] == 'addpost'){
		$vars['view'] = $segments[0];
		$vars['pid'] = $segments[$count-1];
  	}
	
	if( $segments[0] == 'blogger'){
 		$vars['view'] = $segments[0];
		$vars['bn'] = $segments[$count-1];
   	}
	
	if( $segments[0] == 'myposts'){
		if($count==4){
			$vars['view'] = $segments[0];
			$vars['task']    = $segments[$count - 3];
			$vars['pid'] = $segments[$count-2];
			$vars['st'] = $segments[$count-1];
		}if($count==2){
			$vars['view'] = $segments[0];
			$vars['task']    = $segments[$count - 1];
 		} else{
			$vars['view'] = 'myposts';
  		}	
  
  
  	}
  	return $vars;
}

?>