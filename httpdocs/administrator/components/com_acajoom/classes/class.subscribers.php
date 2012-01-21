<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54
class subscribers {

	function userConfirmed($email){
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif
		
		$email = htmlspecialchars($email,ENT_QUOTES);
		$query = "SELECT confirmed FROM `#__acajoom_subscribers` WHERE email = '$email' LIMIT 1" ;
		$database->setQuery($query);
		$confirmed = $database->loadResult();
		if(empty($confirmed)) return false;
		return true;
		
	}
	
	function getSubscribersFromId($qid, $objList = false) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($qid)) {
			$qids = implode (',', $qid);

			if ( empty($qids) ) return '';
			$query = "SELECT A.*, B.username FROM `#__acajoom_subscribers` as A LEFT JOIN `#__users` as B on A.user_id = B.id WHERE A.`id` IN ( $qids )" ;

			$database->setQuery($query);
			$subscribers = $database->loadObjectList();
			$erro->err = $database->getErrorMsg();

			if (!$erro->E(__LINE__ , '8601', $database )) {
				return '';
			} else {
				if (count($subscribers)==1 AND !$objList) {
					$subscriber->id = $subscribers[0]->id ;
					$subscriber->user_id = $subscribers[0]->user_id ;
					$subscriber->name = $subscribers[0]->name ;
					$subscriber->email = $subscribers[0]->email ;
					$subscriber->receive_html = $subscribers[0]->receive_html ;
					$subscriber->confirmed = $subscribers[0]->confirmed ;
					$subscriber->blacklist = $subscribers[0]->blacklist ;
					$subscriber->timezone = $subscribers[0]->timezone ;
					$subscriber->language_iso = $subscribers[0]->language_iso ;
					$subscriber->subscribe_date = $subscribers[0]->subscribe_date ;
					$subscriber->params = $subscribers[0]->params ;
				} else {
					$subscriber = $subscribers;
				}
				return $subscriber;
			}
		} else {
			return '';
		}
	 }


	 function getSubscriberId($date) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'SELECT `id` FROM `#__acajoom_subscribers` WHERE `subscribe_date` = \'' . $date . '\'';
		$database->setQuery($query);
		$id = $database->loadResult();
		$erro->err = $database->getErrorMsg();
		return $erro->Ertrn( __LINE__ , '8603', $database, $id );
	 }


	 function getSubscriberIdFromEmail(&$d) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if ($d['email']) {
			$query = 'SELECT `id` FROM `#__acajoom_subscribers` WHERE `email` = \'' . $d['email'] . '\' LIMIT 1 ';
			$database->setQuery($query);
			$d['subscriberId'] = $database->loadResult();
			$erro->err = $database->getErrorMsg();
		}
		return $erro->Ertrn( __LINE__ , '8605', $database, $d );
	 }


	function getSubscriberIdFromUserId($userId) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($userId))  {
			$query = 'SELECT `id` FROM `#__acajoom_subscribers` WHERE `user_id` = \'' . $userId . '\' LIMIT 1';
			$database->setQuery($query);
			$id = $database->loadResult();
			$erro->err = $database->getErrorMsg();
		}
		return $erro->Ertrn( __LINE__ , '8607', $database, $id );

	 }


	function getSubscriberInfoFromUserId($userId) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if (!empty($userId))  {
			$query = 'SELECT * FROM `#__acajoom_subscribers` WHERE `user_id` = \'' . $userId . '\' LIMIT 1';
	     	$database->setQuery($query);

					if ( ACA_CMSTYPE ) {	// joomla 15
						$subscriber = $database->loadObject();
					} else {									//joomla 1x
						$database->loadObject($subscriber);
					}//endif

			$erro->err = $database->getErrorMsg();
		}
		return $erro->Ertrn( __LINE__ , '8609', $database, $subscriber );

	 }


	 function getSubscribers($start = -1, $limit = -1, $emailsearch, &$total, $listId, $mailingId, $blackList =0 , $confirmed = 0, $order='') {

		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
			$my	=& JFactory::getUser();
		} else {
			global $database, $my;
		}//endif
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$flag = false;
		$limitFlag = false;
	    if ($listId == 0) {
			$query = 'SELECT M.*,U.username FROM `#__acajoom_subscribers` AS M  LEFT JOIN `#__users` as U ON M.user_id = U.id ';
	    } else {
		    $query = 'SELECT M.*,U.username FROM `#__acajoom_subscribers` AS M LEFT JOIN `#__users` as U ON M.user_id = U.id LEFT JOIN `#__acajoom_queue` AS N' .
	    		' ON  M.id = N.subscriber_id  WHERE  N.list_id ='.$listId .' AND  N.published<>2 ';
			$flag = true;
	    }

		if ($mailingId>0 AND $flag) $query .= ' AND N.mailing_id = '.$mailingId;


		if ($listId == 0) {
			if ($blackList == 1) {
				if ($confirmed == 1) {
					$query .= ' WHERE M.blacklist = 0 AND M.confirmed = 1  ';
					$flag = true;
				} else {
					$query .= ' WHERE M.blacklist = 0 ';
					$flag = true;
				}
			}
		} else {
			if ($blackList == 1) {
				if ($confirmed == 1) {
					$query .= ' AND M.blacklist = 0 AND M.confirmed = 1  ';
					$flag = true;
				} else {
					$query .= ' AND M.blacklist = 0 ';
					$flag = true;
				}
			}
		}


		if (!empty($emailsearch)) {
			if ($flag) {
				$query .= ' AND (M.email LIKE \'%' . $emailsearch . '%\' OR M.name LIKE \'%' . $emailsearch . '%\') ';
			} else {
				$query .= ' WHERE M.email LIKE \'%' . $emailsearch . '%\' OR M.name LIKE \'%' . $emailsearch . '%\' ';
			}
		}

		if ( $listId != 0 ) $query .= ' GROUP BY M.id ';

		if (!empty($order)) $query .= acajoom::orderBy($order);

		if ($start != -1 && $limit != -1) {
			$query .= ' LIMIT ' . $start . ', ' . $limit;
			$limitFlag = true;
		}

		$database->setQuery($query);
		$subscribers = $database->loadObjectList();
		$erro->err = $database->getErrorMsg();


		if ($erro->E(__LINE__ , '8611', $database )) {
			if ($limitFlag) {
				$flag = false;

				$query = 'SELECT COUNT(M.id) FROM #__acajoom_subscribers AS M';
				if ($mailingId>0) {
					$query .= ' LEFT JOIN `#__acajoom_queue` AS N  ON  M.id = N.subscriber_id  WHERE  N.mailing_id = '.$mailingId;
					$flag = true;
				} elseif ($listId>0) {
					$query .= ' LEFT JOIN `#__acajoom_queue` AS N  ON  M.id = N.subscriber_id  WHERE N.mailing_id = 0 AND N.list_id = '.$listId;
					$flag = true;
				}

				if (!empty($emailsearch)) {
					if ($flag) {
						$query .= ' AND (M.email LIKE \'%' . $emailsearch . '%\' OR M.name LIKE \'%' . $emailsearch . '%\') ';
					} else {
						$query .= ' WHERE M.email LIKE \'%' . $emailsearch . '%\' OR M.name LIKE \'%' . $emailsearch . '%\' ';
					}
				}

				$database->setQuery($query);
				$total = $database->loadResult();

			} else {
				$total = count($subscribers);
			}
		}

		return $subscribers;

	 }


	function getUserType($userId) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$database->setQuery( "SELECT `usertype` FROM #__users WHERE `id` =".$userId );
		$userType = $database->loadResult();
		$erro->err = $database->getErrorMsg();
		return $erro->Ertrn( __LINE__ , '8613', $database, $userType );

	 }


	function getAdmins() {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = "SELECT S.* FROM `#__acajoom_subscribers` as S ";
		$query .= " LEFT JOIN `#__users` as U ON S.user_id = U.id ";
		$query .= "  WHERE  ( U.usertype = 'superadministrator' ";
		$query .= "  OR  U.usertype  = 'Super Administrator' ";
		$query .= "  OR  U.usertype  = 'super administrator' ) ";
		$database->setQuery( $query );
		$admins = $database->loadObjectList();
		$erro->err = $database->getErrorMsg();
		return $erro->Ertrn( __LINE__ , '8666', $database, $admins );

	}


	function insertOneSubscriber() {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		 $oneSubscriber = '';

		if ( ACA_CMSTYPE ) {	// joomla 15
			 $oneSubscriber->id = intval(JRequest::getVar('subscriber_id', ''));
			 $oneSubscriber->user_id = intval(JRequest::getVar('user_id', ''));
			 $oneSubscriber->name = JRequest::getVar('name', '');
			 $oneSubscriber->email = JRequest::getVar('email', '');
			 $oneSubscriber->receive_html = intval(JRequest::getVar('receive_html', 0));
			 $oneSubscriber->confirmed = intval(JRequest::getVar('confirmed', 0));
			 $oneSubscriber->blacklist = JRequest::getVar('blacklist', 0);
			 $oneSubscriber->timezone = JRequest::getVar('timezone', '');
			 $oneSubscriber->language_iso = JRequest::getVar('language_iso', '');
			 $oneSubscriber->params = JRequest::getVar('params', '');
		} else {									//joomla 1x
			 $oneSubscriber->id = intval(mosGetParam($_REQUEST, 'subscriber_id', ''));
			 $oneSubscriber->user_id = intval(mosGetParam($_REQUEST, 'user_id', ''));
			 $oneSubscriber->name = mosGetParam($_REQUEST, 'name', '');
			 $oneSubscriber->email = mosGetParam($_REQUEST, 'email', '');
			 $oneSubscriber->receive_html = intval(mosGetParam($_REQUEST, 'receive_html', 0));
			 $oneSubscriber->confirmed = intval(mosGetParam($_REQUEST, 'confirmed', 0));
			 $oneSubscriber->blacklist = mosGetParam($_REQUEST, 'blacklist', 0);
			 $oneSubscriber->timezone = mosGetParam($_REQUEST, 'timezone', '');
			 $oneSubscriber->language_iso = mosGetParam($_REQUEST, 'language_iso', '');
			 $oneSubscriber->params = mosGetParam($_REQUEST, 'params', '');
		}//endif


//		 if (!get_magic_quotes_gpc()) {
//		 }

		if ($GLOBALS[ACA.'require_confirmation'] == '1') {
			$oneSubscriber->confirmed = 0;
		}

		$dontParse[] = 'params';
		acajoom::objectHTMLSafe( $oneSubscriber, ENT_QUOTES, $dontParse );

		 $oneSubscriber->subscribe_date = acajoom::getNow();
	    $erro->ck = subscribers::insertSubscriber($oneSubscriber, $subscriberId);
	    $erro->Eck(__LINE__ , '8630');
		if ($GLOBALS[ACA.'require_confirmation'] == '1') {
			$erro->ck = acajoom_mail::sendConfirmationEmail($subscriberId);
		}
		if (!$erro->result) {
			if ($subscriberId<1) return false;
		} else {

			$subscriberId ='';
			$query = 'SELECT `id` FROM `#__acajoom_subscribers` WHERE `email`= \'' . $oneSubscriber->email . '\'';
	     	$database->setQuery($query);
			$subscriberId = $database->loadResult();
			$erro->err = $database->getErrorMsg();
			$erro->E(__LINE__ , '8631', $database );
		 }

		return queue::updateOneSuscription($subscriberId);

	 }


	function insertSubscriber($subscriber, &$subscriberId) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
			JFilterOutput::objectHTMLSafe( $subscriber );
		} else {
			global $database ;
			mosMakeHtmlSafe($subscriber);
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$xf = new xonfig();


		$d['confirm'] = true;
		$d['email'] = $subscriber->email;
		$erro->ck = subscribers::getSubscriberIdFromEmail($d);
		if ($erro->Eck(__LINE__ , '8675')) {
			if ($d['subscriberId']<1) {
				$query = "INSERT INTO `#__acajoom_subscribers` (`name`,`email` , `receive_html` , `confirmed` ";
				$query .= " , `subscribe_date` , `language_iso` , `timezone`, `blacklist` , `params`";
				if(!empty($subscriber->user_id)){
					$query .= " , `user_id` ";
				}
				$query .= ") VALUES (" .
				 " '$subscriber->name' , " .
				 " '$subscriber->email' , " .
				 " '$subscriber->receive_html' , " .
				 " '$subscriber->confirmed' , " .
				 " '$subscriber->subscribe_date', " .
				 " '$subscriber->language_iso', " .
				 " '$subscriber->timezone', " .
				 " '$subscriber->blacklist' , " .
				 " '$subscriber->params' ";
				if(!empty($subscriber->user_id)){
					$query .= " , ".intval($subscriber->user_id);
				}
				$query .= ")" ;
				$database->setQuery($query);
				$database->query();
				$erro->err = $database->getErrorMsg();

				$d['email'] = $subscriber->email;
				if ($erro->E(__LINE__ , '8615', $database )) {
					$erro->ck = subscribers::getSubscriberIdFromEmail($d);
					$erro->Eck(__LINE__ , '8657');

					$d['confirm'] = false;
					$xf->plus('totalsubcribers0', 1);
					$xf->plus('act_totalsubcribers0', 1);
				}
			}
		}
		if ($d['subscriberId']>0) $subscriberId = $d['subscriberId'];
		else $subscriberId = 0;
		return $erro->R();
	 }


	function updateOneSubscriber($userId=0, $user=null, $confirmed='0' ) {
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		 $oneSubscriber = '';


		if ( ACA_CMSTYPE ) {	// joomla 15
			 $oneSubscriber->name = JRequest::getVar('name', '');
			 $oneSubscriber->receive_html = intval(JRequest::getVar('receive_html',0));
			 $oneSubscriber->confirmed = intval(JRequest::getVar('confirmed', 0));
			 $oneSubscriber->blacklist = JRequest::getVar('blacklist', 0);
			 $oneSubscriber->timezone = JRequest::getVar('timezone', '');
			 $oneSubscriber->language_iso = JRequest::getVar('language_iso', '');
			 $oneSubscriber->params = JRequest::getVar('params', '');
			 $oneSubscriber->email = JRequest::getVar('email', '');
		} else {									//joomla 1x
			 $oneSubscriber->name = mosGetParam($_REQUEST, 'name', '');
			 $oneSubscriber->receive_html = intval(mosGetParam($_REQUEST, 'receive_html',0));
			 $oneSubscriber->confirmed = intval(mosGetParam($_REQUEST, 'confirmed', 0));
			 $oneSubscriber->blacklist = mosGetParam($_REQUEST, 'blacklist', 0);
			 $oneSubscriber->timezone = mosGetParam($_REQUEST, 'timezone', '');
			 $oneSubscriber->language_iso = mosGetParam($_REQUEST, 'language_iso', '');
			 $oneSubscriber->params = mosGetParam($_REQUEST, 'params', '');
			 $oneSubscriber->email = mosGetParam($_REQUEST, 'email', '');
		}//endif


		 if ( isset($user) ) {
			$oneSubscriber->email = $user->email;
			if ( empty($oneSubscriber->email) OR !subscribers::validEmail($oneSubscriber->email)) {
				echo '<br />'.acajoom::printM('red' , _ACA_EMAIL_INVALID );
				echo "<script> alert('".addslashes(_ACA_EMAIL_INVALID)."'); window.history.go(-1);</script>\n";
				return false;
			}
			$oneSubscriber->user_id = $user->id;
		 	$oneSubscriber->id = subscribers::getSubscriberIdFromUserId($user->id);
			$subscriberId = $oneSubscriber->id;
			if(!empty($user->name)){
				$oneSubscriber->name = $user->name;
			}
			if($oneSubscriber->confirmed OR $confirmed) $oneSubscriber->confirmed = 1;
			if(isset($user->receive_html)){
				$oneSubscriber->receive_html = $user->receive_html;
			}

		 } elseif ($userId!=0) {
			$oneSubscriber->user_id = $userId;
			$subscriberId = subscribers::getSubscriberIdFromUserId($userId);
		 	$oneSubscriber->id = $subscriberId;
		 } else {
			if ( ACA_CMSTYPE ) {	// joomla 15
				 $oneSubscriber->user_id = intval(JRequest::getVar('id', ''));
				 $subscriberId = intval(JRequest::getVar('subscriber_id', 0));
			} else {									//joomla 1x
				 $oneSubscriber->user_id = intval(mosGetParam($_REQUEST, 'id', ''));
				 $subscriberId = intval(mosGetParam($_REQUEST, 'subscriber_id', 0));
			}//endif
			 $oneSubscriber->id = $subscriberId;
		 }

		$dontParse[] = 'params';
		acajoom::objectHTMLSafe( $oneSubscriber, ENT_QUOTES, $dontParse );
	    $erro->ck = subscribers::updateSubscriber($oneSubscriber, $subscriberId);
		$erro->Eck(__LINE__ , '8635');
	    if ($erro->ck) {

			$erro->ck = queue::updateOneSuscription($subscriberId);
			$erro->Eck(__LINE__ , '8636');
		 }
		return $erro->R();
	 }



	 function updateSubscribers( $force=false, $install=false ) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$time = ( isset($GLOBALS[ACA.'last_sub_update']) && $GLOBALS[ACA.'last_sub_update']>0 ) ? $GLOBALS[ACA.'last_sub_update'] : 200000;
		$newTask= mktime(date("H")-1, date("i"), date("s"), date("m"), date("d"),  date("Y"));

		if ( $force OR ( $newTask > $GLOBALS[ACA.'last_sub_update'] ) ) {
			
			$query = 'UPDATE IGNORE `#__acajoom_subscribers` as S LEFT JOIN `#__users` AS U ON U.`id` = S.`user_id` SET S.`name` = U.`name`, S.`email` = U.`email`, S.`confirmed` = 1 - U.`block`  WHERE U.`id` > 0 AND S.`user_id` > 0';
			$database->setQuery($query);
			$database->query();
		
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$xf = new xonfig();
			$newtime= mktime(date("H", $time), date("i", $time), date("s", $time), date("m", $time), date("d", $time)-2 ,  date("Y", $time));
			if ( $install ) $newtime=0;
			$oneDay = date( 'Y-m-d H:i:s', $newtime );

		    $query = 'SELECT M.* FROM `#__users` AS M ' .
		    		' LEFT JOIN `#__acajoom_subscribers` AS N ON M.email = N.email ';
	    	$query .= ' WHERE M.registerDate > \'' . $oneDay .'\'';
	    	$query .= ' AND  N.id IS NULL AND M.block=0 ';

		    $database->setQuery($query);
		    $rows = $database->loadObjectList();
		    $erro->err = $database->getErrorMsg();
			$erro->E(__LINE__ , '8638', $database );

		    if ($erro->result AND !empty($rows)) {
			   foreach ($rows as $row) {
		 			$query = "INSERT INTO `#__acajoom_subscribers` (`user_id`,`subscribe_date`, `name`,`email`,`confirmed`)";
		 			$query .= " VALUES ( $row->id , '$row->registerDate', '".addslashes($row->name)."', '".addslashes($row->email)."' , 1 ) ";
				    $database->setQuery($query);
		   		 	$database->query();
				    $erro->err = $database->getErrorMsg();
					$xf->plus('totalsubcribers0', 1);
					$xf->plus('act_totalsubcribers0', 1);

			     	$lists = lists::getLists(0, 0, null, '', true, false, false);

			     	if (!empty($lists)) {
					   foreach ($lists as $list) {
						   	 $qid[0] = subscribers::getSubscriberId($row->registerDate);
						   	 $subscriber = subscribers::getSubscribersFromId($qid, false);
						   	 $subId = array();
						   	 if ( isset($subscriber->id) ) {
							   	 $subId[0] =  $subscriber->id;
							   	 $erro->ck = queue::updateQueues($subId, '', $list->id, @$list->acc_id, true);
							   	 $erro->Eck(__LINE__ , '8640');
						   	 }
					   }
			     	}
		  	 	}
		    }

		    $query = 'SELECT M.* FROM `#__acajoom_subscribers` AS M ' .
		    		' LEFT JOIN `#__users` AS N ON N.id = M.user_id ' ;

	    	$query .= ' WHERE N.registerDate > \'' . $oneDay .'\'';
	    	$query .= ' AND M.subscribe_date > \'' . $oneDay .'\'';
		    $query .= ' AND  N.id IS NULL  AND M.user_id>0 ORDER BY N.id ';
		    $database->setQuery($query);
		    $rows = $database->loadObjectList();

		    $erro->err = $database->getErrorMsg();
			$erro->E(__LINE__ , '8641', $database );
		    if ($erro->result AND !empty($rows)) {
			     foreach ($rows as $row) {
				    $query = 'DELETE FROM `#__acajoom_subscribers` WHERE `id` = ' . $row->id;
		   		 	$database->setQuery($query);
			     	$database->query();
				    $erro->err = $database->getErrorMsg();
				    $erro->E(__LINE__ , '8643', $database );
					$xf->plus('act_totalsubcribers0', -1);


				    $erro->ck = queue::deleteSubsQueue($row->id , '');
				    $erro->Eck(__LINE__ , '8644' );
		   		 }
		    }

		    $query = 'SELECT N.id, N.name , N.email , N.block  FROM `#__users` AS N ' .
		    		' LEFT JOIN `#__acajoom_subscribers` AS M ON N.id = M.user_id ' ;

	    	$query .= ' WHERE  N.registerDate > \'' . $oneDay .'\'';
	    	$query .= ' AND M.subscribe_date > \'' . $oneDay .'\'';
	    	$query .= ' AND M.name != N.name  OR M.email != N.email OR N.block = M.confirmed ';

		    $database->setQuery($query);
		    $rows = $database->loadObjectList();

		    $erro->err = $database->getErrorMsg();
			$erro->E(__LINE__ , '8646', $database );
		    if ($erro->result AND !empty($rows)) {
			     foreach ($rows as $row) {
			    	if ($row->block ==1) $status=0; else $status=1;
				    $query = "UPDATE IGNORE `#__acajoom_subscribers` SET `name` ='" .addslashes($row->name) ."' " .
				    		", `email` = '" .addslashes($row->email). "' " .
				    				", `confirmed` ='" .$status ."'  WHERE `user_id` = " . $row->id;
		   		 	$database->setQuery($query);
			     	$database->query();
				    $erro->err = $database->getErrorMsg();
		   		 }

		    }

		    $query = 'SELECT N.id , N.email FROM `#__users` AS N ' ;
		    $query .= 'LEFT JOIN `#__acajoom_subscribers` AS M ON N.email = M.email ' ;

	    	$query .= ' WHERE N.registerDate > \'' . $oneDay .'\'';
	    	$query .= ' AND M.subscribe_date > \'' . $oneDay .'\'';
	    	$query .= ' AND M.user_id = 0 AND N.block = 0 ';

		    $database->setQuery($query);
		    $rows = $database->loadObjectList();
		    $erro->err = $database->getErrorMsg();
		    if ($erro->E(__LINE__ , '8662', $database ) AND !empty($rows)) {
			     foreach ($rows as $row) {
				    $query = "UPDATE `#__acajoom_subscribers` AS S SET `user_id` = " .$row->id ;
				    $query .= " WHERE S.email = '$row->email'" ;
		   		 	$database->setQuery($query);
			     	$database->query();
				    $erro->err = $database->getErrorMsg();
		   		 }

		    }

			$xf->update('last_sub_update', time() );
			return $erro->R();
		}

	}


	 function syncSubscribers($onlyAdd = false) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$xf = new xonfig();
		
		$query = 'UPDATE IGNORE `#__acajoom_subscribers` as S LEFT JOIN `#__users` AS U ON U.`id` = S.`user_id` SET S.`name` = U.`name`, S.`email` = U.`email`, S.`confirmed` = 1 - U.`block` WHERE U.`id` > 0 AND S.`user_id` > 0';
		$database->setQuery($query);
		$database->query();

	    $query = 'SELECT M.* FROM `#__users` AS M ' .
	    		' LEFT JOIN `#__acajoom_subscribers` AS N ON M.email = N.email ' .
	    		' WHERE N.id IS NULL AND M.block=0 AND M.registerDate<>\'0000-00-00 00:00:00\' ORDER BY M.name ';
	    $database->setQuery($query);
	    $rows = $database->loadObjectList();
	    $erro->err = $database->getErrorMsg();
		$erro->E(__LINE__ , '8638', $database );
	    if ($erro->result AND !empty($rows)) {
		   foreach ($rows as $row) {
	 			$query = "INSERT INTO `#__acajoom_subscribers` (`user_id`,`subscribe_date`, `name`,`email`,`confirmed`)";
	 			$query .= " VALUES ( $row->id , '$row->registerDate', '".addslashes($row->name)."', '".addslashes($row->email)."' , 1 ) ";
			    $database->setQuery($query);
	   		 	$database->query();
			    $erro->err = $database->getErrorMsg();
				$erro->E(__LINE__ , '8639', $database );

				$xf->plus('totalsubcribers0', 1);
				$xf->plus('act_totalsubcribers0', 1);


		     	$lists = lists::getLists(0, 0, null, '', true, false, false);


		     	if (!empty($lists)) {
				   foreach ($lists as $list) {

					   	 $qid[0] = subscribers::getSubscriberId($row->registerDate);
					   	 $subscriber = subscribers::getSubscribersFromId($qid, false);

					   	 $subId = array();
					   	 $subId[0] =  $subscriber->id;
					   	 $erro->ck = queue::updateQueues($subId, '', $list->id, @$list->acc_id, true);
					   	 $erro->Eck(__LINE__ , '8640');
				   }
		     	}
	  	 	}

	    }
	    
	    if($onlyAdd) return true;


	    $query = 'SELECT M.* FROM `#__acajoom_subscribers` AS M ' .
	    		' LEFT JOIN `#__users` AS N ON N.id = M.user_id ' .
	    		' WHERE N.id IS NULL AND M.user_id>0 ORDER BY N.id ';
	    $database->setQuery($query);
	    $rows = $database->loadObjectList();
	    $erro->err = $database->getErrorMsg();
		$erro->E(__LINE__ , '8641', $database );
	    if ($erro->result  AND !empty($rows)) {
		     foreach ($rows as $row) {
			    $query = 'DELETE FROM `#__acajoom_subscribers` WHERE `id` = ' . $row->id;
	   		 	$database->setQuery($query);
		     	$database->query();
			    $erro->err = $database->getErrorMsg();
			    $erro->E(__LINE__ , '8643', $database );
				$xf->plus('act_totalsubcribers0', -1);


			    $erro->ck = queue::deleteSubsQueue($row->id , '');
			    $erro->Eck(__LINE__ , '8644' );
	   		 }

	    }


	    $query = 'SELECT N.id, N.name , N.email , N.block  FROM `#__users` AS N ' .
	    		' LEFT JOIN `#__acajoom_subscribers` AS M ON N.id = M.user_id ' .
	    		' WHERE M.name != N.name  OR M.email != N.email OR N.block = M.confirmed';
	    $database->setQuery($query);
	    $rows = $database->loadObjectList();
	    $erro->err = $database->getErrorMsg();
		$erro->E(__LINE__ , '8646', $database );
	    if ($erro->result AND !empty($rows)) {
		     foreach ($rows as $row) {
		    	if ($row->block ==1) $status=0; else $status=1;
			    $query = "UPDATE IGNORE `#__acajoom_subscribers` SET `name` ='" .$row->name ."' " .
			    		", `email` = '" .$row->email. "' " .
			    				", `confirmed` ='" .$status ."'  WHERE `user_id` = " . $row->id;
	   		 	$database->setQuery($query);
		     	$database->query();
			    $erro->err = $database->getErrorMsg();
	   		 }

	    }



	    $query = 'SELECT N.id , N.email FROM `#__users` AS N ' ;
	    $query .= 'LEFT JOIN `#__acajoom_subscribers` AS M ON N.email = M.email ' ;
	    $query .= ' WHERE M.user_id = 0 AND N.block = 0 ';
	    $database->setQuery($query);
	    $rows = $database->loadObjectList();
	    $erro->err = $database->getErrorMsg();
	    if ($erro->E(__LINE__ , '8662', $database ) AND !empty($rows)) {
		     foreach ($rows as $row) {
			    $query = "UPDATE `#__acajoom_subscribers` AS S SET `user_id` = " .$row->id ;
			    $query .= " WHERE S.email = '$row->email'" ;
	   		 	$database->setQuery($query);
		     	$database->query();
			    $erro->err = $database->getErrorMsg();
	   		 }

	    }

	return $erro->R();
	}


	 function updateSubscriber($subscriber, &$subscriberId) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
			JFilterOutput::objectHTMLSafe( $subscriber );
		} else {
			global $database ;
			mosMakeHtmlSafe($subscriber);
		}//endif


		if(!isset($subscriber->params)){
			$subscriber->params = '';
		}
		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		if ($subscriber->id >0 ) {
		   	$query = "UPDATE `#__acajoom_subscribers` SET ";
		   	if(!empty($subscriber->name)){
			$query .=" `name` = '$subscriber->name' , ";
		   	}
		   	if(!empty($subscriber->email)){
				$query .=" `email` = '$subscriber->email' , ";
		   	}
			if($subscriber->receive_html>=0){
				$query.= " `receive_html` = $subscriber->receive_html  , ";
			}
			$query.= " `confirmed` =  $subscriber->confirmed  , " .
			" `timezone` = '$subscriber->timezone' , ";
			if(!empty($subscriber->language_iso)){
				$query.= " `language_iso` = '$subscriber->language_iso' , ";
			}
			if(isset($subscriber->blacklist)){
				$query.= " `blacklist` = $subscriber->blacklist , ";
			}
			$query .= " `params` = '$subscriber->params'  " .
			" WHERE `id` = $subscriber->id ";
	 		$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();

		} else {
			$subscriber->subscribe_date = acajoom::getNow();
			$erro->ck = subscribers::insertSubscriber($subscriber, $subscriberId);
		  	$erro->Eck( __LINE__ , '7625' );
		}

      return $erro->R();
    }

	 function updateReceiveHtml($subscriberId) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
			$htmlReceive =  intval(JRequest::getVar('receive_html',0));
		} else {
			global $database ;
			$htmlReceive =  intval(mosGetParam($_REQUEST, 'receive_html',0));
		}//endif

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );

		if ($subscriberId >0 ) {
		   	$query = "UPDATE `#__acajoom_subscribers` SET ".
			" `receive_html` = $htmlReceive " .
			" WHERE `id` = $subscriberId ";
	 		$database->setQuery($query);
			$database->query();
			$erro->err = $database->getErrorMsg();
		}

		return $erro->err;
    }

	 function deleteOneSubscriber($subscriberId) {

		 if (!subscribers::deleteSubscriber($subscriberId)) {
		      return false;
		 }  else {

			 return queue::deleteSubsQueue($subscriberId , '');
		 }
	}



	 function deleteSubscriber($subId) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		$query = 'DELETE FROM `#__acajoom_subscribers` WHERE `id` = ' . $subId;
		$database->setQuery($query);
		$database->query();
		$erro->err = $database->getErrorMsg();

		if ($erro->E(__LINE__ , '8625', $database )) {
			$xf = new xonfig();
			$xf->plus('act_totalsubcribers0', -1);
		}
		return $erro->R();
	 }


	function import($listId) {

		$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
		@set_time_limit(0);
		@ini_set('memory_limit','128M');
		

		$queue = '';
		if ( ACA_CMSTYPE ) {	// joomla 15
			$queue->sub_list_id = JRequest::getVar('sub_list_id', '');
			$queue->subscribed = JRequest::getVar('subscribed', '');
			$queue->acc_level = JRequest::getVar('acc_level', 29);
		} else {									//joomla 1x
			$queue->sub_list_id = mosGetParam($_REQUEST, 'sub_list_id', '');
			$queue->subscribed = mosGetParam($_REQUEST, 'subscribed', '');
			$queue->acc_level = mosGetParam($_REQUEST, 'acc_level', 29);
		}//endif


		$path = ACA_JPATH_ROOT_NO_ADMIN . $GLOBALS[ACA.'upload_url'];
		$filename = $_FILES['importfile']['name'];
		$path = str_replace(array('/','\\'),DS,$path);

		if (is_writable($path)) {
			if ( !@move_uploaded_file($_FILES['importfile']['tmp_name'], $path . $filename)) {
				$path .= DS;
				if ( !@move_uploaded_file($_FILES['importfile']['tmp_name'], $path . $filename)) {
					echo  _ACA_ERROR_MOVING_UPLOAD ;
					echo '<br/>Please make sure the path '.ACA_JPATH_ROOT_NO_ADMIN . $GLOBALS[ACA.'upload_url'] . ' is writable';
				}
			}

			$import = file_get_contents($path . $filename);
			$import = str_replace(array("\r\n","\r"),"\n",$import);

			$array = explode("\n", $import);

			if (sizeof($array) > 0) {

				foreach ($array AS $row) {
					$row = trim($row);
					if (empty($row)) {
						continue;
					}

					$values = explode(',', $row);
					if(count($values) != 4){
						echo '<br />'.acajoom::printM('red' , $row.' : Acajoom needs 4 arguments for each user separated by a comma (,)' );
						continue;
					}
					$values[0] = trim($values[0]);
					$values[1] = trim($values[1]);

					if ( isset($values[1]) ) {
						$valid = subscribers::validEmail($values[1]);
						if (!$valid) {
							echo '<br />'.acajoom::printM('red' , $values[1] . ': ' . _ACA_EMAIL_INVALID );
							continue;
						} else {
							 $subscriber = null;
							 $values[0] = compa::encodeutf(trim($values[0]));
				 			 $subscriber->name = addslashes($values[0]);
				 			 $subscriber->email = $values[1];
				 			 $subscriber->receive_html  = (empty($values[2])) ? '0' : '1';
				 			 $subscriber->confirmed = (empty($values[3]) AND !$GLOBALS[ACA.'require_confirmation'] ) ? '0' : '1';
				 			 $subscriber->subscribe_date  = acajoom::getNow();
				 			 $subscriber->language_iso  = 'eng';
				 			 $subscriber->timezone  = '00:00:00';
				 			 $subscriber->blacklist  = '0';
				 			 $subscriber->params  = '';
				 			 $d['email'] = $subscriber->email;
				 			 $erro->ck = subscribers::getSubscriberIdFromEmail($d );
							$erro->Eck(__LINE__ , '8679');
				 			 $subscriberId = $d['subscriberId'];

				 			 if ($subscriberId<1) {
								$erro->ck = subscribers::insertSubscriber($subscriber, $subscriberId);
								$erro->Eck(__LINE__ , '8650');
				 			 }
							if (!$erro->ck) {
								echo '<br />'.acajoom::printM('red' , $values[0] . ': ' . _ACA_SUBCRIBER_EXIT );
							} else {
								if (!empty($queue->subscribed) and $subscriberId>0) {
									$queue->user_id = $subscriberId;
									$erro->ck = queue::updateSuscription($queue);
									$erro->Eck(__LINE__ , '8651');

									if ($GLOBALS[ACA.'require_confirmation'] == '1' AND $values[3]== '0') {
										$listIds = array();
										$size = sizeof($queue->sub_list_id);
										for ($index = 0; $index < $size; $index++) {
											if (isset($queue->subscribed[$index])) {
												if ($queue->subscribed[$index]>0) $listIds[]= $queue->sub_list_id[$index];
											}
										}
										$erro->ck = acajoom_mail::processConfirmationEmail($subscriberId, $listIds);
										$erro->Eck(__LINE__ , '8652');
									}
									if ($erro->ck) {
										echo '<br />'.acajoom::printM('green' , $values[0] . ': ' . _ACA_IMPORT_SUCCESS );
									} else {
										echo '<br />'.acajoom::printM('blue' , $values[0] . ': ' . _ACA_PB_QUEUE);
									}
								}
							}
						}
					}
				}
				return true;
			}

			$erro->ck = unlink($path . $filename);
			$erro->Eck(__LINE__ , '8655');
			if (!$erro->ck) {
				echo  _ACA_DELETION_OFFILE . ' ' . $path . $filename . ' ' . _ACA_MANUALLY_DELETE . '.</p>';
			}
		} else {
			echo  _ACA_CANNOT_WRITE_DIR . ' ' . $path . '</p>';
			return false;
		}

	 }


	 function export($listId) {

			$doShowSubscribers = false;
			@set_time_limit(0);
			@ini_set('memory_limit','128M');
			
			if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $HTTP_USER_AGENT)) {
				$UserBrowser = 'Opera';
			} elseif (ereg('MSIE ([0-9].[0-9]{1,2})', $HTTP_USER_AGENT)) {
				$UserBrowser = 'IE';
			} else {
				$UserBrowser = '';
			}

			$mime_type = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ? 'application/octetstream' : 'application/octet-stream';
			$filename = "subscribers_list_" .$listId. "_" . date("Y.d.m");

			ob_end_clean();
			ob_start();

			$subscribers = subscribers::getSubscribers(-1,  -1, '', $total, $listId, '', 1 , 1, 'name');


			$export = 'Name,Email,ReceiveHTML,Registered'."\r\n";
			foreach ($subscribers AS $subscriber) {

				if(get_magic_quotes_runtime()) {
					$subscriber->name = stripslashes($subscriber->name);
					$subscriber->email = stripslashes($subscriber->email);
				}
				$export .= $subscriber->name . '' ;
				$export .= ',' . $subscriber->email . '' ;
				$export .= ',' . $subscriber->receive_html . '' ;
				if ($subscriber->user_id == 0) {
				$export .= ',0' . "\r\n";
				} else {
				$export .= ',1' . "\r\n";
				}
			}


			header('Content-Type: ' . $mime_type);
			header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');

			if ($UserBrowser == 'IE') {
				header('Content-Disposition: inline; filename="' . $filename . '.csv"');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
			} else {
				header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
				header('Pragma: no-cache');
			}

			print $export;
			exit();
			return true;
	 }


	 function updateUserstoAcajoom( $force=false ) {
		if ( ACA_CMSTYPE ) {
			$database =& JFactory::getDBO();
		} else {
			global $database ;
		}//endif


		$time = ( isset($GLOBALS[ACA.'last_sub_update']) && $GLOBALS[ACA.'last_sub_update']>0 ) ? $GLOBALS[ACA.'last_sub_update'] : 10000;
		$newTask= mktime(date("H")-1, date("i"), date("s"), date("m"), date("d")-1 ,  date("Y"));

		if ( $force OR ( $newTask > $GLOBALS[ACA.'last_sub_update'] ) ) {
			$erro = new xerr( __FILE__ , __FUNCTION__ , __CLASS__ );
			$xf = new xonfig();

			$newtime= mktime(date("H", $time)-1, date("i", $time), date("s", $time), date("m", $time), date("d", $time) ,  date("Y", $time));
			$oneDay = date( 'Y-m-d H:i:s', $newtime );

		    $query = 'SELECT M.* FROM `#__users` AS M ' .
		    		' LEFT JOIN `#__acajoom_subscribers` AS N ON M.email = N.email ';

	    	$query .= ' WHERE M.registerDate > \'' . $oneDay .'\'';
	    	$query .= ' AND  N.id IS NULL AND M.block=0 ';

		    $database->setQuery($query);
		    $rows = $database->loadObjectList();

		    $erro->err = $database->getErrorMsg();
			$erro->E(__LINE__ , '8638', $database );

		    if ($erro->result AND !empty($rows)) {
			   foreach ($rows as $row) {
		 			$query = "INSERT INTO `#__acajoom_subscribers` (`user_id`,`subscribe_date`, `name`,`email`,`confirmed`)";
		 			$query .= " VALUES ( $row->id , '$row->registerDate', '$row->name', '$row->email' , 1 ) ";
				    $database->setQuery($query);
		   		 	$database->query();
				    $erro->err = $database->getErrorMsg();

					$xf->plus('totalsubcribers0', 1);
					$xf->plus('act_totalsubcribers0', 1);


			     	$lists = lists::getLists(0, 0, null, '', true, false, false);


			     	if (!empty($lists)) {
					   foreach ($lists as $list) {

						   	 $qid[0] = subscribers::getSubscriberId($row->registerDate);
						   	 $subscriber = subscribers::getSubscribersFromId($qid, false);

						   	 $subId = array();
						   	 $subId[0] =  $subscriber->id;
						   	 $erro->ck = queue::updateQueues($subId, '', $list->id, @$list->acc_id, true);
						   	 $erro->Eck(__LINE__ , '8640');
					   }
			     	}
		  	 	}

		    }
		}
	 }



	 function checkValidKey($subscriberId, $cle) {

		$qid[0] = $subscriberId;
		$subscriber = subscribers::getSubscribersFromId($qid, false);
		if (md5($subscriber->email)==$cle) return true; else return false;

	 }


	 function validEmail($email,$fullCheck = false) {
		if(!preg_match("/^[a-z0-9]([a-z0-9_+\-\.])*@([a-z0-9\-]+\.)+[a-z]{2,7}$/i", $email)) return false;
		
		if(!$fullCheck OR !$GLOBALS[ACA.'fullcheck']) return true;
		
		// gets domain name
		list($user,$domain)=split('@',$email);
		
		// checks for if MX records in the DNS
		//This function does not exist on windows... that's why there is a check first
		//We need to add a dot at the end of the domain name
		if(function_exists('checkdnsrr') AND !checkdnsrr($domain.'.', 'MX')) {
			return false;
		}
		
		return true;
	 }
 }
