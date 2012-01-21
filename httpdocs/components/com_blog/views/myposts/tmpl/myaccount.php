<?php defined('_JEXEC') or die('Restricted access');
$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );

?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/components/com_blog/style.css">
<form action="<?php echo JRoute::_( 'index.php?option=com_blog' ); ?>" method="post" id="josForm" name="josForm"  class="form-validate" enctype="multipart/form-data">
<div>
	<div class="clsLinkedBlog"><div class="clsLinkedBlog_title"><?php echo JText::_( 'Smart Blog' ); ?></div></div>
	<div id="clsTopMenuBg">
	<div class="clsFloatRight">	
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/add_post.png"  border="0" width="16px" align="bottom" alt="Add New Post" />
 			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=addpost&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('Add New Post');?></a>
			<?php if($this->user->get('id') > 0){ ?>
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/mypost.png"  border="0" width="16px" align="bottom" alt="My Posts" class="clsImgPadLeft" />
				<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Posts');?></a>
				<?php #echo JText::_('Display Posts : ');  echo $this->pagination->getLimitBox(true); ?>
 			<?php }?>
		</div>
 		<div class="clsFloatLeft">
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/myaccount.png"  border="0" width="16px" alt="My Account" class="clsImgPadLeft" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&task=myaccount&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Account');?></a>
		</div>
		<div class="clsClearBoth"></div>
	</div>
</div>
<div>
 	<div id="clsTableTdPadd">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td valign="top" align="center">
			<div id="clsTableTdPadd">
				<?php if($this->BlogDetails->image){?>
				
				<div align="left">
					<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/blogger/<?php echo "th".$this->BlogDetails->image;?>"  border="0" alt="Blog Image"  class="clsImgPad" />
				</div>
				<? }else{?>
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/blogger/no_photo_small.gif"  alt="Blog Image" border="1"  class="clsImgPad" />
				<?php } ?>
			</div>
			</td>
			<td valign="middle" align="left">
				<?php echo JText::_( 'Upload Blog Image' ); ?>
				<div id="clsTableTdPadd">
 				<input type="file" name="image" id="file-upload" /> (.jpeg, .gif, .png only)
				<input type="hidden" name="image_old" id="image_old" value="<?php echo $this->BlogDetails->image;?>" />
				</div>
 			</td>
		</tr>
		<tr>
			<td height="25" valign="top" colspan="2"><label id="titlemsg" for="title"><?php echo JText::_( 'My Blog Title' ); ?>:</label>
			<div id="clsTableTdPadd"><input type="text" maxlength="250" size="75%"  class="inputbox required" name="title" id="title" value="<?php echo $this->BlogDetails->title;?>" /> *</div></td>
		</tr>
		<tr>
			<td height="25" valign="top" colspan="2"><label id="descriptionmsg" for="description"><?php echo JText::_( 'Description' ); ?>:</label>
			<div id="clsTableTdPadd"><input type="text" maxlength="250" size="75%"  class="inputbox" name="description" id="description" value="<?php echo $this->BlogDetails->description;?>" /></div></td>
		</tr>
 		<tr>
			<td height="25" valign="top" colspan="2" class="clsTDBorderTop"><label id="publishedmsg" for="published"><?php echo JText::_( 'Do you want to publish?' ); ?>:</label>
			<? print $lists['status'] = JHTML::_('select.booleanlist', 'status', 'class="inputbox"  size="1"', ( isset($this->BlogDetails->status)) ? $this->BlogDetails->status : 1); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" height="25" align="right" class="clsTDBorderTop">
				<?php echo JText::_( '* Required' ); ?>
			</td>
		</tr>
		<tr>
			<td height="25"></td>
			<td>
				<button class="button validate" type="button"  onClick="javascript:window.location='<?php echo JRoute::_('index.php?option=com_blog&view=myposts' ); ?>'"><?php echo JText::_(' Cancel '); ?></button>
				<button class="button validate" type="submit"><?php echo JText::_('Save'); ?></button>	</td>
		</tr>
	</table>
	</div>
</div>
<input type="hidden" name="option" value="com_blog" />
<input type="hidden" name="view" value="myposts" />
<input type="hidden" name="user_id" value="<?php echo $this->user->get('id');?>" />
<input type="hidden" name="id" value="<?php echo $this->BlogDetails->id;?>" />
<input type="hidden" name="controller" value="blog" />
<input type="hidden" name="task" value="savebloggerdetails" />
</form>