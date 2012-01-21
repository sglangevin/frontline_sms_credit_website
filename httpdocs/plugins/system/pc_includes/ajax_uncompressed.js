function Jax()
{
	
	var loadingTimeout = 400;
	var iframe;
	
	this.loadingFunction = function(){};
	this.doneLoadingFunction = function(){};
	

	
	this.stringify = function(arg){
	    var c, i, l, o, u, v;
	
	    switch (typeof arg) {
	    case 'object':
	    	//alert('obj');
	        if (arg) {
	            if (arg.constructor == Array) {
	                o = '';
	                for (i = 0; i < arg.length; ++i) {
	                    v = this.stringify(arg[i]);
	                    if (o && (v !== u)) {
	                        o += ',';
	                    }
	                    if (v !== u) {
	                        o += v;
	                    } 
	                }
	                return '[' + o + ']';
	            } else if (typeof arg.toString != 'undefined') {
	                o = '';
	                for (i in arg) {
	                    v = this.stringify(arg[i]);
	                    if (v !== u) {
	                        if (o) {
	                            o += ',';
	                        }
	                        o += this.stringify(i) + ':' + v;
	                    }
	                }
	                return '{' + o + '}';
	            } else {
	                return;
	            }
	        }
	        //return 'null';
	        return '';
	    case 'unknown':
	    case 'undefined':
	    case 'function':
	        return u;
	    case 'string':
	    	arg = arg.replace(/"/g, "\\\"");
	        l = arg.length;
	        o = '"';
	        for (i = 0; i < l; i += 1) {
	            c = arg.charAt(i);
	            if (c >= ' ') {
	                if (c == '\\' || c == '"') {
	                    o += '\\';
	                }
	                o += c;
	            } else {
	                switch (c) {
	                case '"':
	                	o += '\\"';
	                	break;
	                case '\b':
	                    o += '\\b';
	                    break;
	                case '\f':
	                    o += '\\f';
	                    break;
	                case '\n':
	                    o += '\\n';
	                    break;
	                case '\r':
	                    o += '\\r';
	                    break;
	                case '\t':
	                    o += '\\t';
	                    break;
	                default:
	                    c = c.charCodeAt();
	                    o += '\\u00';
						o += Math.floor(c / 16).toString(16);
						o += (c % 16).toString(16);
	                }
	            }
	        }
	        return o + '"';
	    default:
	        return String(arg);
	    }
	}
	
	/**
	 * Get XMLHttpObject
	 */	 	
	this.getRequestObject = function()
	{
		if (window.XMLHttpRequest) { // Mozilla, Safari,...
		   http_request = new XMLHttpRequest();
		} else if (window.ActiveXObject) { // IE
		    var msxmlhttp = new Array(
					'Msxml2.XMLHTTP.4.0',
					'Msxml2.XMLHTTP.3.0',
					'Msxml2.XMLHTTP',
					'Microsoft.XMLHTTP');
		    
		    for (var i = 0; i < msxmlhttp.length; i++) {
				try {
					http_request = new ActiveXObject(msxmlhttp[i]);
				} catch (e) {
					http_request = null;
				}
			}
		}
		
		if (!http_request) {
		   alert('Unfortunatelly you browser doesn\'t support this feature.');
		   return false;
		}
		
		return http_request;
	}

	/**
	 * xajax.$() is shorthand for document.getElementById()
	 */
	this.$ = function(sId)
	{
		if (!sId) {
			return null;
		}
		var returnObj = document.getElementById(sId);
		if (!returnObj && document.all) {
			returnObj = document.all[sId];
		}
		
		return returnObj;
	}
	
	

   this.addEvent = function ( obj, type, fn ) {
     if ( obj.attachEvent ) {
       obj['e'+type+fn] = fn;
       obj[type+fn] = function(){obj['e'+type+fn]( window.event );}
       obj.attachEvent( 'on'+type, obj[type+fn] );
     } else{
       obj.addEventListener( type, fn, false );}
   }
   
   this.removeEvent = function ( obj, type, fn ) {
     if ( obj.detachEvent ) {
       obj.detachEvent( 'on'+type, obj[type+fn] );
       obj[type+fn] = null;
     } else{
       obj.removeEventListener( type, fn, false );}
   }


	
	this.submitITask = function(comName, func, postData, responseFunc){
		var xmlReq = this.buildXmlReq(comName, func, postData, responseFunc, true);
		this.loadingFunction();
	    if(!this.iframe){
			this.iframe = document.createElement('iframe');
			this.iframe.setAttribute("id", 'ajaxIframe');
			this.iframe.setAttribute("height", 0);
			this.iframe.setAttribute("width", 0);
			this.iframe.setAttribute("border", 0);
			this.iframe.style.visibility = 'hidden';
			document.body.appendChild(this.iframe);
			this.iframe.src = xmlReq;
		} else {
			this.iframe.src = xmlReq;
		}
	}
	
	this.extractIFrameBody = function(iFrameEl) {
	  var doc = null;
	  if (iFrameEl.contentDocument) { // For NS6
	    doc = iFrameEl.contentDocument; 
	  } else if (iFrameEl.contentWindow) { // For IE5.5 and IE6
	    doc = iFrameEl.contentWindow.document;
	  } else if (iFrameEl.document) { // For IE5
	    doc = iFrameEl.document;
	  } else {
	    alert("Error: could not find sumiFrame document");
	    return null;
	  }
	  return doc.body;
	
	}
	
	this.buildXmlReq = function(comName, func, postData, responseFunc, iframe){
		var xmlReq = '';
		if(iframe){
			xmlReq += '?';}
		else{
			xmlReq += '&';}
			
	    xmlReq += 'option='+ comName;
	    xmlReq += '&no_html=1';
	    xmlReq += '&task=azrul_ajax';
	    xmlReq += '&func=' + func; 
	    if(postData){
	        xmlReq += "&" + postData;
	    }
	    
	    return xmlReq;
	}
	
	/**
	 * Sumbit ajax task
	 */
	this.submitTask = function(comName, func, postData, responseFunc){
	
	    var xmlhttp =  this.getRequestObject();
	    var targetUrl = jax_live_site;
	    
	    xmlhttp.open('POST', targetUrl, true);
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4) {
	            if (xmlhttp.status == 200){
	            	jax.doneLoadingFunction();
	            	jax.processResponse(xmlhttp.responseText);
	            }else {
	                // warning ajax fails
	            }
	        }
	    }
						
	    var id = 1;
	    var xmlReq = this.buildXmlReq(comName, func, postData, responseFunc);
		
		this.loadingFunction();
	    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    xmlhttp.send(xmlReq);
	}
	
	this.processIResponse = function(){
		jax.doneLoadingFunction();
		var resp = (this.extractIFrameBody(this.iframe).innerHTML);
 		resp = resp.replace(/&lt;/g, "<");
 		resp = resp.replace(/&gt;/g, ">");
 		resp = resp.replace(/&amp;/g, "&");
 		resp = resp.replace(/&quot;/g, '"');
 		resp = resp.replace(/&#39;/g, "'");
		this.processResponse(resp);
	}
	
	/**
	 * Process the json string
	 */	 	
	this.processResponse = function(responseTxt){
		// clean up any previous error
		var result = eval( responseTxt );
		
		// we now have an array, that contains an array.
		for(var i=0; i<result.length;i++){
		
			var cmd 		= result[i][0];
			var id			= result[i][1];
			var property 	= result[i][2];
			var data 		= result[i][3];

			var objElement = this.$(id);
			
			switch(cmd){
				case 'as': 	// assign or clear
					if(objElement){
// 						data = data.replace(/"/g, "\\\"");
// 						data = data.replace(/&#123;/g, "{");
// 						data = data.replace(/&#125;/g, "}");
						eval("objElement."+property+"=  data \; ");
					}
						
					break;
					
				case 'al':	// alert
					if(data){
						alert(data);}
					break;
				
				case 'ce':
					this.create(id,property, data);
					break;
					
				case 'rm':
					this.remove(id);
					break;
					
				case 'cs':	// call script
					var scr = id + '(';
					if(this.isArray(data)){
						scr += '(data[0])';
						for (var l=1; l<data.length; l++) {
							scr += ',(data['+l+'])';
						}
					} else {
						scr += 'data';
					}
					scr += ');';
					eval(scr);
					break;
				
				default:
					alert("Unknow command: " + cmd);
			}
		}
		
		delete responseTxt;
	}
	
	/**
	 *
	 */	 	
	this.isArray =  function(obj) { // this works
		if(obj){
			return obj.constructor == Array;
		}
		return false;		
	}
	
	this.buildCall = function(comName, sFunction){
	}
	this.icall = function(comName, sFunction){
		var arg = "";
		if(arguments.length > 2){
			for(var i=2; i < arguments.length; i++){
				var a = arguments[i];
				if(this.isArray(a)){
					arg += "arg" + i + "=" + this.stringify(a) + "&";
				}else if(typeof a =="string"){		
					var t = new Array('_d_', encodeURIComponent(a));
					arg += "arg" + i + "=" + this.stringify(t) + "&";
				} else {
					var t = new Array('_d_', encodeURIComponent(a));
					arg += "arg" + i + "=" + this.stringify(t) + "&";
				}
			}
		}

		if(jax_site_type == '1.5'){
			this.submitTask(comName, sFunction, arg);
		} else {
			this.submitITask(comName, sFunction, arg);
		}
		
	}
	
	/**
	 * Function call to PHP function
	 */
	this.call = function(comName, sFunction){
		
		var arg = "";
		if(arguments.length > 2){
			for(var i=2; i < arguments.length; i++){
				var a = arguments[i];
				if(this.isArray(a)){
					arg += "arg" + i + "=" + this.stringify(a) + "&";
				}else if(typeof a =="string"){
					a = a.replace(/"/g, "&quot;");
		
					var t = new Array('_d_', encodeURIComponent(a));
					arg += "arg" + i + "=" + this.stringify(t) + "&";
				} else {
					var t = new Array('_d_', encodeURIComponent(a));
					arg += "arg" + i + "=" + this.stringify(t) + "&";
				}
			}
		}
		this.submitTask(comName, sFunction, arg);
	}
	
	this.create = function(sParentId, sTag, sId){
		var objParent = this.$(sParentId);
		objElement = document.createElement(sTag);
		objElement.setAttribute('id',sId);
		if (objParent){
			objParent.appendChild(objElement);}
	}
	
	this.remove = function(sId){
		objElement = this.$(sId);
		if (objElement && objElement.parentNode && objElement.parentNode.removeChild)
		{
			objElement.parentNode.removeChild(objElement);
		}
	}
	
	/**
	 * Return an array of data within the form object
	 */	 	
	this.getFormValues = function(frm){
		var objForm;
		objForm = this.$(frm);

		if (!Array.prototype.indexOf)
		{
			Array.prototype.indexOf = function(elt /*, from*/)
			{
				var len = this.length;
				
				var from = Number(arguments[1]) || 0;
				from = (from < 0)
				? Math.ceil(from)
				: Math.floor(from);
				if (from < 0)
				from += len;
				
				for (; from < len; from++)
				{
					if (from in this &&
						this[from] === elt)
					return from;
				}
				return -1;
			};
		}
		
		var postData = new Array();
		if (objForm && objForm.tagName == 'FORM'){
			var formElements = objForm.elements;
            
			//uses for checkbox elements									
			var assCheckbox = new Array();
			var assCntIdx   = 0;
			//var startIdx    = 0;
			
			// Array values
			var arrayHiddenValues	= new Array();
			var arrayHiddenCount	= 0;
			
			if(formElements.length > 0){			
				for( var i=0; i < formElements.length; i++)
				{
					if (!formElements[i].name)
					{
						continue;
					}
					if (formElements[i].type && (formElements[i].type == 'radio' || formElements[i].type == 'checkbox') && formElements[i].checked == false)
					{
						continue;
					}
					
					var name = formElements[i].name;
					
					if (name)
					{
						if(formElements[i].type=='select-multiple')
						{
							postData[i] = new Array();
							
							for (var j = 0; j < formElements[i].length; j++)
							{
								if (formElements[i].options[j].selected === true)
								{
									var value = formElements[i].options[j].value;
									postData[i][j] = new Array(name, encodeURIComponent(value));
								}
							}
							//startIdx++;
						}
						else if(formElements[i].type=='checkbox')
						{
						    if(assCheckbox.indexOf(formElements[i].name) == -1)
							{
						       assCheckbox[assCntIdx] = formElements[i].name
						       assCntIdx++;
							}
						}
						else if( formElements[i].type == 'hidden' )
						{
							if( arrayHiddenValues.indexOf( formElements[i].name ) == -1 )
							{
								arrayHiddenValues[ arrayHiddenCount ]	= formElements[ i ].name;
								arrayHiddenCount++;
							}
						}
						else
						{					
							var value = formElements[i].value;
							//value.replace(/"/g, "\\\"");
							value = value.replace(/"/g, "&quot;");
							postData[i] = new Array(name, encodeURIComponent(value));
							//startIdx++;
						}
					}
									 
				}
			}//end if

			// Process hidden values
			if( arrayHiddenValues.length > 0 )
			{

				for( var i =0 ;i < arrayHiddenValues.length; i++ )
				{
					var hiddenElement	= document.getElementsByName( arrayHiddenValues[ i ] );
					
					if( hiddenElement )
					{
						// Test if the hidden elements is array when same name is used.
						if( hiddenElement.length > 1 )
						{
							var curLen			= postData.length;
							postData[curLen]	= new Array();
							
							for(var j=0; j < hiddenElement.length; j++)
							{
				               var value			= hiddenElement[j].value;							       
						       value				= value.replace(/"/g, "&quot;");							       
						       postData[curLen][j]	= new Array(arrayHiddenValues[i], encodeURIComponent(value));
							}
						}
						else
						{
							var value	= hiddenElement[0].value;
							value		= value.replace(/"/g, "&quot;");
							postData[postData.length] = new Array(arrayHiddenValues[i], encodeURIComponent(value));
						}
					}
				}
			}
			
			/****
			 * Use postData.length to determine the current length of the array. Don't need to use startidx
			 * since we only need to append the checkbox values.
			 ***/			 			 			
			//process checkbox elements here.			
			if(assCheckbox.length > 0)
			{			    
				for(var i=0 ; i <  assCheckbox.length; i++)
				{
				   var objCheckbox = document.getElementsByName(assCheckbox[i]);
				   
				   if(objCheckbox)
				   {
				       //multiple checkbox processing here
				       if(objCheckbox.length > 1)
					   {
							var tmpIdx = 0;

							//postData[i + startIdx] = new Array();
							var curLen	= postData.length;
							postData[curLen] = new Array();
							
							for(var j=0; j < objCheckbox.length; j++)
							{
					           if(objCheckbox[j].checked)
							   {
					               var value = objCheckbox[j].value;							       
							       value = value.replace(/"/g, "&quot;");							       
							       postData[curLen][j]	= new Array(assCheckbox[i], encodeURIComponent(value));
							       //postData[i + startIdx][j] = new Array(assCheckbox[i], encodeURIComponent(value));
								   tmpIdx++;							   
							   }//end if
					       }//end for
					       //if(tmpIdx > 0) {startIdx++;}
				       }
					   else
					   {
				           //single checkbox proccessing				           
				           if(objCheckbox[0].checked)
						   {
								var value	= objCheckbox[0].value;
								value		= value.replace(/"/g, "&quot;");
								postData[postData.length] = new Array(assCheckbox[i], encodeURIComponent(value));
								//postData[i + startIdx] = new Array(assCheckbox[i], encodeURIComponent(value));
								//startIdx++;
						   }//end ff
				       }
				   
				   }//end if
				}//end for
			}//end if
			
		}
		
		return postData;
	}	
}

function jax_iresponse(){
	jax.processIResponse();
}
var jax = new Jax();
