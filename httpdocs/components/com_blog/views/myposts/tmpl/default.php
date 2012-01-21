<?php defined('_JEXEC') or die('Restricted access');
$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );

?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/components/com_blog/style.css">
<form action="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts' ); ?>" method="post" id="josForm" name="josForm">
<div>
	<div class="clsLinkedBlog"><div class="clsLinkedBlog_title"><?php echo JText::_( 'Smart Blog' ); ?></div></div>
	<div id="clsTopMenuBg">
		<?php if($this->user->get('id') > 0){ ?>
		<div class="clsFloatRight">
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/add_post.png"  border="0" width="16px" align="bottom" alt="Add New Post" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=addpost&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('Add New Post');?></a>
 			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/myaccount.png"  border="0" width="16px" align="bottom" alt="My Account" class="clsImgPadLeft" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&task=myaccount&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Account');?></a>
		</div>
		<div class="clsFloatLeft">	
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/mypost.png"  border="0" width="16px" align="bottom" alt="My Posts" class="clsImgPadLeft" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Posts');?></a>
			<?php #echo JText::_('Display Posts : ');  echo $this->pagination->getLimitBox(true); ?>
   		</div>
		<?php }?>
		<div class="clsFloatRight">
			
		</div>
		<div class="clsClearBoth"></div>
	</div>
</div>
	
<div id="clsWebpageBlueBorder" class="clsCompanyOverView">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <?php 
  $count=1;
  foreach( $this->bloglists as $bloglist):
  	$pb_image_title = ($bloglist->published == 1)? 'Published': 'Unpublished';
	$pb_image = ($bloglist->published == 1)? 'publish_g.png': 'publish_r.png';
	$pb_published = ($bloglist->published == 1)? 0 : 1;
   ?>
  <tr>
 	<td align="left" valign="top">
		<div class="clsPostTitle"><img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/<?php echo $pb_image;?>"  border="0" alt="<?php echo $pb_image_title;?>" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=comments&pid='.$bloglist->id.'&Itemid='.$Itemid, false); ?>"><?php echo JText::_($bloglist->post_title);?></a></div>
		<div class="clsTDBorderTop"></div>
		<div><?php print( strip_tags( substr( JText::_( $bloglist->post_desc),0,250)));?>...
		<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=comments&pid='.$bloglist->id.'&Itemid='.$Itemid, false); ?>">
			<?php echo JText::_('Read More...');?>
		</a>
		</div>
		
		<div id="divBlogDetails">
			<div align="right">
  				<?php 
 				echo JText::_('On ').JHTML::_('date',  $bloglist->post_date, JText::_('DATE_FORMAT_LC3')); ?>
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/comments.gif"  border="0" alt="Comments" />
				<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=comments&pid='.$bloglist->id.'&Itemid='.$Itemid, false); ?>">
					<?php 
					$options['id']	= $bloglist->id;
					$BlogCommentCount	= $this->modelBlogList->fncGetTotalComments( $options );
					echo JText::_('Comments('.$BlogCommentCount.')');?>
				</a>
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/readmore.png"  border="0" title="Read More..." />
				<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=comments&pid='.$bloglist->id.'&Itemid='.$Itemid, false); ?>">
					<?php echo JText::_('Read More...');?>
				</a>
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/hits.gif"  border="0" alt="Hits" />
				<?php echo JText::_('Views('.$bloglist->post_hits.')');?>

				<?php if($bloglist->user_id == $this->user->get('id')){?>
					<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&task=publishmypost&pid='.$bloglist->id.'&st='.$pb_published.'&Itemid='.$Itemid, false);?>">
					<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/<?php echo $pb_image;?>"  border="0" alt="<?php echo $pb_image_title;?>" />
					<?php echo $pb_image_title."  ";?>
					</a>
					<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/favorite.gif"  border="0" alt="Edit" />
					<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=addpost&pid='.$bloglist->id.'&Itemid='.$Itemid, false); ?>"><?php echo JText::_('Edit');?></a>
					
					<?php $delLink = JRoute::_( 'index.php?option=com_blog&view=comments&task=delete_mypost&pid='.$bloglist->id.'&Itemid='.$Itemid, false);?>
					<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/delete.gif"  border="0" alt="Delete" />
					<a href="javascript:void(0);"  onClick="javascript:__fncDeletePosts('<?php echo $delLink;?>');return false;"><?php echo JText::_('Delete');?></a>
					
				<?php }?>
				
			</div>
		</div>
	</td>
  </tr>
  <?php
	$count++;
  endforeach;?>
</table>
</div>
<div align="center" id="clsDivMarginTop10">
	<?php echo $this->pagination->getPagesLinks(); ?>
	<div><?php echo $this->pagination->getPagesCounter();?></div>
</div>
<input type="hidden" name="option" value="com_blog" />
<input type="hidden" name="view" value="blog" />
<input type="hidden" name="controller" value="blog" />
<input type="hidden" name="task" value="myposts" />
<input type="hidden" name="user_id" value="<?php echo $this->user->get('id');?>" />
</form>
<script language="javascript" type="text/javascript">
	function  __fncDeletePosts( strLink ){
		if( !confirm("Do you want to delete this post?")){
			return false;
		}
		window.location = strLink;
	}
</script>