// redirect to list view
function azrulWindowSaveClose(){
	window.location.reload();
}

function editWindowTitle(nt){
	//jax.$('azrulEditorMessage').innerHTML = nt;
}

// Global object to hold drag information.
var load_method = (window.ie ? 'load' : 'domready');

// Must re-initialize window position
function myAzrulShowWindow(windowUrl){
	
	Obj = document.getElementById("azrulWindow");
	if(!Obj){
		Obj    = document.createElement('div');
		
		var html  = '';
		html += '<div id="azrulWindow" onmousedown="dragOBJ(this, event); return false;" style="top: 0px; text-decoration: none;">';
		html += '	<!-- top section -->';
    	html += '	<div id="az_tl"></div>';
    	html += '	<div id="az_tm"></div>';
    	html += '	<div id="az_tr"></div>';
    	html += '	<div style="clear: both;"></div>';
    	html += '	<!-- middle section -->';
    	html += '	<div id="az_ml"></div>';
    	html += '	<div id="azrulWindowContentOuter">';
    	html += '		<div id="azrulWindowContentTop">';
		html += '			<a href="javascript:void(0);" onclick="myAzrulHideWindow();" id="az_close_btn">Close</a>';
		html += '			<div id="az_logo"></div>';
    	html += '		</div>';			
    	html += '		<div id="azrulWindowContent">';
    	html += '		</div>';		
    	html += '	</div>';
    	html += '	<div id="az_mr"></div>';
    	html += '	<div style="clear: both;"></div>';
    	html += '	<!-- bottom section -->';
    	html += '	<div id="az_bl"></div>';
    	html += '	<div id="az_bm"></div>';
    	html += '	<div id="az_br"></div>';
    	html += '	<div style="clear: both;"></div>';
		html += '</div>';
// 		html += '<!--[if lte IE 6]>';
// 		html += '<script type="text/javascript">';
// 		html += 'jQuery("#az_tl, #az_tm, #az_tr, #az_ml, #az_mr, #az_bl, #az_bm, #az_br, #az_logo").pngfix(\'components/com_myblog/images/pixel.gif\');';
// 		html += '</script>';
// 		html += '<![endif]-->';
		
		
		Obj.innerHTML = html;
		document.body.appendChild(Obj);

	}
	
	
	var myWidth = 0, myHeight = 0;
	if( typeof( window.innerWidth ) == 'number' ) {
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	}
	else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
		//IE 6+ in 'standards compliant mode'
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight - 20+'px';
	}
	else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
		//IE 4 compatible
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
	}
	
	var yPos;
	if (window.innerHeight != null)
	{
		yPos = window.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientHeight)
	{
		yPos = document.documentElement.clientHeight;
	}
	else
	{
		yPos = document.body.clientHeight;
	}
	
	yPos = yPos - 60;
	var leftPos = (myWidth - 980)/2;
	
	document.getElementById('azrulWindow').style.visibility	= "visible";
	document.getElementById('azrulWindow').style.zIndex = myGetZIndexMax() + 1;
    document.getElementById('azrulWindowContent').innerHTML	= '<iframe id="azrulContentFrame" src="' + windowUrl + '" frameborder="0" scrolling="no"></iframe>';
    
	// change the iframe source
	//document.getElementById('azrulContentFrame').setAttribute("src", '');
	document.getElementById('azrulContentFrame').setAttribute("src", windowUrl);

	//if (browser.isIE) {
		//jQuery('#az_tl, #az_tm, #az_tr, #az_ml, #az_mr, #az_bl, #az_bm, #az_br, #az_logo').pngfix();
	//}
	
	/*
	Set editor position, center it in screen regardless of the scroll position
	*/
	// In ie 7, pageYOffset is null
	var iframe = document.getElementById("azrulWindow");
	if (window.pageYOffset)
		iframe.style.marginTop = (window.pageYOffset + 10) + 'px';
	else
	    iframe.style.marginTop = (document.body.scrollTop + 10) + 'px';
	iframe.style.height = (yPos) + 'px';
	
	
	/*
    Set height and width for transparent window
	*/

	var m_s = yPos + 'px';
    document.getElementById("azrulWindow").style.height = m_s
    document.getElementById('azrulWindow').style.left = leftPos + 'px';
	document.getElementById("azrulWindowContent").style.height = (yPos - 30) + 'px';
	document.getElementById("azrulContentFrame").style.height = (yPos - 30) + 'px';
	document.getElementById("azrulWindowContentOuter").style.height = m_s;
	document.getElementById("az_ml").style.height = m_s;
	document.getElementById("az_mr").style.height = m_s;    
	
	 
}

function myAzrulHideWindow(){
	document.getElementById('azrulWindowContent').innerHTML     = "";
	document.getElementById('azrulWindow').style.visibility		= "hidden";
}

function dragOBJ(d,e) {

    function drag(e) {
		if(!stop) {
			d.style.top=(tX=xy(e,1)+oY-eY+'px');
			d.style.left=(tY=xy(e)+oX-eX+'px');
		}
	}
	
	function agent(v) {
		return(Math.max(navigator.userAgent.toLowerCase().indexOf(v),0));
	}
	function xy(e,v) {
		return(v?(agent('msie')?event.clientY+document.body.scrollTop:e.pageY):(agent('msie')?event.clientX+document.body.scrollTop:e.pageX));
	}

    var oX=parseInt(d.style.left);
	var oY=parseInt(d.style.top);
	var eX=xy(e);
	var eY=xy(e,1);
	var tX,tY,stop;

    document.onmousemove=drag;
	document.onmouseup=function(){
		stop=1; document.onmousemove=''; document.onmouseup='';
	};

}

function myGetZIndexMax(){
	var allElems = document.getElementsByTagName?
	document.getElementsByTagName("*"):
	document.all; // or test for that too
	var maxZIndex = 0;

	for(var i=0;i<allElems.length;i++) {
		var elem = allElems[i];
		var cStyle = null;
		if (elem.currentStyle) {cStyle = elem.currentStyle;}
		else if (document.defaultView && document.defaultView.getComputedStyle) {
			cStyle = document.defaultView.getComputedStyle(elem,"");
		}

		var sNum;
		if (cStyle) {
			sNum = Number(cStyle.zIndex);
		} else {
			sNum = Number(elem.style.zIndex);
		}
		if (!isNaN(sNum)) {
			maxZIndex = Math.max(maxZIndex,sNum);
		}
	}
	return maxZIndex;
}

function fixPng( element )
{
	// test if browser ie IE 6
	if ( jQuery.browser.msie && /MSIE\s(5\.5|6\.)/.test(navigator.userAgent) )
	{
	    filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled=true,sizingMethod=crop,src='components/com_myblog/images/pixel.gif')";
        jQuery(element).css({filter:'', background:'url('+src+')'});
	}
}