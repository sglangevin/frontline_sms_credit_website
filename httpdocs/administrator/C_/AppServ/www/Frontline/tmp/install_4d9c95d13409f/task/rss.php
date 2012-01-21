<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'base.php' );
require_once( JPATH_ROOT . '/includes/feedcreator.class.php');
require_once( JPATH_ROOT . '/includes/feedcreator.class.php');
require_once( JPATH_ROOT . '/components/com_myblog/libraries/datamanager.php');

class MyblogRssTask extends MyblogBaseController
{
	/**
	 * Show RSS feed
	 */	 	
	function display()
	{
		header('Content-type:application/xml');
		$author = "";
		$category = "";
		$search = "";
		$archive="";
		$jcategory	= '';
		
		$blogger		= JRequest::getVar( 'blogger' , '' , 'REQUEST' );
		$category		= JRequest::getVar( 'category' , '' , 'REQUEST' );
		$keyword		= JRequest::getVar( 'keyword' , '' , 'REQUEST' );
		$archive		= JRequest::getVar( 'archive' , '' , 'REQUEST' );
		
		if( !empty( $blogger ) )
		{
			if (is_string( $blogger ) )
			{
				$author = myGetAuthorId( urldecode( $blogger ) );
			}
			else
			{
				$author = intval( urldecode( $blogger ) );
			}
		}
		
		if( !empty($category) && is_numeric($category))
		{
			$jcategory	= $category;
		}
		else if( !empty( $category ) )
		{
			$category = urldecode(htmlspecialchars( $category ));
		}
		
		if( !empty( $keyword ) )
		{
			$search = urldecode(htmlspecialchars( $keyword ));
		}
		
		if( !empty( $archive ) )
		{
			$archive = urldecode(htmlspecialchars( $archive ));
		}
		
		$this->_rss($author, $category, $jcategory , $search, $archive);
		exit;
	}
	
	/**
	 *	Gets RSS feed for a specific blog view
	 */ 
	function _rss($bloggerID = "", $tags = "", $category = '',  $keywords = "", $archive="")
	{
		global $MYBLOG_LANG, $_MY_CONFIG, $Itemid;
		
		$mainframe	=& JFactory::getApplication();
		$db			=& JFactory::getDBO();
		
		if (!$_MY_CONFIG->get('useRSSFeed') or $_MY_CONFIG->get('useRSSFeed') == "0")
		{
			echo '<error>';
			echo JText::_('RSS FEED NOT ENABLED');
			echo '</error>';
			return;
		}
		
		$blogger_username = "";
		
		if ($bloggerID != "")
		{
			$query	= "SELECT * from #__users WHERE id='$bloggerID'";
			$db->setQuery( $query );

			$blogger	= $db->loadObjectList();
			
			if ($blogger)
			{
				$blogger = $blogger[0];
				$blogger_username = ($_MY_CONFIG->get('useFullName')=="1" ? $blogger->name :$blogger->username);
			}
			else
			{
				$blogger_username = "";
			}
		}
		
		if( !empty( $archive ) )
		{
			// Joomla 1.5 might convert the '-' to ':'
			$archive = urldecode($archive);
			$archive = str_replace(':', '-', $archive);
			$archive = date("Y-m-d 00:00:00", strtotime(str_replace("-", " ", "01 " . $archive )));
		}
		
		$rss = new RSSCreator20();
		
		$rssLimit	= ( $_MY_CONFIG->get('rssFeedLimit') != 0 ) ? (int) $_MY_CONFIG->get('rssFeedLimit') : 20;

		$searchby = array('limit' => $rssLimit,
				'limitstart' => 0,
				'authorid' => $bloggerID,
				'category' => $tags,
				'jcategory'	=> $category,
				'search' => $keywords,
				'archive' => $archive,
				);
	
		$entries = mb_get_entries($searchby);
		$total = $searchby['total'];
		
		if(!class_exists('AzrulJXTemplate'))
		{
			require_once( JPATH_PLUGINS . DS . 'system' . DS . 'pc_includes' . DS . 'template.php' );
		}
		    
		$tpl = new AzrulJXCachedTemplate(serialize($entries) . "_rss" . strval($bloggerID) . strval($tags) . strval($keywords) , strval($archive));
		
		if (!$tpl->is_cached()) 
		{
			$title	= JText::_('RSS FEED PAGE TITLE');
			
			if( isset( $blogger_username ) && !empty( $blogger_username ) )
			{
				$title	.= ' ' . JText::sprintf( 'RSS FEED PAGE TITLE FROM' , $blogger_username );
			}

			if( isset( $tags ) && !empty( $tags ) )
			{
				$title	.= ' ' . JText::sprintf( 'RSS FEED PAGE TITLE TAGGED' , $tags );
			}

			if( isset( $keywords ) && !empty( $keywords ) )
			{
				$title	.= ', ' . JText::sprintf( 'RSS FEED PAGE TITLE KEYWORDS' , $keywords );
			}

			if ($archive and $archive != "")
			{
				$archive_display	= date("F Y", strtotime($archive));
				$title 				.= " - $archive_display";
			}
			
			$db->setQuery("SELECT description from #__myblog_user WHERE user_id='$bloggerID'");
			$description = $db->loadResult();
			
			if (!$description or $description == "")
				$description = "$title";
			
			// remove readmore tag
			$description = str_replace('{readmore}', '', $description);	
				
			$rss->title 		= $title;
			$rss->description	= $description;
			$rss->encoding		= 'UTF-8';
			$rss->link			= rtrim( JURI::root() , '/' );
			$rss->cssStyleSheet = NULL;
			
			if ($entries)
			{
				$count = 0;
				
				foreach($entries as $row)
				{
					$count++;
					
					if ($count > $rssLimit)
					{
						break;
					}

					$item = new FeedItem();
					$item->title = $row->title != "" ? $row->title : "...";
					$item->title = myUnhtmlspecialchars($item->title);
					
					if( empty( $row->fulltext ) )
					{
						$itemDesc	= ( !empty( $row->introtext ) ) ? $row->introtext : JText::_('NO BLOG DESCRIPTION');
					}
					else
					{
						$itemDesc	= $row->introtext . $row->fulltext;
					}
					$desc_length_max = 500;
					
					$itemDesc 			= strip_tags($itemDesc, '<p> <br /> <br/> <br> <u> <i> <b> <img>');
					$actualDescLength	= JString::strlen($itemDesc);
					$itemDesc			= JString::substr($itemDesc, 0, $desc_length_max);
					$itemDesc			= preg_replace("/\r\n|\n|\r/", "<br/>", $itemDesc);
					
					if ($actualDescLength > $desc_length_max)
					{
						$itemDesc .= JText::_('READMORE');
					}

					$itemDesc			= str_replace('{readmore}', '', $itemDesc);
					$item->description	= $itemDesc;
					
					$item->link			= html_entity_decode($row->permalink);
					
					$date				= new JDate( $row->created );
					
					$date->setOffset( $mainframe->getCfg( 'offset' ) );

					$item->date			= $date->toRFC822( true );
					$item->author		= myGetAuthorEmail($row->created_by);
					$categoriesList 	= myGetTags($row->id);
					
					$extraElements 		= array ();
					
					if ($categoriesList)
					{
						$categories = "";
						$indentString = " ";
						
						foreach ($categoriesList as $category)
						{
							$categoryName = $category->name;
							
							if ($categories != "")
							{
								$categories .= "</category>\n$indentString<category>";
							}
								
							$categories .= htmlentities($categoryName);
						}
						
						$extraElements['category'] = $categories;
						$item->additionalElements = $extraElements;
					}
					
					$rss->addItem($item);
				}
			}
			
			$tpl->set('rss', $rss->createFeed());
		}
		
		$rsscontent = $tpl->fetch_cache(MY_TEMPLATE_PATH . "/admin/rss.tmpl.html");
		while (@ob_end_clean());
		
		echo $rsscontent;
		exit;
	}
}
	
