<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/smoothscroll.js"></script>

  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="container">

<ul class="skip">
  <li><a href="#content">Skip to content</a></li>
  <li><a href="#footer">Skip to navigation and footer</a></li>
</ul>

<hr />

<div id="top-menu">
  <ul>
  	<li class="home page_item <?php if (is_front_page()) { echo ("home_current_page_item"); } ?>"><a href="<?php bloginfo('url'); ?>/" title="Back to the Homepage">Homepage</a></li>
  	<?php wp_list_pages('title_li=0&depth=1'); ?>
  </ul>
  <p id="rss"><a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe to this site!">Feed Rss</a></p>
</div>

<hr />

<div id="header">
  <h1><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>
  <p class="payoff"><?php bloginfo('description'); ?></p>
</div>

<hr />

<div id="content" <?php if (is_archive()) { echo ('class="archive"'); } ?> <?php if (is_404()) { echo ('class="error"'); } ?>>