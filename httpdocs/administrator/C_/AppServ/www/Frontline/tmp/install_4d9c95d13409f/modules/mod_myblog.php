<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

global $_MY_CONFIG;

// Include defines.php if not included
if(!defined('MY_COM_PATH'))
	require_once( JPATH_ROOT . DS . 'components' . DS . 'com_myblog' . DS . 'defines.myblog.php' );

require_once( JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_myblog' . DS . 'config.myblog.php' );
require_once( MY_COM_PATH . DS . 'libraries' . DS . 'datamanager.php' );
require_once( MY_COM_PATH . DS . 'functions.myblog.php' );

$_MY_CONFIG = new MYBLOG_Config();

jimport( 'joomla.filesystem.file' );

if(!class_exists("MyblogModule"))
{

	class MyblogModule
	{
	
		function showArchive()
		{
		    global $_MY_CONFIG, $authorid, $blogger;
		    
			$mbItemid	= $this->myGetItemID();
			$Loop 		= 0;
			$bloggerhref  = "";
			$where		= "";
			$content	= "";
			$sections	= $_MY_CONFIG->get('managedSections');
			
			//blogger name		
			if(!empty($authorid))
			{
				$where =" and created_by=".$authorid ;
				$bloggerhref ="&blogger=".$blogger;
			}
			
			$db		=& JFactory::getDBO();
					
			$queryString = 'SELECT DISTINCT (date_format(jc.created,"%M-%Y")) as archive 
				FROM #__content as jc 
					WHERE 
					jc.sectionid IN('.$sections.') 
					AND state = 1 AND jc.created < NOW() '.$where.' 
				ORDER BY jc.created DESC';
			$db->setQuery( $queryString );
						
			$objList    = $db->loadObjectList();
			
			if($objList)
			{
				$content .= '<ul class="blog-archives">';
			
				while($Loop < count($objList))
				{
					$strSQL	= "SELECT COUNT(*) FROM #__content AS total "
							. "WHERE sectionid IN ({$sections}) "
							. "AND state=1 "
							. "AND date_format(created, '%M-%Y') = '{$objList[$Loop]->archive}'";
					$db->setQuery($strSQL);
					$count	= $db->loadResult();
					$link = JRoute::_("index.php?option=com_myblog&archive={$objList[$Loop]->archive}{$bloggerhref}&Itemid=$mbItemid"); 
					$content .= "<li><a href='$link'>";
					$content .= i8n_date(str_replace("-"," ",$objList[$Loop]->archive))." <span>($count)</span></a>";
					$content .= "</li>";
					$Loop++;
				}
				$content .= '</ul>';
			}
			echo $content;
		}
	
		function myGetItemID()
		{
			return myGetItemId(); 
		}
	
		function showLatestEntriesIntro(&$params)
		{
			global $_MY_CONFIG;
			
			$postedByDisplay    = $params->get('latestEntriesPostedBy');
			$titleMaxLength 	= $params->get('titleMaxLength', 20);
			$introMaxLength     = $params->get('introMaxLength', 50);
			$wrapIntroText      = $params->get('wrapIntro', 10);		
			$limit				= $params->get('numLatestEntries', 5);
			$sections           = $_MY_CONFIG->get('managedSections');
			$showAuthor         = $params->get('showAuthor',1);
			$showReadmore		= $params->get('showReadmore', 1);
			$readmoreText		= $params->get('readmoreText', 'Readmore...');
	
			$blogger			= JRequest::getVar( 'blogger' , '' , 'GET' );
			$authorid			= myGetAuthorId( $blogger );
			
			if($authorid == '0')
				$authorid	= '';
	
			if (!is_numeric($titleMaxLength) or $titleMaxLength == "0")
				$titleMaxLength = 20;
	
			if (!is_numeric($limit))
				$limit = 5;
	
	
			if(function_exists('mb_get_entries'))
			{
				$filter = array(
									'limit'=> $limit,
									'limitstart' => 0,
									'authorid' => $authorid
								);
				$entries = mb_get_entries($filter);
			}
			else
			{
				$objDataMngr = new MY_DataManager();
				$entries = $objDataMngr->getEntries($total,$limit,0,$authorid);
			}
	
			$mbItemid	= 1;
	
			$mbItemid = $this->myGetItemID();
	
			if($entries)
			{
	?>
				<ul class="blog-latest">
	<?php
				foreach ($entries as $row)
				{
					$row->permalinkURL	= myGetPermalinkUrl($row->id);
					$row->titleLink		= $row->permalinkURL;
					$row->author		= myGetAuthorName($row->created_by, ($postedByDisplay=="1" ? "0" : "1"));
	
					$row->authorLink 	= JRoute::_("index.php?option=com_myblog&blogger=".urlencode($row->author)."&Itemid=".$mbItemid."");
					$row->title 		= htmlspecialchars($row->title);
	?>
					
						<li>
							<a title="<?php echo $row->title; ?>" href="<?php echo $row->titleLink; ?>">
	<?php 
						$titlelength = JString::strlen($row->title);
						
						if ($titlelength>$titleMaxLength)
						{
							$row->title = JString::substr($row->title,0,$titleMaxLength);
						}

						echo $row->title; 
	
						if ($titlelength>$titleMaxLength)
						{
							echo " ...";
						}
						echo "</a>";
						/**
						 * Introtext
						 **/					 					
						echo '<br />';
						
						// Strip unwanted tags
						$text	= $row->introtext . $row->fulltext;
						$text	= strip_tags($text);
						$text	= preg_replace('#\s*<[^>]+>?\s*$#','',$text);

						if(JString::strlen($text) > $introMaxLength)
						{
					    	$text  = JString::substr($text,0,$introMaxLength);
					    }
					    
						$text   = wordwrap($text,$wrapIntroText,'<br />');
						$text .= ' ...';
	
						echo $text;
						if ($showAuthor != "2")
						{
	?>
							<span> by <a href="<?php echo $row->authorLink; ?>"><?php echo $row->author; ?></a></span>
	<?php 
						}
						
						if($showReadmore)
						{
	?>
							<br /><a href="<?php echo $row->titleLink; ?>"><?php echo $readmoreText; ?></a>
	<?php
						}
	?>
						</li>		
	<?php	
				}
	?>
				</ul>
	<?php
		 	}else{
		 		echo '<i>None</i>';
			}
		}
	
		function _getCSS($type)
		{
			global $_MY_CONFIG;
			
			
			
			$mainframe	=& JFactory::getApplication();
			
			$path	= JPATH_ROOT . DS . 'components' . DS . 'com_myblog' . DS . 'templates' . DS . '_default' . DS . 'module.' . $type . '.css';
			$custom	= '';
			
			if( $_MY_CONFIG->get('overrideTemplate') )
			{
				$custom	= JPATH_ROOT . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'com_myblog' . DS . 'module.' . $type . '.css';
			}
			else
			{
				$custom	= MY_TEMPLATE_PATH . DS . $_MY_CONFIG->get('template') . DS . 'module.' . $type . '.css';
			}
			
			if( !empty( $custom ) && JFile::exists( $custom ) )
			{
				$path	= $custom;
			}
			
			$contents	= JFile::read( $path );
			$data		= '';
			
			if(!empty($contents))
			{
				$data		= '<style type="text/css">';
				$data		.= $contents;
				$data		.= '</style>';
			}
			return $data;
		}
		
		function _getAvatar($creator)
		{
			global $_MY_CONFIG;
			
			require_once( JPATH_ROOT . DS . 'components' . DS . 'com_myblog' . DS . 'libraries' . DS . 'avatar.php' );
						
			$avatar	= 'My' . ucfirst($_MY_CONFIG->get('avatar')) . 'Avatar';
			$avatar	= new $avatar($creator);
			
			$avatar	= $avatar->get();

			return $avatar;
		}
	
		function showLatestEntries(&$params)
		{
			global $_MY_CONFIG;
	
			$sections           = $_MY_CONFIG->get('managedSections');
			$postedByDisplay 	= $params->get('latestEntriesPostedBy', 1);
			$titleMaxLength 	= $params->get('titleMaxLength',20);
			
			$suffix				= $params->get('moduleclass_sfx');

			$showAuthor         = $params->get('showAuthor',1);
			
			$showReadmore		= $params->get('displayReadmore' , 0);
			$showReadmoreText	= $params->get('displayReadmoreText' , 'Read More...');			
			$showAvatar			= $params->get('displayAvatar' , 0);

			$blogger			= JRequest::getVar( 'blogger' , '' , 'GET' );
			$authorid			= myGetAuthorId( $blogger );
			
			if($authorid == '0')
				$authorid	= '';
	
			if (!is_numeric($titleMaxLength) or $titleMaxLength == "0")
				$titleMaxLength = 20;
			
			$limit = 5;
			if(isset($params))
				$limit	= $params->get('numLatestEntries', 5);
	
			if (!is_numeric($limit))
				$limit = 5;
		
			if(function_exists('mb_get_entries'))
			{
				$filter = array(
					'limit'=> $limit,
					'limitstart' => 0,
					'authorid' => $authorid);
				$entries = mb_get_entries($filter);
			}
			else
			{
				$objDataMngr = new MY_DataManager();
				$entries = $objDataMngr->getEntries($total,$limit,0,$authorid);
			}
		
			$mbItemid	= 1;
			$mbItemid = $this->myGetItemID();
			
			if($entries)
			{
			
				if($showAvatar)
				{
			?>
					<table width="100%" cellpadding="3" cellspacing="0" border="0">
			<?php
				}
				else
				{
			?>
				<ul class="blog-latest">
			<?php
				}
				
				foreach ($entries as $row)
				{
					$row->permalinkURL	= myGetPermalinkUrl($row->id);
					$row->titleLink		= $row->permalinkURL;
					$row->author		= myGetAuthorName($row->created_by, ($postedByDisplay=="1" ? "0" : "1"));
	
					$row->authorLink	= JRoute::_("index.php?option=com_myblog&blogger=".urlencode($row->author)."&Itemid=".$mbItemid);
					$row->title 		= htmlspecialchars($row->title);
	
					$titlelength		= JString::strlen( $row->title );

					if($titlelength>$titleMaxLength)
						$row->title = JString::substr($row->title,0,$titleMaxLength);
						
					$title	= $row->title; 
						
					if ($titlelength>$titleMaxLength)
						$title .= ' ...';
						
						
					if( $showAvatar )
					{
						// Table style
?>
							<tr style="border-bottom: 1px solid #eee;">
								<td width="70%" valign="top">
									<span>
										<a title="<?php echo $row->title; ?>" href="<?php echo $row->titleLink; ?>">
											<?php echo $title; ?>
										</a>
<?php 
										if ($showAuthor != "2")
										{
?>
										by <a href="<?php echo $row->authorLink; ?>"><?php echo $row->author; ?></a>
<?php 
										}
?>
									</span>
<?php					
										if( $showReadmore )
										{
?>
										<br /><a href="<?php echo $row->titleLink; ?>" title="<?php echo $row->title;?>"><?php echo $showReadmoreText; ?></a>
<?php
										}
?>
								</td>
								<td width="30%" align="right">
									<span><?php echo $this->_getAvatar($row->created_by); ?></span>
								</td>
							</tr>
<?php
					}
					else
					{
?>				
					<li>
						<span>
							<a title="<?php echo $row->title; ?>" href="<?php echo $row->titleLink; ?>">
								<?php echo $title; ?>
							</a>
<?php 
						if ($showAuthor != "2")
						{
?>
							by <a href="<?php echo $row->authorLink; ?>"><?php echo $row->author; ?></a>
<?php 
						}
				
						if( $showReadmore )
						{
?>
							<div><a href="<?php echo $row->titleLink; ?>" title="<?php echo $row->title;?>"><?php echo $showReadmoreText; ?></a></div>
<?php
						}
?>
						</span>
					</li>		
					
					<?php
					}	
				}

				if( $showAvatar )
				{
?>
						</table>
<?php
				} else {
?>
						</ul>
<?php
				}
?>
				<?php
		 	}else
		 	{
				echo '<i>None</i>';
			}
		}
	
		function showTagClouds($params)
		{
			global $_MY_CONFIG;

			$wrapperTag   = isset($params) ? $params->get('wrapTag', 'div') : 'div';

			require_once( JPATH_ROOT . DS . 'components' . DS . 'com_myblog' . DS . 'task' . DS . 'categories.php' );
			
			$mbItemid		= $this->myGetItemID();
			$objFrontView	= new MyblogCategoriesTask();
			$tagCloud		= $objFrontView->display('id="blog-tags-mod"', $wrapperTag);
			$mainframe		=& JFactory::getApplication();
				
			$tagCloud 		= JString::str_ireplace("<p>","",$tagCloud);
			$tagCloud 		= JString::str_ireplace("</p>","",$tagCloud);
			$tagCloud 		= JString::str_ireplace("<br/>","",$tagCloud);
		
			// Add the custom css file. Firstly, check in the current template folder if
			// module.tags.css exits. If tempate overriede is used, check in those.
			// If both of the above fails, use the default one in _default
			$cssFilePath 	= MY_COM_PATH . '/templates/_default/module.tags.css';
			$file			= '';
			
			if ($_MY_CONFIG->get('overrideTemplate'))
			{
				$file		= JPATH_ROOT . DS . 'templates' . DS . $mainframe->getTemplate() . DS . 'com_myblog' . DS . 'module.tags.css';
			}
			else
			{
				$file		= MY_TEMPLATE_PATH . DS . $_MY_CONFIG->get('template') . DS . 'module.tags.css';
			}

			if( JFile::exists( $file ) )
			{
				$cssFilePath	= $file;
			}
			
			$contents	= JFile::read( $cssFilePath );
	
			if(!empty($contents))
			{
				echo '<style type="text/css">';
				echo $contents;
				echo '</style>';
			}
	
			if (trim($tagCloud)!="")
				echo $tagCloud;
			else
				echo '<i>None</i>';
		}
	
		function showLatestComment(&$params)
		{
		    global $_MY_CONFIG;
	
			$mbItemid = $this->myGetItemID();
			
			$postedByDisplay    = $params->get('latestCommentsPostedBy', 1);
	   		$titleMaxLength		= $params->get('titleMaxLength', 20);
			$db					=& JFactory::getDBO();
			
			if (!is_numeric($titleMaxLength) or $titleMaxLength == "0")
				$titleMaxLength = 20;
	
			$where				= "";
		
		    $sections   = $_MY_CONFIG->get('managedSections');
	
			$blogger    		= JRequest::getVar( 'blogger' , '' , 'GET');
			$authorid			= myGetAuthorId( $blogger );
			
			if($authorid == 0)
			{
				$authorid = "";
			}
			else
			{
				$where = "and created_by = '".$authorid."'";
			}
		
			$limit = $params->get('numLatestComments', 5);
	
			if (!is_numeric($limit))
				$limit = 5;
	
			$strSQL	= "SELECT a.id, a.comment, a.preview AS preview, a.contentid, a.date, a.user_id FROM #__jomcomment AS a "
					. "JOIN #__content AS b ON a.contentid=b.id "
					. "WHERE b.sectionid IN ($sections) "
					. "AND b.state=1 "
					. "AND a.published=1 "
					. "AND a.option='com_myblog' $where ORDER BY date DESC LIMIT 0, $limit";
		
		    $db->setQuery($strSQL);
		    
			$results    = $db->loadObjectList();
			$Loop		= 0;
			$content 	= "";
		
			$content = '<ul class="blog-comments">';
			
			foreach($results as $row)
			{
				// Test if the preview is available, if it is, just use the preview field
				if($row->preview)
					$row->comment	= $row->preview;

				if(JString::strlen($row->comment) > $titleMaxLength)
					$row->comment	= JString::substr(strip_tags(trim($row->comment)), 0, $titleMaxLength) . ' ...';
			
				if($row->contentid)
				{
					$permalink	= myGetPermalinkUrl($row->contentid);
					$titleHref	= $permalink . '#comment-' . $row->id;
				}
				$authorLink	= '';
				
				if($postedByDisplay != '0')
				{
					if($row->user_id == '0')
					{
						$authorLink	= '<span class="blog-comment-author">by Guest</span>';
					}
					else
					{
						$author			= myUserGetName($row->user_id, ($postedByDisplay == '1' ? '0' : '1'));
						$authorLinkHref	= JRoute::_('index.php?option=com_myblog&blogger=' . urlencode($author) . '&Itemid=' . $mbItemid);
						$authorLink		= '<span class="blog-comment-author">by <a href="' . $authorLinkHref . '">' . $author . '</a></span>';
					}
				}
				$content	.= "<li><a href='".$titleHref."'>". $row->comment ."</a>$authorLink</li>";
			}
			
			$content .= "</ul>";
			echo $content;
		}
	
	
		function showPopularBlogger(&$params)
		{
		    global $_MY_CONFIG;
		    
			$myItemid	= $this->myGetItemID();
	
			$showAvatar	= $params->get('displayAvatar' , 0);
			
			$content = "";
			
			// Get the proper param values.
			$postedByDisplay    = $params->get('popularBlogsPostedBy', 0);
			$limit				= $params->get('numPopularBlogs', 5);
			$db					=& JFactory::getDBO();
			
			if (!is_numeric($limit))
				$limit = 5;
	
			$sections   	= $_MY_CONFIG->get('managedSections');
	
			$strSQL         = "SELECT `created_by`, sum(hits) AS `hits` "
			                . "FROM #__content WHERE `sectionid` IN ({$sections}) "
			                . "AND `state`='1' GROUP BY `created_by` "
			                . "ORDER BY `hits` DESC "
			                . "LIMIT 0,{$limit}";
	
			$db->setQuery($strSQL);
			$rows    = $db->loadObjectList();

			if( $showAvatar )
			{
?>
				<table width="100%" cellpadding="3" cellspacing="0">
<?php
			}
			else
			{
?>
				<ul class="blog-bloggers">
<?php
			}

			if($rows)
			{
				foreach($rows as $row)
				{
					$strSQL	= "SELECT COUNT(*) FROM #__content WHERE `created_by`='{$row->created_by}' AND `sectionid` IN ({$sections}) AND `state` != '0' AND created <= NOW()";
					$db->setQuery($strSQL);
					$count	= $db->loadResult();
					$authorname =  myGetAuthorName( $row->created_by , $_MY_CONFIG->get('useFullName') );
				    $link   = JRoute::_("index.php?option=com_myblog&blogger={$authorname}&Itemid={$myItemid}");
				    
				    if($showAvatar)
				    {
?>
					<tr style="border-bottom: 1px solid #eee;">
						<td width="70%">
								<a href="<?php echo $link;?>">
									<?php echo myUserGetName($row->created_by, ($postedByDisplay == '1' ? '0' : 1 )); ?>
								</a>
								(<?php echo $count; ?>)
						</td>
						<td align="right">
							<?php echo ($showAvatar) ? $this->_getAvatar( $row->created_by ) : ''; ?>
						</td>
					</tr>
<?php				}
					else
					{
?>
					<li>
						<a href="<?php echo $link;?>">
							<?php echo myUserGetName($row->created_by, ($postedByDisplay == '1' ? '0' : 1 )); ?>
						</a>
						(<?php echo $count; ?>)
					</li>
<?php
					}
				}
				
				if( $showAvatar )
				{
?>
					</table>
<?php
				}
				else
				{
?>
					</ul>
<?php
				}
			}
			else
			{
?>
				<p>No bloggers yet.</p>
	<?php
			}
		}
		
		function showCategories()
		{
		    global $_MY_CONFIG;
		    
		    $categories	= myGetCategoryList( $_MY_CONFIG->get('postSection') );
?>
			<ul class="blog-categories">
<?php
			foreach( $categories as $category)
			{
				$link	= JRoute::_('index.php?option=com_myblog&task=tag&category=' . $category->id . '&Itemid=' . myGetItemId() );
				$count	= myGetCategoryCount( $category->id );
?>
				<li>
					<span>
						<a href="<?php echo $link;?>"><?php echo $category->title; ?> (<?php echo $count; ?>)</a>
					</span>
				</li>
<?php
			}
?>
			</ul>
<?php
		}
		
	}//end class
}//end outher if