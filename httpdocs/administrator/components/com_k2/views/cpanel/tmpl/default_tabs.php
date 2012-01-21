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

?>

  <?php
		jimport('joomla.html.pane');
		$pane =& JPane::getInstance('Tabs');
		echo $pane->startPane('myPane');

		echo $pane->startPanel(JText::_('About'), 'aboutK2Tab');
		echo JText::_('K2_ABOUT');
		echo $pane->endPanel();
		?>
  <?php echo $pane->startPanel(JText::_('Latest items'), 'latestItemsTab'); ?>
  <table class="adminlist">
    <thead>
      <tr>
        <td class="title"><?php echo JText::_('Title'); ?></td>
        <td class="title"><?php echo JText::_('Created'); ?></td>
        <td class="title"><?php echo JText::_('Author'); ?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($this->latestItems as $latest): ?>
      <tr>
        <td><?php echo $latest->title; ?></td>
        <td><?php echo JHTML::_('date', $latest->created , JText::_('K2_DATE_FORMAT')); ?></td>
        <td><?php echo $latest->author; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $pane->endPanel(); ?>
  <?php echo $pane->startPanel(JText::_('Latest comments'), 'latestCommentsTab'); ?>
  <table class="adminlist">
    <thead>
      <tr>
        <td class="title"><?php echo JText::_('Comment'); ?></td>
        <td class="title"><?php echo JText::_('Added on'); ?></td>
        <td class="title"><?php echo JText::_('Posted by'); ?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach($this->latestComments as $latest): ?>
      <tr>
        <td><?php echo $latest->commentText; ?></td>
        <td><?php echo JHTML::_('date', $latest->commentDate , JText::_('K2_DATE_FORMAT')); ?></td>
        <td><?php echo $latest->userName; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php echo $pane->endPanel(); ?>
  <?php echo $pane->startPanel(JText::_('Statistics'), 'statsTab'); ?>
  <table class="adminlist">
    <thead>
      <tr>
        <td class="title"><?php echo JText::_('Type'); ?></td>
        <td class="title"><?php echo JText::_('Count'); ?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo JText::_('Items'); ?></td>
        <td><?php echo $this->numOfItems; ?> (<?php echo $this->numOfFeaturedItems.' '.JText::_('featured').' - '.$this->numOfTrashedItems.' '.JText::_('trashed'); ?>)</td>
      </tr>
      <tr>
        <td><?php echo JText::_('Categories'); ?></td>
        <td><?php echo $this->numOfCategories; ?> (<?php echo $this->numOfTrashedCategories.' '.JText::_('trashed'); ?>)</td>
      </tr>
      <tr>
        <td><?php echo JText::_('Tags'); ?></td>
        <td><?php echo $this->numOfTags; ?></td>
      </tr>
      <tr>
        <td><?php echo JText::_('Comments'); ?></td>
        <td><?php echo $this->numOfComments; ?></td>
      </tr>
      <tr>
        <td><?php echo JText::_('Users'); ?></td>
        <td><?php echo $this->numOfUsers; ?></td>
      </tr>
      <tr>
        <td><?php echo JText::_('User groups'); ?></td>
        <td><?php echo $this->numOfUserGroups; ?></td>
      </tr>
    </tbody>
  </table>
  <?php echo $pane->endPanel(); ?>
  <?php echo $pane->startPanel(JText::_('Credits'), 'creditsTab'); ?>
  <table class="adminlist">
    <thead>
      <tr>
        <td class="title"></td>
        <td class="title"><?php echo JText::_('Version'); ?></td>
        <td class="title"><?php echo JText::_('Type'); ?></td>
        <td class="title"><?php echo JText::_('License'); ?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><a target="_blank" href="http://nuovext.pwsp.net/">NuoveXT</a></td>
        <td>2.2</td>
        <td><?php echo JText::_('Icons'); ?></td>
        <td><?php echo JText::_('GNU/GPL'); ?></td>
      </tr>
      <tr>
        <td><a target="_blank" href="http://blog.tpdkdesign.net/2006/05/01/choose-your-sport/">tpdkdesign.net</a></td>
        <td><?php echo JText::_('n/a'); ?></td>
        <td><?php echo JText::_('Icons'); ?></td>
        <td><?php echo JText::_('Creative Commons Attribution - Noncommercial - No Derivative Works 3.0'); ?></td>
      </tr>
      
      <tr>
        <td><a target="_blank" href="http://www.komodomedia.com/">Komodo Media</a></td>
        <td><?php echo JText::_('n/a'); ?></td>
        <td><?php echo JText::_('Icons'); ?></td>
        <td><?php echo JText::_('Creative Commons Attribution-Share Alike 3.0 Unported License'); ?></td>
      </tr>
      <tr>
        <td><a target="_blank" href="http://p.yusukekamiyamane.com/">Fugue by Yusuke Kamiyamane</a></td>
        <td>2.9.4</td>
        <td><?php echo JText::_('Icons'); ?></td>
        <td><?php echo JText::_('Creative Commons Attribution 3.0 license'); ?></td>
      </tr>
      <tr>
        <td><a target="_blank" href="http://pear.php.net/package/Services_JSON/">Services_JSON</a></td>
        <td>1.0.1</td>
        <td><?php echo JText::_('PHP Class'); ?></td>
        <td><?php echo JText::_('BSD'); ?></td>
      </tr>
      <tr>
        <td><a target="_blank" href="http://www.verot.net/php_class_upload.htm">class.upload.php</a></td>
        <td>0.28</td>
        <td><?php echo JText::_('PHP Class'); ?></td>
        <td><?php echo JText::_('GNU/GPL'); ?></td>
      </tr>
      <tr>
        <td><a target="_blank" href="http://labs.komrade.gr/simpletabs/">SimpleTabs by Komrade</a></td>
        <td>1.3</td>
        <td><?php echo JText::_('Tabs script'); ?></td>
        <td><?php echo JText::_('GNU/GPL'); ?></td>
      </tr>
      <tr>
        <td><a target="_blank" href="http://digitarald.de/project/autocompleter/">Autocompleter (modified by JoomlaWorks)</a></td>
        <td>1.0rc4</td>
        <td><?php echo JText::_('Autocompleter script'); ?></td>
        <td><?php echo JText::_('MIT'); ?></td>
      </tr>
    </tbody>
  </table>
  <?php echo $pane->endPanel(); ?>
  <?php echo $pane->endPane(); ?>