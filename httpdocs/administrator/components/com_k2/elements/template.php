<?php
/**
 * @version		$Id: template.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementTemplate extends JElement
{

	var $_name = 'template';

	function fetchElement($name, $value, & $node, $control_name) {
		
		jimport('joomla.filesystem.folder');
		$componentPath = JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'templates';
		$componentFolders = JFolder::folders($componentPath);
		$db =& JFactory::getDBO();
		$query = "SELECT template FROM #__templates_menu WHERE client_id = 0 AND menuid = 0";
		$db->setQuery($query);
		$defaultemplate = $db->loadResult();
		
		if(JFolder::exists(JPATH_SITE.DS.'templates'.DS.$defaultemplate.DS.'html'.DS.'com_k2'.DS.'templates')){
			$templatePath = JPATH_SITE.DS.'templates'.DS.$defaultemplate.DS.'html'.DS.'com_k2'.DS.'templates';
		} else {
			$templatePath = JPATH_SITE.DS.'templates'.DS.$defaultemplate.DS.'html'.DS.'com_k2';
		}
		
		if (JFolder::exists($templatePath)){
			$templateFolders = JFolder::folders($templatePath);
			$folders = @array_merge($templateFolders, $componentFolders);
			$folders = @array_unique($folders);
		}
		else {
			$folders = $componentFolders;
		}

		$exclude = 'default';
		$options = array ();
		foreach ($folders as $folder) {
			if (preg_match(chr(1).$exclude.chr(1), $folder)) {	
				continue ;
			}
			$options[] = JHTML::_('select.option', $folder, $folder);
		}
		
		array_unshift($options, JHTML::_('select.option', '', '-- '.JText::_('Use default').' --'));
		
		return JHTML::_('select.genericlist', $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, $control_name.$name);
	
	}

}
