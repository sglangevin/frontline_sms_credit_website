<?php
/**
 * @version		$Id: filebrowser.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<form method="post" name="fileBrowserForm" class="fileBrowserForm" action="index.php">

	  <h1><?php echo $this->title;?></h1>

		<div id="fileBrowserFolderPath">
			<a id="fileBrowserFolderPathUp" href="<?php echo JRoute::_('index.php?option=com_k2&view=item&task=filebrowser&folder='.$this->parent.'&type='.$this->type.'&tmpl=component');?>">
				<span><?php echo JText::_('Up'); ?></span>
			</a>
			<input type="text" value="<?php echo $this->path;?>" name="path" disabled="disabled" id="addressPath" maxlength="255" />
			<div class="clr"></div>
		</div>

	  <div id="fileBrowserFolders">

			<?php if(count($this->folders)): ?>
				<?php foreach ($this->folders as $folder) :	?>
					<div class="item">
						<a href="<?php echo JRoute::_('index.php?option=com_k2&view=item&task=filebrowser&folder='.$this->path.'/'.$folder.'&type='.$this->type.'&tmpl=component');?>">
							<img alt="<?php echo $folder;?>" src="<?php echo JURI::root()?>administrator/components/com_k2/images/system/folder.png">
							<span><?php echo $folder;?></span>
						</a>
					</div>
				<?php endforeach;?>
			<?php endif;?>

			<?php if(count($this->files)): ?>
			<?php foreach($this->files as $file): ?>
				<div class="item">
					<a href="/<?php echo $this->path.'/'.$file;?>" class="<?php echo $this->type;?>File">
						<img width="64" alt="<?php echo $file;?>" src="<?php echo ($this->type=='video')? JURI::root().'administrator/components/com_k2/images/system/video.png':JURI::root().$this->path.'/'.$file;?>">
						<span><?php echo $file;?></span>
					</a>
				</div>
			<?php endforeach;?>
			<?php endif;?>

			<div class="clr"></div>
		</div>

</form>
