<?php
/**
 * Main Plugin File
 * Does all the magic!
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

$mainframe =& JFactory::getApplication();
if( $mainframe->isAdmin() ) {
	// load the NoNumber! Elements language file
	$lang =& JFactory::getLanguage();
	$lang->load( 'plg_system_nonumberelements', JPATH_ADMINISTRATOR, 'en-GB' ); // Loads English language file as fallback (for undefined stuff in other language file)
	$lang->load( 'plg_system_nonumberelements', JPATH_ADMINISTRATOR, null, 1 );
}

if ( $mainframe->isSite() && JRequest::getCmd( 'option' ) == 'com_search' ) {
	$classes = get_declared_classes();
	if ( !in_array( 'SearchModelSearch', $classes ) && !in_array( 'SearchModelSearch', $classes ) ) {
		require_once JPATH_PLUGINS.DS.'system'.DS.'nonumberelements'.DS.'helpers'.DS.'search.php';
	}
}

/**
* Plugin that loads Elements
*/
class plgSystemNoNumberElements extends JPlugin
{
	/**
	* Constructor
	*
	* For php4 compatibility we must not use the __constructor as a constructor for
	* plugins because func_get_args ( void ) returns a copy of all passed arguments
	* NOT references. This causes problems with cross-referencing necessary for the
	* observer design pattern.
	*/
	function plgSystemNoNumberElements( &$subject, $config )
	{
		parent::__construct( $subject, $config );

		$mainframe =& JFactory::getApplication();
		if( $mainframe->isSite() ) {
			return;
		}

		$template = $mainframe->getTemplate();
		if( $template == 'adminpraise3' ) {
			$document =& JFactory::getDocument();
			$document->addStyleSheet( JURI::root( true ).'/plugins/system/nonumberelements/css/ap3.css' );
		}
	}

	function onAfterRoute()
	{
		if( !JRequest::getInt( 'nn_qp' ) ) {
			return;
		}

		// Include the Helper
		require_once JPATH_PLUGINS.DS.'system'.DS.'nonumberelements'.DS.'helper.php';
		$this->helper = new plgSystemNoNumberElementsHelper;
	}
}