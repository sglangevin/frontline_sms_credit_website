<?php
/**
 * @version		$Id: default.php 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<!-- To move into k2.mootools.js -->
<script type="text/javascript">
	//<![CDATA[
	window.addEvent('domready', function(){
		$$('#toolbar-Link a').addEvent('click', function(e){
			var answer = confirm('<?php echo JText::_('WARNING: You are about to import all sections, categories and articles from Joomla!\'s core content component (com_content) into K2! If this is the first time you import content to K2 and your site has more than a few thousand articles, the process may take a few minutes. If you have executed this operation before, duplicate content may be produced!', true); ?>');
			if (!answer){
				new Event(e).stop();
			}
		})
	});
	//]]>
</script>

<div id="cpanel" class="k2AdminCpanel">
	<?php echo $this->loadTemplate('quickicons'); ?>
	<div class="clr"></div>
</div>
<div id="k2AdminStats">
	<?php echo $this->loadTemplate('tabs'); ?>
</div>
<div class="clr"></div>
