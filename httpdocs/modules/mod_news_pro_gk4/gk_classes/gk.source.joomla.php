<?php

/**
* Joomla! news class
* @package Joomla!
* @Copyright (C) 2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.1 $
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

class NSP_GK4_Joomla_Source {	
	// Method to get sources of articles
	function getSources($config) {
		global $mainframe;
		//
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$aid = $user->get('aid', 0);
		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$noauth	= $contentConfig->get('show_noauth');
		// if source type is section / sections
		$source = false;
		$where1 = '';
		$where2 = '';
		//
		if($config['data_source'] == 'com_sections'){
			$source = $config['com_sections'];
			$where1 = ' c.section = ';
			$where2 = ' OR c.section = ';
		}elseif($config['data_source'] == 'com_categories'){
			$source = $config['com_categories'];
			$where1 = ' c.id = ';
			$where2 = ' OR c.id = ';
		}else{
			$source = strpos($config['com_articles'],',') !== false ? explode(',', $config['com_articles']) : $config['com_articles'];
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
				c.section AS SID, 
				c.title AS name
			FROM 
				#__categories AS c
			LEFT JOIN 
				#__content AS content 
				ON 
				c.id = content.catid 	
			WHERE 
				( '.$where.' ) 
				AND 
				c.published = 1'.((!$noauth && $config['unauthorized'] == 0) ? ' 
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
		//
		$sql_where = '';
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
		$content_iid = array();
		$content_cid = array();
		$content_title = array();
		$content_text = array();
		$content_images = array();
		$content_date = array();
		$content_date_publish = array();
		$content_author = array();
		$content_catname = array();
		$content_sid = array();
		$content_hits = array();
		$content_email = array();
		$content_rating_sum = array();
		$content_rating_count = array();
		$news_amount = 0;
		// Initializing standard Joomla classes and SQL necessary variables
		$db =& JFactory::getDBO();
		$user =& JFactory::getUser();
		$aid = $user->get('aid', 0);
		$contentConfig = &JComponentHelper::getParams( 'com_content' );
		$noauth	= $contentConfig->get('show_noauth');
		$date =& JFactory::getDate("now", $config['time_offset']);
		$now  = $date->toMySQL();
		$nullDate = $db->getNullDate();
		// Overwrite SQL query when user set IDs manually
		if($config['data_source'] == 'com_articles' && $config['com_articles'] != ''){
			// initializing variables
			$sql_where = '';
			$ids = explode(',', $config['com_articles']);
			//
			for($i = 0; $i < count($ids); $i++ ){	
				// linking string with content IDs
				$sql_where .= ($i != 0) ? ' OR content.id = '.$ids[$i] : ' content.id = '.$ids[$i];
			}
		}
		// if some data are available
		if(count($categories) > 0){
			// when showing only frontpage articles is disabled
			$frontpage_con = ($config['only_frontpage'] == 0) ? (($config['news_frontpage'] == 0) ? ' AND frontpage.content_id IS NULL ' : '' ) : (($config['news_frontpage'] == 0) ? ' AND frontpage.content_id = 10 ' : ' AND frontpage.content_id IS NOT NULL ' );
			$since_con = '';
			if($config['news_since'] !== '') $since_con = ' AND content.created >= ' . $db->Quote($config['news_since']);
			// Ordering string
			$order_options = '';
			// When sort value is random
			if($config['news_sort_value'] == 'random') {
				$order_options = ' RAND() '; 
			}else{ // when sort value is different than random
				if($config['news_sort_value'] != 'fordering') $order_options = ' content.'.$config['news_sort_value'].' '.$config['news_sort_order'].' ';
				else $order_options = ' frontpage.ordering '.$config['news_sort_order'].' ';
			}	
			// creating SQL query
			$query_news = '
			SELECT DISTINCT
				cats.title AS cat, 
				'.$config['username'].' AS author,
				users.email AS author_email,
				cats.section AS SID, 
				'.($config['use_title_alias'] ? 'content.alias' : 'content.title').' AS title, 
				content.introtext AS text, 
				content.created AS date, 
				content.publish_up AS date_publish,
			    content.images AS images, 
				content.id AS IID,
				content.hits AS hits,
				content_rating.rating_sum AS rating_sum,
				content_rating.rating_count AS rating_count,
				CASE WHEN CHAR_LENGTH(content.alias) 
					THEN CONCAT_WS(":", content.id, content.alias) 
						ELSE content.id END as ID, 
				CASE WHEN CHAR_LENGTH(cats.alias) 
					THEN CONCAT_WS(":", cats.id, cats.alias) 
						ELSE cats.id END as CID 					
			FROM 
				#__content AS content 
				LEFT JOIN 
					#__categories AS categories 
					ON categories.id = content.catid 
				
				LEFT JOIN 
					#__sections AS sections 
					ON sections.id = content.sectionid 
				LEFT JOIN 
					#__users AS users 
					ON users.id = content.created_by
				LEFT JOIN 
					#__content_frontpage AS frontpage 
					ON content.id = frontpage.content_id  			
				LEFT JOIN 
					#__categories AS cats 
					ON content.catid = cats.id 	
				LEFT JOIN 
					#__content_rating AS content_rating 
					ON content_rating.content_id = content.id
			WHERE 
				content.state = 1'.((!$noauth && $config['unauthorized'] == 0) ? ' 
					AND categories.access <= ' .(int) $aid . ' 
					AND content.access <= '.(int) $aid : '').' 
				 	AND categories.published = 1  
			 		AND ( content.publish_up = '.$db->Quote($nullDate).' OR content.publish_up <= '.$db->Quote($now).' )
					AND ( content.publish_down = '.$db->Quote($nullDate).' OR content.publish_down >= '.$db->Quote($now).' )
				AND ( '.$sql_where.' ) 
				'.$frontpage_con.' 
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
					$content_iid[] = $item->IID; // news IDs
					$content_cid[] = $item->CID; // news CIDs
					$content_title[] = $item->title; // news titles
					$content_text[] = $item->text; // news text
					$content_images[] = $item->images; // news images	
					$content_date[] = $item->date; // news dates
					$content_date_publish[] = $item->date_publish; // news dates
					$content_author[] = $item->author; // news author
					$content_catname[] = $item->cat; // news category name
					$content_sid[] = $item->SID; // news category section ID
					$content_hits[] = $item->hits; // news hits
					$content_email[] = $item->author_email; // news author emails
					$content_rating_sum[] = $item->rating_sum; // news rating sum
					$content_rating_count[] = $item->rating_count; // news rating count
					$news_amount++;	// news amount
				}
			}
		}
		// Returning data in hash table
		return array(
			"ID" => $content_id,
			"IID" => $content_iid,
			"CID" => $content_cid,
			"title" => $content_title,
			"text" => $content_text,
			"images" => $content_images,
			"date" => $content_date,
			"date_publish" => $content_date_publish,
			"author" => $content_author,
			"catname" => $content_catname,
			"SID" => $content_sid,
			"hits" => $content_hits,
			"email" => $content_email,
			"news_amount" => $news_amount,
			"rating_sum" => $content_rating_sum,
			"rating_count" => $content_rating_count
		);
	}
}
