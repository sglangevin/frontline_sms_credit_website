<?php
/**
 * @category	Azrul System Helper
 * @package		Azrul System Mambot
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */

(defined('_VALID_MOS') or defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

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

function azrulGetJoomlaVersion()
{
	static $version;

	if( !isset( $version ) )
	{	
		// Get the base path
		$base	= rtrim( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) , '/' );
		
	 	if( class_exists( 'JFactory' ) && defined( '_JEXEC' ) && file_exists( $base . '/libraries/joomla/factory.php') )
	 	{
	 		$version	= '1.5';
		}
		else if( defined( '_VALID_MOS' ) && class_exists( 'joomlaVersion' ) )
		{
			$version	= '1.0';
		}
		else if( defined( '_VALID_MOS') && class_exists( 'mamboCore' ) )
		{
			$version	= 'MAMBO';
		}
	}
	return $version;
}
