<?php
/**
 * Blog table class
 * Component Name 	: 	com_blog
 * Created On 		:	March 17, 2009
 * Author			:	Aneesh s(aneesh@aarthikaindia.com) 
 * @package    		:	com_blog
 * @subpackage 		:	Components
 * @license			:	GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Hello Table class
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class TableAddPost extends JTable
{
	/*  Primary Key *  * @var int  */
	var $id = null;
	
	/*  Foriegn Key *  * @var int  */
	var $user_id = null;
	
	/* @var string */
	var $post_title = null;
	
	/* @var string */
	var $post_desc = null;
	
	/* @var string */
	var $post_image = null;

	/* @var Date time */
	var $post_date = null;

	/* @var date time */
	var $post_update = null;
 	
	/* @var string */
	var $post_ip = null;

	/* @var int */
	var $post_hits = null;

	/* @var int */
	var $checked_out = null;
	
	/* @var int */
	var $checked_out_time = null;

	/* String */
	var $published = null;
  
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableAddPost(& $db) {
		parent::__construct('#__blog_postings', 'id', $db);
	}
}
?>