function MyBlog()
{
	this.toPermalink	= function(){
		var title	= jQuery( '#title' ).val();
		
		title		= trim( title );
		
		if( title != '' )
		{
			title		= title.replace(/[^a-zA-Z0-9\-+]+/ig , '-');
			title		= title.toLowerCase();
			title		= title + '.html';
			jQuery('#permalink').val( title );
			jQuery('#permalink-data').html( title );
			jQuery('#permalink-caption').show();
		}
	}
	
	this.loading = function ( option ){
		if( option == 'show' )
		{
			// Show loading so user will be notified.
			jQuery('#save-overlay-container').css('display','block');
	
			var overlayTop	= ( jQuery('#save-overlay').height() - 100 ) / 2;
			var overlayLeft	= ( jQuery('#save-overlay').width() - 250 )/ 2;
			
// 			jQuery('#save-loading').css('top' , overlayTop + 'px');
// 			jQuery('#save-loading').css('left' , overlayLeft + 'px');
			jQuery('#save-loading').css('top' , '50%');
			jQuery('#save-loading').css('marginTop' , '-30px');
			jQuery('#save-loading').css('left' , '50%');
			jQuery('#save-loading').css('marginLeft' , '-100px');
		}
		else
		{
			// Show loading so user will be notified.
			jQuery('#save-overlay-container').css('display','none');	
		}
	}
	
	this.initTooltip = function(){
		//jQuery('.imgBrowserItem').Tooltip({showBody: " - ", left:-30});
	}

	this.busyLoading = function ( element, img){
		jQuery(element).html('<img src="'+ img +'" />');
	} 

	this.encloseText = function(text1, text2){
		//use document.getelementbyid here
		var textarea	= document.getElementById('fulltext');
		
		// Can a text range be created?
		if (typeof(textarea.caretPos) != "undefined" && textarea.createTextRange)
		{
			var caretPos = textarea.caretPos, temp_length = caretPos.text.length;
			caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text1 + caretPos.text + text2 + ' ' : text1 + caretPos.text + text2;
	
			if (temp_length == 0)
			{
				caretPos.moveStart("character", -text2.length);
				caretPos.moveEnd("character", -text2.length);
				caretPos.select();
			}
			else
				textarea.focus(caretPos);
		}
		// Mozilla text range wrap.
		else if (typeof(textarea.selectionStart) != "undefined")
		{
			var begin = textarea.value.substr(0, textarea.selectionStart);
			var selection = textarea.value.substr(textarea.selectionStart, textarea.selectionEnd - textarea.selectionStart);
			var end = textarea.value.substr(textarea.selectionEnd);
			var newCursorPos = textarea.selectionStart;
			var scrollPos = textarea.scrollTop;
	
			textarea.value = begin + text1 + selection + text2 + end;
	
			if (textarea.setSelectionRange)
			{
				if (selection.length == 0)
					textarea.setSelectionRange(newCursorPos + text1.length, newCursorPos + text1.length);
				else
					textarea.setSelectionRange(newCursorPos, newCursorPos + text1.length + selection.length + text2.length);
				textarea.focus();
			}
			textarea.scrollTop = scrollPos;
		}
		// Just put them on the end, then.
		else
		{
			textarea.value += text1 + text2;
			textarea.focus(textarea.value.length - 1);
		}
	}
	
	this.appendReadmore = function(site){
	
		var added	= (jQuery('.mceEditor iframe').contents().find('#readmore img').html() == null) ? false : true;
	
		if(!added){
			tinyMCE.execCommand('mceFocus',false, 'mce_editor_0');
			tinyMCE.execCommand('mceInsertContent',false, '<p id="readmore"><img src="' + site + '/images/readmoreline.gif" /></p><p></p>');
			return;
		}
		alert('Sorry, only 1 readmore tag is allowed!')
	}

	var noTags		= '<span id="notags">None</span>';

	this.addTag = function(tags){
		// Split comma's ','
		var tags = tags.split(',');
 		
 		for(var i = 0; i < tags.length; i++){
 			tag	= tags[i];
			
			if(tag != '')
			{
				// Remove the '#notags' span
				jQuery('#notags').remove();
				
				myblog.checkAddedTag(tag);
			}
				
			//if(tag != ''){
			//	var input	= '<input type="hidden" value="' + tag + '" name="tags[]">';
			//	jQuery('#tagListFieldSet').append('<span>' + input + '<a href="javascript:void(0);" >X</a>' + tag + '</span>');
			//}
		}
		
		// add click event
		myblog.bindAddedTag();
		
		// Clear input box ;)
		jQuery('#newtag').val('');
	}

	this.bindAddedTag = function (){
		jQuery('#tagListFieldSet a').unbind('click');
		jQuery('#tagListFieldSet a').click(function () { 
	      jQuery(this).parent().remove();
		  if(trim(jQuery('#tagListFieldSet').html()) == '<legend>Selected tags</legend>'){
		  	jQuery('#tagListFieldSet').append(noTags);
		  }
	    });
	}
	
	this.advAddTag	= function (tags){
		// Split comma's ','
		var tags = tags.split(',');
 		
 		for(var i = 0; i < tags.length; i++){
 			tag	= tags[i];
			if(tag != ''){
				var input	= '<input type="hidden" value="' + tag + '" name="tags[]">';
				
				// Remove the '#notags' span
				jQuery('#selectedTagFieldset').append('<span>' + input + '<a href="javascript:void(0);">X</a>' + tag + '</span>');
				myblog.bindSelectedTag();
			}
		}

		// Clear input box ;)
		jQuery('#advnewtag').val('');
	}
	
	this.bindSelectTag = function(){
		jQuery('#fullTagList span').unbind('click');
		jQuery('#fullTagList span').click(function(){
			var tag = jQuery(this).html();
			jQuery(this).remove();
			jQuery('#selectedTagFieldset').append('<span>' + tag + '</span>');
			myblog.bindSelectedTag();
		});
	}
	
	this.bindSelectedTag = function (){
		jQuery('#selectedTagFieldset span').unbind('click');
		jQuery('#selectedTagFieldset span').click(function(){
			var tag = jQuery(this).html();
			jQuery(this).remove();
			jQuery('#fullTagList').append('<span>' + tag + '</span>');
			myblog.bindSelectTag();
		});
	}
	
	this.selectTagOk = function(){
		jQuery('#tagListFieldSet').append(jQuery('#selectedTagFieldset').html());
		jQuery('#selectedTagFieldset').empty();

		if(trim(jQuery('#notags').html()) != null){
			jQuery('#notags').remove();
		}

		myblog.bindAddedTag();
		azDlgClose();
	}

	this.openFolder = function (folder, isAdv){
		isAdv = typeof(isAdv) != 'undefined' ? isAdv : '';
		jax.call('myblog','myxLoadFolder', folder, isAdv);
	}
	
	this.attachImage = function (imgSource){
		if(tinyMCE.getInstanceById('fulltext'))
		{
			var editor	= tinyMCE.getInstanceById('fulltext');
			tinyMCE.execCommand('mceFocus',false, editor['editorId']);
			tinyMCE.execCommand('mceInsertContent',false,'<img src="' + imgSource + '" />');
		}
		else
		{
			alert('Image embed only works in WYSIWYG Editor Mode');
		}


	}
	
	this.attachDocument = function (imgThumbNail, documentLocation){
		tinyMCE.execCommand('mceInsertContent',false,'<a href="' + documentLocation + '"><img src="' + imgThumbNail + '" border="0"/></a>');
	}
	
	this.mediaPreview	= function (imgThumbNail, fileLocation){
		jQuery('td.myAdvanceMediaThumbnail').empty();
		jQuery('td.myAdvanceMediaThumbnail').append('<img src="' + imgThumbNail + '" border="0" />')
	}
	
	this.browserBuild = function(data, isAdv){
		var hrTracker = 0;
		var hdCount = 4;
		var html = '<table id="myblogMediaBrowser" cellpadding="2" cellspacing="2"><tbody>';
		var eventStr = '';
		if(isAdv == 'true'){
			hdCount = 5;
		}
		for(var i = 0; i< data.length; i++){
			if(hrTracker % hdCount == 0)
				html	+= '<tr>';
			html += '<td>';
			// Build the inner table
			switch(data[i].e){
				case 'ai': // attach image
					eventStr = 'myblog.attachImage(\''+ data[i].d + '\')'; 
					break;
				case 'ad': // attach document
					eventStr = 'myblog.attachDocument(\'' +  data[i].d[0] + '\',\'' + data[i].d[1] + '\');';
					break;
				case 'o':  //open folder
					eventStr = 'myblog.openFolder(\''+ data[i].d + '\', \''+isAdv+'\')';
					break;
			}
			
			html +=  '<div class="imgBrowserItem" onclick="' + eventStr + '">';
			html +=  '<table class="image-list"><tbody><tr><td>';
			html +=  '<img src="' + data[i].i + '" border="0" alt="' + data[i].c + '" />';
			html +=  '</td></tr></tbody></table>';
			html +=  '</div>';
			html +=  '<div class="imgBrowserCaption">' + data[i].c + '</div>';
			
			hrTracker++;
			if(hrTracker % hdCount == 0)
				html	+= '<tr>';
		}
		html += '</tbody></table>';
		if(isAdv == 'true'){
			jQuery('.mn_fileExplorerAdv').html(html);
		}else{
			jQuery('#mn_fileExplorer').html(html);
		}
	}
	
	this.browserAdvInit = function(){
		var html ='';
		html += '<table class="myAdvanceMediaBrowser" width="100%" cellspacing="8" border="0">';
		html += '<tbody>';
		html += '<tr>';
		
		html += '<td>';
		html += '</td>';
		
		html += '<td>';
		html += '</td>';
		
		html += '</tr>';
		
		html += '</tbody>';
		html += '</table>';
		
		html = '<table width="100%" border="0" cellspacing="8" class="myAdvanceMediaBrowser"><tr>			<td class="myAdvanceMediaBrowserList">			<div class="myAdvanceMediaPath">			Path:			</div><table id="myblogMediaBrowser"><tr><td>	<div class="imgBrowserItem" onclick="myblog.openFolder(\'\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/folderup.gif" title=".."/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">..</div></td><td>	<div class="imgBrowserItem" onclick="myblog.openFolder(\'/banners\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/bigfolder.gif" title="banners"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">banners</div></td><td>	<div class="imgBrowserItem" onclick="myblog.openFolder(\'/M_images\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/bigfolder.gif" title="M_images"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">M_images</div></td><td>	<div class="imgBrowserItem" onclick="myblog.openFolder(\'/smilies\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/bigfolder.gif" title="smilies"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">smilies</div></td><td>	<div class="imgBrowserItem" onclick="myblog.openFolder(\'/stories\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/bigfolder.gif" title="stories"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">stories</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//apply_f2.png\',\'http://j10.com/images//apply_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/apply_f2.png" title="apply_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">apply_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//archive_f2.png\',\'http://j10.com/images//archive_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/archive_f2.png" title="archive_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">archive_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//back_f2.png\',\'http://j10.com/images//back_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/back_f2.png" title="back_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">back_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//blank.png\',\'http://j10.com/images//blank.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/blank.png" title="blank.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">blank.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//cancel.png\',\'http://j10.com/images//cancel.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/cancel.png" title="cancel.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">cancel.png</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//cancel_f2.png\',\'http://j10.com/images//cancel_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/cancel_f2.png" title="cancel_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">cancel_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//css_f2.png\',\'http://j10.com/images//css_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/css_f2.png" title="css_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">css_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//edit_f2.png\',\'http://j10.com/images//edit_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/edit_f2.png" title="edit_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">edit_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//favicon.ico\',\'http://j10.com/images//favicon.ico\');">	<table>		<tr>			<td>				<img border="0" src="" title="favicon.ico"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">favicon.ico</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//html_f2.png\',\'http://j10.com/images//html_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/html_f2.png" title="html_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">html_f2.png</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8334.JPG\',\'http://j10.com/images//IMG_8334.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8334.JPG" title="IMG_8334.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8334.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8335.JPG\',\'http://j10.com/images//IMG_8335.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8335.JPG" title="IMG_8335.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8335.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8336.JPG\',\'http://j10.com/images//IMG_8336.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8336.JPG" title="IMG_8336.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8336.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8338.JPG\',\'http://j10.com/images//IMG_8338.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8338.JPG" title="IMG_8338.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8338.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8340.JPG\',\'http://j10.com/images//IMG_8340.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8340.JPG" title="IMG_8340.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8340.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8345.JPG\',\'http://j10.com/images//IMG_8345.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8345.JPG" title="IMG_8345.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8345.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8346.JPG\',\'http://j10.com/images//IMG_8346.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8346.JPG" title="IMG_8346.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8346.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8347.JPG\',\'http://j10.com/images//IMG_8347.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8347.JPG" title="IMG_8347.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8347.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8348.JPG\',\'http://j10.com/images//IMG_8348.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8348.JPG" title="IMG_8348.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8348.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8349.JPG\',\'http://j10.com/images//IMG_8349.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8349.JPG" title="IMG_8349.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8349.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8351.JPG\',\'http://j10.com/images//IMG_8351.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8351.JPG" title="IMG_8351.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8351.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8352.JPG\',\'http://j10.com/images//IMG_8352.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8352.JPG" title="IMG_8352.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8352.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8353.JPG\',\'http://j10.com/images//IMG_8353.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8353.JPG" title="IMG_8353.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8353.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8354.JPG\',\'http://j10.com/images//IMG_8354.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8354.JPG" title="IMG_8354.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8354.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8355.JPG\',\'http://j10.com/images//IMG_8355.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8355.JPG" title="IMG_8355.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8355.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8356.JPG\',\'http://j10.com/images//IMG_8356.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8356.JPG" title="IMG_8356.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8356.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8357.JPG\',\'http://j10.com/images//IMG_8357.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8357.JPG" title="IMG_8357.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8357.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8358.JPG\',\'http://j10.com/images//IMG_8358.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8358.JPG" title="IMG_8358.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8358.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8359.JPG\',\'http://j10.com/images//IMG_8359.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8359.JPG" title="IMG_8359.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8359.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8360.JPG\',\'http://j10.com/images//IMG_8360.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8360.JPG" title="IMG_8360.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8360.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8361.JPG\',\'http://j10.com/images//IMG_8361.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8361.JPG" title="IMG_8361.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8361.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8363.JPG\',\'http://j10.com/images//IMG_8363.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8363.JPG" title="IMG_8363.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8363.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8365.JPG\',\'http://j10.com/images//IMG_8365.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8365.JPG" title="IMG_8365.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8365.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8366.JPG\',\'http://j10.com/images//IMG_8366.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8366.JPG" title="IMG_8366.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8366.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8367.JPG\',\'http://j10.com/images//IMG_8367.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8367.JPG" title="IMG_8367.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8367.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8368.JPG\',\'http://j10.com/images//IMG_8368.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8368.JPG" title="IMG_8368.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8368.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8370.JPG\',\'http://j10.com/images//IMG_8370.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8370.JPG" title="IMG_8370.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8370.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8373.JPG\',\'http://j10.com/images//IMG_8373.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8373.JPG" title="IMG_8373.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8373.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8374.JPG\',\'http://j10.com/images//IMG_8374.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8374.JPG" title="IMG_8374.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8374.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8375.JPG\',\'http://j10.com/images//IMG_8375.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8375.JPG" title="IMG_8375.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8375.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8376.JPG\',\'http://j10.com/images//IMG_8376.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8376.JPG" title="IMG_8376.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8376.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8379.JPG\',\'http://j10.com/images//IMG_8379.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8379.JPG" title="IMG_8379.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8379.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8383.JPG\',\'http://j10.com/images//IMG_8383.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8383.JPG" title="IMG_8383.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8383.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8384.JPG\',\'http://j10.com/images//IMG_8384.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8384.JPG" title="IMG_8384.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8384.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8386.JPG\',\'http://j10.com/images//IMG_8386.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8386.JPG" title="IMG_8386.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8386.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8387.JPG\',\'http://j10.com/images//IMG_8387.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8387.JPG" title="IMG_8387.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8387.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8388.JPG\',\'http://j10.com/images//IMG_8388.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8388.JPG" title="IMG_8388.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8388.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8389.JPG\',\'http://j10.com/images//IMG_8389.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8389.JPG" title="IMG_8389.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8389.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8391.JPG\',\'http://j10.com/images//IMG_8391.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8391.JPG" title="IMG_8391.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8391.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8392.JPG\',\'http://j10.com/images//IMG_8392.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8392.JPG" title="IMG_8392.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8392.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8393.JPG\',\'http://j10.com/images//IMG_8393.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8393.JPG" title="IMG_8393.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8393.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8394.JPG\',\'http://j10.com/images//IMG_8394.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8394.JPG" title="IMG_8394.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8394.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8395.JPG\',\'http://j10.com/images//IMG_8395.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8395.JPG" title="IMG_8395.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8395.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8397.JPG\',\'http://j10.com/images//IMG_8397.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8397.JPG" title="IMG_8397.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8397.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8398.JPG\',\'http://j10.com/images//IMG_8398.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8398.JPG" title="IMG_8398.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8398.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8399.JPG\',\'http://j10.com/images//IMG_8399.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8399.JPG" title="IMG_8399.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8399.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8400.JPG\',\'http://j10.com/images//IMG_8400.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8400.JPG" title="IMG_8400.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8400.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8401.JPG\',\'http://j10.com/images//IMG_8401.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8401.JPG" title="IMG_8401.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8401.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8402.JPG\',\'http://j10.com/images//IMG_8402.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8402.JPG" title="IMG_8402.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8402.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8403.JPG\',\'http://j10.com/images//IMG_8403.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8403.JPG" title="IMG_8403.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8403.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8404.JPG\',\'http://j10.com/images//IMG_8404.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8404.JPG" title="IMG_8404.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8404.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8405.JPG\',\'http://j10.com/images//IMG_8405.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8405.JPG" title="IMG_8405.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8405.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8406.JPG\',\'http://j10.com/images//IMG_8406.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8406.JPG" title="IMG_8406.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8406.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8407.JPG\',\'http://j10.com/images//IMG_8407.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8407.JPG" title="IMG_8407.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8407.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8410.JPG\',\'http://j10.com/images//IMG_8410.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8410.JPG" title="IMG_8410.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8410.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8411.JPG\',\'http://j10.com/images//IMG_8411.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8411.JPG" title="IMG_8411.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8411.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8412.JPG\',\'http://j10.com/images//IMG_8412.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8412.JPG" title="IMG_8412.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8412.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8413.JPG\',\'http://j10.com/images//IMG_8413.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8413.JPG" title="IMG_8413.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8413.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8414.JPG\',\'http://j10.com/images//IMG_8414.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8414.JPG" title="IMG_8414.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8414.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8415.JPG\',\'http://j10.com/images//IMG_8415.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8415.JPG" title="IMG_8415.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8415.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8416.JPG\',\'http://j10.com/images//IMG_8416.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8416.JPG" title="IMG_8416.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8416.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8418.JPG\',\'http://j10.com/images//IMG_8418.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8418.JPG" title="IMG_8418.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8418.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8419.JPG\',\'http://j10.com/images//IMG_8419.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8419.JPG" title="IMG_8419.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8419.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8420.JPG\',\'http://j10.com/images//IMG_8420.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8420.JPG" title="IMG_8420.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8420.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8421.JPG\',\'http://j10.com/images//IMG_8421.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8421.JPG" title="IMG_8421.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8421.JPG</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8422.JPG\',\'http://j10.com/images//IMG_8422.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8422.JPG" title="IMG_8422.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8422.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8423.JPG\',\'http://j10.com/images//IMG_8423.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8423.JPG" title="IMG_8423.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8423.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//IMG_8424.JPG\',\'http://j10.com/images//IMG_8424.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FIMG_8424.JPG" title="IMG_8424.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">IMG_8424.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="index.html"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">index.html</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//joomla_logo_black.jpg\',\'http://j10.com/images//joomla_logo_black.jpg\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2Fjoomla_logo_black.jpg" title="joomla_logo_black.jpg"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">joomla_logo_black.jpg</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//menu_divider.png\',\'http://j10.com/images//menu_divider.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/menu_divider.png" title="menu_divider.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">menu_divider.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="MVI_8381.AVI"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">MVI_8381.AVI</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="MVI_8381.THM"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">MVI_8381.THM</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="MVI_8408.AVI"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">MVI_8408.AVI</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="MVI_8408.thm"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">MVI_8408.thm</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="MVI_8409.AVI"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">MVI_8409.AVI</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="MVI_8409.THM"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">MVI_8409.THM</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="MVI_8417.AVI"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">MVI_8417.AVI</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/components/com_myblog/images/files.png\',\'http://j10.com/components/com_myblog/images/files.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/components/com_myblog/images/files.png" title="MVI_8417.THM"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">MVI_8417.THM</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//new_f2.png\',\'http://j10.com/images//new_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/new_f2.png" title="new_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">new_f2.png</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//powered_by.png\',\'http://j10.com/images//powered_by.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2Fpowered_by.png" title="powered_by.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">powered_by.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//preview_f2.png\',\'http://j10.com/images//preview_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/preview_f2.png" title="preview_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">preview_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//publish_f2.png\',\'http://j10.com/images//publish_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/publish_f2.png" title="publish_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">publish_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//publish_x.png\',\'http://j10.com/images//publish_x.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/publish_x.png" title="publish_x.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">publish_x.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//save.png\',\'http://j10.com/images//save.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/save.png" title="save.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">save.png</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//save_f2.png\',\'http://j10.com/images//save_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/save_f2.png" title="save_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">save_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//STA_8362.JPG\',\'http://j10.com/images//STA_8362.JPG\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/index2.php?option=com_myblog&task=thumb&maxwidth=44&fn=C%3A%5Cxampp%5Chtdocs%5Cjoomla%5Cdev10%2Fimages%2FSTA_8362.JPG" title="STA_8362.JPG"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">STA_8362.JPG</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//tick.png\',\'http://j10.com/images//tick.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/tick.png" title="tick.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">tick.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//unarchive_f2.png\',\'http://j10.com/images//unarchive_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/unarchive_f2.png" title="unarchive_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">unarchive_f2.png</div></td><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//unpublish_f2.png\',\'http://j10.com/images//unpublish_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/unpublish_f2.png" title="unpublish_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">unpublish_f2.png</div></td></tr><tr><td>	<div class="imgBrowserItem" onclick="myblog.attachImage(\'http://j10.com/images//upload_f2.png\',\'http://j10.com/images//upload_f2.png\');">	<table>		<tr>			<td>				<img border="0" src="http://j10.com/images/upload_f2.png" title="upload_f2.png"/>			</td>		</tr>	</table>	</div>	<div class="imgBrowserCaption">upload_f2.png</div></td></table>			</td>			<td class="myAdvanceMediaThumbnail">thumbnails</td>		</tr>		<tr>			<td colspan="2">				<fieldset><legend>Upload</legend>					<input type="text" id="myAdvanceMediaBrowseUploadPath" />					<button>Upload</button>				</fieldset>			</td>		</tr></table>';
		
		var html = jQuery('#hImgBrowser').html();
		jQuery('div.azDialogText').html(html);
		if(jQuery('.mn_fileExplorerAdv div.white-loading').length != 0){
			this.openFolder('', true);
		}
		
	}
	
	this.sidebarShow = function(data){
		var dtid = data.prev().attr('dtid');
		
		switch(dtid){
			case '2':
				if(jQuery('#mn_fileExplorer div.white-loading').length != 0){
					this.openFolder('');
				}
				break;
		}
	}
	
	// hide all other div and show just the current div
	this.showMinitab = function(element, num){
		jQuery(element)
			.parent().children().removeClass('bold')
			.parent().parent().children()
			.slice(1)
			.each(function(i){
				if(i != num)
					jQuery(this).hide();
				else
					jQuery(this).show();
			});
		jQuery(element).addClass('bold').blur();
	}
	
// 	this.assignTags	= function(){		
// 		var checked	= jQuery('#tagListings').children().children().children(':input:checked');
// 		
// 		if(checked.length == 0){
// 			alert('Select a tag from the list above.');
// 			return;
// 		}
// 
// 		for(var i = 0; i < checked.length; i++){
// 			myblog.checkAddedTag(checked[i].value);
// 		}
// 		myblog.showMinitab(jQuery('#tagAssign'), 0);
// 	}

	this.bindAssignTag = function (){
		jQuery('#tagListings').children().children().children(':input').bind('click',function(){
			if(this.checked == true)
			{
				myblog.assignTag(this.value);
			}
			else
			{
				// If user decides to de-select this tag, remove it from the list
				myblog.removeTag(this.value);
			}
				
		});
	}
	
	this.removeTag	= function(value){
		// Remove element from tag listings
		var x 	= jQuery('#tagListFieldSet').children('span:contains("' + value + '")');
		
		// If the tags exists, we need to remove them
		if(jQuery(x).html() != null)
		{
			jQuery(x).remove();
		}
		
	}
	
	this.assignTag	= function(tag){
		myblog.checkAddedTag(tag);
	}
	
	this.checkAddedTag = function(value){
		var x 	= jQuery('#tagListFieldSet').children('span:contains("' + value + '")');
		
		if( jQuery('#notags').length > 0 )
		{
			jQuery('#notags').remove();
		}
		
		// Need to do checking if the current tag already exists in the cloud list.
		if(jQuery(x).html() == null){
			var html = '<span>';
			html	+= '<input type="hidden" name="tags[]" value="' + value + '" />';
			html	+= '<a>X</a>' + value;
			html	+= '</span>';
			jQuery('#tagListFieldSet').append(html);
		}
		
		myblog.bindAddedTag()
	}

	this.togglePermalink = function(){
	
		if(jQuery('#permalink-input').css('display') == 'none')
		{
			jQuery('#permalink-input').css('display', 'block');
			jQuery('#permalink-caption').hide();
			jQuery('#permalink-edit').hide();
			jQuery('#permalink-save').show();
		}
		else
		{
			jQuery('#permalink-input').css('display', 'none');
			jQuery('#permalink-caption').show();
			jQuery('#permalink-edit').show();
			jQuery('#permalink-save').hide();
			jQuery('#permalink-data').html( jQuery('#permalink').val() );
		}
	}
	
}
var myblog = new MyBlog();