<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

$my		=& JFactory::getUser();
$db		=& JFactory::getDBO();

if( $my->id == 0 )
{
	echo 'Not authenticated';
	return;
}

$query	= JRequest::getVar( 'q' , '' , 'GET' );
$query	= strtolower($query);

if(!$query)
	return;

$query	= 'SELECT name FROM #__myblog_categories';
$db->setQuery( $query );

$tags	= $db->loadObjectList();

foreach ($tags as $key)
{
	if (strpos(strtolower($key->name), $query) !== false)
	{
		echo $key->name . "|\n";
	}
}