<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" />
    <?php wp_head(); ?>
    <script type="text/javascript"><!--//--><![CDATA[//><!--

sfHover = function() {
	var sfEls = document.getElementById("nav").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);

    //--><!]]></script>
    <!--[if lt IE 7]>
        <script defer type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pngfix.js"></script>
    <style type="text/css">
        *html .excrept_in {height: 1%;}
    </style>
    <![endif]-->
</head>
<body>
    <div id="header">
    <div id="topnav">
    <!--
        <div id="topnav_left">
            <ul id="pagenav">
                <?php wp_list_pages('sort_column=menu_order&title_li=&depth=1'); ?>
            </ul>
        </div>
    
        <div id="topnav_right">
            <script src="<?php bloginfo('template_url'); ?>/js/date.js" type="text/javascript"></script>
        </div>
    -->    
    <div class="clear"></div>
    </div><!-- End Topnav -->
        <div id="header_left">
		<img src="<?php bloginfo('template_url'); ?>/images/logo.png">        
        </div>
        
    
    <div id="navbar">
        <div id="navigation">
            <div id="nav_left">
                <ul id="nav">
                	<li><a class="home" href="http://credit.frontlinesms.com/" title="">Home</a></li>
                    <li><a class="about" href="http://credit.frontlinesms.com/index.php?option=com_content&view=article&id=1&Itemid=2" title="">About</a></li>
                    <li><a class="software" href="http://credit.frontlinesms.com/index.php?option=com_content&view=article&id=2&Itemid=3" title="">Software</a></li>
                    <li><a class="current blog" href="<?php echo get_settings('home'); ?>/" title="<?php bloginfo('description'); ?>">Blog</a></li>
                    <li><a class="contact" href="http://credit.frontlinesms.com/index.php?option=com_contact&view=contact&id=1&Itemid=5" title="">Contact</a></li>
                </ul>
            </div>
            
            
            
        <div class="clear"></div>
        </div>
    </div><!-- Header End Here -->
        
    </div>