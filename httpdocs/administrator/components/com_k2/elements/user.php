<?php
/**
 * @version		$Id: user.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementUser extends JElement
{

	var $_name = 'User';

	function fetchElement($name, $value, & $node, $control_name)
	{
	
		$mainframe = &JFactory::getApplication();
	
		$db = & JFactory::getDBO();
		$doc = & JFactory::getDocument();
		$fieldName = $control_name.'['.$name.']';
	
		if ($value) {
			$user = & JFactory::getUser($value);
		}
		else {
			$user->name = JText::_('Select a user...');
		}
	
		$js = "
		function jSelectUser(id, title, object) {
			document.getElementById(object + '_id').value = id;
			document.getElementById(object + '_name').value = title;
			document.getElementById('sbox-window').close();
		}
		";
		
		$doc->addScriptDeclaration($js);
		$link = 'index.php?option=com_k2&amp;view=users&amp;task=element&amp;tmpl=component&amp;object='.$name;
	
		JHTML::_('behavior.modal', 'a.modal');
	
		$html = '
		<div style="float:left;">
			<input style="background:#fff;margin:3px 0;" type="text" id="' . $name . '_name" value="' . htmlspecialchars ( $user->name, ENT_QUOTES, 'UTF-8' ) . '" disabled="disabled" />
		</div>
		<div class="button2-left">
			<div class="blank">
				<a class="modal" title="' . JText::_ ( 'Select a user' ) . '"  href="' . $link . '" rel="{handler: \'iframe\', size: {x: 700, y: 450}}">'.JText::_('Select').'</a>
			</div>
		</div>
		<input type="hidden" id="' . $name . '_id" name="' . $fieldName . '" value="' . ( int ) $value . '" />
		';

		return $html;
	}

}
