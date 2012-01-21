<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filesystem.file' );

# Return an array of entries based on the given search paramaters 
function mb_get_entries(&$searchby)
{
	$db			=& JFactory::getDBO();
	$mainframe	=& JFactory::getApplication();
	
	$limit 		= isset($searchby['limit']) 	 ? intval($searchby['limit']): 10;
	$limitstart = isset($searchby['limitstart']) ? intval($searchby['limitstart']): 0;
	$jcategory 	= isset($searchby['jcategory'])  ? intval($searchby['jcategory']): 0;
	
	$authorid 	= isset($searchby['authorid']) 	 ? $db->getEscaped($searchby['authorid']): "";
	$category 	= isset($searchby['category']) 	 ? $db->getEscaped($searchby['category']): "";
	$search 	= isset($searchby['search']) 	 ? $db->getEscaped($searchby['search']): "";
	$archive 	= isset($searchby['archive']) 	 ? $db->getEscaped($searchby['archive']): "";
	
	 
	// & $total, $limit = 10, $limitstart = 0, $authorid = "0", $category = "", $search = "", $archive=""
	global $sectionid, $_MY_CONFIG;
	
	$sections       = $_MY_CONFIG->get('managedSections');
	$selectMore		= "";
	$searchWhere	= "";
	$primaryOrder	= "";
	$use_tables		= "";
	
	#search by tags
	if (!empty ($category) && empty($jcategory))
	{
		$categoriesArray = explode(",", $category);
		$categoriesList = "0";
		foreach ($categoriesArray as $mycat)
		{
			$mycat	= $db->getEscaped( trim( $mycat ) );

			// Use LIKE tag search since we might get confused with  space and dash 
			// get mixed up
			$mycat = str_replace(' ', '%', $mycat);
			$db->setQuery("SELECT id FROM #__myblog_categories WHERE name LIKE '$mycat' OR `slug` LIKE '{$mycat}'");
			$searchCategoryId = $db->loadResult();
			
			if ($searchCategoryId)
			{
				$categoriesList .= ",";
				$categoriesList .= "$searchCategoryId";
			}
		}
		
		$use_tables .= ",#__myblog_categories as b,#__myblog_content_categories as c ";
		$searchWhere .= " AND (b.id=c.category AND c.contentid=a.id AND b.id IN ($categoriesList)) ";
	}
	
	# seach by joomla category
	if (!empty ($jcategory) && $jcategory > 0)
	{		
		$searchWhere .= " AND (a.catid='$jcategory') ";
	}
	
	# search  by blogger
	if (!empty ($authorid) or $authorid == "0")
	{
		$searchWhere .= " AND a.created_by IN ($authorid)";
	}
	
	# search keywords
	if (!empty ($search))
	{
		$searchWhere .= " AND match (a.title,a.fulltext,a.introtext) against ('$search' in BOOLEAN MODE) ";
	}
	
	# display entries for a specific month/year
	if (!empty ($archive))
	{
		$searchWhere .= " AND a.created BETWEEN '$archive' AND date_add('$archive', INTERVAL 1 MONTH) ";
	}
	
	$date	=& JFactory::getDate();
	
	$query = " SELECT count(*) FROM #__content as a,#__myblog_permalinks as p $use_tables WHERE a.state=1 and a.publish_up < '" . $date->toMySQL() . "' and a.sectionid in ($sections) and a.id=p.contentid $searchWhere";
	$db->setQuery($query);
	$total = $db->loadResult();
	$searchby['total'] = $total;

	// New version, no permalink joins
	$query = " SELECT a.*, round(r.rating_sum/r.rating_count) as rating, r.rating_count $selectMore 
		FROM (#__content as a $use_tables ) 
			left outer join #__content_rating as r 
				on (r.content_id=a.id) 
		WHERE a.state=1 and a.publish_up < '" . $date->toMySQL() . "' 
			and a.sectionid in ($sections) 
			$searchWhere ORDER BY $primaryOrder a.created DESC,a.id DESC LIMIT $limitstart,$limit";

	$db->setQuery($query);

	$rows = $db->loadObjectList();
	
	// Add permalinks to the data
	if($rows AND count($rows) > 0)
	{
		$url	= rtrim( JURI::root() , '/' );

		for($i = 0; $i < count($rows); $i++ )
		{
			$rows[$i]->permalink = myGetPermalinkUrl($rows[$i]->id);
			
			//Change all relative url to absolute url
			$rows[$i]->introtext = str_replace('src="images', 'src="'. $url .'/images', $rows[$i]->introtext );
			$rows[$i]->fulltext = str_replace('src="images', 'src="'. $url .'/images',  $rows[$i]->fulltext );
		}
	}
	
	return $rows;
	
}
