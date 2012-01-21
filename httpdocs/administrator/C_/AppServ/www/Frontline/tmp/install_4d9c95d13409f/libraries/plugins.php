<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

global $_MY_CONFIG;

class MYPlugins
{	
	/** Private Properties **/
	var $_folder	= '';		// Plugins / Mambots folder
	var $_events	= null;

	function MYPlugins()
	{

		// Include our custom cmslib if its not defined
		if(!defined('MYPluginsDB'))
			include_once (MY_MODEL_PATH . '/plugins.db.php');

		$this->_db	= new MYPluginsDB();

		// Set the plugins / mambots folder for this specific environment.
		$this->_folder	= JPATH_PLUGINS;
	}
	
	/**
	 * Load plugins for specific event.
	 **/	 	
	function load()
	{
		$mainframe	=& JFactory::getApplication();
		$plugins	= $this->_db->getPlugins();
		
		if($plugins)
		{
			foreach($plugins as $plugin)
			{
			    // Instead of including the mambots, we allow the mainframe mambot to include for us.
			    // so that other module that has triggers would not come up with an error.
			    $plugin->folder 		= 'content';
			    $plugin->published 	= '1';
			    $plugin->params		= null; // no params
			
				JRequest::setVar( 'task' , 'view' , 'GET' );
				JRequest::setVar( 'option' , 'com_content' , 'GET' );
	
				// Import plugin.
				JPluginHelper::importPlugin('content', $plugin->element);
				$plg	= JPluginHelper::getPlugin('content' , $plugin->element);
				
				
				$dispatcher	=& JDispatcher::getInstance();
				$plgObj		= 'plgContent' . ucfirst($plg->name);
				
				if( class_exists( $plgObj ) )
				{
					
					$instance = new $plgObj($dispatcher , (array) $plg);
					
					if( method_exists($instance , 'onPrepareContent') )
					{
						$this->register( 'onPrepareContent' , $plgObj , $plugin->params , $plugin->published );
					}
					
					if( method_exists($instance , 'onBeforeDisplayContent') )
					{
						$this->register( 'onBeforeDisplayContent' , $plgObj , $plugin->params , $plugin->published );
					}

					if( method_exists($instance , 'onAfterDisplayContent') )
					{
						$this->register( 'onAfterDisplayContent' , $plgObj , $plugin->params , $plugin->published );
					}
				}
				else 
				{
					foreach($dispatcher->_observers as $observer)
					{
						if( is_array($observer) )
						{
							if($observer['event'] == 'onPrepareContent')
							{
								$this->register('onPrepareContent', $observer['handler'], $plugin->params, $plugin->published);
							}

							if($observer['event'] == 'onBeforeDisplayContent')
							{
								$this->register('onBeforeDisplayContent', $observer['handler'], $plugin->params, $plugin->published);
							}

							if($observer['event'] == 'onAfterDisplayContent')
							{
								$this->register('onAfterDisplayContent', $observer['handler'], $plugin->params, $plugin->published);
							}
						}
					}
				}
			}// End for loop
		}// End if
	}// End function

	/**
	 * Register specific plugin in our events list
	 **/	 	
	function register($event, $handler, $params, $published = 1)
	{		
		if(!isset($this->_events[$event])) 
			$this->_events[$event]	= array();
	
		if(!in_array($handler, $this->_events[$event]))
			$this->_events[$event][] = $handler;
	}
	
	/**
	 * Call the necessary mambots to run.
	 **/	 	
	function _callFunction($handler, &$row, &$params, $page, $event)
	{
		if( class_exists($handler) )
		{
			$dispatcher	=& JDispatcher::getInstance();

			// load plugin parameters
			$plugin =& JPluginHelper::getPlugin('content' , $handler);

			// create the plugin
			$instance = new $handler($dispatcher, (array)($plugin));

			
			return $instance->$event($row, $params , $page);
		}
		else if( function_exists($handler) )
		{
			return call_user_func_array($handler, array(&$row, &$params, $page));
		}
	}
	
	function trigger($event, &$row, &$params, $page = '0')
	{
		$result	= '';
		if(isset($this->_events[$event]))
		{
			foreach($this->_events[$event] as $handler)
			{
				//var_dump($handler);
				$result	.= $this->_callFunction($handler, $row, $params, $page, $event);
			}
		}
 		return $result;
	}
	
	/**
	 * Initialize all mambots / plugins to be stored into #__myblog_mambots	 
	 **/	 	
	function init()
	{
		$this->_db->initPlugins();
	}
	
	function get($limitstart, $limit)
	{
		return $this->_db->get($limitstart, $limit);
	}
	
	function getTotal()
	{
		return $this->_db->getTotal();
	}
}