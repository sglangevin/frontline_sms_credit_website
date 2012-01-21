<?php
/**
 * @version		$Id: categorieslatest.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementCategoriesLatest extends JElement
{

	var	$_name = 'categorieslatest';

	function fetchElement($name, $value, &$node, $control_name){
		JHTML::_('behavior.modal');
		$document = & JFactory::getDocument();
		$js = "
		function jSelectCategory(id, title, object) {
			var exists = false;
			$$('#categoriesList input').each(function(element){
					if(element.value==id){
						alert('".JText::_('Category exists already in the list')."');
						exists = true;
					}
			});
			if(!exists){
				var container = new Element('div').injectInside($('categoriesList'));
				var img = new Element('img',{'class':'remove', 'src':'images/publish_x.png'}).injectInside(container);
				var span = new Element('span',{'class':'handle2'}).setHTML(title).injectInside(container);
				var input = new Element('input',{'value':id, 'type':'hidden', 'name':'".$control_name."[".$name."][]'}).injectInside(container);
				var div = new Element('div',{'style':'clear:both;'}).injectInside(container);
				fireEvent('sortingready2');
				alert('".JText::_('Category added in the list')."');
			}
		}

		window.addEvent('domready', function(){
			fireEvent('sortingready2');
		});

		window.addEvent('sortingready2', function(){
			new Sortables($('categoriesList'), {
			 	handles:$$('.handle2')
			});

			$$('#categoriesList .remove').addEvent('click', function(){
				$(this).getParent().remove();
			});
		});
		";

		$document->addScriptDeclaration($js);

		$css = "
		#categoriesList {
			padding:4px 0;
		}
		#categoriesList span {
			display:inline-block;
			height:16px;
			line-height:16px;
		}
		#categoriesList span.handle2 {
			cursor:move;
		}
		#categoriesList img.remove {
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

		$output = '
		<div class="button2-left">
			<div class="blank">
				<a class="modal" title="' .JText::_ ( 'Click to select one or more categories' ). '"  href="index.php?option=com_k2&view=categories&task=element&tmpl=component" rel="{handler: \'iframe\', size: {x: 700, y: 450}}">'.JText::_('Click to select one or more categories').'</a>
			</div>
		</div>
		<div style="clear:both;"></div>
		';

		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		$output.= '<div id="categoriesList">';
		foreach($current as $id){
			$row = & JTable::getInstance('K2Category', 'Table');
			$row->load($id);
			$output .= '
			<div>
				<img class="remove" src="images/publish_x.png"/>
				<span class="handle2">'.$row->name.'</span>
				<input type="hidden" value="'.$row->id.'" name="'.$control_name.'['.$name.'][]"/>
				<div style="clear:both"></div>
			</div>
			';
		}
		$output.='</div>';
		return $output;
	}
}
