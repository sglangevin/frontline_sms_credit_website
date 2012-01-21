<?php
(defined('_VALID_MOS') OR defined('_JEXEC')) or die('Direct Access to this location is not allowed.');

global $jaxFuncNames;
if (!isset($jaxFuncNames) or !is_array($jaxFuncNames)) $jaxFuncNames = array();
$jaxFuncNames[] = "myxTogglePublish";
$jaxFuncNames[] = "myxPingMyBlog";
$jaxFuncNames[] = "myxSearchPosts";
$jaxFuncNames[] = "myxValidate";
$jaxFuncNames[] = "myxToggleBotPublish";
$jaxFuncNames[] = "myxDeleteCategory";
$jaxFuncNames[] = "myxAddCategory";
$jaxFuncNames[] = "myxTogglePublishAdmin";
$jaxFuncNames[] = "myxToggleMambotPublish";
$jaxFuncNames[] = "myxSaveBloggerProfile";
$jaxFuncNames[] = "myxToggleCommentPublish";
$jaxFuncNames[] = 'myxLoadFolder';
$jaxFuncNames[] = 'myxUserAddTag';              #User add tags.
$jaxFuncNames[] = 'myxSetVideoType';
$jaxFuncNames[]	= 'myxUpdateCategory';			// Update tags
$jaxFuncNames[]	= 'myxSetDefaultCategory';		// Set the tag as default
$jaxFuncNames[]	= 'myxUpdateSlug';				// Update slugs
$jaxFuncNames[]	= 'myxCommentApproveAll';
$jaxFuncNames[]	= 'myxCommentRemoveUnpublished';
$jaxFuncNames[]	= 'myxSaveBlog';