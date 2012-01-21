<?php
/**
 * @version		$Id: items.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementItems extends JElement
{

	var	$_name = 'items';

	function fetchElement($name, $value, &$node, $control_name){
		$document = & JFactory::getDocument();
		$js = "		
		function jSelectItem(id, title, object) {
			var exists = false;
			$$('#itemsList input').each(function(element){
					if(element.value==id){
						alert('".JText::_('Item exists already in the list')."');
						exists = true;			
					}
			});
			if(!exists){
				var container = new Element('div').injectInside($('itemsList'));
				var img = new Element('img',{'class':'remove', 'src':'images/publish_x.png'}).injectInside(container);
				var span = new Element('span',{'class':'handle'}).setHTML(title).injectInside(container);
				var input = new Element('input',{'value':id, 'type':'hidden', 'name':'".$control_name."[".$name."][]'}).injectInside(container);
				var div = new Element('div',{'style':'clear:both;'}).injectInside(container);
				fireEvent('sortingready');
				alert('".JText::_('Item added in the list')."');			
			}
		}
		
		window.addEvent('domready', function(){			
			fireEvent('sortingready');
		});
		
		window.addEvent('sortingready', function(){
			new Sortables($('itemsList'), {
			 	handles:$$('.handle')
			
			});
			$$('#itemsList .remove').addEvent('click', function(){
				$(this).getParent().remove();
			});
		});
		";

		$document->addScriptDeclaration($js);
		
		$css = "
		#itemsList {
			height:100px;
			overflow:hidden;
		}
		#itemsList span {
			display:inline-block;
			height:16px;
			line-height:16px;
		}
		#itemsList span.handle {
			cursor:move;
		}
		#itemsList img.remove {
			width:16px;
			height:16px;
			margin-right:4px;
			cursor:pointer;
			float:left;
		}
		";
		$document->addStyleDeclaration($css);
		$current = array();
		if(is_string($value) && !empty($value))
			$current[]=$value;
		if(is_array($value))
			$current=$value;
			
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		$output = '<div id="itemsList">';
		foreach($current as $id){
			$row = &JTable::getInstance('K2Item', 'Table');
			$row->load($id);
			$output .= '
			<div>
				<img class="remove" src="images/publish_x.png"/>
				<span class="handle">'.$row->title.'</span>
				<input type="hidden" value="'.$row->id.'" name="'.$control_name.'['.$name.'][]"/>
				<div style="clear:both;"></div>
			</div>
			';
		}
		$output .= '</div>';
		return $output;
	}
}
