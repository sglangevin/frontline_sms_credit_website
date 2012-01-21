/**
 * @version		$Id: k2.mootools.js 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

window.addEvent('domready', function(){

	// Toggler
	if($('k2ToggleSidebar')){	
		$('k2ToggleSidebar').addEvent('click', function(){
			$('adminFormK2Sidebar').setStyle('display', $('adminFormK2Sidebar').getStyle('display') != 'none' ? 'none' : '')
		});
	}
	
	// File browser
	$$('.videoFile').addEvent('click', function(e){
		e = new Event(e).stop();
		parent.$$('input[name=remoteVideo]').setProperty('value', this.getProperty('href'));
		parent.$('sbox-window').close();
	});
	
	$$('.imageFile').addEvent('click', function(e){
		e = new Event(e).stop();
		parent.$$('input[name=existingImage]').setProperty('value', this.getProperty('href'));
		parent.$('sbox-window').close();
	});
	
	
});
