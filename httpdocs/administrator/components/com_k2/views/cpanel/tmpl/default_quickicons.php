<?php
/**
 * @version		$Id$
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Get user group ID
$user= &JFactory::getUser();
$params = &JComponentHelper::getParams('com_k2');
?>

  <div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=item">
		    <img alt="<?php echo JText::_('Add new item'); ?>" src="components/com_k2/images/dashboard/item-new.png" />
		    <span><?php echo JText::_('Add new item'); ?></span>
	    </a>
    </div>
  </div>

  <div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=items&amp;filter_trash=0">
		    <img alt="<?php echo JText::_('Items'); ?>" src="components/com_k2/images/dashboard/items.png" />
		    <span><?php echo JText::_('Items'); ?></span>
	    </a>
    </div>
  </div>

	<div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=items&amp;filter_featured=1">
		    <img alt="<?php echo JText::_('Featured items'); ?>" src="components/com_k2/images/dashboard/items-featured.png" />
		    <span><?php echo JText::_('Featured items'); ?></span>
	    </a>
    </div>
  </div>

  <div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=items&amp;filter_trash=1">
		    <img alt="<?php echo JText::_('Trashed items'); ?>" src="components/com_k2/images/dashboard/items-trashed.png" />
		    <span><?php echo JText::_('Trashed items'); ?></span>
	    </a>
    </div>
  </div>

	<div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=categories&amp;filter_trash=0">
		    <img alt="<?php echo JText::_('Categories'); ?>" src="components/com_k2/images/dashboard/categories.png" />
		    <span><?php echo JText::_('Categories'); ?></span>
	    </a>
    </div>
  </div>

	<div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=categories&amp;filter_trash=1">
		    <img alt="<?php echo JText::_('Trashed categories'); ?>" src="components/com_k2/images/dashboard/categories-trashed.png" />
		    <span><?php echo JText::_('Trashed categories'); ?></span>
	    </a>
    </div>
  </div>

	<?php if( !$params->get('lockTags') || $user->gid>23):?>
	<div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=tags">
		    <img alt="<?php echo JText::_('Tags'); ?>" src="components/com_k2/images/dashboard/tags.png" />
		    <span><?php echo JText::_('Tags'); ?></span>
	    </a>
    </div>
  </div>
  <?php endif; ?>


	<div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=comments">
		    <img alt="<?php echo JText::_('Comments'); ?>" src="components/com_k2/images/dashboard/comments.png" />
		    <span><?php echo JText::_('Comments'); ?></span>
	    </a>
    </div>
  </div>

  <?php if ($user->gid>23): ?>
  <!--
  <div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&view=users">
		    <img src="components/com_k2/images/dashboard/users.png" alt="<?php echo JText::_('Users'); ?>" />
		    <span><?php echo JText::_('Users'); ?></span>
	    </a>
    </div>
  </div>

  <div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&view=userGroups">
		    <img src="components/com_k2/images/dashboard/user-groups.png" alt="<?php echo JText::_('User groups'); ?>" />
		    <span><?php echo JText::_('User groups'); ?></span>
	    </a>
    </div>
  </div>
  -->

  <div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=extraFields">
		    <img alt="<?php echo JText::_('Extra fields'); ?>" src="components/com_k2/images/dashboard/extra-fields.png" />
		    <span><?php echo JText::_('Extra fields'); ?></span>
	    </a>
    </div>
  </div>

	<div style="float:left;">
    <div class="icon">
	    <a href="index.php?option=com_k2&amp;view=extraFieldsGroups">
		    <img alt="<?php echo JText::_('Extra field groups'); ?>" src="components/com_k2/images/dashboard/extra-field-groups.png" />
		    <span><?php echo JText::_('Extra field groups'); ?></span>
	    </a>
    </div>
  </div>
  <?php endif; ?>

	<div style="float:left;">
    <div class="icon">
	    <a href="#" onclick="window.open('http://www.splashup.com/splashup/','splashupEditor','height=700,width=990,toolbar=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes'); return false;">
		    <img alt="<?php echo JText::_('Edit images (with SplashUp)'); ?>" src="components/com_k2/images/dashboard/image-editing.png" />
		    <span><?php echo JText::_('Edit images<br />(with SplashUp)'); ?></span>
	    </a>
    </div>
  </div>

  <div style="float:left;">
    <div class="icon">
    	<a target="_blank" href="http://getk2.org/documentation/">
    		<img alt="<?php echo JText::_('K2 Docs &amp; Tutorials'); ?>" src="components/com_k2/images/dashboard/documentation.png" />
    		<span><?php echo JText::_('K2 Docs &amp; Tutorials'); ?></span>
    	</a>
    </div>
  </div>

  <?php if ($user->gid>23): ?>
  <div style="float:left;">
    <div class="icon">
    	<a target="_blank" href="http://community.getk2.org/">
    		<img alt="<?php echo JText::_('K2 Community'); ?>" src="components/com_k2/images/dashboard/help.png" />
    		<span><?php echo JText::_('K2 Community'); ?></span>
    	</a>
    </div>
  </div>

  <div style="float:left;">
    <div class="icon">
	    <a class="modal" rel="{handler: 'iframe', size: {x: 1040, y: 600}}" href="http://start.joomlaworks.gr" title="<?php echo JText::_('Joomla! Community News by Joomla!Sphere, a free service from JoomlaWorks'); ?>">
		    <img alt="<?php echo JText::_('Joomla! Community News by Joomla!Sphere, a free service from JoomlaWorks'); ?>" src="components/com_k2/images/dashboard/joomlasphere.png" />
		    <span><?php echo JText::_('Joomla!<br />Community News'); ?></span>
	    </a>
    </div>
  </div>
  <?php endif; ?>
