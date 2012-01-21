<?php
/*
Template Name: Archive
*/
?>
<?php get_header(); ?>

<div class="page custom-archive">
  <div class="column">
  <h2>Archives by Month:</h2>
  	<ul>
  		<?php wp_get_archives('type=monthly'); ?>
  	</ul>
  </div>
  
  <div class="column">
  <h2>Archives by Subject:</h2>
  	<ul>
  		 <?php wp_list_categories('show_count=1&title_li='); ?>
  	</ul>
  </div>
</div>

<hr />

<?php get_footer(); ?>