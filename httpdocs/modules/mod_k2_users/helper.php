<?php
/**
 * @version		$Id: helper.php 565 2010-09-23 11:48:48Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php');

class modK2UsersHelper {

	function getUsers(&$params){

		$user = &JFactory::getUser();
		$aid = (int) $user->get('aid');
		$db = &JFactory::getDBO();

		$jnow = &JFactory::getDate();
		$now = $jnow->toMySQL();
		$nullDate = $db->getNullDate();
		$userObjects = array();

		if($params->get('source')=='specific' && $params->get('userIDs')){
			$IDs = array();
			if(is_string($params->get('userIDs')))
				$IDs[]=$params->get('userIDs');
			else
				$IDs = $params->get('userIDs');

			JArrayHelper::toInteger($IDs);

			$query = "SELECT users.name,users.email,users.gid,users.id AS UID, profiles.* FROM #__users AS users
			LEFT JOIN #__k2_users AS profiles ON users.id=profiles.userID
			WHERE users.block=0 AND users.id IN (".implode(',',$IDs).")";
			$db->setQuery($query);
			$userObjects = $db->loadObjectList();

		}

		else {

			switch($params->get('filter',0)){

				case 0:

					$query = "SELECT users.name,users.email,users.id AS UID, profiles.*";

					if ($params->get('ordering')=='recent')
						$query.=", MAX(i.created) AS counter";

					$query.=" FROM #__users AS users
					LEFT JOIN #__k2_users AS profiles ON users.id=profiles.userID";

					if ($params->get('ordering')=='recent'){

						$query.=" LEFT JOIN #__k2_items AS i ON users.id=i.created_by
								LEFT JOIN #__k2_categories AS c ON i.catid=c.id";
					}

					$query.=" WHERE users.block=0 AND profiles.`group`=".(int)$params->get('K2UserGroup');

					if ($params->get('ordering')=='recent'){
						$query.=" AND
						i.published = 1 AND i.access <= {$aid} AND i.trash = 0 AND c.published = 1 AND c.access <= {$aid} AND c.trash = 0
						AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )
						AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )
						AND i.created_by_alias=''";
					}

					if ($params->get('ordering')=='alpha')
						$query.=" ORDER BY users.name";
					elseif ($params->get('ordering')=='random')
						$query.=" ORDER BY RAND()";
					elseif ($params->get('ordering')=='recent')
						$query.=" GROUP BY users.id ORDER BY counter DESC";

					break;

				case 1:

					$query = "SELECT users.name,users.email,users.id AS UID, profiles.*, COUNT(i.id) AS counter FROM #__users AS users
					LEFT JOIN #__k2_users AS profiles ON users.id=profiles.userID
					LEFT JOIN #__k2_items AS i ON users.id=i.created_by
					LEFT JOIN #__k2_categories AS c ON i.catid=c.id
					WHERE users.block=0 AND
					i.published = 1 AND i.access <= {$aid} AND i.trash = 0 AND c.published = 1 AND c.access <= {$aid} AND c.trash = 0
					AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )
					AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )
					AND i.created_by_alias=''
					GROUP BY users.id ORDER BY counter DESC";

					break;

				case 2:

					$query = "SELECT users.name,users.email,users.id AS UID, profiles.*, MAX(i.hits) AS counter FROM #__users AS users
					LEFT JOIN #__k2_users AS profiles ON users.id=profiles.userID
					LEFT JOIN #__k2_items AS i ON users.id=i.created_by
					LEFT JOIN #__k2_categories AS c ON i.catid=c.id
					WHERE users.block=0 AND
					i.published = 1 AND i.access <= {$aid} AND i.trash = 0 AND c.published = 1 AND c.access <= {$aid} AND c.trash = 0
					AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )
					AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )
					AND i.created_by_alias=''
					GROUP BY users.id ORDER BY counter DESC";
					break;

				case 3:

					$query = "SELECT users.name,users.email,users.id AS UID, profiles.*, COUNT(comment.id) AS counter FROM #__users AS users
					LEFT JOIN #__k2_users AS profiles ON users.id=profiles.userID
					LEFT JOIN #__k2_items AS i ON users.id=i.created_by
					LEFT JOIN #__k2_categories AS c ON i.catid=c.id
					LEFT JOIN #__k2_comments AS comment ON i.id=comment.itemID
					WHERE users.block=0 AND
					i.published = 1 AND i.access <= {$aid} AND i.trash = 0 AND c.published = 1 AND c.access <= {$aid} AND c.trash = 0
					AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )
					AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )
					AND i.created_by_alias=''
					AND comment.published=1
					GROUP BY users.id ORDER BY counter DESC";
					break;

			}

			$db->setQuery($query, 0, $params->get('limit',4));
			$userObjects = $db->loadObjectList();

		}


		if(count($userObjects)){
			foreach($userObjects as $userObject){

				$userObject->avatar = K2HelperUtilities::getAvatar($userObject->UID, $userObject->email, $params->get('userImageWidth'));
				$userObject->link = JRoute::_(K2HelperRoute::getUserRoute($userObject->UID));
				$userObject->feed = JRoute::_(K2HelperRoute::getUserRoute($userObject->UID).'&format=feed');

				if($params->get('userItemCount')){
					$query = "SELECT i.*, c.name as categoryname,c.id as categoryid, c.alias as categoryalias, c.params as categoryparams FROM #__k2_items as i LEFT JOIN #__k2_categories AS c ON c.id = i.catid WHERE i.published = 1
					AND i.access <= {$aid}
					AND i.trash = 0
					AND c.published = 1
					AND c.access <= {$aid}
					AND c.trash = 0
					AND ( i.publish_up = ".$db->Quote($nullDate)." OR i.publish_up <= ".$db->Quote($now)." )
					AND ( i.publish_down = ".$db->Quote($nullDate)." OR i.publish_down >= ".$db->Quote($now)." )
					AND i.created_by=".(int)$userObject->UID."
					AND i.created_by_alias=''
					ORDER BY i.created DESC";

					$db->setQuery($query, 0, $params->get('userItemCount'));
					$userObject->items = $db->loadObjectList();
					if(count($userObject->items)){
						foreach($userObject->items as $item){
							$link = K2HelperRoute::getItemRoute($item->id.':'.urlencode($item->alias),$item->catid.':'.urlencode($item->categoryalias));
							$item->link=urldecode(JRoute::_($link));
						}
					}
				} else {
					$userObject->items = null;
				}
			}
		}
		return $userObjects;

	}

}
