<?php
/**
 * Element: Load Language
 * Loads the English language file as fallback
 *
 * @package     NoNumber! Elements
 * @version     2.3.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright © 2011 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Load Language Element
 */
class JElementLoadLanguage extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Load Language';

	function fetchTooltip()
	{
		return;
	}

	function fetchElement( $name, $value, &$node )
	{
		require_once JPATH_PLUGINS.DS.'system'.DS.'nonumberelements'.DS.'helpers'.DS.'functions.php';
		$this->functions =& NNFunctions::getFunctions();
		$mt_version = $this->functions->getJSVersion();

		$document =& JFactory::getDocument();
		$document->addScript( JURI::root(true).'/plugins/system/nonumberelements/js/script'.$mt_version.'.js' );

		$extension =		$node->attributes( 'extension' );
		$admin =			$this->def( $node->attributes( 'admin' ), 1 );

		$path = $admin ? JPATH_ADMINISTRATOR : JPATH_SITE;
		// load the admin language file
		$lang =& JFactory::getLanguage();
		$lang->load( $extension, $path, 'en-GB' ); // Loads English language file as fallback (for undefined stuff in other language file)
		$lang->load( $extension, $path, null, 1 );

		$random = rand( 100000, 999999 );
		$html = '<div id="end-'.$random.'"></div><script type="text/javascript">NoNumberElementsHideTD( "end-'.$random.'" );</script>';

		return $html;
	}

	function loadLanguage( $extension, $admin = 1 )
	{
		if ( $extension ) {
			if ( $admin ) {
				$path = JPATH_ADMINISTRATOR;
			} else {
				$path = JPATH_SITE;
			}
			$lang =& JFactory::getLanguage();
			$lang->load( $extension, $path, 'en-GB' ); // Loads English language file as fallback (for undefined stuff in other language file)
			$lang->load( $extension, $path, null, 1 );

		}
	}

	function def( $val, $default )
	{
		return ( $val == '' ) ? $default : $val;
	}
}