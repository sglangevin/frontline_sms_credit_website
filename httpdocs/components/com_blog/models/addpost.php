<?php
/**
 * 
 * @package    Joomla
 * @subpackage Components
 * @license    GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

/**
 * Hello Model
 *
 * @package    Joomla
 * @subpackage Components
 */
class BlogModelAddPost extends JModel
{
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * function for Get Post Details
	 **/
	function fncGetMyPostDetails($options=array())
	{
		$db 		=& JFactory::getDBO();
		$id			= @$options['id'];
		$user_id	= @$options['user_id'];
		
		// WHere conditions
		$wheres[] = 'id = ' . (int) $id;
		$wheres[] = 'user_id = ' . (int) $user_id;
		
		$db		=& JFactory::getDBO();				
		$query	= 	'SELECT *
					FROM #__blog_postings
					WHERE '. implode( ' AND ', $wheres );
 		$bloglist = $this->_getList( $query );
		return @$bloglist[0];		
	}
	/**
	 * Method to store a record
 	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{	
		$row =& $this->getTable();
		$data = JRequest::get( 'post' );
		$data['post_desc'] = JRequest::getVar('post_desc', '', 'post', 'string', 2);
		
		// Bind the form fields to the Add form
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the Add Blog record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the post details table to the database
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}

		return true;
	}
 	
	/**
	 * Generate Random ID
	 *
	 **/
	 function fncUid(){
		return sprintf(
				 '%08x-%04x-%04x-%02x%02x-%012x', mt_rand(), mt_rand(0, 65535),	 bindec(substr_replace(sprintf('%016b', mt_rand(0, 65535)), '0100', 11, 4)),
				 bindec(substr_replace(sprintf('%08b', mt_rand(0, 255)), '01', 5, 2)), mt_rand(0, 255), mt_rand() );
	}

	## Thumbnail Creation [With Ratio]
	function imageCompression($imgfile="",$thumbsize=0,$savePath) {
		$this->thumbnail(2, $imgfile, $savePath, $thumbsize, $thumbsize);
		/*
		if($savePath==NULL) {
				header('Content-type: image/jpeg');
		}
		list($width,$height)=getimagesize($imgfile);
		$imgratio=$width/$height; 
		if($imgratio>1) {
				$newwidth=$thumbsize;
				$newheight=$thumbsize/$imgratio;
		} else {
				$newheight=$thumbsize;       
				$newwidth=$thumbsize*$imgratio;
		}
		$thumb=imagecreatetruecolor($newwidth,$newheight); // Making a new true color image

		$source=imagecreatefromjpeg($imgfile); // Now it will create a new image from the source
		imagecopyresampled($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);  // Copy and resize the image
		imagejpeg($thumb,$savePath,100);
		imagedestroy($thumb);
		*/
	}

	/**
	 * Method to Upload Company Logo
	 *
	 **/
	function uploadlogo($id)
	{
		$base = "./components/com_blog/";
		$working_folder =$base."Images/blogimages/";
		$db 		=& JFactory::getDBO();
		if($_FILES["image"]["size"] > 0 ){

			$path = strtolower(strrchr($_FILES["image"]["name"], '.'));
			if(($path!='.jpeg') && ($path!='.jpg') && ($path!='.gif') && ($path!='.png')){
				return 'invalidformat';
			}
			
			if (file_exists($working_folder."th".$_POST["image_old"])) { 
				if($_POST["image_old"]){
					@unlink ($working_folder."th".$_POST["image_old"]);
				}
			}
			
			$filename = strtolower($this->fncUid().'_'.$_FILES["image"]["name"]);
			if(copy($_FILES["image"]["tmp_name"], $working_folder.$filename)){
				$query = "UPDATE #__blog_postings SET post_image = '".$filename."' WHERE id = '".$id."'";
				$db->setQuery( $query );
			 	if (!$db->query()) {
					JError::raiseError(500, $db->getErrorMsg() );
				}
				$source=$working_folder.$filename;
				$dest=$working_folder."th".$filename;
				$this->imageCompression($source,150,$dest);
				@unlink( $source );
			}
		}
	}
	
 	
	function ErrorImage ($text) {
		global $maxw;
		$len 							= 	strlen($text);
		if($maxw < 100) $errw = 100;
		$errh 							= 	25;
		$chrlen 						= 	intval (4 * $len);
		$offset 						= 	intval (($errw - $chrlen) / 2);
		$im 							= 	imagecreate ($errw, $errh); /* Create a blank image */
		$bgc 							= 	imagecolorallocate ($im, 153, 63, 63);
		$tc 							= 	imagecolorallocate ($im, 255, 255, 255);
		imagefilledrectangle ($im, 0, 0, $errw, $errh, $bgc);
		imagestring ($im, 2, $offset, 7, $text, $tc);
		imagejpeg ($im);
		imagedestroy ($im);
		exit;
	}
	function thumbnail ($gdver, $src, $newFile1, $maxw='' ,$maxh='') {
		$gdarr 	= 	array (1,2);
		for ($i=0; $i<count($gdarr); $i++) {
			if ($gdver != $gdarr[$i]) $test.="|";
		}
		$exp 							= 	explode ("|", $test);
		if (count ($exp) == 3) {
			$this->ErrorImage ("Incorrect GD version!");
		}
		if (!function_exists ("imagecreate") || !function_exists ("imagecreatetruecolor")) {
			$this->ErrorImage ("No image create functions!");
		}
		$size = @getimagesize ($src);
		if (!$size) {
			$this->ErrorImage ("Image File Not Found!");
		} else {
			
			$imgratio= $size[0]/$size[1]; 
			if($imgratio>1) {
					$newx=$maxw;
					$newy=$maxw/$imgratio;
			} else {
					$newy=$maxw;       
					$newx=$maxw*$imgratio;
			}
			
			/*
			if ($size[0] > $maxw) {
				#$newx = intval ($maxw);
				$newx=$maxw;
				#$newy = $maxh;
				$newy = intval ($size[1] * ($maxw / $size[0]));
			} else {
			
				#$newx = $size[0];
				$newx=$maxw;
				#$newy = $maxh;
				$newy = $size[1];
			}
			*/
			if ($gdver == 1) {
				$destimg =  imagecreate ($newx, $newy );
			} else {
				$destimg = @imagecreatetruecolor ($newx, $newy ) or die ($this->ErrorImage ("Cannot use GD2 here!"));
			}
			if ($size[2] == 1) {
				if (!function_exists ("imagecreatefromgif")) {
					ErrorImage ("Cannot Handle GIF Format!");
				} else {
					$sourceimg = imagecreatefromgif ($src);
					if ($gdver == 1)
						imagecopyresized ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]);
					else
						@imagecopyresampled ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]) or die (ErrorImage ("Cannot use GD2 here!"));
					imagegif ($destimg, $newFile1);
				}
			}elseif ($size[2]==2) {
				$sourceimg = imagecreatefromjpeg ($src);
				if ($gdver == 1)
					imagecopyresized ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]);
				else
					@imagecopyresampled ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]) or die (ErrorImage ("Cannot use GD2 here!"));
				imagejpeg ($destimg, $newFile1);
				
			}elseif ($size[2] == 3) {
				$sourceimg = imagecreatefrompng ($src);
				if ($gdver == 1)
					imagecopyresized ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]);
				else
					@imagecopyresampled ($destimg, $sourceimg, 0,0,0,0, $newx, $newy, $size[0], $size[1]) or die (ErrorImage ("Cannot use GD2 here!"));
				imagepng ($destimg, $newFile1);
			}else {
				ErrorImage ("Image Type Not Handled!");
			}
		}
		imagedestroy ($destimg);
		imagedestroy ($sourceimg);
	}
}
?>