<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

DEFINE("MB_SECTION",8);
DEFINE("MB_CATEGORY",18);

class myblogContent extends JTable
{ 
	var $id =0;
	var $title =null;
	var $title_alias =null;
	var $introtext =null;
	var $images =null;
	var $fulltext =null;
	var $state =null;
	var $sectionid =null;
	var $mask =null;
	var $catid =null;
	var $created =null;
	var $created_by =null;
	var $created_by_alias=null;	
	var $modified =null;	
	var $modified_by =null;	
	var $checked_out =null;	
	var $checked_out_time=null;	
	var $publish_up =null;	
	var $publish_down =null;	
	var $urls =null;	
	var $attribs =null;	
	var $version =null;	
	var $parentid =null;	
	var $ordering =null;	
	var $metakey =null;	
	var $metadesc =null;	
	var $access =null;
	var $hits =null;	
	
	/* Custom params */
	var $permalink = null;
	var $tags	= null; // string, saperated by comma
	var $tagobj	= null;	// array, obj(id, name) of the tags
	var $rating = null;
	var $rating_count	= null;
	
	function __construct(&$db)
	{
		parent::__construct('#__content','id', $db);
	}
	
	function autoCloseTags($string) {
		// automatically close HTML-Tags
		// (usefull e.g. if you want to extract part of a blog entry or news as preview/teaser)
		// coded by Constantin Gross <connum at googlemail dot com> / 3rd of June, 2006
		// feel free to leave comments or to improve this function!
		$donotclose=array('br','img','input'); //Tags that are not to be closed
		//prepare vars and arrays
		$tagstoclose='';
		$tags=array();
		//put all opened tags into an array
		preg_match_all("/<(([A-Z]|[a-z]).*)(( )|(>))/isU",$string,$result);
		$openedtags=$result[1];
		$openedtags=array_reverse($openedtags); //this is just done so that the order of the closed tags in the end will be better
		//put all closed tags into an array
		preg_match_all("/<\/(([A-Z]|[a-z]).*)(( )|(>))/isU",$string,$result2);
		$closedtags=$result2[1];
		//look up which tags still have to be closed and put them in an array
		for ($i=0;$i<count($openedtags);$i++) {
			if (in_array($openedtags[$i],$closedtags)) { unset($closedtags[array_search($openedtags[$i],$closedtags)]); }
			else array_push($tags, $openedtags[$i]);
		}
		$tags=array_reverse($tags); //now this reversion is done again for a better order of close-tags
		//prepare the close-tags for output
		for($x=0;$x<count($tags);$x++) {
			$add=strtolower(trim($tags[$x]));
			if(!in_array($add,$donotclose)) $tagstoclose.='</'.$add.'>';
		}
		//and finally
		return $tagstoclose;
	}

	function getParagraphCount($text)
	{
		$position = -1;
		$count	  = 0;

		while( ( $position = strpos($text , '</p>' , $position + 1) ) !== false )
		{
			$count++;
		}
			
		return $count;
	}
	
	function getBrowseText(&$row){
		global $_MY_CONFIG;
		
		if($_MY_CONFIG->get('useIntrotext')){
			if(empty($row->fulltext)){
				$ending = strpos($row->introtext, '</p>');
				
				$pos=-1;
				$pos_array = array();
				while (($pos=strpos($row->introtext,'</p>',$pos+1))!==false) 
					$pos_array[]=$pos;
				
				$pNum = $_MY_CONFIG->get('autoReadmorePCount');
				if (count($pos_array) <= $pNum) {
				   $row->text = $row->introtext;
				} else {
					$ending = $pos_array[$pNum-1];
					$row->introtext = JString::substr($row->introtext, 0, $ending + 4);
					$row->introtext = myCloseTags(preg_replace('#\s*<[^>]+>?\s*$#','',$row->introtext));
				}
			}
			else if( !empty($row->fulltext) && empty($row->introtext) )
			{
				// Strip x paragraphs
				
				$ending = strpos($row->fulltext, '</p>');
				
				$pos=-1;
				$pos_array = array();
				while (($pos=strpos($row->fulltext,'</p>',$pos+1))!==false) 
				$pos_array[]=$pos;
				
				$pNum = $_MY_CONFIG->get('autoReadmorePCount');
				if (count($pos_array) <= $pNum) {
					$row->text = $row->fulltext;
				} else {
					$ending = $pos_array[$pNum-1];
					$row->fulltext = JString::substr($row->fulltext, 0, $ending + 4);
					$row->fulltext = myCloseTags(preg_replace('#\s*<[^>]+>?\s*$#','',$row->fulltext));
				}
			}
			
			// If user set to display introtext but introtext might be empty
			// due to the way previous version of My Blog stores the entries.
			if( empty($row->introtext) )
			{
				$row->text = $row->fulltext;
			}
			else
			{
				$row->text = $row->introtext;
			}
		}
		else
		{
			if(empty($row->introtext))
				$row->text = $row->fulltext;
			else
				$row->text = $row->introtext;	
		}
	}
	
	function _splitReadmoreOnSave(){
		// During save, the text in the editor will be stored in $this->fulltext.
		// If readmore is detected, we split it up and place it in introtext / fulltext
		// If it doesn't exists just place it in introtext like the default Joomla.
		
		
		// we are assuming everything is now in fulltext
		$this->fulltext = preg_replace('/<p id="readmore">(.*?)<\\/p>/i', '{readmore}', $this->fulltext);
		$pos = strpos($this->fulltext, '{readmore}');
		if ($pos === false) {
			$this->introtext = $this->fulltext;
			$this->fulltext = '';
		} 
		else
		{
			$this->introtext = JString::substr($this->fulltext, 0, $pos);
			$this->fulltext  = JString::substr($this->fulltext, $pos + 10);
		} 
	}
	
	// We can load the row using either numeric id or a permalink string
	function load($id)
	{
		$mainframe	=& JFactory::getApplication();
		$db			=& JFactory::getDBO();
		$originalid = $id;
		
		if(is_numeric($id))
		{
			parent::load($id);
		}
		else
		{
			$query	= "SELECT contentid FROM #__myblog_permalinks WHERE permalink='{$id}'";
			$db->setQuery( $query );
			$id = $db->loadResult();
			
			// IF we cannot find it, need to try and convert ':' to '-'. Joomla 1.5
			// seems to convert this
			if(!$id)
			{
				$id = str_replace(':', '-', $originalid);
				$sql = "SELECT contentid FROM #__myblog_permalinks WHERE permalink='{$id}'";
				
				$db->setQuery($sql);
				$id = $db->loadResult();
			}
			
			// If we still can't locate it, perhaps they might be using an older permalink
			if( !$id )
			{
				$id		= JRequest::getVar( 'show' , '' , 'GET' );
				
				$query	= 'SELECT * FROM ' . $db->nameQuote( '#__myblog_redirect' ) . ' '
						. 'WHERE ' . $db->nameQuote( 'permalink' ) . '=' . $db->Quote( $id );
				$db->setQuery( $query );
				
				$permalink	= $db->loadObject();
				
				// If its an older permalink, then we should do a 301 redirect.
				if( $permalink )
				{
					$id			= $permalink->contentid;
					
					$query	= 'SELECT ' . $db->nameQuote( 'permalink' ) . ' FROM ' . $db->nameQuote( '#__myblog_permalinks' )
							. 'WHERE ' . $db->nameQuote('contentid') . '=' . $db->Quote( $permalink->contentid );
					$db->setQuery( $query );
					
					$link	= $db->loadResult();
					
					$url		= JRoute::_('index.php?option=com_myblog&show=' . $link , false );
					$mainframe->redirect( $url );
					exit;
				}

			}
			
			parent::load($id);
		}
		
		// get the permalink
		if(is_numeric($id) && ($id != 0))
		{
			$db->setQuery("SELECT `permalink` FROM #__myblog_permalinks WHERE `contentid`='{$id}'");
			$this->permalink = $db->loadResult();
		}
		
		// if the fulltext contain the '{readmore}', that means this is the old data and we need to clean them up a bit
		// $this->_split_fulltext_readmore();
		// @gotcha. if fulltext contain readmore, and {introtext}
		$pos = strpos($this->fulltext, '{readmore}');
		
		if ($pos === false)
		{
		}
		else
		{
			$this->introtext .= JString::substr($this->fulltext, 0, $pos);
			$this->fulltext  = JString::substr($this->fulltext, $pos + 10);
		}
		
		// We store all the text in the introtext if no {readmore} is present. 
		// Otherwise it is stored in introtext
		// and fulltext appropriately.
 		if(!empty($this->fulltext) && empty($this->introtext))
		{
 			$this->introtext = $this->fulltext;
 			$this->fulltext = '';
 		}

		// Load the tags into a string
		$sql = "SELECT `tag`.`id` ,`tag`.`name` "
			." \n FROM #__myblog_categories as tag ,  #__myblog_content_categories as c "
			." \n WHERE tag.`id` = c.category AND c.contentid='{$this->id}'";
		$db->setQuery($sql);
		$this->tagobj = $db->loadObjectList();
		$tags = array();
		if($this->tagobj)
		{
			foreach($this->tagobj as $tag)
			{
				$tags[] = $tag->name;
			}
		}
		$this->tags = implode(',', $tags);
		
		# Get the rating
		$db->setQuery("SELECT *, round( rating_sum / rating_count ) AS rating FROM #__content_rating WHERE content_id='{$this->id}'");
		$rating = $db->loadObject();
		
		if($rating)
		{
			$this->rating = $rating->rating;
			$this->rating_count = $rating->rating_count;
		}
		
		//Change all relative url to absolute url
		$this->introtext = str_replace('src="images', 'src="'. rtrim( JURI::root() , '/' ) .'/images', $this->introtext);
		$this->fulltext  = str_replace('src="images', 'src="'. rtrim( JURI::root() , '/' ) .'/images',  $this->fulltext);
		
		// Convert back to htmlentities
		$this->title        = htmlspecialchars($this->title);
		
		// make sure no bloody {readmore} tag ever
		$this->introtext = str_replace('{readmore}', '', $this->introtext);
		$this->fulltext = str_replace('{readmore}', '', $this->fulltext);

		# Trim all necessary text
		$this->introtext = trim($this->introtext);
		$this->fulltext = trim($this->fulltext);
		$this->permalink = trim($this->permalink);
	}
	
	function bind($vars, $editorSave=false)
	{
		if(empty($vars))
			return;
			
		parent::bind($vars);

		// if saving from editor, everything is in the fulltext, need to split it
		if($editorSave && empty($vars['introtext']))
		{
			$this->_splitReadmoreOnSave();
		}
	}
	
	function store()
	{
		global $_MY_CONFIG;
		
		$mainframe	=& JFactory::getApplication();
		$temp		= $this->permalink;
		$tags		= $this->tags;
		$my			=& JFactory::getUser();
		$db			=& JFactory::getDBO();
		
		unset($this->permalink);
		unset($this->tags);
		unset($this->rating);
		unset($this->rating_count);
		
		
		if(empty($this->publish_up))
		{
			$this->publish_up = $this->created;
		}
		
		if(empty($this->sectionid))
		{
			$this->sectionid = $_MY_CONFIG->get('postSection');
		}
		
		if(empty($this->catid))
		{
			$this->catid = $_MY_CONFIG->get('catid');
		}
		
		if(empty($this->created_by))
		{
			$this->created_by = $my->id;
		}
		
		if($this->id != NULL && $this->id != 0)
		{
			$this->modified = strftime("%Y-%m-%d %H:%M:%S", time() + ( $mainframe->getCfg('offset') * 60 * 60 ));	
		}
		
		//$this->_splitReadMoreOnSave();
		
		// Decode back to normal
		$this->title    = html_entity_decode($this->title);
		//$this->title = htmlspecialchars($this->title);

		$currentId		= $this->id;

		parent::store();
		
		// restore custom fields
		$this->permalink = $temp;
		$this->tags =  $tags;
		
		// If the permalink is empty, we need to create them or update if necessary
		if(empty($this->permalink))
		{
			$this->permalink    = myGetPermalink($this->id);
		}

		jimport( 'joomla.filesystem.file' );
		
		if( $_MY_CONFIG->get('jomsocialActivity') )
		{
			// Test if jomsocial file really exists.
			$core	= JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php';
			if( JFile::exists( $core ) )
			{
				require_once( $core );
				$command		= ( $currentId == 0 ) ? 'blog.create' : 'blog.update';
				$title			= JString::substr( $this->title , 0 , 20 ) . '...';
				$link			= JRoute::_('index.php?option=com_myblog&show=' . $this->permalink . '&Itemid=' . myGetItemId() ); 
				$act			= new stdClass();
				$act->cmd 		= $command;
				$act->actor   	= $my->id;
				$act->target  	= 0;
				$act->title		= ( $currentId == 0 ) ? JText::sprintf('JS BLOG ENTRY CREATED ACTIVITY' , $link , $title ) : JText::sprintf('JS BLOG ENTRY UPDATED ACTIVITY' , $link , $title );
				$act->content	= $this->introtext . $this->fulltext;
				$act->app		= 'myblog';
				$act->cid		= $this->id;
	
				// Add activity logging
				CFactory::load ( 'libraries', 'activities' );
				CActivityStream::add($act);
			}
		}

		if( $_MY_CONFIG->get('jomsocialPoints') )
		{
			if( $this->id != 0 )
			{
				$file	= JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'userpoints.php';
				
				if( JFile::exists( $file ) )
				{
					require_once( $file );

					CUserPoints::assignPoint( 'myblog.add' , $my->id );
				}
			}
		}
		
		if($this->id != 0)
		{
			$sql = "SELECT permalink FROM `#__myblog_permalinks` WHERE `contentid`='{$this->id}'";
			$db->setQuery($sql);
			
			$oldPermalink	= $db->loadResult();
			
			if($oldPermalink)
			{
				// If there is a change in permalink, need to add a redirection
				if( $oldPermalink != $this->permalink )
				{
					// Add a record into the redirect table so we can do a 300 redirect later.
					$query	= 'INSERT INTO ' . $db->nameQuote( '#__myblog_redirect' ) . ' (' . $db->nameQuote( 'contentid' ) . ',' . $db->nameQuote('permalink') . ') '
							. 'VALUES (' . $db->Quote( $this->id ) . ',' . $db->Quote( $oldPermalink ) . ')';
					$db->setQuery( $query );
					$db->query();
				}

				$db->setQuery("UPDATE `#__myblog_permalinks` SET `permalink`= '{$this->permalink}' WHERE `contentid`='{$this->id}'");
				$db->query();
			}
			else
			{
				$db->setQuery("INSERT INTO `#__myblog_permalinks` (`contentid`, `permalink`) VALUES ({$this->id}, '{$this->permalink}') ");
				$db->query();
			}
		}
	}
	
	/**
	 * Return an array of strings with all the validation error of the given entry.	  	
	 * The data given will be blogContent object.
	 * 
	 * If no error is found, return an empty array	 	 
	 */	 	
	function validate_save(){
		$validate = array();
		
		# Title cannot be empty
		if(empty($this->title)){
			$validate[] = "Title is empty"; 
		} 
		
		# Fulltext area cannot be empty
		if(empty($this->fulltext)){
			$validate[] = "You cannot save a blank entry. "; 
		}
		
		# Check if permalink contains any unallowed characters and no duplicate is allowed
		if (preg_match('/[!@#$%\^&*\(\)\+=\{\}\[\]|\\<">,\\/\^\*;:\?\']/', $this->permalink)) {
			$validate[] = "Permanent link can only contain ASCII alphanumeric characters and.-_ only";
		} else {
			$db->query("SELECT count(*) from #__myblog_permalinks WHERE permalink='{$this->permalink}' and contentid!={$this->id}");
			
			if ($db->get_value() and $this->permalink != "") {
				$validate[] = "Permanent link has already been taken. Please choose a different permanent link.";
			} 
		}
		
		return $validate;
	}
} 
