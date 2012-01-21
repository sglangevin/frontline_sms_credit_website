<?php
/**
* Comments (for yvComment Joomla! extension) Tab Class for handling the CB tab api
* @version $Id: cbyvcomment.php 19 2010-05-25 15:05:48Z yvolk $
* @package 
* @subpackage cbyvcomment.php
* @author Yuri Volkov
* @copyright (C) Yuri Volkov, http://yurivolkov.com
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
*/

// ensure this file is being included by a parent file
if ( ! ( defined( '_VALID_CB' ) || defined( '_JEXEC' ) || defined( '_VALID_MOS' ) ) ) { die( 'Direct Access to this location is not allowed.' ); }

// Initialize yvComment core + CB once only --------------
getcbyvCommentsTab::InitializeyvComment();

class getcbyvCommentsTab extends cbTabHandler {
	// This is set based on tab parameter
	protected $CommentTypeId = 1;
	// Static member is not compatible with PHP4 :-( 
	private static $_Ok = false; // if false - error state: try to be quiet

	// Static function...
	static function InitializeyvComment() {
		global $mainframe;
		self::$_Ok = false;
		$_ExtensionName = 'yvCommentCBPlugin';
		// Main Release Level. Extensions for the same Release are compatible
		// ToDo: move this var to the class level and make it static (not compatible with PHP4)
		$_Release = '1.25';
	
		// Initialize yvComment solution
		if (!class_exists('yvCommentHelper')) {
			$path = JPATH_SITE . DS . 'components' . DS . 'com_yvcomment' . DS . 'helpers.php';
			if (file_exists($path)) {
			  require_once ($path);
			}
		}
		if (class_exists('yvCommentHelper')) {
			$yvComment = &yvCommentHelper::getInstance(1);
			self::$_Ok = yvCommentHelper::VersionChecks($_ExtensionName, $_Release);
		} else {
			// No yvComment Component
		  $mainframe->enqueueMessage(
			  $_ExtensionName . ' is installed, but "<b>yvComment Component</b>" is <b>not</b> installed. Please install it to use <a href="http://yurivolkov.com/Joomla/yvComment/index_en.html" target="_blank">yvComment solution</a>.<br/>' . '(yvComment Plugin version="' . yvCommentPluginVersion . '")',
		  	'error');
		}

		if (self::$_Ok) {
			if ($mainframe->isAdmin()) {
				// In addition, due to the CB incompatibility
				// with Joomla! 1.5 localization using JText,
				// help CB to translate Admin interface
	CBTxt::addStrings( array(
	'COMMENT_TYPE_ID' => JText::_('COMMENT_TYPE_ID'),
	'DESCRIPTION' => JText::_('DESCRIPTION'),
	'LAYOUT_NAME'	=> JText::_('LAYOUT_NAME'),
	'LAYOUT_NAME_DESC'	=> JText::_('LAYOUT_NAME_DESC'),
	'YVCOMMENT_DESCRIPTION' => JText::_('YVCOMMENT_DESCRIPTION'),
	'LAYOUT_NAME_CUSTOM' => JText::_('LAYOUT_NAME_CUSTOM'),
	'LAYOUT_002' => JText::_('LAYOUT_002'),
	'LAYOUT_003' => JText::_('LAYOUT_003'),
	'LIST_COUNT' => JText::_('LIST_COUNT'),
	'LIST_COUNT_DESC' => JText::_('LIST_COUNT_DESC'),
	'PRIMARY_ORDER' => JText::_('PRIMARY_ORDER'),
	'PRIMARY_ORDER_DESC' => JText::_('PRIMARY_ORDER_DESC'),
	'ORDER_OLDEST_FIRST' => JText::_('ORDER_OLDEST_FIRST'),
	'ORDER_MOST_RECENT_FIRST' => JText::_('ORDER_MOST_RECENT_FIRST'),
	'PARAMMODULECLASSSUFFIX' => JText::_('PARAMMODULECLASSSUFFIX'),
	'MAX_CHARACTERS_LIST_ROW' => JText::_('MAX_CHARACTERS_LIST_ROW'),
	'MAX_CHARACTERS_LIST_ROW_DESC' => JText::_('MAX_CHARACTERS_LIST_ROW_DESC'),
	'RESULT_DAYS' => JText::_('RESULT_DAYS'),
	'RESULT_DAYS_DESC' => JText::_('RESULT_DAYS_DESC'),
	'ALL_RESULTS' => JText::_('ALL_RESULTS'),
	'1_DAY' => JText::_('1_DAY'),
	'7_DAYS' => JText::_('7_DAYS'),
	'2_WEEKS' => JText::_('2_WEEKS'),
	'1_MONTH' => JText::_('1_MONTH'),
	'3_MONTHS' => JText::_('3_MONTHS'),
	'6_MONTHS' => JText::_('6_MONTHS'),
	'1_YEAR' => JText::_('1_YEAR'),
	'SHOW_PAGINATION' => JText::_('SHOW_PAGINATION'),
	'SHOW_PAGINATION_DESC' => JText::_('SHOW_PAGINATION_DESC'),
	'HIDE' => JText::_('HIDE'),
	'SHOW' => JText::_('SHOW'),
	));
			}
		}		

	}	
	
	function getcbyvCommentsTab() {
		global $mainframe;
		
		//$mainframe->enqueueMessage('yvcomment CB Plugin constructor' . '<br/>', 'notice');
		$Ok = self::$_Ok;
		
		if ($Ok) {
			$this->cbTabHandler();
		}
	}
	
	function getDisplayTab($tab, $user, $ui) {
		global $mainframe;
		$strOut = '';
		if (!self::$_Ok) { return $strOut;};

		$params = new JParameter('');
		
		// Create a copy of plugin params
		// and convert CB params to native Joomla format...
		$params->loadINI($this->params->_raw);
		// But this is wrong - different type of objects: 
		//   $params->merge($this->params);

		//No need in this - the tab params are there already!
		//$params->merge($tab->params);

		$this->CommentTypeId = intval($params->get('comment_type_id', $this->CommentTypeId));
		$yvComment = &yvCommentHelper::getInstance($this->CommentTypeId);
		
		global $option;
		$Ok = true;
		$strOut = '';
		$task = 'viewdisplay';

		//$strOut .= '<hr />' . print_r($this->params, true) . '<hr />';
		//$strOut .= '<hr />' . print_r($tab->params, true) . '<hr />';
		//$strOut .= '<hr />' . print_r($params, true) . '<hr />';

		$InstanceInd = $yvComment->BeginInstance('module', $params);

		// Show comments for one user (author of comment) only		
		$yvComment->setPageValue('authoridsfilter', (integer) $user->id);
		
		$viewName = $yvComment->getPageValue('view_name', 'listofcomments');
		$layoutName = $yvComment->getPageValue('layout_name', 'default');
		if ($layoutName == '0') {
			$layoutName = $yvComment->getPageValue('layout_name_custom', 'default');
		}
		JRequest::setVar('layout', $layoutName);

		// Pagination for CB Tab plugin works, but after refresh we are not getting to this tab:
		//   just to the first (default...) 
		$show_pagination = $yvComment->getPageValue('show_pagination', false);	
		if (!$show_pagination) {
		  // Next line doesn't work, because it doesn't really set parameter to 'false':
		  //   $yvComment->setPageValue('show_pagination', false);
		  // And this works:	
		  $yvComment->setPageValue('show_pagination', '0');	
		  // echo 'show_pagination=' . $yvComment->getPageValue('show_pagination', '???') . ';';	
			$limit = intval($yvComment->getPageValue('count', 0));
			if ($limit > 0) {
				$yvComment->setPageValue('yvcomment_limit', $limit);
			}
		}	  	

		if ($Ok) {
			$config = array ();
			$config['task'] = $task;
			$config['view'] = $viewName;
			$config['comment_type_id'] = $this->CommentTypeId;
			
			// This is needed only because we can't 'undefine' this:
			//define( 'JPATH_COMPONENT',					JPATH_BASE.DS.'components'.DS.$name);
			$config['base_path'] = JPATH_SITE_YVCOMMENT;
	
			// Create the controller
			$controller = new yvcommentController($config);
	
			// Perform the Request task
			$controller->execute($task);
	
			$strOut .= $controller->getOutput();
		}
		$yvComment->EndInstance($InstanceInd);

		return $strOut;
	}
	
}	// end class getcbyvCommentsTab.

/**
 * This is required, because CB doesn't allow to have two copies of the same Tab 
 *
 */
class getcbyvCommentsTab2 extends getcbyvCommentsTab {
}
?>