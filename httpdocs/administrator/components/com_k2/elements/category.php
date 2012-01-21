<?php
/**
 * @version		$Id: category.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementCategory extends JElement
{

	var	$_name = 'category';
	
	function fetchElement($name, $value, &$node, $control_name)
	{
		$db = &JFactory::getDBO();
		$query = 'SELECT m.* FROM #__k2_categories m WHERE published = 1 ORDER BY parent, ordering';
		$db->setQuery( $query );
		$mitems = $db->loadObjectList();
		$children = array();

		if ( $mitems )
		{
			foreach ( $mitems as $v )
			{
				$pt 	= $v->parent;
				$list 	= @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}
		}

		$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );
		$mitems = array();
		
		if($name=='categories'){
			$doc = & JFactory::getDocument();
			$js = "
			window.addEvent('domready', function(){
				setTask();
			})
			function setTask() {
				var counter=0;
				$$('#paramscategories option').each(function(el) {
					if (el.selected){
						value=el.value;
						counter++;
					}
				});
				if (counter>1 || counter==0){
					$('urlparamsid').setProperty('value','');
					$('urlparamstask').setProperty('value','');
					enableParams();
				}
				if (counter==1){
					$('urlparamsid').setProperty('value',value);
					$('urlparamstask').setProperty('value','category');
					disableParams();
				}
			}
			function disableParams(){
				$('paramsnum_leading_items').setProperty('disabled','disabled');
				$('paramsnum_leading_columns').setProperty('disabled','disabled');
				$('paramsleadingImgSize').setProperty('disabled','disabled');
				$('paramsnum_primary_items').setProperty('disabled','disabled');
				$('paramsnum_primary_columns').setProperty('disabled','disabled');
				$('paramsprimaryImgSize').setProperty('disabled','disabled');
				$('paramsnum_secondary_items').setProperty('disabled','disabled');
				$('paramsnum_secondary_columns').setProperty('disabled','disabled');
				$('paramssecondaryImgSize').setProperty('disabled','disabled');
				$('paramsnum_links').setProperty('disabled','disabled');
				$('paramsnum_links_columns').setProperty('disabled','disabled');
				$('paramslinksImgSize').setProperty('disabled','disabled');
				$('paramscatCatalogMode').setProperty('disabled','disabled');
				$('paramscatFeaturedItems').setProperty('disabled','disabled');
				$('paramscatOrdering').setProperty('disabled','disabled');
				$('paramscatPagination').setProperty('disabled','disabled');
				$('paramscatPaginationResults0').setProperty('disabled','disabled');
				$('paramscatPaginationResults1').setProperty('disabled','disabled');
				$('paramscatFeedLink0').setProperty('disabled','disabled');
				$('paramscatFeedLink1').setProperty('disabled','disabled');
				$('paramstheme').setProperty('disabled','disabled');
				
			}
			function enableParams(){
				$('paramsnum_leading_items').removeProperty('disabled');
				$('paramsnum_leading_columns').removeProperty('disabled');
				$('paramsleadingImgSize').removeProperty('disabled');
				$('paramsnum_primary_items').removeProperty('disabled');
				$('paramsnum_primary_columns').removeProperty('disabled');
				$('paramsprimaryImgSize').removeProperty('disabled');
				$('paramsnum_secondary_items').removeProperty('disabled');
				$('paramsnum_secondary_columns').removeProperty('disabled');
				$('paramssecondaryImgSize').removeProperty('disabled');
				$('paramsnum_links').removeProperty('disabled');
				$('paramsnum_links_columns').removeProperty('disabled');
				$('paramslinksImgSize').removeProperty('disabled');
				$('paramscatCatalogMode').removeProperty('disabled');
				$('paramscatFeaturedItems').removeProperty('disabled');
				$('paramscatOrdering').removeProperty('disabled');
				$('paramscatPagination').removeProperty('disabled');
				$('paramscatPaginationResults0').removeProperty('disabled');
				$('paramscatPaginationResults1').removeProperty('disabled');
				$('paramscatFeedLink0').removeProperty('disabled');
				$('paramscatFeedLink1').removeProperty('disabled');
				$('paramstheme').removeProperty('disabled');
			}
			";
			$doc->addScriptDeclaration($js);
		}
		
		foreach ( $list as $item ) {
			@$mitems[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'. $item->treename.$item->title );
		}

		return JHTML::_('select.genericlist',  $mitems, ''.$control_name.'['.$name.'][]', 'onchange="setTask();" class="inputbox" style="width:90%;" multiple="multiple" size="15"', 'value', 'text', $value );

	}

}
