<div id="leftside">
	<ul class="sb-list clearfix">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

<?php if(function_exists('twitter_messages')) { ?>
<li>
	<ul class="sb-tools clearfix">
		<li class="twitter-icon">
    	<a class="sb-icon" href="http://twitter.com/cordobo" rel="nofollow">
    		<span><?php _e('Latest Tweet', 'default'); ?></span>
    		<?php if(function_exists('twitter_messages')) { twitter_messages('cordobo', 1, false, false, '', false, false, false); } ?>
      </a>
    	<p class="sb-icon-text"><?php _e('Follow me on twitter', 'default'); ?> <a href="http://twitter.com/cordobo" rel="nofollow"><?php _e('here', 'default'); ?></a>.</p>
		</li>
	</ul>
</li>
<?php } ?>


<li>
	<ul class="sb-tools clearfix">
		<li class="rss-icon">
			<a href="<?php if (get_option('greenpark2_feed_enable') == 'yes') { echo 'http://feeds.feedburner.com/' . get_option('greenpark2_feed_uri'); } else { echo get_bloginfo('rss2_url'); }?>" title="<?php _e('Subscribe to my feed - You\'ll be happy!', 'default'); ?>">
				<span><?php _e('Subscribe', 'default'); ?></span>
				<?php _e('Subscribe to my blogs feed', 'default'); ?>
			</a>
		</li>
	</ul>
</li>

<?php endif; // end 1st sidebar widgets  ?>


<?php if ( is_single() ) { ?>
<li>
	<ul class="sb-tools clearfix">
		<?php previous_post_link('<li class="previous-post">%link</li>', '<span>' . (__('Previous Entry', 'default')) . '</span> %title'); ?>
		<?php next_post_link('<li class="next-post">%link</li>', '<span>' . (__('Next Entry', 'default')) . '</span> %title'); ?>
	</ul>	
</li>
<?php } ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>

	<?php if ( is_404() || is_category() || is_day() || is_month() || is_year() || is_search() || is_paged() ) { ?>
	<li class="currently-viewing">

	<?php /* If this is a 404 page */ if (is_404()) { ?>
	<?php /* If this is a category archive */ } elseif (is_category()) { ?>
	<p><?php _e('You are currently browsing the archives for the', 'default'); ?> <?php single_cat_title(''); ?> <?php _e('category', 'default'); ?>.</p>

	<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
	<p><?php _e('You are currently browsing the archives for the day', 'default'); ?> <?php the_time('l, F jS, Y'); ?>.</p>

	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<p><?php _e('You are currently browsing the archives for', 'default'); ?> <?php the_time('F, Y'); ?>.</p>

	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<p><?php _e('You are currently browsing the archives for the year', 'default'); ?> <?php the_time('Y'); ?>.</p>

	<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
	<p><?php _e('You have searched for', 'default'); ?> <strong>'<?php the_search_query(); ?>'</strong>.
  <?php _e('If you are unable to find anything in these search results, you can try one of these links', 'default'); ?>.</p>

	<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<p><?php _e('You are currently browsing the', 'default'); ?> <a href="<?php echo bloginfo('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('blog archives', 'default'); ?>.</p>

	<?php } ?>

	</li>
	<?php }?>

<?php endif; // end 2nd sidebar widgets  ?>
</ul>

</div> <!-- #sidebar -->