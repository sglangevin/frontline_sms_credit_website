<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

include_once(MY_COM_PATH . '/task/browse.base.php');


class MyblogBrowseTask extends MyblogBrowseBase
{
	
	function MyblogBrowseTask()
	{
		parent::MyblogBrowseBase();
		$this->toolbar = MY_TOOLBAR_HOME;
	}
	
}
