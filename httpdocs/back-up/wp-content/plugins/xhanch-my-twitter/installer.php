<?php
	// require_once(ABSPATH . 'wp-admin/upgrade.php');

	global $wpdb;
	global $xmt_accounts;
	global $xmt_default;
	
	$wpdb->query("delete from ".$wpdb->prefix."options where option_name like='%xhanch_my_twitter%'");
		
	$xmt_accounts = get_option('xmt_accounts');
	if($xmt_accounts === false){
		$xmt_accounts = array();	
		add_option('xmt_accounts', $xmt_accounts);
	}else{			
		foreach($xmt_accounts as $acc=>$acc_set){
			$acc_set['general']['show_credit'] = 1;
			$xmt_res = array_merge($xmt_default, $acc_set);
			$xmt_accounts[$acc] = $xmt_res;
		}
		update_option('xmt_accounts', $xmt_accounts);
	}
	
	if(count($xmt_accounts) == 0){
		$xmt_accounts['primary'] = $xmt_default;
		update_option('xmt_accounts', $xmt_accounts);
	}
?>