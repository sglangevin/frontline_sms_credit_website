<?php
/**
 * @version		$Id: k2.php 548 2010-08-30 15:39:07Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$mainframe->registerEvent('onSearch', 'plgSearchItems');
$mainframe->registerEvent('onSearchAreas', 'plgSearchItemsAreas');

JPlugin::loadLanguage('plg_search_k2', JPATH_ADMINISTRATOR);

function & plgSearchItemsAreas() {
	static $areas = array('k2'=>'K2 Items');
	return $areas;
}

function plgSearchItems($text, $phrase = '', $ordering = '', $areas = null) {

	$mainframe = &JFactory::getApplication();

	$db = &JFactory::getDBO();
	$jnow = &JFactory::getDate();
	$now = $jnow->toMySQL();
	$nullDate = $db->getNullDate();
	$user = &JFactory::getUser();
	$access = $user->get('aid');
	$tagIDs = array();
	$itemIDs = array();

	require_once (JPATH_SITE.DS.'administrator'.DS.'components'.DS.'com_search'.DS.'helpers'.DS.'search.php');
	require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');

	$searchText = $text;
	if (is_array($areas)) {
		if (!array_intersect($areas, array_keys(plgSearchItemsAreas()))) {
			return array();
		}
	}

	$plugin = &JPluginHelper::getPlugin('search', 'k2');
	$pluginParams = new JParameter($plugin->params);

	$limit = $pluginParams->def('search_limit', 50);

	$text = JString::trim($text);
	if ($text == '') {
		return array();
	}

	$rows = array();

	if ($limit> 0){

		if($pluginParams->get('search_tags')){
			$tagQuery = JString::str_ireplace('*', '', $text);
			$words = explode(' ', $tagQuery);
			for($i=0; $i<count($words); $i++){
				$words[$i].= '*';
			}
			$tagQuery = implode(' ', $words);
			$tagQuery = $db->Quote($db->getEscaped($tagQuery, true), false);

			$query = "SELECT id FROM #__k2_tags WHERE MATCH(name) AGAINST ({$tagQuery} IN BOOLEAN MODE) AND published=1";
			$db->setQuery($query);
			$tagIDs = $db->loadResultArray();

			if(count($tagIDs)){
				JArrayHelper::toInteger($tagIDs);
				$query = "SELECT itemID FROM #__k2_tags_xref WHERE tagID IN (".implode(',',$tagIDs).")";
				$db->setQuery($query);
				$itemIDs = $db->loadResultArray();
			}
		}


		if($phrase=='exact'){
			$text = JString::trim($text,'"');
			$text = $db->Quote('"'.$db->getEscaped($text, true).'"', false);
		}
		else {
			$text = JString::str_ireplace('*', '', $text);
			$words = explode(' ', $text);
			for($i=0; $i<count($words); $i++){
				if($phrase=='all')
				$words[$i]= '+'.$words[$i];
				$words[$i].= '*';
			}
			$text = implode(' ', $words);
			$text = $db->Quote($db->getEscaped($text, true), false);
		}


		$query = "
		SELECT i.title AS title,
	    i.metadesc,
	    i.metakey,
	    c.name as section,
	    i.image_caption,
	    i.image_credits,
	    i.video_caption,
	    i.video_credits,
	    i.extra_fields_search,
	    i.created,
    	CONCAT(i.introtext, i.fulltext) AS text,
    	CASE WHEN CHAR_LENGTH(i.alias) THEN CONCAT_WS(':', i.id, i.alias) ELSE i.id END as slug,
    	CASE WHEN CHAR_LENGTH(c.alias) THEN CONCAT_WS(':', c.id, c.alias) ELSE c.id END as catslug
    	FROM #__k2_items AS i
    	INNER JOIN #__k2_categories AS c ON c.id=i.catid AND c.access <= {$access}
		WHERE (";
		if($pluginParams->get('search_tags') && count($itemIDs)){
			JArrayHelper::toInteger($itemIDs);
			$query.=" i.id IN (".implode(',',$itemIDs).") OR ";
		}
		$query.="MATCH(i.title, i.introtext, i.`fulltext`,i.extra_fields_search,i.image_caption,i.image_credits,i.video_caption,i.video_credits,i.metadesc,i.metakey) AGAINST ({$text} IN BOOLEAN MODE)
		)
		AND i.trash = 0
	    AND i.published = 1
	    AND i.access <= {$access}
	    AND c.published = 1
	    AND c.access <= {$access}
	    AND c.trash = 0
	    AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )
        AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )
	    GROUP BY i.id ";

		switch ($ordering) {
			case 'oldest':
				$query.= 'ORDER BY i.created ASC';
				break;

			case 'popular':
				$query.= 'ORDER BY i.hits DESC';
				break;

			case 'alpha':
				$query.= 'ORDER BY i.title ASC';
				break;

			case 'category':
				$query.= 'ORDER BY c.name ASC, i.title ASC';
				break;

			case 'newest':
			default:
				$query.= 'ORDER BY i.created DESC';
				break;
		}

		$db->setQuery($query, 0, $limit);
		$list = $db->loadObjectList();
		$limit -= count($list);

		if (isset($list)) {
			foreach ($list as $key=>$item) {
				$list[$key]->href = JRoute::_(K2HelperRoute::getItemRoute($item->slug, $item->catslug));

			}
		}
		$rows[] = $list;


	}

	$results = array();
	if (count($rows)) {
		foreach ($rows as $row) {
			$new_row = array();
			foreach ($row as $key=>$item) {
				$item->browsernav = '';
				$item->tag = $searchText;
				if (searchHelper::checkNoHTML($item, $searchText, array('text', 'title', 'metakey', 'metadesc', 'section', 'image_caption', 'image_credits', 'video_caption', 'video_credits', 'extra_fields_search', 'tag'))) {
					$new_row[] = $item;
				}
			}
			$results = array_merge($results, (array) $new_row);
		}
	}

	return $results;
}
