<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');

$baseurl = JURI::base();
$blinklist = $params->get('blinklist');
$delicious = $params->get('delicious');
$digg = $params->get('digg');
$facebook = $params->get('facebook');
$furl = $params->get('furl');
$google = $params->get('google');
$magnolia = $params->get('magnolia');
$newsvine = $params->get('newsvine');
$reddit = $params->get('reddit');
$stumbleupon = $params->get('stumbleupon');
$technorati = $params->get('technorati');
$yahoo = $params->get('yahoo');
$tags 			= addslashes(str_replace("\n","", $mainframe->getCfg( 'MetaKeys' )));
$tags 			= trim($tags);
$tags_space		= str_replace(',', ' ', $tags);
$tags_semi 		= str_replace(',', ';', $tags);
$tags_space     = str_replace('  ', ' ', $tags_space);
$description    = addslashes($mainframe->getCfg( 'MetaDesc' ));

?>

<!-- Blinklist -->
<a rel="nofollow" style="text-decoration:none;<?php if ($blinklist==1) echo ("display:none;"); ?>" href="http://www.blinklist.com/" onclick="window.open('http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Description=<?php echo $description;?>&amp;Tag=<?php echo $tags;?>&amp;Url='+encodeURIComponent(location.href)+'&amp;Title='+encodeURIComponent(document.title));return false;" title="Add this page to Blinklist"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/blinklist.png";?>" alt="Add this page to Blinklist" name="Blinklist" border="0" id="Blinklist"/></a>

<!-- Delicious -->
<a rel="nofollow" style="text-decoration:none;<?php if ($delicious==1) echo ("display:none;"); ?>" href="http://del.icio.us/" onclick="window.open('http://del.icio.us/post?v=2&amp;url='+encodeURIComponent(location.href)+'&amp;notes=<?php echo $description;?>&amp;tags=<?php echo $tags_space;?>&amp;title='+encodeURIComponent(document.title)); return false;" title="Add this page to Del.icio.us"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/delicious.png";?>" alt="Add this page to Del.icoi.us" name="Delicious" border="0" id="Delicious"/></a>

<!-- Digg -->
<a rel="nofollow" style="text-decoration:none;<?php if ($digg==1) echo ("display:none;"); ?>" href="http://digg.com/" onclick="window.open('http://digg.com/submit?phase=2&amp;url='+encodeURIComponent(location.href)+'&amp;bodytext=<?php echo $description;?>&amp;tags=<?php echo $tags_space;?>&amp;title='+encodeURIComponent(document.title)); return false;" title="Add this page to Digg"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/digg.png";?>" alt="Add this page to Digg" name="Digg" border="0" id="Digg"/></a>

<!-- Facebook -->
<a rel="nofollow" style="text-decoration:none;<?php if ($facebook==1) echo ("display:none;"); ?>" href="http://www.facebook.com/" onclick="window.open('http://www.facebook.com/share.php?u='+encodeURIComponent(location.href)+'&amp;t='+encodeURIComponent(document.title)); return false;" title="Add this page to Facebook"><img class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/facebook.png";?>" alt="Add this page to Facebook" name="facebook" border="0" id="facebook"/></a>

<!-- Furl -->
<a rel="nofollow" style="text-decoration:none;<?php if ($furl==1) echo ("display:none;"); ?>" href="http://www.furl.net/" onclick="window.open('http://www.furl.net/storeIt.jsp?u='+encodeURIComponent(location.href)+'&amp;keywords=<?php echo $tags;?>&amp;t='+encodeURIComponent(document.title)); return false;" title="Add this page to Furl"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/furl.png";?>" alt="Add this page to Furl" name="Furl" border="0" id="Furl"/></a>

<!-- Google -->

<a rel="nofollow" style="text-decoration:none;<?php if ($google==1) echo ("display:none;"); ?>" href="http://www.google.com/" onclick="window.open('http://www.google.com/bookmarks/mark?op=add&amp;hl=en&amp;bkmk='+encodeURIComponent(location.href)+'&amp;annotation=<?php echo $description;?>&amp;labels=<?php echo $tags;?>&amp;title='+encodeURIComponent(document.title)); return false;" title="Add this page to Google"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/google.png";?>" alt="Add this page to Google" name="Google" border="0" id="Google"/></a>

<!-- Magnolia -->

<a rel="nofollow" style="text-decoration:none;<?php if ($magnolia==1) echo ("display:none;"); ?>" href="http://ma.gnolia.com/" onclick="window.open('http://ma.gnolia.com/bookmarklet/add?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title)+'&amp;description=<?php echo $description;?>&amp;tags=<?php echo $tags;?>'); return false;" title="Add this page to Ma.Gnolia"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/magnolia.png";?>" alt="Add this page to Ma.Gnolia" name="MaGnolia" border="0" id="MaGnolia"/></a>

<!-- Newsvine -->

<a rel="nofollow" style="text-decoration:none;<?php if ($newsvine==1) echo ("display:none;"); ?>" href="http://www.newsvine.com/" onclick="window.open('http://www.newsvine.com/_wine/save?popoff=1&amp;u='+encodeURIComponent(location.href)+'&amp;tags=<?php echo $tags?>&amp;blurb='+encodeURIComponent(document.title)); return false;" title="Add this page to Newsvine"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/newsvine.png";?>" alt="Add this page to Newsvine" name="Newsvine" border="0" id="Newsvine"/></a>

<!-- Reddit -->

<a rel="nofollow" style="text-decoration:none;<?php if ($reddit==1) echo ("display:none;"); ?>" href="http://reddit.com/" onclick="window.open('http://reddit.com/submit?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title)); return false;" title="Add this page to Reddit"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/reddit.png";?>" alt="Add this page to Reddit" name="Reddit" border="0" id="Reddit"/></a>

<!-- Stumbleupon -->

<a rel="nofollow" style="text-decoration:none;<?php if ($stumbleupon==1) echo ("display:none;"); ?>" href="http://www.stumbleupon.com/" onclick="window.open('http://www.stumbleupon.com/submit?url='+encodeURIComponent(location.href)+'&amp;newcomment=<?php echo $description;?>&amp;title='+encodeURIComponent(document.title)); return false;" title="Add this page to StumbleUpon"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/stumbleupon.png";?>" alt="Add this page to StumbleUpon" name="StumbleUpon" border="0" id="StumbleUpon"/></a>

<!-- Technorati -->

<a rel="nofollow" style="text-decoration:none;<?php if ($technorati==1) echo ("display:none;"); ?>" href="http://www.technorati.com/" onclick="window.open('http://technorati.com/faves?add='+encodeURIComponent(location.href)+'&amp;tag=<?php echo $tags_space?>'); return false;" title="Add this page to Technorati"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/technorati.png";?>" alt="Add this page to Technorati" name="Technorati" border="0" id="Technorati"/></a>

<!-- Yahoo -->

<a rel="nofollow" style="text-decoration:none;<?php if ($yahoo==1) echo ("display:none;"); ?>" href="http://www.yahoo.com/" onclick="window.open('http://myweb2.search.yahoo.com/myresults/bookmarklet?t='+encodeURIComponent(document.title)+'&amp;d=<?php echo $description;?>&amp;tag=<?php echo $tags?>&amp;u='+encodeURIComponent(location.href)); return false;" title="Add this page to Yahoo"><img style="padding-bottom:1px;" class="bookmarkimage" src="<?php echo $baseurl."modules/mod_socialbookmarking/images/yahoo.png";?>" alt="Add this page to Yahoo" name="Yahoo" border="0" id="Yahoo"/></a>