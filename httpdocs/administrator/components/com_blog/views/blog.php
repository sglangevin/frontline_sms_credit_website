<?php
/**
 * @version		$Id: banner.php 10554 2008-07-15 17:15:19Z ircmaxell $
 * @package		Joomla
 * @subpackage	Banners
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
* @package		Joomla
* @subpackage	Banners
*/
class BlogViewBlog
{
	function setBlogToolbar()
	{
		JToolBarHelper::title( JText::_( 'Smart Blog Manager' ), 'generic.png' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
	}

	function Blog( &$rows, &$pageNav, &$lists )
	{
		BlogViewBlog::setBlogToolbar();
		$user =& JFactory::getUser();
		JHTML::_('behavior.tooltip');
		?>
		<form action="index.php?option=com_blog" method="post" name="adminForm">
		<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Filter Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
				<?php
 					echo $lists['state'];
				?>
			</td>
		</tr>
		</table>

			<table class="adminlist">
			<thead>
				<tr>
					<th width="20">
						<?php echo JText::_( 'Num' ); ?>
					</th>
					<th width="20">
						<input type="checkbox" name="toggle" value=""  onclick="checkAll(<?php echo count( $rows ); ?>);" />
					</th>
					<th nowrap="nowrap" class="title">
						<?php echo JHTML::_('grid.sort',  'Title', 'b.post_title', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="10%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   'Blogger', 'b.user_id', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="10%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   'Username', 'b.user_id', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="10%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   'Posted On', 'b.post_date', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="10%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   'Edited On', 'b.post_update', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="5%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',  'Views', 'b.post_hits', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="5%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',  'Published', 'b.published', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="10%" nowrap="nowrap">
						<?php echo '#'; ?>
					</th>

				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="13">
						<?php echo $pageNav->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php
			$k = 0;
			for ($i=0, $n=count( $rows ); $i < $n; $i++) {
				$row = &$rows[$i];

				$row->id	= $row->id;
				$link		= JRoute::_( 'index.php?option=com_blog&task=edit&cid[]='. $row->id );
 				
 				$row->published = $row->published;
				$published 		= JHTML::_('grid.published', $row, $i );
				$checked		= JHTML::_('grid.checkedout',   $row, $i );
				?>
				<tr class="<?php echo "row$k"; ?>">
					<td align="center">
						<?php echo $pageNav->getRowOffset($i); ?>
					</td>
					<td align="center">
						<?php echo $checked; ?>
					</td>
					<td>
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit' );?>::<?php echo substr(JText::_($row->post_title),0, 200); ?>...">
						<?php
 						if ( JTable::isCheckedOut($user->get ('id'), $row->checked_out ) ) {
							echo $row->post_title;
						} else {
							?>

							<a href="<?php echo $link; ?>">
								<?php echo $row->post_title; ?></a>
							<?php
						}
						?>
						</span>
					</td>
					<td align="center"> 
					<?php if( $row->my_user_id){?>
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit Blogger Details' );?>::<?php echo $row->postedname; ?>">
						<a href="<?php echo JRoute::_('index.php?option=com_blog&c=myaccount&task=edit&id='.$row->user_id. ''); ?>">
							<?php echo $row->postedname;?>
						</a>
					</span>
					<?php }else{
						echo $row->postedname;
					}?>
					</td>
					<td align="center"> 
						<a href="<?php echo 'index.php?option=com_users&amp;view=user&amp;task=edit&amp;cid[]='.$row->user_id.''; ?>">
							<?php echo $row->postedname;?>
						</a>
					</td>
					<td align="center">
						<?php echo JHTML::_('date',  $row->post_date, JText::_('DATE_FORMAT_LC1')); ?>
					</td>
					<td align="center">
						<?php echo JHTML::_('date',  $row->post_update, JText::_('DATE_FORMAT_LC1')); ?>
					</td>
					<td align="center">
						<?php echo $row->post_hits;?>
					</td>
					<td align="center">
						<?php echo $published;?>
					</td>
					<td align="center">
						<a href="<?php echo 'index.php?option=com_blog&amp;c=comments&amp;pid='. $row->id. ''; ?>">
							<?php echo 'View Comments';?> ( <?php $options['id'] = $row->id;  echo $this->fncGetTotalComments($options);?> )
						</a>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			</tbody>
			</table>

		<input type="hidden" name="c" value="blog" />
		<input type="hidden" name="option" value="com_blog" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<?php
	}

	function setBlogPostToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');

		JToolBarHelper::title( $task == 'add' ? JText::_( 'Blog-Post' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Blog-Post' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( 'save' );
		JToolBarHelper::apply('apply');
		JToolBarHelper::cancel( 'cancel' );
	}
	
	/**
	 *function for Edit Posts
	 **/
	function editblogpost( &$row, &$lists )
	{
		BlogViewBlog::setBlogPostToolbar();
		JRequest::setVar( 'hidemainmenu', 1 );
		JFilterOutput::objectHTMLSafe( $row, ENT_QUOTES, 'custombannercode' );
		?>
		<script language="javascript" type="text/javascript">
		<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.post_title.value == "") {
				alert( "<?php echo JText::_( 'You must provide title.', true ); ?>" );
			} else if (form.post_desc.value == "") {
				alert( "<?php echo JText::_( 'You must provide description.', true ); ?>" );
			}else{
				submitform( pressbutton );
			}
		}
 		//-->
		</script>
		<form action="index.php" method="post" name="adminForm">
		<div class="col100">
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Details' ); ?></legend>
				<table class="admintable" width="100%">
				<tbody>
					<tr>
						<td height="25" valign="top"><label id="post_titlemsg" for="post_title"><?php echo JText::_( 'Title' ); ?>:</label></td>
						<td valign="top"><div id="clsTableTdPadd"><input type="text" maxlength="150" size="70%"  class="inputbox required" name="post_title" id="post_title" value="<?php echo $row->post_title;?>" /> *</div></td>
					</tr>
					<tr>
					  <td width="9%" height="25" valign="top"><label id="post_descmsg" for="post_desc"><?php echo JText::_( 'Description' ); ?>:</label></td>
						<td width="91%" valign="top">
						<div id="clsTableTdPadd">
						<?php
						$editor =& JFactory::getEditor();												
						$Edoptions['theme']	= 'simple';
						echo $editor->display('post_desc', $row->post_desc, '90%', '300', '550', '100', false, $Edoptions);
						?>
							 
						</div>
					  </td>
					</tr>
					<tr>
						<td height="25" valign="top"><?php echo JText::_( 'Upload Image' ); ?></td>
						<td valign="top">
						<div id="clsTableTdPadd">
							<input type="hidden" name="image_old" id="image_old" value="<?php echo $row->post_image;?>" />
							<div>
							<?php if($row->post_image){?>
							<div align="left">
								<img src="../components/com_blog/Images/blogimages/<?php echo "th".$row->post_image;?>"  border="0" alt="Blog Image"  class="clsImgPad" />
							</div>
							<? } ?>
							</div>
 						</div>
						</td>
					</tr>
					<tr>
						<td height="25" valign="top" colspan="2" class="clsTDBorderTop"><label id="product_specialmsg" for="product_special"><?php echo JText::_( 'Do you want to publish?' ); ?>:</label>
						<? print $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"  size="1"', ( isset($row->published)) ? $row->published : 1); ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" height="25" align="right" class="clsTDBorderTop">
							<?php echo JText::_( '* Required' ); ?>
						</td>
					</tr>
  				</tbody>
				</table>
			</fieldset>
		</div>
		<div class="clr"></div>

		<input type="hidden" name="c" value="blog" />
		<input type="hidden" name="option" value="com_blog" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<script language="javascript" type="text/javascript">
			var thisForm = document.adminForm; 
			var strpost_descLength   = 240 - thisForm.post_desc.value.length;
			if(thisForm.remLen0.value == '' ){
				thisForm.remLen0.value = strpost_descLength;
			}
			function textCounter(field,cntfield,maxlimit) {
				if (field.value.length > maxlimit) // if too long...trim it!
					field.value = field.value.substring(0, maxlimit);
					// otherwise, update 'characters left' counter
				else
					cntfield.value = maxlimit - field.value.length;
			}
		</script>
		<?php
	}
}
