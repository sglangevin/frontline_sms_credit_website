function jxUpdateShareLink(sharelink) {
	sharelink = sharelink.replace(/%%URL%%/gi, encodeURIComponent(location.href));
	sharelink = sharelink.replace(/%%TITLE%%/gi, encodeURIComponent(document.title));
	sharelink = sharelink.replace(/%%URLENC%%/gi, encodeURIComponent(encodeURIComponent(location.href)));
	sharelink = sharelink.replace(/%%TITLEENC%%/gi, encodeURIComponent(encodeURIComponent(document.title)));
	return sharelink;
}

// Create a slide for the links box.
function jxSetupShareSlide(fxslide) {
	var jxshare_btn = $('jxshare_button');
	if (jxshare_btn.hasClass('trans_vert')) {
		var fx_mode = 'vertical';
	} else {
		var fx_mode = 'horizontal';
	}
	if (jxshare_btn.hasClass('fx_elastic')) {
		var fx_trans = Fx.Transitions.Elastic.easeOut;
	} else if (jxshare_btn.hasClass('fx_expo')) {
		var fx_trans = Fx.Transitions.Expo.easeOut;
	} else if (jxshare_btn.hasClass('fx_bounce')) {
		var fx_trans = Fx.Transitions.Bounce.easeOut;
	} else if (jxshare_btn.hasClass('fx_back')) {
		var fx_trans = Fx.Transitions.Back.easeOut;
	} else if (jxshare_btn.hasClass('fx_sine')) {
		var fx_trans = Fx.Transitions.Sine.easeOut;
	} else if (jxshare_btn.hasClass('fx_circ')) {
		var fx_trans = Fx.Transitions.Circ.easeOut;
	} else if (jxshare_btn.hasClass('fx_quad')) {
		var fx_trans = Fx.Transitions.Quad.easeOut;
	} else if (jxshare_btn.hasClass('fx_cubic')) {
		var fx_trans = Fx.Transitions.Cubic.easeOut;
	} else if (jxshare_btn.hasClass('fx_quart')) {
		var fx_trans = Fx.Transitions.Quart.easeOut;
	} else if (jxshare_btn.hasClass('fx_quint')) {
		var fx_trans = Fx.Transitions.Quint.easeOut;
	} else {
		var fx_trans = Fx.Transitions.linear;
	}
	var fxslide = new Fx.Slide($('jxshare_box'), {
		duration: 750,
		transition: fx_trans,
		mode: fx_mode
	}).hide();
    $('jxshare_box').setStyles({visibility: 'visible'});
	$('jxshare_box').addEvent('mouseleave', function() { fxslide.slideOut(); });
	$('jxshare_box').addEvent('mouseenter', function() { fxslide.stop(); fxslide.slideIn(); });

	return fxslide;
}

// Add share button slide toggle.
function jxInsertShareButton(fxslide) {
	var imageShareLink = $('jxshare_button');
	imageShareLink.addEvents({
		'click': function(e) {
			e = new Event(e).stop();
			fxslide.toggle();
		}
	});
}

// Move share button to the buttonheading node.
function jxMoveShareButton() {
	var imageShareLink = $('jxshare_button');
	var buttonheading = $$('.buttonheading');
	buttonheading[0].adopt(imageShareLink, 'bottom');
}

// Setup the links box.
function jxSetupShareBox() {
	var sharebox_coords = $('jxshare_box').getCoordinates();
	var sharebtn_coords = $('jxshare_button').getCoordinates();

	if ($('jxshare_button').hasClass('trans_vert')) {
		var sharebox_x = sharebtn_coords.left + (sharebtn_coords.width / 2) - (sharebox_coords.width / 2);
		var sharebox_y = sharebtn_coords.bottom + 2;
	} else {
		var sharebox_x = sharebtn_coords.right + 2;
		var sharebox_y = sharebtn_coords.top + (sharebtn_coords.height / 2) - (sharebox_coords.height / 2);
	}
	//alert(Json.toString(sharebtn_coords));

	$('jxshare_posbox').setStyles({
		top: sharebox_y,
		left: sharebox_x
	});
}

// Bookmark page
function jxBookmarkPage() {
	title = document.title;
	url = location.href;
	if (window.sidebar) { // firefox
		window.sidebar.addPanel(title, url, '');
	} else if (window.opera && window.print) { // opera
		var elem = document.createElement('a');
		elem.setAttribute('href', url);
		elem.setAttribute('title', title);
		elem.setAttribute('rel', 'sidebar');
		elem.click();
	} else if (document.all) { // ie
		window.external.AddFavorite(url, title);
	}
}

// Load link.
function jxLoadLink(url) {
	if (url.indexOf('#bookmark') > 0) {
		jxBookmarkPage()
	} else {
		if ($('jxshare_button').hasClass('jxshare_popup')) {
			var load = window.open(url,'_popup','scrollbars=auto,menubar=no,height=400,width=600,resizable=yes,toolbar=no,location=no,status=no');
		} else if ($('jxshare_button').hasClass('jxshare_blank')) {
			var newWindow = window.open(url, '_blank');
		} else {
			location.href = url;
		}
	}
}

// Setup share links.
function jxSetupShareLinks() {
	var share_links = $$('#jxshare_box a.jxshare_link');
	share_links.each(function(link, index) {
        link.href = jxUpdateShareLink(link.href);
		link.addEvents({
		  'click': function(e) {
    		e = new Event(e).stop();
    		jxLoadLink(link.href);
		  }
	    });
	});
}

// Run startup stuff on domready.
window.addEvent('domready', function() {
	if (!$('jxshare_box').hasClass('jxshare_flat')) {
		fxslide = jxSetupShareSlide();
		jxInsertShareButton(fxslide);
		if ($('jxshare_button').hasClass('jxshare_btnhead')) {
			jxMoveShareButton();
		}
		jxSetupShareBox();
	}
	jxSetupShareLinks();
});
