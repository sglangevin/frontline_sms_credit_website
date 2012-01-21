<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

class MYTechnorati
{

	/* Technorati api configurations */
	var $_server	= 'rpc.technorati.com';
	var $_port		= 80;
	var $_errorStr	= '';
	var $_errorNo	= '';
	var $_timeout	= 15;
	
	var $_blogName	= '';
	var $_blogURL	= '';
	
	var $_siteBlogName	= '';
	var $_siteBlogURL	= '';
	
	var $_userAgent		= '';
	
	function MYTechnorati($author, $userAgent)
	{		
		$this->_userAgent	= $userAgent;
		
		// Define blog properties that should be displayed in technorati.
		// Can be configured or modified.
		$this->_blogName	= "{$author}'s Blog Entries";
		$this->_blogURL		= JRoute::_('index.php?option=com_myblog&blogger=' . $author);
		
		$mainframe				=& JFactory::getApplication();
		
		$this->_siteBlogName	= $mainframe->get('sitename');
		$this->_siteBlogURL		= JRoute::_('index.php?option=com_myblog'); 
	}

	function ping()
	{
		$message	= xmlrpc_encode_request('weblogUpdates.ping', array($this->_blogName, $this->_blogURL));
		$socket		= $this->_open();
		
		// Cant connect to RPC server.
		if(!is_resource($socket))
			return;
		
		$socket 	= $this->_send($socket, $message, $this->_userAgent);
		$response	= fread($socket, 8192);	// Grab response from Technorati.
		$this->_close($socket);

		// Send technorati ping for site blog entries as well.
		$message2	= xmlrpc_encode_request('weblogUpdates.ping', array($this->_siteBlogName, $this->_siteBlogURL));
		$socket2	= $this->_open();
		
		// Cant connect to RPC server.
		if(!is_resource($socket2))
			return;

		$socket2	= $this->_send($socket2, $message2, $this->_userAgent);
		$response2	= fread ($socket2, 8192); // Grab response from Technorati
		$this->_close($socket2);
		
		return "<!--$this->_blogURL ping,technorati response: $response-->";
	}
	
	function _open(){
		$socket		= @fsockopen($this->_server, $this->_port, $this->_errorNo, $this->_errorStr, $this->_timeout);
		
		if(!is_resource($socket)){
			// Cant connect to RPC server.
			return;
		}
		return $socket;
	}
	
	function _send($socket, $message, $userAgent)
	{
		// Avoid stalling for too long if connection cannot be established.
		socket_set_timeout($socket, 15);
		
		fputs($socket, "POST /rpc/ping HTTP/1.0\r\n");
		fputs($socket, "User-Agent:".$userAgent."\r\n");
		fputs($socket, "Host:rpc.technorati.com\r\n");
		fputs($socket, "Content-type:text/xml\r\n");
		fputs($socket, "Content-length:" . strlen($message) . "\r\n");
		fputs($socket, "Connection:close\r\n\r\n");
		fputs($socket, $message);
		return $socket;
	}
	
	function _close($socket){
		if(!is_resource($socket))
			return;
		
		fclose($socket);
	}
}
