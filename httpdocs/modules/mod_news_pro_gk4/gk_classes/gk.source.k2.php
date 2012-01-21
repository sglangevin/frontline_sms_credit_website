<?php

/**
* K2 Source class
* @package News Show Pro GK4
* @Copyright (C) 2009-2010 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 4.0.0 $
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

class NSP_GK4_K2_Source {
	// Method to get sources of articles
	function getSources($config) {
		global $mainframe;
		//
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$aid = $user->get('aid', 0);
		// if source type is section / sections
		$source = false;
		$where1 = '';
		$where2 = '';
		$tag_join= '';
		//
		if( $config['data_source'] == 'k2_tags' ) $tag_join = ' LEFT JOIN #__k2_tags_xref AS tx ON content.id = tx.itemID LEFT JOIN #__k2_tags AS t ON t.id = tx.tagID ';
		//
		if($config['data_source'] == 'k2_categories'){
			$source = $config['k2_categories'];
			$where1 = ' c.id = ';
			$where2 = ' OR c.id = ';
		} else if($config['data_source'] == 'k2_tags') {
            $where1 = ' t.id = ';
            // adding quotes to tag name
            $source = $config['k2_tags'];
		} else {
			$source = strpos($config['k2_articles'],',') !== false ? explode(',', $config['k2_articles']) : $config['k2_articles'];
			$where1 = ' content.id = ';
			$where2 = ' OR content.id = ';	
		}
		//	
		$where = ''; // initialize WHERE condition
		// generating WHERE condition
		for($i = 0;$i < count($source);$i++){
			if(count($source) == 1) $where .= ($i == 0) ? $where1.$source : $where2.$source;
			else $where .= ($i == 0) ? $where1.$source[$i] : $where2.$source[$i];		
		}
		//
		$query_name = '
			SELECT DISTINCT 
				c.id AS ID,  
				c.name AS name,
				c.alias AS alias 
			FROM 
				#__k2_categories AS c
			LEFT JOIN 
				#__k2_items AS content 
				ON 
				c.id = content.catid 
             '.$tag_join.' 
			WHERE 
				( '.$where.' ) 
				AND 
				c.published = 1'.(($config['unauthorized'] == 0) ? ' 
				AND 
				c.access <= ' .(int) $aid : '').';
		';
		// Executing SQL Query
		$db->setQuery($query_name);
		//
		return $db->loadObjectList();
	}
	// Method to get articles in standard mode 
	function getArticles($categories, $config, $amount) {	
		// mainframe
		global $mainframe;
		$sql_where = '';
		$tag_join = '';
		//
		if($categories) {				
			$j = 0;
			// getting categories ItemIDs
			foreach ($categories as $item) {
				$sql_where .= ($j != 0) ? ' OR content.catid = '.$item->ID : ' content.catid = '.$item->ID;
				$j++;
			}	
		}
		// Arrays for content
		$content_id = array();
		$content_alias = array();
		$content_cid = array();
		$content_title = array();
		$content_text = array();
		$content_date = array();
		$content_date_publish = array();
		$content_author = array();
		$content_cat_name = array();
		$content_cat_alias = array();
		$content_hits = array();
		$content_email = array();
		$content_authorid = array();
		$content_rating_sum = array();
		$content_rating_count = array();
		$news_amount = 0;
		// Initializing standard Joomla classes and SQL necessary variables
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$aid = $user->get('aid', 0);
		$date =& JFactory::getDate("now", $config['time_offset']);
		$now  = $date->toMySQL();
		$nullDate = $db->getNullDate();
		// Overwrite SQL query when user set IDs manually
		if($config['data_source'] == 'k2_articles' && $config['k2_articles'] != ''){
			// initializing variables
			$sql_where = '';
			$ids = explode(',', $config['k2_articles']);
			//
			for($i = 0; $i < count($ids); $i++ ){	
				// linking string with content IDs
				$sql_where .= ($i != 0) ? ' OR content.id = '.$ids[$i] : ' content.id = '.$ids[$i];
			}
		}
		// Overwrite SQL query when user specified tags
		if($config['data_source'] == 'k2_tags' && $config['k2_tags'] != ''){
			// initializing variables
			$sql_where = '';
			$tag_join = ' LEFT JOIN #__k2_tags_xref AS tx ON content.id = tx.itemID LEFT JOIN #__k2_tags AS t ON t.id = tx.tagID ';
			// getting tag
			$sql_where .= ' t.id = '. $config['k2_tags'];
		}		
		// if some data are available
		if(count($categories) > 0){
			// when showing only frontpage articles is disabled
			$featured_con = ($config['only_frontpage'] == 0) ? (($config['news_frontpage'] == 0) ? ' AND content.featured = 0 ' : '' ) : (($config['news_frontpage'] == 0) ? ' AND content.featured = 10 ' : ' AND content.featured = 1 ' );
			$since_con = '';
			if($config['news_since'] !== '') $since_con = ' AND content.created >= ' . $db->Quote($config['news_since']);
			// Ordering string
			$order_options = '';
			// When sort value is random
			if($config['news_sort_value'] == 'random') {
				$order_options = ' RAND() '; 
			}else{ // when sort value is different than random
				if($config['news_sort_value'] != 'fordering') $order_options = ' content.'.$config['news_sort_value'].' '.$config['news_sort_order'].' ';
				else $order_options = ' content.featured_ordering '.$config['news_sort_order'].' ';
			}	
			// creating SQL query
			$query_news = '
			SELECT DISTINCT
				cats.name AS cat_name,
				cats.alias AS cat_alias,
				content.catid AS cat_id,
				'.((($config['username'] != 2) ? 'users.'.(($config['username'] == 1) ? 'username':'name') : 'content.created_by_alias')) .' AS author, 
				users.email AS author_email,
				users.id AS author_id,
				'.($config['use_title_alias'] ? 'content.alias' : 'content.title').' AS title, 
				content.introtext AS text, 
				content.created AS date, 
				content.publish_up AS date_publish,
				content.id AS ID,
				content.alias AS alias,
				content.hits AS hits,
                content_rating.rating_sum AS rating_sum,
                content_rating.rating_count AS rating_count			
			FROM 
				#__k2_items AS content 
				LEFT JOIN 
					#__k2_categories AS cats
					ON cats.id = content.catid 
				LEFT JOIN 
					#__users AS users 
					ON users.id = content.created_by
                 '.$tag_join.' 	
                LEFT JOIN
                    #__k2_rating AS content_rating
                    ON content.id = content_rating.itemID	
			WHERE 
				content.trash = 0'.(($config['unauthorized'] == 0) ? ' 
					AND cats.access <= ' .(int) $aid . ' 
					AND content.access <= '.(int) $aid : '').'
					AND content.published = 1 
				 	AND cats.published = 1  
			 		AND ( content.publish_up = '.$db->Quote($nullDate).' OR content.publish_up <= '.$db->Quote($now).' )
					AND ( content.publish_down = '.$db->Quote($nullDate).' OR content.publish_down >= '.$db->Quote($now).' )
				AND ( '.$sql_where.' ) 
				'.$featured_con.' 
				'.$since_con.'
			ORDER BY 
				'.$order_options.'
			LIMIT
				'.($config['startposition']).','.($amount + (int)$config['startposition']).';
			';
			
			// run SQL query
			$db->setQuery($query_news);
			// when exist some results
			if($news = $db->loadObjectList()) {
				// generating tables of news data
				foreach($news as $item) {						
					$content_id[] = $item->ID; // news IDs
					$content_alias[] = $item->alias; // news aliases
					$content_cid[] = $item->cat_id; // news CIDs
					$content_title[] = $item->title; // news titles
					$content_text[] = $item->text; // news text
					$content_date[] = $item->date; // news dates
					$content_date_publish[] = $item->date_publish; // news dates
					$content_author[] = $item->author; // news author
					$content_cat_name[] = $item->cat_name; // news category name
					$content_cat_alias[] = $item->cat_alias; // news category alias
					$content_hits[] = $item->hits; // news hits
					$content_email[] = $item->author_email; // news author email
					$content_authorid[] = $item->author_id; // news author id
					$content_rating_sum[] = $item->rating_sum; // news rating sum
					$content_rating_count[] = $item->rating_count; // news rating count
					$news_amount++;	// news amount
				}
			}
		}
		// Returning data in hash table
		return array(
			"ID" => $content_id,
			"alias" => $content_alias,
			"CID" => $content_cid,
			"title" => $content_title,
			"text" => $content_text,
			"date" => $content_date,
			"date_publish" => $content_date_publish,
			"author" => $content_author,
			"cat_name" => $content_cat_name,
			"cat_alias" => $content_cat_alias,
			"hits" => $content_hits,
			"email" => $content_email,
			"author_id" => $content_authorid,
			"rating_sum" => $content_rating_sum,
			"rating_count" => $content_rating_count,
			"news_amount" => $news_amount
		);
	}
	
	// Method to get articles in standard mode 
	function getComments($content, $config) {
		// 
		$db =& JFactory::getDBO();
		$counters_tab = array();
		// 
		if(count($content) > 0) {
			// initializing variables
			$sql_where = '';
			$ids = $content['ID'];
			//
			for($i = 0; $i < count($ids); $i++ ) {	
				// linking string with content IDs
				$sql_where .= ($i != 0) ? ' OR content.id = '.$ids[$i] : ' content.id = '.$ids[$i];
			}
			// creating SQL query
			$query_news = '
			SELECT 
				content.id AS id,
				COUNT(comments.itemID) AS count			
			FROM 
				#__k2_items AS content 
				LEFT JOIN 
					#__k2_comments AS comments
					ON comments.itemID = content.id 		
			WHERE 
				comments.published
				AND ( '.$sql_where.' ) 
			GROUP BY 
				comments.itemID
			;';
			// run SQL query
			$db->setQuery($query_news);
			// when exist some results
			if($counters = $db->loadObjectList()) {
				// generating tables of news data
				foreach($counters as $item) {						
					$counters_tab['art'.$item->id] = $item->count;
				}
			}
		}
		
		return $counters_tab;
	}		
}

?>