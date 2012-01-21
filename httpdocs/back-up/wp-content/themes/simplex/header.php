<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="Keywords" content="microfinance, micro-finance, microcredit, micro-credit, microinsurance, micro-insurance, financial inclusion, mobile money, m-money, m-wallet, mobile payment, m-payment, mobile money transfer, frontlinesms, sms, mobile microfinance, sms banking, millennium development goals, MDG, MDGs, women's empowerment, women in development, empowerment, ken banks, kiwanja.net, savings, credit, ict4d, information communication technology for development, development, non-profit, mobile finance, SME, small and medium enterprise, informal sector, informal economy, female empowerment, creditsms, credit history, bottom billion, bottom of the pyramid, poorest of the poor, economic empowerment, inclusive technology, GSM, GPRS, EDGE, mobile activism, mobile innovation, mobile development, m-finance, m-development, BOP, enterprise, social enterprise, social entrepreneur, social entrepreneurship, technopreneurship, technopreneur, open source, open software, FrontlineSMS:Medic, decentralizing technology, digital empowerment" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?> - <?php bloginfo('description'); ?> </title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/includes/js/suckerfish.js"></script>
<!--[if lt IE 7]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script>
<![endif]--> 
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="shortcut icon" href="http://credit.frontlinesms.com/favicon.ico">
<?php wp_head(); ?>
<!--[if lte IE 7]>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie.css" />
<![endif]-->
<script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.2.6.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	$(function(){
		var tabContainers = $('div#maintabdiv > div');
		tabContainers.hide().filter('#comments').show();
		
		$('div#maintabdiv ul#tabnav a').click(function () {
				tabContainers.hide();
				tabContainers.filter(this.hash).show();
				$('div#maintabdiv ul#tabnav a').removeClass('current');
				$(this).addClass('current');
				return false;
			}).filter('#comments').click();
		
		
	});
</script>

<script src="http://credit.frontlinesms.com/wp-content/themes/simplex/scripts/jquery-1.3.1.js" type="text/javascript"></script>
<script src="http://credit.frontlinesms.com/wp-content/themes/simplex/scripts/cufon-yui.js" type="text/javascript"></script>
<script src="http://credit.frontlinesms.com/wp-content/themes/simplex/scripts/Trade_Gothic_LT_Std_700.font.js" type="text/javascript"></script>
<script type="text/javascript">Cufon.replace('#rightnav, h1, h2, h6');</script>

<script type="text/javascript" src="http://credit.frontlinesms.com/wp-content/themes/simplex/scripts/swfobject.js"></script>
<script type="text/javascript">
	var theatre_flashvars = {};

theatre_flashvars.b0_txt = "LEARN ABOUT US";
theatre_flashvars.b1_txt = "WATCH A VIDEO";
theatre_flashvars.b2_txt = "VISIT OUR BLOG";
theatre_flashvars.b3_txt = "MEET THE TEAM";
theatre_flashvars.b4_txt = "SUPPORT US";
theatre_flashvars.b0_url = "http://credit.frontlinesms.com/about-2/";
theatre_flashvars.b1_url = "http://credit.frontlinesms.com/about-2/";
theatre_flashvars.b2_url = "http://credit.frontlinesms.com/blog/";
theatre_flashvars.b3_url = "http://credit.frontlinesms.com/our-team/";
theatre_flashvars.b4_url = "http://credit.frontlinesms.com/donate/";
theatre_flashvars.s0_img = "http://credit.frontlinesms.com/wp-content/uploads/splash_04.jpg";
theatre_flashvars.s1_img = "http://credit.frontlinesms.com/wp-content/uploads/splash_03.jpg";
theatre_flashvars.s2_img = "http://credit.frontlinesms.com/wp-content/uploads/splash_02.jpg";
theatre_flashvars.s3_img = "http://credit.frontlinesms.com/wp-content/uploads/splash_01.jpg";
theatre_flashvars.s0_url = "http://credit.frontlinesms.com/about-2/";
theatre_flashvars.s1_url = "http://credit.frontlinesms.com/blog/2009/09/blog-post/";
theatre_flashvars.s2_url = "http://credit.frontlinesms.com/about-2/";
theatre_flashvars.s3_url = "http://credit.frontlinesms.com/blog/2009/10/leveraging-technology-for-microfinance/";
		
	var theatre_params = {};
	var theatre_attributes = {};
	theatre_attributes.id = "homepageTheatre";
	
	swfobject.embedSWF("http://credit.frontlinesms.com/wp-content/themes/simplex/scripts/homepage_theatre.swf", "alternateTheatre", "754", "451", "8.0.0", "expressInstall.swf", theatre_flashvars, theatre_params, theatre_attributes);
</script>


</head>
<body>
<div id="page">
<div id="header">
	<div id="headerimg">   
        <div id="searchdiv">
        </div>        
	</div>
    
</div>

<div id="pagemenu">
<ul id="page-list"  class="clearfix">
<li <?php if(is_home()){ echo 'class="page_item current_page_item"'; } else { echo 'class="page_item"'; } ?>>
<a href="<?php bloginfo('url') ?>" title="Home" >Home</a></li>
<?php wp_list_pages('exclude=2&title_li=' ); ?></ul>    
</div>
<hr />