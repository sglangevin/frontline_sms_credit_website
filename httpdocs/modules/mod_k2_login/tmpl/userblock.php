<?php
/**
 * @version		$Id: userblock.php 503 2010-06-24 21:11:53Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2UserBlock <?php echo $params->get('moduleclass_sfx'); ?>">

	<?php if($userGreetingText): ?>
	<p class="ubGreeting"><?php echo $userGreetingText; ?></p>
  <?php endif; ?>

	<div class="k2UserBlockDetails">
	  <?php if($params->get('userAvatar')): ?>
	  <a class="k2Avatar ubAvatar" href="<?php echo JRoute::_(K2HelperRoute::getUserRoute($user->id)); ?>" title="<?php echo JText::_('My page'); ?>">
	  	<img src="<?php echo K2HelperUtilities::getAvatar($user->id, $user->email);?>" alt="<?php echo $user->name; ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
	  </a>
	  <?php endif; ?>
	  <span class="ubName"><?php echo $user->name; ?></span>
		<span class="ubCommentsCount"><?php echo JText::_('You have'); ?> <b><?php echo $user->numOfComments; ?></b> <?php if($user->numOfComments==1) echo JText::_('published comment'); else echo JText::_('published comments'); ?></span>
	  <div class="clr"></div>
	</div>

  <ul class="k2UserBlockActions">
    <?php if(is_object($user->profile) &&  isset($user->profile->addLink)):?>
    <li>
	    <a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $user->profile->addLink; ?>"><?php echo JText::_('Add new item'); ?></a>
    </li>
    <?php endif ; ?>
    
    <li>
	    <a href="<?php echo JRoute::_(K2HelperRoute::getUserRoute($user->id)); ?>"><?php echo JText::_('My page'); ?></a>
    </li>
    
    <li>
	    <a href="<?php echo JRoute::_('index.php?option=com_user&view=user&task=edit'); ?>"><?php echo JText::_('My account'); ?></a>
    </li>
    
		<li>
			<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&tmpl=component'); ?>"><?php echo JText::_('Moderate comments to my published items'); ?></a>
		</li>
  </ul>

  <form action="index.php" method="post">
    <input type="submit" name="Submit" class="button ubLogout" value="<?php echo JText::_( 'Logout'); ?>" />
    <input type="hidden" name="option" value="com_user" />
    <input type="hidden" name="task" value="logout" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
  </form>
</div>
