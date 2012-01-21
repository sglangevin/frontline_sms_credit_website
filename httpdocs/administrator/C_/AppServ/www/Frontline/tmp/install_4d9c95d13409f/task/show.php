<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'show.base.php' );
require_once( MY_COM_PATH . DS . 'libraries' . DS . 'plugins.php' );

class MyblogShowTask extends MyblogShowBase
{
	var $_plugins	= null;
	var $row = null;
	var $uid = null;
	
	function MyblogShowTask()
	{	
		$this->_plugins	= new MYPlugins();
		$this->toolbar = MY_TOOLBAR_HOME;
		
		$db			=& JFactory::getDBO();
		$show		= JRequest::getVar( 'show' , '' , 'GET' );
		$id			= JRequest::getVar( 'id' , '' , 'GET' );
		$this->uid	= (!empty( $show ) ) ? $show : $id;
		$uid		= $this->uid;

		// Get blog entry
		if (is_numeric($uid))
		{
			$date	=& JFactory::getDate();
			
			$query	= "SELECT c.*,p.permalink, '" . $date->toMySQL() ."' as curr_time, r.rating_sum/r.rating_count as rating, r.rating_count from (#__content as c,#__myblog_permalinks as p) left outer join #__content_rating as r on (r.content_id=c.id) WHERE c.id=p.contentid and c.id='$uid'";
			$db->setQuery( $query );
			$row	= $db->loadObject();

			if( !$row )
			{
				$row	=& JTable::getInstance( 'Content' , 'Myblog' );
				$row->load( $uid );
			}
		}
		else
		{
			$uid = stripslashes($uid);
			//$uid = urldecode($uid);
			$uid = $db->getEscaped($uid);

			$row	=& JTable::getInstance( 'Content' , 'Myblog' );
			$row->load($uid);
		}
		$this->row = &$row;
	}
	
	function _header()
	{
		echo parent::_header();
		if($this->isMyEntry())
		{
		?>
			<script type="text/javascript" language="javascript" src="<?php echo MY_COM_LIVE; ?>/js/myblog.js"></script>
			<link href="<?php echo MY_COM_LIVE; ?>/css/azwindow.css" rel="stylesheet" type="text/css" />
		<?php
		}
	}
	
	// return true if the entry is logged in user entry
	function isMyEntry()
	{
		$my		=& JFactory::getUser();
		
		return( $this->row->created_by == $my->id );
	}

	function display($styleid = '', $wrapTag = 'div')
	{
		global $MYBLOG_LANG, $_MY_CONFIG;

		$mainframe		=& JFactory::getApplication();
		if(!myAllowedGuestView('entry'))
		{
			$template		= new AzrulJXTemplate();
			$content		= $template->fetch($this->_getTemplateName('permissions'));
			return $content;
		}
		
		$Itemid		= myGetItemId();
		$row		= null;
		$task		= '';
		$task_url	= "";

		if ($task!="")
		{
			$task_url = "&task=$task";
		}
		
		// Load plugins
		$this->_plugins->load();
		
		$row = &$this->row;

		// Need to fix the permalink with complete path
		$row->permalink = myGetPermalinkUrl($row->id);
		$row->comments = "";
		
		$date			=& JFactory::getDate( $row->created );
		$date->setOffSet( $mainframe->getCfg( 'offset' ) );

		$row->createdFormatted	= $date->toFormat( $_MY_CONFIG->get('dateFormat') );
		$row->created			= $date->toFormat();

		$row->title = myUnhtmlspecialchars($row->title);
		$row->title = htmlspecialchars($row->title); 
		
		$db			=& JFactory::getDBO();
		$date		=& JFactory::getDate();

		if ($row->state != 1 || $row->publish_up > $date->toMySQL() )
		{
			echo JText::_("Cannot find the entry.The user has either change the permanent link or the content has not been published.");
			return;
		}
		else
		{
			$query	= "UPDATE #__content SET hits=hits+1 WHERE id=$row->id";
			$db->setQuery( $query );
			$db->query();
		}

		// Page title will be added whatever $mosConfig_MetaTitle setting is
		myAddPageTitle(myUnhtmlspecialchars($row->title));
		myAddPathway($row->title);

		if ($mainframe->getCfg('MetaAuthor') == '1') 
		{
			$mainframe->addMetaTag( 'author' , myGetAuthorName( $row->created_by , '1' ) );
		}

		// Attach meta tags for tags. Get the tags for this article.
		$tags	= myGetTags($row->id);
		
		$keywords	= '';
		foreach($tags as $tag)
		{
			$keywords	.= $tag->name . ' ';
		}
		
		$document=& JFactory::getDocument();
			
		if($document->getDescription() == '' || $row->metadesc != '')
			$document->setDescription( $row->metadesc );
		
		if( !empty( $row->metakey ) )
		{
			$keywords	.= ' ' . $row->metakey;
		}

		$mainframe->appendMetaTag( 'keywords' , $keywords );

		$my		=& JFactory::getUser();
		$tpl	= new AzrulJXCachedTemplate(serialize($row) . $my->usertype . $_MY_CONFIG->get('template') . $task);


		if (!$tpl->is_cached())
		{
			// Process text, combine introtext/fulltext
			$row->text	= '';
			
			if($row->introtext && trim($row->introtext) != '')
			{
				$row->text	.= $row->introtext;
			}
			
			// Add the rest of the fulltext
			if($row->fulltext && trim($row->fulltext) != '')
			{
				// Process anchor for #readmore only when there is fulltext
				if($_MY_CONFIG->get('anchorReadmore'))
				{
					$row->text	.= '<a name="readmore"></a>'; 
				}
				$row->text	.= $row->fulltext;
			}

			// if JC integration enabled, display JC
			if ($_MY_CONFIG->get('useComment'))
			{
				jimport( 'joomla.filesystem.file');
				
				$file	= JPATH_PLUGINS . DS . 'content' . DS . 'jom_comment_bot.php';
				if (JFile::exists( $file ) )
				{
					require_once( $file );
					
					// Check if admin allows user to enable or disable the comment on the blog
 					if($_MY_CONFIG->get('enableJCDashboard'))
					{
 						if(eregi('\{!jomcomment\}',$row->text))
						{
 							$row->text	= str_replace('{!jomcomment}','',$row->text);
 						}
						else if(eregi('\{jomcomment\}',$row->text))
						{
 							$row->text	= str_replace('{jomcomment}','',$row->text);
 							$row->comments	= "";
 							$row->comments 	= jomcomment($row->id, "com_myblog");
 						}
 						else if(eregi('\{jomcomment lock\}', $row->text) )
 						{
 							$row->text	= str_replace('{jomcomment lock}','',$row->text);
 							$row->comments	= "";
 							$row->comments 	= jomcomment($row->id, "com_myblog" , '' , '' , true );
						}
						else
						{
 							// Default
 							// User is not allowed to enable or disable comments
 							// so we use the default value to display
 							$row->comments	= "";
 							$row->comments 	= jomcomment($row->id, "com_myblog");
 						}
 					}
					else
					{
 						// User is not allowed to enable or disable comments
 						// so we use the default value to display
 						$row->comments	= "";
 						$row->comments 	= jomcomment($row->id, "com_myblog");
 					}
				}
			}
			$row->author = myUserGetName($row->created_by, $_MY_CONFIG->get('useFullName'));
			$row->authorLink = JRoute::_("index.php?option=com_myblog$task_url&blogger=" . urlencode(myGetAuthorName($row->created_by , $_MY_CONFIG->get('useFullName'))) . "&Itemid=$Itemid");
			$row->categories = myCategoriesURLGet($row->id, true, $task);
			$row->jcategory		= '<a href="' . JRoute::_('index.php?option=com_myblog&task=tag&category=' . $row->catid ) . '">' . myGetJoomlaCategoryName( $row->catid ) . '</a>';
			$row->emailLink = JRoute::_("index.php?option=com_content&task=emailform&id={$this->uid}");

			$avatar	= 'My' . ucfirst($_MY_CONFIG->get('avatar')) . 'Avatar';
			$avatar	= new $avatar($row->created_by);	
			$row->avatar	= $avatar->get();

			$row->afterContent = '';
			$row->beforeContent = '';

			$params	= $this->_buildParams();
			$row->beforeContent		= @$this->_plugins->trigger('onBeforeDisplayContent', $row, $params, 0);
			$row->onPrepareContent	= @$this->_plugins->trigger('onPrepareContent', $row, $params, 0);
			$row->afterContent		= "<br />". @$this->_plugins->trigger('onAfterDisplayContent', $row, $params, 0);

			
			$row->editLink = '<span class="editLink" onclick="myAzrulShowWindow(\'index.php?option=com_myblog&task=write&no_html=1&id='.$row->id.'\');">&nbsp;[' . JText::_('Edit') . ']&nbsp;</span>';

			// Check if user enables back link
			if($_MY_CONFIG->get('enableBackLink'))
				$row->afterContent .= myGetBackLink();

			$enablePdf		= ( boolean ) $_MY_CONFIG->get('enablePdfLink');
			$enablePrint	= ( boolean ) $_MY_CONFIG->get( 'enablePrintLink' );
			
			$tpl->set( 'enablePdfLink' 	, $enablePdf );
			$tpl->set( 'enablePrintLink', $enablePrint );

			// Remove all member with '_' prefix. Get rid of reference to cms/cmsdb
			unset($row->_table);
			unset($row->_key);
			unset($row->_db);

			$my		=& JFactory::getUser();
			
			$tpl->set('userId', $my->id);
			$tpl->set( 'categoryDisplay' , $_MY_CONFIG->get('categoryDisplay') );
			$tpl->set('entry', $tpl->object_to_array($row));

		}

		$content	= '';
		
		$path	= $this->_getTemplateName( 'entry' );
		
		$content .= $tpl->fetch_cache( $path );
		return $content;		
	}
}