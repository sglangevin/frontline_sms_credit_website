<?php
/*
Template Name: Donate
*/
?>

<?php get_header(); ?>
<?php get_sidebar('left'); ?>
	<div id="container">
		<div id="content_page">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>

<table border="0" cellspacing="5" cellpadding="0" width="100%">
<tbody>
<tr>
<td valign="top">
<h3>Buy one, fund one...</h3>
<hr />
<p>You can help support the FrontlineSMS:Credit mission by buying a solar panel and lamp through our site!</p>

<p>For every solar panel and lamp you buy, we get a free panel and lamp to use in pilot projects and to distribute freely to MFI parties. As we grow, the need to get pilots off the ground is fundamental to our success. And you can help!</p>

<p><a href="http://www.toughstuffonline.org/bofofaq/" target="_blank">Read the Buy One, Fund One FAQ &gt;&gt;</a></p>

<p><div style="padding-bottom:10px;">Where would you like your products sent?</div></p>

<table border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<form action="https://www.e-junkie.com/ecom/gb.php?c=cart&i=353072&cl=71771&ejc=2" target="ej_ejc" method="POST" accept-charset="UTF-8">
<select name="o1">
<option value="SEND ME solar panel and lamp in US">SEND ME solar panel and lamp in US</option>
<option value="SEND ME solar panel and lamp OUTSIDE the US">SEND ME solar panel and lamp OUTSIDE the US</option>
<option value="GIFT solar panel and lamp to a friend in US">GIFT solar panel and lamp to a friend in US</option>
<option value="GIFT solar panel and lamp to a friend OUTSIDE the US">GIFT solar panel and lamp to a friend OUTSIDE the US</option>
</select>
<br />
<hr />
<input type="image" src="http://www.e-junkie.com/ej/ej_add_to_cart.gif" border="0"  alt="Add to Cart" class="ec_ejc_thkbx" onClick="javascript:return EJEJC_lc(this.parentNode);"/>
</form>
</td>
</tr>
</tbody></table>
<a href="https://www.e-junkie.com/ecom/gb.php?c=cart&cl=71771&ejc=2" target="ej_ejc" class="ec_ejc_thkbx" onClick="javascript:return EJEJC_lc(this);"><img src="http://www.e-junkie.com/ej/ej_view_cart.gif" border="0" alt="View Cart" style="padding:0px; border:0px;" /></a>
<script language="javascript" type="text/javascript">
<!--
function EJEJC_lc(th) { return false; }
// -->
</script>
<script src='http://www.e-junkie.com/ecom/box.js' type='text/javascript'></script></td>
<td width="110"><img class="alignleft size-full wp-image-118" title="solar_panel" src="http://credit.frontlinesms.com/wp-content/uploads/solar_panel.jpg" alt="solar_panel" width="105" height="300" /></td>
</tr>
</tbody></table>


			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>