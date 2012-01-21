<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filesystem.file' );

class MYAvatarBase
{
	var $_width		= '';
	var $_height	= '';
	var $_user		= '';
	
	var	$_default	= '';
	var $_email		= '';
	
	function MYAvatarBase($userId)
	{
		global $_MY_CONFIG;
		
		$this->_user	= $userId;
		$this->_email	= myGetAuthorEmail( $userId );
				
		$this->_width	= $_MY_CONFIG->get('avatarWidth');
		$this->_height	= $_MY_CONFIG->get('avatarHeight');
		
		$this->_default	= MY_COM_LIVE . '/images/guest.gif';
	}
	
	// Return the HTML code to be inserted as avatar
	function display($url = false)
	{
		global $_MY_CONFIG;
		
		$url		= !empty($url) ? $url : $this->_default;
		$alt		= myGetAuthorName($this->_user, $_MY_CONFIG->get('useFullName'));
		$content	= '';
		$link		= $this->_link();

		if($this->_link() && $_MY_CONFIG->get('linkAvatar'))
		{
			$content	= '<a href="' . $link . '">'
						. '<img src="' . $url . '" border="0" alt="' . $alt . '" width="' . $this->_width . '" height="' . $this->_height . '" />'
						. '</a>';
		}
		else
		{
			$content	= '<img src="' . $url . '" border="0" alt="' . $alt . '" width="' . $this->_width . '" height="' . $this->_height . '" />';
		}
		
		return $content;
	}
}

class MYGravatarAvatar extends MYAvatarBase
{
	// Returns html source
	function get()
	{
		global $_MY_CONFIG;
		
		$url	= 'http://www.gravatar.com/avatar.php?gravatar_id=' . md5(myGetAuthorEmail($this->_user))
				. '&default=' . urlencode($this->_default)	. '&size=' . $this->_width;
	
		return $this->display($url);
	}
	
	function _link()
	{
		return false;
	}
}

class MYFireboardAvatar extends MYAvatarBase
{
	// Fireboard configuration file
	var $_config	= '';
	
	// Fireboard configurations
	var $_version	= '';
	var $_src		= '';
	
	function _init()
	{

		// Test if this is prior to 1.0.5
		if( file_exists( $this->_config ) )
		{
			// We assume it might be version 1.0.5 and above
			require_once( $this->_config );
			global $fbConfig;
				
			$this->_config	= new fb_config();
			$this->_config->load();
		}
		else
		{
			$this->_config  = JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_fireboard' . DS . 'fireboard_config.php';
			include($this->_config);
			
			$this->_version	= $fbConfig['version'];
			$this->_src		= $fbConfig['avatar_src'];
		}
	}

	function _loadVars()
	{
		if( !is_object( $this->_config ) )
		{
			require( $this->_config );
			global $fbConfig;
		
			$obj	= new stdclass();
				
			$obj->avatar_src	= $fbConfig['avatar_src'];
			$obj->version		= $fbConfig['version'];
			
			$this->_config	= $obj;
		}
		
	}
		
	// Returns path to image
	function get()
	{
		$this->_config	= JPATH_ROOT . DS . 'components' . DS . 'com_fireboard' . DS . 'sources' . DS . 'fb_config.class.php';

		$this->_init();
		$this->_loadVars();
		
		if($this->_config->avatar_src == 'fb')
		{
			// Get fireboard avatar path
			$query	= "SELECT `avatar` FROM #__fb_users WHERE `userid`='{$this->_user}'";
			
			$db		=& JFactory::getDBO();
			
			$db->setQuery( $query );

			$relativePath	= $db->loadResult();
			
			if($relativePath)
			{
				$avatar		= '';
				
				if($this->_config->_version == '1.0.2' || $this->_config->_version == '1.0.3')
				{
					// Older versions
					$avatar	= '/components/com_fireboard/avatars/' . $relativePath;
				}
				else
				{
					// Newer versions
					$avatar	= '/images/fbfiles/avatars/' . $relativePath;
				}
				
				// Check if avatar file really exists.
				
				
				if( JFile::exists( JPATH_ROOT . $avatar ) )
				{
					return $this->display( rtrim( JURI::root() , '/' ) . $avatar);
				}
			}
		} else if($this->_config->avatar_src != 'cb')
		{
			// handling cases where fireboard avatar source is from clexus PM
		}
		return $this->display();
	}
	
	function _link()
	{
		global $Itemid;
		
		$link	= JRoute::_( 'index.php?option=com_fireboard&func=fbprofile&task=showprf&userid=' . $this->_user . '&Itemid=' . $Itemid );
		
		return $link;
	}
}

class MYCbAvatar extends MYAvatarBase
{
	
	function get()
	{
		$query	= "SELECT `avatar` FROM #__comprofiler WHERE `user_id`='{$this->_user}' AND `avatarapproved`='1'";
		$db		=& JFactory::getDBO();
		$db->setQuery( $query );

		$result	= $db->loadResult();

		if($result)
		{
			if( JFile::exists( JPATH_ROOT . DS . 'components' . DS . 'com_comprofiler' . DS . 'images' . DS . $result))
			{
				$url	= rtrim( JURI::root() , '/' ) . '/components/com_comprofiler/images/' . $result;

				return $this->display($url);
			}
			else if( JFile::exists( JPATH_ROOT . DS .'images' . DS .'comprofiler' . DS . $result))
			{
				$url	= rtrim( JURI::root() , '/' ) . '/images/comprofiler/' . $result;
				return $this->display($url);
			}
		}
		return $this->display();
	}
	
	function _link()
	{
		$link	= JRoute::_('index.php?option=com_comprofiler&task=userProfile&user=' . $this->_user );

		return $link;
	}
}

class MYSmfAvatar extends MYAvatarBase
{

	var $_path	= '';
	var $_db;
	
	function _selectDB( $server , $user , $password , $db )
	{
		static $selected;
		
		$selected	= false;
		if( !$selected )
		{
			$resource	= mysql_connect( $server , $user , $password );
		
			mysql_select_db( $db , $resource );
			
			$selected	= true;
		}
		return true;
	}
	
	function get()
	{
		global $_MY_CONFIG;
		
		$mainframe		=& JFactory::getApplication();
		$this->_path	= rtrim(trim($_MY_CONFIG->get('smfPath')), '/');
		

		if(!$this->_path || $this->_path == '' || !JFile::exists($this->_path . '/Settings.php')){
			$this->_path	= JPATH_ROOT . DS . 'forum';
		}

		// check for SMF bridge, then use SMF bridge settings if SMF bridge installed
		if(!$this->_path || $this->_path == '' || !JFile::exists($this->_path . '/Settings.php'))
		{
			$query	= "SELECT `id` FROM #__components WHERE `option`='com_smf'";
			$db		=& JFactory::getDBO();
			$db->setQuery( $query );

			if( $db->loadResult() )
			{
				$query	= "SELECT `value1` FROM #__smf_config WHERE variable='smf_path'";
				$db->setQuery( $query );

				$this->_path	= rtrim(str_replace("\\", "/", $db->loadResult() ) , "/");
			}
		}

		// need to get the settings as SMF db / tables can be in different location
		if(JFile::exists($this->_path . '/Settings.php'))
		{
			include($this->_path . '/Settings.php');

			mysql_select_db($mainframe->getCfg('db') , $this->cms->db->db);

			$this->_selectDB($db_server , $db_user , $db_passwd , $db_name );
			
			// query for user avatar, id using email address
			$strSQL	= sprintf("SELECT avatar, ID_MEMBER FROM {$db_prefix}members WHERE emailAddress='{$this->_email}'");
			$result	= mysql_query($strSQL);

			if($result)
			{
				$result_row	= mysql_fetch_array($result);
				mysql_select_db($mainframe->getCfg('db'));
				
				if($result_row){
					$id_member	= $result_row[1];
					
					if(trim($result_row[0]) != ''){
						if(substr($result_row[0], 0, 7) != 'http://'){
							$url	= $boardurl . '/avatars/' . $result_row[0];
							return $this->display($url);
						}else{
							$url	= $result_row[0];
							return $this->display($url);
						}
							
					} else {
						mysql_select_db($db_name);
						$strSQL	= sprintf("SELECT ID_ATTACH FROM {$db_prefix}attachments WHERE ID_MEMBER='{$id_member}' AND ID_MSG=0 AND attachmentType=0");
						$result = mysql_query($strSQL);
						
						if($result){
							$result_avatar = mysql_fetch_array($result);
							mysql_select_db($mainframe->getCfg('db'));
							if ($result_avatar[0]){
								$url = "$boardurl/index.php?action=dlattach;attach=" . $result_avatar[0] . ";type=avatar";
								return $this->display($url);
							}
						}
					}
				}
			}
		}
		return $this->display();
	}
	
	function _link()
	{
		$mainframe	=& JFactory::getApplication();
		
		if( JFile::exists($this->_path . '/Settings.php'))
		{
			include($this->_path . '/Settings.php');

			$this->_selectDB($db_server , $db_user , $db_passwd , $db_name );
			
			$strSQL	= sprintf("SELECT ID_MEMBER FROM {$db_prefix}members WHERE emailAddress='%s'", mysql_real_escape_string($this->_email));
			$result = mysql_query($strSQL);
			$result_row = @mysql_fetch_array($result);
			mysql_select_db($mainframe->getCfg('db'));
				
			if($result_row)
			{
				$link = $boardurl . "/index.php?action=profile&u=" . $result_row[0];
				return $link;
			}		
		}
		return false;
	}
}

class MYJuserAvatar extends MYAvatarBase
{

	// Returns html source
	function get()
	{
		$path	= JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_juser' . DS . 'avatars';		
		$path	= $path . '/' . myGetAuthorName($this->_user);
		
		$source	= rtrim( JURI::root() , '/' ) . '/administrator/components/com_juser/avatars/' . myGetAuthorName($this->_user);
		
		if( JFile::exists($path . '.gif'))
		{
			$source	.= '.gif';
		}
		else if(JFile::exists($path . '.png'))
		{
			$source .= '.png';
		}
		else if(JFile::exists($path . '.jpg'))
		{
			$source .= '.jpg';
		}
		else
		{
			return false;
		}
	
		return $this->display($source);
	}
	
	function _link()
	{
		return false;
	}
}

class MYJomsocialAvatar extends MYAvatarBase
{
	function _getPath()
	{
		$path	= JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php';
		
		return $path;
	}
	
	// Returns html source
	function get()
	{
		$core	= $this->_getPath();

		if( JFile::exists( $core ))
		{
			require_once( $core );
			
			$user	=& CFactory::getUser( $this->_user );
			
			return $this->display( $user->getThumbAvatar() );
		}

		return $this->display();
	}
	
	function _link()
	{
		$core	= $this->_getPath();
		
		if( file_exists( $core ))
		{
			require_once( $core );
			
			$url 	= CRoute::_('index.php?option=com_community&view=profile&userid=' . $this->_user );
			
			return $url;
		}
		return false;
	}
}

class MYNoneAvatar extends MYAvatarBase{
	
	function get(){
		return "";
	}
}