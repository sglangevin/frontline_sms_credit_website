<?php
/**
 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

include_once (dirname(__FILE__).DS.'/ja_vars.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">

<head>
<title>FrontlineSMS:Credit</title>
<jdoc:include type="head" />
<?php JHTML::_('behavior.mootools'); ?>
<link href="css/template.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->baseurl(); ?>templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->baseurl(); ?>templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/template.css" type="text/css" />

<script language="javascript" type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/ja.script.js"></script>

<?php if ($tmpTools->getParam('rightCollapsible')): ?>
<script language="javascript" type="text/javascript">
var rightCollapseDefault='<?php echo $tmpTools->getParam('rightCollapseDefault'); ?>';
var excludeModules='<?php echo $tmpTools->getParam('excludeModules'); ?>';
</script>
<script language="javascript" type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/ja.rightcol.js"></script>
<?php endif; ?>

<?php  if($this->direction == 'rtl') : ?>
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/template_rtl.css" type="text/css" />
<link  rel='stylesheet' href='<?php echo $tmpTools->templateurl(); ?>http://fonts.googleapis.com/css?family=PT+Sans' type='text/css'>
<?php else : ?>
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/menu.css" type="text/css" />
<?php endif; ?>

<?php if ($this->countModules('hornav')): ?>
<?php if ($tmpTools->getParam('horNavType') == 'css'): ?>
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/ja-sosdmenu.css" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/ja.cssmenu.js"></script>
<?php else: ?>
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/css/ja-sosdmenu.css" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo $tmpTools->templateurl(); ?>/js/ja.moomenu.js"></script>
<?php endif; ?>
<?php endif; ?>

<?php if ($tmpTools->getParam('theme_header') && $tmpTools->getParam('theme_header')!='-1') : ?>
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/styles/header/<?php echo $tmpTools->getParam('theme_header'); ?>/style.css" type="text/css" />
<?php endif; ?>
<?php if ($tmpTools->getParam('theme_background') && $tmpTools->getParam('theme_background')!='-1') : ?>
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/styles/background/<?php echo $tmpTools->getParam('theme_background'); ?>/style.css" type="text/css" />
<?php endif; ?>
<?php if ($tmpTools->getParam('theme_elements') && $tmpTools->getParam('theme_elements')!='-1') : ?>
<link rel="stylesheet" href="<?php echo $tmpTools->templateurl(); ?>/styles/elements/<?php echo $tmpTools->getParam('theme_elements'); ?>/style.css" type="text/css" />
<?php endif; ?>

<!--[if gte IE 7.0]>
<style type="text/css">
.clearfix {display: inline-block;}
</style>
<![endif]-->
<?php if ($tmpTools->isIE6()): ?>
<!--[if lte IE 6]>
<script type="text/javascript">
var siteurl = '<?php echo $tmpTools->

baseurl();?>';

window.addEvent ('load', makeTransBG);
function makeTransBG() {
	fixIEPNG($E('.ja-headermask'), '', '', 1);
	fixIEPNG($E('h1.logo a'));
	fixIEPNG($$('img'));
	fixIEPNG ($$('#ja-mainnav ul.menu li ul'), '', 'scale', 0, 2);
}
</script>
<style type="text/css">
.ja-headermask, h1.logo a, #ja-cssmenu li ul { background-position: -1000px; }
#ja-cssmenu li ul li, #ja-cssmenu li a { background:transparent url(<?php echo $tmpTools->templateurl(); ?>/images/blank.png) no-repeat right;}
.clearfix {height: 1%;}
</style>
<![endif]-->
<?php endif; ?>

<style type="text/css">
#ja-header,#ja-mainnav,#ja-container,#ja-botsl,#ja-footer {width: <?php echo $tmpWidth; ?>;margin: 0 auto;}
#ja-wrapper {min-width: <?php echo $tmpWrapMin; ?>;}
</style>

<script type="text/javascript"src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher:'6ba9f8c5-6ff2-422a-a2e7-0bcb7b33d004'});</script>
</head>

<body id="bd" class="fs<?php echo $tmpTools->getParam(JA_TOOL_FONT);?> <?php echo $tmpTools->browser();?>" >
<div id="header-wrapper">
	<div id="header">
		<div id="logo">
		<a href="<?php echo $tmpTools->baseurl(); ?>">
			<jdoc:include type="modules" name="logo" style="xhtml" />
		</a>
		</div>
		<div id="nav-social">
			<div id="social"><jdoc:include type="modules" name="social" style="xhtml" /></div>
			<div id="navigation"><jdoc:include type="modules" name="nav" style="xhtml" /></div>
		</div>
	</div>
</div>
<div id="wrapper">
	<?php 
			$option = JRequest::getVar('option');
			$itemid = JRequest::getVar('Itemid');
			$view = JRequest::getVar('view');
			//get user object
			$user = & JFactory::getUser();
			
		 	?>
			<?php if($tmpTools->isFrontPage()){ ?>
				<div id="newsletter-home">
				<jdoc:include type="modules" name="newsletter" style="xhtml" />
				</div>
				<div id="banner">
					<h3 class="main"><div class="front"></div></h3>
					<jdoc:include type="modules" name="banner" style="xhtml" />
				</div>
				<div id="content-home">
					<h3 class="main">SOFTWARE SPECIFICATIONS</h3>
                                        <h6 class="main">SIMPLE, FLEXIBLE, INTEROPERABLE</h6>
					<jdoc:include type="modules" name="home-mods" style="xhtml" />
				</div>
                <?php } else {
			 if($option=='com_blog')
				{
				?>
                
                <div id="newsletter">
					<jdoc:include type="modules" name="newsletter" style="xhtml" />
					<jdoc:include type="modules" name="breadcrumb" style="xhtml" />
				</div>
				<div id="content-inside">
					<div id="left-side" class="blogside"><jdoc:include type="modules" name="blog" style="xhtml" /></div>
					<div id="right-side"><jdoc:include type="component" />
                    <jdoc:include type="modules" name="right" style="xhtml" />
                    <jdoc:include type="modules" name="blogicons" style="xhtml" />
                    </div>
				</div>
				 <?php } else {
			 if($itemid=='3')
				{
				?>
				<div id="newsletter">
					<jdoc:include type="modules" name="newsletter" style="xhtml" />
					<jdoc:include type="modules" name="breadcrumb" style="xhtml" />
				</div>
				<div id="content-inside">
					<div id="left-side"><jdoc:include type="modules" name="left-soft" style="xhtml" /></div>
					<div id="right-side"><div id="mainRight"><jdoc:include type="component" /></div>
                    <jdoc:include type="modules" name="right" style="xhtml" />
                    </div>
				</div>
				
	<?php
		 }
		 else
		 {
		  ?>	
		  		<div id="newsletter">
					<jdoc:include type="modules" name="newsletter" style="xhtml" />
					<jdoc:include type="modules" name="breadcrumb" style="xhtml" />
				</div>
				<div id="content-inside">
					<div id="left-side"><jdoc:include type="modules" name="left" style="xhtml" /></div>
					<div id="right-side"><div id="mainRight"><jdoc:include type="component" /></div>
                    <jdoc:include type="modules" name="right" style="xhtml" />
                    </div>
				</div>
		<?php 
			}
		}
		}
		?> 
	<div id="footer"><jdoc:include type="modules" name="nav" style="xhtml" /></div>
</div>
<jdoc:include type="modules" name="debug" />

</body>

</html>