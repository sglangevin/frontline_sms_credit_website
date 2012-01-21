<?php
/**
 * @version		$Id: default.php 481 2010-06-16 17:36:08Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<div class="clr"></div>

<?php if($modLogo): ?>
<div id="k2QuickIconsTitle">
	<a href="index.php?option=com_k2" title="<?php echo JText::_('K2 dashboard'); ?>">
		<span>K2</span>
	</a>
</div>
<?php endif; ?>

<div id="k2QuickIcons"<?php if(!$modLogo): ?> class="k2NoLogo"<?php endif; ?>>
	<?php if(file_exists($quickIconsFile)) @ include($quickIconsFile); ?>
	<div class="clr"></div>
</div>

<div class="clr"></div>
