<?php
/**
 * FenerskSoci Social Bookmarking Plugin.
 * @package Joomla 1.5
 * @copyright (C) 2010 by Fenersk.com. All rights reserved.
 * @license GNU/GPL
 * @link http://www.fenersk.com
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgContentFenersksoci extends JPlugin {

    function __construct(&$subject, $params) {
        parent::__construct($subject, $params);
    }
    function onAfterDisplayContent(&$article, &$params, $limitstart) {
        $plugin = JPluginHelper::getPlugin('content', 'fenersksoci');
        $myParams = new JParameter($plugin -> params);
        return $myParams -> get('placement') == 'afterDisplayContent'
            ? $this -> _generateHtml($article, $myParams) : '';
    }

    function onBeforeDisplayContent(&$article, &$params, $limitstart) {
        $plugin = JPluginHelper::getPlugin('content', 'fenersksoci');
        $myParams = new JParameter($plugin -> params);
        return $myParams -> get('placement') == 'beforeDisplayContent'
            ? $this -> _generateHtml($article, $myParams) : '';
    }
    function _generateHtml(&$article, $myParams) {
        $html = '';
        if (JFactory::getApplication() -> scope != 'com_content') {
            return $html;
        }

        JPlugin::loadLanguage ( 'plg_content_fenersksoci', JPATH_ADMINISTRATOR );
        $document = JFactory::getDocument();
        $view = JRequest::getCmd('view');
    
        if (
            !(
                $view == 'article'
                || ($myParams -> get('frontpage', true) && $view == 'frontpage')
                || ($myParams -> get('section', true) && $view == 'section')
                || ($myParams -> get('category', true) && $view == 'category')
            )
        ) {
            return $html;
        }

        $sectionIDList = array();
        $sectionMode = '';
        foreach (explode(',', $myParams -> get('sectionIDList', '')) as $num) {
            if (is_numeric($num)) {
                if ($sectionMode == '') {
                    if ($num[0] == '-') {
                        $sectionMode = '-';
                    } else {
                        $sectionMode = '+';
                    }
                }
                if ($num[0] == '-') {
                    $sectionIDList[] = -1 * (int) $num;
                } else {
                    $sectionIDList[] = (int) $num;
                }
            }
        }
        if (
            $sectionMode
            && (in_array($article -> sectionid, $sectionIDList) != ($sectionMode == '+'))
        ) {
            return $html;
        }
        $categoryIDList = array();
        $categoryMode = '';
        foreach (explode(',', $myParams -> get('categoryIDList', '')) as $num) {
            if (is_numeric($num)) {
                if ($categoryMode == '') {
                    if ($num[0] == '-') {
                        $categoryMode = '-';
                    } else {
                        $categoryMode = '+';
                    }
                }
                if ($num[0] == '-') {
                    $categoryIDList[] = -1 * (int) $num;
                } else {
                    $categoryIDList[] = (int) $num;
                }
            }
        }
        if (
            $categoryMode
            && (in_array($article -> catid, $categoryIDList) != ($categoryMode == '+'))
        ) {
            return $html;
        }
        $articleIDList = array();
        $articleMode = '';
        foreach (explode(',', $myParams -> get('articleIDList', '')) as $num) {
            if (is_numeric($num)) {
                if ($articleMode == '') {
                    if ($num[0] == '-') {
                        $articleMode = '-';
                    } else {
                        $articleMode = '+';
                    }
                }
                if ($num[0] == '-') {
                    $articleIDList[] = -1 * (int) $num;
                } else {
                    $articleIDList[] = (int) $num;
                }
            }
        }
        if (
            $articleMode
            && (in_array($article -> id, $articleIDList) != ($articleMode == '+'))
        ) {
            return $html;
        }
        
        if ($view != 'article') {
            if ($article -> access > JFactory::getUser() -> get('aid')) {
                return $html;
            }
            $uri = JURI::getInstance(JURI::base());
            $shareUrl = $uri -> toString(array('scheme', 'host', 'port'))
                . JRoute::_(
                    ContentHelperRoute::getArticleRoute(
                        $article -> slug, $article -> catslug, $article -> sectionid
                    )
                );
            $shareTitle = $article -> title;
        } 
        if ($myParams -> get('useFenerskSoci', '')) {
			$document->addStyleSheet(JURI::base()."plugins/content/fenersksoci/styles.css");
			$url 				=& JFactory::getURI();
			$perms 				= $url->toString();
			$perms 				= str_replace( '&amp;', '&', $perms );
			// Title
			$title 				= urlencode($article -> title);
			$title 				= str_replace('%3A',':',$title);
			$title 				= str_replace('%3F','?',$title);
			// Tags
			$tags 				= str_replace("\n","", $article -> title);
			$tags 				= trim($tags);
			$tags_space			= str_replace(',', ' ', $tags);
			$tags_semi 			= str_replace(',', ';', $tags);
			$tags_space 		= str_replace('  ', ' ', $tags_space);
			// Description
			$description1    	= strip_tags($article -> introtext );
			$description2    	= str_replace("'", '', strip_tags($description1));
			$description    	= str_replace('"', '', strip_tags($description2));
			$introdesc 			= mb_substr($description,0,300, 'UTF-8').'...';
			// Plugin Manager
            $paylastext 		= $myParams -> get('TextPaylas', '');
			$paylastextcolor 	= $myParams -> get('TextPaylasColor', '00008b');
			$border 			= $myParams -> get('StyleBorder', '1px');
			$pluginwidth		= $myParams -> get('PluginWidth', '468px');
			$bordercolor 		= $myParams -> get('StyleBorderColor', 'dcdcdc');
			$backgroundcolor 	= $myParams -> get('BackgroundColor', 'e0ffff');
			$paylasimagesize 	= $myParams -> get('ImageSize', '24x24');
			
			$html .= '<div><!-- Start Fenersk.com Social -->' . chr(10)
			
                . '<div class="fenersksocial" style="background-color: #'.$backgroundcolor.'; text-align: right; margin: 0; padding-top: 4px; padding-bottom: 0; width: '.$pluginwidth.'; border: solid '.$border.' #'.$bordercolor.'"><div class="paylas" style="color: #'.$paylastextcolor.'">'.$paylastext.'</div><ul>' . chr(10);

		if ($myParams -> get('useLive', '')) {			
			$html .= '<li><a href="https://favorites.live.com/quickadd.aspx?marklet=1&amp;url='.$perms.'&amp;title='.$title.'" title="Windows Live" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/live.png" alt="Windows Live"></a></li>';
			}			
		if ($myParams -> get('useNewsvine', '')) {			
			$html .= '<li><a href="http://www.newsvine.com/_tools/seed&save?u='.$perms.'&amp;h='.$title.'&amp;tags='.$tags.'" title="Newsvine" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/newsvine.png" alt="Newsvine"></a></li>';
			}
		if ($myParams -> get('useMisterwong', '')) {			
			$html .= '<li><a href="http://www.mister-wong.com/addurl/?bm_url='.$perms.'&amp;bm_description='.$title.'+-+'.$introdesc.'" title="Mister Wong" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/misterwong.png" alt="Mister Wong"></a></li>';
			}
		if ($myParams -> get('useDelicios', '')) {			
			$html .= '<li><a href="http://del.icio.us/post?url='.$perms.'&amp;title='.$title.'&amp;tags='.$tags.'&amp;notes='.$introdesc.'" title="Delicios" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/delicious.png" alt="del.icio.us"></a></li>';
			}
		if ($myParams -> get('useMySpace', '')) {		
			$html .= '<li><a href="http://www.myspace.com/Modules/PostTo/Pages/?l=2&u='.$perms.'&amp;t='.$title.'&amp;c='.$introdesc.'" title="MySpace" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/myspace.png" alt="MySpace"></a></li>';
			}
		if ($myParams -> get('useDigg', '')) {	
			$html .= '<li><a href="http://digg.com/submit?phase=2&amp;url='.$perms.'&amp;title='.$title.'&amp;bodytext='.$introdesc.'&amp;tags='.$tags.'" title="Digg" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/digg.png" alt="digg"></a></li>';
			}
		if ($myParams -> get('useGoogle', '')) {	
			$html .= '<li><a href="http://www.google.com/bookmarks/mark?op=add&amp;hl=tr&amp;bkmk='.$perms.'&amp;title='.$title.'&amp;annotation='.$introdesc.'&amp;labels='.$tags.'" title="Google Bookmark" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/google.png" alt="Google"></a></li>';
			}
		if ($myParams -> get('useYahoo', '')) {	
			$html .= '<li><a href="http://myweb2.search.yahoo.com/myresults/bookmarklet?t='.$title.'&amp;u='.$perms.'&amp;d='.$introdesc.'&amp;tag='.$tags.'" title="Yahoo Bookmark" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/yahoo.png" alt="Yahoo"></a></li>';
			}
		if ($myParams -> get('useReddit', '')) {	
			$html .= '<li><a href="http://reddit.com/submit?url='.$perms.'&amp;title='.$title.'" title="Reddit" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/reddit.png" alt="Reddit"></a></li>';
			}
		if ($myParams -> get('useFacebook', '')) {	
			$html .= '<li><a href="http://www.facebook.com/sharer.php?u='.$perms.'&amp;t='.$title.'&amp;d='.$introdesc.'" title="Facebook" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/facebook.png" alt="Facebook"></a></li>';
			}
		if ($myParams -> get('useTwitter', '')) {	
			$html .= '<li><a href="http://twitter.com/home?status='.$title.'...+'.$perms.'" title="Twitter" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/twitter.png" alt="Twitter"></a></li>';
			}
		if ($myParams -> get('useGoogleBuzz', '')) {	
			$html .= '<li><a href="http://www.google.com/reader/link?url='.$perms.'&amp;title='.$title.'&amp;snippet='.$introdesc.'&amp;srcTitle=FenerSK" title="Google Buzz" target="_new"><img src="plugins/content/fenersksoci/'.$paylasimagesize.'/google-buzz.png" alt="GoogleBuzz"></a></li>';
			}	
			$html .= '</ul></div>' . chr(10)
                . '<!-- End Fenersk.com Social -->' . chr(10)
                . '</div>'
                ;
        }

        return $html;
    }
}
