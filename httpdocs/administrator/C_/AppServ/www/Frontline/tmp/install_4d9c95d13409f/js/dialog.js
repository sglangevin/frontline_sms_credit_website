// Open a new dialog
function azDlgOpen(title, content, buttonYes, buttonNo, buttonCancel, icon)
{
	//
	// getPageScroll()
	// Returns array with x,y page scroll values.
	// Core code from - quirksmode.org
	//
	function getPageScroll(){
	
		var yScroll;
	
		if (self.pageYOffset) {
			yScroll = self.pageYOffset;
		} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
			yScroll = document.documentElement.scrollTop;
		} else if (document.body) {// all other Explorers
			yScroll = document.body.scrollTop;
		}
	
		arrayPageScroll = new Array('',yScroll) 
		return arrayPageScroll;
	}
	
	
	
	//
	// getPageSize()
	// Returns array with page width, height and window width, height
	// Core code from - quirksmode.org
	// Edit for Firefox by pHaez
	//
	function getPageSize(){
		
		var xScroll, yScroll;
		
		if (window.innerHeight && window.scrollMaxY) {	
			xScroll = document.body.scrollWidth;
			yScroll = window.innerHeight + window.scrollMaxY;
		} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
			xScroll = document.body.scrollWidth;
			yScroll = document.body.scrollHeight;
		} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
			xScroll = document.body.offsetWidth;
			yScroll = document.body.offsetHeight;
		}
		
		var windowWidth, windowHeight;
		if (self.innerHeight) {	// all except Explorer
			windowWidth = self.innerWidth;
			windowHeight = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
			windowWidth = document.documentElement.clientWidth;
			windowHeight = document.documentElement.clientHeight;
		} else if (document.body) { // other Explorers
			windowWidth = document.body.clientWidth;
			windowHeight = document.body.clientHeight;
		}	
		
		// for small pages with total height less then height of the viewport
		if(yScroll < windowHeight){
			pageHeight = windowHeight;
		} else { 
			pageHeight = yScroll;
		}
	
		// for small pages with total width less then width of the viewport
		if(xScroll < windowWidth){	
			pageWidth = windowWidth;
		} else {
			pageWidth = xScroll;
		}
	
	
		arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
		return arrayPageSize;
	}
	
	// Create overlay obe
	overlay = document.getElementById("azOverlay");
	if(!overlay){
		
		overlay    = document.createElement('div');
		overlay.setAttribute("id", "azOverlay");
		overlay.setAttribute("style", "opacity:0.3;display:block;background-color:#333333;height:100%;width:100%;position:absolute;top:0px;left:0px");		
		overlay.style.cssText = "opacity:0.3;filter: alpha(opacity = 50);display:block;background-color:#333333;height:100%;width:100%;position:absolute;top:0px;left:0px";
		
		document.body.appendChild(overlay);
		
		arrayPageSize = getPageSize();
		overlay.style.height = (arrayPageSize[1] + 'px');		
	}
	
	

	
	Obj = document.getElementById("azDlg");
	if(!Obj){
		
		Obj    = document.createElement('div');
		Obj.setAttribute("id", "azDlg");
		Obj.setAttribute("style", "color:#999999;background-color:#FFFFFF;width:586px;position:absolute;top:0px;");
		Obj.style.cssText = "color:#999999;background-color:#FFFFFF;width:586px;position:absolute;top:0px;";
		
		var html  = '';
		html += '	<!-- top section -->';
    	html += '	<div id="az_tl"></div>';
    	html += '	<div id="az_tm"></div>';
    	html += '	<div id="az_tr"></div>';
    	html += '	<div style="clear: both;"></div>';
    	html += '	<!-- middle section -->';
    	html += '	<div id="az_ml"></div>';
    	html += '	<div id="azrulWindowContentOuter">';
    	/*
    	html += '		<div id="azrulWindowContentTop">';
		html += '			<a href="javascript:void(0);" onclick="azDlgClose();" id="az_close_btn">Close</a>';
		html += '			<div id="az_logo"></div>';
    	html += '		</div>';
    	*/
		html += '				<!-- Dialog -->';
		html += '				<div class="azDialog">';
		html += '				    <div class="azDialogTitle">' + title + '</div>';
		
		var iconClass	= 'azDialogIconConfirm';
		if(icon == 'warning'){
			iconClass	= 'azDialogIconWarning';
		} else if (icon == 'info'){
			iconClass	= 'azDialogIconInfo';
		}
		
		if(icon != false)
			html += '				    <div class="' + iconClass + '"></div>';
		html += '				    <div class="azDialogText">';
		html += content;
		
		html += '					</div>';
		html += '					<div style="clear: both;"></div>';
		html += '				    <div class="azDialogButton">';
		
		if(buttonYes['action'] == null)
			buttonYes['action']	= 'javascript:void(0);';
	
		if(buttonYes)
			html += '		                <button class="button" onclick="' + buttonYes['action'] + '">' + buttonYes['text'] + '</button>';
		
		if(buttonNo)
			html += '		                <button class="button" onclick="' + buttonNo + '">No</button>';
	
		if(buttonCancel)
			html += '		                <button class="button" onclick="azDlgClose();">Cancel</button>';

		html += '					</div>';
		html += '				</div>';
		html += '				<!-- Dialog -->';
    	html += '		</div>';
    	html += '	</div>';
    	html += '	<div id="az_mr"></div>';
    	html += '	<div style="clear: both;"></div>';
    	html += '	<!-- bottom section -->';
    	html += '	<div id="az_bl"></div>';
    	html += '	<div id="az_bm"></div>';
    	html += '	<div id="az_br"></div>';
    	html += '	<div style="clear: both;"></div>';
		
		Obj.innerHTML = html;
		//console.log(html);
		document.body.appendChild(Obj);
	}
	
	// resize/reposition the dialog
	arrayPageSize = getPageSize();
	Obj.style.top  = ((arrayPageSize[1] - Obj.offsetHeight)/2) + 'px';
	Obj.style.left = ((arrayPageSize[0] - 586)/2) + 'px'; 
}

// Close current dialog
function azDlgClose(){
	obj = document.getElementById("azDlg");
	document.body.removeChild(obj);
	
	obj = document.getElementById("azOverlay");
	document.body.removeChild(obj);
}
