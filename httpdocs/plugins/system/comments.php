<?php
/**
* denCODE v0.5
* @copyright (C) 2007 3DEN StudiO
* @package Joomla!
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
// no direct access
defined( '_JEXEC' ) or die( 'Access Denied!' );

// Import ComponentHelper or nothing at all
if( 
	!is_file(JPATH_SITE.DS.'components'.DS.'com_comments'.DS.'comments.php')
	|| 	!is_file(JPATH_SITE.DS.'modules'.DS.'mod_comments'.DS.'helper.php')
){
	JError::raiseWarning( 123, JText::_('COMPONENT NOT FOUND'));
	return;
}


/**
 * @package		Joomla
 */
class plgSystemComments extends JPlugin
{
	
	/**
	 * Generic Get Comments 
	 * @return html
	 * @param string $mode (form, list, link) what to display
	 * @param $item Object
	 * @param $params Object[optional]
	 */
	function onGetComments($mode, &$item, &$params=null)
	{
		//PARAMs
		$plgParams =& $this->_getParams(); 
		$plgParams->merge($params) or $plgParams->bind($params);	

		// Check Item
		if(is_object($item) ){
			$cotid = $item->id;
		}elseif(is_array($item)){
			$cotid = $item['id'];
		}else{
			$cotid = (int)$item;
		}

		// Set Params
		$plgParams->set('cotid', $cotid);
		$plgParams->set('mode', strtolower($mode));

		// Module
	  	$module = &JModuleHelper::getModule('mod_comments');		
		$module->params = $plgParams->toString();

		return JModuleHelper::renderModule($module);
	}


	/**
	 * on load content function
	 * 
	 * @return boolean True on sucess
	 * @param $row Object
	 * @param $params Object
	 * @param $page Object[optional]
	 */
	function onAfterDisplayContent( &$row, &$params, $page=0 ){		
	
		//Regular Expression
		$regex = '/\{comments(.*?)}/i';
		$total = preg_match_all( $regex, $row->text, $matches );
		if(!$total){
			return false;
		}
	
		// Custom Params			
		$parts = trim($matches[1][0]);
		$position = 'end';
		
		// Switch view
		switch( JRequest::getCmd('view') ){
			case 'article':
				$html = $this->onGetComments('list', $row, $params)
					. $this->onGetComments('form', $row, $params);
				break;
				
			default:
				$params->set('link', JRoute::_('index.php?option=com_content&view=article&id='.$row->slug.'&catid='.$row->catslug) );
				$html = $this->onGetComments('link' ,$row, $params); 
				$position = 'bottom'; 
				break;	
		}
		
		/************************************************************
		 *  Display 
		 ************************************************************/
		// Clean Comments tags
		$row->text = preg_replace( $regex, '', $row->text );
	
		// switch position
		switch($position){
			case 'end'://after content
				return $html;
				break;
			case 'bottom'://bottom of content
				$row->text .= $html;	
				break;
				
			case 'start'://[useless]before content
				echo $html;	
				break;		
			case 'top'://[useless]top of content
				$row->text = $html . $row->text;	
				break;		
		}
		return;
	}


	/**
	 * Display Captha
	 * @return 
	 */
	function onCaptcha_Display() {		
		$session =& JFactory::getSession();
       	$params =& $this->_getParams();
 /*      	
		require_once(JPATH_PLUGINS.DS.'system'.DS.'Captcha04'.DS."Functions.php"); // string generator, crypt/decrypt functions
		require_once(JPATH_PLUGINS.DS.'system'.DS.'Captcha04'.DS."GIFEncoder.class.php"); // gif animation
		$tries = $session->get('attempts');
		if ($tries > $this->max_tries) $rnd = 'You are a spambot';
		else $rnd = rnd_string	(intval($params->get('word_len')) );
		$cid = md5_encrypt	( $rnd );
		$uid = "54;".$cid;
		
		$session->set('bigo_uid',$cid); // secret word
		
		
		require_once(JPATH_PLUGINS.DS.'system'.DS.'Captcha04'.DS."CaptchaImage.php"); // creates the magic!
		exit(); 
*/
	}

	/**
	 * Confirm Captcha
	 * @return 
	 * @param $word Object
	 * @param $return Object
	 */
	function onCaptcha_confirm($word, &$return) {		
		global $mainframe;
/*
		require_once(JPATH_PLUGINS.DS.'system'.DS.'Captcha04'.DS."Functions.php");
		$session =& JFactory::getSession();
		
		// guessing protection
		$tries = 0; 
		$tries = $session->get('attempts');		
		$session->set('attempts', ++$tries);

		if (!$word || $tries > $this->max_tries) {
			return false;
		}
		
  		$correct = md5_decrypt ( $session->get('bigo_uid') );
  		$session->set('bigo_uid', null);
  		if (strtolower($word) == strtolower($correct)) {
  			$session->set('attempts',0); 
  			$return = true;
  		} else $return = false;  				
		return $return;
*/		
	}


	/**
	 * Get Comments parameters object
	 * 
	 * @return JParameter
	 */
	function &_getParams(){
		static $plgParams;
		if( !empty($plgParams) ){
			return $plgParams;		
		}
		
		$plugin =& JPluginHelper::getPlugin('system', 'comments');
		$plgParams = new JParameter( $plugin->params );
		
		// Some defs
		$plgParams->set('cache', 0);
		$plgParams->def('link_layout', 'link_readon');
		$plgParams->def('list_layout', 'list');
		$plgParams->def('form_layout', 'form');
		
		return $plgParams;
	}
}