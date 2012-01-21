<?php
/**
 * @version		$Id: categoriesmultiple.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementCategoriesmultiple extends JElement
{

	var	$_name = 'categoriesmultiple';

	function fetchElement($name, $value, &$node, $control_name){
		$db = &JFactory::getDBO();

		$query = 'SELECT m.* FROM #__k2_categories m WHERE published=1 AND trash = 0 ORDER BY parent, ordering';
		$db->setQuery( $query );
		$mitems = $db->loadObjectList();
		$children = array();
		if ($mitems){
			foreach ( $mitems as $v ){
				$pt 	= $v->parent;
				$list = @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}
		}
		$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );
		$mitems = array();

		foreach ( $list as $item ) {
			$mitems[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'.$item->treename );
		}
		
		$doc = & JFactory::getDocument();
		$js = "
		window.addEvent('domready', function(){
			
			$('paramscatfilter0').addEvent('click', function(){
				$('paramscategory_id').setProperty('disabled', 'disabled');
				$$('#paramscategory_id option').each(function(el) {
					el.setProperty('selected', 'selected');
				});
			})
			
			$('paramscatfilter1').addEvent('click', function(){
				$('paramscategory_id').removeProperty('disabled');
				$$('#paramscategory_id option').each(function(el) {
					el.removeProperty('selected');
				});

			})
			
			if ($('paramscatfilter0').checked) {
				$('paramscategory_id').setProperty('disabled', 'disabled');
				$$('#paramscategory_id option').each(function(el) {
					el.setProperty('selected', 'selected');
				});
			}
			
			if ($('paramscatfilter1').checked) {
				$('paramscategory_id').removeProperty('disabled');
			}
			
		});
		";
		
		$doc->addScriptDeclaration($js);
		$output= JHTML::_('select.genericlist',  $mitems, ''.$control_name.'['.$name.'][]', 'class="inputbox" style="width:90%;" multiple="multiple" size="10"', 'value', 'text', $value );
		return $output;
	}
}
