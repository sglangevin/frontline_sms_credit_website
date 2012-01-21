<?php
/**
 * @version		$Id: moduletemplate.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementModuletemplate extends JElement
{

	var $_name = 'moduletemplate';

	function fetchElement($name, $value, &$node, $control_name) {

		jimport('joomla.filesystem.folder');

		$moduleName = $node->_attributes['modulename'];
		$moduleTemplatesPath = JPATH_SITE.DS.'modules'.DS.$moduleName.DS.'tmpl';
		$moduleTemplatesFolders = JFolder::folders($moduleTemplatesPath);

		$db =& JFactory::getDBO();
		$query = "SELECT template FROM #__templates_menu WHERE client_id = 0 AND menuid = 0";
		$db->setQuery($query);
		$defaultemplate = $db->loadResult();
		$templatePath = JPATH_SITE.DS.'templates'.DS.$defaultemplate.DS.'html'.DS.$moduleName;

		if (JFolder::exists($templatePath)){
			$templateFolders = JFolder::folders($templatePath);
			$folders = @array_merge($templateFolders, $moduleTemplatesFolders);
			$folders = @array_unique($folders);
		} else {
			$folders = $moduleTemplatesFolders;
		}

		$exclude = 'Default';
		$options = array ();
		foreach ($folders as $folder) {
			if (preg_match(chr(1).$exclude.chr(1), $folder)) {
				continue ;
			}
			$options[] = JHTML::_('select.option', $folder, $folder);
		}

		array_unshift($options, JHTML::_('select.option','Default','-- '.JText::_('Use default').' --'));

		return JHTML::_('select.genericlist', $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, $control_name.$name);

	}

}
