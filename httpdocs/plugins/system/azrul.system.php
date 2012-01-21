<?php
/**
 * @package		Azrul System Mambot
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');


/** Define some constants that can be used by the system **/
if( !defined( 'AZRUL_SYSTEM_PATH' ) )
{
	// Get the real system path.
	$system	= rtrim(  dirname( __FILE__ ) , '/' );

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

if( !defined( 'AZRUL_SYSTEM_LIVE' ) )
{
	if( azrulGetJoomlaVersion() == '1.0' || azrulGetJoomlaVersion() == 'MAMBO' )
	{
		global $mosConfig_live_site;
		
		define( 'AZRUL_SYSTEM_LIVE' , rtrim( $mosConfig_live_site , '/' ) . '/mambots/system' );
	}
	else if( azrulGetJoomlaVersion() == '1.5' )
	{
		define( 'AZRUL_SYSTEM_LIVE' , rtrim( JURI::root() , '/' ) . '/plugins/system' );
	}
}

if( !defined( 'AZRUL_BASE_LIVE' ) )
{
	if( azrulGetJoomlaVersion() == '1.0' || azrulGetJoomlaVersion() == 'MAMBO' )
	{
		global $mosConfig_live_site;
		
		define( 'AZRUL_BASE_LIVE' , rtrim( $mosConfig_live_site , '/' ) );
	}
	else if( azrulGetJoomlaVersion() == '1.5' )
	{
		define( 'AZRUL_BASE_LIVE' , rtrim( JURI::root() , '/' ) );
	}
}

/**
 * Register the respective events
 **/ 
if( azrulGetJoomlaVersion() == '1.0' )
{
	global $_MAMBOTS;
	
	$_MAMBOTS->registerFunction( 'onAfterStart' , 'azrulSysBot' );
}
else if( azrulGetJoomlaVersion() == 'MAMBO' )
{
	global $_MAMBOTS;
	
	$_MAMBOTS->registerFunction( 'onHeaders' , 'azrulSysBot' );
}
else if( azrulGetJoomlaVersion() == '1.5' )
{
	global $mainframe;
	
	$mainframe->registerEvent( 'onAfterRoute' , 'azrulSysBot' );
}

// Include the template file as Jom Comment and My Blog needs this.
include_once( AZRUL_SYSTEM_PATH . DS . 'pc_includes' . DS . 'template.php');

/**
 * Display required javascript codes for AJAX function calls
 **/ 
function azrulSysBot()
{
	static	$added	= false;
	
	if( !$added )
	{
		$format		= 'html';
		
		// Don't display mambots on pdf view for 1.5
		if( azrulGetJoomlaVersion() == '1.5' )
		{
			$format		= JRequest::getWord( 'format' , 'html' );
			
			if( $format == 'pdf' )
			{
				return;
			}
		}
		
		// Include ajax file
		include_once( AZRUL_SYSTEM_PATH . '/pc_includes/ajax.php' );
		
		$jax	= new JAX( AZRUL_SYSTEM_LIVE . '/pc_includes' );
		$jax->setReqURI( AZRUL_BASE_LIVE . '/index.php' );
		$jax->process();
		
		if( !isset($_POST['no_html']) && $format == 'html' )
		{
			global $mainframe;
			
			$mainframe->addCustomHeadTag( $jax->getScript() );
		}
		$added	= true;
	}
}