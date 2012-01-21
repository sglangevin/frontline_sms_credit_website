<?php
/**
 * @package		Azrul System Mambot
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
(defined('_VALID_MOS') or defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

define('JAX_SITE_ROOT', dirname(dirname(dirname(dirname(__FILE__)))));
define('AZRUL_SYSTEM' , '1.3');

/** Define some constants that can be used by the system **/
if( !defined( 'AZRUL_SYSTEM_PATH' ) )
{
	// Get the real system path.
	$system	= rtrim(  dirname( dirname( __FILE__ ) ), '/' );

	define( 'AZRUL_SYSTEM_PATH' , $system );
}
$helper	= AZRUL_SYSTEM_PATH . '/pc_includes/helper.php';

// Test if file exists before trying to include and generate errors on the entire site.
if( file_exists( $helper ) )
{
	include_once( $helper );
}
else
{
	// If file doesn't exists, just quit it now.
	return;
}

global $jaxFuncNames;
$jaxFuncNames  = array();

if(!class_exists('JAXResponse')){

class JAXResponse
{
	
	var $_response = null;
	
	function JAXResponse(){
		$this->_response = array();
	}
	
	function object_to_array($obj) {
       $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
       $arr = array();
       foreach ($_arr as $key => $val) {
               $val = (is_array($val) || is_object($val)) ? $this->object_to_array($val) : $val;
               $arr[$key] = $val;
       }
       return $arr;
	}
	
	/**
	 * Assign new sData to the $sTarget's $sAttribute property
	 */	 	
	function addAssign($sTarget,$sAttribute,$sData){
		//$sData = $this->_hackString($sData);
		//$sData = preg_replace("((\r\n)+)", '', $sData);
		$this->_response[] = array('as', $sTarget, $sAttribute, $sData);
	}
	
	/**
	 * Clear the given target property
	 */	 	
	function addClear($sTarget,$sAttribute){
		$this->_response[] = array('as', $sTarget, $sAttribute, "");
	}
	
	function addCreate($sParent, $sTag, $sId, $sType=""){
		$this->_response[] = array('ce', $sParent, $sTag, $sId);
	}
	
	function addRemove($sTarget){
		$this->_response[] = array('rm', $sTarget);
	}
	
	/**
	 * Assign new sData to the $sTarget's $sAttribute property
	 */	 	
	function addAlert($sData){
		$this->_response[] = array('al', "", "", $sData);
	}
	
	function _hackString($str){
		# Convert '{' and '}' to 0x7B and 0x7D
	    //$str = str_replace(array('{', '}'), array('&#123;', '&#125;'), $str);	   
		return $str;
	}
	
	/**
	 * Add a script call
	 */	 	
	function addScriptCall($func){
		$size = func_num_args();
		$response = "";

		if($size > 1){
			$response = array();
		
			for ($i = 1; $i < $size; $i++) {
				$arg = func_get_arg($i);
				$response[] = $arg;
			}
		}
		
		
		$this->_response[] = array('cs', $func, "", $response);
	}
	
	function encodeString($contents){
	    $ascii = '';
	    $strlen_var = strlen($contents);
	
	   /*
	    * Iterate over every character in the string,
	    * escaping with a slash or encoding to UTF-8 where necessary
	    */
	    for ($c = 0; $c < $strlen_var; ++$c) {
	
	        $ord_var_c = ord($contents{$c});
	
	        switch ($ord_var_c) {
	            case 0x08:  $ascii .= '\b';  break;
	            case 0x09:  $ascii .= '\t';  break;
	            case 0x0A:  $ascii .= '\n';  break;
	            case 0x0C:  $ascii .= '\f';  break;
	            case 0x0D:  $ascii .= '\r';  break;

	            default:
	                $ascii .= $contents{$c};
	          }
	    } 
	    
	    
	    return $ascii;
	    
	    //return $this->_hackString($ascii);
	}
	
	/**
	 * Flush the output back
	 */	 	
	function sendResponse(){
	    
		
		$obEnabled  = ini_get('output_buffering');

		if($obEnabled == "1" || $obEnabled == 'On')
		{
			$ob_active = ob_get_length () !== FALSE;
			if($ob_active)
			{
				while (@ ob_end_clean());
					if(function_exists('ob_clean'))
					{
						@ob_clean();
					}
			}
			ob_start();
		}
	
		// Send text/html if we're using iframe
		if(isset($_GET['func']))
		{
			$iso		= '';
			
			if( azrulGetJoomlaVersion() == '1.5' )
			{
				$iso	= 'UTF-8';
			}
			else
			{
				global $mainframe;
				
				$lang   = 'english';
				
				// loads english language file by default
				if ($mainframe->getCfg('lang') != '')
				{
				    $lang   =& $mainframe->getCfg('lang');
				}
	
				// If the $lang is still empty, force it to be english
				if($lang == '' || empty($lang))
					$lang   = 'english';
	
				include_once( JAX_SITE_ROOT . '/language/' . $lang . '.php' );
				
				$iso	= explode( '=' , _ISO );
			}			
			header("Content-type: text/html; $iso");
		}else
			header('Content-type: text/plain');
		
		if(!defined('SERVICES_JSON_SLICE'))
			include_once( AZRUL_SYSTEM_PATH . '/system/pc_includes/JSON.php');
		
		$json = new Services_JSON();
		
		# Encode '{' and '}' characters
				
		# convert a complex value to JSON notation
		$output = $json->encode($this->_response);
		
		if(isset($_GET['func']))
			$output = "<body onload=\"parent.jax_iresponse();\">" . htmlentities($output). "</body>";
		echo(($output));
		exit;
	}
}

class JAX
{
	var $_html = "";
	var $_funct = null;
	var $_path = "";
	var $livePath = "";
	var $_reqURL = "";
	var $_param = null;
	
	function JAX($livepath, $param= null){
		$this->_funct = array();
		$this->_path  = dirname(__FILE__);
		$this->_livePath = $livepath;
		$this->_param = $param;
		
	}
	
	function registerFunction($mFunction){
		$this->_funct[] = $mFunction;
	}
	
	function addAssign(){
	}
	
	function setReqURI($reqURL){
		$this->_reqURL = $this->_fixHTTPS($reqURL);
	}
	
	function _fixHTTPS($content){
		global $mainframe;
		
		$reqURI		= AZRUL_BASE_LIVE;
		//$reqURI   = $mainframe->getCfg('live_site');
	
		# if host have wwww, but mosConfig doesn't
		if(isset($_SERVER['HTTP_HOST']))
		{		
			if((substr_count($_SERVER['HTTP_HOST'], "www.") != 0) && (substr_count($reqURI, "www.") == 0))
			{
				$reqURI = str_replace("://", "://www.", $reqURI);		
			} else if((substr_count($_SERVER['HTTP_HOST'], "www.") == 0) && (substr_count($reqURI, "www.") != 0))
			{
				// host do not have 'www' but mosConfig does
				$reqURI = str_replace("www.", "", $reqURI);
			}
		}
		
		
	
		/* Check for HTTPS */
		if(isset($_SERVER))
		{
			if(isset($_SERVER['HTTPS']))
			{
				if(strtolower($_SERVER['HTTPS']) == "on" )
				{
					$reqURI = str_replace("http://", "https://", $reqURI);
				}
			}
		}
		else if(isset($_SERVER['REQUEST_URI']))
		{
			// use REQUEST_URI method
			if(strpos($_SERVER['REQUEST_URI'], 'https://') === FALSE)
			{
				// not a https
			}
			else
			{
				$reqURI = str_replace("http://", "https://", $reqURI);
			}
		}
	
		return str_replace( AZRUL_BASE_LIVE , $reqURI, $content);
	}
	
	/**
	 * Return the script thatshould be added to the <head> section
	 */	 	
	function getScript()
	{
		global $mainframe;
		
		$reqURI = $this->_reqURL;
		$compress	= $mainframe->getCfg('gzip');

		# if host have wwww, but mosConfig doesn't
		//if (substr($_SERVER['HTTP_HOST'], 0, 4) == "www.") {
		if((substr_count(@$_SERVER['HTTP_HOST'], "www.") != 0) && (substr_count($reqURI, "www.") == 0))
		{
			$reqURI = str_replace("://", "://www.", $reqURI);		
		} else if((substr_count(@$_SERVER['HTTP_HOST'], "www.") == 0) && (substr_count($reqURI, "www.") != 0))
		{
			// host do not have 'www' but mosConfig does
			$reqURI = str_replace("www.", "", $reqURI);
		}
	
		/* Check for HTTPS */
		if(isset($HTTP_SERVER_VARS))
		{
			if(isset($HTTP_SERVER_VARS['HTTPS']))
			{
				if($HTTP_SERVER_VARS['HTTPS'] == "ON" )
				{
					$reqURI = str_replace("http://", "https://", $reqURI);
				}
			}
		}
		$siteType	= azrulGetJoomlaVersion() == '1.5' ? '1.5' : '1.0';
	
		$html = 
"<script type='text/javascript'>
/*<![CDATA[*/
	var jax_live_site = '$reqURI';
	var jax_site_type = '$siteType';
/*]]>*/
</script>";
		$html .= "<script type=\"text/javascript\" src=\"$this->_livePath/ajax_" . AZRUL_SYSTEM . ".js\"></script>\n";
		return $this->_fixHTTPS($html);
	}
	
	function nl2brStrict($text) {
		return preg_replace("/\r\n|\n|\r/", " <br />", $text);
	}
	
	function br2nl($text){
		$text = str_replace(' <br />', "\n", $text);
		return $this->_fixQuote($text);	
	}
	
	function _fixQuote($text){
		return str_replace('&quot;', '"', $text);
	}

	function singleLineIt($text){
		return preg_replace("((\r\n)+)", '', $text);
	}
		
	/**
	 *
	 */	 	
	function process()
	{
		global $mainframe;

		if(!defined('SERVICES_JSON_SLICE'))
		{
			include_once( AZRUL_SYSTEM_PATH . '/pc_includes/JSON.php');
		}
			
		$json = new Services_JSON();
		global $my, $mainframe;
		
		if(@isset($_REQUEST['task']) && ($_REQUEST['task'] == 'azrul_ajax'))
		{	
			if(!isset($my))
				$my = $mainframe->getUser();
			
			$func = @$_REQUEST['func'];
			
			// Security fix.
			// 1. check if user are trying to run an eval
			
			# build an array of args
			$args = array();
			$argCount = 0;
			
			# All POST data that are meant to be send to the function will
			# be appended by 'arg' keyword. Only pass this vars to the function
			foreach($_REQUEST as $key => $postData)
			{
				if(substr($key, 0, 3) == 'arg' )
				{
					//if ( get_magic_quotes_gpc() ) {
						$postData = stripslashes($postData);
					//}


					$postData = ($this->nl2brStrict($postData));
					//var_dump($postData);				
					$decoded = $json->decode($postData);
					$key = "";
					$val = "";

// print_r($decoded);
// exit;
					# if the args is an array, we need to pass it as an array
					# todo@ we need to expand this array further. We now assume,
					# if an array is passed, it comes in a pair of (key/value)												
					if(is_array($decoded))
					{
						foreach($decoded as $index => $value)
						{
							$tempArray	= array();
							
							if( is_array($value) )
							{
								foreach($value as $val)
								{
									
									
									// The value is an array so we need to chuck them in
									// a multidimensional array instead
									if( is_array($val) )
									{
										// Since the values here are array, we will
										// always assume that the index 0 is always the key
										$key	= $val[0];
										$data	= $this->br2nl( rawurldecode($val[1]) );
										
										// We will also always assume that the index 1 will be the value
										$decoded[$key][]	= $data;
									}
									else
									{
										// We always assume that the index 0 is the key of the array.
										$key	= $value[0];
										
										// We always assume that the index 1 is the data of the array.
										$data	= $this->br2nl(rawurldecode($value[1]));
										
										if( substr($value[0], 0, 6) == '_d_' )
										{
											$decoded = array($val);
										}
										else
										{
											$newArray	= array( $key => $data );
											$decoded	= array_merge( $decoded, $newArray );
											//$newA		= array($key => $val);
											//$decoded	= array_merge($decoded, $newA);
										}
									}
								}
							} else{
								// If data passed is not array we treat
								if($value != '_d_' ){
									$decoded = $this->br2nl(rawurldecode($value));
								}
							}
						}

						$args[] = $decoded;
					} else {
						$args[] = $this->br2nl(rawurldecode($decoded));
					}
					$argCount++;
				}
			}

			# Include the main component file
			$comName = $_REQUEST['option'];
						
			ob_start();
			
			global $jaxFuncNames;
			
			
			// This is a really silly test!

			if(strpos($this->_reqURL, 'hidemainmenu=1') OR strpos($_SERVER['HTTP_REFERER'], 'administrator')){
				include_once(JAX_SITE_ROOT . "/administrator/components/com_$comName/admin.$comName.php");
				// Test, and make sure $my object is valid
				if(!$my->id){
					echo "Invalid access";
					exit;
				}
			}
			else {
				include_once(JAX_SITE_ROOT . "/components/com_$comName/$comName.php");
			}

			@ob_end_clean();
			
			$jaxFilename = JAX_SITE_ROOT . "/components/com_$comName/jax.$comName.php";
			@include_once($jaxFilename);
			// check and make sure the fucntion name is actually registered
			if(!in_array($func, $jaxFuncNames)){
				//print_r($jaxFuncNames);
				echo 'invalid function calls';
				exit;
			}
			
			$funcArray = explode(',', $func);
			
			// Object call
			if(count($funcArray) > 1){
				//$response = call_user_func_array($funcArray, $args);
				$entryPoint = $comName.'AjaxEntry';
				$arg = array();
				$arg[] = $func;
				$arg[] = $args;
				
				$response = call_user_func_array($entryPoint, $arg);
			} else
				$response = call_user_func_array($func, $args);
			//header('Content-type: text/plain');
			//echo $response;
			//exit;
		}
	}
	
}

}
