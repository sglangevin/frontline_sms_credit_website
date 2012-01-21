<?php
/**
 * @version		$Id: install.k2.php 539 2010-08-05 09:14:03Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.installer.installer');

// Load K2 language file
$lang = &JFactory::getLanguage();
$lang->load('com_k2');

$db = & JFactory::getDBO();
$status = new JObject();
$status->modules = array();
$status->plugins = array();
$src = $this->parent->getPath('source');

$modules = &$this->manifest->getElementByPath('modules');
if (is_a($modules, 'JSimpleXMLElement') && count($modules->children())) {
	foreach ($modules->children() as $module) {
		$mname = $module->attributes('module');
		$client = $module->attributes('client');
		if(is_null($client)) $client = 'site';
		($client=='administrator')? $path=$src.DS.'administrator'.DS.'modules'.DS.$mname: $path = $src.DS.'modules'.DS.$mname;
		$installer = new JInstaller;
		$result = $installer->install($path);
		$status->modules[] = array('name'=>$mname,'client'=>$client, 'result'=>$result);
	}
}

$query = "UPDATE #__modules SET position='icon', ordering=99, published=1 WHERE module='mod_k2_quickicons'";
$db->setQuery($query);
$db->query();

$plugins = &$this->manifest->getElementByPath('plugins');
if (is_a($plugins, 'JSimpleXMLElement') && count($plugins->children())) {

	foreach ($plugins->children() as $plugin) {
		$pname = $plugin->attributes('plugin');
		$pgroup = $plugin->attributes('group');
		$path = $src.DS.'plugins'.DS.$pgroup;
		$installer = new JInstaller;
		$result = $installer->install($path);
		$status->plugins[] = array('name'=>$pname,'group'=>$pgroup, 'result'=>$result);

		$query = "UPDATE #__plugins SET published=1 WHERE element=".$db->Quote($pname)." AND folder=".$db->Quote($pgroup);
		$db->setQuery($query);
		$db->query();
	}
}

if (JFolder::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomfish'.DS.'contentelements')){
	$elements = &$this->manifest->getElementByPath('joomfish');
	if (is_a($elements, 'JSimpleXMLElement') && count($elements->children())) {
		foreach ($elements->children() as $element) {
			JFile::copy($src.DS.'administrator'.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.$element->data(),JPATH_ADMINISTRATOR.DS.'components'.DS.'com_joomfish'.DS.'contentelements'.DS.$element->data());
		}
	}
} else {
	$mainframe = &JFactory::getApplication();
	$mainframe->enqueueMessage(JText::_('Notice: K2 content elements for Joom!Fish were not copied to the related folder, because Joom!Fish was not found on your system.'));
}

// Database modifications [start]
$db = &JFactory::getDBO();
$fields = $db->getTableFields('#__k2_items');
if (!array_key_exists('featured_ordering', $fields['#__k2_items'])) {
	$query = "ALTER TABLE #__k2_items ADD `featured_ordering` INT(11) NOT NULL default '0' AFTER `featured`";
	$db->setQuery($query);
	$db->query();
}


$query = "SELECT COUNT(*) FROM #__k2_user_groups";
$db->setQuery($query);
$num = $db->loadResult();

if ($num==0){
	$query = "INSERT INTO #__k2_user_groups (`id`, `name`, `permissions`) VALUES('', 'Registered', 'frontEdit=0\nadd=0\neditOwn=0\neditAll=0\npublish=0\ncomment=1\ninheritance=0\ncategories=all\n\n')";
	$db->setQuery($query);
	$db->Query();

	$query = "INSERT INTO #__k2_user_groups (`id`, `name`, `permissions`) VALUES('', 'Site Owner', 'frontEdit=1\nadd=1\neditOwn=1\neditAll=1\npublish=1\ncomment=1\ninheritance=1\ncategories=all\n\n')";
	$db->setQuery($query);
	$db->Query();

}

if($fields['#__k2_items']['video']!='text'){
	$query = "ALTER TABLE #__k2_items MODIFY `video` TEXT";
	$db->setQuery($query);
	$db->query();
}

if($fields['#__k2_items']['introtext']=='text'){
	$query = "ALTER TABLE #__k2_items MODIFY `introtext` MEDIUMTEXT";
	$db->setQuery($query);
	$db->query();
}

if($fields['#__k2_items']['fulltext']=='text'){
	$query = "ALTER TABLE #__k2_items MODIFY `fulltext` MEDIUMTEXT";
	$db->setQuery($query);
	$db->query();
}

$query = "SHOW INDEX FROM #__k2_items";
$db->setQuery($query);
$indexes = $db->loadObjectList();
$indexExists = false;
foreach ($indexes as $index){
	if ($index->Key_name=='search')
		$indexExists = true;
}

if (!$indexExists){
	$query = "ALTER TABLE #__k2_items ADD FULLTEXT `search` (`title`,`introtext`,`fulltext`,`extra_fields_search`,`image_caption`,`image_credits`,`video_caption`,`video_credits`,`metadesc`,`metakey`)";
	$db->setQuery($query);
	$db->query();

	$query = "ALTER TABLE #__k2_items ADD FULLTEXT (`title`)";
	$db->setQuery($query);
	$db->query();
}


$query = "SHOW INDEX FROM #__k2_tags";
$db->setQuery($query);
$indexes = $db->loadObjectList();
$indexExists = false;
foreach ($indexes as $index){
	if ($index->Key_name=='name')
		$indexExists = true;
}

if (!$indexExists){
	$query = "ALTER TABLE #__k2_tags ADD FULLTEXT (`name`)";
	$db->setQuery($query);
	$db->query();
}

// Database modifications [end]

?>

<?php $rows = 0;?>
<img src="components/com_k2/images/K2logo.gif" width="109" height="48" alt="K2 Component" align="right" />
<h2><?php echo JText::_('K2 Installation Status'); ?></h2>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('Extension'); ?></th>
			<th width="30%"><?php echo JText::_('Status'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo 'K2 '.JText::_('Component'); ?></td>
			<td><strong><?php echo JText::_('Installed'); ?></strong></td>
		</tr>
		<?php if (count($status->modules)) : ?>
		<tr>
			<th><?php echo JText::_('Module'); ?></th>
			<th><?php echo JText::_('Client'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->modules as $module) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo $module['name']; ?></td>
			<td class="key"><?php echo ucfirst($module['client']); ?></td>
			<td><strong><?php echo ($module['result'])?JText::_('Installed'):JText::_('Not installed'); ?></strong></td>
		</tr>
		<?php endforeach;?>
		<?php endif;?>
		<?php if (count($status->plugins)) : ?>
		<tr>
			<th><?php echo JText::_('Plugin'); ?></th>
			<th><?php echo JText::_('Group'); ?></th>
			<th></th>
		</tr>
		<?php foreach ($status->plugins as $plugin) : ?>
		<tr class="row<?php echo (++ $rows % 2); ?>">
			<td class="key"><?php echo ucfirst($plugin['name']); ?></td>
			<td class="key"><?php echo ucfirst($plugin['group']); ?></td>
			<td><strong><?php echo ($plugin['result'])?JText::_('Installed'):JText::_('Not installed'); ?></strong></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
