<?php
/**
 * @package WordPress
 * @subpackage Wordousel Lite
 */

/*
Template Name: Home_template
*/
?>

<?php get_header(); ?>

<div id="masthead">

<span class="jFlowPrev">Prev</span>

<div id="mySlides">

<!-- CATEGORY FOR CAROUSEL -->
<!-- showposts= should reflect the number of posts you want to pull
	 cat= Should reflect the category ID you want to pull posts from -->
	 
	<?php query_posts('showposts=4&cat=5'); ?>
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

<!-- END CATEGORY FOR CAROUSEL -->

<div>		
<div class="masthead_lft">
	
<!-- This pulls the post title & post excerpt -->
	
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
<?php the_excerpt(); ?>
</div>

		
<div class="masthead_rgt">

<!-- Next line defines the output of the post custom field "Thumb" is the name of the field
	 Make sure you use this when adding the image to the custom field. Image size= 413px × 212px -->


<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php $values = get_post_custom_values("Thumb"); echo $values[0]; ?>" alt="Featured Project" /></a>

</div>
</div>
		<?php endwhile; ?>
	<?php endif; ?>

</div>

<!-- SLIDE COUNT -->
<!-- The following classes control the amount of slides you have in your carousel. 
	 Make sure this matches showposts= above in the carousel area. Default, I am showing 4 panels, therefore 4 posts -->

<div id="myController">
<span class="jFlowControl">1</span>
<span class="jFlowControl">2</span>
<span class="jFlowControl">3</span>
<span class="jFlowControl">4</span>
</div>

<span class="jFlowNext">Next</span>

</div>

<div id="wrapper1" class="clearfix">

<h2>Stay Tuned</h2>

<p>After many requests, I have decided to integrate the carousel into a premium theme offering. Stay tuned for more information. I will also be offering a free version.</p>

<div class="hmdark">
<h2>Info</h2>

<p>Have you ever wondered how to integrate new WordPress posts into a content slider or carousel? Here is a 
working sample built with <a href="http://www.gimiti.com/kltan/wordpress/?p=46" title="jFlow">jFlow 1.2</a>. I used the WordPress 
<a href="http://codex.wordpress.org/Template_Tags/query_posts" title="query_posts">query_posts</a> call to output the latest 4 posts from the featured category.</p>



<p>Read the HOW TO by <a href="http://armeda.com/how-to-create-a-jquery-carousel-with-wordpress-posts/" title="Armeda">Dre Armeda</a>.</p>
</div> 
</div>

<?php get_footer(); ?>
