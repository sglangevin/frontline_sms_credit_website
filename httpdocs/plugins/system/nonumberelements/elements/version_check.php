<?php
/**
 * Element Include: VersionCheck
 * Methods to check if current version is the latest
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
 * Version Check Class (Include file)
 * Is an old file, so for backward compatibility
 */
class NoNumberVersionCheck
{
	function setMessage( $current_version = '0', $version_file = '' )
	{
		require_once JPATH_PLUGINS.DS.'system'.DS.'nonumberelements'.DS.'helpers'.DS.'versions.php';
		$versions = NNVersions::instance();

		echo $versions->getMessage( str_replace( 'version_', '', $version_file ), '', $current_version, 1 );
	}
}