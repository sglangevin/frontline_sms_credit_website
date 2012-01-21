<?php
/**
 * Main Plugin File
 * Does all the magic!
 *
 * @package     Modalizer
 * @version     2.3.2
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright © 2011 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport( 'joomla.event.plugin' );

/**
* Plugin that replaces stuff
*/
class plgSystemModalizer extends JPlugin
{
	/**
	* Constructor
	*
	* For php4 compatibility we must not use the __constructor as a constructor for
	* plugins because func_get_args ( void ) returns a copy of all passed arguments
	* NOT references. This causes problems with cross-referencing necessary for the
	* observer design pattern.
	*/
	function plgSystemModalizer( &$subject, $config )
	{
		parent::__construct( $subject, $config );
	}

	function onAfterRoute()
	{
		$this->_pass = 0;

		// return if disabled via url
		// return if current page is raw format
		// return if current page is a joomfishplus page
		if (
				JRequest::getCmd( 'disable_modalizer' )
			||	JRequest::getCmd( 'format' ) == 'raw'
			||	JRequest::getCmd( 'option' ) == 'com_joomfishplus'
		) {
			return;
		}

		// load the admin language file
		$lang =& JFactory::getLanguage();
		$lang->load( 'plg_'.$this->_type.'_'.$this->_name, JPATH_ADMINISTRATOR, 'en-GB' ); // Loads English language file as fallback (for undefined stuff in other language file)
		$lang->load( 'plg_'.$this->_type.'_'.$this->_name, JPATH_ADMINISTRATOR, null, 1 );

		$mainframe =& JFactory::getApplication();

		// return if NoNumber! Elements plugin is not installed
		jimport( 'joomla.filesystem.file' );
		if ( !JFile::exists( JPATH_PLUGINS.DS.'system'.DS.'nonumberelements.php' ) ) {
			if ( $mainframe->isAdmin() && JRequest::getCmd( 'option' ) !== 'com_login' ) {
				$mainframe->enqueueMessage( '', 'error' );
				$msg = JText::_( 'MDL_NONUMBER_ELEMENTS_PLUGIN_NOT_INSTALLED' );
				foreach ( $mainframe->_messageQueue as $m ) {
					if ( $m['message'] == $msg ) {
						$msg = '';
						break;
					}
				}
				$mainframe->enqueueMessage( $msg, 'error' );
			}
			return;
		}

		// return if current page is an administrator page (and not acymailing)
		if ( $mainframe->isAdmin() && JRequest::getCmd( 'option' ) != 'com_acymailing' ) { return; }

		$this->_pass = 1;

		// Load plugin parameters
		require_once JPATH_PLUGINS.DS.'system'.DS.'nonumberelements'.DS.'helpers'.DS.'parameters.php';
		$parameters =& NNParameters::getParameters();
		$params = $parameters->getParams( $this->params->_raw, JPATH_PLUGINS.DS.$this->_type.DS.$this->_name.'.xml' );

		// Include the Helper
		require_once JPATH_PLUGINS.DS.$this->_type.DS.$this->_name.DS.'helper.php';
		$class = get_class( $this ).'Helper';
		$this->helper = new $class ( $params );
	}

	function onAfterDispatch()
	{
		if ( $this->_pass ) {
			$this->helper->placeScripts();
		}
	}

	function onAfterRender()
	{
		if ( $this->_pass ) {
			$this->helper->onAfterRender();
		}
	}
}
