<?php

// Used for first-time initialization 
// create tables if not present...
function counterize_install()
{ 
	update_option('counterize_logbots', "disabled");
	
  $MajorVersion = get_option('counterize_MajorVersion');
  $MinorVersion = get_option('counterize_MinorVersion');
  
  $wpdb =& $GLOBALS['wpdb'];
  
  if($MajorVersion < 2)
  {
    $sql = 'SHOW TABLES LIKE \'' . counterize_logTable() . '\'';
    $results = $wpdb->query($sql);
  
    if ($results == 0)
    {
      // Update to Version 1
      $sql = "create table ".counterize_logTable()."
          (
            id integer not null auto_increment,
            `IP` varchar(16) NOT NULL,
            `timestamp` datetime NOT NULL,
          	url varchar(255) not null default 'unknown',
          	referer varchar(255) not null default 'unknown',
            useragent text,
            primary key(id)
          )";
      
      $results = $wpdb->query($sql);
    }
    
    // update to Version 2
    $sql = "ALTER TABLE `".counterize_logTable()."` ADD `pageID` INT( 11 ) NOT NULL;"; 
    $wpdb->query($sql);
    
    $sql = "ALTER TABLE `".counterize_logTable()."` ADD `agentID` INT( 11 ) NOT NULL;";
    $wpdb->query($sql);
     
    $sql = "ALTER TABLE `".counterize_logTable()."` ADD `refererID` INT( 11 ) NOT NULL;";
    $wpdb->query($sql);
          
    $sql = "CREATE TABLE `".counterize_pageTable()."` (
        `pageID` int(11) NOT NULL auto_increment,
        `url` varchar(255) NOT NULL,
        `count` int(11) NOT NULL default '1',
        `postID` bigint(20) default NULL,
        PRIMARY KEY  (`pageID`),
        KEY `url` (`url`),
        KEY `count` (`count`)
      )";
    $wpdb->query($sql);
      
    $sql ="CREATE TABLE `".counterize_refererTable()."` (
        `refererID` int(11) NOT NULL auto_increment,
        `name` varchar(255) NOT NULL,
        `count` int(11) NOT NULL default '1',
        PRIMARY KEY  (`refererID`),
        KEY `name` (`name`),
        KEY `count` (`count`)
      )";
    $wpdb->query($sql);
      
    $sql = "CREATE TABLE `".counterize_agentsTable()."` (
        `agentID` int(11) NOT NULL auto_increment,
        `name` varchar(255) NOT NULL,
        `count` int(11) NOT NULL default '1',
        PRIMARY KEY  (`agentID`),
        KEY `name` (`name`),
        KEY `count` (`count`)
      ) ";
    $wpdb->query($sql);
      
    $sql = "INSERT INTO `".counterize_pageTable()."` (url,count)
        SELECT 
          url, count(url) 
        FROM `" .counterize_logTable()."`
        GROUP BY url;";
    $wpdb->query($sql);
        
    $sql = "INSERT INTO `".counterize_refererTable()."` (name,count)
        SELECT 
          referer, count(referer) 
        FROM `".counterize_logTable()."`
        GROUP BY referer;";
    $wpdb->query($sql);
        
    $sql = "INSERT INTO `".counterize_agentsTable()."` (name,count)
        SELECT 
          useragent, count(useragent) 
        FROM `".counterize_logTable()."`
        GROUP BY useragent;";      
    $wpdb->query($sql);
    
    $entries = $wpdb->get_results("Select * from ".counterize_logTable());
    foreach ($entries as $entry)
    {
      $pageID = $wpdb->get_var("Select pageID from `".counterize_pageTable()."` where url='" . $entry->url . "'");
      $agentID = $wpdb->get_var("Select agentID from `".counterize_agentsTable()."` where name='" . $entry->useragent ."'");
      $refererID = $wpdb->get_var("Select refererID from `".counterize_refererTable()."` where name='" . $entry->referer ."'");
      if (!$pageID)
        $pageID = "null";
      if (!$agentID)
        $agentID = "null";
      if (!$refererID)
        $refererID = "null";        
      $sql = "update `".counterize_logTable()."` set pageID = $pageID, agentID = $agentID, refererID = $refererID where id = " . $entry->id;
      $wpdb->query($sql);
    }
    
    $sql = "ALTER TABLE `".counterize_logTable()."` DROP `url`;";
    $wpdb->query($sql);
    
    $sql = "ALTER TABLE `".counterize_logTable()."` DROP `useragent`;";
    $wpdb->query($sql);
    
    $sql = "ALTER TABLE `".counterize_logTable()."` DROP `referer`;";
    $wpdb->query($sql); 
  }
  
  // now we have Version 2
  if($MinorVersion < 4) 
  {
    update_option('counterize_whois','http://ws.arin.net/cgi-bin/whois.pl?queryinput=');
        
    $sql = "CREATE TABLE `".counterize_keywordTable()."` (
              `keywordID` int(11) NOT NULL auto_increment,
              `keyword` varchar(255) NOT NULL,
              `count` int(11) NOT NULL default '1',
              PRIMARY KEY  (`keywordID`),
              KEY `keyword` (`keyword`)
            );";
    $wpdb->query($sql);
    
    $sql = "ALTER TABLE `".counterize_refererTable()."` ADD `keywordID` INT( 11 ) NOT NULL ;";
    $wpdb->query($sql);    
    
    $referers = $wpdb->get_results("Select * from `".counterize_refererTable()."`");
    foreach ($referers as $referer)
    { 
    		$keywordID = counterize_getKeywordID($referer->name);
    		$wpdb->query("update ".counterize_refererTable()." set keywordID = $keywordID where refererID=".$referer->refererID);  
    		$wpdb->query("update ".counterize_keywordTable()." set count = count + ".$referer->count." where keywordID=".$keywordID);
    }
  } 
  
  if($MinorVersion < 8) 
  {
    update_option('counterize_maxWidth',50);
    
    $sql = "ALTER TABLE `".counterize_agentsTable()."` ADD `browserName` VARCHAR( 255 ) NOT NULL ;";
    $wpdb->query($sql);    
    
    $sql = "ALTER TABLE `".counterize_agentsTable()."` ADD `browserCode` VARCHAR( 255 ) NOT NULL ;";
    $wpdb->query($sql);
    
    $sql = "ALTER TABLE `".counterize_agentsTable()."` ADD `browserVersion` VARCHAR( 255 ) NOT NULL ;";
    $wpdb->query($sql);   
    
    $sql = "ALTER TABLE `".counterize_agentsTable()."` ADD `osName` VARCHAR( 255 ) NOT NULL ;";
    $wpdb->query($sql);    
    
    $sql = "ALTER TABLE `".counterize_agentsTable()."` ADD `osCode` VARCHAR( 255 ) NOT NULL ;";
    $wpdb->query($sql);
    
    $sql = "ALTER TABLE `".counterize_agentsTable()."` ADD `osVersion` VARCHAR( 255 ) NOT NULL ;";
    $wpdb->query($sql);       
    
    counterize_update_all_userAgents();                
  }
  
  if($minorVersion < 12)
  {
    $sql = "ALTER TABLE `".counterize_logTable()."` ADD INDEX ( `timestamp` );";
    $wpdb->query($sql);     
  }
  
  if($minorVersion < 13)
  {
    $sql = "UPDATE `".counterize_logTable()."` set IP=MD5(IP);" ;
    $wpdb->query($sql);     
  }
  
  // Set new Version
  update_option('counterize_MajorVersion',2);
  update_option('counterize_MinorVersion',13);
}
?>
