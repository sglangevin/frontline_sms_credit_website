<?php
/**
 * @version		$Id: permissions.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class K2HelperPermissions {

    function setPermissions() {

        $params = &JComponentHelper::getParams('com_k2');
        $user = &JFactory::getUser();
        if ($user->guest)
            return;

        $K2User = K2HelperPermissions::getK2User($user->id);
        if (!is_object($K2User))
            return;

        $K2UserGroup = K2HelperPermissions::getK2UserGroup($K2User->group);
        if (is_null($K2UserGroup))
            return;

        $permissions = new JParameter($K2UserGroup->permissions);
        $auth = &JFactory::getACL();

        if ($permissions->get('categories') == 'none') {
            return;
        } else if ($permissions->get('categories') == 'all') {

            if ($permissions->get('add') && $permissions->get('frontEdit') && $params->get('frontendEditing')) {
                $auth->addACL('com_k2', 'add', 'users', $user->usertype, 'category', 'all');
                $auth->addACL('com_k2', 'tag', 'users', $user->usertype);
                $auth->addACL('com_k2', 'extraFields', 'users', $user->usertype);
            }

            if ($permissions->get('editOwn') && $permissions->get('frontEdit') && $params->get('frontendEditing')) {
                $auth->addACL('com_k2', 'editOwn', 'users', $user->usertype, 'item', $user->id);
                $auth->addACL('com_k2', 'tag', 'users', $user->usertype);
                $auth->addACL('com_k2', 'extraFields', 'users', $user->usertype);
            }

            if ($permissions->get('editAll') && $permissions->get('frontEdit') && $params->get('frontendEditing')) {
                $auth->addACL('com_k2', 'editAll', 'users', $user->usertype, 'category', 'all');
                $auth->addACL('com_k2', 'tag', 'users', $user->usertype);
                $auth->addACL('com_k2', 'extraFields', 'users', $user->usertype);
            }

            if ($permissions->get('publish') && $permissions->get('frontEdit') && $params->get('frontendEditing')) {
                $auth->addACL('com_k2', 'publish', 'users', $user->usertype, 'category', 'all');
            }

            if ($permissions->get('comment')) {
                $auth->addACL('com_k2', 'comment', 'users', $user->usertype, 'category', 'all');
            }

        } else {

            $selectedCategories = $permissions->get('categories', NULL);

            if (is_string($selectedCategories))
                $searchIDs[] = $selectedCategories;

            else
                $searchIDs = $selectedCategories;

            if ($permissions->get('inheritance')) {
                foreach ($searchIDs as $catid) {
                    $childCategories = K2HelperPermissions::getCategoryChilds($catid);
                    $childIDs = array();
                    foreach ($childCategories as $child) {
                        $childIDs[] = $child;
                    }
                }

                $allIDs = @array_merge($searchIDs, $childIDs);
                $categories = @array_unique($allIDs);
            } else {
                $categories = $searchIDs;

            }

            if (is_array($categories) && count($categories)) {
                foreach ($categories as $category) {

                    if ($permissions->get('add') && $permissions->get('frontEdit') && $params->get('frontendEditing')) {
                        $auth->addACL('com_k2', 'add', 'users', $user->usertype, 'category', $category);
                        $auth->addACL('com_k2', 'tag', 'users', $user->usertype);
                        $auth->addACL('com_k2', 'extraFields', 'users', $user->usertype);
                    }

                    if ($permissions->get('editOwn') && $permissions->get('frontEdit') && $params->get('frontendEditing')) {
                        $auth->addACL('com_k2', 'editOwn', 'users', $user->usertype, 'item', $user->id.'|'.$category);
                        $auth->addACL('com_k2', 'tag', 'users', $user->usertype);
                        $auth->addACL('com_k2', 'extraFields', 'users', $user->usertype);
                    }

                    if ($permissions->get('editAll') && $permissions->get('frontEdit') && $params->get('frontendEditing')) {
                        $auth->addACL('com_k2', 'editAll', 'users', $user->usertype, 'category', $category);
                        $auth->addACL('com_k2', 'tag', 'users', $user->usertype);
                        $auth->addACL('com_k2', 'extraFields', 'users', $user->usertype);
                    }

                    if ($permissions->get('publish') && $permissions->get('frontEdit') && $params->get('frontendEditing')) {
                        $auth->addACL('com_k2', 'publish', 'users', $user->usertype, 'category', $category);
                    }

                    if ($permissions->get('comment')) {
                        $auth->addACL('com_k2', 'comment', 'users', $user->usertype, 'category', $category);
                    }

                }
            }

        }


        return;
    }

    function checkPermissions() {

        $view = JRequest::getCmd('view');
        if ($view != 'item')
            return;

        $task = JRequest::getCmd('task');

        switch ($task) {

            case 'add':
                if (!K2HelperPermissions::canAddItem())
                    JError::raiseError(403, JText::_("ALERTNOTAUTH"));
                break;

            case 'edit':
            case 'deleteAttachment':
            case 'checkin':
                $cid = JRequest::getInt('cid');
                if (!$cid)
                    JError::raiseError(403, JText::_("ALERTNOTAUTH"));

                JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');
                $item = &JTable::getInstance('K2Item', 'Table');
                $item->load($cid);

                if (!K2HelperPermissions::canEditItem($item->created_by, $item->catid))
                    JError::raiseError(403, JText::_("ALERTNOTAUTH"));
                break;

            case 'save':
                $cid = JRequest::getInt('id');
                if ($cid) {

                    JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.DS.'tables');
                    $item = &JTable::getInstance('K2Item', 'Table');
                    $item->load($cid);

                    if (!K2HelperPermissions::canEditItem($item->created_by, $item->catid))
                        JError::raiseError(403, JText::_("ALERTNOTAUTH"));
                }
                else {
                    if (!K2HelperPermissions::canAddItem())
                        JError::raiseError(403, JText::_("ALERTNOTAUTH"));
                }

                break;

            case 'tag':
                if (!K2HelperPermissions::canAddTag())
                    JError::raiseError(403, JText::_("ALERTNOTAUTH"));
                break;

            case 'extraFields':
                if (!K2HelperPermissions::canRenderExtraFields())
                    JError::raiseError(403, JText::_("ALERTNOTAUTH"));
                break;

        }
    }

    function getK2User($userID) {

        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_users WHERE userID = ".(int)$userID;
        $db->setQuery($query);
        $row = $db->loadObject();
        return $row;
    }

    function getK2UserGroup($id) {

        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_user_groups WHERE id = ".(int)$id;
        $db->setQuery($query);
        $row = $db->loadObject();
        return $row;
    }

    function getCategoryChilds($catid) {

        static $array = array();
        $user = &JFactory::getUser();
        $aid = (int) $user->get('aid');
        $catid = (int) $catid;
        $db = &JFactory::getDBO();
        if ($catid=="all"){
        	$query = "SELECT * FROM #__k2_categories WHERE published=1 AND trash=0 AND access<={$aid} ORDER BY ordering ";
        }
		else {
			$query = "SELECT * FROM #__k2_categories WHERE parent={$catid} AND published=1 AND trash=0 AND access<={$aid} ORDER BY ordering ";
		}
        $db->setQuery($query);
        $rows = $db->loadObjectList();

        foreach ($rows as $row) {
            array_push($array, $row->id);
            if (K2HelperPermissions::hasChilds($row->id)) {
                K2HelperPermissions::getCategoryChilds($row->id);
            }
        }
        return $array;
    }

    function hasChilds($id) {

        $user = &JFactory::getUser();
        $aid = (int) $user->get('aid');
        $id = (int) $id;
        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories WHERE parent={$id} AND published=1 AND trash=0 AND access<={$aid} ";
        $db->setQuery($query);
        $rows = $db->loadObjectList();

        if (count($rows)) {
            return true;
        } else {
            return false;
        }
    }

    function canAddItem() {

        $user = &JFactory::getUser();
        $aid = (int) $user->get('aid');
        if ($user->authorize('com_k2', 'add', 'category', 'all'))
            return true;

        $db = &JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories WHERE published=1 AND trash=0 AND access<={$aid}";
        $db->setQuery($query);
        $categories = $db->loadObjectList();

        foreach ($categories as $category) {
            if ($user->authorize('com_k2', 'add', 'category', $category->id))
                return true;
        }

        return false;
    }

    function canEditItem($itemOwner, $itemCategory) {

        $user = &JFactory::getUser();

        if ($user->authorize('com_k2', 'editAll', 'category', 'all') || $user->authorize('com_k2', 'editOwn', 'item', $itemOwner) || $user->authorize('com_k2', 'editOwn', 'item', $itemOwner.'|'.$itemCategory) || $user->authorize('com_k2', 'editAll', 'category', $itemCategory))
            return true;
        else
            return false;
    }

    function canPublishItem($itemCategory) {

        $user = &JFactory::getUser();
        if ($user->authorize('com_k2', 'publish', 'category', 'all') || $user->authorize('com_k2', 'publish', 'category', $itemCategory))
            return true;
        else
            return false;
    }

    function canAddTag() {

        $user = &JFactory::getUser();
        if ($user->authorize('com_k2', 'tag'))
            return true;
        else
            return false;
    }

    function canRenderExtraFields() {

        $user = &JFactory::getUser();
        if ($user->authorize('com_k2', 'extraFields'))
            return true;
        else
            return false;
    }

    function canAddComment($itemCategory) {

        $user = &JFactory::getUser();
        if ($user->authorize('com_k2', 'comment', 'category', 'all') || $user->authorize('com_k2', 'comment', 'category', $itemCategory))
            return true;
        else
            return false;
    }

}
