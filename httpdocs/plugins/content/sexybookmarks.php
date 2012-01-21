<?php
/**
* @version      $Id: sexybookmarks.php 15 2009-08-29 13:53:17Z astblog $
* @author       Alex Hoentschel
* @copyright    Copyright (C) 2009 Alex Hoentschel. All rights reserved.
* @license      GNU/GPL
* The Sexy Bookmarks plugin is based on the Sexy Bookmarks Plugin for Wordpress
* originaly designed and coded by Josh Jones http://www.eight7teen.com
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

define('SEXY_URL', JURI::base()."plugins/content/sexybookmarks");
define('SEXY_VER', '1.1.0');

/**
 *
 * Base class für Sexy Bookmarks plugin
 *
 */
class plgContentSexyBookmarks extends JPlugin {

    /**
     * Constructor für Plugin
     *
     * @param $subject
     * @param $config
     */
    function plgContentSexyBookmarks(&$subject, $config) {
        parent::__construct( $subject, $config );
    }

    /**
     * Adds the plugin to the required point
     *
     * @param $article
     * @param $params
     * @param $limitstart
     * @return mixed
     */
    function onPrepareContent( &$article, &$params, $limitstart='') {
        JPlugin::loadLanguage( 'plg_content_sexybookmarks', JPATH_ADMINISTRATOR);

        $doc =& JFactory::getDocument();

        if($this->params->get(add_css) == 1) {
            $doc->addStyleSheet(SEXY_URL."/style.css?ver=".SEXY_VER);
        }

        // Not yet available
        //$doc->addScript(SEXY_URL."/sexybookmarks.js");

        if(!$this->checkCategories($article)) return;

        if($this->params->get('manual') != 1 && !$this->searchAntiBookmarkTag($article)) {
            $article->text = $this->deleteBookmarkTag($article->text);
            if($this->params->get('article') == 1 && JRequest::getVar('view') == 'article') {
                $article->text = $article->text.$this->fetchSexyHTML($article);
            } elseif($this->params->get('frontpage') == 1 && JRequest::getVar('view') == 'frontpage') {
                $article->text = $article->text.$this->fetchSexyHTML($article);
            } elseif($this->params->get('blog') == 1 && JRequest::getVar('layout') == 'blog') {
                $article->text = $article->text.$this->fetchSexyHTML($article);
            } else {
                return;
            }
        } else {
            $article->text = $this->searchBookmarkTag($article->text);
        }

        return;
    }

    /**
     * Category check. Is the articles category allowed to print
     * the bookmarks menu
     *
     * @param $article
     * @return bool
     */
    function checkCategories(&$article) {
        if($this->params->get('include_cat') == "") return true;

        $include_array = explode(",", $this->params->get('include_cat'));

        if(in_array($article->catid, $include_array)) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Manually insertion of the Bookmarks Menu
     *
     * @param object $article
     * @return object
     */
    function searchBookmarkTag($text) {
        $searchtag = "{sexybookmark}";

        if(substr_count($text, $searchtag) >= 1) {
            $text = $text.$this->fetchSexyHTML($article);
        } else {
            $text = $text;
        }

        $text = $this->deleteBookmarkTag($text);
        return $text;
    }

    /**
     * Check for existing {nosexybookmark} in articles
     *
     * @param object $article
     * @return bool
     */
    function searchAntiBookmarkTag(&$article) {
        $searchtag = "{nosexybookmark}";
        if(substr_count($article->text, $searchtag) >= 1) {
            $article->text = $this->deleteAntiBookmarkTag($article->text);
            return true;
        }

        return false;
    }

    /**
     * Fetches the required background image
     *
     * @return string
     */
    function fetchBackground() {
        if($this->params->get('bgimg') == 'caring') {
            return " sexy-bookmarks-bg-caring";
        } elseif($this->params->get('bgimg') == 'sexy') {
            return " sexy-bookmarks-bg-sexy";
        } elseif($this->params->get('bgimg') == 'wealth') {
            return " sexy-bookmarks-bg-wealth";
        } elseif($this->params->get('bgimg') == 'care-old') {
            return " sexy-bookmarks-bg-caring-old";
        } elseif($this->params->get('bgimg') == 'love') {
            return " sexy-bookmarks-bg-love";
        } else {
            return;
        }
    }

    /**
     * Core function to add the Sexy Bookmarks menu to the article
     *
     * @param object $article
     * @return mixed
     */
    function fetchSexyHTML(&$article) {

        $echo_bookmarks = false;

        $j_config =& JFactory::getConfig();

        if($this->params->get('article') == 1 && JRequest::getVar('view') == 'article') {
            $url =& JFactory::getURI();
            $perms = $url->toString();
            $perms = str_replace( '&amp;', '&', $perms );
            $echo_bookmarks = true;
        } else {
            $user =& JFactory::getUser();
            if ($article->access <= $user->get('aid', 0)) {
                jimport('joomla.application.component.helper');
                $perms = JRoute::_($this->constructFrontpageUrl($article), false, -1);
                $echo_bookmarks = true;
            } else {
                $echo_bookmarks = false;
            }
        }

        if($j_config->getValue('config.sef') != 1) $perms = urlencode($perms);

        $title = urlencode($article->title);
        $title = str_replace('%3A',':',$title);
        $title = str_replace('%3F','?',$title);
        $title = str_replace('%C3%B9','ù',$title);
        $title = str_replace('%C3%A0','à',$title);
        $title = str_replace('%C3%A8','è',$title);
        $title = str_replace('%C3%AC','ì',$title);
        $title = str_replace('%C3%B2','ò',$title);

        $short_title = substr($title, 0, 60)."...";

        $mail_subject = urlencode(substr($title, 0, 60)."...");
        $mail_subject = str_replace('+','%20',$mail_subject);
        $mail_subject = str_replace("&#8217;","'",$mail_subject);

        $sexy_content = urlencode(strip_tags(substr($article->text, 0, 220)."[..]"));
        //$sexy_content = urlencode(substr(strip_tags(strip_shortcodes(get_the_content())),0,300));
        $sexy_content = str_replace('+','%20',$sexy_content);
        $sexy_content = str_replace("&#8217;","'",$sexy_content);


        $post_summary = stripslashes($sexy_content);

        //$sexy_teaser = strip_tags(substr($article->text, 0, 250)."[..]");
        $sexy_teaser = $sexy_content;
        $strip_teaser = stripslashes($sexy_teaser);

        $site_name = $title;

        if($this->params->get('twitter') == 1 && $this->params->get('twittid') != "") {
            $short_url = $this->getShortUrl($perms);
            $post_by = "RT+@".$this->params->get('twittid').":+";
        }

        if ($this->params->get('twittley') == 1 && $article->metakey != '') {
            $twittley_cat = $this->params->get('twittcat');
            $twittley_tags = $article->metakey;
        } elseif($this->params->get('twittley') == 1 && $this->params->get('twittcat') != '') {
            $twittley_cat = $this->params->get('twittcat');
            $twittley_tags = $this->params->get('defaulttags');
        }

        /**
        * Not yet available
        * if($this->params->get('autoexpand') == 1) {
        *     $add_class = " sexy-bookmarks-expand";
        * } else {
        *     //$style = 'style="'$this->params->get('xtrastyle').'"';
        * }
        */
        $style = 'style="'.$this->params->get('xtrastyle').'"';

        $socials = "\n".'<div class="sexy-bookmarks'.$add_class.''.$this->fetchBackground().'" '.$style.' id="sexy-bookmarks"><ul id="socials" class="socials">'.
        ($this->params->get('scriptstyle') == 1 ? $this->fetchHTMLSnippet("sexy-scriptstyle", "http://scriptandstyle.com/submit?url=".$perms."&amp;title=".$title, JText::_("Submit this to Script Style")) : '').

        ($this->params->get('blinklist') == 1 ? $this->fetchHTMLSnippet("sexy-blinklist", "http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Url=".$perms."&amp;Title=".$title, JText::_("Share this on Blinklist")) : '').

        ($this->params->get('delicious') == 1 ? $this->fetchHTMLSnippet("sexy-delicious", "http://del.icio.us/post?url=".$perms."&amp;title=".$title, JText::_("Share this on del.icio.us")) : '').

        ($this->params->get('digg') == 1 ? $this->fetchHTMLSnippet("sexy-digg", "http://digg.com/submit?phase=2&amp;url=".$perms."&amp;title=".$title, JText::_("Digg this!")) : '').

        ($this->params->get('reddit') == 1 ? $this->fetchHTMLSnippet("sexy-reddit", "http://reddit.com/submit?url=".$perms."&amp;title=".$title, JText::_("Share this on Reddit")) : '').

        //($this->params->get('yahoo') == 1 ? $this->fetchHTMLSnippet("sexy-yahoomyweb", "http://myweb2.search.yahoo.com/myresults/bookmarklet?t=".$title."&amp;u=".$perms, JText::_("Save this to Yahoo MyWeb")) : '').

        ($this->params->get('stumpleupon') == 1 ? $this->fetchHTMLSnippet("sexy-stumbleupon", "http://www.stumbleupon.com/submit?url=".$perms."&amp;title=".$title, JText::_("Stumble upon something good? Share it on StumbleUpon")) : '').

        ($this->params->get('technorati') == 1 ? $this->fetchHTMLSnippet("sexy-technorati", "http://technorati.com/faves?add=".$perms, JText::_("Share this on Technorati")) : '').

        ($this->params->get('mixx') == 1 ? $this->fetchHTMLSnippet("sexy-mixx", "http://www.mixx.com/submit?page_url=".$perms."&amp;title=".$title, JText::_("Share this on Mixx")) : '').

        ($this->params->get('myspace') == 1 ? $this->fetchHTMLSnippet("sexy-myspace", "http://www.myspace.com/Modules/PostTo/Pages/?u=".$perms."&amp;t=".$title, JText::_("Post this to MySpace")) : '').

        ($this->params->get('designfloat') == 1 ? $this->fetchHTMLSnippet("sexy-designfloat", "http://www.designfloat.com/submit.php?url=".$perms."&amp;title=".$title, JText::_("Submit this to DesignFloat")) : '').

        ($this->params->get('facebook') == 1 ? $this->fetchHTMLSnippet("sexy-facebook", "http://www.facebook.com/share.php?u=".$perms."&amp;t=".$title, JText::_("Share this on Facebook")) : '').

        ($this->params->get('twitter') == 1 && $this->params->get('twittid') != "" && $short_url != "" ? $this->fetchHTMLSnippet("sexy-twitter", 'http://www.twitter.com/home?status='.$post_by.'+'.$short_title.'+-+'.$short_url, JText::_("Tweet This!")) : '').

        ($this->params->get('devmarks') == 1 ? $this->fetchHTMLSnippet("sexy-devmarks", 'http://devmarks.com/index.php?posttext='.$post_summary.'&amp;posturl='.$perms.'&posttitle='.$title, JText::_("Share this on Devmarks")) : '').

        ($this->params->get('newsvine') == 1 ? $this->fetchHTMLSnippet("sexy-newsvine", "http://www.newsvine.com/_tools/seed&save?u=".$perms."&amp;h=".$title, JText::_("Seed this on Newsvine")) : '').

        ($this->params->get('linkedin') == 1 ? $this->fetchHTMLSnippet("sexy-linkedin", 'http://www.linkedin.com/shareArticle?mini=true&amp;url='.$perms.'&amp;title='.$title.'&amp;summary='.$post_summary.'&amp;source='.$site_name, JText::_("Share this on Linkedin")) : '').

        ($this->params->get('google') == 1 ? $this->fetchHTMLSnippet("sexy-google", "http://www.google.com/bookmarks/mark?op=add&amp;bkmk=".$perms."title=".$title, JText::_("Add this to Google Bookmarks")) : '').

        //($this->params->get('email') == 1 ? $this->fetchHTMLSnippet("sexy-mail", 'mailto:?subject='.$mail_subject.'&amp;body='.$strip_teaser.' - '.$perms, JText::_("Email this to a friend?")) : '').

        ($this->params->get('misterwong') == 1 ? $this->fetchHTMLSnippet("sexy-misterwong", "http://www.mister-wong.com/addurl/?bm_url=".$perms."&amp;bm_description=".$title."&amp;plugin=sexybookmarks", JText::_("Add this to Mister Wong")) : '').

        ($this->params->get('izeby') == 1 ? $this->fetchHTMLSnippet("sexy-izeby", "http://izeby.com/add_story.php?story_url=".$perms, JText::_("Add this to Izeby")) : '').

        ($this->params->get('diigo') == 1 ? $this->fetchHTMLSnippet("sexy-diigo", "http://www.diigo.com/post?url=".$perms."&amp;title=".$title."&amp;desc=".$sexy_teaser, JText::_("Post this on Diigo")) : '').

        //($this->params->get('tumblr') == 1 ? $this->fetchHTMLSnippet("sexy-tumblr", "http://www.tumblr.com/share?v=3&amp;u=".$perms."&amp;t=".$title."&amp;s=", JText::_("Share this on Tumblr")) : '').

        ($this->params->get('tipd') == 1 ? $this->fetchHTMLSnippet("sexy-tipd", "http://tipd.com/submit.php?url=".$title, JText::_("Share this on Tipd")) : '').

        ($this->params->get('pfbuzz') == 1 ? $this->fetchHTMLSnippet("sexy-pfbuzz", "http://pfbuzz.com/submit?url=".$perms."&amp;title=".$title, JText::_("Share this on PFBuzz")) : '').

        // neue...
        ($this->params->get('friendfeed') == 1 ? $this->fetchHTMLSnippet("sexy-friendfeed", "http://www.friendfeed.com/share?title=".$title."&amp;link=".$perms, JText::_("Share this on FriendFeed")) : '').

        ($this->params->get('blogmarks') == 1 ? $this->fetchHTMLSnippet("sexy-blogmarks", "http://blogmarks.net/my/new.php?mini=1&amp;simple=1&amp;url=".$perms."&amp;title=".$title, JText::_("Mark this on BlogMarks")) : '').

        ($this->params->get('twittley') == 1 ? $this->fetchHTMLSnippet("sexy-twittley", "http://twittley.com/submit/?title=".$title."&amp;url=".$perms."&amp;desc=".$post_summary."&amp;pcat=".$twittley_cat."&amp;tags=".$twittley_tags, JText::_("Submit this to Twittley")) : '').

        ($this->params->get('fwisp') == 1 ? $this->fetchHTMLSnippet("sexy-fwisp", "http://fwisp.com/submit?url=".$perms, JText::_("Share this on Fwisp")) : '').

        '</ul></div>';

        if($echo_bookmarks === true) {
            return $socials;
        } else {
            return;
        }

    }

    /**
     * Builds each single menu element as a HTML list element
     *
     * @param string $class
     * @param string $url
     * @param string $title
     * @return string
     */
    function fetchHTMLSnippet($class, $url, $title) {
        if($this->params->get('add_nofollow') == 1) {
            $relopt = "nofollow";
        } else {
            $relopt = "";
        }

        if($this->params->get('open_in_newwindow') == 1) {
            $tarwin = "_blank";
        } else {
            $tarwin = "_self";
        }

        return "\n".'<li class="'.$class.'"><a href="'.$url.'" target="'.$tarwin.'" rel="'.$relopt.'" title="'.$title.'"> </a></li>';
    }

    /**
     * Helper function to build the Frontpage url. Not necessary on article pages
     *
     * @param object $article
     * @return string
     */
    function constructFrontpageUrl(&$article) {

        $needles = array(
            'article'  => (int) $article->slug,
            'category' => (int) $article->catslug,
            'section'  => (int) $article->sectionid
        );

        $link = 'index.php?option=com_content&view=article&id='. $article->slug;

        if($article->catslug) {
            $link .= '&catid='.$article->catslug;
        }

        if($item = plgContentSexyBookmarks::_findItem($needles)) {
            $link .= '&Itemid='.$item->id;
        }

        return $link;
    }

    /**
     * Delete manual bookmark tag from Text
     *
     * @param string $article
     * @return string
     */
    function deleteBookmarkTag($text) {
        return str_replace('{sexybookmark}', '', $text);
    }

    /**
     * Delete inserted bookmark tag to avoid displaying
     * sexy bookmarks menu
     *
     * @param string $text
     * @return string
     */
    function deleteAntiBookmarkTag($text) {
        return str_replace('{nosexybookmark}', '', $text);
    }

    /**
     * Helper function to create short url's for Twitter
     *
     *
     * @param string $url
     * @return string
     */
    function getShortUrl($url) {

        switch ($this->params->get('url_service')) {
            case 'tinyurl':
                $api_url = 'http://tinyurl.com/api-create.php?url='.$url;
                break;
            case 'is.gd':
                $api_url = 'http://is.gd/api.php?longurl='.$url;
                break;
            case 'rims':
                $api_url = 'http://ri.ms/api-create.php?url='.$url;
                break;
            case 'tinyarro':
                $api_url = 'http://tinyarro.ws/api-create.php?url='.$url;
                break;
        }

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch,CURLOPT_URL,$api_url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Finds the Itemid for the correct Url on the frontpage
     *
     * @param array $needles
     * @return object
     */
    function _findItem($needles) {
        $component =& JComponentHelper::getComponent('com_content');

        $menus  = &JApplication::getMenu('site', array());
        $items  = $menus->getItems('componentid', $component->id);

        $match = null;

        foreach($needles as $needle => $id)
        {
            foreach($items as $item)
            {
                if ((@$item->query['view'] == $needle) && (@$item->query['id'] == $id)) {
                    $match = $item;
                    break;
                }
            }

            if(isset($match)) {
                break;
            }
        }

        return $match;
    }

}
?>