<?php
/**
 * @version		$Id: category.php 567 2010-09-23 11:50:09Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelCategory extends JModel
{

    function getData() {

        $cid = JRequest::getVar('cid');
        $row = & JTable::getInstance('K2Category', 'Table');
        $row->load($cid);
        return $row;
    }

    function save() {

        $mainframe = &JFactory::getApplication();
        jimport('joomla.filesystem.file');
        require_once (JPATH_COMPONENT.DS.'lib'.DS.'class.upload.php');
        $row = & JTable::getInstance('K2Category', 'Table');
        $params = & JComponentHelper::getParams('com_k2');
        if (!$row->bind(JRequest::get('post'))) {
            $mainframe->redirect('index.php?option=com_k2&view=categories', $row->getError(), 'error');
        }

        $row->description = JRequest::getVar('description', '', 'post', 'string', 2);
        if($params->get('xssFiltering')){
            $filter = new JFilterInput(array(), array(), 1, 1, 0);
            $row->description = $filter->clean( $row->description );
        }

        if (!$row->id) {
            $row->ordering = $row->getNextOrder('parent = '.$row->parent.' AND trash=0');
        }

        if (!$row->check()) {
            $mainframe->redirect('index.php?option=com_k2&view=category&cid='.$row->id, $row->getError(), 'error');
        }

        if (!$row->store()) {
            $mainframe->redirect('index.php?option=com_k2&view=categories', $row->getError(), 'error');
        }

        if(!$params->get('disableCompactOrdering'))
        $row->reorder('parent = '.$row->parent.' AND trash=0');

        $file = JRequest::get('files');

        $savepath = JPATH_ROOT.DS.'media'.DS.'k2'.DS.'categories'.DS;

        if ($file['image']['error'] == 0 && !JRequest::getBool('del_image')) {
            $handle = new Upload($file['image']);
            if ($handle->uploaded) {
                $handle->file_auto_rename = false;
                $handle->file_overwrite = true;
                $handle->file_new_name_body = $row->id;
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_x = $params->get('catImageWidth', '100');
                $handle->Process($savepath);
                $handle->Clean();
            }
            else {
                $mainframe->redirect('index.php?option=com_k2&view=categories', $handle->error, 'error');
            }
            $row->image = $handle->file_dst_name;
        }


        if (JRequest::getBool('del_image')) {
            $currentRow = & JTable::getInstance('K2Category', 'Table');
            $currentRow->load($row->id);
            if (JFile::exists(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'categories'.DS.$currentRow->image)) {
                JFile::delete(JPATH_ROOT.DS.'media'.DS.'k2'.DS.'categories'.DS.$currentRow->image);
            }
            $row->image = '';
        }

        if (!$row->store()) {
            $mainframe->redirect('index.php?option=com_k2&view=categories', $row->getError(), 'error');
        }

        $cache = & JFactory::getCache('com_k2');
        $cache->clean();

        switch(JRequest::getCmd('task')) {
            case 'apply':
                $msg = JText::_('Changes to Category saved');
                $link = 'index.php?option=com_k2&view=category&cid='.$row->id;
                break;
            case 'saveAndNew':
                $msg = JText::_('Category saved');
                $link = 'index.php?option=com_k2&view=category';
                break;
            case 'save':
            default:
                $msg = JText::_('Category Saved');
                $link = 'index.php?option=com_k2&view=categories';
                break;
        }
        $mainframe->redirect($link, $msg);
    }

    function countCategoryItems($catid) {

        $db = & JFactory::getDBO();
        $catid = (int)$catid;
        $query = "SELECT COUNT(*) FROM #__k2_items WHERE catid={$catid} AND trash=0 ";
        $db->setQuery($query);
        $result = $db->loadResult();
        return $result;

    }

}
