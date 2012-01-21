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
class BlogViewmyaccount
{
 	function setPrivacynoticeEditToolbar()
	{
		$task = JRequest::getVar( 'task', '', 'method', 'string');

		JToolBarHelper::title( $task == 'add' ? JText::_( 'Manage Blog: - Blogger Details' ) . ': <small><small>[ '. JText::_( 'New' ) .' ]</small></small>' : JText::_( 'Manage Blog: - Blogger Details' ) . ': <small><small>[ '. JText::_( 'Edit' ) .' ]</small></small>', 'generic.png' );
		JToolBarHelper::save( 'save' );
		JToolBarHelper::apply('apply');
		JToolBarHelper::cancel( 'cancel' );
	}
	
	/**
	 *function for Edit Posts
	 **/
	function edit( &$row, &$lists )
	{
 		BlogViewmyaccount::setPrivacynoticeEditToolbar();
		JRequest::setVar( 'hidemainmenu', 1 );
 		?>
		<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/components/com_blog/style.css">
 		<script language="javascript" type="text/javascript">
		<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
 			submitform( pressbutton );
 		}
 		//-->
		</script>
 		<form action="index.php" method="post" name="adminForm">
		<div class="col100">
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Details' ); ?></legend>
				<table class="admintable" width="80%">
				<tbody>
 					<tr>
						<td valign="top" align="left" colspan="2">
						<div id="clsTableTdPadd">
							<?php if($row->image){?>
							
							<div align="left">
								<img src="../components/com_blog/Images/blogger/<?php echo "th".$row->image;?>"  border="0" alt="Blog Image"  class="clsImgPad" />
							</div>
							<? }else{?>
							<img src="../components/com_blog/Images/blogger/no_photo_small.gif"  alt="Blog Image" border="1"  class="clsImgPad" />
							<?php } ?>
						</div>
						</td>
 					</tr>
 					<tr>
						<td height="25" valign="top" colspan="2"><label id="titlemsg" for="title"><?php echo JText::_( 'My Blog Title' ); ?>:</label>
						<div id="clsTableTdPadd"><input type="text" maxlength="250" size="75%"  class="inputbox required" name="title" id="title" value="<?php echo $row->title;?>" /> *</div></td>
					</tr>
					<tr>
						<td height="25" valign="top" colspan="2"><label id="descriptionmsg" for="description"><?php echo JText::_( 'Description' ); ?>:</label>
						<div id="clsTableTdPadd"><input type="text" maxlength="250" size="75%"  class="inputbox" name="description" id="description" value="<?php echo $row->description;?>" /></div></td>
					</tr>
 					<tr>
						<td height="25" valign="top" colspan="2" class="clsTDBorderTop"><label id="publishedmsg" for="published"><?php echo JText::_( 'Status' ); ?>:</label>
						<? print $lists['status'] = JHTML::_('select.booleanlist', 'status', 'class="inputbox"  size="1"', ( isset($row->status)) ? $row->status : 1); ?>
						</td>
					</tr>
					<tr>
						<td height="25" valign="top" colspan="2" class="clsTDBorderTop"><label id="publishedmsg" for="published"><?php echo JText::_( 'Publish?' ); ?>:</label>
						<? print $lists['published'] = JHTML::_('select.booleanlist', 'published', 'class="inputbox"  size="1"', ( isset($row->published)) ? $row->published : 1); ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" height="25" align="left" class="clsTDBorderTop">
							<?php echo JText::_( '* Required' ); ?>
						</td>
					</tr>
  				</tbody>
				</table>
 			</fieldset>
		</div>
		<div class="clr"></div>
 		<input type="hidden" name="c" value="myaccount" />
		<input type="hidden" name="option" value="com_blog" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="user_id" value="<?php echo $row->user_id; ?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHTML::_( 'form.token' ); ?>
		</form>
 		<?php
	}
}
