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
class TableMyPosts extends JTable
{
	/*  Primary Key *  * @var int  */
	var $id = null;
	
	/*  Foriegn Key *  * @var int  */
	var $user_id = null;
	
	/* @var string */
	var $title = null;
	
	/* @var string */
	var $description = null;
	
	/* @var string */
	var $image = null;

	/* @var Date time */
	var $dateadded = null;

	/* @var date time */
	var $dateupdated = null;
 	
 	/* @var int */
	var $checked_out = null;
	
	/* @var int */
	var $checked_out_time = null;

	/* String */
	var $status = null;
 
	/* String */
	var $published = null;
  
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableMyPosts(& $db) {
		parent::__construct('#__blog_myaccount', 'id', $db);
	}
}
?>