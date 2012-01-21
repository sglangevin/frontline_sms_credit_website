<?php
/**
 * @package jx_modules
 * @package JX Share Link
 * @version $Id$
 * @copyright Olle Johansson
 * @license GNU/GPLv2,
 * @author Olle Johansson <Olle@Johansson.com>
 * @todo Change items to a list and use anchors instead of images.
 * @todo Optionally display or exclude button on front page
 * @todo Optionally display or exclude button in article intro sections
 * @todo Add a What's This link.
 * @todo Make it possible to track which links have been shared.
 * @todo Add speed option for effect.
 * @todo Create imagelist element which shows the selected image. Add javascript to select box to update the image automatically on change. Make sure it is loaded by default.
 * @todo Possibly have a bunch of "categories" that can be activated individually. German, Asian etc.
 * @todo New element for lists which can be sorted and filled with items from a container of all items. Similar to the image selection when creating an article in Joomla, but for any list.
 * @todo Support text selection, especially for Diigo.
 * @todo Support Jaiku.
 * @todo Find more Swedish sites.
 * @todo Exclude button from entire sections and categories
 * @todo option to display buttons on regular content items, static content items, or all content items.
 * @todo Plugin code to change url/title of buttons for an article.
 * @todo Allow for permalink for items.
 * @todo Add cool hover effect on share links.
 * @todo http://www.seo-id.com/social-bookmark-list
 * @todo http://forum.vbulletinsetup.com/f7/over-500-social-networking-sites-can-3548.html
 * @todo http://www.socialbookmarketing.org
 */

defined( '_JEXEC' ) or die('Restricted access.');
jimport( 'joomla.event.plugin' );

class plgContentJxShareLink extends JPlugin
{
	protected $_plugin;
	protected $_pluginParams;
	protected $_document;
	
	protected $shares = array(
		array('Bookmark', 'bookmark.png', '#bookmark'),
		array('Google', 'google.png', 'http://www.google.com/bookmarks/mark?op=add&amp;bkmk=%%URL%%&amp;title=%%TITLE%%'),
		array('Yahoo MyWeb', 'yahoo.png', 'http://Myweb2.search.yahoo.com/myresults/bookmarklet?u=%%URL%%&amp;t=%%TITLE%%'),
		array('Del.icio.us', 'delicious.png', 'http://del.icio.us/post?&amp;url=%%URL%%&amp;title=%%TITLE%%'),
		array('Digg', 'digg.png', 'http://digg.com/submit?phase=2&amp;url=%%URL%%&amp;title=%%TITLE%%'),
		array('Facebook', 'facebook.png', 'http://www.facebook.com/share.php?u=%%URL%%'),
		array('Myspace', 'myspace.png', 'http://www.myspace.com/Modules/PostTo/Pages/?c=%%URL%%&amp;t=%%TITLE%%'),
		array('Reddit', 'reddit.png', 'http://reddit.com/submit?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Ma.gnolia', 'magnolia.png', 'http://ma.gnolia.com/bookmarklet/add?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Technorati', 'technorati.png', 'http://technorati.com/faves?add=%%URL%%'),
		array('Stumble Upon', 'stumbleupon.png', 'http://www.stumbleupon.com/submit?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Pownce', 'pownce.png', 'http://pownce.com/send/link/?url=%%URL%%&amp;note_body=%%TITLE%%'),
		array('Blogmarks', 'blogmarks.png', 'http://blogmarks.net/my/new.php?mini=1&amp;simple=1&amp;url=%%URL%%&amp;title=%%TITLE%%'),
		array('Blinklist', 'blinklist.png', 'http://www.blinklist.com/index.php?Action=Blink/addblink.php&amp;Description=%%TITLE%%&amp;Url=%%URL%%&amp;Title=%%TITLE%%'),
		array('Spurl', 'spurl.png', 'http://www.spurl.net/spurl.php?v=3&amp;title=%%TITLE%%&amp;url=%%URL%%'),
		array('Furl', 'furl.png', 'http://www.furl.net/storeIt.jsp?u=%%URL%%&amp;t=%%TITLE%%'),
		array('Fark', 'fark.png', 'http://cgi.fark.com/cgi/fark/farkit.pl?u=%%URL%%&amp;h=%%TITLE%%'),
		array('Newsvine', 'newsvine.png', 'http://www.newsvine.com/_wine/save?u=%%URL%%&amp;h=%%TITLE%%'),
		array('Diigo', 'diigo.png', 'http://www.diigo.com/post?url=%%URL%%&amp;title=%%TITLE%%&amp;desc=%%DESCRIPTION%%'),
		array('Mister Wong', 'mrwong.png', 'http://www.mister-wong.com/index.php?action=addurl&amp;bm_url=%%URL%%&amp;bm_description=%%TITLE%%&amp;bm_notice=%%DESCRIPTION%%'),
		array('folkd', 'folkd.png', 'http://www.folkd.com/page/submit.html?step2_sent=1&amp;url=%%URL%%&amp;check=page&amp;add_title=%%TITLE%%&amp;add_description=%%DESCRIPTION%%&amp;add_tags_show=&amp;add_tags=%%TAGS%%&amp;add_state=public'),
		array('Smarking', 'smarking.png', 'http://smarking.com/editbookmark/?url=%%URL%%&amp;description=%%TITLE%%&amp;tags=%%TAGS%%'),
		array('Propeller', 'propeller.png', 'http://www.propeller.com/submit?storyUrl=%%URL%%&amp;storyTitle=%%TITLE%%&amp;storyText=%%DESCRIPTION%%&amp;storyTags=%%TAGS%%'),
		array('Slashdot', 'slashdot.png', 'http://slashdot.org/bookmark.pl?url=%%URL%%&amp;tags=%%TAGS%%&amp;title=%%TITLE%%'),
		array('Simpy', 'simpy.png', 'http://www.simpy.com/simpy/LinkAdd.do?href=%%URL%%&amp;title=%%TITLE%%'),
		array('Ask', 'ask.png', 'http://myjeeves.ask.com/mysearch/BookmarkIt?v=1.2&t=webpages&url=%%URL%%&amp;title=%%TITLE%%'),
		array('Squidoo', 'squidoo.png', 'http://www.squidoo.com/lensmaster/bookmark?%%URL%%'),
		array('Sphinn', 'sphinn.png', 'http://sphinn.com/submit.php?url=%%URL%%'),
		array('IndianPad', 'indianpad.png', 'http://www.indianpad.com/submit.php?url=%%URL%%'),
		array('DZone', 'dzone.png', 'http://www.dzone.com/links/add.html?url=%%URL%%&amp;title=%%TITLE%%'),
		array('StartAid', 'startaid.png', 'http://www.startaid.com/index.php?st=AddBrowserLink&amp;type=Detail&amp;v=3&urlname=%%URL%%&amp;urltitle=%%TITLE%%&amp;urldesc=%%DESCRIPTION%%'),
		array('Kaboodle', 'kaboodle.png', 'http://www.kaboodle.com/za/selectpage?p_pop=false&amp;pa=url&amp;u=%%URL%%'),
		array('Faves', 'faves.png', 'https://secure.faves.com/post?&amp;url=%%URL%%&amp;title=%%TITLE%%'),
		array('Bumpzee', 'bumpzee.png', 'http://www.bumpzee.com/bump.php?u=%%URL%%'),
		array('SWiK', 'swik.png', 'http://stories.swik.net/?submitUrl&amp;url=%%URL%%&amp;title=%%TITLE%%'),
		array('Shoutwire', 'shoutwire.png', 'http://www.shoutwire.com/?p=submit&amp;link=%%URL%%'),
		array('ThisNext', 'thisnext.png', 'http://www.thisnext.com/pick/new/submit/sociable/?url=%%URL%%&amp;name=%%TITLE%%'),
		array('Netvouz', 'netvouz.png', 'http://www.netvouz.com/action/submitBookmark?url=%%URL%%&amp;title=%%TITLE%%&amp;popup=no'),
		array('PlugIM', 'plugim.png', 'http://www.plugim.com/submit?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Wists', 'wists.png', 'http://wists.com/s.php?c=&r=%%URL%%&amp;title=%%TITLE%%'),
		array('Connotea', 'connotea.png', 'http://www.connotea.org/addpopup?continue=confirm&amp;uri=%%URL%%&amp;title=%%TITLE%%'),
		array('Dotnetkicks', 'dotnetkicks.png', 'http://www.dotnetkicks.com/kick/?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Fleck', 'fleck.png', 'http://extension.fleck.com/?v=b.0.804&amp;url=%%URL%%'),
		array('ppnow', 'ppnow.png', 'http://www.ppnow.net/submit.php?url=%%URL%%'),
		array('HaoHaoReport', 'haohaoreport.png', 'http://www.haohaoreport.com/submit.php?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Jumptags', 'jumptags.png', 'http://www.jumptags.com/add/?url=%%URL%%&amp;title=%%TITLE%%'),
		array('netRocket', 'netrocket.png', 'http://bookmarks.com/mynetrocket/UpdateBookmark.aspx?mode=compact&burl=%%URL%%&amp;bdesc=%%TITLE%%'),
		array('Mixx', 'mixx.png', 'http://www.mixx.com/submit?page_url=%%URL%%'),
		array('Chipmark', 'chipmark.png', 'https://www.chipmark.com/AddLink?agent=ext&amp;linkName=%%TITLE%%&amp;linkURL=%%URL%%&amp;linkPermission=public&amp;linkDescription=%%DESCRIPTION%%&amp;labelNames=%%TAGS%%'),
		array('Yahoo Bookmarks', 'yahoobookmarks.png', 'https://login.yahoo.com/config/login?.src=bmk2&.intl=us&.done=http://bookmarks.yahoo.com/toolbar/savebm%3Fopener%3Dtb%26amp;u%3D%%URL%%%26amp;t%3D%%TITLE%%'),
		array('Link-a-Gogo', 'linkagogo.png', 'http://www.linkagogo.com/go/AddNoPopup?url=%%URL%%&amp;title=%%TITLE%%'),
		array('myAOL', 'myaol.png', 'https://my.screenname.aol.com/_cqr/login/login.psp?sitedomain=my.aol.com&authLev=0&lang=en&locale=us&siteState=OrigUrl%3Dhttp%253A%252F%252Ffavorites.my.aol.com%252Fffclient%252Fwebroot%252F0.4.3%252Fsrc%252Fhtml%252FaddBookmarkDialog.html%253Furl%253D%%URLENC%%%2526title%253D%%TITLEENC%%'),
		array('MSN Live', 'msnlive.png', 'https://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=en-us&amp;url=%%URL%%&amp;title=%%TITLE%%&amp;top=1'),
		#Not a social bookmarking site anymore: array('RawSugar', 'rawsugar.png', 'http://www.rawsugar.com/tagger/?turl=%%URL%%&amp;tttl=%%TITLE%%&amp;editorInitialized=1'),
		#Site down: array('Tailrank', 'tailrank.png', 'http://tailrank.com/share/?text=%%DESCRIPTION%%&amp;link_href=%%URL%%&amp;title=%%TITLE%%'),
		#Site not responding: array('BlogMemes', 'blogmemes.png', 'http://www.blogmemes.net/post.php?url=%%URL%%&amp;title=%%TITLE%%'),
		#No icon: array('De.lirio.us', '', 'http://de.lirio.us/rubric/post?uri=%%URL%%;title=%%TITLE%%&amp;when_done=go_back'),
		#Site not responding: array('Co.mments', '', 'http://co.mments.com/track?url=%%URL%%&amp;title=%%TITLE%%'),
	);

	protected $asian = array(
		array('Nifty Clip', 'niftyclip.png', 'http://clip.nifty.com/create?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Hatena', 'hatena.png', 'http://b.hatena.ne.jp/add?mode=confirm&title=%%TITLE%%&amp;url=%%URL%%'),
		array('Drecom', 'drecom.png', 'http://rss.drecom.jp/shortcut/add_clip?url=%%URL%%&amp;title=%%TITLE%%'),
		array('MyShare', 'myshare.png', 'http://myshare.url.com.tw/index.php?func=newurl&amp;url=%%URL%%&amp;desc=%%TITLE%%'),
		array('HEMiDEMi', 'hemidemi.png', 'http://www.hemidemi.com/user_bookmark/new?title=%%TITLE%%&amp;url=%%URL%%'),
		array('JoltMark', 'joltmark.png', 'http://mark.jolt.jp/mark/entryMark.do?u=%%URL%%&amp;t=%%TITLE%%&amp;dj=%%DESCRIPTION%%'),
		array('RootAce', 'rootace.png', 'http://www.rootace.com/add.php?mode=confirm&amp;title=%%TITLE%%&amp;url=%%URL%%'),
	);

	protected $german = array(
		array('Oneview', 'oneview.png', 'http://www.oneview.de/quickadd/neu/addBookmark.jsf?URL=%%URL%%&amp;title=%%TITLE%%'),
		array('Linksilo', 'linksilo.png', 'http://www.linksilo.de/index.php?area=bookmarks&amp;func=bookmark_new&amp;addurl=%%URL%%&amp;addtitle=%%TITLE%%'),
		array('Readster', 'readster.png', 'http://www.readster.de/submit/?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Newsider', 'newsider.png', 'http://www.newsider.de/submit.php?url=%%URL%%'),
		array('Bookmarks.cc', 'bookmarkscc.png ', 'http://www.bookmarks.cc/bookmarken.php?action=neu&amp;url=%%URL%%&amp;title=%%TITLE%%'),
		array('Newskick', 'newskick.png', 'http://www.newskick.de/submit.php?url=%%URL%%'),
		array('Yigg', 'yigg.png', 'http://yigg.de/neu?exturl=%%URL%%'),
		array('Linkarena', 'linkarena.png', 'http://linkarena.com/bookmarks/addlink/?url=%%URL%%&amp;title=%%TITLE%%&amp;desc=%%DESCRIPTION%%&amp;tags=%%TAGS%%'),
		array('Webnews', 'webnews.png', 'http://www.webnews.de/einstellen?url=%%URL%%&amp;title=%%TITLE%%&amp;desc=%%DESCRIPTION%%'),
		array('Kledy', 'kledy.png', 'http://www.kledy.de/submit.php?url=%%URL%%'),
		array('Favit', 'favit.png', 'http://www.favit.de/submit.php?url=%%URL%%'),
		array('Favoriten', 'favoriten.png', 'http://www.favoriten.de/url-hinzufuegen.html?bm_url=%%URL%%&amp;bm_title=%%TITLE%%'),
		array('Seek XL', 'seekxl.png', 'http://social-bookmarking.seekxl.de/?add_url=%%URL%%&amp;title=%%TITLE%%'),
		array('BoniTrust', 'bonitrust.png', 'http://www.bonitrust.de/account/bookmark/?bookmark_url=%%URL%%'),
	);

	protected $swedish = array(
		array('Pusha', 'pusha.png', 'http://www.pusha.se/posta?url=%%URL%%&amp;title=%%TITLE%%'),
		#Doesn't seem to work properly: array('Hajpa', '', 'http://hajpa.se/site/public/nyheter/ny/index.php?url=%%URL%%&amp;title=%%TITLE%%'),
	);

	protected $european = array(
		array('OkNotizie', 'oknotizie.png', 'http://oknotizie.alice.it/post.html.php?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Segnalo', 'segnalo.png', 'http://segnalo.alice.it/post.html.php?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Chatta.it', 'chattait.png', 'http://blog.chatta.it/add.asp?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Nujij', 'nujij.png', 'http://nujij.nl/jij.lynkx?t=%%TITLE%%&amp;u=%%URL%%'),
		array('Ekudos', 'ekudos.png', 'http://www.ekudos.nl/artikel/nieuw?url=%%URL%%&amp;title=%%TITLE%%'),
		array('GeenRedactie', 'geenredactie.png', 'http://www.geenredactie.nl/submit?url=%%URL%%&amp;title=%%TITLE%%'),
		array('Wykop', 'wykop.png', 'http://www.wykop.pl/dodaj?url=%%URL%%'),
		array('Gwar', 'gwar.png', 'http://www.gwar.pl/DodajGwar.html?u=%%URL%%'),
		array('Blogter', 'blogter.png', 'http://cimlap.blogter.hu/index.php?action=suggest_link&amp;title=%%TITLE%%&amp;url=%%URL%%'),
		array('Linkter', 'linkter.png', 'http://www.linkter.hu/index.php?action=suggest_link&amp;url=%%URL%%&amp;title=%%TITLE%%'),
		array('InterNetMedia', 'internetmedia.png', 'http://internetmedia.hu/submit.php?url=%%URL%%'),
		array('Scoopeo', 'scoopeo.png', 'http://www.scoopeo.com/scoop/new?newurl=%%URL%%&amp;title=%%TITLE%%'),
		array('Rec6', 'rec6.png', 'http://www.via6.com/rec6/link.php?url=%%URL%%&amp;title=%%TITLE%%'),
	);

	function plgContentJxShareLink(&$subject, $params)
	{
		parent::__construct($subject, $params);
	}

	function onPrepareContent(&$article, &$params)
	{
		// Return directly if not viewing an article.
		if ((JRequest :: getVar('view')) != 'article') {
			return true;
		}

		// Load language.
		JPlugin::loadLanguage('plg_content_jxsharelink', 'administrator');

		// Set up private attributes.
		$this->_plugin =& JPluginHelper::getPlugin('content', 'jxsharelink');
		$this->_pluginParams = new JParameter( $this->_plugin->params );
		$this->_document = &JFactory::getDocument();

		if (!$this->isPluginActive($article)) {
			return true;
		}

		// Get the share list.
		$sharelist = $this->getShareList();

		// If all items were removed, return directly.
		if (!count($sharelist)) {
			return true;
		}

		// Add javascript and stylesheet files to header.
		$this->setupExternal();

		// Create html for all sites.
		$sites_html = $this->getShareListHtml($sharelist);		

		// Get the html for the share link.
		$share_link_html = $this->getShareHtml($sites_html);

		// Output the html.
		$placement = $this->_pluginParams->get('placement', 'listafter');
		if (in_array($placement, array('listafter', 'dropdownafter', 'buttonheading'))) {
	    	$article->text .= $share_link_html;
		} else {
	    	$article->text = $share_link_html . $article->text;
		}
	}
	
	/**
	 * Checks if the plugin should be active.
	 *
	 * @param object Article this plugin is used on.
	 */
	function isPluginActive(&$article)
	{
		return (!$this->isArticleExcluded($article));
	}
	
	/**
	 * Is the given article excluded from the using the Share Icon.
	 *
	 * @param object Article this plugin is used on.
	 */
	function isArticleExcluded(&$article)
	{
		// Check if the current article is to be excluded.
		$excludedarticles = $this->_pluginParams->get('excludedarticles', '');
		if (trim($excludedarticles)) {
			$xlist = explode(',', $excludedarticles);
			$xlist = array_map('trim', $xlist);
			if (in_array($article->id, $xlist)) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Returns a list of shares.
	 *
	 * Returns a list of all selected shares, with added shares as well.
	 * 
	 * @return array List of shares to use.
	 */
	function getShareList()
	{
		$sharelist = array();

		$this->filterShareList($sharelist);

		$this->updateShareImage($sharelist);
		
		$this->addExtraShares($sharelist);
		
		return $sharelist;		
	}
	
	/**
	 * Filter out only selected sites from the share list.
	 *
	 * @param array List of shares to update image link path for.
	 */
	function filterShareList(&$sharelist)
	{
		// Merge all share lists into one.
		$shares = array_merge($this->shares, $this->asian, $this->german, $this->swedish, $this->european);

		// Just use selected sites.
		$usedsites = $this->_pluginParams->get('usedsites', '');

		if (!is_array($usedsites)) {
		    $usedsites = array($usedsites);
		}

		if (count($usedsites) > 0) {
			$sc = count($shares);
			for ($i = 0; $i < $sc; $i++) {
				if (in_array($shares[$i][0], $usedsites)) $sharelist[] = $shares[$i];
			}
		}
	}
	
	/**
	 * Add full URL to images.
	 *
	 * @param array List of shares to update image link path for.
	 */
	function updateShareImage(&$sharelist)
	{
		$sc = count($sharelist);
		for ($i = 0; $i < $sc; $i++) {
			$sharelist[$i][1] = JURI::base() . "plugins/content/jxsharelink/images/" . $sharelist[$i][1];
		}
	}
	
	/**
	 * Add extra sites to array.
	 *
	 * @param array List of shares to update image link path for.
	 */
	function addExtraShares(&$sharelist)
	{
		$addedsites = $this->_pluginParams->get('addedsites', '');

		if (trim($addedsites)) {
			$sites = preg_split("/(\n|\r|\r\n)/", $addedsites, -1, PREG_SPLIT_NO_EMPTY);
			if (count($sites)) {
				foreach ($sites as $site) {
					list($site_name, $site_image, $site_url) = explode('|', $site);
					$sharelist[] = array(trim($site_name), trim($site_image), trim($site_url));
				}
			}
		}	
	}
	
	/**
	 * Sets up external links in the header.
	 */
	function setupExternal()
	{
		$this->_document->addScript(JURI::base() . "plugins/content/jxsharelink/jxsharelink.js");
		$this->_document->addStyleSheet(JURI::base() . "plugins/content/jxsharelink/jxsharelink.css");
	}
	
	/**
	 * Return a string with html for the share sites.
	 *
	 * @return string Html for all the share sites.
	 */
	function getShareListHtml(&$sharelist)
	{
		$tags = $this->_document->getMetaData('keywords');
		$description = $this->_document->getMetaData('description');
		
		$sites_html = '';
		$text_share_link_on = JText::_('Share Link On:');
		foreach ($sharelist as $link) {
			$link[2] = str_replace('%%TAGS%%', $tags, $link[2]);
			$link[2] = str_replace('%%DESCRIPTION%%', $description, $link[2]);
			$title_text = ($link[0] == 'Bookmark') ? JText::_('Bookmark This Page') : "$text_share_link_on {$link[0]}";
			$sites_html .= "\t<a class='jxshare_link' title='$title_text' href=\"{$link[2]}\"><img class='jxshare_image' alt=\"{$link[0]}\" src=\"{$link[1]}\" /></a>\n";
		}
		return $sites_html;
	}
	
	/**
	 * Returns a string with the html to output.
	 *
	 * @string Html to print.
	 */
	function getShareHtml(&$sites_html)
	{
		// Read parameters.
		$placement = $this->_pluginParams->get('placement', 'listafter');

		// Check if icons should float left or right.
		$float = '';
		if ($placement == "float_right") {
			$float = 'jxfloat_right';
		} else if ($placement == "float_left") {
			$float = 'jxfloat_left';
		}

		$share_icon_html = $this->getShareIconHtml();

		if (in_array($placement, array('dropdownbefore', 'dropdownafter', 'buttonheading'))) {
			$share_link_html = "\n$share_icon_html<div id='jxshare_posbox' class='jxshare_posbox $float'><div id='jxshare_box' class='jxshare_box'>\n$sites_html</div></div>\n";
		} else {
			$text_share_link = $float ? '' : JText::_( 'Share Link:' );
			$share_link_html = "\n<div id='jxshare_box' class='jxshare_flat $float'>\n$share_icon_html $text_share_link $sites_html</div>\n";
		}
		return $share_link_html;
	}
	
	/**
	 * Returns the share icon html.
	 *
	 * @return string Share icon html.
	 */
	function getShareIconHtml()
	{
		// Read parameters.
		$shareicon = $this->_pluginParams->get('shareicon', 'openshare-icon-32');

		$buttonclasses = $this->getIconClasses();

		// Create html for the share link.
		// Check which share icon to use.
		$text_share_link = JText::_( 'Share Link:' );
		switch ($shareicon) {
			case '-1':
				$share_icon_html = '';
				break;
			case '0':
				$shareicon = 'openshare-icon-32';
				// Don't break out, we need to set the html for the icon.
			default:
				$share_icon_html = "<img id='jxshare_button' src='".JURI::base()."/plugins/content/jxsharelink/images/shareicons/$shareicon.png' title='$text_share_link :: ".JText::_( 'Share this article on social bookmarking sites.' )."' class='$buttonclasses' alt='$text_share_link' />\n";
		}
		return $share_icon_html;
	}
	
	/**
	 * Get the list of classes to use on the Share Icon.
	 *
	 * @return string Class names to add to the Share Icon html.
	 */
	function getIconClasses()
	{
		// Read parameters.
		$placement = $this->_pluginParams->get('placement', 'listafter');
		$mode      = $this->_pluginParams->get('mode', 'vertical');
		$effect    = $this->_pluginParams->get('effect', 'bounce');
		$openlink  = $this->_pluginParams->get('openlink', '');

		// By default, don't use any extra classes on share button.
		$buttonclasses = 'hasTip jxshare_button';

		// If icon should be placed in the buttonheading, add a special class to the share icon.
		if ($placement == 'buttonheading') {
			$buttonclasses .= ' jxshare_btnhead';
		}

		// Menu mode.
		$buttonclasses .= ($mode == 'horizontal') ?	' trans_horiz' : ' trans_vert';

		// Transition effect
		switch ($effect) {
			case 'bounce':  $buttonclasses .= ' fx_bounce'; break;
			case 'elastic': $buttonclasses .= ' fx_elastic'; break;
			case 'expo':    $buttonclasses .= ' fx_expo'; break;
			case 'back':    $buttonclasses .= ' fx_back'; break;
			case 'circ':    $buttonclasses .= ' fx_circ'; break;
			case 'sine':    $buttonclasses .= ' fx_sine'; break;
			case 'quad':    $buttonclasses .= ' fx_quad'; break;
			case 'cubic':   $buttonclasses .= ' fx_cubic'; break;
			case 'quart':   $buttonclasses .= ' fx_quart'; break;
			case 'quint':   $buttonclasses .= ' fx_quint'; break;
			case 'linear':
			default:
			$buttonclasses .= ' fx_linear';
		}

		// Check how to open links.
		if ($openlink == 'popup') {
			$buttonclasses .= ' jxshare_popup';
		} else if ($openlink == 'blank') {
			$buttonclasses .= ' jxshare_blank';
		}
		
		return $buttonclasses;
	}
}

