
// Show the layer with the given id and hide the rest
function myToggleView(nv){
	var headers = new Array();
	headers[0] = "toolbarHome";
	headers[1] = "toolbarTags";
	headers[2] = "toolbarSearch";
	headers[3] = "toolbarBlogger";
	
	for (i=0;i<headers.length;i++){
		if(headers[i] != nv){
			var cname = document.getElementById(headers[i]).className = headers[i];
		}else{
			document.getElementById(nv).className += ' blogActive';
			document.getElementById(nv).blur();
		}
	}
	return false;
}
