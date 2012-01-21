/*
/**
* CHRONOFORMS version 3.0 
* Copyright (c) 2008 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
You are not allowed to copy or use or rebrand or sell any code at this page under your own name or any other identity!
* See readme.html.
* Visit http://www.ChronoEngine.com for regular update and information.
**/
Element.extend({
    highlight: function(color){
        var style = this.getStyle('background-color');
        style = (style == 'transparent') ? '#ffffff' : style;
        new Fx.Style(this,'background-color').start(color || '#face8f', style);
        return this;
    },
	injectHTML: function(content, where){
		new Element('div').setHTML(content).getChildren().inject(this, where);
		return this;
	},
	showProperties: function(ParentTag){
		var Prop = new ELEMPROP(ParentTag, this);
		return Prop;
	}
});

function dodragging(container, drop_container){
	var drop = container;//$(container);
	var dropFx = drop.effect('background-color', {wait: false}); // wait is needed so that to toggle the effect,
	//var counter = 0; 
	//var ChronoCode = '';
	$$('.item').each(function(item){
	 
		item.addEvent('mousedown', function(e) {
			e = new Event(e).stop();
	 
			var clone = this.clone()
				.setStyles(this.getCoordinates()) // this returns an object with left/top/bottom/right, so its perfect
				.setStyles({'opacity': 0.7, 'position': 'absolute'})
				.addEvent('emptydrop', function() {
					this.remove();
					drop.removeEvents();
				}).inject(document.body);
	 		
			
			drop.addEvents({
				'drop': function() {
					drop.removeEvents();
					var droptop = clone.getTop();
					clone.remove();
					// Check created item type
					var thisitemtype = item.clone().getFirst().getProperty('id');
					var theitem = new Element('div').setProperty("class", 'form_element');
					// add proper item
					var addlabel = 0;
					if(thisitemtype == 'cf_textbox'){
						theitem.empty();
						var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'text_'+counter);
						newTextbox.createElement().injectTop(theitem);
						theitem.addClass('cf_textbox');
						addlabel = 1;
					}else if(thisitemtype == 'cf_textarea'){
						theitem.empty();
						var newTextArea = new CFTEXTAREA('cf_inputbox', '30', '3', 'text_'+counter);
						newTextArea.createElement().injectTop(theitem);
						theitem.addClass('cf_textarea');
						addlabel = 1;
					}else if(thisitemtype == 'cf_password'){
						theitem.empty();
						var newPassword = new CFPASSWORD('cf_inputbox', '30', 'text_'+counter);
						newPassword.createElement().injectTop(theitem);
						theitem.addClass('cf_password');
						addlabel = 1;
					}else if(thisitemtype == 'cf_hidden'){
						theitem.empty();
						var newHidden = new CFHIDDEN('','hidden_'+counter);
						newHidden.createElement().injectTop(theitem);
						theitem.addClass('cf_hidden');
						addlabel = 0;
						var newLabel = new CFLABEL('cf_label', 'Hidden field', thistag+'_'+counter);
						newLabel.createElement().injectTop(theitem);
					}else if(thisitemtype == 'cf_dropdown'){
						theitem.empty();
						var newSelect = new CFSELECT('cf_inputbox',  '1', 'select_'+counter);
						newSelect.createElement().injectTop(theitem);
						theitem.addClass('cf_dropdown');
						addlabel = 1;
					}else if(thisitemtype == 'cf_checkbox'){
						theitem.empty();
						var newCheckbox = new CFCHECKBOX('cf_inputbox',  '1', 'check');
						newCheckbox.createElement().injectTop(theitem);
						theitem.addClass('cf_checkbox');
						addlabel = 1;
					}else if(thisitemtype == 'cf_radiobutton'){
						theitem.empty();
						var newRadio = new CFRADIO('cf_inputbox',  '1', 'radio');
						newRadio.createElement().injectTop(theitem);
						theitem.addClass('cf_radiobutton');
						addlabel = 1;
					}else if(thisitemtype == 'cf_text'){
						theitem.empty();
						var newSpan = new CFSPAN('cf_text', 'Click me to Edit', 'text_'+counter);
						newSpan.createElement().injectTop(theitem);
						theitem.addClass('cf_text');
						addlabel = 0;
					}else if(thisitemtype == 'cf_heading'){
						theitem.empty();
						var newHeading = new CFHEADING('cf_text', 'Click me to Edit', 'text_'+counter);
						newHeading.createElement().injectTop(theitem);
						theitem.addClass('cf_heading');
						addlabel = 0;
					}else if(thisitemtype == 'cf_button'){
						theitem.empty();
						var newButton = new CFBUTTON('cf_button', 'Submit', 'button_'+counter);
						newButton.createElement().injectTop(theitem);
						theitem.addClass('cf_button');
						addlabel = 0;
					}else if(thisitemtype == 'cf_fileupload'){
						theitem.empty();
						var newFile = new CFFILE('cf_inputbox', '20', 'file_'+counter);
						newFile.createElement().injectTop(theitem);
						theitem.addClass('cf_fileupload');
						addlabel = 1;
					}else if(thisitemtype == 'cf_datetimepicker'){
						theitem.empty();
						var newDatePicker = new CFDATEPICKER('cf_datetime', '20', 'date_'+counter);
						newDatePicker.createElement().injectTop(theitem);
						theitem.addClass('cf_datetimepicker');
						addlabel = 1;
					}else if(thisitemtype == 'cf_captcha'){
						theitem.empty();
						var newCaptcha = new CFCAPTCHA('cf_captcha', '20', 'captcha_'+counter);
						newCaptcha.createElement().injectTop(theitem);
						theitem.addClass('cf_captcha');
						addlabel = 1;
					}else if(thisitemtype == 'cf_placeholder'){
						theitem.empty();
						var newPlaceHolder = new CFPLACEHOLDER('cf_placeholder', '20', 'placeholder_'+counter);
						newPlaceHolder.createElement().injectTop(theitem);
						theitem.addClass('cf_placeholder');
						addlabel = 0;
					}else if(thisitemtype == 'cf_multiholder'){
						theitem.empty();
						var newMultiHolder = new CFMULTIHOLDER('cf_multiholder', '20', 'multiholder_'+counter);
						newMultiHolder.createElement().injectTop(theitem);
						theitem.addClass('cf_multiholder');
						addlabel = 1;
					}else {}
					// get the added item type
					var thistag = theitem.getFirst().getTag();
					if(thistag == 'input'){
						thistag = theitem.getFirst().getProperty('type');
					}
					
					// add label
					if(addlabel){
						var newLabel = new CFLABEL('cf_label', 'Click Me to Edit', thistag+'_'+counter);
						newLabel.createElement().injectTop(theitem);
					}
										
					form_item = new Element('div', {"class": 'form_item', 'title': 'form_item'+counter});
					theitem.injectInside(form_item);
					theitem = form_item;
					if(thisitemtype == 'cf_multiholder'){
						//dodragging(theitem, theitem.getElement('div[class=multi_container]'));
					}
					
					// add main attributes
					theitem.getLast().injectHTML('<div class="delete_icon"><img src="components/com_chronocontact/css/images/icon_delete.gif" alt="delete" width="15" height="15"  /></div>', 'after');
					theitem.getLast().setStyle('display', 'none');
					theitem.getLast().addEvent('click', function(e) {
						new Event(e).stop();
						this.getParent().remove();
						$$('div.Propertiesitem').each(function(item){
							item.setStyle('display','none');
						});
					})
					theitem.getLast().injectHTML('<div class="config_icon"><img src="components/com_chronocontact/css/images/config.png" alt="Config" width="15" height="15"  /></div>', 'after');
					theitem.getLast().addEvent('click', function(e) {
						new Event(e).stop();
						$ES('.form_item', container).each(function(item2){
							item2.setStyle('border', '0px solid #000');
							$E('.delete_icon', item2).setStyle('display', 'none');
						});
						$$('div.Propertiesitem').each(function(item){
							item.setStyle('display','none');
						});
						theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
						theitem.setStyle('border', '1px solid #000');		
						$E('.delete_icon', theitem).setStyle('display', 'inline');
						theitem.showProperties(theitem.getTag());			
						$('formbuilder').setStyle('height', ( (container.getCoordinates().height + $('top_column').getCoordinates().height) > $('right_column').getCoordinates().height ) ? (container.getCoordinates().height + $('top_column').getCoordinates().height) : $('right_column').getCoordinates().height );
					})
					//theitem.getLast().injectHTML('<div class="delete_icon"><img src="components/com_chronocontact/css/images/sort.png" alt="delete" width="15" height="15"  /></div>', 'after');
					theitem.getLast().injectHTML('<span class="drag" style="cursor: move; height:auto; width: 15px;"><img src="components/com_chronocontact/css/images/sort.png" alt="Sort" width="15" height="15"  /></span>');
					theitem.getLast().injectHTML('<div class="slabel" style="display:none;"></div>', 'after');
					theitem.getLast().injectHTML('<div class="clear">&nbsp;</div>', 'after');
					
					counter = counter + 1;
					
					theitem.addEvents({
						'mouseover': function(e) {
							//new Event(e).stop();
							theitem.effect('background-color', {wait: false, duration: 100}).start('E7DFE7','E7DFE7');							
						},
						'mouseout': function(e) {
							//new Event(e).stop();
							theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
						},
						'click': function(e) {
							//new Event(e).stop();
							$ES('.form_item', container).each(function(item2){
								item2.setStyle('border', '0px solid #000');
								$E('.delete_icon', item2).setStyle('display', 'none');
							});
							$$('div.Propertiesitem').each(function(item){
								item.setStyle('display','none');
							});
							theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
							theitem.setStyle('border', '1px solid #000');		
							$E('.delete_icon', theitem).setStyle('display', 'inline');
							this.showProperties(this.getTag());			
							$('formbuilder').setStyle('height', ( (container.getCoordinates().height + $('top_column').getCoordinates().height) > $('right_column').getCoordinates().height ) ? (container.getCoordinates().height + $('top_column').getCoordinates().height + 150) : $('right_column').getCoordinates().height + 150);
						}			
					});
					
					var inputwidth = 100;
					if($chk(theitem.getFirst().getFirst().getNext())){
						inputwidth = theitem.getFirst().getFirst().getNext().getStyle('width').toInt();
					}
					/*theitem.makeResizable({
						modifiers: {x: 'width', y: false},
						limit: {x: [inputwidth + 45 + 30, 550]}					  
					});*/
					var dropped = 0;
					$ES('.form_item', container).each(function(item2){
						var item2co = item2.getCoordinates();
						if(Math.abs(item2.getTop() - droptop) < item2co['height']){ 
							theitem.injectBefore(item2);
							dropped = 1;
						}
					});
					if(!dropped)
					theitem.inject(drop_container);
					//new Element('input', {'name':'slabel[]', 'type':'hidden', 'id':'slabel_'+theitem.getProperty('title'), 'value':''}).injectAfter($('uploadfields'));
					$('formbuilder').setStyle('height', ( (container.getCoordinates().height + $('top_column').getCoordinates().height) > $('right_column').getCoordinates().height ) ? (container.getCoordinates().height + $('top_column').getCoordinates().height + 150) : $('right_column').getCoordinates().height + 150);
					new Sortables(container, {
						handles: 'span.drag'			
					});
					
					dropFx.start('7389AE').chain(dropFx.start.pass('ffffff', dropFx));
				},
				'over': function() {
					dropFx.start('98B5C1');
				},
				'leave': function() {
					dropFx.start('ffffff');
				}
			});
	 
			
			var drag = clone.makeDraggable({
				droppables: [drop]
			}); // this returns the dragged element
			
			
			drag.start(e); // start the event manual
			
		});
	 
	});	
}

window.addEvent('domready', function() {
	dodragging($('left_column'), $('left_column'));
	var Tips1 = new ChronoTips($('cf_to'));
	var Tips2 = new ChronoTips($('cf_dto'));
	var Tips3 = new ChronoTips($('cf_subject'));
	var Tips4 = new ChronoTips($('cf_dsubject'));
	var Tips5 = new ChronoTips($('cf_cc'));
	var Tips6 = new ChronoTips($('cf_dcc'));
	var Tips7 = new ChronoTips($('cf_bcc'));
	var Tips8 = new ChronoTips($('cf_dbcc'));
	var Tips9 = new ChronoTips($('cf_fromname'));
	var Tips10 = new ChronoTips($('cf_dfromname'));
	var Tips11 = new ChronoTips($('cf_fromemail'));
	var Tips12 = new ChronoTips($('cf_dfromemail'));
	var Tips90 = new ChronoTips($('cf_replytoname'));
	var Tips100 = new ChronoTips($('cf_dreplytoname'));
	var Tips110 = new ChronoTips($('cf_replytoemail'));
	var Tips120 = new ChronoTips($('cf_dreplytoemail'));
	
	var TipNewEmail = new ChronoTips($('cf_newemail'));
	var TipDelEmail = new ChronoTips($('cf_delemail'));	
	var TipFormPreview = new ChronoTips($('cf_formpreview'));
	var TipHTMLSource = new ChronoTips($('cf_htmlsource'));
	var TipSaveForm = new ChronoTips($('cf_saveform'));
	var TipSaveForm = new ChronoTips($('cf_saveform2'));
	var TipSaveForm = new ChronoTips($('cf_saveform3'));
	var TipSaveForm = new ChronoTips($('cf_saveform4'));
	var Tipinsertfieldname = new ChronoTips($('cf_insertfieldname'));
	var Tipinsertfieldname = new ChronoTips($('cf_insertfieldname2'));
	
	var TipFilesextensions = new ChronoTips($('prop_cf_fileupload_extensions'));
	var TipMulti = new ChronoTips($('prop_cf_multiholder_options'));
	var TipRedirectURL = new ChronoTips($('redirecturltip'));
	var TipSubmittext = new ChronoTips($('submittexttip'));
	
	$('emailslist').value = '';
	$ES('div[class=cf_email]', $('left_column2')).each(function(email){
		$('emailslist').value = $('emailslist').value + email.getProperty('name')+",";
	});
	
	$$('.emailitem').each(function(item){	 
		item.addEvent('mousedown', function(e) {
			e = new Event(e).stop();
	 		
			
			var clone = new Element('div', {'class':'emailitem'}).adopt( new Element('span', {'id':this.getFirst().getProperty('id')}).setText(this.getFirst().getText()) )//this.clone()
			//var clonetext = new Element('span', {'id':this.getFirst().getProperty('id')}).injectInside(clone);
				.setStyles(this.getCoordinates()) // this returns an object with left/top/bottom/right, so its perfect
				.setStyles({'opacity': 0.7, 'position': 'absolute'})
				.addEvent('emptydrop', function() {
					this.remove();
					$ES('div[class=cf_email]', $('left_column2')).each(function(droparea){
						droparea.removeEvents();
						droparea.addEvent('click', function() {
							$$('div.cf_email').each(function(item){
								item.setProperty('id','');
								item.setStyles({'border':'1px #111 solid'});
							});
							this.setProperty('id','cf_email_active');
							this.setStyles({'border':'3px #111 solid'});
							ShowEmailProperties();
						});	
					});
				}).inject(document.body);
				
				
			var thisitemtype = item.clone().getFirst().getProperty('id');
			var theitem = new Element('div').setProperty("class", 'form_element');
	 		$ES('div[class=cf_email]', $('left_column2')).each(function(droparea){
				droparea.addEvents({
					'drop': function() {
						$ES('div[class=cf_email]', $('left_column2')).each(function(dropareain){
							dropareain.removeEvents();
							dropareain.addEvent('click', function() {
								$$('div.cf_email').each(function(item){
									item.setProperty('id','');
									item.setStyles({'border':'1px #111 solid'});
								});
								this.setProperty('id','cf_email_active');
								this.setStyles({'border':'3px #111 solid'});
								ShowEmailProperties();
							});	
						});
						clone.remove();
						// add proper item
						if(thisitemtype == 'cf_to'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'to_'+counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'To', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dto'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dto_'+counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic To', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_subject'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'subject_'+counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Subject', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dsubject'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dsubject_'+counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic Subject', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_cc'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'cc_'+counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'CC', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dcc'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dcc_'+counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic CC', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_bcc'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'bcc_'+counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'BCC', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dbcc'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dbcc_'+counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic BCC', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_fromname'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'fromname_'+counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'From Name', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dfromname'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dfromname_'+counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic From Name', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_fromemail'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'fromemail_'+counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'From Email', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dfromemail'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dfromemail_'+counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic From Email', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						//v3.1
						}else if(thisitemtype == 'cf_replytoname'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'replytoname_'+counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'ReplyTo Name', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dreplytoname'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dreplytoname_'+counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic ReplyTo Name', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_replytoemail'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'replytoemail_'+counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'ReplyTo Email', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dreplytoemail'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dreplytoemail_'+counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic ReplyTo Email', 'input_'+counter);
							newLabel.createElement().injectTop(theitem);
						
						}else {}
						form_item = new Element('div').setProperty("class", 'form_item_email');
						theitem.injectInside(form_item);
						theitem = form_item;
						
						// add main attributes
						theitem.getLast().injectHTML('<div class="delete_icon_email"><img src="components/com_chronocontact/css/images/icon_delete.gif" alt="delete" width="15" height="15"  /></div>', 'after');
						theitem.getLast().setStyle('display', 'none');
						theitem.getLast().addEvent('click', function(e) {
							new Event(e).stop();
							this.getParent().remove();
							if(($chk($E('input[name^=to_]', droparea)) || $chk($E('input[name^=dto_]', droparea))) && ($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))) && ($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))) && ($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))) ){
								droparea.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
							}else{
								var email_params = $('params_'+droparea.getProperty('name')).value.split(',');
								$('params_'+droparea.getProperty('name')).value = email_params[0] + ',' + email_params[1] + ',' + '0,1,1';
								$('prop_cf_Email_enable').value = 0;
								$('prop_cf_Email_enable').disabled = true;
								droparea.effect('background-color', {wait: false, duration: 100}).start('FFAEA5','FFAEA5');
							}
						})
						theitem.getLast().injectHTML('<div class="clear">&nbsp;</div>', 'after');
						theitem.addEvents({
							'mouseover': function(e) {
								//new Event(e).stop();
								theitem.effect('background-color', {wait: false, duration: 100}).start('E7DFE7','E7DFE7');							
							},
							'mouseout': function(e) {
								//new Event(e).stop();
								theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
							},
							'click': function(e) {
								//new Event(e).stop();
								$ES('.form_item_email',droparea).each(function(item2){
									item2.setStyle('border', '0px solid #000');
									$E('.delete_icon_email', item2).setStyle('display', 'none');
								});
								theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
								theitem.setStyle('border', '1px solid #000');		
								$E('.delete_icon_email', theitem).setStyle('display', 'inline');
							}			
						});
						theitem.effect('background-color', {wait: false, duration: 100}).start('E7DFE7','E7DFE7');
						
						var dropthis = 1;
						if((thisitemtype == 'cf_fromemail')||(thisitemtype == 'cf_dfromemail')){
							if($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))){
								$('logdiv').setText('Only one From Email or Dynamic From Email is accepted per Email');
								dropthis = 0;
							}
						}
						if((thisitemtype == 'cf_fromname')||(thisitemtype == 'cf_dfromname')){
							if($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))){
								$('logdiv').setText('Only one From Name or Dynamic From Name is accepted per Email');
								dropthis = 0;
							}
						}
						if((thisitemtype == 'cf_replytoemail')||(thisitemtype == 'cf_dreplytoemail')){
							if($chk($E('input[name^=replytoemail_]', droparea)) || $chk($E('input[name^=dreplytoemail_]', droparea))){
								$('logdiv').setText('Only one ReplyTo Email or Dynamic ReplyTo Email is accepted per Email');
								dropthis = 0;
							}
						}
						if((thisitemtype == 'cf_replytoname')||(thisitemtype == 'cf_dreplytoname')){
							if($chk($E('input[name^=replytoname_]', droparea)) || $chk($E('input[name^=dreplytoname_]', droparea))){
								$('logdiv').setText('Only one ReplyTo Name or Dynamic ReplyTo Name is accepted per Email');
								dropthis = 0;
							}
						}
						if((thisitemtype == 'cf_subject')||(thisitemtype == 'cf_dsubject')){
							if($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))){
								$('logdiv').setText('Only one Subject or Dynamic Subject is accepted per Email');
								dropthis = 0;
							}
						}
						if(dropthis == 1)
						theitem.injectBefore(droparea.getLast());
						counter = counter + 1;
						if($chk($E('div[class=infodiv]', droparea)))$E('div[class=infodiv]', droparea).remove();
						if(($chk($E('input[name^=to_]', droparea)) || $chk($E('input[name^=dto_]', droparea))) && ($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))) && ($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))) && ($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))) ){
							droparea.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
							if(droparea.getProperty('id') == 'cf_email_active'){
								$('prop_cf_Email_enable').disabled = false;
							}
						}
						$('emailbuilder').setStyle('height',  ($('left_column2').getCoordinates().height + $('top_column2').getCoordinates().height) );
						
					},
					'over': function() {
						//dropFx.start('98B5C1');
					},
					'leave': function() {
						//dropFx.start('ffffff');
					}
				});
				
	 		});
			
			//counter = counter + 1;
			var drag2 = clone.makeDraggable({
				droppables: $ES('div[class=cf_email]', $('left_column2'))
			}); // this returns the dragged element
	 
			drag2.start(e); // start the event manual
		});
	 
	});
	
	
});
function Checkform(){
	if($E('input[id=form_title]', $('TB_window')).getProperty('value') == ''){
		alert('Enter form title first');
		return false;
	}else{
		// Prepare form code
		$('form_title_temp').setProperty('value', $E('input[id=form_title]', $('TB_window')).getProperty('value'));
		Output = $('left_column').clone();
		
		var ChronoCode = '';
		var uploadscount = 0;
		var uploadsfields = $('uploadfields').value.trim().split(',');
		$ES('div.form_item',Output).each(function(form_item){
			ChronoCode += '[';
			ChronoCode += 'type="' + form_item.getFirst().removeClass('form_element').className + '"';
			ChronoCode += 'CHRONO_CONSTANT_EOL';
			
			if((form_item.getFirst().className == 'cf_textbox')||(form_item.getFirst().className == 'cf_password')||(form_item.getFirst().className == 'cf_datetimepicker')){
				var Props = form_item.getFirst().getFirst().getNext().getProperties('id', 'name', 'class', 'type', 'size', 'maxlength', 'title');
				if(form_item.getFirst().getFirst().getStyle('display') == 'none'){
					Props['hidelabel'] = 1;	
				}else{
					Props['hidelabel'] = 0;	
				}
				Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				if($chk($E('div[class=tooltipdiv]', form_item.getFirst()))){
					Props['tooltiptext'] = $E('div[class=tooltipdiv]', form_item.getFirst()).getText();
				}else{
					Props['tooltiptext'] = '';	
				}
			}
			
			if((form_item.getFirst().className == 'cf_textarea')){
				var Props = form_item.getFirst().getFirst().getNext().getProperties('id', 'name', 'class', 'rows', 'cols', 'title');
				if(form_item.getFirst().getFirst().getStyle('display') == 'none'){
					Props['hidelabel'] = 1;	
				}else{
					Props['hidelabel'] = 0;	
				}
				Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				if($chk($E('div[class=tooltipdiv]', form_item.getFirst()))){
					Props['tooltiptext'] = $E('div[class=tooltipdiv]', form_item.getFirst()).getText();
				}else{
					Props['tooltiptext'] = '';	
				}
			}
			
			if((form_item.getFirst().className == 'cf_heading')||(form_item.getFirst().className == 'cf_text')){
				var Props = form_item.getFirst().getFirst().getProperties('class');
				if(form_item.getFirst().getFirst().getStyle('display') == 'none'){
					Props['hidelabel'] = 1;	
				}else{
					Props['hidelabel'] = 0;	
				}
				Props['tag'] = form_item.getFirst().getFirst().getTag();
				Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				if($chk($E('div[class=tooltipdiv]', form_item.getFirst()))){
					Props['tooltiptext'] = $E('div[class=tooltipdiv]', form_item.getFirst()).getText();
				}else{
					Props['tooltiptext'] = '';	
				}
				Props['hidelabel'] = 0;	
				Props['labelwidth'] = 0;
			}
			
			if(form_item.getFirst().className == 'cf_placeholder'){
				var Props = form_item.getFirst().getFirst().getProperties('class');
				Props['hidelabel'] = 0;
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				Props['hidelabel'] = 0;	
				Props['labelwidth'] = 0;
				Props['tooltiptext'] = '';
			}
			
			if(form_item.getFirst().className == 'cf_multiholder'){
				var Props = form_item.getFirst().getFirst().getNext().getProperties('class');
				if(form_item.getFirst().getFirst().getStyle('display') == 'none'){
					Props['hidelabel'] = 1;	
				}else{
					Props['hidelabel'] = 0;	
				}
				var theoptions = '';
				form_item.getFirst().getFirst().getNext().getElements('td').each(function(option){
					theoptions = theoptions + option.getText() +'*,*';
				});
				Props['thecells'] = theoptions;
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				Props['tooltiptext'] = '';
			}
			
			if((form_item.getFirst().className == 'cf_dropdown')){
				var Props = form_item.getFirst().getFirst().getNext().getProperties('id', 'name', 'class', 'size', 'title');
				//Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				var theoptions = '';
				form_item.getFirst().getFirst().getNext().getElements('option').each(function(option){
					theoptions = theoptions + option.getProperty('value') +'*,*';
				});
				Props['theoptions'] = theoptions;
				if(form_item.getFirst().getFirst().getStyle('display') == 'none'){
					Props['hidelabel'] = 1;	
				}else{
					Props['hidelabel'] = 0;	
				}
				Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				if($chk($E('div[class=tooltipdiv]', form_item.getFirst()))){
					Props['tooltiptext'] = $E('div[class=tooltipdiv]', form_item.getFirst()).getText();
				}else{
					Props['tooltiptext'] = '';	
				}
			}
			
			if((form_item.getFirst().className == 'cf_hidden')){
				var Props = form_item.getFirst().getFirst().getNext().getProperties('id', 'name');				
				Props['value'] = form_item.getFirst().getFirst().getNext().value;	
				Props['hidelabel'] = 0;	
				Props['labelwidth'] = 0;
				Props['tooltiptext'] = '';
			}
			
			if((form_item.getFirst().className == 'cf_captcha')){
				var Props = {};
				if(form_item.getFirst().getFirst().getStyle('display') == 'none'){
					Props['hidelabel'] = 1;	
				}else{
					Props['hidelabel'] = 0;	
				}
				Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				if($chk($E('div[class=tooltipdiv]', form_item.getFirst()))){
					Props['tooltiptext'] = $E('div[class=tooltipdiv]', form_item.getFirst()).getText();
				}else{
					Props['tooltiptext'] = '';	
				}
			}
			
			if((form_item.getFirst().className == 'cf_button')){
				var Props = {};				
				Props['value'] = form_item.getFirst().getFirst().value;	
				Props['name'] = form_item.getFirst().getFirst().getProperty('name');
				if($chk($E('div[class=tooltipdiv]', form_item.getFirst()))){
					Props['tooltiptext'] = $E('div[class=tooltipdiv]', form_item.getFirst()).getText();
				}else{
					Props['tooltiptext'] = '';	
				}
				Props['reset'] = '0';
				if($chk($E('input[type=reset]', form_item.getFirst()))){
					Props['reset'] = '1';
				}
				Props['hidelabel'] = 0;	
				Props['labelwidth'] = 0;
			}
			
			if((form_item.getFirst().className == 'cf_fileupload')){
				var Props = form_item.getFirst().getFirst().getNext().getProperties('id', 'name', 'class', 'size', 'title');
				if(form_item.getFirst().getFirst().getStyle('display') == 'none'){
					Props['hidelabel'] = 1;	
				}else{
					Props['hidelabel'] = 0;	
				}
				Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				if($chk($E('div[class=tooltipdiv]', form_item.getFirst()))){
					Props['tooltiptext'] = $E('div[class=tooltipdiv]', form_item.getFirst()).getText();
				}else{
					Props['tooltiptext'] = '';	
				}
				Props['data'] = uploadsfields[uploadscount];
				uploadscount = uploadscount + 1;
			}
			
			if((form_item.getFirst().className == 'cf_checkbox')||(form_item.getFirst().className == 'cf_radiobutton')){
				var Props = {};
				
				$('prop_cf_checkbox_options').value = '';
				var prop_cf_checkbox_options = Array(form_item.getFirst().getFirst().getNext().getElements('input').length);
				var counter = 0;
				form_item.getFirst().getFirst().getNext().getElements('input').each(function(input){
					prop_cf_checkbox_options[counter] = input.getProperty('value');
					if(counter == 0){
						Props['class'] = input.getProperty('class');	
					}
					counter = counter + 1;
					if(true){//if(form_item.getFirst().className == 'cf_radiobutton'){
						Props['name'] = input.getProperty('name');	
					}
				});
				Props['theoptions'] = prop_cf_checkbox_options.join("*,*");
				
				if(form_item.getFirst().getFirst().getStyle('display') == 'none'){
					Props['hidelabel'] = 1;	
				}else{
					Props['hidelabel'] = 0;	
				}
				Props['labelwidth'] = form_item.getFirst().getFirst().getStyle('width');
				Props['labeltext'] = form_item.getFirst().getFirst().getText();
				Props['title'] = form_item.getFirst().getFirst().getNext().getProperty('title');
				if($chk($E('div[class=tooltipdiv]', form_item.getFirst()))){
					Props['tooltiptext'] = $E('div[class=tooltipdiv]', form_item.getFirst()).getText();
				}else{
					Props['tooltiptext'] = '';	
				}
			}
			
			if($chk($E('div.slabel', form_item))){
				Props['slabel'] = $E('div.slabel', form_item).getText();
			}
			
			var result = '{' + 'CHRONO_CONSTANT_EOL';
			for (var i in Props) {
				result +=  i + ' = ' + Props[i] + 'CHRONO_CONSTANT_EOL';
			}
			result += '}';
			//alert(Props.length);
			//alert(result);
			ChronoCode += result;
			
			ChronoCode += ']';
			ChronoCode += 'CHRONO_CONSTANT_EOL';
		});
		//alert(ChronoCode);
		//alert($('form_code_temp').value);
		$('chronocode').setText(ChronoCode);
		//alert('1');
		//convert chronocode to XHTML
		/*var XHTMLELEMENTS = ChronoCode.split(']'+'\n').each(function(input){
			if((input.trim().test('type="cf_textbox"'))||(input.trim().test('type="cf_password"'))||(input.trim().test('type="cf_datetimepicker"'))){
				newinput = input.replace('[type="cf_textbox"'+'\n'+'{'+'\n', '').replace('[type="cf_password"'+'\n'+'{'+'\n', '').replace('[type="cf_datetimepicker"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
				//alert(newinput);
			}else if(input.trim().test('type="cf_textarea"')){
				newinput = input.replace('[type="cf_textarea"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
			}else if((input.trim().test('type="cf_text"'))||(input.trim().test('type="cf_heading"'))){
				newinput = input.replace('[type="cf_text"'+'\n'+'{'+'\n', '').replace('[type="cf_heading"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
			}else if(input.trim().test('type="cf_dropdown"')){
				newinput = input.replace('[type="cf_dropdown"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
			}else if(input.trim().test('type="cf_hidden"')){
				newinput = input.replace('[type="cf_hidden"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
			}else if(input.trim().test('type="cf_captcha"')){
				newinput = input.replace('[type="cf_captcha"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
			}else if(input.trim().test('type="cf_button"')){
				newinput = input.replace('[type="cf_button"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
			}else if(input.trim().test('type="cf_fileupload"')){
				newinput = input.replace('[type="cf_fileupload"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
			}else if((input.trim().test('type="cf_checkbox"'))||(input.trim().test('type="cf_radiobutton"'))){
				newinput = input.replace('[type="cf_checkbox"'+'\n'+'{'+'\n', '').replace('[type="cf_radiobutton"'+'\n'+'{'+'\n', '').replace('\n'+'}', '');
			}else {
				
			}
		});
		*/
		$ES('.delete_icon',Output).each(function(delete_div){
			delete_div.remove();
		});
		/*$ES('.cf_datetime',Output).each(function(date_field){
			date_field.setProperty('onClick',"new Calendar(this);");
		});*/
		/*$ES('',Output).each(function(element){
			element.removeEvents();
		});
		$ES('.form_item',Output).each(function(element){
			element.setStyle('border','0px');
		});*/
		Template = Output.clone();
		//$('form_code_temp').setText(Output.innerHTML.replace(/\$included="null"/g,'').replace(/\$events="null"/g,'').replace(/style=".*?"/g,''));
		//prepare fields names
		var fieldsnames= '';
		var fieldstypes= '';
		var datefieldsnames= '';
		var fieldsnames_array = new Array();
		var fieldstypes_array = new Array();
		var datefieldsnames_array = new Array();
		//alert($('html').value);
		$ES('input[type=submit]',Template).each(function(element){
			element.getParent().getParent().remove();
		});
		$ES('input[type=button]',Template).each(function(element){
			element.getParent().getParent().remove();
		});
		$ES('input[type=reset]',Template).each(function(element){
			element.getParent().getParent().remove();
		});
		$ES('div.cf_captcha',Template).each(function(element){
			element.getParent().remove();
		});
		$ES('input',Template).each(function(element){
			if(!fieldsnames_array.contains(element.getProperty('name'))){
				fieldsnames_array.push(element.getProperty('name'));
				fieldstypes_array.push(element.getProperty('type'));
			}
		});
		$ES('select',Template).each(function(element){
			if(!fieldsnames_array.contains(element.getProperty('name'))){
				fieldsnames_array.push(element.getProperty('name'));
				fieldstypes_array.push('select');
			}
		});
		$ES('textarea',Template).each(function(element){
			if(!fieldsnames_array.contains(element.getProperty('name'))){
				fieldsnames_array.push(element.getProperty('name'));
				fieldstypes_array.push('textarea');
			}
		});
		$ES('.cf_datetimepicker',Template).each(function(element){
			if(!datefieldsnames_array.contains(element.getFirst().getNext().getProperty('name'))){
				datefieldsnames_array.push(element.getFirst().getNext().getProperty('name'));
			}
		});
		$('fieldsnames').value = fieldsnames_array.join(',').replace(/\[\]/g,"");
		$('fieldstypes').value = fieldstypes_array.join(',').replace(/\[\]/g,"");
		$('datefieldsnames').value = datefieldsnames_array.join(',').replace(/\[\]/g,"");
		//Add templates for empty ones
		/*$ES('textarea[name^=editor_email_]', $('left_column3')).each(function(editor){
			if(!tinyMCE.get(editor.getProperty('id')).getContent()){
				$ES('input[type=submit]',Template).each(function(element){
					element.getParent().getParent().remove();
				});
				$ES('input[type=reset]',Template).each(function(element){
					element.getParent().getParent().remove();
				});
				$ES('div.cf_captcha',Template).each(function(element){
					element.getParent().remove();
				});
				$ES('input',Template).each(function(element){
					element.replaceWith(new Element('span').setText('{'+element.getProperty('name').replace("[]","")+'}'));
				});
				$ES('select',Template).each(function(element){
					element.replaceWith(new Element('span').setText('{'+element.getProperty('name').replace("[]","")+'}'));
				});
				$ES('textarea',Template).each(function(element){
					element.replaceWith(new Element('span').setText('{'+element.getProperty('name').replace("[]","")+'}'));
				});
				
				extratemplate = new Element('textarea', { 'name': 'extra_'+editor.getProperty('id'), 'rows':'20', 'cols':'75', 'styles': {'width':'100%', 'height':'350px' } });
				extratemplate.setText(Template.innerHTML.replace(/\$included="null"/g,'').replace(/\$events="null"/g,'').replace(/style=".*?"/g,''));
				extratemplate.inject($('left_column3'));
				//tinyMCE.get(editor.getProperty('id')).execCommand('mceInsertContent',false, Template.innerHTML.replace(/\$included="null"/g,'').replace(/\$events="null"/g,'').replace(/style=".*?"/g,''));
			}
		});*/
		// Prepare Emails
		Output2 = $('left_column2').clone();
		var emailstring = '';
		var arrcount = 0;
		
		$ES('.cf_email',Output2).each(function(emailitem){
			// Define arrays
			var toarray = new Array();
			var dtoarray = new Array();
			var subarray = new Array();
			var dsubarray = new Array();
			var ccarray = new Array();
			var dccarray = new Array();
			var bccarray = new Array();
			var dbccarray = new Array();
			var fromnamearray = new Array();
			var dfromnamearray = new Array();
			var fromemailarray = new Array();
			var dfromemailarray = new Array();
			var replytonamearray = new Array();
			var dreplytonamearray = new Array();
			var replytoemailarray = new Array();
			var dreplytoemailarray = new Array();
		
		
			emailstring = emailstring + 'start_email{';
			// add TO items
			$ES('input[name^=to]',emailitem).each(function(toitem){
				toarray[arrcount] = toitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'TO=[' + toarray.join(',') + ']||';
			// add Dynamic TO items
			$ES('input[name^=dto]',emailitem).each(function(dtoitem){
				dtoarray[arrcount] = dtoitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'DTO=[' + dtoarray.join(',') + ']||';
			// add Subject items
			$ES('input[name^=subject]',emailitem).each(function(subitem){
				subarray[arrcount] = subitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'SUBJECT=[' + subarray.join(',') + ']||';
			// add Dynamic Subject items
			$ES('input[name^=dsubject]',emailitem).each(function(dsubitem){
				dsubarray[arrcount] = dsubitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'DSUBJECT=[' + dsubarray.join(',') + ']||';
			// add CC items
			$ES('input[name^=cc]',emailitem).each(function(ccitem){
				ccarray[arrcount] = ccitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'CC=[' + ccarray.join(',') + ']||';
			// add Dynamic CC items
			$ES('input[name^=dcc]',emailitem).each(function(dccitem){
				dccarray[arrcount] = dccitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'DCC=[' + dccarray.join(',') + ']||';
			// add BCC items
			$ES('input[name^=bcc]',emailitem).each(function(bccitem){
				bccarray[arrcount] = bccitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'BCC=[' + bccarray.join(',') + ']||';
			// add Dynamic BCC items
			$ES('input[name^=dbcc]',emailitem).each(function(dbccitem){
				dbccarray[arrcount] = dbccitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'DBCC=[' + dbccarray.join(',') + ']||';
			// add FromName items
			$ES('input[name^=fromname]',emailitem).each(function(fromnameitem){
				fromnamearray[arrcount] = fromnameitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'FROMNAME=[' + fromnamearray.join(',') + ']||';
			// add Dynamic FromName items
			$ES('input[name^=dfromname]',emailitem).each(function(dfromnameitem){
				dfromnamearray[arrcount] = dfromnameitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'DFROMNAME=[' + dfromnamearray.join(',') + ']||';
			// add FromEmail items
			$ES('input[name^=fromemail]',emailitem).each(function(fromemailitem){
				fromemailarray[arrcount] = fromemailitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'FROMEMAIL=[' + fromemailarray.join(',') + ']||';
			// add Dynamic FromEmail items
			$ES('input[name^=dfromemail]',emailitem).each(function(dfromemailitem){
				dfromemailarray[arrcount] = dfromemailitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'DFROMEMAIL=[' + dfromemailarray.join(',') + ']||';
			//v3.1
			// add ReplyToName items
			$ES('input[name^=replytoname]',emailitem).each(function(replytonameitem){
				replytonamearray[arrcount] = replytonameitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'REPLYTONAME=[' + replytonamearray.join(',') + ']||';
			// add Dynamic ReplyToName items
			$ES('input[name^=dreplytoname]',emailitem).each(function(dreplytonameitem){
				dreplytonamearray[arrcount] = dreplytonameitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'DREPLYTONAME=[' + dreplytonamearray.join(',') + ']||';
			// add ReplyToEmail items
			$ES('input[name^=replytoemail]',emailitem).each(function(replytoemailitem){
				replytoemailarray[arrcount] = replytoemailitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'REPLYTOEMAIL=[' + replytoemailarray.join(',') + ']||';
			// add Dynamic ReplyToEmail items
			$ES('input[name^=dreplytoemail]',emailitem).each(function(dreplytoemailitem){
				dreplytoemailarray[arrcount] = dreplytoemailitem.value;
				arrcount = arrcount + 1;
			});
			arrcount = 0;
			emailstring = emailstring + 'DREPLYTOEMAIL=[' + dreplytoemailarray.join(',') + ']';
			
			
			emailstring = emailstring + '}end_email';
		});
		
		$('emails_temp').value = emailstring;
		document.adminForm.submit();
		return true;
	}
}

function insertfieldname(){
	//tinyMCE.activeEditor.execCommand('mceInsertContent', false, '8888');
}
var ieBookmark;
function getselect(){
if(window.ie)alert('yes this is IE');
ieBookmark = tinyMCE.activeEditor.selection.getBookmark();
}
function setselect(){
tinyMCE.get('editor_email_0').focus();
tinyMCE.get('editor_email_0').selection.moveToBookmark(ieBookmark);
}


function ShowAddField(){
	if(!$chk($E('div[class=cf_email]', $('left_column2')))){
		alert('Sorry, you have not created any emails in Step 2 to choose fields!');
	}else{
		ieBookmark = tinyMCE.activeEditor.selection.getBookmark();
		TB_show('Add Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=200&width=200&inlineId=temp_code2&homeId=left_column&sourceId=addfield_editor_temp', '');
	}
}
function ShowAddField2(){
	//if(!$chk($E('div[class=cf_email]', $('left_column2')))){
		//alert('Sorry, you have not created any emails in Step 2 to choose fields!');
	//}else{
		ieBookmark = tinyMCE.activeEditor.selection.getBookmark();
		TB_show('Add Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=200&width=200&inlineId=temp_code2&homeId=left_column&sourceId=onsubmitcode', '');
	//}
}



function ShowEmailProperties(){
	$('prop_cf_Email').setStyle('display','block');
	$$('div.cf_email').each(function(item){
		if(item.getProperty('id') == 'cf_email_active'){
			var params = $('params_'+item.getProperty('name')).value.split(',');
			$('prop_cf_Email_IP').value = params[0];
			$('prop_cf_Email_format').value = params[1];
			$('prop_cf_Email_enable').value = params[2];
			$('prop_cf_Email_editor').value = params[3];
			$('prop_cf_Email_enable_attachments').value = params[4];
			if(($chk($E('input[name^=to_]', item)) || $chk($E('input[name^=dto_]', item))) && ($chk($E('input[name^=subject_]', item)) || $chk($E('input[name^=dsubject_]', item))) && ($chk($E('input[name^=fromname_]', item)) || $chk($E('input[name^=dfromname_]', item))) && ($chk($E('input[name^=fromemail_]', item)) || $chk($E('input[name^=dfromemail_]', item))) ){
			//if($chk($E('input[name^=to_]', item))){
				$('prop_cf_Email_enable').disabled = false;
			}else{
				$('prop_cf_Email_enable').disabled = true;
			}
		}
	});
	$('prop_cf_Email_done').removeEvents();
	$('prop_cf_Email_done').addEvent('click', function() {
		$$('div.cf_email').each(function(item){
			if(item.getProperty('id') == 'cf_email_active'){
				$('params_'+item.getProperty('name')).value = '';
				$('params_'+item.getProperty('name')).value = $('prop_cf_Email_IP').value;
				$('params_'+item.getProperty('name')).value = $('params_'+item.getProperty('name')).value + ',' + $('prop_cf_Email_format').value;
				$('params_'+item.getProperty('name')).value = $('params_'+item.getProperty('name')).value + ',' + $('prop_cf_Email_enable').value;
				$('params_'+item.getProperty('name')).value = $('params_'+item.getProperty('name')).value + ',' + $('prop_cf_Email_editor').value;
				$('params_'+item.getProperty('name')).value = $('params_'+item.getProperty('name')).value + ',' + $('prop_cf_Email_enable_attachments').value;
			}
		});
	});
	$('emailbuilder').setStyle('height',  ($('left_column2').getCoordinates().height + $('top_column2').getCoordinates().height) + 140 );
}

function deletemail(){
	deleted = 0;
	$$('div.cf_email').each(function(item){
		if(item.getProperty('id') == 'cf_email_active'){
			item.remove();
			tinyMCE.execCommand('mceRemoveControl', false, 'editor_'+item.getProperty('name'));
			$E('textarea#editor_'+ item.getProperty('name')).remove();
			$('params_'+ item.getProperty('name')).remove();
			$E('div#'+'after_editor_'+ item.getProperty('name')).remove();
			$E('div#'+'before_editor_'+ item.getProperty('name')).remove();
			deleted = 1;
		}
	});
	if(!deleted)alert('Choose an email first to delete');
	if(deleted){
		$('emailslist').value = '';
		$ES('div[class=cf_email]', $('left_column2')).each(function(email){
			$('emailslist').value = $('emailslist').value + email.getProperty('name')+",";
		});	
	}
}
/*var emailcounter = 0;
var email_element_counter = 0; */
function addEmail(){
	newemail = new Element('div', {'class': 'cf_email', 'id': 'email_'+emailcounter, 'name': 'email_'+emailcounter});
	neweditor = new Element('textarea', {'class': 'mce_editable', 'id': 'editor_email_'+emailcounter, 'name': 'editor_email_'+emailcounter, 'rows':'20', 'cols':'75', 'styles': {'width':'100%', 'height':'350px' } });
	new Element('div', {'id':'before_'+ 'editor_email_'+emailcounter}).inject($('left_column3'));
	new Element('span', {'styles':{'font-weight':'bold', 'font-size':'12px'}}).setText('Email Template').inject($('before_'+ 'editor_email_'+emailcounter));
	neweditor.inject($('left_column3'));
	new Element('input', {'type':'hidden', 'id': 'params_email_'+emailcounter, 'value':'1,html,0,1,1', 'name': 'params_email_'+emailcounter}).inject($('left_column3'));
	new Element('div', {'id':'after_'+ 'editor_email_'+emailcounter}).inject($('left_column3'));
	new Element('br').inject($('after_'+ 'editor_email_'+emailcounter));
	new Element('br').inject($('after_'+ 'editor_email_'+emailcounter));
	
	tinyMCE.execCommand('mceAddControl', false, 'editor_email_'+emailcounter);
	if(window.ie6){
		newemail.setStyles({'width':'500px', 'border':'1px #111 solid', 'padding':'15px', 'background-color':'#FFAEA5', 'height':'auto', 'height':'75px', 'margin-top':'15px'});
	}else{
		newemail.setStyles({'width':'500px', 'border':'1px #111 solid', 'padding':'15px', 'background-color':'#FFAEA5', 'min-height':'75px', 'margin-top':'15px'});
	}
	newemail.addEvent('click', function() {
		$$('div.cf_email').each(function(item){
			item.setProperty('id','');
			item.setStyles({'border':'1px #111 solid'});
		});
		this.setProperty('id','cf_email_active');
		this.setStyles({'border':'3px #111 solid'});
		ShowEmailProperties();
	});	
	infodiv = new Element('div', {'class': 'infodiv'}).setText('Drag Email elements from the toolbox on the right side to build your email, the email box color will turn to green only when all the needed elements are existing!');
	infodiv.inject(newemail);	
	cleardiv = new Element('div', {'class': 'clear'});
	cleardiv.inject(newemail);
	newemail.inject($('left_column2'));
	if(emailcounter == 0)$('logdiv').setText('Drag and Drop Email elements to the new Email area');
	emailcounter = emailcounter + 1;
	//var dropFx = drop.effect('background-color', {wait: false}); // wait is needed so that to toggle the effect,	
	$$('.emailitem').each(function(item){
		item.removeEvents();
	});
	//var counter = 0; 
	$$('.emailitem').each(function(item){	 
		item.addEvent('mousedown', function(e) {
			e = new Event(e).stop();
	 		
			
			var clone = new Element('div', {'class':'emailitem'}).adopt( new Element('span', {'id':this.getFirst().getProperty('id')}).setText(this.getFirst().getText()) )//this.clone()
			//var clonetext = new Element('span', {'id':this.getFirst().getProperty('id')}).injectInside(clone);
				.setStyles(this.getCoordinates()) // this returns an object with left/top/bottom/right, so its perfect
				.setStyles({'opacity': 0.7, 'position': 'absolute'})
				.addEvent('emptydrop', function() {
					this.remove();
					$ES('div[class=cf_email]', $('left_column2')).each(function(droparea){
						droparea.removeEvents();
						droparea.addEvent('click', function() {
							$$('div.cf_email').each(function(item){
								item.setProperty('id','');
								item.setStyles({'border':'1px #111 solid'});
							});
							this.setProperty('id','cf_email_active');
							this.setStyles({'border':'3px #111 solid'});
							ShowEmailProperties();
						});	
					});
				}).inject(document.body);
				
				
			var thisitemtype = item.clone().getFirst().getProperty('id');
			var theitem = new Element('div').setProperty("class", 'form_element');
	 		$ES('div[class=cf_email]', $('left_column2')).each(function(droparea){
				droparea.addEvents({
					'drop': function() {
						$ES('div[class=cf_email]', $('left_column2')).each(function(dropareain){
							dropareain.removeEvents();
							dropareain.addEvent('click', function() {
								$$('div.cf_email').each(function(item){
									item.setProperty('id','');
									item.setStyles({'border':'1px #111 solid'});
								});
								this.setProperty('id','cf_email_active');
								this.setStyles({'border':'3px #111 solid'});
								ShowEmailProperties();
							});	
						});
						clone.remove();
						// add proper item
						if(thisitemtype == 'cf_to'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'to_'+email_element_counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'To', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dto'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dto_'+email_element_counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic To', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_subject'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'subject_'+email_element_counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Subject', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dsubject'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dsubject_'+email_element_counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic Subject', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_cc'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'cc_'+email_element_counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'CC', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dcc'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dcc_'+email_element_counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic CC', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_bcc'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'bcc_'+email_element_counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'BCC', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dbcc'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dbcc_'+email_element_counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic BCC', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_fromname'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'fromname_'+email_element_counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'From Name', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dfromname'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dfromname_'+email_element_counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic From Name', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_fromemail'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'fromemail_'+email_element_counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'From Email', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dfromemail'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dfromemail_'+email_element_counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic From Email', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						//v3.1
						}else if(thisitemtype == 'cf_replytoname'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'replytoname_'+email_element_counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'ReplyTo Name', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dreplytoname'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dreplytoname_'+email_element_counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic ReplyTo Name', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_replytoemail'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'replytoemail_'+email_element_counter);
							newTextbox.createElement().injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'ReplyTo Email', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else if(thisitemtype == 'cf_dreplytoemail'){
							theitem.empty();
							var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dreplytoemail_'+email_element_counter);
							newTextbox.createElement().addEvents({
								'click': function() {
									TB_show('Select Field', 'index.php?option=com_chronocontact&task=form_wizard#TB_inline&height=400&width=300&inlineId=temp_code2&homeId=left_column&sourceId='+newTextbox.createElement().getProperty('name'), '');
								}
							})
							.injectTop(theitem);
							theitem.addClass('cf_textbox');
							var newLabel = new CFLABEL('cf_label', 'Dynamic ReplyTo Email', 'input_'+email_element_counter);
							newLabel.createElement().injectTop(theitem);
						}else {}
						form_item = new Element('div').setProperty("class", 'form_item_email');
						theitem.injectInside(form_item);
						theitem = form_item;
						
						// add main attributes
						theitem.getLast().injectHTML('<div class="delete_icon_email"><img src="components/com_chronocontact/css/images/icon_delete.gif" alt="delete" width="15" height="15"  /></div>', 'after');
						theitem.getLast().setStyle('display', 'none');
						theitem.getLast().addEvent('click', function(e) {
							new Event(e).stop();
							this.getParent().remove();
							if(($chk($E('input[name^=to_]', droparea)) || $chk($E('input[name^=dto_]', droparea))) && ($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))) && ($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))) && ($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))) ){
								droparea.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
							}else{
								var email_params = $('params_'+droparea.getProperty('name')).value.split(',');
								$('params_'+droparea.getProperty('name')).value = email_params[0] + ',' + email_params[1] + ',' + '0,1,1';
								$('prop_cf_Email_enable').value = 0;
								$('prop_cf_Email_enable').disabled = true;
								droparea.effect('background-color', {wait: false, duration: 100}).start('FFAEA5','FFAEA5');
							}
						})
						theitem.getLast().injectHTML('<div class="clear">&nbsp;</div>', 'after');
						theitem.addEvents({
							'mouseover': function(e) {
								//new Event(e).stop();
								theitem.effect('background-color', {wait: false, duration: 100}).start('E7DFE7','E7DFE7');							
							},
							'mouseout': function(e) {
								//new Event(e).stop();
								theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
							},
							'click': function(e) {
								//new Event(e).stop();
								$ES('.form_item_email',droparea).each(function(item2){
									item2.setStyle('border', '0px solid #000');
									$E('.delete_icon_email', item2).setStyle('display', 'none');
								});
								theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
								theitem.setStyle('border', '1px solid #000');		
								$E('.delete_icon_email', theitem).setStyle('display', 'inline');
							}			
						});
						theitem.effect('background-color', {wait: false, duration: 100}).start('E7DFE7','E7DFE7');
						
						var dropthis = 1;
						if((thisitemtype == 'cf_fromemail')||(thisitemtype == 'cf_dfromemail')){
							if($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))){
								$('logdiv').setText('Only one From Email or Dynamic From Email is accepted per Email');
								dropthis = 0;
							}
						}
						if((thisitemtype == 'cf_fromname')||(thisitemtype == 'cf_dfromname')){
							if($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))){
								$('logdiv').setText('Only one From Name or Dynamic From Name is accepted per Email');
								dropthis = 0;
							}
						}
						if((thisitemtype == 'cf_replytoemail')||(thisitemtype == 'cf_dreplytoemail')){
							if($chk($E('input[name^=replytoemail_]', droparea)) || $chk($E('input[name^=dreplytoemail_]', droparea))){
								$('logdiv').setText('Only one ReplyTo Email or Dynamic ReplyTo Email is accepted per Email');
								dropthis = 0;
							}
						}
						if((thisitemtype == 'cf_replytoname')||(thisitemtype == 'cf_dreplytoname')){
							if($chk($E('input[name^=replytoname_]', droparea)) || $chk($E('input[name^=dreplytoname_]', droparea))){
								$('logdiv').setText('Only one ReplyTo Name or Dynamic ReplyTo Name is accepted per Email');
								dropthis = 0;
							}
						}
						if((thisitemtype == 'cf_subject')||(thisitemtype == 'cf_dsubject')){
							if($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))){
								$('logdiv').setText('Only one Subject or Dynamic Subject is accepted per Email');
								dropthis = 0;
							}
						}
						if(dropthis == 1)
						theitem.injectBefore(droparea.getLast());
						email_element_counter = email_element_counter + 1;
						if($chk($E('div[class=infodiv]', droparea)))$E('div[class=infodiv]', droparea).remove();
						if(($chk($E('input[name^=to_]', droparea)) || $chk($E('input[name^=dto_]', droparea))) && ($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))) && ($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))) && ($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))) ){
							droparea.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
							if(droparea.getProperty('id') == 'cf_email_active'){
								$('prop_cf_Email_enable').disabled = false;
							}
						}
						$('emailbuilder').setStyle('height',  ($('left_column2').getCoordinates().height + $('top_column2').getCoordinates().height) );
						
					},
					'over': function() {
						//dropFx.start('98B5C1');
					},
					'leave': function() {
						//dropFx.start('ffffff');
					}
				});
				
	 		});
			
			//email_element_counter = email_element_counter + 1;
			var drag2 = clone.makeDraggable({
				droppables: $ES('div[class=cf_email]', $('left_column2'))
			}); // this returns the dragged element
	 
			drag2.start(e); // start the event manual
		});
	 
	});
	//drop2.inject($('left_column2'));
	$('emailbuilder').setStyle('height',  ($('left_column2').getCoordinates().height + $('top_column2').getCoordinates().height) );
	//write new emails list
	$('emailslist').value = '';
	$ES('div[class=cf_email]', $('left_column2')).each(function(email){
		$('emailslist').value = $('emailslist').value + email.getProperty('name')+",";
	});
	
}


