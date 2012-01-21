<?php
/**
 * @version		$Id: helper.php 534 2010-08-04 10:57:16Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php');
require_once (dirname(__FILE__).DS.'includes'.DS.'calendarClass.php');

class modK2ToolsHelper {

  function getAuthors(&$params) {
    $componentParams = &JComponentHelper::getParams('com_k2');
    $where = '';
    $cid = $params->get('authors_module_category');
    if ($cid > 0) {
      $categories = modK2ToolsHelper::getCategoryChildren($cid);
      $categories[] = $cid;
      JArrayHelper::toInteger($categories);
      $where = " catid IN(".implode(',', $categories).") AND ";

    }

    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $db = &JFactory::getDBO();

    $jnow = &JFactory::getDate();
    $now = $jnow->toMySQL();
    $nullDate = $db->getNullDate();

    $query = "SELECT DISTINCT created_by FROM #__k2_items  WHERE {$where} published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND trash=0 AND access<={$aid} AND created_by_alias='' AND EXISTS (SELECT * FROM #__k2_categories WHERE id= #__k2_items.catid AND published=1 AND trash=0 AND access<={$aid} )";
    $db->setQuery($query);
    $rows = $db->loadObjectList();

    $authors = array();
    if (count($rows)) {
      foreach ($rows as $row) {
        $author = JFactory::getUser($row->created_by);
        $author->link = JRoute::_(K2HelperRoute::getUserRoute($author->id));

        $query = "SELECT id, gender, description, image, url, `group`, plugins FROM #__k2_users WHERE userID=".(int)$author->id;
        $db->setQuery($query);
        $author->profile = $db->loadObject();

        if ($params->get('authorAvatar')) {
          $author->avatar = K2HelperUtilities::getAvatar($author->id, $author->email, $componentParams->get('userImageWidth'));
        }

        $query = "SELECT i.*, c.alias as categoryalias FROM #__k2_items as i
        LEFT JOIN #__k2_categories c ON c.id = i.catid
        WHERE i.created_by = ".(int)$author->id."
        AND i.published = 1
        AND i.access <= {$aid}
        AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )
        AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )
        AND i.trash = 0 AND created_by_alias='' AND c.published = 1 AND c.access <= {$aid} AND c.trash = 0 ORDER BY created DESC";

        $db->setQuery($query, 0, 1);
        $author->latest = $db->loadObject();
		$author->latest->id = (int) $author->latest->id;
        $author->latest->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($author->latest->id.':'.urlencode($author->latest->alias), $author->latest->catid.':'.urlencode($author->latest->categoryalias))));

        $query = "SELECT COUNT(*) FROM #__k2_comments WHERE published=1 AND itemID={$author->latest->id}";
        $db->setQuery($query);
        $author->latest->numOfComments = $db->loadResult();

        if ($params->get('authorItemsCounter')) {
          $query = "SELECT COUNT(*) FROM #__k2_items  WHERE {$where} published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND trash=0 AND access<={$aid} AND created_by_alias='' AND created_by={$row->created_by} AND EXISTS (SELECT * FROM #__k2_categories WHERE id= #__k2_items.catid AND published=1 AND trash=0 AND access<={$aid} )";
          $db->setQuery($query);
          $numofitems = $db->loadResult();
          $author->items = $numofitems;
        }
        $authors[] = $author;
      }
    }
    return $authors;
  }

  function getArchive(&$params) {

    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $db = &JFactory::getDBO();

    $jnow = &JFactory::getDate();
    $now = $jnow->toMySQL();
    $nullDate = $db->getNullDate();

    $query = "SELECT DISTINCT MONTH(created) as m, YEAR(created) as y FROM #__k2_items  WHERE published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND trash=0 AND access<={$aid} ";

    $catid = $params->get('archiveCategory', 0);
    if ($catid > 0)
      $query .= " AND catid=".(int)$catid;

    $query .= " ORDER BY created DESC";

    $db->setQuery($query, 0, 12);
    $rows = $db->loadObjectList();
    $months = array(JText::_('JANUARY'), JText::_('FEBRUARY'), JText::_('MARCH'), JText::_('APRIL'), JText::_('MAY'), JText::_('JUNE'), JText::_('JULY'), JText::_('AUGUST'), JText::_('SEPTEMBER'), JText::_('OCTOBER'), JText::_('NOVEMBER'), JText::_('DECEMBER'), );
    if (count($rows)) {

      foreach ($rows as $row) {
        if ($params->get('archiveItemsCounter')) {
          $row->numOfItems = modK2ToolsHelper::countArchiveItems($row->m, $row->y, $catid);
        } else {
          $row->numOfItems = '';
        }
        $row->name = $months[($row->m) - 1];
        $archives[] = $row;
      }

      return $archives;

    }
  }

  function tagCloud(&$params) {

    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $db = &JFactory::getDBO();

    $jnow = &JFactory::getDate();
    $now = $jnow->toMySQL();
    $nullDate = $db->getNullDate();

    $query = "SELECT t.name, t.id FROM #__k2_tags as t";
    $query .= " LEFT JOIN #__k2_tags_xref tags_xref ON tags_xref.tagID = t.id";
    $query .= " LEFT JOIN #__k2_items i ON tags_xref.itemID = i.id";
    $query .= " LEFT JOIN #__k2_categories c ON c.id = i.catid";
    $query .= " WHERE t.published=1 ";
    $query .= " AND i.published=1 ";
    $query .= " AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." ) ";
    $query .= " AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )";
    $query .= " AND i.trash=0 ";
    $query .= " AND i.access <= {$aid}";
    $query .= " AND c.published=1 ";
    $query .= " AND c.trash=0 ";
    $query .= " AND c.access <= {$aid}";

    $cloudCategory = $params->get('cloud_category');
    if ($cloudCategory) {
    	if(!is_array($cloudCategory)){
			$cloudCategory = (array)$cloudCategory;
		}   	
        foreach($cloudCategory as $cloudCategoryID){
    		$categories[] = $cloudCategoryID;
			if($params->get('cloud_category_recursive')){
				$children = modK2ToolsHelper::getCategoryChildren($cloudCategoryID);
				$categories = @array_merge($categories, $children);
			}
		}
    	$categories = @array_unique($categories);
    	JArrayHelper::toInteger($categories);
    	if(count($categories)==1){
			$query .= " AND i.catid={$categories[0]}";
    	}
    	else {
    		$query .= " AND i.catid IN(".implode(',', $categories).")";
    	}
    }

    $db->setQuery($query);
    $rows = $db->loadResultArray();
    $cloud = array();

    if (count($rows)) {
      foreach ($rows as $tag) {
        if (@array_key_exists($tag, $cloud)) {
          $cloud[$tag]++;
        } else {
          $cloud[$tag] = 1;
        }
      }

      $max_size = $params->get('max_size');
      $min_size = $params->get('min_size');
      $max_qty = max(array_values($cloud));
      $min_qty = min(array_values($cloud));
      $spread = $max_qty - $min_qty;
      if (0 == $spread) {
        $spread = 1;
      }

      $step = ($max_size - $min_size) / ($spread);

      $counter = 0;
      arsort($cloud, SORT_NUMERIC);
      $cloud = array_slice($cloud, 0, $params->get('cloud_limit'));
      uksort($cloud, "strnatcasecmp");

      foreach ($cloud as $key=>$value) {
        $size = $min_size + (($value - $min_qty) * $step);
        $size = ceil($size);
        $tags[$counter]-> {'tag'} = $key;
        $tags[$counter]-> {'count'} = $value;
        $tags[$counter]-> {'size'} = $size;
        $tags[$counter]-> {'link'} = urldecode(JRoute::_(K2HelperRoute::getTagRoute($key)));
        $counter++;
      }

      return $tags;
    }
  }

  function getSearchImage($button_text) {

    $img = JHTML::_('image.site', 'searchButton.gif', '/images/M_images/', NULL, NULL, $button_text, null, 0);
    return $img;
  }

  function hasChildren($id) {

    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $id = (int) $id;
    $db = &JFactory::getDBO();
    $query = "SELECT * FROM #__k2_categories  WHERE parent={$id} AND published=1 AND trash=0 AND access<={$aid} ";
    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
    }

    if (count($rows)) {
      return true;
    } else {
      return false;
    }
  }

  function treerecurse(&$params, $id = 0, $level = 0, $begin = false) {

    static $output;
    if ($begin) {
      $output = '';
    }

    $root_id = (int) $params->get('root_id');
    $end_level = $params->get('end_level', NULL);
	$id = (int) $id;
    $catid = JRequest::getInt('id');
    $option = JRequest::getCmd('option');
    $view = JRequest::getCmd('view');

    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $db = &JFactory::getDBO();

    switch ($params->get('categoriesListOrdering')) {

      case 'alpha':
        $orderby = 'name';
        break;

      case 'ralpha':
        $orderby = 'name DESC';
        break;

      case 'order':
        $orderby = 'ordering';
        break;

      case 'reversedefault':
        $orderby = 'id DESC';
        break;

      default:
        $orderby = 'id ASC';
        break;
    }

    if (($root_id != 0) && ($level == 0)) {
      $query = "SELECT * FROM #__k2_categories WHERE parent={$root_id} AND published=1 AND trash=0 AND access<={$aid} ORDER BY {$orderby}";

    } else {
      $query = "SELECT * FROM #__k2_categories WHERE parent={$id} AND published=1 AND trash=0 AND access<={$aid} ORDER BY {$orderby}";
    }

    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
    }

    if ($level < intval($end_level) || is_null($end_level)) {
      $output .= '<ul class="level'.$level.'">';
      foreach ($rows as $row) {
        if ($params->get('categoriesListItemsCounter')) {
          $row->numOfItems = ' ('.modK2ToolsHelper::countCategoryItems($row->id).')';
        } else {
          $row->numOfItems = '';
        }

        if (($option == 'com_k2') && ($view == 'itemlist') && ($catid == $row->id)) {
          $active = ' class="activeCategory"';
        } else {
          $active = '';
        }

        if (modK2ToolsHelper::hasChildren($row->id)) {

          $output .= '<li'.$active.'><a href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'"><span>'.$row->name.$row->numOfItems.'</span></a>';
          modK2ToolsHelper::treerecurse($params, $row->id, $level + 1);
          $output .= '</li>';
        } else {
          $output .= '<li'.$active.'><a href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'"><span>'.$row->name.$row->numOfItems.'</span></a></li>';
        }
      }
      $output .= '</ul>';
    }

    return $output;
  }

  function treeselectbox(&$params, $id = 0, $level = 0) {

    $root_id = (int) $params->get('root_id2');
    $option = JRequest::getCmd('option');
    $view = JRequest::getCmd('view');
    $category = JRequest::getInt('id');
	$id = (int) $id;
    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $db = &JFactory::getDBO();
    if (($root_id != 0) && ($level == 0)) {
      $query = "SELECT * FROM #__k2_categories WHERE parent={$root_id} AND published=1 AND trash=0 AND access<={$aid} ORDER BY ordering ";
    } else {
      $query = "SELECT * FROM #__k2_categories WHERE parent={$id} AND published=1 AND trash=0 AND access<={$aid} ORDER BY ordering ";
    }

    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
    }

    if ($level == 0) {
      echo '
<div class="k2CategorySelectBlock '.$params->get('moduleclass_sfx').'">
	<form action="'.JRoute::_('index.php').'" method="get">
		<select name="category" onchange="window.location=this.form.category.value;">
			<option value="'.JURI::root().'">'.JText::_("-- Select category --").'</option>
			';
    }
    $indent = "";
    for ($i = 0; $i < $level; $i++) {
      $indent .= '&ndash; ';
    }

    foreach ($rows as $row) {
      if (($option == 'com_k2') && ($category == $row->id)) {
        $selected = ' selected="selected"';
      } else {
        $selected = '';
      }
      if (modK2ToolsHelper::hasChildren($row->id)) {
        echo '<option value="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'"'.$selected.'>'.$indent.$row->name.'</option>';
        modK2ToolsHelper::treeselectbox($params, $row->id, $level + 1);
      } else {
        echo '<option value="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'"'.$selected.'>'.$indent.$row->name.'</option>';
      }
    }

    if ($level == 0) {

      echo '
			</select>
			<input name="option" value="com_k2" type="hidden" />
			<input name="view" value="itemlist" type="hidden" />
			<input name="task" value="category" type="hidden" />
			<input name="Itemid" value="'.JRequest::getInt('Itemid').'" type="hidden" />';

      // For Joom!Fish compatibility
      if (JRequest::getCmd('lang')) {
        echo '<input name="lang" value="'.JRequest::getCmd('lang').'" type="hidden" />';
      }

      echo '
	</form>
</div>
			';

    }
  }

  function breadcrumbs($params) {

    $array = array();
    $view = JRequest::getCmd('view');
    $id = JRequest::getInt('id');
    $option = JRequest::getCmd('option');
    $task = JRequest::getCmd('task');

    $db = &JFactory::getDBO();
    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');

    if ($option == 'com_k2') {

      switch ($view) {

        case 'item':
          $query = "SELECT * FROM #__k2_items  WHERE id={$id} AND published=1 AND trash=0 AND access<={$aid} AND EXISTS (SELECT * FROM #__k2_categories WHERE #__k2_categories.id= #__k2_items.catid AND published=1 AND access<={$aid})";
          $db->setQuery($query);
          $row = $db->loadObject();
          if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
          }
          $title = $row->title;
          $path = modK2ToolsHelper::getCategoryPath($row->catid);

          break;

        case 'itemlist':
          if ($task == 'category') {

            $query = "SELECT * FROM #__k2_categories  WHERE id={$id} AND published=1 AND trash=0 AND access<={$aid}";
            $db->setQuery($query);
            $row = $db->loadObject();
            if ($db->getErrorNum()) {
              echo $db->stderr();
              return false;
            }
            $title = $row->name;
            $path = modK2ToolsHelper::getCategoryPath($row->parent);

          } else {
            $document = &JFactory::getDocument();
            $title = $document->getTitle();
            $path = modK2ToolsHelper::getSitePath();
          }
          break;
      }

    } else {
      $document = &JFactory::getDocument();
      $title = $document->getTitle();
      $path = modK2ToolsHelper::getSitePath();
    }

    return array($path, $title);
  }

  function getSitePath() {

    $mainframe = &JFactory::getApplication();
    $pathway = &$mainframe->getPathway();
    $items = $pathway->getPathway();
    $count = count($items);
    $path = array();
    for ($i = 0; $i < $count; $i++) {
      if (! empty($items[$i]->link)) {
        $items[$i]->name = stripslashes(htmlspecialchars($items[$i]->name, ENT_QUOTES, 'UTF-8'));
        $items[$i]->link = JRoute::_($items[$i]->link);
        array_push($path, '<a href="'.JRoute::_($items[$i]->link).'">'.$items[$i]->name.'</a>');
      }

    }
    return $path;

  }

  function getCategoryPath($catid) {

    static $array = array();
    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $catid = (int) $catid;
    $db = &JFactory::getDBO();
    $query = "SELECT * FROM #__k2_categories WHERE id={$catid} AND published=1 AND trash=0 AND access<={$aid}";

    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
    }

    foreach ($rows as $row) {
      array_push($array, '<a href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'">'.$row->name.'</a>');
      modK2ToolsHelper::getCategoryPath($row->parent);
    }

    return array_reverse($array);
  }

  function getCategoryChildren($catid) {

    static $array = array();
    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $catid = (int) $catid;
    $db = &JFactory::getDBO();
    $query = "SELECT * FROM #__k2_categories WHERE parent={$catid} AND published=1 AND trash=0 AND access<={$aid} ORDER BY ordering ";
    $db->setQuery($query);
    $rows = $db->loadObjectList();
    if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
    }
    foreach ($rows as $row) {
      array_push($array, $row->id);
      if (modK2ToolsHelper::hasChildren($row->id)) {
        modK2ToolsHelper::getCategoryChildren($row->id);
      }
    }
    return $array;
  }

  function countArchiveItems($month, $year, $catid = 0) {

    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $month = (int) $month;
    $year = (int) $year;
    $db = &JFactory::getDBO();

    $jnow = &JFactory::getDate();
    $now = $jnow->toMySQL();
    $nullDate = $db->getNullDate();

    $query = "SELECT COUNT(*) FROM #__k2_items WHERE MONTH(created)={$month} AND YEAR(created)={$year} AND published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND trash=0 AND access<={$aid}";
    if ($catid > 0)
      $query .= " AND catid={$catid}";
    $db->setQuery($query);
    $total = $db->loadResult();
    return $total;

  }

  function countCategoryItems($id) {

    $user = &JFactory::getUser();
    $aid = (int) $user->get('aid');
    $id = (int) $id;
    $db = &JFactory::getDBO();

    $jnow = &JFactory::getDate();
    $now = $jnow->toMySQL();
    $nullDate = $db->getNullDate();

    $query = "SELECT COUNT(*) FROM #__k2_items WHERE catid={$id} AND published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND trash=0 AND access<={$aid}";
    $db->setQuery($query);
    $total = $db->loadResult();
    return $total;
  }

  function calendar($params) {

    $month = JRequest::getInt('month');
    $year = JRequest::getInt('year');

    $months = array(JText::_('JANUARY'), JText::_('FEBRUARY'), JText::_('MARCH'), JText::_('APRIL'), JText::_('MAY'), JText::_('JUNE'), JText::_('JULY'), JText::_('AUGUST'), JText::_('SEPTEMBER'), JText::_('OCTOBER'), JText::_('NOVEMBER'), JText::_('DECEMBER'), );
    $days = array(JText::_('SUN'), JText::_('MON'), JText::_('TUE'), JText::_('WED'), JText::_('THU'), JText::_('FRI'), JText::_('SAT'), );

    $cal = new MyCalendar;
    $cal->category = $params->get('calendarCategory', 0);
    $cal->setStartDay(1);
    $cal->setMonthNames($months);
    $cal->setDayNames($days);

    if (($month) && ($year)) {
      return $cal->getMonthView($month, $year);
    } else {
      return $cal->getCurrentMonthView();
    }
  }

}

class MyCalendar extends Calendar {

  var $category = null;

  function getDateLink($day, $month, $year) {

    $user = &JFactory::getUser();
    $aid = $user->get('aid');
    $db = &JFactory::getDBO();

    $jnow = &JFactory::getDate();
    $now = $jnow->toMySQL();
    $nullDate = $db->getNullDate();

    $query = "SELECT COUNT(*) FROM #__k2_items WHERE YEAR(created)={$year} AND MONTH(created)={$month} AND DAY(created)={$day} AND published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND trash=0 AND access<={$aid} AND EXISTS(SELECT * FROM #__k2_categories WHERE id= #__k2_items.catid AND published=1 AND trash=0 AND access<={$aid})";

    $catid = $this->category;
    if ($catid > 0)
      $query .= " AND catid={$catid}";

    $db->setQuery($query);
    $result = $db->loadResult();
    if ($db->getErrorNum()) {
      echo $db->stderr();
      return false;
    }

    if ($result > 0) {
      $itemID = JRequest::getInt('Itemid');
      if ($catid > 0)
        return JRoute::_('index.php?option=com_k2&view=itemlist&task=date&year='.$year.'&month='.$month.'&day='.$day.'&catid='.$catid.'&Itemid='.$itemID);
      else
        return JRoute::_('index.php?option=com_k2&view=itemlist&task=date&year='.$year.'&month='.$month.'&day='.$day.'&Itemid='.$itemID);

    } else {
      return false;
    }
  }

  function getCalendarLink($month, $year) {
    $itemID = JRequest::getInt('Itemid');
    if ($this->category > 0)
      return JURI::root()."index.php?option=com_k2&amp;view=itemlist&amp;task=calendar&amp;month={$month}&amp;year={$year}&amp;catid={$this->category}&amp;Itemid={$itemID}";
    else
      return JURI::root()."index.php?option=com_k2&amp;view=itemlist&amp;task=calendar&amp;month=$month&amp;year=$year&amp;Itemid={$itemID}";
  }

}
