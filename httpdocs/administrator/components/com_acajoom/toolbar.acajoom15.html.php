<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die('...Direct Access to this location is not allowed...');
### Copyright (C) 2006-2009 Acajoom Services. All rights reserved.
### http://www.ijoobi.com/index.php?option=com_content&view=article&id=12&Itemid=54
class mosMenuBarCustom {
	function cancel( $alt='Cancel', $href='' ) {
		compa::showIcon('cancel.png','back','cancel');
		compa::showIcon('cancel_f2.png','back','cancel',0);
		if ( $href ) {
   			$link = $href;
   		} else {
 			$link = 'javascript:window.history.back();';
		}
		?>
		<td>
  			<a class="toolbar" href="<?php echo $link; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('cancel','','<?php echo $image2; ?>',1);">
			<?php echo $image; ?>
			<?php echo $alt;?>
  		</a>
		</td>
		<?php
	}
}

 class menuAcajoom {
	 function REGISTERED() {
		// // // // mosMenuBar::endTable();
		JToolBarHelper::custom('export', 'archive.png', 'archive_f2.png', _ACA_MENU_EXPORT , false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('import', 'upload.png', 'upload_f2.png', _ACA_MENU_IMPORT , false);
		JToolBarHelper::spacer(50);
		JToolBarHelper::addNewX();
		JToolBarHelper::spacer();
		JToolBarHelper::editListX();
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList('' , 'delete');
		JToolBarHelper::spacer(50);
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// mosMenuBar::endTable();
	 }
	 function SHOWSUBSCRIBER() {
		// // // // mosMenuBar::endTable();
		JToolBarHelper::custom('updateOneSub', 'save.png', 'save_f2.png', _ACA_UPDATE , false);
		//JToolBarHelper::spacer(50);
		//JToolBarHelper::deleteList('' , 'deleteOneSub');
		JToolBarHelper::spacer(50);
		JToolBarHelper::custom('cancelSub', 'cancel.png', 'cancel_f2.png', _ACA_CANCEL , false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// mosMenuBar::endTable();
	 }
	 function NEWSUBSCRIBER() {
		// // // // mosMenuBar::endTable();
		JToolBarHelper::save('doNew', _ACA_SAVE );
		JToolBarHelper::spacer(50);
		JToolBarHelper::custom('cancelSub', 'cancel.png', 'cancel_f2.png', _ACA_CANCEL , false);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// mosMenuBar::endTable();
	 }
	 function IMPORT() {
		// // // // mosMenuBar::endTable();
		JToolBarHelper::custom('doImport', 'upload.png', 'upload_f2.png', _ACA_MENU_IMPORT , false);
		JToolBarHelper::spacer(50);
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// mosMenuBar::endTable();
	 }
	 function EXPORT() {
		// // // // mosMenuBar::endTable();
		JToolBarHelper::custom('doExport', 'archive.png', 'archive_f2.png', _ACA_MENU_EXPORT , false);
		JToolBarHelper::spacer(50);
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// mosMenuBar::endTable();
	 }
	 function SHOW_LIST() {


			// // // // mosMenuBar::endTable();
			if (class_exists('pro'))
				JToolBarHelper::custom('forms','html.png','html_f2.png', _ACA_FORM_BUTTON ,false);
//				JToolBarHelper::customX( 'copyselect', 'copy.png', 'copy_f2.png', 'Copy', true );
			JToolBarHelper::spacer(50);
			JToolBarHelper::custom('publish','publish.png','publish_f2.png', _ACA_PUBLISHED ,true);
			JToolBarHelper::spacer();
			JToolBarHelper::custom('unpublish','publish.png','publish_f2.png', _ACA_UNPUBLISHED ,true);
			JToolBarHelper::spacer(50);
			JToolBarHelper::addNewX();
//		JToolBarHelper::addNewX();
			JToolBarHelper::spacer();
			JToolBarHelper::editListX();
//		JToolBarHelper::editListX();
			JToolBarHelper::spacer();
			JToolBarHelper::custom( 'copy', 'copy.png', 'copy_f2.png', _ACA_MENU_COPY , true);
			JToolBarHelper::spacer();
			JToolBarHelper::deleteList('' , 'delete');
//		JToolBarHelper::deleteList();
			JToolBarHelper::spacer(50);
			JToolBarHelper::back();
			JToolBarHelper::spacer();
			JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
			// // mosMenuBar::endTable();
	 }
	 function EDIT_LIST($task) {

		// // // // // mosMenuBar::endTable();
		JToolBarHelper::save('update', _ACA_SAVE );
		JToolBarHelper::spacer(50);
		JToolBarHelper::cancel($task);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function NEW_LIST($task) {

		// // // // // mosMenuBar::endTable();
		JToolBarHelper::save('doNew', _ACA_SAVE );
		JToolBarHelper::spacer(50);
		JToolBarHelper::cancel($task);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function SHOW_MAILINGS() {
		// // // // // mosMenuBar::endTable();
		//JToolBarHelper::custom('publishMailing','publish.png','publish_f2.png', _ACA_PUBLISHED ,true);
		//JToolBarHelper::spacer();
		JToolBarHelper::custom('unpublishMailing','publish.png','publish_f2.png', _ACA_UNPUBLISHED ,true);
		JToolBarHelper::spacer(50);
		JToolBarHelper::custom('preview', 'preview.png', 'preview_f2.png', _ACA_MENU_PREVIEW , true );
		$listype = 0;
		if (isset($_GET['listype'])){ $listype = $_GET['listype']; }
		elseif (isset($_POST['droplist'])){ $maliste = explode('-',$_POST['droplist']); $listype = $maliste[0];}
		elseif (isset($_POST['listid'])){
			$maliste = lists::getLists($_POST['listid'],0,null,'listnameA',false,false,false,false);
			$listype = $maliste[0]->list_type;
		}
		if ($listype==1) {
			JToolBarHelper::spacer(50);
			JToolBarHelper::custom('sendNewsletter','forward.png','forward_f2.png', _ACA_MENU_SEND ,true);
		}
		JToolBarHelper::spacer(50);
		JToolBarHelper::addNewX();
		JToolBarHelper::spacer();
		JToolBarHelper::editListX();
		JToolBarHelper::spacer();
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList('' , 'deleteMailing');
		JToolBarHelper::spacer(50);
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function NEWMAILING() {
		// // // // // mosMenuBar::endTable();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('savePreview', 'preview.png', 'preview_f2.png', _ACA_MENU_PREVIEW , false);
		$listype = 0;
		if (isset($_GET['listype'])){ $listype = $_GET['listype']; }
		elseif (isset($_POST['droplist'])){ $maliste = explode('-',$_POST['droplist']); $listype = $maliste[0];}
		elseif (isset($_POST['listype'])){ $listype = $_POST['listype'];}
		elseif (isset($_GET['listid'])){
			$maliste = lists::getLists($_GET['listid'],0,null,'listnameA',false,false,false,false);
			$listype = $maliste[0]->list_type;
		}

		if ($listype==1) {
			JToolBarHelper::spacer(50);
			JToolBarHelper::custom('saveSend','forward.png','forward_f2.png', _ACA_MENU_SEND ,false);
		}
		JToolBarHelper::spacer(50);
		JToolBarHelper::save();
		JToolBarHelper::spacer();
		JToolBarHelper::spacer(50);
		JToolBarHelper::cancel('show');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function PREVIEWMAILING($task) {
		// // // // // mosMenuBar::endTable();
		JToolBarHelper::custom('preview', 'forward.png', 'forward_f2.png', _ACA_MENU_SEND_TEST , false);
		JToolBarHelper::spacer(50);
		JToolBarHelper::cancel('show');
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function CONFIGURATION() {
		// // // // // mosMenuBar::endTable();
		if (class_exists('aca_archive') ) {
			JToolBarHelper::custom('archiveAll', 'unarchive.png', 'unarchive_f2.png', _ACA_MENU_ARCHIVE_ALL, false);
			JToolBarHelper::spacer(50);
		}
		if ( class_exists('autonews') ) {
			JToolBarHelper::custom('reset','move.png','move.png', 'Reset S.N. Counter' ,false);
			JToolBarHelper::spacer(50);
		}
		if (class_exists('auto')) $flag = auto::viewCron(); else $flag = false;
		if ($flag) {
			JToolBarHelper::custom('sendQueue','forward.png','forward_f2.png', _ACA_MENU_SEND_QUEUE ,false);
			JToolBarHelper::spacer(50);
		}
		if ( $GLOBALS[ACA.'type'] =='Plus' OR $GLOBALS[ACA.'type']=='PRO' ) {
			JToolBarHelper::custom('syncUsers','addusers.png','addusers.png', _ACA_MENU_SYNC_USERS ,false);
			JToolBarHelper::spacer(50);
		}
		JToolBarHelper::save();
		JToolBarHelper::spacer();
		JToolBarHelper::apply();
		JToolBarHelper::spacer(50);
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function CANCEL_ONLY($task) {
		// // // // // mosMenuBar::endTable();
		JToolBarHelper::cancel($task);
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function STATISTICS() {
		// // // // // mosMenuBar::endTable();
		JToolBarHelper::custom('view', 'move.png', 'move_f2.png', _ACA_MENU_VIEW_STATS, true);
		JToolBarHelper::spacer(50);
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function UPDATE() {
		// // // // // mosMenuBar::endTable();
		/*JToolBarHelper::custom('complete', 'upload.png', 'upload_f2.png', _ACA_CHECK , false);
		JToolBarHelper::spacer(50);
		JToolBarHelper::cancel();
			*/
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function DOUPDATE() {

		// // // // // mosMenuBar::endTable();
	 /*
		JToolBarHelper::custom('doUpdate', 'upload.png', 'upload_f2.png', _ACA_UPDATE , false);
		JToolBarHelper::spacer(50);
		JToolBarHelper::cancel();
		*/
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// // mosMenuBar::endTable();
	 }
	 function ABOUT() {
		// // // mosMenuBar::endTable();
		JToolBarHelper::back();
		JToolBarHelper::spacer();
		JToolBarHelper::custom('cpanel', 'tool.png', 'tool_f2.png', _ACA_MENU_CPANEL, false);
		// mosMenuBar::endTable();
	 }
 }
