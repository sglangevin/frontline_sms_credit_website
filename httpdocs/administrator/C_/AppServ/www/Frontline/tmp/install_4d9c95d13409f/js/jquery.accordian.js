jQuery.fn.accordion = function(options) {
	// options
	var CURRENT = '';
	var SLIDE_DOWN_SPEED = 'normal';
	var SLIDE_UP_SPEED = 'fast';
	var startClosed = options && options.start && options.start == 'closed';
	var on = options && options.on && (typeof options.on == 'number' && options.on > 0) ? options.on - 1 : 0;
	return this.each( function() {
		jQuery(this).addClass('accordion'); // use to activate styling
		jQuery(this).find('dd').hide();

		
		jQuery(this).find('dt').click( function() {
			if ( !jQuery(this).hasClass('active') ) {
				jQuery('#editor-tools').find('dt').removeClass('active');
				jQuery(this).addClass('active');
				
				var current = jQuery(this.parentNode).find('dd:visible');
				var next = jQuery(this).find('+dd');
				if (current[0] != next[0]) {
					current.slideUp(SLIDE_UP_SPEED);
				}
				if (next.is(':visible')) {
					next.slideUp(SLIDE_UP_SPEED);
				} 
				else {
					next.slideDown(SLIDE_DOWN_SPEED).focus(function(){});
					myblog.sidebarShow(next);
				}
			}
		});

		

		if (!startClosed) {
			jQuery(this).find('dd:eq(' + on + ')').slideDown(SLIDE_DOWN_SPEED);
		}
	});
};