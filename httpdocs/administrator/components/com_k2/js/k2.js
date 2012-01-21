/**
 * @version		$Id: k2.js 478 2010-06-16 16:11:42Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

var k2JS = {

	toggleSidebar: function(){
		var toggler = document.getElementById('k2ToggleSidebar');
		
		toggler.onclick = function(){
			k2JS.toggle('adminFormK2Sidebar');
			return false;
		}
		
	},

	toggle: function(obj) {
		var el = document.getElementById(obj);
		el.style.display = (el.style.display != 'none' ? 'none' : '' );
	},

	// Loader
	addLoadEvent: function(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				if (oldonload) {
					oldonload();
				}
				func();
			}
		}
	}
	
	// END
};

// Load K2
k2JS.addLoadEvent(k2JS.toggleSidebar);
