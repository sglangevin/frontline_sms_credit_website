<?php
/**
*
* @package SocialList
* @copyright (C)2008 Vadim Tropnikov
* @license GNU/GPL
* http://sociallist.org/
*
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$mainframe->registerEvent( 'onPrepareContent', 'plgSocialList' );

function plgSocialList( &$row, &$params, $page=0 ) {
	
	$plugin =& JPluginHelper::getPlugin('content', 'sociallist');
	$botParams = new JParameter( $plugin->params );
	
	$print   = JRequest::getBool('print');
	$showall = JRequest::getBool('showall');
	
	//die ("z" . $showall);
		
	$lang = $botParams->def( 'lang', 'en' );
	$cols = $botParams->def( 'cols', '3' );
	$rows = $botParams->def( 'rows', '5' );
	$button_dx = $botParams->def( 'button_dx', '160' );
	$button_dy = $botParams->def( 'button_dy', '24' );
	
	$staticcontent = $botParams->def( 'staticcontent', 'all' );
	$homedisplay = $botParams->def( 'homedisplay', 'bottomleft' );
	$contentdisplay = $botParams->def( 'contentdisplay', 'bottomleft' );
	
	$excludecategories = $botParams->def( 'excludecategories', ' ' );
	$manualurl = $botParams->def( 'manualurl', 'no' );
	$currenturl = $botParams->def( 'currenturl', 'no' );
	$bookmarktext = $botParams->def( 'bookmarktext', '' );
	$removebaseurl = $botParams->def( 'removebaseurl', 'no' );
	
	// Check if this content item is in an excluded category
	$excluded = explode (",", $excludecategories);
	$goodtogo = true;
	foreach ($excluded as $ex) {
		//echo($ex);
		if ($row->catid == $ex) {
			$goodtogo = false;
		}
	}
	
	// ((If current page is the full content item unless desired on homepage) and ((if not static content and not only static content desired) or (if static content and only static content not desired)))
	if ((@$_GET['task'] == 'view' || ($partialdisplay != "none") && ($currenturl == 'no')) && $goodtogo && ((($row->catid != 0) && ($staticcontent != "static")) || (($row->catid == 0) && ($staticcontent != "content")))) {
		$temphtml = '';
		$tophtml = '';
		$bottomhtml = '';
		
		if ($manualurl == 'yes' && preg_match('#{sociallist}(.*?){/sociallist}#s', $row->text, $matches, PREG_OFFSET_CAPTURE)) {
			// Get $thisurl
			$pos1 = stripos($matches[0][0], 'sburl=&quot;') + 12;
			$pos2 = stripos($matches[0][0], '&quot;', $pos1);
			$thisurl = substr($matches[0][0], $pos1, $pos2 - $pos1);				
			// Get $thistitle
			if (preg_match('#sbtitle=#s', $matches[0][0])) {
				$pos1 = stripos($matches[0][0], 'sbtitle=&quot;') + 14;
				$pos2 = stripos($matches[0][0], '&quot;', $pos1);
				$thistitle = substr($matches[0][0], $pos1, $pos2 - $pos1);
			} else {
				$thistitle = $row->title;
			}

		} else {
			$thistitle = $row->title;
		}

		$uri    = JURI::getInstance();
		$prefix = $uri->toString(array('scheme', 'host', 'port'));
		$thisurl = $prefix . JRoute::_(ContentHelperRoute::getArticleRoute($row->id, $row->catid));
		
		$uid = substr (md5 (mt_rand (1,1000000000)), 0, 8);
		
		$thisurl = addslashes ($thisurl);
		$thistitle = addslashes ($thistitle);
		
		$widgethtml = '<!-- SocialList.org BEGIN -->
<script type="text/javascript">
sociallist_'.$uid.'_url = \''.$thisurl.'\';
sociallist_'.$uid.'_title = \''.$thistitle.'\';
sociallist_'.$uid.'_text = \'\';
sociallist_'.$uid.'_tags = \'\';
</script><script type="text/javascript" src="http://sociallist.org/widget.js?type=1&cols='.$cols.'&rows='.$rows.'&button_dx='.$button_dx.'&button_dy='.$button_dy.'&lang='.$lang.'&uid='.$uid.'"></script>
<noscript>
<a href="http://sociallist.org/submit.php?type=1'.
'&lang=' . $lang .
'&url=' . urlencode ($thisurl) . 
'&title=' . urlencode ($thistitle) . 
'" target="_blank" title="Bookmark this Website"><img src="http://sociallist.org//buttons/' . 
$lang . $button_dx . 'x' . $button_dy . '.gif" border="0" width="' . $button_dx . '" height="' . $button_dy .
'" alt="Bookmark" /></a>
</noscript>
<!-- SocialList.org END -->';

		if (@$_GET['view'] == 'article') {
			$displayOption = $contentdisplay;
			
		} else {
			$displayOption = $homedisplay;
			
		}
		
		if (strstr ($displayOption, "top")) {
		
			if (strstr ($displayOption, "left")) {
				$verticalfloat = "left";
				$verticalmargin = "right";
				
			} else if (strstr ($displayOption, "left")) {
				$verticalfloat = "right";
				$verticalmargin = "left";
			}
			
			$row->text = '<div style="float:'. $verticalfloat .'; margin-'. $verticalmargin .': 10px; padding-bottom: 10px; text-align: right;">'. $widgethtml .'</div>'. $row->text;
		}
		
		if (strstr ($displayOption, "bottom")) {
		
			if (strstr ($displayOption, "left")) {
				$horizontalalign = "left";
				
			} else if (strstr ($displayOption, "center")) {
				$horizontalalign = "center";
				
			} else if (strstr ($displayOption, "right")) {
				$horizontalalign = "right";
			}
		
			$row->text = $row->text .'<div style="clear:both; text-align: '. $horizontalalign .'"><br />'. $bookmarktext .'<br />'. $widgethtml .'</div>';
		}
	}

	// Remove code from HTML
	$row->text = preg_replace('#{sociallist}(.*?){/sociallist}#s', '', $row->text);
	
	return true;
}
?>