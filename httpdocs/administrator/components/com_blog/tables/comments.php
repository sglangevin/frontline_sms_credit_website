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
class TableComments extends JTable
{
	/*  Primary Key *  * @var int  */
	var $id = null;
	
	/*  Foriegn Key *  * @var int  */
	var $user_id = null;

	/*  Foriegn Key *  * @var int  */
	var $post_id = null;

	/* @var string */
	var $comment_title = null;
	
	/* @var string */
	var $comment_desc = null;
	
 	/* @var Date time */
	var $comment_date = null;

	/* @var date time */
	var $comment_update = null;
 	
	/* @var string */
	var $comment_ip = null;

	/* @var int */
	var $comment_hit = null;

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
	function TableComments(& $db) {
		parent::__construct('#__blog_comment', 'id', $db);
	}
}
?>