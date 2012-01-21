<?php
/**
 * Element: Slide
 * Element to create a new slide pane
 *
 * @package     NoNumber! Elements
 * @version     2.3.1
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright © 2011 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Slide Element
 */
class JElementSlide extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Slide';

	function fetchTooltip()
	{
		return;
	}

	function fetchElement( $name, $value, &$node )
	{
		$label =		$node->attributes( 'label' );
		$description =	$node->attributes( 'description' );
		$lang_folder =	$node->attributes( 'language_folder' );
		$show_apply =	$node->attributes( 'show_apply' );

		$html = '</td></tr></table></div></div>';
		$html .= '<div class="panel"><h3 class="jpane-toggler title" id="advanced-page"><span>';
		$html .= html_entity_decoder( JText::_( $label ) );
		$html .= '</span></h3>';
		$html .= '<div class="jpane-slider content"><table width="100%" class="paramlist admintable" cellspacing="1"><tr><td colspan="2" class="paramlist_value">';

		if ( $lang_folder ) {
			jimport( 'joomla.filesystem.file' );

			// Include extra language file
			$language =& JFactory::getLanguage();
			$lang = str_replace( '_', '-', $language->_lang );

			if ( strpos( $lang_folder, '/administrator' ) === 0 ) {
				$lang_folder = str_replace( '/', DS, str_replace( '/administrator', JPATH_ADMINISTRATOR, $lang_folder ) );
			} else {
				$lang_folder = JPATH_SITE.str_replace( '/', DS, $lang_folder );
			}

			$inc = '';
			$lang_file = ( $lang_file ? '.'.$lang_file : '' ).'.inc.php';
			if ( JFile::exists( $lang_folder.DS.$lang.DS.$lang.$lang_file ) ) {
				$inc = $lang_folder.DS.$lang.DS.$lang.$lang_file;
			} else if ( JFile::exists( $lang_folder.DS.$lang.$lang_file ) ) {
				$inc = $lang_folder.DS.$lang.$lang_file;
			}
			if ( !$inc && $lang != 'en-GB' ) {
				$lang = 'en-GB';
				if ( JFile::exists( $lang_folder.DS.$lang.DS.$lang.$lang_file ) ) {
					$inc = $lang_folder.DS.$lang.DS.$lang.$lang_file;
				} else if ( JFile::exists( $lang_folder.DS.$lang.$lang_file ) ) {
					$inc = $lang_folder.DS.$lang.$lang_file;
				}
			}
			if ( $inc ) {
				include $inc;
			}
		}

		if ( $description ) {
			$description = html_entity_decoder( JText::_( $description ) );
			$html .= '<div class="panel"><div style="padding: 2px 5px;">';
			if ( $show_apply ) {
				$apply_button = '<a href="#" onclick="submitbutton( \'apply\' );" title="'.JText::_( 'Apply' ).'"><img align="right" border="0" alt="'.JText::_( 'Apply' ).'" src="images/tick.png"/></a>';
				$html .= $apply_button;
			}
			$html .= $description;
			$html .= '<div style="clear: both;"></div></div></div>';
		}

		return $html;
	}

	function def( $val, $default )
	{
		return ( $val == '' ) ? $default : $val;
	}
}

if ( !function_exists( 'html_entity_decoder' ) ) {
	function html_entity_decoder( $given_html, $quote_style = ENT_QUOTES, $charset = 'UTF-8' )
	{
		if ( is_array( $given_html ) ) {
			foreach( $given_html as $i => $html ) {
				$given_html[$i] = html_entity_decoder( $html );
			}
			return $given_html;
		}
		if ( phpversion() < '5.0.0' ) {
			$trans_table = array_flip( get_html_translation_table( HTML_SPECIALCHARS, $quote_style ) );
			$trans_table['&#39;'] = "'";
			return ( strtr( $given_html, $trans_table ) );
		} else {
			return html_entity_decode( $given_html, $quote_style, $charset );
		}
	}
}