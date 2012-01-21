<?php get_header(); ?>

<?php /* If this is a category archive */ if (is_category()) { ?>
<h2 class="title">Archive for the &#8216;<strong><?php single_cat_title(); ?></strong>&#8217; category</h2>
<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
<h2 class="title">Posts Tagged &#8216;<strong><?php single_tag_title(); ?></strong>&#8217;</h2>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h2 class="title">Archive for <strong><?php the_time('F jS, Y'); ?></strong></h2>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h2 class="title">Archive for <strong><?php the_time('F, Y'); ?></strong></h2>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h2 class="title">Archive for <strong><?php the_time('Y'); ?></strong></h2>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h2 class="title">Blog Archives</h2>
<?php } ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php 
     $time = get_the_time('M d Y');
     list($mo, $da, $ye) = explode(" ", $time);
	?>
  <div class="date" title="<?php the_time('d-m-Y'); ?>">
    <p>
         <span class="month"><?php echo($mo); ?></span>
         <span class="day"><?php echo($da); ?></span>
         <span class="year"><?php echo($ye); ?></span>
    </p>
  </div>
	<h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
  <div class="meta"><p><span class="category"><?php _e("category:"); ?> <?php the_category(',') ?></span> <span class="user">author: <?php the_author_posts_link(); ?> </span> <?php edit_post_link(__('Edit This')); ?></p></div>

	<div class="storycontent">
		<?php the_excerpt("Continue reading " . the_title('"', '"', false) . " &raquo;"); ?>
	</div>

	<p class="feedback"><?php comments_popup_link(__('0 comments'), __('1 comment'), __('% comments')); ?></p>
	<?php if (function_exists('the_tags')): ?>
  	<?php if (has_tag()): ?>
    	<p class="tags"><?php the_tags('tag: ',', '); ?></p>
  	<?php endif;?>
	<?php endif;?>

</div>
<hr />
<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<p class="navigation"><?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?></p>

<?php get_footer(); ?>