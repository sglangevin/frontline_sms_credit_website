<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

require_once( MY_COM_PATH . DS . 'task' . DS . 'browse.base.php' );

class MyblogAdminTask extends MyblogBrowseBase
{		
	function MyblogAdminTask()
	{		
		$this->toolbar	= MY_TOOLBAR_HOME;	
	}
	
	function display()
	{
		$db 		=& JFactory::getDBO();
		
		// Get current action
		$action		= JRequest::getVar( 'do' , '' , 'GET' );

		// Check if sid is valid
		$sid		= JRequest::getVar( 'sid','','GET' );
		
		$strSQL	= "SELECT `cid` FROM #__myblog_admin WHERE `sid`='{$sid}'";
		$db->setQuery( $strSQL );
		
		$cid	= $db->loadResult();
		if( $cid )
		{
			if(method_exists( $this , $action))
				$content	= $this->$action($cid);
			else
				$content	= $this->_error();
		}
		else
		{
			$content	= $this->_error();
		}			
		return $content;
	}
	
	function publish($cid)
	{
		$db		=& JFactory::getDBO();
		
		// We know that the sid is valid.
		$strSQL	= "UPDATE #__content SET `state`='1' WHERE `id`='{$cid}'";
		$db->setQuery( $strSQL );
		$db->query();
		
		return 'Blog entry published.';
	}
	
	function unpublish($cid)
	{
		$db		=& JFactory::getDBO();
		
		// We know that the sid is valid.
		$strSQL	= "UPDATE #__content SET `state`='0' WHERE `id`='{$cid}'";
		$db->setQuery( $strSQL );
		$db->query();
		
		return 'Blog entry unpublished.';
	}

	function remove($cid)
	{
		$db		=& JFactory::getDBO();
		
		// We know that the sid is valid.
		$strSQL	= "DELETE FROM #__content WHERE `id`='{$cid}'";
		$db->setQuery( $strSQL );
		$db->query();
		
		return 'Blog entry removed.';
	}
	
	function _error()
	{
		return "<p><b>The link is invalid. You can use the backend to publish the comment.</b></p>";
	}

}