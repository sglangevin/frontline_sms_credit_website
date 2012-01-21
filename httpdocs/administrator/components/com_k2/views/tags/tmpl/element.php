<?php
/**
 * @version		$Id: element.php 549 2010-08-30 15:39:45Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<form action="index.php" method="post" name="adminForm">
  <table width="100%">
    <tr>
      <td align="left" width="50%"><?php echo JText::_('Filter:'); ?>
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'] ?>" class="text_area" title="<?php echo JText::_('Filter by name'); ?>"/>
        <button onclick="this.form.submit();"><?php echo JText::_('Go'); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='-1';this.form.submit();"><?php echo JText::_('Reset'); ?></button></td>
      <td align="right" width="50%"><?php echo $this->lists['state']; ?></td>
    </tr>
  </table>
  <table class="adminlist">
    <thead>
      <tr>
        <th width="5" align="center"><?php echo JText::_( 'Num' ); ?></th>
        <th class="title"> <?php echo JHTML::_('grid.sort', 'Name', 'name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', 'Published', 'published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
        <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort', 'ID', 'id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> </th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="7"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
    <tbody>
      <?php
      	$k = 0; $i = 0;	$n = count( $this->rows );
				foreach ($this->rows as $row):
			?>
      <tr class="<?php echo "row$k"; ?>">
        <td align="center"><?php echo $i+1; ?></td>
        <td><a style="cursor:pointer" onclick="window.parent.jSelectTag('<?php echo urlencode($row->name); ?>', '<?php echo str_replace(array("'", "\""), array("\\'", ""),$row->name); ?>', 'tag');"><?php echo $row->name; ?></a></td>
        <td nowrap="nowrap"><?php echo JHTML::_('grid.published', $row, $i ); ?></td>
        <td align="center"><?php echo $row->id; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="tags" />
  <input type="hidden" name="task" value="element" />
  <input type="hidden" name="tmpl" value="component" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
</form>
