<?php
/**
 * @version		$Id: default.php 541 2010-08-17 14:23:04Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<form action="index.php" method="post" name="adminForm">

<table cellpadding="0" cellspacing="0" border="0" style="width:100%" id="k2InfoPage">
	<tr>
		<td>
		  <fieldset class="adminform">
		    <legend><?php echo JText::_('System information');?></legend>
		    <table class="adminlist">
		      <thead>
		        <tr>
		          <th><?php echo JText::_('Check'); ?></th>
		          <th><?php echo JText::_('Result');?></th>
		        </tr>
		      </thead>
		      <tfoot>
		        <tr>
		          <th colspan="2">&nbsp;</th>
		        </tr>
		      </tfoot>
		      <tbody>
		        <tr>
		          <td><strong><?php echo JText::_('Web Server');?></strong></td>
		          <td><?php echo $this->server; ?></td>
		        </tr>
		        <tr>
		          <td><strong><?php echo JText::_('PHP version');?></strong></td>
		          <td><?php echo $this->php_version; ?></td>
		        </tr>
		        <tr>
		          <td><strong><?php echo JText::_('MySQL version');?></strong></td>
		          <td><?php echo $this->db_version; ?></td>
		        </tr>
		        <tr>
		          <td><strong><?php echo JText::_('GD image library');?></strong></td>
		          <td><?php if ($this->gd_check) {$gdinfo=gd_info(); echo $gdinfo["GD Version"];} else echo JText::_('Disabled'); ?></td>
		        </tr>
		        <tr>
		          <td><strong><?php echo JText::_('Multibyte string support');?></strong></td>
		          <td><?php if ($this->mb_check) echo JText::_('Enabled'); else echo JText::_('Disabled'); ?></td>
		        </tr>
		        <tr>
		          <td><strong><?php echo JText::_('Upload limit');?></strong></td>
		          <td><?php echo ini_get('upload_max_filesize'); ?></td>
		        </tr>
		        <tr>
		          <td><strong><?php echo JText::_('Memory limit');?></strong></td>
		          <td><?php echo ini_get('memory_limit'); ?></td>
		        </tr>
		        <tr>
		          <td><strong><?php echo JText::_('Open remote files (allow_url_fopen)');?></strong></td>
		          <td><?php echo (ini_get('allow_url_fopen'))? JText::_('Yes'):JText::_('No'); ?></td>
		        </tr>
		      </tbody>
		    </table>
		  </fieldset>
		  
		  <fieldset class="adminform">
		    <legend><?php echo JText::_('Directory permissions');?></legend>
		    <table class="adminlist">
		      <thead>
		        <tr>
		          <th><?php echo JText::_('Check'); ?></th>
		          <th><?php echo JText::_('Result');?></th>
		        </tr>
		      </thead>
		      <tfoot>
		        <tr>
		          <th colspan="2">&nbsp;</th>
		        </tr>
		      </tfoot>
		      <tbody>
		        <tr>
		          <td><strong>media/k2</strong></td>
		          <td><?php if ($this->media_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
		        </tr>
		        <tr>
		          <td><strong>media/k2/attachments</strong></td>
		          <td><?php if ($this->attachments_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
		        </tr>
		        <tr>
		          <td><strong>media/k2/categories</strong></td>
		          <td><?php if ($this->categories_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
		        </tr>
		        <tr>
		          <td><strong>media/k2/galleries</strong></td>
		          <td><?php if ($this->galleries_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
		        </tr>
		        <tr>
		          <td><strong>media/k2/items</strong></td>
		          <td><?php if ($this->items_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
		        </tr>
		        <tr>
		          <td><strong>media/k2/users</strong></td>
		          <td><?php if ($this->users_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
		        </tr>
		        <tr>
		          <td><strong>media/k2/videos</strong></td>
		          <td><?php if ($this->videos_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
		        </tr>
		        <tr>
		          <td><strong>cache</strong></td>
		          <td><?php if ($this->cache_folder_check) echo JText::_('Writable'); else echo JText::_('Not writable'); ?></td>
		        </tr>
		      </tbody>
		    </table>
		  </fieldset>	
		</td>
		<td>
		  <fieldset class="adminform">
		    <legend><?php echo JText::_('K2 Modules');?></legend>
		    <table class="adminlist">
		      <thead>
		        <tr>
		          <th><?php echo JText::_('Check'); ?></th>
		          <th><?php echo JText::_('Result');?></th>
		        </tr>
		      </thead>
		      <tfoot>
		        <tr>
		          <th colspan="2">&nbsp;</th>
		        </tr>
		      </tfoot>
		      <tbody>
		        <tr>
		          <td><strong>mod_k2_comments</strong></td>
		          <td><?php echo (is_null(JModuleHelper::getModule('mod_k2_comments')))?JText::_('Not installed'):JText::_('Installed');?></td>
		        </tr>
		        <tr>
		          <td><strong>mod_k2_content</strong></td>
		          <td><?php echo (is_null(JModuleHelper::getModule('mod_k2_content')))?JText::_('Not installed'):JText::_('Installed');?></td>
		        </tr>
		        <tr>
		          <td><strong>mod_k2_login</strong></td>
		          <td><?php echo (is_null(JModuleHelper::getModule('mod_k2_login')))?JText::_('Not installed'):JText::_('Installed');?></td>
		        </tr>
		        <tr>
		          <td><strong>mod_k2_tools</strong></td>
		          <td><?php echo (is_null(JModuleHelper::getModule('mod_k2_tools')))?JText::_('Not installed'):JText::_('Installed');?></td>
		        </tr>
		        <tr>
		          <td><strong>mod_k2_users</strong></td>
		          <td><?php echo (is_null(JModuleHelper::getModule('mod_k2_users')))?JText::_('Not installed'):JText::_('Installed');?></td>
		        </tr>
		        <tr>
		          <td><strong>mod_k2_quickicons</strong> (administrator)</td>
		          <td><?php echo (is_null(JModuleHelper::getModule('mod_k2_quickicons')))?JText::_('Not installed'):JText::_('Installed');?></td>
		        </tr>
		      </tbody>
		    </table>
		  </fieldset>
		  
		  <fieldset class="adminform">
		    <legend><?php echo JText::_('K2 Plugins');?></legend>
		    <table class="adminlist">
		      <thead>
		        <tr>
		          <th><?php echo JText::_('Check'); ?></th>
		          <th><?php echo JText::_('Result');?></th>
		        </tr>
		      </thead>
		      <tfoot>
		        <tr>
		          <th colspan="2">&nbsp;</th>
		        </tr>
		      </tfoot>
		      <tbody>
		        <tr>
		          <td><strong>System - K2</strong></td>
		          <td><?php echo (JFile::exists(JPATH_PLUGINS.DS.'system'.DS.'k2.php'))?JText::_('Installed'):JText::_('Not installed');?> - <?php echo (JPluginHelper::isEnabled('system', 'k2'))?JText::_('Enabled'):JText::_('Disabled');?></td>
		        </tr>
		        <tr>
		          <td><strong>User - K2</strong></td>
		          <td><?php echo (JFile::exists(JPATH_PLUGINS.DS.'user'.DS.'k2.php'))?JText::_('Installed'):JText::_('Not installed');?> - <?php echo (JPluginHelper::isEnabled('user', 'k2'))?JText::_('Enabled'):JText::_('Disabled');?></td>
		        </tr>
		        <tr>
		          <td><strong>Search - K2</strong></td>
		          <td><?php echo (JFile::exists(JPATH_PLUGINS.DS.'search'.DS.'k2.php'))?JText::_('Installed'):JText::_('Not installed');?> - <?php echo (JPluginHelper::isEnabled('search', 'k2'))?JText::_('Enabled'):JText::_('Disabled');?></td>
		        </tr>
		      </tbody>
		    </table>
		  </fieldset>
		
		  <fieldset class="adminform">
		    <legend><?php echo JText::_('Third-party plugin information');?></legend>
		    <table class="adminlist">
		      <thead>
		        <tr>
		          <th><?php echo JText::_('Check'); ?></th>
		          <th><?php echo JText::_('Result');?></th>
		        </tr>
		      </thead>
		      <tfoot>
		        <tr>
		          <th colspan="2">&nbsp;</th>
		        </tr>
		      </tfoot>
		      <tbody>
		        <tr>
		          <td><strong><?php echo JText::_('AllVideos Plugin');?></strong></td>
		          <td><?php 
						if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_allvideos.php'))
							echo JText::_('Installed');
						else 
							echo JText::_('Not installed');
					?></td>
		        </tr>		     
		        <tr>
		          <td><strong><?php echo JText::_('Simple Image Gallery PRO Plugin');?></strong></td>
		          <td><?php 
						if (JFile::exists(JPATH_PLUGINS.DS.'content'.DS.'jw_sigpro.php'))
							echo JText::_('Installed');
						else 
							echo JText::_('Not installed');
					?></td>
		        </tr>
		      </tbody>
		    </table>
		  </fieldset>		
		</td>
	</tr>
</table>


  

  
</form>
