<?php
/**
 * Plugin Helper File
 *
 * @package     Modalizer
 * @version     2.3.2
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright © 2011 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport( 'joomla.event.plugin' );

/**
* Plugin that places articles
*/
class plgSystemModalizerHelper
{
	function plgSystemModalizerHelper( &$params )
	{
		$this->params = $params;
		$this->params->class = 'modalizer_link';
		$this->params->group = 'modalizer_group';

		$this->params->pass = 1;
		if ( !(
				( $this->params->enable_classnames && $this->params->classnames )
			||	( $this->params->enable_filetypes && $this->params->filetypes )
			||	( $this->params->enable_urls && $this->params->urls )
			||	( $this->params->enable_target && ( $this->params->target_internal || $this->params->target_external ) )
			||	( $this->params->enable_syntax && $this->params->syntax )
		) ) {
			$this->params->pass = 0;
			return;
		}

		$this->params->imagetypes = array( 'png', 'jpg', 'gif', 'bmp', 'jpeg' );

		if ( JRequest::getInt( 'ml', 0 ) ) {
			$_REQUEST['tmpl'] = $this->params->tmpl;
			$this->params->pass = 2;
			if (	$this->params->modal_tmpl_links
				&& (	(	$this->params->modal_iframe && in_array( $this->params->modal_type, array( 'core', 'colorbox', 'fancybox' ) ) )
					||	( in_array( $this->params->modal_type, array( 'lytebox', 'shadowbox' ) ) )
				)
			) {
				$this->params->pass = 3;
			}
			return;
		}

		// allow in component?
		if ( $this->params->disable_components && $this->params->disable_components != 'x' ) {
			$option = JRequest::getCmd( 'option' );
			if ( !is_array( $this->params->disable_components ) ) {
				$this->params->disable_components = explode( '|', $this->params->disable_components );
			}
			if ( in_array( $option, $this->params->disable_components ) ) {
				$this->params->pass = 0;
				return;
			}
		}

		$this->params->sizes = $this->initSizes();

		if ( $this->params->enable_urls && $this->params->urls ) {
			$this->params->urls = str_replace( '\n', "\n", $this->params->urls );
			$this->params->urls = str_replace( array( '[:REGEX_ENTER:]', '\|' ), array( '\n', '|' ), $this->params->urls );
			$this->params->urls = explode( "\n", $this->params->urls );
		}
	}

////////////////////////////////////////////////////////////////////
// AFTER RENDER
////////////////////////////////////////////////////////////////////
	function onAfterRender()
	{
		if ( !$this->params->pass ) { return; }

		$document =& JFactory::getDocument();
		$docType = $document->getType();

		// only in html
		if ( $docType != 'html' ) { return; }

		$html = JResponse::getBody();

		if ( $this->params->pass > 1 ) {
			$this->removeCloseLinks( $html );
			if ( $this->params->pass == 3 ) {
				$this->tmplLinks( $html );
			}
		} else {
			$this->handleLinks( $html );
		}
		if ( $this->params->enable_syntax ) {
			$this->handleSyntax( $html );
		}

		JResponse::setBody( $html );
	}


////////////////////////////////////////////////////////////////////
// PLACE SCRIPTS
////////////////////////////////////////////////////////////////////
	function placeScripts()
	{
		if( $this->params->pass !== 1 ) {
			return;
		}
		switch ( $this->params->modal_type ) {
			case 'colorbox':
				$this->placeScriptsColorBox();
				break;
			case 'fancybox':
				$this->placeScriptsFancyBox();
				break;
			case 'lytebox':
				$this->placeScriptsLyteBox();
				break;
			case 'shadowbox':
				$this->placeScriptsShadowBox();
				break;
			default:
				$this->placeScriptsCore();
				break;
		}
	}

	function placeScriptsCore()
	{
		$document =& JFactory::getDocument();
		JHTML::_('behavior.modal');

		$classnames = '';
		if ( $this->params->enable_classnames && $this->params->classnames ) {
			$classnames = explode( ',', $this->params->classnames );
			$classnames = 'a.'.implode( ',a.', $classnames );
		}

		$script = "
			window.addEvent('domready', function() {
				SqueezeBox.initialize({});
				$$('a.".$this->params->class.",".$classnames."').each(function(el) {
					el.addEvent('click', function(e) {
						new Event(e).stop();
						// fix sizing problem if auto size window is opened before fixed
						$('sbox-window').setStyle( 'width', '' ).setStyle( 'height', '' );
						SqueezeBox.fromElement(el);
					});
				});
			});
		";
		$document->addScriptDeclaration( $script );

	}

	function placeScriptsColorBox()
	{
		$document =& JFactory::getDocument();
		if ( $this->params->load_jquery ) {
			$document->addScript( JURI::root( true ).'/plugins/system/modalizer/modals/jquery.min.js' );
		}
		$document->addScript( JURI::root( true ).'/plugins/system/modalizer/modals/colorbox/jquery.colorbox-min.js' );
		if ( is_int( $this->params->modal_colorbox_style ) ) {
			$this->params->modal_colorbox_style = 'style'.$this->params->modal_colorbox_style;
		}
		$document->addStyleSheet( JURI::root( true ).'/plugins/system/modalizer/modals/colorbox/'.$this->params->modal_colorbox_style.'/colorbox.css' );

		$classnames = '';
		if ( $this->params->enable_classnames && $this->params->classnames ) {
			$classnames = explode( ',', $this->params->classnames );
			$classnames = 'a.'.implode( ',a.', $classnames );
		}

		$s = $this->params->sizes;

		$extra = ( $s->w ? 'width:\''.$s->w.'\',' : '' ).( $s->h ? 'height:\''.$s->h.'\'' : '' );
		$extra_img = $extra;
		if ( $this->params->modal_iframe ) {
			$extra = 'width:\''.( $s->w ? $s->w : '80%' ).'\','
					.'height:\''.( $s->h ? $s->h : '80%' ).'\','
					.'iframe:true';
		}
		$extra_ext = 'width:\''.( $s->w_ext ? $s->w_ext : '80%' ).'\','
					.'height:\''.( $s->h_ext ? $s->h_ext : '80%' ).'\','
					.'iframe:true';
		$script = "
			\$j(document).ready(function(){
				\$j('a.".$this->params->class.",".$classnames."').colorbox({".$extra."});
				\$j('a.".$this->params->class."_image').colorbox({".$extra_img."});
				\$j('a.".$this->params->class."_external').colorbox({".$extra_ext."});
			});
		";
		$document->addScriptDeclaration( $script );

		$css = "#cboxLoadedContent{background-color:#fff;}";
		$document->addStyleDeclaration( $css );

	}

	function placeScriptsFancyBox()
	{
		$document =& JFactory::getDocument();
		if ( $this->params->load_jquery ) {
			$document->addScript( JURI::root( true ).'/plugins/system/modalizer/modals/jquery.min.js' );
		}
		$document->addScript( JURI::root( true ).'/plugins/system/modalizer/modals/fancybox/jquery.fancybox.pack.js' );
		$document->addStyleSheet( JURI::root( true ).'/plugins/system/modalizer/modals/fancybox/jquery.fancybox.css' );

		$classnames = '';
		if ( $this->params->enable_classnames && $this->params->classnames ) {
			$classnames = explode( ',', $this->params->classnames );
			$classnames = 'a.'.implode( ',a.', $classnames );
		}
		$e = array();
		if ( $this->params->modal_fancybox_titlepos && $this->params->modal_fancybox_titlepos != 'none' ) {
			if ( $this->params->modal_fancybox_titlepos == 'none' ) {
				$e[] = '\'titleShow\':false';
			} else {
				$e[] = '\'titlePosition\':\''.$this->params->modal_fancybox_titlepos.'\'';
			}
		}
		if ( $this->params->modal_fancybox_border != 20 ) {
			$e[] = '\'padding\':'.(int) $this->params->modal_fancybox_border;
		}
		if ( $this->params->modal_fancybox_transition ) {
			$e[] = '\'transitionIn\':\''.$this->params->modal_fancybox_transition.'\'';
			$e[] = '\'transitionOut\':\''.$this->params->modal_fancybox_transition.'\'';
		}
		$s = $this->params->sizes;

		$extra = array();
		if ( $s->w ) {
			$extra[] = 'width:\''.$s->w.'\'';
		}
		if ( $s->h ) {
			$extra[] = 'height:\''.$s->h.'\'';
		}
		$extra = array_merge( $extra, $e );
		$extra_img = $extra;
		if ( $this->params->modal_iframe ) {
			$extra[] = 'type:\'iframe\'';
		}

		$extra_ext = array();
		$extra_ext[] = 'width:\''.( $s->w_ext ? $s->w_ext : '80%' ).'\'';
		$extra_ext[] = 'height:\''.( $s->h_ext ? $s->h_ext : '80%' ).'\'';
		$extra_ext[] = 'type:\'iframe\'';
		$extra_ext = array_merge( $extra_ext, $e );

		$script = "
			\$j(document).ready(function(){
				\$j('a.".$this->params->class.",".$classnames."').fancybox({".implode( ',', $extra )."});
				\$j('a.".$this->params->class."_image').fancybox({".implode( ',', $extra_img )."});
				\$j('a.".$this->params->class."_external').fancybox({".implode( ',', $extra_ext )."});

			});
		";
		$document->addScriptDeclaration( $script );
	}


	function placeScriptsLyteBox()
	{
		$document =& JFactory::getDocument();
		$document->addScript( JURI::root( true ).'/plugins/system/modalizer/modals/lytebox/lytebox.js' );
		$document->addStyleSheet( JURI::root( true ).'/plugins/system/modalizer/modals/lytebox/lytebox.css' );

		$extra = array();
		if ( !$this->params->modal_lytebox_transition ) {
			$extra[] = 'myLytebox.doAnimations = 0;';
		}
		if ( !$this->params->modal_lytebox_border ) {
			$extra[] = 'myLytebox.outerBorder = 0;';
		}
		$script = "
			if (window.addEventListener) {
				window.addEventListener(\"load\",initLytebox,false);
			} else if (window.attachEvent) {
				window.attachEvent(\"onload\",initLytebox);
			} else {
				window.onload = function() {initLytebox();}
			}
			function initLytebox() {
				myLytebox = new LyteBox();
				".implode( '', $extra )."
			}
		";
		$document->addScriptDeclaration( $script );
	}

	function placeScriptsShadowBox()
	{
		$document =& JFactory::getDocument();
		$document->addScript( JURI::root( true ).'/plugins/system/modalizer/modals/shadowbox/shadowbox.js' );
		$document->addStyleSheet( JURI::root( true ).'/plugins/system/modalizer/modals/shadowbox/shadowbox.css' );

		$extra = array();
		if ( $this->params->modal_shadowbox_transition ) {
			if ( $this->params->modal_shadowbox_transition == 'none' ) {
				$extra[] = 'animate:false';
			} else {
				$extra[] = 'animSequence:\''.$this->params->modal_shadowbox_transition.'\'';
			}
		}
		$script = "
			Shadowbox.init({".implode( ',', $extra )."});
		";
		$document->addScriptDeclaration( $script );

		$css = "#sb-body-inner{background-color:#fff;}";
		$document->addStyleDeclaration( $css );
	}


////////////////////////////////////////////////////////////////////
// IN POPUP
////////////////////////////////////////////////////////////////////
	function removeCloseLinks( &$html )
	{
		// Remove all close window links
		if ( !( strpos( $html, 'window.close(' ) === false ) ) {
			$html = preg_replace( '#<(a|button|div|span) [^>]*window.close\(.*?</\1>#si', '', $html );
		}
	}

	function tmplLinks( &$html )
	{
		// handle all links inside window to add tmpl
		if ( preg_match_all( '#<a\s.*?</a>#si', $html, $links, PREG_SET_ORDER ) > 0 ) {
			foreach ( $links as $link ) {
				$newlink = $this->tmplLink( $link['0'] );
				if ( $newlink != $link['0'] ) {
					$html = str_replace( $link['0'], $newlink, $html );
				}
			}
		}
	}

	function tmplLink( $link )
	{
		if ( preg_match( '#href="(\#[^"]*)"#si', $link, $u ) ) {
			$link = str_replace( $u['0'], 'href="'.JRequest::getURI().$u['1'].'"', $link );
			return $link;
		}
		if ( !preg_match( '#href="([^"]*?)((\#[^"]*)?)"#si', $link, $u ) ) {
			return $link;
		}
		if ( !preg_match( '#\starget="_self"#si', $link ) && preg_match( '#\starget="(.*?)"#si', $link ) ){
			return $link;
		}

		$url = $u['1'];

		$params = new stdClass();
		$params->filetype = $this->getFiletype( $url );
		$params->isexternal = $this->isExternal( $url );

		$isindex = ( $params->isexternal ) ? 0 : ( $params->filetype == '' || in_array( $params->filetype, array( 'php', 'html', 'htm' ) ) );
		if ( !$isindex ) {
			return $link;
		}

		if ( strpos( $url, '?' ) === false ) {
			$url .= '?ml=1';
		} else {
			$url .= '&amp;ml=1';
		}
		$url .= $u['2'];

		$link = str_replace( $u['0'], 'href="'.$url.'"', $link );

		return $link;
	}

////////////////////////////////////////////////////////////////////
// HANDLE LINKS
////////////////////////////////////////////////////////////////////
	function handleLinks( &$html )
	{
		// handle all links that should be modalized
		if ( preg_match_all( '#<a\s.*?</a>#si', $html, $links, PREG_SET_ORDER ) > 0 ) {
			foreach ( $links as $link ) {
				$newlink = $this->handleLink( $link['0'] );
				if ( $newlink != $link['0'] ) {
					$html = str_replace( $link['0'], $newlink, $html );
				}
			}
		}
	}

	function handleLink( $link )
	{
		if ( !preg_match( '#href="(.*?)"#si', $link, $u ) ) {
			return $link;
		}
		$url = $u['1'];

		$hasclass = preg_match( '#\sclass="(.*?)"#si', $link, $c );
		$hastarget = preg_match( '#\starget="(.*?)"#si', $link, $t );
		$hasrel = preg_match( '#\srel="(.*?)"#si', $link, $r );

		$params = new stdClass();
		$params->filetype = $this->getFiletype( $url );
		$params->isexternal = $this->isExternal( $url );
		$params->ismedia = in_array( $params->filetype, $this->params->imagetypes );

		$class = '';
		$rel = '';

		$ismodal = 0;

		// is a special Modalizer link
		if ( $hasclass && in_array( $this->params->class, explode( ',', $c['1'] ) ) ) {
			$ismodal = 1;
			$class = $c['1'];
		}

		// enable_classnames?
		if ( !$ismodal && $hasclass && $this->params->enable_classnames && $this->params->classnames ) {
			$classnames = explode( ',', $c['1'] );
			$p_classnames = explode( ',', $this->params->classnames );
			foreach( $classnames as $classname ) {
				if ( in_array( $classname, $p_classnames ) ) {
					$ismodal = 1;
					$class = $c['1'];
					break;
				}
			}
		}

		// enable_filetypes?
		if ( !$ismodal && $this->params->enable_filetypes && $this->params->filetypes ) {
			if ( $params->filetype && in_array( $params->filetype, explode( ',', $this->params->filetypes ) ) ) {
				$ismodal = 1;
			}
		}

		// enable_urls?
		if ( !$ismodal && $this->params->enable_urls && $this->params->urls ) {
			foreach ( $this->params->urls as $url_part ) {
				if ( $url_part !== '' ) {
					$url_part = '#'.str_replace( '&amp;', '(&amp;|&)', $url_part ).'#si';

					if (	@preg_match( $url_part.'u', $url )
						||	@preg_match( $url_part.'u', html_entity_decode( $url ) )
						||	@preg_match( $url_part, $url )
						||	@preg_match( $url_part, html_entity_decode( $url ) )
					) {
						$ismodal = 1;
						break;
					}
				}
			}
		}

		// enable_target?
		if ( !$ismodal && $hastarget && $this->params->enable_target && ( $this->params->target_internal || $this->params->target_external ) ) {
			if (
					$t['1'] == '_blank'
				&& (
						( $this->params->target_internal && !$params->isexternal )
					||	( $this->params->target_external && $params->isexternal )
				)
			) {
				$ismodal = 1;
				if ( $this->params->target_disablefiletypes ) {
					$params->filetype = $this->getFiletype( $url );
					if ( $params->filetype && in_array( $params->filetype, explode( ',', $this->params->target_disablefiletypes ) ) ) {
						$ismodal = 0;
					}
				}
			}
		}

		if ( $ismodal ) {
			$isindex = ( $params->isexternal ) ? 0 : ( $params->filetype == '' || in_array( $params->filetype, array( 'php', 'html', 'htm' ) ) );
			if ( $isindex ) {
				if ( strpos( $url, '?' ) === false ) {
					$url .= '?ml=1';
				} else {
					$url .= '&amp;ml=1';
				}
				$link = str_replace( $u['0'], 'href="'.$url.'"', $link );
			}

			// remove onclick actions
			$link = preg_replace( '#\sonclick=".*?"#si', '', $link );

			if ( $hastarget ) {
				$link = str_replace( $t['0'], ' target="_blank"', $link );
			} else {
				$link = str_replace( '<a', '<a target="_blank"', $link );
			}

			$this->getClassAndRel( $class, $rel, $params );

			if ( !$class ) {
				$class = $this->params->class;
				if ( $hasclass ) {
					$class .= ' '.$c['1'];
				}
			}

			if ( $rel ) {
				if ( $hasrel ) {
					$link = str_replace( $r['0'], ' rel="'.trim( $rel ).'"', $link );
				} else {
					$link = str_replace( '<a', '<a rel="'.trim( $rel ).'"', $link );
				}
			}

			if ( $hasclass ) {
				$link = str_replace( $c['0'], ' class="'.trim( $class ).'"', $link );
			} else {
				$link = str_replace( '<a', '<a class="'.trim( $class ).'"', $link );
			}
		}

		return $link;
	}

	function handleSyntax( &$html )
	{
		// first handle modal tags within other links (like in menu items)
		$regex = '#<a\s([^>]*)>((?:\s*</?span[^>]*>)*\s*\{'.preg_quote( $this->params->syntax, '#' ).'((?:\s+[^\}]*)?)\}'.'.*?\{/'.preg_quote( $this->params->syntax, '#' ).'\}\s*(?:</?span[^>]*>\s*)*)</a>#s';
		if ( preg_match_all( $regex, $html, $tags, PREG_SET_ORDER ) > 0 ) {
			foreach ( $tags as $tag ) {
				$link = $this->handleTagInLink( $tag );
				$html = str_replace( $tag['0'], $link, $html );
			}
		}

		// handle all modal tags
		$regex = '#\{'.preg_quote( $this->params->syntax, '#' ).'\s+([^\}]*)\}'.'(.*?)\{/'.preg_quote( $this->params->syntax, '#' ).'\}#s';
		if ( preg_match_all( $regex, $html, $tags, PREG_SET_ORDER ) > 0 ) {
			foreach ( $tags as $tag ) {
				$link = $this->handleTag( $tag );
				$html = str_replace( $tag['0'], $link, $html );
			}
		}
	}

	function handleTagInLink( $tag )
	{
		$regex = '#\{'.preg_quote( $this->params->syntax, '#' ).'(?:\s+[^\}]*)?\}'.'(.*?)\{/'.preg_quote( $this->params->syntax, '#' ).'\}#s';
		$text = preg_replace( $regex, '\1', $tag['2'] );

		$link_params = $this->getLinkParams( trim( $tag['1'] ) );
		$tag_params = $this->getTagParams( trim( $tag['3'] ) );

		if ( !$tag_params->url && isset( $link_params->href ) ) {
			$tag_params->url = $link_params->href;
		}
		if ( isset( $link_params->class ) ) {
			$tag_params->class = trim( $tag_params->class.' '.$link_params->class );
		}
		if ( !$tag_params->title && isset( $link_params->title ) ) {
			$tag_params->title = $link_params->title;
		}

		$params = array();
		foreach ( $tag_params as $key => $val ) {
			if ( $val != '' ) {
				$params[] = $key.'='.$val;
			}
		}
		$newtag = '{modal '.implode( '|', $params ).'}'.$text.'{/modal}';

		return $newtag;
	}

	function handleTag( $tag )
	{
		$tagparams = $this->getTagParams( $tag['1'] );
		if ( !$tagparams->url ) {
			return '';
		}

		$params = new stdClass();
		$params->filetype = $this->getFiletype( $tagparams->url );
		$params->isexternal = $this->isExternal( $tagparams->url );
		$params->ismedia = in_array( $params->filetype, $this->params->imagetypes );

		$isindex = ( $params->isexternal ) ? 0 : ( $params->filetype == '' || in_array( $params->filetype, array( 'php', 'html', 'htm' ) ) );
		if ( $isindex ) {
			if ( strpos( $tagparams->url, '?' ) === false ) {
				$tagparams->url = $tagparams->url.'?ml=1';
			} else {
				$tagparams->url = $tagparams->url.'&amp;ml=1';
			}
		}

		$link = '<a href="'.$tagparams->url.'"';

		if ( $this->params->pass != 2 ) {
			$class = '';
			$rel = '';

			$this->getClassAndRel( $class, $rel, $params, $tagparams );

			if ( !$class ) {
				$class = $this->params->class;
			}
			if ( $tagparams->class ) {
				$class .= ' '.$tagparams->class;
			}
			$link .= ' class="'.trim( $class ).'" ';
			if ( $rel ) {
				$link .= ' rel="'.trim( $rel ).'"';
			}
		}

		if ( $tagparams->title ) {
			$link .= ' title="'.$tagparams->title.'"';
		}

		$link .= '>'.$tag['2'].'</a>';

		return $link;
	}

	function getLinkParams( $str )
	{
		$p = new stdClass();

		if ( !$str ) {
			return $p;
		}

		$regex = '#([a-z0-9_-]+)="([^\"]*)"#si';
		if ( preg_match_all( $regex, $str, $params, PREG_SET_ORDER ) > 0 ) {
			foreach ( $params as $param ) {
				$p->$param['1'] = $param['2'];
			}
		}

		return $p;
	}

	function getTagParams( $str )
	{
		$p = new stdClass();
		$p->url = '';
		$p->width = '';
		$p->height = '';
		$p->title = '';
		$p->group = '';
		$p->class = '';

		if ( !$str ) {
			return $p;
		}

		$regex = '#([a-z0-9_-]+)=([^\|]*)#si';
		if ( preg_match_all( $regex, $str, $params, PREG_SET_ORDER ) > 0 ) {
			foreach ( $params as $param ) {
				$p->$param['1'] = $param['2'];
			}
		}

		if ( isset( $p->href ) ) {		$p->url = $p->href; } else
		if ( isset( $p->link ) ) {		$p->url = $p->href;	}
		if ( isset( $p->w ) ) {			$p->width = $p->w; }
		if ( isset( $p->h ) ) {			$p->height = $p->h; }
		if ( isset( $p->set ) ) {		$p->group = $p->set; } else
		if ( isset( $p->gallery ) ) {	$p->group = $p->gallery; }
		if ( isset( $p->classname ) ) {	$p->class = $p->classname; }

		return $p;
	}

	function isExternal( $url )
	{
		$external = 0;
		if ( !( strpos( $url, '://' ) === false ) ) {
			// hostname: give preference to SERVER_NAME, because this includes subdomains
			$hostname = ( $_SERVER['SERVER_NAME'] ) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
			$external = !( strpos( preg_replace( '#^.*?://#', '', $url ) , $hostname ) === 0 );
		}
		return $external;
	}

	function getFiletype( $url )
	{
		$url = preg_replace( '#^.*?://#', '', $url );
		if ( preg_match( '#^[^\?]*/[^\/\?]*\.([^\/\?]*?)(\?.*)?$#', $url, $match ) ) {
			return $match['1'];
		}
		return '';
	}

	function getClassAndRel( &$class, &$rel, &$params, $tag = '' )
	{
		if ( $tag && $tag->width ) {
			$width = $tag->width;
		} else if ( $params->ismedia ) {
			$width = $this->params->sizes->w_img;
		} else if ( $params->isexternal ) {
			$width = $this->params->sizes->w_ext;
		} else {
			$width = $this->params->sizes->w;
		}

		if ( $tag && $tag->height ) {
			$height = $tag->height;
		} else if ( $params->ismedia ) {
			$height = $this->params->sizes->h_img;
		} else if ( $params->isexternal ) {
			$height = $this->params->sizes->h_ext;
		} else {
			$height = $this->params->sizes->h;
		}

		// CLASS
		switch ( $this->params->modal_type ) {
			case 'colorbox':
			case 'fancybox':
				if ( $params->ismedia ) {
					$class = $this->params->class.'_image';
				} else if ( $params->isexternal ) {
					$class = $this->params->class.'_external';
				}
				break;
			case 'lytebox':
				if ( !$params->ismedia && ( $width || $height ) ) {
					if ( !$width ) {
						$width = $height;
					}
					if ( !$height ) {
						$height = $width;
					}
					$class = '" rev="width:'.(int) $width.'px;height:'.(int) $height.'px;';
				}
				break;
		}

		$group = ( $params->filetype && $this->params->modal_group && $this->params->modal_group_filetypes && in_array( $params->filetype, explode( ',', $this->params->modal_group_filetypes ) ) );

		// REL
		switch ( $this->params->modal_type ) {
			case 'colorbox':
			case 'fancybox':
				if ( $tag && $tag->group ) {
					$rel = $tag->group;
				} else if ( $group ) {
					$rel = $this->params->group;
				}
				break;
			case 'lytebox':
				if ( !$params->ismedia ) {
					$rel = 'lyteframe';
				} else {
					$rel = 'lytebox';
					if ( $tag && $tag->group ) {
						$rel .= '['.$tag->group.']';
					} else if ( $group ) {
						$rel .= '['.$this->params->group.']';
					}
				}
				break;
			case 'shadowbox':
				$rel = 'shadowbox';
				if ( $tag && $tag->group ) {
					$rel .= '['.$tag->group.']';
				} else if ( $group ) {
					$rel .= '['.$this->params->group.']';
				}

				if ( $width ) {
					$rel .= ';width='.(int) $width;
				}
				if ( $height ) {
					$rel .= ';height='.(int) $height;
				}
				break;
			case 'core':
				$r = array();
				if ( !$params->ismedia && ( $params->isexternal || $this->params->modal_iframe ) ) {
					$r[] = 'handler:\'iframe\'';
				}
				if ( !$params->ismedia && ( $width || $height ) ) {
					$r[] = 'size:{'
						.( $width ? 'x:\''.(int) $width.'\',' : '' )
						.( $height ? 'y:\''.(int) $height.'\'' : '' )
						.'}';
				}
				if ( !empty( $r ) ) {
					$rel = '{'.implode( ',', $r ).'}';
				}
				break;
		}
	}

	function initSizes()
	{
		$s = new stdClass();
		$s->w = 0;
		$s->h = 0;
		$s->w_ext = 0;
		$s->h_ext = 0;
		$s->w_img = 0;
		$s->h_img = 0;

		$usepx = in_array( $this->params->modal_type, array( 'core', 'lytebox' ,'shadowbox') );

		if ( $this->params->modal_size ) {
			if ( $usepx ) {
				$s->w = (int) $this->params->modal_width_px;
				$s->h = (int) $this->params->modal_height_px;
			} else {
				$s->w = $this->params->modal_width;
				$s->h = $this->params->modal_height;
			}
		}

		if ( $this->params->modal_ext_size == 2 ) {
				$s->w_ext = $s->w;
				$s->h_ext = $s->h;
		} else if ( $this->params->modal_img_size ) {
			if ( $usepx ) {
				$s->w_ext = (int) $this->params->modal_ext_width_px;
				$s->h_ext = (int) $this->params->modal_ext_height_px;
			} else {
				$s->w_ext = $this->params->modal_ext_width;
				$s->h_ext = $this->params->modal_ext_height;
			}
		}

		if ( $this->params->modal_type != 'shadowbox' || $this->params->modal_img_size == 2 ) {
				$s->w_img = $s->w;
				$s->h_img = $s->h;
		} else if ( $this->params->modal_img_size ) {
			if ( $usepx ) {
				$s->w_img = (int) $this->params->modal_img_width_px;
				$s->h_img = (int) $this->params->modal_img_height_px;
			} else {
				$s->w_img = $this->params->modal_img_width;
				$s->h_img = $this->params->modal_img_height;
			}
		}

		return $s;
	}
}