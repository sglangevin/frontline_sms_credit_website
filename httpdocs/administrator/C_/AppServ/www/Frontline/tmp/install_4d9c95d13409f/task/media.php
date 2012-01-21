<?php
(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

global $_MY_CONFIG;
	
// Load the trunchtml library
$this->cms->load('libraries', 'trunchtml');
$this->cms->load('libraries', 'user');
		
// get List of content id by this blogger
$secid = $_MY_CONFIG->get('postSection');
$this->cms->db->query("SELECT `id` FROM #__content WHERE `created_by`='{$cms->user->id}' AND sectionid='{$secid}' ");
$contents = $this->cms->db->get_object_list();
$sections = array();
foreach($contents as $row){
	$sections[] = $row->id;
}
$limitstart = cmsGetVar('limitstart', 'GET');
		
$limit = $limitstart ? "LIMIT $limitstart, ".MY_DEFAULT_LIMIT : 'LIMIT '.MY_DEFAULT_LIMIT;
$this->cms->db->query("SELECT * FROM #__jomcomment WHERE (`option`='com_content' OR `option`='com_myblog') AND `contentid` IN (". implode(',', $sections).") ORDER BY `date` DESC $limit");
$comments = $this->cms->db->get_object_list(); 
		
// Add pagination
$this->cms->load('libraries', 'pagination');
$config = array();
			
$this->cms->db->query("SELECT count(*) FROM #__jomcomment WHERE (`option`='com_content' OR `option`='com_myblog') AND `contentid` IN (". implode(',', $sections).")");
$config['total_rows'] = $this->cms->db->get_value();
$config['base_url'] = $_SERVER['REQUEST_URI'];
$config['per_page'] = MY_DEFAULT_LIMIT;

$this->cms->pagination->initialize($config);
	
$pagination =  $this->cms->pagination->create_links();

$tpl = new AzrulJXTemplate();
$tpl->set('myitemid', myGetItemId());
$tpl->set('pagination', $pagination);
$tpl->set('comments', $comments);

$html = $tpl->fetch(MY_TEMPLATE_PATH."/admin/blogger_media.html");
echo $html;
