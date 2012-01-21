<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Base class for all MyBlog task
 */
jimport( 'joomla.utilities.date' );
jimport( 'joomla.filesystem.file' );

class MyblogBaseController
{
	var $toolbar = MY_TOOLBAR_HOME;
	var $pageTitle = '';
	var $category = "";

	// Simplistic execute that just call the display
	function execute(){
		$content = $this->display();
		echo $this->_header();
		echo $content;
		echo $this->_footer();
	}
	
	function MyblogBaseController()
	{		
		// Request might contain 'category'
		$this->category = JRequest::getVar( 'category' , '' , 'REQUEST' );
		if( !empty( $this->category ) )
		{
			$this->category = strval(urldecode( $this->category ));
			$this->category = str_replace("+", " ", $this->category);
		}
	}

	function _header()
	{
		global $_MY_CONFIG, $MYBLOG_LANG;;
		
		$mainframe	=& JFactory::getApplication();
		
		if ($_MY_CONFIG->get('overrideTemplate'))
		{
			$myCustomTplStyle = JPATH_ROOT . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'html' . DS . 'com_myblog' . DS . 'css' . DS . 'template_style.css';
			
			if( JFile::exists($myCustomTplStyle) )
			{
				$style = '<link rel="stylesheet" type="text/css" href="' . rtrim( JURI::root() , '/' ) . '/templates/' .$mainframe->getTemplate() .'/html/com_myblog/css/template_style.css" />';
				$mainframe->addCustomHeadTag($style);
			}
			else
			{
				if( JFile::exists(MY_TEMPLATE_PATH . "/" . $_MY_CONFIG->get('template') . "/css/template_style.css"))
				{
					$style = '<link rel="stylesheet" type="text/css" href="' . rtrim( JURI::root() , '/' ) . '/components/com_myblog/templates/' . $_MY_CONFIG->get('template') . "/css/template_style.css" . '"/>';
					$mainframe->addCustomHeadTag($style);
				}	
			}
		}
		else
		{
			if(JFile::exists(MY_TEMPLATE_PATH . "/" . $_MY_CONFIG->get('template') . "/css/template_style.css"))
			{
				$style = '<link rel="stylesheet" type="text/css" href="' . rtrim( JURI::root() , '/' ) . '/components/com_myblog/templates/' . $_MY_CONFIG->get('template') . "/css/template_style.css" . '"/>';
				$mainframe->addCustomHeadTag($style);
			}
		}
		
		// Add IE6 specific CSS file
		if ( JFile::exists(MY_TEMPLATE_PATH . "/" . $_MY_CONFIG->get('template') . "/css/IE6.css" ) )
		{
			$style  = '<!--[if lte IE 6]>'."\n";		
			$style .= '<link rel="stylesheet" type="text/css" href="' . rtrim( JURI::root() , '/' ) . '/components/com_myblog/templates/' . $_MY_CONFIG->get('template') . "/css/IE6.css" . '"/>'."\n";
			$style .= '<![endif]-->';			
			$mainframe->addCustomHeadTag($style);
		}
		// Add IE7 specific CSS file
		if ( JFile::exists(MY_TEMPLATE_PATH . "/" . $_MY_CONFIG->get('template') . "/css/IE7.css" ) )
		{
			$style  = '<!--[if IE 7]>'."\n";
			$style .= '<link rel="stylesheet" type="text/css" href="' . rtrim( JURI::root() , '/' ) . '/components/com_myblog/templates/' . $_MY_CONFIG->get('template') . "/css/IE7.css" . '"/>';
			$style .= '<![endif]-->';	
			$mainframe->addCustomHeadTag($style);
		}
		
		
		// Add the myblog div-wrapper
		$html  = '<div id="myBlog-wrap">';
		
		// Add the toolbar
		$html .= $this->_showToolbar($this->toolbar);
		
		// Add some filtering options
		if(!empty($this->category))
		{
			if(is_numeric($this->category))
			{
				$html .= "<div><span class=\"filterLabel\">" . JText::_('Category') . " >> </span><span class=\"filterData\">".htmlspecialchars(myGetJoomlaCategoryName($this->category)) ."</span></div>";
			}
			else
			{
				$html .= "<div><span class=\"filterLabel\">" . JText::_('Tags') . " >> </span><span class=\"filterData\">".htmlspecialchars(myGetTagName($this->category)) ."</span></div>";
			}
		}
		
		return $html;
	}
	
	function _footer()
	{
		$html  = getPoweredByLink();
		$html .= '</div>'; 
		return $html;
	}

	// Build the content params object
	function _buildParams()
	{
		$mainframe	=& JFactory::getApplication();

		$mosParams = new JParameter('');
		$mosParams->def('link_titles', $mainframe->getCfg('link_titles'));
		$mosParams->def('author', !$mainframe->getCfg('hideAuthor'));
		$mosParams->def('createdate', !$mainframe->getCfg('hideCreateDate'));
		$mosParams->def('modifydate', !$mainframe->getCfg('hideModifyDate'));
		$mosParams->def('print', !$mainframe->getCfg('hidePrint'));
		$mosParams->def('pdf', !$mainframe->getCfg('hidePdf'));
		$mosParams->def('email', !$mainframe->getCfg('hideEmail'));
		$mosParams->def('rating', $mainframe->getCfg('vote'));
		$mosParams->def('icons', $mainframe->getCfg('icons'));
		$mosParams->def('readmore', $mainframe->getCfg('readmore'));
		$mosParams->def('popup', $mainframe->getCfg('popup'));
		$mosParams->def('image', 1);
		$mosParams->def('section', 0);
		$mosParams->def('section_link', 0);
		$mosParams->def('category', 0);
		$mosParams->def('category_link', 0);
		$mosParams->def('introtext', 1);
		$mosParams->def('pageclass_sfx', '');
		$mosParams->def('item_title', 1);
		$mosParams->def('url', 1);
		$mosParams->set('intro_only', 0);

		return $mosParams;
	}

	/**
	 *	Shows toolbar for the My Blog frontpage
	 */ 
	function _showToolbar($op = "")
	{
		global $MYBLOG_LANG, $Itemid , $_MY_CONFIG;

		$mainframe	=& JFactory::getApplication();		
		$show		= array();
		$category	= JRequest::getVar( 'category' , '' , 'GET' );
		$search		= JRequest::getVar( 'search' , '' , 'GET' );
		$db			=& JFactory::getDBO();
		$document	=& JFactory::getDocument();
		
		
		// Check if current page is blogger
		$blogger	= JRequest::getVar( 'blogger' , '' , 'GET' );

		$isBlogger	= myGetUserCanPost();
		
		if( $isBlogger )
		{
			myAddEditorHeader();
		}
		
		$show['feed'] = $_MY_CONFIG->get('useRSSFeed');

		$rssLink	 = '';
		if($show['feed'])
		{
			$rssLink = "index.php?option=com_myblog";
			if (isset ($_REQUEST['blogger']) and $_REQUEST['blogger'] != "")
				$rssLink .= "&blogger=" . htmlspecialchars($_REQUEST['blogger']);
			
			if (isset ($_REQUEST['category']) and $_REQUEST['category'] != "")
				$rssLink .= "&category=" . htmlspecialchars($_REQUEST['category']);
			
			if (isset ($_REQUEST['keyword']) and $_REQUEST['keyword'] != "")
				$rssLink .= "&keyword=" . htmlspecialchars($_REQUEST['keyword']);
			
			if (isset ($_REQUEST['archive']) and $_REQUEST['archive'] != "")
				$rssLink .= "&archive=" . htmlspecialchars($_REQUEST['archive']);
			
			if (isset ($_REQUEST['Itemid']) and $_REQUEST['Itemid'] != "" and $_REQUEST['Itemid'] != "0")
				$rssLink .= "&Itemid=" . intval($_REQUEST['Itemid']);
			else
			{
				# autodetect Itemid
				$query = "SELECT id FROM #__menu  WHERE type='components' "
				        ."AND link='index.php?option=com_myblog' "
				        ."AND published='1'";
	
				$db->setQuery($query);
	
				$myItemid = $db->loadResult();
				if (!$myItemid)
					$myItemid = 1;
				$Itemid = $myItemid;
			}
			$rssLink	.= "&task=rss";
			$rssLink	= JRoute::_($rssLink);

			if(isset($blogger) && !empty($blogger))
			{
				// Check if user uses feedburner instead.
				if($_MY_CONFIG->get('userUseFeedBurner'))
				{
					// Get RSS link for specific user.
					$user		=& JTable::getInstance( 'Blogger' , 'Myblog' );
					$user->load(myGetAuthorId($blogger));

					// Check if user's feedburner link is empty, we use the administrator's defined
					// link
					if($user->feedburner == '' && $_MY_CONFIG->get('useFeedBurner'))
					{
						$rssLink	= $_MY_CONFIG->get('useFeedBurnerURL');
					}
					else
					{
						$rssLink	= $user->feedburner;
					}
				}
			}
			
			// Check if user wants to use feedburner
			if($_MY_CONFIG->get('useFeedBurner') && empty($blogger))
			{
				$rssLink	= $_MY_CONFIG->get('useFeedBurnerURL');
			}

			$rssTitle = $MYBLOG_LANG['_MB_RSS_BLOG_ENTRIES'];
			
			if ($blogger && $blogger != "")
			{
				$rssTitle .= $MYBLOG_LANG['_MB_RSS_BLOG_FOR'] . ' ' . $blogger;
			}
			
			
			if ($category && $category != "")
			{
				$rssTitle .= ' ' . $MYBLOG_LANG['_MB_RSS_BLOG_TAGGED'] . ' \'' . htmlspecialchars($category) . "'";
			}
			
			
			if ($search && $search != "")
			{
				$rssTitle .= "," . $MYBLOG_LANG['_MB_RSS_BLOG_KEYWORD'] . "'" . htmlspecialchars($search) ."'";
			}
			
			$rssLinkHeader = '<link rel="alternate" type="application/rss+xml" title="' . $rssTitle . '" href="' . $rssLink . '" />';
			
			$mainframe->addCustomHeadTag($rssLinkHeader);
		}
				
		if($_MY_CONFIG->get('frontpageToolbar'))
		{
			$myItemid				= myGetBlogItemId();
			$dashboardItemid	= myGetAdminItemId();
			
			$homeLink     = JRoute::_("index.php?option=com_myblog&Itemid=$myItemid");
			$categoryLink = JRoute::_("index.php?option=com_myblog&task=categories&Itemid=$myItemid");
			$searchLink   = JRoute::_("index.php?option=com_myblog&task=search&Itemid=$myItemid");
			$bloggersLink = JRoute::_("index.php?option=com_myblog&task=bloggers&Itemid=$myItemid");
			$accountLink  = JRoute::_("index.php?option=com_myblog&task=adminhome&Itemid=$dashboardItemid");

			$dashboardClass = "thickbox";
			$thickboxScript="";
			
			if(!class_exists('AzrulJXTemplate'))
			    include_once( JPATH_PLUGINS . DS . 'system' . DS . 'pc_includes' . DS . 'template.php' );
	
			$tpl		= new AzrulJXTemplate();
			$toolbar	= array();
			$active		= array();

			$toolbar['op']            = $op;	
			$toolbar['homeLink']      = $homeLink;
			$toolbar['categoryLink']  = $categoryLink;
			$toolbar['searchLink']    = $searchLink;
			$toolbar['bloggersLink']  = $bloggersLink;
			$toolbar['accountLink']   = $accountLink;


			$active['home']		= '';
			$active['category'] = '';
			$active['search'] 	='';
			$active['blogger'] 	='';
			$active['account']	= '';
			$active[$op] 		= ' blogActive';
			
			# If viewing userblog, only display Home and Dashboard links
			if ($op == "userblog")
			{
				$homeLink				= JRoute::_("index.php?option=com_myblog&Itemid=$Itemid&task=userblog");
				$manageBlogLink 		= JRoute::_("index2.php?option=com_myblog&no_html=1&admin=1&task=adminhome&Itemid=$Itemid&keepThis=true&TB_iframe=true&height=600&width=850");
				$toolbar['homeLink'] 	= $homeLink;
				$toolbar['manageBlogLink'] = $manageBlogLink;
			}
			else 
			{
				$toolbar['rssFeedLink'] = $rssLink;
			}
			
			$title 	= '';
			$desc	= '';
			
			if( !empty( $blogger ) )
			{
				$title	= stripslashes(myGetAuthorTitle(myGetAuthorId($blogger)));
				$desc	= stripslashes(myGetAuthorDescription(myGetAuthorId($blogger)));	
			}
			
			$title 	= empty($title) ? stripslashes($_MY_CONFIG->get('mainBlogTitle'))	: $title;
			$desc	= empty($desc)  ? stripslashes($_MY_CONFIG->get('mainBlogDesc'))	: $desc;
			
			$tpl->set('toolbar', $toolbar);
			$tpl->set('show', $show);
			$tpl->set('active', $active);
			$tpl->set('title', $title);
			$tpl->set('summary', $desc);
			
			$templateFile	= $this->_getTemplateName( 'toolbar' );
	
			$toolbar_output = $tpl->fetch($templateFile);
			return $toolbar_output;
		}
	}

	function _getTemplateName($templateType)
	{
		global $_MY_CONFIG;
		
		$mainframe	=& JFactory::getApplication();

		$template	= MY_TEMPLATE_PATH . DS . '_default' . DS . $templateType . '.tmpl.html';

		if ($_MY_CONFIG->get('overrideTemplate'))
		{
			$path		= JPATH_ROOT . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'html' . DS . 'com_myblog' . DS . $templateType . '.tmpl.html';
			
			$template	= JFile::exists( $path ) ? $path : $template;
		}
		else
		{
			$path		= MY_TEMPLATE_PATH . DS . $_MY_CONFIG->get('template') . DS . $templateType . '.tmpl.html';
			$template	= JFile::exists( $path ) ? $path : $template;
		}
		
		return $template;
	}
	
	function _checkViewPermissions($context){

	}
}
