<?php
// FileManager 1.0;
$txt['fm_adminbutton'] = 'File Manager';
$txt['fm_index'] = 'File Index';
$txt['fm_pagetitle'] = 'File Manager';
$txt['fm_browsefiles'] = 'Browsing directory:';
$txt['fm_editfile'] = 'Editing file:';
$txt['fm_viewfile'] = 'Viewing file:';
$txt['fm_viewimage'] = 'Viewing image:';
$txt['fm_removefile'] = 'Remove file or directory:';
$txt['fm_renamefile'] = 'Rename file or directory:';
$txt['fm_chmodfile'] = 'Chmod file or directory:';
$txt['fm_search'] = 'Search';
$txt['fm_search_desc'] = 'Search current dir';
$txt['fm_searchdir'] = 'Searching directory:';
$txt['fm_uploadfile'] = 'Upload file';
$txt['fm_uploadfiletodir'] = 'Upload file to dir';
$txt['fm_createdir'] = 'Create a new directory in:';
$txt['fm_createfile'] = 'Create a new file in:';$txt['fm_outdated'] =' You seem to be using an outdated version of The SMF File Management Tool. Please visit the SMF Mod Site as soon as possible to update to the latest release!<br />You are currently using version <i id="currentVersion" style="white-space: nowrap;">%s</i>, while the latest version is <i id="latestVersion" style="white-space: nowrap;">??</i>.';
// Types
$txt['fm_type_dir'] = 'Directory';
$txt['fm_type_file'] = 'File';
$txt['fm_type_other'] = 'Other';
// Table headings
$txt['fm_filetype'] = 'Type';
$txt['fm_filename'] = 'File';
$txt['fm_filesize'] = 'Size';
$txt['fm_filepermissions'] = 'File permissions';
$txt['fm_lastedit'] = 'Last modified';
$txt['fm_actions'] = 'Actions';
// Actions
$txt['fm_view'] = 'Open file';
$txt['fm_opendir'] = 'Open folder';
$txt['fm_rename'] = 'Rename';
$txt['fm_remove'] = 'Remove';
$txt['fm_edit'] = 'Edit';
$txt['fm_savefile'] = 'Save edits';
$txt['fm_savenewname'] = 'Rename file';
$txt['fm_chmod'] = 'Chmod';
$txt['fm_download'] = 'Download file';
$txt['fm_savechmod'] = 'CHMOD';
$txt['fm_createdirnow'] = 'Create new directory';
$txt['fm_createfilenow'] = 'Create new file';
$txt['fm_playaudio'] = 'Play audio file';
// Errors
$txt['fm_file_noexist'] = 'The file you tried to view does not exist, or has been damaged.';
$txt['fm_file_couldnotopen_wite'] = '<i class="error">The file could not be opened for writing.</i>';
$txt['fm_file_couldnotopen_read'] = '<i class="error">The file could not be opened for reading.</i>';
$txt['fm_file_empty'] = '<i class="error">The file was left empty. The original content was left untouched and shown below.</i>';
$txt['fm_rename_empty'] = '<i class="error">The name was left empty.</i>';
$txt['fm_chmod_empty'] = '<i class="error">You did not enter any chmod value</i>';
$txt['fm_search_empty'] = '<i class="error">No search keyword entered.</i>';
$txt['fm_remove_failed'] = '<i class="error">Could not remove file/directory!</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_nofiles'] = 'There are no files in this directory.';
$txt['fm_file_fail'] = '<i class="error">The edits could not be saved!</i> Try again below or <a href="%s">click here to go Back to previous directory</a>.';
$txt['fm_remove_none'] = 'This file cannot be removed as it is vital for SMF to work correctly.<br /> <a href="%s">Back to previous directory</a>.';
$txt['fm_remove_none_dir'] = 'This directory cannot be removed as it is vital for SMF to work correctly.<br /> <a href="%s">Back to previous directory</a>.';
$txt['fm_rename_none'] = 'This file cannot be renamed as it is vital for SMF to work correctly.<br /> <a href="%s">Back to previous directory</a>.';
$txt['fm_rename_none_dir'] = 'This directory cannot be renamed as it is vital for SMF to work correctly.<br /> <a href="%s">Back to previous directory</a>.';
$txt['fm_rename_failed'] = '<i class="error">The file/directory could not be renamed.</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_chmod_failed'] = '<i class="error">Could not change chmod!</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_createdir_failed'] = '<i class="error">Could not create new directory!</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_createdir_empty'] = '<i class="error">You have to give your directory a name!</i>';
$txt['fm_createfile_failed'] = '<i class="error">Could not create new file!</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_createfile_error'] = '<i class="error">Could not create file.</i>';
$txt['fm_createfile_empty'] = '<i class="error">You have to give your file a name!</i>';
// Confirm/complete actions
$txt['fm_editinfo'] = 'Make edits to the file below. Remember to make regular saves.';
$txt['fm_renameinfo'] = 'Change the name of the file or directory <i>%s</i> here.';
$txt['fm_chmodinfo'] = 'Enter the chmod level you want for this file below.';
$txt['fm_createdirinfo'] = 'Enter a name for your new directory.';
$txt['fm_createfileinfo'] = 'Enter a name for your new file.';
$txt['fm_file_complete'] = '<i style="color: green;">Your edits have been saved.</i> Keep editing the file below or <a href="%s">click here to go Back to previous directory</a>.';
$txt['fm_remove_sure'] = 'Are you sure you want to remove this file: %s.';
$txt['fm_remove_sure_dir'] = 'Are you sure you want to remove this directory: %s. <strong>ALL FILES INSIDE WILL BE DELETED AS WELL!</strong>';
$txt['fm_yes'] = '<span style="color: green;">Yes</span>';
$txt['fm_no'] = '<span style="color: red;">No</span>';
$txt['fm_remove_complete'] = '<i style="color: green;">The file/directory has been removed.</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_edit_warning'] = 'Please note that this file is vital for SMF to work correctly! Be careful with your edits here.';
$txt['fm_rename_complete'] = '<i style="color: green;">The file/directory has been renamed.</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_chmod_complete'] = '<i style="color: green;">Chmod changed.</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_createdir_complete'] = '<i style="color: green;">New directory succesfully created.</i> <br /><a href="%s">Back to previous directory</a>.';
$txt['fm_createfile_complete'] = '<i style="color: green;">Succesfully created %s. You can now add content to this file below.</a>';
$txt['fm_search_results'] = 'Displaying search results for <i>%s</i>.';
$txt['fm_search_noresults'] = 'Your search did not return anything.';
// The top bar
$txt['fm_rootfolder'] = 'SMF Root Folder';
$txt['fm_currentdir'] = 'Current directory';
$txt['fm_thereare'] = 'This directory contains %s.';
$txt['fm_gotoparent'] = 'Go to parent directory.';
$txt['fm_gotoroot'] = 'Go to the SMF Root Folder';
// Viewing an image.
$txt['fm_imageinfo'] = 'Image information';
$txt['fm_fullsize'] = 'Click on the image to view it in full size.';
$txt['fm_imageactions'] = 'Image actions';
$txt['fm_imagewidth'] = 'Image width';
$txt['fm_imageheight'] = 'Image height';
$txt['fm_imagesize'] = 'Image size';
$txt['fm_imagedir'] = 'Image location';
$txt['fm_image'] = '%s-image'; // Example: JPG-image
// Viewing a file.
$txt['fm_fileinfo'] = 'File information';
$txt['fm_fileactions'] = 'File actions';
$txt['fm_filedir'] = 'File location';
// Playing an audio file.
$txt['fm_audioinfo'] = 'Audio file information';
// General
$txt['fm_kb'] = 'kb';
$txt['fm_files'] = 'files';
$txt['fm_file'] = 'file';
$txt['fm_folders'] = 'folders';
$txt['fm_folder'] = 'folder';
$txt['fm_empty'] = 'Empty folder';
$txt['fm_smfimportant'] = 'IMPORTANT SMF FILE';
$txt['fm_codepress_toggle'] = 'Toggle highlighting';
$txt['fm_codepress_toggle_lines'] = 'Toggle line numbers';
$txt['fm_codepress_toggle_auto'] = 'Toggle auto complete';
// Uploading a file
$txt['fm_uploading'] = 'Uploading file...';
$txt['fm_filetoupload'] = 'File to upload';
$txt['fm_upload'] = 'Upload';
$txt['fm_uploaderror'] = 'Error: %s';
$txt['fm_fileuploaded'] = 'The file, %s, has been succesfully uploaded to';
$txt['fm_nossi'] = 'Could not upload file. Make sure process.php is located in the same directory as SSI.php.';
$txt['fm_uploadclosenotice'] = 'Close notice';
// PHP file errors (Uploading a file)
$txt['fm_uploaderror_1'] = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
$txt['fm_uploaderror_2'] = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
$txt['fm_uploaderror_3'] = 'The uploaded file was only partially uploaded.';
$txt['fm_uploaderror_4'] = 'No file was uploaded.';
$txt['fm_uploaderror_6'] = 'Missing a temporary folder.';
$txt['fm_uploaderror_7'] = 'Failed to write file to disk.';
$txt['fm_uploaderror_8'] = 'File upload stopped by extension.';
// Zip and rar
$txt['fm_zipnotinstalled'] = 'The Zip extension is not installed.';
$txt['fm_rarnotinstalled'] = 'The Rar extension is not installed.';
$txt['fm_extract_failed'] = 'Could not extract file.';
?>