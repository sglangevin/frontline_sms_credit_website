<?php
/**
 * @package		My Blog
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.azrul.com Copyrighted Commercial Software
 */
defined('_JEXEC') or die('Restricted access');

// If the memory limit is too low, increase it 
if(ini_get('memory_limit') == '8M')
	@ini_set('memory_limit', '16M');

jimport( 'joomla.filesystem.file' );
jimport( 'joomla.filesystem.folder');

class MYMedia
{
	var $db		= null;
	
	var $media		= '';	// Full Path to the image root
	var $mediaURI	= '';	// Full URI Path to the image root
	var $cache		= '';	// Full Path to cache folder

	function MYMedia()
	{
		$this->_init();
	}
	
	function _init()
	{
		global $_MY_CONFIG;
		
		$mainframe		=& JFactory::getApplication();
		$user			=& JFactory::getUser();

		$this->media	= JPATH_ROOT . DS . trim($_MY_CONFIG->get('imgFolderRoot'), '\\/');
		$this->mediaURI	= rtrim( JURI::root() , '/' ) . '/' . trim($_MY_CONFIG->get('imgFolderRoot') , '\\/');
		
		if($_MY_CONFIG->get('imgFolderRestrict'))
		{
			$this->media	.= '/' . $user->id;
			
			// If folder doesn't exists create it.
			if(!file_exists($this->media))
			{
				JFolder::create( $this->media );
			}
			
			$this->mediaURI	.= '/' . $user->id;
		}
	}

	// Returns the extensions for the provided file
	function extension($filePath, $uppercase = false)
	{
		if($uppercase)
			return strtoupper(pathinfo($filePath, PATHINFO_EXTENSION));

		return strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
	}
	
	/**
	 * Return an array of contents in a specific directory
	 **/	 	
	function _getContents($directory)
	{
		$files	= JFolder::files( $directory );

		if( !$files )
		{
			return false;
		}
		return $files;
	}
	
	/**
	 * Browse a specific folder and list the contents
	 * $folder:	 string (folder that you want to browse)  
	 **/
	function _getFiles($folder, $advanced)
	{
		global $_MY_CONFIG, $mainframe;

		$directory	= $this->media . '/' . $folder;

		// Don't waste time processing it
		if(!is_dir($directory)){
			return false;
		}

		$contents	= $this->_getContents($directory);
		$items		= array();

		// Process folders first
		foreach($contents as $content)
		{
			
			$contentDirectory	= $this->media . '/' . $folder . '/' . $content;
			
			if(is_dir($contentDirectory))
			{
					$content	= $this->_processFolder($content, $folder, $advanced);
				
			
				if(is_array($content) && ($content !== false))
				{
					$items[]	= $content;
				}
			}
		}

		// Then we process files
		foreach($contents as $content)
		{
			if(is_file($this->media . '/' . $folder . '/' . $content))
			{
				$content	= $this->_processFile($content, $folder);
				$items[]	= $content;
			}
		}
		
		return $items;
	}

	//
	// $folder = the folder in this folder
	// $cwd	   = the current folder
	//
	function _processFolder($folder, $cwd, $escape)
	{
		$open	= '';
		
		if($folder == '..')
		{
			$image	= $this->_thumbnail['folderup'];
			
			// We need to know that this is a subfolder of current working directory
			$parent		= rtrim(dirname($cwd), '\\/');

			// Remove the media directory from the path
			$open		= str_replace($this->media, '', $parent);
		
		}
		else if($folder != '.' && $folder != '..')
		{
		
			// If folder is not '.' and not '..' we know its a folder.
			$image	= $this->_thumbnail['folder'];
			
			$open	= $cwd . '/' . $folder;
		}
		
		$items	= array();
		$eventData = '';
		
		$user		=& JFactory::getUser();
		
		if($folder != '.')
		{
			switch($folder)
			{
				case $folder != '/..':
				case $folder == '/..' && !$_MY_CONFIG->get('imgFolderRestrict'):
				case $folder == '/..' && $user->id == '62':
				$event	= 'o';//($escape) ? 'myblog.openFolder(\\\''. $open . '\\\');' : 'myblog.openFolder(\'' . $open . '\');';
				$eventData = $open;
				$items	= array(
								'i'	=> $image,
								'e'	=> $event,
								'd' => $eventData,
								't'	=> $folder,
								'c'	=> $folder
								);

				break;
			}
		} else
			return false;

		
		return $items;
	}
}
