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
class BlogViewComments
{
	function setBlogCommentsToolbar()
	{
		JToolBarHelper::title( JText::_( 'Smart Blog Manager-Comments' ), 'generic.png' );
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
	}

	function BlogComments( &$rows, &$pageNav, &$lists )
	{
		BlogViewComments::setBlogCommentsToolbar();
		$user =& JFactory::getUser();
		JHTML::_('behavior.tooltip');
		?>
		<form action="index.php" method="post" name="adminForm">
		<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Filter Reset' ); ?></button>
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
						<?php echo JHTML::_('grid.sort',  'Comments', 'b.comment_desc', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="10%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   'Posted By', 'b.user_id', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
					<th width="10%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',   'Posted On', 'b.comment_date', @$lists['order_Dir'], @$lists['order'] ); ?>
					</th>
 					<th width="5%" nowrap="nowrap">
						<?php echo JHTML::_('grid.sort',  'Published', 'b.published', @$lists['order_Dir'], @$lists['order'] ); ?>
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
				$link		= JRoute::_( 'index.php?option=com_blog&c=comments&pid='.$row->post_id.'&task=edit&cid[]='. $row->id );
 				
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
					<span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit' );?>::<?php echo $row->comment_desc; ?>">
						<?php
						if ( JTable::isCheckedOut($user->get ('id'), $row->checked_out ) ) {
							echo $row->comment_desc;
						} else {
							?>

							<a href="<?php echo $link; ?>">
								<?php echo $row->comment_desc; ?></a>
							<?php
						}
						?>
						</span>
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
						<?php echo $published;?>
					</td>
				</tr>
				<?php
				$k = 1 - $k;
			}
			?>
			</tbody>
			</table>

		<input type="hidden" name="c" value="comments" />
		<input type="hidden" name="option" value="com_blog" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="pid" value="<?php echo $row->post_id;?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $lists['order']; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $lists['order_Dir']; ?>" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<?php
	}

	function setBlogCommentToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');

		JToolBarHelper::title( $task == 'add' ? JText::_( 'Blog-Comment' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Blog-Comment' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( 'save' );
		JToolBarHelper::apply('apply');
		JToolBarHelper::cancel( 'cancel' );
	}
	
	/**
	 *function for Edit Posts
	 **/
	function editblogcomment( &$row, &$lists )
	{
		BlogViewComments::setBlogCommentToolbar();
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
			/*if (form.comment_title.value == "") {
				alert( "<?php //echo JText::_( 'You must provide title.', true ); ?>" );
			} else */if (form.comment_desc.value == "") {
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
					<!--
					<tr>
						<td height="25" valign="top"><label id="comment_titlemsg" for="comment_title"><?php echo JText::_( 'Title' ); ?>:</label></td>
						<td valign="top"><div id="clsTableTdPadd"><input type="text" maxlength="150" size="70%"  class="inputbox required" name="comment_title" id="comment_title" value="<?php echo $row->comment_title?>" /> *</div></td>
					</tr>
					-->
					<tr>
						<td width="19%" height="25" valign="top"><label id="comment_descmsg" for="comment_desc"><?php echo JText::_( 'Comment' ); ?>:</label></td>
						<td width="81%" valign="top">
						<div id="clsTableTdPadd">
							<?php
							$editor =& JFactory::getEditor();												
							$Edoptions['theme']	= 'simple';
							echo $editor->display('comment_desc', $row->comment_desc, '90%', '300', '550', '8', false, $Edoptions);
							?>
 						</div>
						</td>
					</tr>
					<tr>
						<td height="25" valign="top" colspan="2" class="clsTDBorderTop"><label id="product_specialmsg" for="product_special"><?php echo JText::_( 'Do you want to publish?' ); ?>:</label>
						<? print $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"  size="1"', ( isset($row->published)) ? $row->published : 1); ?>
						<div align="right"><?php echo JText::_( '* Required' ); ?></div>
						</td>
					</tr>
    				</tbody>
				</table>
			</fieldset>
		</div>
		<div class="clr"></div>

		<input type="hidden" name="c" value="comments" />
		<input type="hidden" name="option" value="com_blog" />
		<input type="hidden" name="pid" value="<?php echo $row->post_id; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
		<script language="javascript" type="text/javascript">
			var thisForm = document.adminForm; 
			var strpost_descLength   = 240 - thisForm.comment_desc.value.length;
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
