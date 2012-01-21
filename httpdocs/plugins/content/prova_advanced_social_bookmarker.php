<?php
/* Prova Advanced Social Bookmarker (with AddThis.com tracking)
* Created by Prova.com
* For support visit http://prova.com
* Development was started on Wed, 28th Oct 2009
*/

// Are we being run by Joomla?

defined('_JEXEC') or die ('Sorry - you do not have access to this');

// First steps first, tell Joomla! what we want to do with this plugin

$mainframe->registerEvent('onPrepareContent', 'bookmarker');

function bookmarker(&$article) {
	$pageType = $_GET['view']; // What type of page are we on?
	
	$plugin =& JPluginHelper::getPlugin('content', 'prova_advanced_social_bookmarker'); // Get plugin reference
	$pluginParams = new JParameter($plugin->params); // Put parameter reference to $pluginParams
	
	// Let's get all the configuration settings
	$configSection = $pluginParams->get('section_lists',''); // Display on Section pages?
	$configCategories = $pluginParams->get('cat_lists', ''); // Display on Category pages?
	$configIncCategories = $pluginParams->get('inc_cat', ''); // Display in these categories
    $configExcCategories = $pluginParams->get('exc_cat', ''); // Don't display in these categories
	$configPrecHtml = $pluginParams->get('bot_prec_html', ''); // Bottom preceeding HTML
	$configFolHtml = $pluginParams->get('bot_fol_html', ''); // Bottom following HTML
	$configAddThisUsername = $pluginParams->get('add_this_username', ''); // Add This Username
   	$configAddThisWord = $pluginParams->get('add_this_word', ''); // Add This Word Label
    $configButton1 = $pluginParams->get('badge1', ''); //Button
    $configButton2 = $pluginParams->get('badge2', ''); //Button
    $configButton3 = $pluginParams->get('badge3', ''); //Button
    $configButton4 = $pluginParams->get('badge4', ''); //Button
    $configButton5 = $pluginParams->get('badge5', ''); //Button
    $buttonarray = array("$configButton1","$configButton2","$configButton3","$configButton4","$configButton5");
    
                        $configDigg = $pluginParams->get('digg_big', ''); // Digg on top
                        $configTwitter = $pluginParams->get('twitter_big', ''); // Twitter on top
                        $configBuzz = $pluginParams->get('yahoo_big', ''); // Yahoo buzz on top
                        $configFB = $pluginParams->get('facebook_big', ''); // Yahoo buzz on top
        
    $configBadgeSide = $pluginParams->get('badge_side', ''); //What side the badges display on
	$configTwitName1 = str_replace('@','',$pluginParams->get('twitteruser1', '')); // Twitter username
    $configTwitName2 = str_replace('@','',$pluginParams->get('twitteruser2', '')); // Twitter username 2
    $configTwit2desc = str_replace('@','',$pluginParams->get('twitter2desc', '')); // Twitter username 2 description
    $configLeader = $pluginParams->get('leader', '');
    $configPill = $pluginParams->get('addthispill', '');// Leader icons
	// $ok is the variable that tells the script what to do later on
	// 1 means continue, 0 means stop

	if($pageType == 'section') {
		$ok = 0; // Don't display on a section page
	} else if ($pageType == 'category') {
		$ok = 0; // Don't display on a category page
	}
	// Now time to check, are we in the right categories?
	
	// Let's connect to the DB
	
	if($pageType == 'article') { // If we're on an article
        /* $db =& JFactory::getDBO(); // Grab the database reference object REMOVED 9/1/10
        
        $id = $article->id; // Get the id from the URL
        
        $query = "SELECT catid FROM #__content WHERE id=$id LIMIT 1"; // Select the category id from the jos_content table, where the content id = $id
        $db->setQuery($query); // Put the query to the database
        $catID = $db->loadResult(); // Load back the single result */
        
        /*$query = "SELECT title FROM #__categories WHERE id=$catID LIMIT 1"; // Select the title from the jos_categories table, where the category id is the result of the above query
        $db->setQuery($query); // Put query to the database
        $catTitle = $db->loadResult(); // Load the result
        */
        // Are we in the right categories?
        
        $catID = $article->catid;   //echo $catID . " IDIDIDID";
        
        //If the Show all but excluded list has data, then do this
        if($configExcCategories) {
            $arr_catid = explode(",",$configExcCategories); //1,3,10
            if(in_array($catID,$arr_catid)){
                $ok = 0;
            } else {
                $ok = 1;
                $big = 1;
            }
        } else {
            $arr_catid = explode(",",$configIncCategories); //Thanks Randolf.  2,4,8
            //if(strstr($configIncCategories, $catID))      //Thanks Randolf
            if(in_array($catID,$arr_catid)){
                // If the current category is within the allowed categories list, then OK
                $ok = 1; // Row along bottom to show
                $big = 1; // Big buttons on side (if enabled thru admin panel) to show
                } else {
                $big = 0; // nothing to show if we're not in the correct categories
            }
        }
	} // End the if('article') check
	
    $document =& JFactory::getDocument(); // Get the document handler, to add stylesheet definitions
    if($big == 1) {
        // Has the script returned $big to be 1? Should we display the big buttons on the right hand side?
        // Set the styling info for the badges into a variable
        if ($configBadgeSide == 'left') {
            $styledec = '.social_bookmarker_top { float:left;text-align:center;margin:10px 10px 10px 0; }';
        } else {
            $styledec = '.social_bookmarker_top { float:right;text-align:center;margin:10px 0 10px 10px; }';
        }
        
        //If showing a facebook badge, add more style declarations
        if(in_array("facebook",$buttonarray)){
            $styledec .= '.prova_fb_badge { margin:0 0 24px; width:52px; display:block; }';
            $styledec .= '.fb_share_count_wrapper { width:50px !important; }';
            $styledec .= '.FBConnectButton_Small .FBConnectButton_Text { margin-left:17px !important; padding:2px 3px 3px 2px !important; }';
            $styledec .= '.FBConnectButton .FBConnectButton_Text, .FBConnectButton_RTL .FBConnectButton_Text { font-weight:normal !important; }';
        }
        
        // And then add it to a style declaration through Joomla (more secure, and goes in <head> declaration)
        $document->addStyleDeclaration($styledec, 'text/css');

        // Decide which boxes are going to be added on the side
        $rightButtons = "<!-- Prova Advanced Social Bookmarker Plugin version 2.2 http://prova.com --> \n <div class=\"social_bookmarker_top\">";
        $articleTitle = $article->title; // Get the article's title and put it into a new variable
            
        // Get base URL
        $baseUrl = JURI::root();
        
        //Non standard links, just pull URL
        if ($baseUrl[strlen($baseUrl)-1] == '/') {
            $baseUrl = substr($baseUrl, 0, strlen($baseUrl) - 1); // Cut off a trailing slash, as the article base below will also have that info
        }
        
        // Get the artcile route through Joomla
        $link = $baseUrl . JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug, $article->sectionid));
       
        foreach($buttonarray as $badge) {

            Switch($badge) {
                case "digg":
                    $rightButtons .= showDigg();
                    break;
                case "facebook":
                    $rightButtons .= showFacebook();
                    break;
                case "google":
                    $rightButtons .= showGoogle();
                    break;
                case "topsy":
                    $rightButtons .= showTopsy($link, $article->title, $configTwitName1);
                    break;
                case "twitter":
                    $rightButtons .= showTwitter($configTwitName1, $configTwitName2, $configTwit2desc);
                    break;
                case "yahoo":
                    $rightButtons .= showYahoo($article);
                    break;
            }
        }
      
        // Close off the 'right side' class
        $rightButtons .= "</div>";
        
        // Set the article body to include the right hand side buttons, and then add in the article text
        $article->text = $rightButtons . $article->text;
            
    } // end $big if
    
    $extrastyle = '<style type="text/css">#at15s_brand a {color:#000000;}</style>';
	$document->addCustomTag($extrastyle);
	
	// Are we on the right type of page & in the right category?
	if($ok == 1) {
	// Grab the preference for which order the buttons should go in, and put it into an array
	$arrayLeader = explode(',', $configLeader);
	
    // Start the bottom section off with a line break & a solid line
    $textToAdd = "<br /><div style='margin-top:20px;'><hr>";
    
	// The variable $textToAdd will be added to the bottom of the article content. First we have the preference 'Preceeding HTML'
	$textToAdd .= $configPrecHtml;
	
	// Begin the styling for the button row // ************************************* ONLY TWEETS THE ARTICLE TITLE. not page title ************
    $textToAdd .= '<!-- AddThis Button BEGIN -->
                    <script type="text/javascript">
                        var addthis_config = {
                            "data_track_clickback":true,
                            ui_cobrand: "<a href=\"http://prova.com/advertising/tools/advanced-social-bookmarker\" target=\"_blank\">Advertising Tools</a>",
                            data_track_linkback: true
                        };
                    </script>
                    <div class="addthis_toolbox addthis_default_style">';
	
	// For each of the items in the 'Leader Button' array, create the link/icon
	foreach($arrayLeader as $key => $value) {
        $value = trim($value, ' '); // Remove the space from beginning/end
        $value = strtolower($value); // Convert the name to the lower case
        $fbaddend = ($value == 'facebook_like') ? 'fb:like:layout="button_count"' : '';
        $textToAdd .= '<a class="addthis_button_' . $value . '" '.$fbaddend.'></a>'; // Add the button to the array
	} // End the foreach
	
	
	// Finish off the code for the button row
    $legacyadd = '<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=' . $configAddThisUsername . '" class="addthis_button_compact">' . $configAddThisWord . '</a>';
    $pilladd = '<a class="addthis_counter addthis_pill_style"></a>';
    $textToAdd .= '&nbsp;<a style="float:left; padding:0 2px;" href="http://prova.com/advertising/tools/advanced-social-bookmarker" target="_blank"><img src="plugins/content/pbuttons/widget16.png" style="border:0;margin:0;" /></a>';
    $textToAdd .= ($configPill == 'pill') ? $pilladd : $legacyadd;
    $textToAdd .= '</div><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=' . $configAddThisUsername . '"></script>';

	$textToAdd .= $configFolHtml."</div>"; // Configuration 'Following HTML'
	
	// Add the whole thing to the bottom of the article text
	$article->text .= $textToAdd;

	} // end of $ok if
}

function showDigg(){
    $document =& JFactory::getDocument();
    $diggjs = "<script type='text/javascript'>
                (function() {
                var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'http://widgets.digg.com/buttons.js';
                s1.parentNode.insertBefore(s, s1);
                })();
                </script>";
    $document->addCustomTag($diggjs);
    return '<div style="margin-bottom:10px;"><a class="DiggThisButton DiggMedium"></a><div style="clear:both"></div></div>';
}

function showFacebook(){
    return "<div style='margin-bottom: 10px; width: 50px; margin-left: auto; margin-right: auto;'><a name='fb_share' type='box_count' href='http://www.facebook.com/sharer.php'>Share</a><script src='http://static.ak.fbcdn.net/connect.php/js/FB.Share' type='text/javascript'></script><div class='clear'></div></div>";
}

function showGoogle() {
    return '<div style="margin-bottom:10px;"><a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="normal-count"></a><script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script></div>';
}

function showTopsy($url, $title, $username){
    $document =& JFactory::getDocument();
    $topsyjs = '<script type="text/javascript" src="http://cdn.topsy.com/topsy.js?init=topsyWidgetCreator"></script>';
    $document->addCustomTag($topsyjs);
    return '<div style="margin-bottom:10px;width:50px;margin-left:auto;margin-right:auto;"><div class="topsy_widget_data"><script type="text/javascript">topsyWidgetPreload({ "url": "'.$url.'", "title": "'.$title.'", "style": "big", "nick": "'.$username.'" });</script></div></div>';
}

function showTwitter($twitname1, $twitname2, $twit2desc){
    if($twitname1) { $twit1add = 'data-via="'.$twitname1.'" ';}
    if($twit2desc) { $twit2descadd = ":".$twit2desc;}
    if($twitname2) { $twit2add = 'data-related="'.$twitname2.$twit2descadd.'" ';}
    return '<div style="margin-bottom:10px;"><a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical" '.$twit1add.$twit2add.'>Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';
}

function showYahoo($article){
    return '<div style="margin-bottom:10px;width:51px;margin-left:auto;margin-right:auto;"><script type="text/javascript" src="http://d.yimg.com/ds/badge2.js" badgetype="square">ARTICLEURL</script></div>';
}