<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

// Include Imagebrowser.
require_once( MY_LIBRARY_PATH . DS . 'imagebrowser.php' );

class MyblogWriteTask extends MyBlogBaseController
{
	function _header()
	{
	}
	
	function _footer()
	{
	}
	
	function display()
	{
		global $_MY_CONFIG;

		$mainframe	=& JFactory::getApplication();
		
		$jax	= new JAX( rtrim( JURI::root() , '/' ) . '/plugins/system/pc_includes' );
		$jax->setReqURI( rtrim( JURI::root() , '/' ) . '/index.php?tmpl=component' );
		$jax->process();
				
		if(!class_exists('AzrulJXCachedTemplate'))
		{
			require_once( JPATH_PLUGINS . DS . 'system' . DS . 'pc_includes' . DS . 'template.php' );
		}
	
		# If user is not allowed to post
		if(!myGetUserCanPost())
		{
		    // User not allowed to post blogs
		    echo JText::_('BLOG ADMIN NO PERMISSIONS TO POST');
			return;
		}		
		$tpl	= new AzrulJXTemplate();
		$id		= JRequest::getVar( 'id' , '' , 'GET' );
		
		// If form id is set in in the 'post' data, use that one instead. You see, when
		// creating new entry, it the url will have id=0, even after saving. To avoid
		// redirecting to a new url, with id=34324 (whatever the new id is), we use the 
		// Post id instead.
		$postid	= JRequest::getVar( 'id' , 0 , 'POST' );
		if(!empty($postid))
		{
			$id = $postid;
		}
				
		// load the editor
		$row	=& JTable::getInstance( 'Content' , 'Myblog' );
		$row->load($id);

		$isNew	= true;
		
		if($row->id != '0' || $row->id != 0)
			$isNew	= false;

		// If post var exist, bind them
		if(!empty($_POST))
			$row->bind($_POST, true);

		// Check if state is published or unpublished.
		if(!myGetUserCanPublish())
		{
		    // User may not be able to publish or unpublish even if they try
		    // to hack the system by posting additional $_POST['state']
		    $row->state    = 0;
		}

		/**
		 * Check if creation of tags configuration is enabled. If not enabled,
		 * dont display add new tag form.
		 **/
		$userCreateTag  = (boolean) $_MY_CONFIG->get('enableUserCreateTags');
		
		/**
		 * Check if image browser / uploads are enabled.
		 **/
		$userImageBrowser	= (boolean) $_MY_CONFIG->get('useImageBrowser');

		$my				=& JFactory::getUser();

		// If user is admin, we dont want to disable the tag creations for him/her
		if($my->id == '62')
		{
		    $userCreateTag  = true;
		}

		// list of categories
		$categories = "";
		$categoriesArray = "";
		$query = "SELECT c.name,c.slug, count(c2.category) frequency FROM #__myblog_categories c left outer join #__myblog_content_categories c2 on (c.id=c2.category) GROUP BY c.name ORDER BY frequency DESC";
		$categoriesArray = myGetTagClouds($query); // get list of available tags

		// Process HTML for list of tags
		if ($categoriesArray != "")
		{
			foreach ($categoriesArray as $category)
			{
				$catclass = "tag".$category['cloud'];
				$catname = $category['name'];
				$catname_enc = $catname;
				
				$categories .= ", <a class=\"$catclass\" href=\"javascript:addTag('$catname_enc')\">$catname_enc</a>";
			}
		}
		$categories = trim($categories, ","); // available tags
		
		$tagListing	= '<span id="notags">None</span>';
		
		$db			=& JFactory::getDBO();
		if($row->id != 0)
		{
			// Display tags that this content uses.
			$strSQL	= "SELECT a.category AS id, b.name FROM #__myblog_content_categories AS a, #__myblog_categories AS b "
					. "WHERE b.id=a.category AND a.contentid='{$row->id}'";
			$db->setQuery( $strSQL );
			
			$tagList	= $db->loadObjectList();

			if($tagList != '')
			{
				$tagListing		= '';
				foreach($tagList as $tag)
				{
					$tagListing	.= '<span>'
								.  '<input type="hidden" value="' . $tag->name . '" name="tags[]">'
								.  '<a >X</a>' . $tag->name 
								.  '</span>';
				}
			}
		}
		else if ($row->id == '0' && $_MY_CONFIG->get('allowDefaultTags'))
		{
			// Load default tags
        	$strSQL	= "SELECT id,name FROM #__myblog_categories WHERE `default`='1'";
			$db->setQuery( $strSQL );

			$tagList	= $db->loadObjectList();

			if($tagList != '')
			{
				$tagListing		= '';
				foreach($tagList as $tag)
				{
					$tagListing	.= '<span>'
								.  '<input type="hidden" value="' . $tag->name . '" name="tags[]">'
								.  '<a >X</a>' . $tag->name 
								.  '</span>';
				}
			}
        }

		// Get list of tags
 		$strSQL	= 'SELECT * FROM #__myblog_categories';
 		$db->setQuery($strSQL);
 		$tags	= $db->loadObjectList();

		// Grab existing trackback URLs for this blog entry		
		$db->setQuery("SELECT url from #__myblog_tb_sent WHERE contentid='$row->id'");
		$trackbackurls = $db->loadObjectList();
		$trackbackcontent = "";
		
		if ($trackbackurls)
		{
			foreach ($trackbackurls as $trackbackurl)
			{
				if ($trackbackcontent != "")
					$trackbackcontent .= " ";
				$trackbackcontent .= $trackbackurl->url;
			}
		}

		// Grab created time if existing entry, otherwise set created time to current time if new entry
		if( !empty( $row->created ) ) 
		{
			// Convert datetime to time. For Joomla 1.5 users, the offset are not calculated by Joomla
			// It is stored as it is, so we need to add the offset back to the time as we removed it
			// when saving
			$date		=& JFactory::getDate( $row->created );
			
		}
		else
		{
			$date		=& JFactory::getDate();
		}
		$date->setOffSet( $mainframe->getCfg( 'offset' ) );
		
		// Show jomcomment locks in dashboard?
		$jcDashboard    = false;
		$enableDashboard    = $_MY_CONFIG->get('enableJCDashboard');
		$enableJC           = $_MY_CONFIG->get('useComment');
		$jcFile				= JPATH_ROOT . DS . 'components' . DS . 'com_jomcomment' . DS . 'jomcomment.php';
				
		if($enableDashboard && $enableJC && file_exists($jcFile))
			$jcDashboard    = true;
				
		// Save attempt
		$validation_msg = array();
		$message = "";
		
		$saving		= JRequest::getVar( 'saving' , '' , 'POST' );

		// Combine introtext and fulltext
		$readmoreTag = '<p id="readmore"><img src="'.MY_COM_LIVE.'/images/readmoreline.gif"/></p>';
		$readmore = (!empty($row->introtext) && !empty($row->fulltext))? $readmoreTag : '';
		$row->fulltext = $row->introtext . $readmore. $row->fulltext; 
		
		// Check if Jom comment is installed and enabled on myblog
		// No jomcomment tags, use default behaviour
		$jcState = 'disabled';
		if($jcDashboard)
		{
			// Check if there are any jomcomment locking tags in the text
			if(stristr($row->fulltext, '{jomcomment}') !== false)
			{
				// Set $jcState so that templates know comment is enabled.
				$jcState = 'enabled';
			
				// Remove {jomcomment} from being displayed.
				$row->fulltext = str_replace('{jomcomment}','',$row->fulltext);
			}
			else if(stristr($row->fulltext, '{!jomcomment}') !== false)
			{
				// Set $jcState so that templates know comment is disabled.
				$jcState = 'disabled';
		
				// Remove {jomcomment_lock} from being displayed.
				$row->fulltext = str_replace('{!jomcomment}','',$row->fulltext);
			}
			else
			{
				// Use default
				$jcState = 'default';
			}
		}

		$tpl->set('enableImageResize', $_MY_CONFIG->get('enableImageResize'));
		$tpl->set('trackbacks', myGetTrackbacks($row->id));
		$tpl->set('imageBrowser', $userImageBrowser);
		$tpl->set('userCreateTag',$userCreateTag);
		$tpl->set('jcState',$jcState);
		$tpl->set('message', $message);
		$tpl->set('jcDashboard',$jcDashboard);
		$tpl->set('validation_msg', $validation_msg);
		$tpl->set('jax_script', $jax->getScript());
		
		$tpl->set('date', $date->toFormat() );
		$tpl->set('trackback_urls', $trackbackcontent);
		$tpl->set('publishRights', myGetUserCanPublish());
		$tpl->set('publishStatus', true);
		$tpl->set('disableReadMoreTag' , $_MY_CONFIG->get('disableReadMoreTag') );
			// Build category selection if necessary
			$contentcat = '';
			//if($_MY_CONFIG->get('allowCategorySelection'))
			{
				$contentcat = '<label><strong>Category</strong><select name="esrt" id="esrt">';
				$cats = myGetCategoryList($_MY_CONFIG->get('postSection'));
				foreach($cats as $c){
					$contentcat .= '<option value="'.$c->id.'">'.$c->title.'</option>';
				}	
				$contentcat .= '</select></label>';
			}
				
			// Grab default publishing status defined in My Blog config.
			$row->id = intval($row->id);
			if($row->id == 0)
				$row->state = $_MY_CONFIG->get('defaultPublishStatus');
			
			$tpl->set('metakey', $row->metakey);
			$tpl->set('metadesc', $row->metadesc);
			$tpl->set('state', $row->state);
			$tpl->set('existingTags', $row->tags);
			$tpl->set('categories', $contentcat);
			$tpl->set('videobot',$_MY_CONFIG->get('enableAzrulVideoBot'));
			$tpl->set('tags', $tagListing);
			$tpl->set('fulltext', $row->fulltext);
			$tpl->set('id', $row->id);
			$tpl->set('permalink', $row->permalink);
			$tpl->set('title', $row->title);
			$tpl->set('use_mce', $_MY_CONFIG->get('useMCEeditor') ? "true" : "false");

			$user		=& JTable::getInstance( 'Blogger' , 'Myblog' );
			$user->load( $my->id );
			
			$tpl->set( 'goGears' , $user->googlegears );
		
			$html = $tpl->fetch(MY_TEMPLATE_PATH."/admin/write.html");
			$html = str_replace("src=\"icons", "src=\"" . rtrim( JURI::root() , '/' ) . "/components/com_myblog/templates/admin/icons", $html);
			
			# Perform ping to server so user does not get logged out while writing/editing
			$html .= '<script language="Javascript" type="text/javascript">';
			$html .= 'setTimeout("jax.call(\'myblog\',\'myxPingMyBlog\')", 120000);';
			$html .= '</script>';
		
			echo $html;
	}

	function login()
	{
		global $_MY_CONFIG;

		$mainframe	=& JFactory::getApplication();
		
		$task		= JRequest::getVar( 'task' , '' , 'REQUEST' );
		$id			= JRequest::getVar( 'id' , 0 , 'GET' );
		$db			=& JFactory::getDBO();
		
		if(!class_exists('JAX'))
		{
			require_once( JPATH_PLUGINS . DS . 'system' . DS . 'pc_includes' . DS . 'ajax.php' );
		}
		
		$jax	= new JAX( rtrim( JURI::root() , '/' ) . '/plugins/system/pc_includes' );
		$jax->setReqURI( rtrim( JURI::root() , '/' ) . 'index.php?tmpl=component' );
		$jax->process();
	
		$session	= JRequest::getVar( 'session' , '' , 'GET' );

		$user		=& JFactory::getUser();
		
		if($session)
		{
			// Override cms->user
			$user		= myGetUser($session);
		}
		
		global $Itemid;
		
		# if Itemid is 0, need to autodetect itemid
		if ($Itemid==0)
		{
			# first detect userblog itemid
			$db->setQuery("select id from #__menu where link LIKE 'index.php?option=com_myblog%task=userblog%' and published='1'");
			$myItemid = $db->loadResult();
			
			if (!$myItemid) {
				# then detect main myblog component itemid if userblog link DNE
				$db->setQuery("select id from #__menu where type='components' and link='index.php?option=com_myblog' and published='1'");
				$myItemid = $db->loadResult();
			}
			
			if ($myItemid)
				$Itemid=$myItemid;
		}
		
		# Displays login form for a user if login form enabled and user is not logged in while viewing dashboard
		# - useLoginForm is removed as we require a login form.
		if (!isset($user->id) || !$user->id)
		{
			$dashboardLink	= base64_encode( rtrim( JURI::root() , '/' ) . 'index.php?option=com_myblog&task=write&no_html=1&id=0&tmpl=component' );
		?>
		<form action="<?php echo rtrim( JURI::root() , '/' ) . '/index.php';?>" method="POST" name="login" id="form-login" >
			<fieldset class="input">
			<p id="form-login-username">
				<label for="modlgn_username"><?php echo JText::_('Username') ?></label><br />
				<input id="modlgn_username" type="text" name="username" class="inputbox" alt="username" size="18" />
			</p>
			<p id="form-login-password">
				<label for="modlgn_passwd"><?php echo JText::_('Password') ?></label><br />
				<input id="modlgn_passwd" type="password" name="passwd" class="inputbox" size="18" alt="password" />
			</p>
			<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
			<p id="form-login-remember">
				<label for="modlgn_remember"><?php echo JText::_('Remember me') ?></label>
				<input id="modlgn_remember" type="checkbox" name="remember" class="inputbox" value="yes" alt="Remember Me" />
			</p>
			<?php endif; ?>
				<input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />
				</fieldset>
			<ul>
				<li><a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>"><?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a></li>
			</ul>
			<input type="hidden" name="option" value="com_user" />
			<input type="hidden" name="task" value="login" />
			<input type="hidden" name="return" value="<?php echo $dashboardLink;?>" />
		
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<?php
		}
		else
		{
			// User is already authenticated
			$this->display();
		}
	}
}
