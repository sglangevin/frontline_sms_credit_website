<?php
/**
 * @copyright (C) 2007 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 *
 * Rem:
 *
 * 
 **/
(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

class MYPluginsDB{
	var $table	= '#__myblog_mambots';
	var $key	= '';
	var $db		= null;
	
	var $_plugins	= '';
	function MYPluginsDB()
	{
		$this->db		=& JFactory::getDBO();
		$this->_plugins	= '#__plugins';
	}
	
	function getPlugins($type = 'content', $published = true){
	
		if($type == 'content')
			$type	= "AND a.folder='content' ";
		else
			$type	= "AND a.folder='{$type}' ";

		// Check if only get published mambots
		if($published)
			$published	= "AND b.my_published='1' ";

		$strSQL	= "SELECT a.element, a.ordering "
				. "FROM {$this->_plugins} AS a, {$this->table} AS b "
				. "WHERE b.mambot_id=a.id "
				. "AND a.published='1' "
				. $published
				. $type
				. "AND a.element !='jom_comment_bot' "
				. "ORDER BY a.ordering";

		$this->db->setQuery($strSQL);
		return $this->db->loadObjectList();
	}
	
	function getTotal()
	{
		$query	= 'SELECT COUNT(*) FROM ' . $this->db->nameQuote( $this->_plugins ) . ' '
				. 'WHERE published="1" '
				. 'AND folder="content" '
				. 'AND element != "jom_comment_bot"';
		$this->db->setQuery( $query );
		
		return $this->db->loadResult();
	}
	
	function get($limitstart , $limit)
	{
		$strSQL	= "SELECT a.name, b.mambot_id, b.my_published "
				. "FROM {$this->_plugins} AS a, {$this->table} AS b "
				. "WHERE b.mambot_id=a.id "
				. "AND a.published='1' "
				. "AND a.folder='content' "
				. "AND a.element!='jom_comment_bot' "
				. "LIMIT {$limitstart}, {$limit}";
		$this->db->setQuery($strSQL);
		return $this->db->loadObjectList();
	}

	function initPlugins($type = 'content')
	{
	
		if($type == 'content')
			$type	= "AND a.folder='content' ";
		else
			$type	= "AND a.folder='{$type}' ";

		$strSQL	= "SELECT a.name, a.id FROM {$this->_plugins} AS a "
				. "LEFT OUTER JOIN {$this->table} AS b "
				. "ON (a.id=b.mambot_id) "
				. "WHERE b.mambot_id IS NULL "
				. $type
				. "AND a.published='1' "
				. "AND a.element!='jom_comment_bot'";

		$this->db->setQuery($strSQL);
		$plugins	= $this->db->loadObjectList();
		
		if($plugins)
		{
			foreach($plugins as $plugin)
			{
				$strSQL	= "INSERT INTO {$this->table} SET mambot_id='{$plugin->id}'";
				$this->db->setQuery($strSQL);
				$this->db->query();
			}
		}
	}
}
