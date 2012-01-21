<div id="sidebar">
	<ul class="sb-list clearfix">


<ul class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?>
  
  <?php if ( is_front_page() || is_home() || is_page() ) { ?>
    <?php wp_list_pages('title_li=<div class="sb-title">' . __('Pages','default') . '</div>' ); ?>
  <?php } ?>
  
  <?php if ( is_home() || is_day() || is_month() || is_year() ) { ?>
  	<li class="archives">
      <div class="sb-title"><?php _e('Archives', 'default'); ?></div>
  		<ul>
  		  <?php wp_get_archives('type=monthly'); ?>
  		</ul>
  	</li>
  <?php } ?>
  
  <?php if ( is_home() || is_category() ) { ?>
    <?php wp_list_categories('show_count=1&title_li=<div class="sb-title">' . __('Categories','default') . '</div>'); ?>
  <?php } ?>

<?php endif; // end 3rd sidebar widgets  ?>
</ul>

<ul class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : ?>
  
  <?php if ( is_front_page() || is_home() || is_page() ) { ?>
    <?php wp_list_pages('title_li=<div class="sb-title">' . __('Pages','default') . '</div>' ); ?>
  <?php } ?>
  
  <?php if ( is_home() || is_day() || is_month() || is_year() ) { ?>
  	<li class="archives">
      <div class="sb-title"><?php _e('Archives', 'default'); ?></div>
  		<ul>
  		  <?php wp_get_archives('type=monthly'); ?>
  		</ul>
  	</li>
  <?php } ?>
  
  <?php if ( is_home() || is_category() ) { ?>
    <?php wp_list_categories('show_count=1&title_li=<div class="sb-title">' . __('Categories','default') . '</div>'); ?>
  <?php } ?>

<?php endif; // end 4th sidebar widgets  ?>
</ul>

</div> <!-- #sidebar -->