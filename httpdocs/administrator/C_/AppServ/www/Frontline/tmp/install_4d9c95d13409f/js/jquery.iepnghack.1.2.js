/*
 * jQuery pngfix plugin
 * Version 1.2  (20/05/2007)
 * @requires jQuery v1.1.1
 *
 * Examples at: http://khurshid.com/jquery/iepnghack/
 * Copyright (c) 2007 Khurshid M.
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 */
 /**
  *
  * @example
  *
  * $('img[@src$=.png], #panel').iepnghack();
  *
  * @apply hack to all png images and #panel which icluded png img in its css
  *
  * @name pngfix
  * @type jQuery
  * @cat Plugins/Image
  * @return jQuery
  * @author jQuery Community
  */
 
(function($) {
	/**
	 * helper variables and function
	 */
	var hack = {
		ltie7 : $.browser.msie && /MSIE\s(5\.5|6\.)/.test(navigator.userAgent),
		pixel : 'pixel.gif',
		filter : function(src) {
			return "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=crop,src='"+src+"')";
		}
	};
	/**
	 * Applies ie png hack to selected dom elements
	 *
	 * $('img[@src$=.png]').iepnghack();
	 * @desc apply hack to all images with png extensions
	 *
	 * $('#panel, img[@src$=.png]').iepnghack();
	 * @desc apply hack to element #panel and all images with png extensions
	 *
	 * @name iepnghack
	 * @type jQuery
	 * @cat Plugins/iepnghack
	 */
	$.fn.pngfix = hack.ltie7 ? function() {
    	return this.each(function() {
			var $$ = $(this);
			if ($$.is('img')) { /* hack image tags present in dom */
				$$.css({filter:hack.filter($$.attr('src')), width:$$.width(), height:$$.height()})
				  .attr({src:hack.pixel})
				  .positionFix();
			} else { /* hack png css properties present inside css */
				var image = $$.css('backgroundImage');
				if (image.match(/^url\(["'](.*\.png)["']\)$/i)) {
					image = RegExp.$1;
					$$.css({backgroundImage:'none', filter:hack.filter(image)})
					  .positionFix();
				}
			}
		});
	} : function() { return this; };
	/**
	 * Removes any png hack that may have been applied previously
	 *
	 * $('img[@src$=.png]').pngunfix();
	 * @desc revert hack on all images with png extensions
	 *
	 * $('#panel, img[@src$=.png]').iepnghack();
	 * @desc revert hack on element #panel and all images with png extensions
	 *
	 * @name pngunfix
	 * @type jQuery
	 * @cat Plugins/iepnghack
	 */
	$.fn.pngunfix = hack.ltie7 ? function() {
    	return this.each(function() {
			var $$ = $(this);
			var src = $$.css('filter');
			if (src.match(/src=["'](.*\.png)["']/i)) { /* get img source from filter */
				src = RegExp.$1;
				if ($$.is('img')) {
					$$.attr({src:src}).css({filter:''});
				} else {
					$$.css({filter:'', background:'url('+src+')'});
				}	
			}
		});
	} : function() { return this; };
	/**
	 * positions selected item relatively
	 */
	$.fn.positionFix = function() {
		return this.each(function() {
			var $$ = $(this);
			var position = $$.css('position');
			if (position != 'absolute' && position != 'relative') {
				$$.css({position:'relative'});
			}
		});
	};

})(jQuery);