<?php
/**
* Trendy Social Share - Joomla Plugin
* Version			: 1.1
* Created by		: RBO Team > Project::: RumahBelanja.com, Demo::: MedicRoom.com
* Created on		: v1.0 - December 19th, 2010
* Updated			: v1.1 - January 4th, 2011
* Package			: Joomla 1.5.x
* License			: http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

defined( '_JEXEC' ) or  die('Restricted access');
jimport( 'joomla.event.plugin' );
require_once JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php';
$mainframe->registerEvent('onPrepareContent', 'plgContentTrendySocialShare');	

function plgContentTrendySocialShare(&$article, &$params, $page=0) {
	
	global $mainframe;
	
	//Get url
	if(JRequest::getVar('view','')=='article') $url = "http://".$_SERVER['HTTP_HOST'] . getenv('REQUEST_URI'); 
	else {
		if(isset($article->id)) $url = "http://".$_SERVER['HTTP_HOST'].JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug, $article->sectionid));
		else return;
		}		
	//$url_view = urlencode($url);
	$url_view = $url;
	
	// Get Plugin info
	//$doc 		= & JFactory::getDocument();
	$plugin	 	=& JPluginHelper::getPlugin('content', 'trendysocialshare');
	$param		= new JParameter( $plugin->params );
	
	//Get Params
	$global_style 	= $param->get('global_style');
	$ltr_rtl	 	= $param->get('ltr_rtl');
	$tweetuser		= $param->get('tweetuser');
	
	if ($ltr_rtl==0) { $float_def="left";} else { $float_def="right"; }

		//Languange Helper
	$tweetlang 	= JText::_('en');
	$buzzlang 	= JText::_('Post To Google Buzz');
	
	//SOCIAL BUTTONS CONTROL SYSTEM
	//Tweeter CONTROL System
	switch ($param->get( 'tweetbuttonstyle' )) {
				case 1:
					$tweetstyle = "horizontal";
				break;

				case 2:
					$tweetstyle = "none";
				break;

				case 0:
				default:
					$tweetstyle  = "vertical";
				break;
				}	

	switch ($tweetlang) {
				case 'fr':
					$tweettext  = "Tweeter";
				break;

				case 'de':
					$tweettext  = "Twittern";
				break;
				
				case 'es':
					$tweettext  = "Twittear";
				break;
				
				case 'ja':
					$tweettext  = "Tweet";
				break;

				case 'en':
				default:
					$tweettext  = "Tweet";
				break;
				}
	
	if (($param->get( 'get_tweet')) == 0) {
		$tweet_base="<div class=\"socialshare_tweet\"><a href=\"http://twitter.com/share?url=".$url_view."\" class=\"twitter-share-button\" data-text=\"".$article->title."\" data-count=\"".$tweetstyle."\" data-via=\"".$tweetuser."\" data-lang=\"".$tweetlang."\">".$tweettext."</a><script type=\"text/javascript\" src=\"http://platform.twitter.com/widgets.js\"></script></div>";
	}

	//Facebook CONTROL System
	switch ($param->get( 'fb_layout' )) {
				case 1:
					$fblayout = "button_count";
					$fb_width = 90;
					$fb_height= 20;
				break;

				case 2:
					$fblayout = "box_count";
					$fb_width = 55;
					$fb_height= 65;
				break;

				case 0:
				default:
					$fblayout = "standard";
					
					if (($param->get( 'fb_showface')) == 0){
						$fb_width 	= 450;	
						$fb_height	= 80;
						$fbshowface	= "true";
					} else { 
						$fb_width 	= 450;	
						$fb_height	= 35;
						$fbshowface = "false";
					}
				break;
				}


	switch ($param->get( 'fb_action' )) {
				case 1:
					$fbaction = "recommend";
				break;

				case 0:
				default:
					$fbaction = "like";
				break;
				}

	switch ($param->get( 'fb_fontbutton' )) {
				case 5:
					$fbfontbutton = "verdana";
				break;
				
				case 4:
					$fbfontbutton = "trebuchet ms";
				break;
				
				case 3:
					$fbfontbutton = "tahoma";
				break;
				
				case 2:
					$fbfontbutton = "segoe ui";
				break;
				
				case 1:
					$fbfontbutton = "lucida grande";
				break;

				case 0:
				default:
					$fbfontbutton = "arial";
				break;
				}

	switch ($param->get( 'fb_colorscheme' )) {
				case 1:
					$fbcolorscheme = "dark";
				break;

				case 0:
				default:
					$fbcolorscheme = "light";
				break;
				}
	
	if (($param->get( 'get_facebook')) == 0) {
		$facebook_base="<div class=\"socialshare_fb\"><iframe src=\"http://www.facebook.com/plugins/like.php?href=".$url_view."&amp;layout=$fblayout&amp;show_faces=$fbshowface&amp;width=".$fb_width."&amp;action=".$fbaction."&amp;font=".$fbfontbutton."&amp;colorscheme=".$fbcolorscheme."&amp;height=".$fb_height."\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:".$fb_width."px; height:".$fb_height."px;\" allowTransparency=\"true\"></iframe></div>";
	}
	
	//Google Buzz CONTROL System
	switch ($param->get( 'gbuzz_style' )) {
				case 4:
					$gbuzzstyle = "link";
				break;
				
				case 3:
					$gbuzzstyle = "small-button";
				break;
				
				case 2:
					$gbuzzstyle = "normal-button";
				break;
				
				case 1:
					$gbuzzstyle = "small-count";
				break;

				case 0:
				default:
					$gbuzzstyle = "normal-count";
				break;
				}
	
	if (($param->get( 'get_gbuzz')) == 0) {
		$gbuzz_base="<div class=\"socialshare_gbuzz\"><a =\"nofollow\" title=\"".$buzzlang."\" class=\"google-buzz-button\" href=\"http://www.google.com/buzz/post\" data-button-style=\"".$gbuzzstyle."\" data-url=\"".$url_view."\" ></a><script type=\"text/javascript\" src=\"http://www.google.com/buzz/api/button.js\"></script></div>";
	}
	
	//Yahoo Buzz CONTROL System
	switch ($param->get( 'ybuzz_style' )) {
				case 9:
					$ybuzzstyle = "large";
				break;
				
				case 8:
					$ybuzzstyle = "medium";
				break;
				
				case 7:
				default:
					$ybuzzstyle = "small";
				break;
				
				case 6:
					$ybuzzstyle = "text";
				break;
				
				case 5:
					$ybuzzstyle = "logo";
				break;
				
				case 4:
					$ybuzzstyle = "large-votes";
				break;
				
				case 3:
					$ybuzzstyle = "medium-votes";
				break;
				
				case 2:
					$ybuzzstyle = "small-votes";
				break;
				
				case 1:
					$ybuzzstyle = "text-votes";
				break;

				case 0:
					$ybuzzstyle = "square";
				break;
				}
	
	if (($param->get( 'get_ybuzz')) == 0) {
		$ybuzz_base="<div class=\"socialshare_ybuzz\"><script type=\"text/javascript\">yahooBuzzArticleHeadline = \"".$article->title."\"; yahooBuzzArticleSummary = \"".$article->text."\";</script><script type=\"text/javascript\" src=\"http://d.yimg.com/ds/badge2.js\" badgetype=\"".$ybuzzstyle."\">".$url_view."</script></div>";
	}
	
	//Digg CONTROL System
	switch ($param->get( 'digg_style' )) {
				case 3:
					$diggstyle = "DiggThisButton DiggIcon";
				break;
				
				case 2:
					$diggstyle = "DiggThisButton DiggWide";
				break;
				
				case 1:
					$diggstyle = "DiggThisButton DiggMedium";
				break;

				case 0:
				default:
					$diggstyle = "DiggThisButton DiggCompact";
				break;
				}
		
	if (($param->get( 'get_digg')) == 0) {
		$digg_base="<div class=\"socialshare_digg\"><script type=\"text/javascript\"> (function() { var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0]; s.type = 'text/javascript'; s.async = true; s.src = 'http://widgets.digg.com/buttons.js'; s1.parentNode.insertBefore(s, s1); })();</script><a rel=\"nofollow\" class=\"".$diggstyle."\" href=\"http://digg.com/submit?url=".$url_view."&amp;title=".$article->title."\"></a></div>";
	}
	//END SOCIAL BUTTONS CONTROL SYSTEM
	
	//CSS STYLE for button position
	?>
	<link rel="stylesheet" href="<?php echo $baseurl; ?>plugins/content/trendysocialshare/css/style.css" />
	<style type="text/css">	
	div.socialshare_tweet,
	div.socialshare_fb,
	div.socialshare_gbuzz,
	div.socialshare_ybuzz,
	div.socialshare_digg{
		float:<?php echo $float_def; ?>;
	}
	</style>
	<?php		
	
	//Special CSS STYLE for digg compact button
	if (($param->get( 'digg_style')) == 0) { ?>	
		<style type="text/css">	
			.db-wrapper .db-compact { width:85px;}
		</style>
	<?php }
	
	$displaybuttons = $tweet_base . $digg_base . $ybuzz_base . $gbuzz_base . $facebook_base;
	if(!$param->get('whereview')&&JRequest::getVar('view','')!='article') return;
	
	//Display The Plugin	
	if($global_style==0) { 	
		$article->text =  $article->text.'<div class="trendysocialshare">'.$displaybuttons.'<div style="clear:both;"></div></div>';
	} else if($global_style==1) {
		$article->text =  '<div class="trendysocialshare">'.$displaybuttons.'<div style="clear:both;"></div></div>'.$article->text.'';
	} else {
		$article->text =  '<div class="trendysocialshare">'.$displaybuttons.'<div style="clear:both;"></div></div>'.$article->text.'<div class="trendysocialshare" style="margin-top:15px;">'.$displaybuttons.'<div style="clear:both;"></div></div>';
	}

}
?>