<?php defined('_JEXEC') or die('Restricted access');
$Itemid = JRequest::getVar( 'Itemid', 0, 'get', 'int' );

?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl; ?>/components/com_blog/style.css">
<form action="<?php echo JRoute::_( 'index.php?option=com_blog&view=blogger' ); ?>" method="post" id="josForm" name="josForm">
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
 		<td colspan="2" id="clsBloggerTitle" valign="top" align="left">
			<?php if($this->BloggerDetails->image){?>
  					<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/blogger/<?php echo "th".$this->BloggerDetails->image;?>"  border="0" align="left" />
 				<? }else{?>
				<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/smartblog.png"  alt="Blogger Image" border="1" align="left" />
				<?php } ?>
 			<div class="clsLinkedBlog_title"><?php echo ($this->BloggerDetails->title) ? JText::_($this->BloggerDetails->title): JText::_('My Blog Title');?>
			<div id="clsBloggerDesc"><?php echo $this->BloggerDetails->description;?></div>
			<div id="clsBloggerLogDet"><?php echo 'Member Since : '.JHTML::_('date',  $this->BloggerDetails->registerDate, JText::_('DATE_FORMAT_LC1'));?></div>
			<div id="clsBloggerLogDet"><?php echo 'Last Login : '.JHTML::_('date',  $this->BloggerDetails->lastvisitDate, JText::_('DATE_FORMAT_LC1'));?></div>
  			</div>
		</td>
	  </tr>
 	</table>
	<div id="clsTopMenuBg">
		<?php if($this->user->get('id') > 0){ ?>
		<div class="clsFloatLeft">	
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/myaccount.png"  border="0" width="16px" align="bottom" alt="My Account" class="clsImgPadLeft" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&task=myaccount&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Account');?></a>
		</div>
		<div class="clsFloatRight">	
			<img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/mypost.png"  border="0" width="16px" align="bottom" alt="My Posts" class="clsImgPadLeft" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=myposts&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('My Posts');?></a>
			<?php #echo JText::_('Display Posts : ');  echo $this->pagination->getLimitBox(true); ?>
 		</div>
		<?php }?>
		<div class="clsFloatRight"><img src="<?php echo $this->baseurl; ?>/components/com_blog/Images/icons/add_post.png"  border="0" width="16px" align="bottom" alt="Add New Post" />
			<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=addpost&Itemid='.$Itemid, false ); ?>"><?php echo JText::_('Add New Post');?></a>
		</div>
		<div class="clsClearBoth"></div>
	</div>
</div>

	
<div id="clsWebpageBlueBorder" class="clsCompanyOverView">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php 
  $count=1;
  foreach( $this->bloglists as $bloglist):
   ?>
  <tr>
	<td align="left" valign="top">
		<div class="clsPostTitle"><a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=comments&pid='.$bloglist->id.'&Itemid='.$Itemid, false); ?>"><?php echo JText::_($bloglist->post_title);?></a></div>
		<div class="clsTDBorderTop"></div>
		<div><?php print( strip_tags( substr( JText::_( $bloglist->post_desc),0,500)));?>...
		<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=comments&pid='.$bloglist->id.'&Itemid='.$Itemid, false); ?>">
			<?php echo JText::_('Read More...');?>
		</a>
		</div>
		
		<div id="divBlogDetails">
			<div align="right">
				<?php echo JText::_('By:');?>
				<a href="<?php echo JRoute::_( 'index.php?option=com_blog&view=blogger&bn='.$bloglist->postedby.'&Itemid='.$Itemid, false);?>"><?php echo JText::_($bloglist->postedby);?></a>
				
				<?php echo JText::_(' On '). JHTML::_('date',  $bloglist->post_date, JText::_('DATE_FORMAT_LC1')); ?>
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
<input type="hidden" name="task" value="save_comment" />
</form>