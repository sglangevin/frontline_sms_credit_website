<?php
/**
 * Extension Install File
 * Does the stuff for the specific extensions
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

$name = 'Modalizer';
$alias = 'modalizer';
$ext = $name.' (system plugin)';

// SYSTEM PLUGIN
$states[] = installExtension( $alias, 'System - '.$name, 'plugin', array( 'folder'=>'system' ) );