<?php
/**
 * @version		$Id: k2category.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableK2Category extends JTable
{

	var $id = null;
	var $name = null;
	var $alias = null;
	var $description = null;
	var $parent = null;
	var $extraFieldsGroup = null;
	var $published = null;
	var $image = null;
	var $access = null;
	var $ordering = null;
	var $params = null;
	var $trash = null;
	var $plugins = null;

	function __construct( & $db) {

		parent::__construct('#__k2_categories', 'id', $db);
	}

	function check() {

		if (trim($this->name) == '') {
			$this->setError(JText::_('Category must have a name'));
			return false;
		}
		if ( empty($this->alias)) {
			$this->alias = $this->name;
		}

		if(JPluginHelper::isEnabled('system', 'unicodeslug'))
			$this->alias = JFilterOutput::stringURLSafe($this->alias);
		else {

			mb_internal_encoding("UTF-8");
			mb_regex_encoding("UTF-8");
			$this->alias = trim(mb_strtolower($this->alias));
			$this->alias = str_replace('-', ' ', $this->alias);
			$this->alias = mb_ereg_replace('[[:space:]]+', ' ', $this->alias);
			$this->alias = trim(str_replace(' ', '-', $this->alias));
			$this->alias = str_replace('.', '', $this->alias);
			$this->alias = str_replace('"', '', $this->alias);
			$this->alias = str_replace("'", '', $this->alias);
			 
			$stripthese = ',|~|!|@|%|^|(|)|<|>|:|;|{|}|[|]|&|`|â€ž|â€¹|â€™|â€˜|â€œ|â€�|â€¢|â€º|Â«|Â´|Â»|Â°|«|»|…';
			$strips = explode('|', $stripthese);
			foreach ($strips as $strip) {
				$this->alias = str_replace($strip, '', $this->alias);
			}


			$params = &JComponentHelper::getParams('com_k2');
			$SEFReplacements = array();
			$items = explode(',', $params->get('SEFReplacements'));
			foreach ($items as $item) {
				if (! empty($item)) {
					@list($src, $dst) = explode('|', trim($item));
					$SEFReplacements[trim($src)] = trim($dst);
				}
			}


			foreach ($SEFReplacements as $key=>$value) {
				$this->alias = str_replace($key, $value, $this->alias);
			}

			$this->alias = trim($this->alias, '-.');

			if (trim(str_replace('-', '', $this->alias)) == '') {
				$datenow = &JFactory::getDate();
				$this->alias = $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
			}
		}

		return true;

	}

	function bind($array, $ignore = '')	{

		if (key_exists('params', $array) && is_array($array['params']))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['params']);
			$array['params'] = $registry->toString();
		}

		if (key_exists('plugins', $array) && is_array($array['plugins']))
		{
			$registry = new JRegistry();
			$registry->loadArray($array['plugins']);
			$array['plugins'] = $registry->toString();
		}

		return parent::bind($array, $ignore);
	}

}
