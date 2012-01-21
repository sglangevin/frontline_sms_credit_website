<?php
/**
 * @version		$Id: utilities.php 510 2010-06-28 13:22:33Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class K2HelperUtilities {

    // Get user avatar
    function getAvatar($userID, $email = NULL, $width = 50) {

    	jimport('joomla.filesystem.folder');
      $params = &JComponentHelper::getParams('com_k2');

/*
      // JomSocial Avatar integration
      if(JFolder::exists(JPATH_SITE.DS.'components'.DS.'com_community') && $userID>0){
				$userInfo = &CFactory::getUser($userID);
				return $userInfo->getThumbAvatar();
      }
*/
			
			// Continue with default K2 avatar determination
      if ($userID == 'alias')
          $avatar = JURI::root().'components/com_k2/images/placeholder/user.png';

      else if ($userID == 0) {
          if ($params->get('gravatar') && !is_null($email)) {
              $avatar = 'http://www.gravatar.com/avatar/'.md5($email).'?s='.$width.'&amp;default='.urlencode(JURI::root().'components/com_k2/images/placeholder/user.png');
          } else {
              $avatar = JURI::root().'components/com_k2/images/placeholder/user.png';
          }
      } else if (is_numeric($userID) && $userID > 0) {

          $db = &JFactory::getDBO();
          $query = "SELECT image FROM #__k2_users WHERE userID={$userID}";
          $db->setQuery($query);
          $avatar = $db->loadResult();
          if ( empty($avatar)) {
              if ($params->get('gravatar') && !is_null($email)) {
                  $avatar = 'http://www.gravatar.com/avatar/'.md5($email).'?s='.$width.'&amp;default='.urlencode(JURI::root().'components/com_k2/images/placeholder/user.png');
              } else {
                  $avatar = JURI::root().'components/com_k2/images/placeholder/user.png';
              }
          } else {
              $avatar = JURI::root().'media/k2/users/'.$avatar;
          }

      }

      if(!$params->get('userImageDefault') && $avatar == JURI::root().'components/com_k2/images/placeholder/user.png')
      	$avatar='';

      return $avatar;
    }

    // Word limit
    function wordLimit($str, $limit = 100, $end_char = '&#8230;') {
      if (trim($str) == '') return $str;
      
      // always strip tags for text
      $str = strip_tags($str);

			$find = array("/\r|\n/","/\t/","/\s\s+/");
			$replace = array(" "," "," ");
      $str = preg_replace($find,$replace,$str);
      
      preg_match('/\s*(?:\S*\s*){'.(int) $limit.'}/', $str, $matches);
      if (strlen($matches[0]) == strlen($str))
          $end_char = '';
      return rtrim($matches[0]).$end_char;
    }
    
    // Character limit
		function characterLimit($str, $limit = 150, $end_char = '...') {
      if (trim($str) == '') return $str;
      
      // always strip tags for text
      $str = strip_tags(trim($str));

			$find = array("/\r|\n/","/\t/","/\s\s+/");
			$replace = array(" "," "," ");
      $str = preg_replace($find,$replace,$str);

			if(strlen($str)>$limit){
				if(function_exists("mb_substr")) {
					$str = mb_substr($str, 0, $limit);
				} else {
					$str = substr($str, 0, $limit);
				}
				return rtrim($str).$end_char;
			} else {
				return $str;
			}

		}

    // Cleanup HTML entities
    function cleanHtml($text){
    	return htmlentities($text, ENT_QUOTES, 'UTF-8');
    }

    // Gender
    function writtenBy($gender) {
      if (is_null($gender))
          return JText::_('WRITTEN_BY');
      if ($gender == 'm')
          return JText::_('WRITTEN_BY_MALE');
      if ($gender == 'f')
          return JText::_('WRITTEN_BY_FEMALE');
    }

    function setDefaultImage(&$item, $view, $params = NULL) {
      if ($view == 'item') {
        $image = 'image'.$item->params->get('itemImgSize');
        $item->image = $item->$image;

        switch ($item->params->get('itemImgSize')) {

            case 'XSmall':
                $item->imageWidth = $item->params->get('itemImageXS');
                break;

            case 'Small':
                $item->imageWidth = $item->params->get('itemImageS');
                break;

            case 'Medium':
                $item->imageWidth = $item->params->get('itemImageM');
                break;

            case 'Large':
                $item->imageWidth = $item->params->get('itemImageL');
                break;

            case 'XLarge':
                $item->imageWidth = $item->params->get('itemImageXL');
                break;
        }
      }

      if ($view == 'itemlist') {
        $image = 'image'.$params->get($item->itemGroup.'ImgSize');
        $item->image = $item->$image;

        switch ($params->get($item->itemGroup.'ImgSize')) {

            case 'XSmall':
                $item->imageWidth = $item->params->get('itemImageXS');
                break;

            case 'Small':
                $item->imageWidth = $item->params->get('itemImageS');
                break;

            case 'Medium':
                $item->imageWidth = $item->params->get('itemImageM');
                break;

            case 'Large':
                $item->imageWidth = $item->params->get('itemImageL');
                break;

            case 'XLarge':
                $item->imageWidth = $item->params->get('itemImageXL');
                break;
        }
      }

      if ($view == 'latest') {
        $image = 'image'.$params->get('latestItemImageSize');
        $item->image = $item->$image;

        switch ($params->get('latestItemImageSize')) {

            case 'XSmall':
                $item->imageWidth = $item->params->get('itemImageXS');
                break;

            case 'Small':
                $item->imageWidth = $item->params->get('itemImageS');
                break;

            case 'Medium':
                $item->imageWidth = $item->params->get('itemImageM');
                break;

            case 'Large':
                $item->imageWidth = $item->params->get('itemImageL');
                break;

            case 'XLarge':
                $item->imageWidth = $item->params->get('itemImageXL');
                break;
        }
      }
    }

} // End Class
