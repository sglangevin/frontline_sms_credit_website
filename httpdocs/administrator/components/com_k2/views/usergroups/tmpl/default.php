<?php
/**
 * @version		$Id: default.php 549 2010-08-30 15:39:45Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<script type="text/javascript">
	//<![CDATA[
	window.addEvent('domready', function(){

		// For the Joomla! checkbox toggle button
		$$('#jToggler').addEvent('click', function(){
			checkAll(<?php echo count( $this->rows ); ?>);
		});
		
	});
	//]]>
</script>

<form action="index.php" method="post" name="adminForm">
  <table class="adminlist">
    <thead>
      <tr>
        <th>#</th>
        <th><input id="jToggler" type="checkbox" name="toggle" value="" /></th>
        <th class="title"><?php echo JHTML::_('grid.sort', 'Name', 'name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th><?php echo JHTML::_('grid.sort', 'User count', 'numOfUsers', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
        <th><?php echo JHTML::_('grid.sort', 'ID', 'id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $k = 0; $i = 0;
      
			foreach ($this->rows as $row) :
				$row->checked_out=0;
				$checked 	= JHTML::_('grid.checkedout', $row, $i );
				$link = JRoute::_('index.php?option=com_k2&view=userGroup&cid='.$row->id);
			?>
      <tr class="<?php echo "row$k"; ?>">
        <td class="k2Center"><?php echo $i+1; ?></td>
        <td class="k2Center"><?php echo $checked; ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $row->name;?></a></td>
        <td class="k2Center"><?php echo $row->numOfUsers; ?></td>
        <td class="k2Center"><?php echo $row->id; ?></td>
      </tr>
      <?php $k = 1 - $k; $i++; endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5"><?php echo $this->page->getListFooter(); ?></td>
      </tr>
    </tfoot>
  </table>
  
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="boxchecked" value="0" />
  
  <?php echo JHTML::_( 'form.token' );?>
</form>
