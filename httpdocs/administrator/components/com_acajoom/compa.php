<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
global $_VERSION;

class compa{

	function completeLink(&$link,$back = true,$sef = true){
		if($link == "#") return;
		
		if(ACA_CMSTYPE){
			if($back){
				$link = 'index'.$link;
			}else{
				$rest = 'index'.$link;
				if($sef){
					$rest = ltrim(JRoute::_($rest),'/');
				}
				if(ACA_URL_MORE AND strpos($rest,ACA_URL_MORE) === false){
					$rest = ACA_URL_MORE.$rest;
				}
				$link = ACA_COMPLETE_URL.$rest;
			}
		}else{
			if($back){
				$link = ACA_JPATH_LIVE.'/administrator/index2'.$link;
			}else{
				if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) {
					$link = sefRelToAbs('index'.$link);
				}else{
					$link = ACA_JPATH_LIVE.'/index'.$link;
				}
			}
		}
	}

	function showIcon($image,$text,$text2 = '',$option = 1){
		if(ACA_CMSTYPE){
			echo '<img alt="'.$text.'" src="'.ACA_JPATH_LIVE.'/administrator/images/'.$image.'"/>';
		}
		else{
			echo mosAdminMenus::imageCheckAdmin( $image, '/administrator/images/', NULL,NULL, $text,$text2,$option );
		}
	}

	function toolTip($tooltip, $title='', $width='', $image='tooltip.png', $text='', $href='', $link=1){

		global $mainframe;
			
		if($GLOBALS[ACA.'disabletooltip'] AND !$mainframe->isAdmin()){
			$text = str_replace(array("'",'"'),array("&#039;",'&quot;'),$text);
			$title = str_replace(array("'",'"'),array("&#039;",'&quot;'),$title);
			
			$return = '<span class="editlinktip">';
			if(!empty($href) AND !preg_match("/#/",$href)){
				$return .='<a href="'. $href .'">';
			}
			$return .= $text ;
			if(!empty($href) AND !preg_match("/#/",$href)){
				$return .='</a>';
			}
			$return .= '</span>';
			
			return $return;
		}
		
		if(ACA_CMSTYPE){
			$text = str_replace(array("'",'"'),array("&#039;",'&quot;'),$text);
			$title = str_replace(array("'",'"'),array("&#039;",'&quot;'),$title);
			
			if(preg_match("/#/",$href)){
				$href = null;
			}
			return JHTML::_('tooltip', $tooltip, $title, $image, $text, $href, $link);
		}else{
			if ( $GLOBALS[ACA.'use_sef'] AND function_exists('sefRelToAbs') ) $href = sefRelToAbs($href);
			return mosToolTip( htmlspecialchars($tooltip, ENT_QUOTES), addslashes($title), $width, $image, $text, $href, $link);
		}
	}

	function allow_html(){
		if(ACA_CMSTYPE){
			return JREQUEST_ALLOWRAW; 
		}else{
			return _MOS_ALLOWHTML;
		}
	}

	function redirect($link, $message = ''){
		global $mainframe;
		if(ACA_CMSTYPE){
			$mainframe->redirect( $link, trim($message) );
			exit;
		}else{
			if ( !preg_match("/index2/",$link) AND function_exists('sefRelToAbs') AND $GLOBALS[ACA.'use_sef'] ) {
				$link = sefRelToAbs($link);
			}
			mosRedirect($link, trim($message));
			exit;
		}
	}

	function encodeutf($string){
		if(ACA_CMSTYPE){
			return utf8_encode($string);
		}else{
			return $string;
		}
	}
}
