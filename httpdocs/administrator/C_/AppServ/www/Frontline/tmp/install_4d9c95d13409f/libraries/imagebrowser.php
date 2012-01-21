<?php
(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

// If the memory limit is too low, increase it 
if(ini_get('memory_limit') == '8M')
	@ini_set('memory_limit', '16M');

jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.folder' );
include_once(MY_LIBRARY_PATH . '/mediabrowser.php');

class MYMediaBrowser extends MYMedia{
	var $extension			= '';
	var $imagePath			= '';
	
	var $_thumbnail			= array(
										'width'		=> '44',
										'folder'	=> '',
										'folderup'	=> '',
										'unknown'	=> '' 
									);
	var $_allowedExtensions = array( 
										'GIF', 'JPG', 'JPEG', 'PNG','SWF','PSD',
										'BMP','TIFF','TIFF','JPC','JP2','ICO',
										'JPX','JB2','SWC','IFF','WBMP','XBM'
									);
	var $_imageExtensions	= array( 'jpeg', 'gif', 'png', 'gd', 'gd2',
									'im','xbm','xpm');
	var $_cache				= '';
	
	// Key are the extensions and value should represent their thumbnails
	var $_documents			= array(
										'pdf'	=> '',	// PDF
										'doc'	=> '',	// Word
										'xls'	=> '',	// Excel 
										'ppt'	=> '',	// Powerpoint
										'log'	=> '',	// Log files
										'txt'	=> '',	// Text files
										'rtf'	=> '',	// Rich Txt Format
										'xml'	=> ''	// XML
									);

	function MYMediaBrowser($filepath = ''){
		parent::MYMedia();
		$this->imagePath	= urldecode($filepath);
		$this->_cache		= MY_CACHE_PATH;
		
		$this->_thumbnail['folder']		= MY_COM_LIVE . '/images/bigfolder.gif';
		$this->_thumbnail['folderup']	= MY_COM_LIVE . '/images/folderup.gif';
		$this->_thumbnail['unknown']	= MY_COM_LIVE . '/images/files.png';

		// Configure here to set the thumbnails for the extensions
		$this->_documents['pdf']	= MY_COM_LIVE . '/images/pdf.gif';
		$this->_documents['doc']	= MY_COM_LIVE . '/images/text.gif';
		$this->_documents['log']	= MY_COM_LIVE . '/images/text.gif';
		$this->_documents['txt']	= MY_COM_LIVE . '/images/text.gif';
		$this->_documents['rtf']	= MY_COM_LIVE . '/images/text.gif';
		$this->_documents['xls']	= MY_COM_LIVE . '/images/excel.gif';
		$this->_documents['xlsx']	= MY_COM_LIVE . '/images/excel.gif';
		$this->_documents['ppt']	= MY_COM_LIVE . '/images/ppt.gif';
		$this->_documents['pptx']	= MY_COM_LIVE . '/images/ppt.gif';
	}

	function upload($file, $resize = false)
	{
		global $_MY_CONFIG;

		$fileName	= JString::strtolower($file['name']);
		$save		= $this->media . '/' . $file['name'];
		
		$error		= '';
		$msg		= '';
		
		if(strpos(strtolower($_MY_CONFIG->get('allowedUploadFileType')), substr($fileName, -3)) === false)
		{
			$error	= 'The file must have an extension of ' . $_MY_CONFIG->get('allowedUploadFileType'); 
		}
		
		if($file['size'] >= ($_MY_CONFIG->get('uploadSizeLimit') * 1024))
		{
			$error	= 'File size too large.';
		}
		
		if(file_exists($save))
		{
			$error	= 'File exists.';
		}
		
		if(empty($error))
		{
			if(!JFile::move($file['tmp_name'], $save) )
			{
				$error	= JText::sprintf( 'Error while moving files from temporary folder %1$s' , $file['tmp_name'] );
			}
		}

		$msg	= '';
		
		// Resize images
		if( empty( $error ) )
		{
			if($_MY_CONFIG->get('enableImageResize') && $_MY_CONFIG->get('maxWidth') && $resize == '1' )
			{
				$image		= $this->_resize($save, $_MY_CONFIG->get('maxWidth'));
				
				// Get the mime type for this image.
			 	$mimetype	= $this->_readImage($save, true);
			 	
				// Save new image
				ob_start();
		
				if ($mimetype == "gif"){
					imagegif ($image);
				}
				else if ($mimetype == "png"){
					imagepng ($image, '', 7);
				}
				else{
					imagejpeg ($image, '', 80);
				}
				$content	= ob_get_contents();
				while( @ob_end_clean() );
		
				// Remove old image
				@unlink($save);
			
				$this->_write($save, $content);
			}
			$msg	= 'File ' . $file['name'] . ' uploaded successfully.';
			
			// For security reason, we force to remove all uploaded file
			JFile::delete($file['tmp_name']);
		}
				
		return array('error' => $error, 'msg' => $msg , 'source' => $this->mediaURI . '/' . $file['name'] );
	}
	
	function _getHeaderType($extension = 'bmp'){
		$headers		= 'Content-type: image/';
		$knownHeaders	= array('png','gif','jpg');
		
		if(!in_array($extension, $knownHeaders))
			$headers	.= 'bmp';
		else
			$headers	.= $extension;

		return $headers;
	}

	function _readImage($path, $getExtension = false){
	
		foreach($this->_imageExtensions as $extension){
			// Try to create the image from the specific extension
			$func	= 'imagecreatefrom' . strtolower($extension);
			$image	= @$func($path);
			if($image !== false ) return ($getExtension) ? $extension : $image;
		}

		// Try and load from string:
		$im = @imagecreatefromstring(file_get_contents($file));
		if ($im !== false){
			return $im;
		}
		return false;
	}

	function _openCachedImageFile($path){
		$handle		= fopen($path, 'r');
		$contents	= fread($handle, filesize($path));
		
		fclose($handle);
		return $contents;
	}
	
	function _resize($path, $maxWidth)
	{
		$image	= $this->_readImage($path);

		if($image === false)
			return false;

		$width	= imagesx($image);
		$height	= imagesy($image);
		
		if($width > $maxWidth)
		{
			$newWidth	= $maxWidth;
			$newHeight	= intval($maxWidth * $height / $width);
		}
		else
		{
			$newWidth	= $width;
			$newHeight	= $height;
		}
		
		$newImage	= imagecreatetruecolor($newWidth, $newHeight);
		$background	= imagecolorallocate($newImage, 0, 0, 0);

		// For GIF's and PNG's set the transparency and turn off alpha blending
		if($this->_readImage($path, true) == 'gif' || $this->_readImage($path, true) == 'png')
		{
			// Set thumbnail to be transparent
			ImageColorTransparent($newImage, $background);
		
			// Turn off alpha blending to keep alpha channel
			imagealphablending($newImage, false);
		}
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		return $newImage;
	}
	
	function thumbnail($maxWidth = 60){
		//$imagepath	= urldecode($image);

		$cached	= $this->_cache . '/cache_img' . md5($this->imagePath);

		// Get image extension
		$extension	= strtolower(pathinfo($this->imagePath, PATHINFO_EXTENSION));

		if(file_exists($cached)){
			header($this->_getHeaderType($extension));
			echo $this->_openCachedImageFile($cached);
		} else {
			$image	= $this->_resize($this->imagePath, $maxWidth);

			if($image === false){
				// Display a not known thumbnail
				$extension	= strtolower(pathinfo($this->_thumbnail['unknown'], PATHINFO_EXTENSION));
				header($this->_getHeaderType($extension));
				echo $this->mnOpenImage($this->_thumbnail['unknown']);
			} else {
				// Display
				ob_start();
	
				// Get the mime type for this image.
	 			$mimetype	= $this->_readImage($this->imagePath, true);

			     if ($mimetype == "gif"){
				    header("Content-type: image/gif");
			 		imagegif ($image);
				 }
			     else if ($mimetype == "png"){
				    header("Content-type: image/png");
			 		imagepng ($image, '', 7);
				 }
			     else{
				    header("Content-type: image/jpeg");
			 		imagejpeg ($image, '', 80);
				 }
				
				// need to check the format
				$thumb	= ob_get_contents();
				ob_end_flush();
				
				// Write to cache file
				$this->_write($cached, $thumb);
				echo $thumb;
			}
		}
		die();
	}
	
	function _write($location, $content){
		$handle	= fopen($location, 'w');
		
		// If we can't write cache data to the file, return false
		if(!$handle)
			return false;
		
		// Proceed in storing the cached content
		if(fwrite($handle, $content) === FALSE)
			return false;
		
		// Here we assume the file gets stored correctly, now close it.
		fclose($handle);
		return true;
	}

// 	function _processFileAdvanced($file, $cwd){
// 		$filepath	= $this->media . rtrim($cwd, '/') . '/' . $file;
// 
// 		$image		= '';
// 
// 		$extension	= $this->extension($filepath);
// 		
// 		if(array_key_exists($extension, $this->_documents)){
// 			// Process documents
// 			$location	= $this->mediaURI . '/' . ltrim($file, '\\/');
// 			$image		= $this->_documents[$extension];
// 			$event		= 'myblog.mediaPreview(\\\'' . $image . '\\\',\\\'' . $location . '\\\');';
// 
// 			$file		= $file;
// 		} else {
// 			// Process images
// 			if(@list($width, $height) = getimagesize($filepath)){
// 	
// 				$image	= rtrim($this->mediaURI , '\\/') . '/' . ltrim($file, '\\/');
// 				
// 				// Image is larger than thumbnail, then we need to thumbnail the image
// 				if($width > $this->_thumbnail['width']){
// 					// Check if thumbnail image is created.
// 					$thumbnail	= rtrim($cwd, '\\/') . '/' . ltrim($file, '\\/');
// 					$image		= $this->cms->get_path('live') . '/index2.php?option=com_myblog&task=thumb&maxwidth=' . $this->_thumbnail['width'] . '&fn=' . urlencode($filepath);
// 				}
// 			}
// 	
// 			// Check if this file is a known image.
// 			$extension	= strtoupper(pathinfo($filepath, PATHINFO_EXTENSION));
// 	
// 			// We don't want to display unknown extensions since they might not be images
// 			// and we 
// 			if(!in_array($extension, $this->_allowedExtensions)){
// 				$image			= $this->_thumbnail['unknown'];
// 				$imageSource	= $this->_thumbnail['unknown'];
// 			} else {
// 				// Get image source file for known images.
// 				$imageSource	= $this->mediaURI . ltrim(rtrim($cwd,'/'), '/') . '/' . $file;
// 			}
// 			$event	= 'myblog.attachImage(\\\'' . $imageSource . '\\\',\\\'' . $imageSource . '\\\');';
// 		}
// 		
// // 		$items	= array(
// // 						'image'		=> $image,
// // 						'e'		=> $event,
// // 						'd'		=> $event,
// // 						'title'		=> $file,
// // 						'caption'	=> $file
// // 						);
// // 		return $items;
// 	}
	
	function _processFile($file, $cwd){
		$filepath	= $this->media . rtrim($cwd, '/') . '/' . $file;

		$image		= '';
		$extension	= $this->extension($filepath);
		
		if(array_key_exists($extension, $this->_documents)){
			// Process documents
			$location	= $this->mediaURI . '/' . ltrim($file, '\\/');
			$image		= $this->_documents[$extension];
			//$event		= 'myblog.attachDocument(\'' . $image . '\',\'' . $location . '\');';
			$event		= 'ad';
			$eventData 	= array($image, $location);
			$file		= $file;
		} else {
			// Process images
			if(@list($width, $height) = getimagesize($filepath)){
	
				$image	= rtrim($this->mediaURI , '\\/') . '/' . ltrim($file, '\\/');
				
				// Image is larger than thumbnail, then we need to thumbnail the image
				if($width > $this->_thumbnail['width']){
					// Check if thumbnail image is created.
					$thumbnail	= rtrim($cwd, '\\/') . '/' . ltrim($file, '\\/');
					$image		= rtrim( JURI::root() , '/' ) . '/index2.php?option=com_myblog&task=thumb&maxwidth=' . $this->_thumbnail['width'] . '&fn=' . urlencode($filepath);
				}
			}
	
			// Check if this file is a known image.
			$extension	= strtoupper(pathinfo($filepath, PATHINFO_EXTENSION));
	
			// We don't want to display unknown extensions since they might not be images
			// and we 
			if(!in_array($extension, $this->_allowedExtensions)){
				$image			= $this->_thumbnail['unknown'];
				$imageSource	= $this->_thumbnail['unknown'];
			} else {
				// Get image source file for known images.
				$imageSource	= $this->mediaURI . '/' . ltrim(rtrim($cwd,'/'), '/') . '/' . $file;
			}
			$event	= 'ai';//'myblog.attachImage(\'' . $imageSource . '\');';
			$eventData = $imageSource;
		}
		
		$items	= array(
						'i'		=> $image,
						'e'		=> $event,
						'd'		=> $eventData,
						't'		=> $file,
						'c'		=> $file
						);
		return $items;
	}
}
