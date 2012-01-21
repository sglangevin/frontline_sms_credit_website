<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'base.php' );
require_once( MY_LIBRARY_PATH . DS . 'avatar.php' );
require_once( MY_LIBRARY_PATH . DS . 'plugins.php' );
require_once( MY_COM_PATH . DS . 'table' . DS . 'content.php' );

class MyblogBrowseBase extends MyblogBaseController
{
	var $entries;
	var $totalEntries;
	var $filters;
	var $html;
	var $limit;
	var $limitstart;
	var $_plugins	= null;
	
	function MyblogBrowseBase()
	{
		global $_MY_CONFIG;
				
		parent::MyblogBaseController();

		$this->_plugins	= new MYPlugins();
		$this->toolbar = MY_TOOLBAR_HOME;
		$this->limit		= JRequest::getVar( 'limit' , $_MY_CONFIG->get('numEntry') , 'GET');
		$this->limitstart	= JRequest::getVar( 'limitstart' , 0 , 'GET' );
	}
	
	function _header()
	{
		return parent::_header();
	}
	
	function display()
	{
		global $_MY_CONFIG, $MYBLOG_LANG;

		if(!myAllowedGuestView('intro'))
		{
			$template		= new AzrulJXTemplate();
			$content		= $template->fetch($this->_getTemplateName('permissions'));
			return $content;
		}
		
		$my		=& JFactory::getUser();		
		myAddPageTitle( JText::_('ALL BLOG ENTRIES TITLE') );
		
		// Get the entries data
		$this->setData(); 
		$this->_getEntries($this->filters);
	
		$tpl = new AzrulJXCachedTemplate(time() . $my->usertype . $_MY_CONFIG->get('template'));
		$html = '';
		
		// Prepare the entries
		array_walk($this->entries, array($this, '_prepareData') );
		
		$entryArray = $tpl->object_to_array($this->entries);
		$tpl->set('entry', $entryArray);
		$tpl->set( 'categoryDisplay' , $_MY_CONFIG->get('categoryDisplay') );
		$tpl->set('showAnchor', $_MY_CONFIG->get('anchorReadmore') ? '#readmore' : '');
		unset($entryArray);
		
				
		$template = $this->_getTemplateName('index');
		$html = $tpl->fetch_cache($template);

		// Fix for IIS webservers that doesn't have REQUEST_URI
		if ( !isset($_SERVER['REQUEST_URI']) )
		{

			$_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'],1 );
		
			if (isset($_SERVER['QUERY_STRING']))
			{
				$_SERVER['REQUEST_URI'].='?'.$_SERVER['QUERY_STRING'];
			}
		}

		if(!isset($_SERVER['QUERY_STRING']))
		{
			$_SERVER['QUERY_STRING'] = ''; //new
		
			foreach($_GET as $key => $val){
				$_SERVER['QUERY_STRING'] .= $key . '=' . $val . '&';
			}
			$_SERVER['QUERY_STRING'] = rtrim($_SERVER['QUERY_STRING'] , '&');
		}
		
		// For page navigation
		$queryString = $_SERVER['QUERY_STRING'];
		$queryString = preg_replace("/\&limit=[0-9]*/i", "", $queryString);
		$queryString = preg_replace("/\&limitstart=[0-9]*/i", "", $queryString);
		
		$pageNavLink = $_SERVER['REQUEST_URI'];
		$pageNavLink = preg_replace("/\&limit=[0-9]*/i", "", $pageNavLink);
		$pageNavLink = preg_replace("/\&limitstart=[0-9]*/i", "", $pageNavLink);

		if ($this->totalEntries > $this->limit)
		{
			jimport( 'joomla.html.pagination' );
			$pageNav	= new JPagination( $this->totalEntries , $this->limitstart , $this->limit );
			$html .= '<div class="my-pagenav">' . $pageNav->getPagesLinks('index.php?' . $queryString) . '</div>';
		}
		
		return $html;	
	}
	
	function setData()
	{		
		$searchby = array();
		
		// Request might contain 'category'
		$category	= JRequest::getVar( 'category' , '' , 'REQUEST' );
		if( !empty( $category ) )
		{
			if(is_numeric($category))
			{
				$category = strval( urldecode( $category ) );
				$category = str_replace("+", " ", $category);
				$searchby['jcategory'] = $category;
			}
			else
			{
				$category = strval( urldecode( $category ) );
				$category = str_replace("+", " ", $category);
				$searchby['category'] = $category;
			}
		}

		$archive	= JRequest::getVar( 'archive' , '' , 'REQUEST' );
		if ( !empty( $archive ) )
		{
			$archive = urldecode( $archive );

			// Joomla 1.5 might convert the '-' to ':'
			$archive = str_replace(':', '-', $archive);
			$archive = date("Y-m-d 00:00:00", strtotime(str_replace("-", " ", "01 " . $archive)));
			$searchby['archive']	= $archive;
		}

		$this->filters = $searchby;
	}
	
	// Get all required variables for entries display
	function _prepareData(&$row, $key)
	{
		global $_MY_CONFIG, $Itemid , $MYBLOG_LANG;
		
		$mainframe	=& JFactory::getApplication();

		// Load plugins
		$this->_plugins->load();

		// Test if there is blogger in the url.
		$blogger		= JRequest::getVar( 'blogger' , '' , 'GET' );
		
		if( !empty( $blogger ) )
			myAddPageTitle( $blogger . $MYBLOG_LANG['_MB_BLOGGERS_TITLE'] );

		// add permalink		
		$row->permalink = myGetPermalinkUrl($row->id , '' , $blogger);
		
		// Change all relative url to absolute url
		$row->introtext = str_replace('src="images', 'src="'. rtrim( JURI::root() , '/' ) .'/images', $row->introtext);
		$row->fulltext  = str_replace('src="images', 'src="'. rtrim( JURI::root() , '/' ) .'/images',  $row->fulltext);
		
		$row->author		= myGetAuthorName($row->created_by, $_MY_CONFIG->get('useFullName'));
		$row->authorLink	= JRoute::_("index.php?option=com_myblog&blogger=" . urlencode(myUserGetName($row->created_by , $_MY_CONFIG->get('useFullName'))) . "&Itemid=$Itemid");
		$row->categories	= myCategoriesURLGet($row->id, true);
		
		$row->jcategory		= '<a href="' . JRoute::_('index.php?option=com_myblog&task=tag&category=' . $row->catid ) . '">' . myGetJoomlaCategoryName( $row->catid ) . '</a>';
		
		$date				= new JDate( $row->created );
		$date->setOffset( $mainframe->getCfg( 'offset' ) );
		$row->createdFormatted	= $date->toFormat( $_MY_CONFIG->get( 'dateFormat' ) );
		
		// We need to format the date correctly and add the necessary offset back.
		$row->created		= $date->toFormat();

		// Add readmore link if necessary
		$row->readmore	= ($_MY_CONFIG->get('useIntrotext') == '1') ? '1' : '0';
		
		if($_MY_CONFIG->get('necessaryReadmore') == '1' && $row->readmore == '1')
		{
			if($row->introtext && empty($row->fulltext) )
			{
				// Check for the number of X <p> tags in the introtext that is set in the back end of My Blog
				// to determine whether to display the read more link.
				$count = MyblogContent::getParagraphCount($row->introtext);
				if( $count <= $_MY_CONFIG->get('autoReadmorePCount') )
				{
					$row->readmore = '0';
				}
			}
			else if( empty($row->introtext) && $row->fulltext )
			{
				// Check for the number of X <p> tags in the fulltext that is set in the back end of My Blog
				// to determine whether to display the read more link.
				$count = MyblogContent::getParagraphCount($row->fulltext);
				
				if( $count <= $_MY_CONFIG->get('autoReadmorePCount') )
				{
					$row->readmore = '0';
				}
			}
		}				
		MyblogContent::getBrowseText($row);
		
		$row->comments = ($_MY_CONFIG->get('useComment') == "1") ? myCommentsURLGet($row->id, true) : '';

		$avatar	= 'My' . ucfirst($_MY_CONFIG->get('avatar')) . 'Avatar';
		$avatar	= new $avatar($row->created_by);
		
		$row->avatar	= $avatar->get();
		$params			= $this->_buildParams();
		
		if ($_MY_CONFIG->get('mambotFrontpage')=="1")
		{
			$row->beforeContent = $this->_plugins->trigger('onBeforeDisplayContent', $row, $this->_buildParams(), 0);
			$this->_plugins->trigger('onPrepareContent', $row, $params, 0);			
			$row->afterContent	= @$this->_plugins->trigger('onAfterDisplayContent', $row, $this->_buildParams(), 0);
			if ($row->afterContent != "") $row->afterContent = "<br/>" . $row->afterContent;
		}

		// Clean up the final text
		$row->text 	= str_replace(array('{mosimage}', 
			'{mospagebreak}', 
			'{readmore}',
			'{jomcomment}',
			'{!jomcomment}'), '', $row->text);

	}
		
	// Return an array of entries based on the given search paramaters 
	function _getEntries(&$searchby)
	{
		global $_MY_CONFIG;
		
		$db			=& JFactory::getDBO();

		$limit 		= isset($searchby['limit']) 	 ? intval($searchby['limit']): $this->limit;
		$limitstart = isset($searchby['limitstart']) ? intval($searchby['limitstart']): $this->limitstart;
		$jcategory 	= isset($searchby['jcategory'])  ? intval($searchby['jcategory']): 0;
		
		$authorid 	= isset($searchby['authorid']) 	 ? $db->getEscaped($searchby['authorid']): "";
		$category 	= isset($searchby['category']) 	 ? $db->getEscaped($searchby['category']): "";
		$search 	= isset($searchby['search']) 	 ? $db->getEscaped($searchby['search']): "";
		$archive 	= isset($searchby['archive']) 	 ? $db->getEscaped($searchby['archive']): "";
		
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
				$mycat = $db->getEscaped(trim($mycat));
				
				// Use LIKE tag search since we might get confused with  space and dash 
				// get mixed up
				$mycat = str_replace(' ', '%', $mycat);
				$db->setQuery("SELECT id FROM #__myblog_categories WHERE name LIKE '$mycat' OR `slug` LIKE '$mycat'");
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
		$date			=& JFactory::getDate();
		$query = " SELECT count(*) FROM #__content as a,#__myblog_permalinks as p $use_tables WHERE a.state=1 and a.publish_up < '" .$date->toMySQL() . "' and a.sectionid in ($sections) and a.id=p.contentid $searchWhere";
		$db->setQuery($query);
		$total = $db->loadResult();
		$searchby['total'] = $total;
		$this->totalEntries = $total;
		
		

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
		$this->entries = $rows;
		unset($rows);
	}
}
