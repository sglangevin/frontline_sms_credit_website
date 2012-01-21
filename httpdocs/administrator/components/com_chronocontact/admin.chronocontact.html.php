<?php
/*
/**
* CHRONOFORMS version 3.0 
* Copyright (c) 2008 Chrono_Man, ChronoEngine.com. All rights reserved.
* Author: Chrono_Man (ChronoEngine.com)
You are not allowed to copy or use or rebrand or sell any code at this page under your own name or any other identity!
* See readme.html.
* Visit http://www.ChronoEngine.com for regular update and information.
**/

/* ensure that this file is called from another file */
defined('_JEXEC') or die('Restricted access'); 
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_chronocontact/css/cc.css');
if ( !function_exists( 'property_exists' ) ) {
    function property_exists( $class, $property ) {
        if ( is_object( $class ) ) {
            $vars = get_object_vars( $class );
        } else {
            $vars = get_class_vars( $class );
        }
        return array_key_exists( $property, $vars );
    }
} 
class HTML_ChronoContact {
  function showChronoContact( $rows, $pageNav, $option ) {
    global $mainframe;
	$configs = JComponentHelper::getParams('com_chronocontact');
	$showtipday = $configs->get('showtipoftheday', 1);
	if($showtipday){
		HTML_ChronoContact::showTipOfDay();
	}
    ?>
	<?php echo JHTML::_('behavior.tooltip'); ?>
	<script type="text/javascript">
	function changetable(name){
		document.getElementById('table').value = name;
	}
	</script>
    <form action="index2.php?option=com_chronocontact" method="post" name="adminForm">
	<table class="adminlist"><tr><td width="130px" valign="top">
	<table cellpadding="0" cellspacing="0" border="0" width="130px">
		<tr>
			<td width="130px" valign="top">
				<strong>Plugins</strong>
			</td>
		</tr>
		<tr>
			<td width="130px" valign="top">
				<?php
				$tooltips = "window.addEvent('domready', function() {";
				$document =& JFactory::getDocument();
				
				$directory = JPATH_SITE.'/components/com_chronocontact/plugins/';
				$results = array();
				$handler = opendir($directory);
				while ($file = readdir($handler)) {
					if ( $file != '.' && $file != '..' && substr($file, -4) == '.php' && substr($file, 0, 3) == 'cf_')
						$results[] = str_replace(".php","", $file);
				}
				closedir($handler);
				foreach($results as $result){
					require_once(JPATH_SITE."/components/com_chronocontact/plugins/".$result.".php");
					${$result} = new $result();
					?>
					<a title="<?php echo ${$result}->result_TITLE; ?> :: <?php echo ${$result}->result_TOOLTIP; ?>" id="<?php echo ${$result}->plugin_name; ?>" style="display:block; " href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Please make a selection from the list to <?php echo ${$result}->result_TITLE; ?>');}else{submitbutton('<?php echo 'plugin_'.$result; ?>')}">
					<?php echo ${$result}->result_TITLE; ?></a><br>
					<?php
					$tooltips .= "var Tip".${$result}->plugin_name." = new Tips($('".${$result}->plugin_name."'));";
				}
				$tooltips .= "});";
				$document->addScriptDeclaration($tooltips);
				?>			
			</td>
			
		</tr>
	</table>
	</td><td valign="top">
    <table class="adminheading">
    <tr>
	  <th>Chrono Forms - Forms Manager</th>
    </tr>
	</table>
    <table class="adminlist">
	<tr>
	  <th width="20" class='title'>#</th>
	  <th width="5%" class='title'>Form ID</th>
	  <th width="20" class='title'><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>

	  <th width="20%" align="left" class='title'>Name</th>
	  <th width="60%" align="left" class='title'>Link</th>
	  <th width="20%" align="center" class='title'>
	  <?php echo JHTML::_('tooltip', "To Enable Emails you need to :<br>1# Set Email Results to Yes in the General Tab<br>2# Set Enabled to Yes at every email area from the Email properties" ); ?>
	  Emails</th>
	  <th width="20%" align="center" class='title'>Tables Connected</th>
	  <th width="5%" align="right" class='title'>Publish</th>
	</tr>
    <?php
	$k = 0;
    for ($i=0, $n=count($rows); $i < $n; $i++) {
	  $row = $rows[$i];
		$link	= 'index2.php?option=com_chronocontact&task=editA&hidemainmenu=1&id='. $row->id;
	  ?>
	  
	  <tr class="<?php echo "row$k"; ?>">
		<td width="20" align="center"><?php echo $i+$pageNav->limitstart+1;?></td>
		<td width="20" align="center"><?php echo $row->id; ?></td>
		<td width="20"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
		
		<td width="20%" align="left" ><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')"><?php echo $row->name; ?></a></td>
		<td width="60%" align="left" ><a target="_blank" href="<?php echo $mainframe->getSiteURL(); ?>index.php?option=com_chronocontact&amp;chronoformname=<?php echo $row->name; ?>">index.php?option=com_chronocontact&amp;chronoformname=<?php echo $row->name; ?></a></td>
		<?php
			$database =& JFactory::getDBO();
			$query = "SELECT * FROM #__chrono_contact_emails WHERE formid = '".$row->id."' ORDER BY emailid";
			$database->setQuery( $query );
			$emails = $database->loadObjectList();
			$emails_enabled = 0;
			$emails_disabled = 0;
			if(!$row->emailresults){
				$emails_enabled = '0';
				$emails_disabled = count($emails);
			}else{
				foreach($emails as $email){
					$registry = new JRegistry();
					$registry->loadINI( $email->params );
					$emailparams = $registry->toObject( );
					if(trim($emailparams->enabled == '1')){
						$emails_enabled++;
					}else{
						$emails_disabled++;
					}
				}
			}
		?>
		<td width="20%" align="center" ><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')">Enabled:<?php echo $emails_enabled; ?><br>Disabled:<?php echo $emails_disabled; ?></a>
		</td>
		<?php
		$paramsvalues = new JParameter($row->paramsall);
		if($paramsvalues->get('tablenames')){
			$tables = explode(",", $paramsvalues->get('tablenames'));
		}else{
			$tables = array();
		}
		?>
		<td width="20%" align="center" >
		<?php
		foreach($tables as $table){
		?>
			<a href="index.php?option=com_chronocontact&table=<?php echo $table; ?>#show" onclick="changetable('<?php echo $table; ?>'); return listItemTask('cb<?php echo $i;?>','show')"><?php echo $table; ?></a><br>
		<?php
		}
		?>
		</td>
		<?php if($row->published){ ?>
		<td width="5%" align="center" ><a href="#unpublish" onclick="return listItemTask('cb<?php echo $i;?>','unpublish')"><img border="0" alt="Published" src="images/tick.png"/></a></td>
		<?php }else{ ?>
		<td width="5%" align="center" ><a href="#publish" onclick="return listItemTask('cb<?php echo $i;?>','publish')"><img border="0" alt="Unpublished" src="images/publish_x.png"/></a></td>
		<?php } ?>
	  </tr>
      <?php
			$k = 1 - $k;
		}
    ?>
		<tr><td colspan="8" style="white-space:nowrap; " height="20px"><?php echo $pageNav->getListFooter(); ?></td></tr>
	  </table>
	  </td></tr></table>
	  <input type="hidden" name="option" value="<?php echo $option; ?>" />
	  <input type="hidden" name="table" id="table" value="" />
	  <input type="hidden" name="task" value="" />
	  <input type="hidden" name="boxchecked" value="0" />
	  <input type="hidden" name="hidemainmenu" value="0">
	  </form>
    <?php
	}

  // this method represents the edit mask
  function editChronoContact( $row, $option ) {
		global $mainframe;
		$paramsvalues = new JParameter($row->paramsall);
		if ( is_array($paramsvalues->get('uploadfields')) ) {
		  $paramsvalues->set('uploadfields', implode('|', $paramsvalues->get('uploadfields')));
		}
		
		
		/*JHTML::_('behavior.switcher');
		$contents = '';
		ob_start();
		require_once(JPATH_COMPONENT.DS.'tmpl'.DS.'navigation.php');
		$contents = ob_get_contents();
		ob_clean();*/

		//$document =& JFactory::getDocument();
		//$document->setBuffer($contents, 'module', 'submenu');
    ?>
	
		<!--[if gte IE 6]><link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>style1-ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
		<!--[if gte IE 7]><link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>style1-ie7.css" rel="stylesheet" type="text/css" /><![endif]-->
		<!--[if !IE]> <--><link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>style1.css" rel="stylesheet" type="text/css" /><!--> <![endif]-->
		<link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>calendar.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>tooltip.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>accordion.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>smoothbox/smoothbox.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo JURI::Base().'components/com_chronocontact/js/'; ?>CFElements.js"></script>
	  <script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == "cancel") {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if ((form.name.value == '')||(form.name.value.search(/ /) > -1)) {
				alert( "Please enter the form name without any spaces" );
			} else {
				Checkform();
				submitform( pressbutton );
			}
		}
		function addmenuitem(){
			var form = document.adminForm;
			if (form.menutext.value == '') {
				alert( "Please enter a text for the menu link" );
			} else {
				submitform( 'addmenuitem' );
			}
		}
		function toggleList(e){
		element = document.getElementById(e).style;
		element.display == 'none' ? element.display = 'block' :
		element.display='none';
		}
		function change_order1_plus(e){
			element = document.getElementById(e);
			if(trim(element.value) == "" ) element.value = "0";
			element.value = parseInt(element.value) + 1;
		}
		function change_order1_minus(e){
			element = document.getElementById(e);
			if(trim(element.value) == "" ) element.value = "0";
			parseInt(element.value) == 0 ? element.value = 0 :			
			element.value = parseInt(element.value) - 1;
		}
		function enable_order(e1, e2){
			element1 = document.getElementById(e1);
			element2 = document.getElementById(e2);
			if(element2.checked == true)element1.disabled = false;
			if(element2.checked == false)element1.disabled = true;
		}
		function change_order2_plus(e){
			element = document.getElementById(e);
			if(trim(element.value) == "" ) element.value = "0";
			element.value = parseInt(element.value) + 1;
		}
		function change_order2_minus(e){
			element = document.getElementById(e);
			if(trim(element.value) == "" ) element.value = "0";
			parseInt(element.value) == 0 ? element.value = 0 :			
			element.value = parseInt(element.value) - 1;
		}
		
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
		
		
		
		function Checkform(){
				// Prepare form code				
				Template = new Element('div', {'id':'form_html_template', 'styles':{'display':'none'}});
				Template.innerHTML = $('html').value;
				//Template.inject($('left_column3'));
				var fieldsnames= '';
				var fieldstypes= '';
				var fieldsnames_array = new Array();
				var fieldstypes_array = new Array();
				//alert($('html').value);
				$ES('input[type=submit]',Template).each(function(element){
					element.remove();
				});
				$ES('input[type=reset]',Template).each(function(element){
					element.remove();
				});
				$ES('div.cf_captcha',Template).each(function(element){
					element.remove();
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
				$('fieldsnames').value = fieldsnames_array.join(',').replace(/\[\]/g,"");
				$('fieldstypes').value = fieldstypes_array.join(',').replace(/\[\]/g,"");
				Template.inject($('left_column33'));
				//$('form_code_temp').setText(Output.innerHTML.replace(/\$included="null"/g,'').replace(/\$events="null"/g,'').replace(/style=".*?"/g,''));
				//Add templates for empty ones
				$ES('textarea[name^=editor_email_]', $('left_column33')).each(function(editor){
					var editor_data = '';
					if(editor.hasClass('2mce_editable')){
						editor_data = tinyMCE.get(editor.getProperty('id')).getContent();
					}else{
						editor_data = editor.value;
					}
					if(!editor_data){
						/*$ES('input[type=submit]',Template).each(function(element){
							element.getParent().getParent().remove();
						});
						$ES('input[type=reset]',Template).each(function(element){
							element.getParent().getParent().remove();
						});
						$ES('div.cf_captcha',Template).each(function(element){
							element.getParent().remove();
						});*/
						Template = $('form_html_template');
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
						extratemplate.setText(Template.innerHTML.replace(/\$included="null"/g,'').replace(/\$events="null"/g,''));
						extratemplate.inject($('left_column33'));
						//tinyMCE.get(editor.getProperty('id')).execCommand('mceInsertContent',false, Template.innerHTML.replace(/\$included="null"/g,'').replace(/\$events="null"/g,'').replace(/style=".*?"/g,''));
					}
				});
				// Prepare Emails
				Output2 = $('left_column2').clone();
				var emailstring = '';
				var arrcount = 0;
				var emails_temp_ids = '';
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
					emails_temp_ids = emails_temp_ids + ',' + emailitem.getProperty('name');
				
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
					/// new at V3.1
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
				$('emails_temp_ids').value = emails_temp_ids;
				$('form_html_template').empty();
				//document.adminForm.submit();
			
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
			//$('emailbuilder').setStyle('height',  ($('left_column2').getCoordinates().height + $('top_column2').getCoordinates().height) + 140 );
		}
		
		function deletemail(){
			deleted = 0;
			$$('div.cf_email').each(function(item){
				if(item.getProperty('id') == 'cf_email_active'){
					item.remove();
					if($('editor_'+item.getProperty('name')).hasClass('2mce_editable')){
						tinyMCE.execCommand('mceRemoveControl', false, 'editor_'+item.getProperty('name'));
					}					
					$E('textarea#editor_'+ item.getProperty('name')).remove();
					$('params_'+ item.getProperty('name')).remove();
					$E('div#'+'after_editor_'+ item.getProperty('name')).remove();
					$E('div#'+'before_editor_'+ item.getProperty('name')).remove();
					deleted = 1;
				}
			});
			if(!deleted)alert('Choose an email first to delete');
		}
		<?php
			$database =& JFactory::getDBO();
			$query = "SELECT * FROM #__chrono_contact_emails WHERE formid = '".$row->id."' ORDER BY emailid";
			$database->setQuery( $query );
			$emails = $database->loadObjectList();
		?>
		
		var emailcounter = <?php echo count($emails); ?>;
		var counter = 0;
		function addEmail(){
			newemail = new Element('div', {'class': 'cf_email', 'id': 'email_'+emailcounter, 'name': 'email_'+emailcounter});
			neweditor = new Element('textarea', {'class': 'mce_editable', 'id': 'editor_email_'+emailcounter, 'name': 'editor_email_'+emailcounter, 'rows':'20', 'cols':'75', 'styles': {'width':'90%', 'height':'350px' } });
			new Element('div', {'id':'before_'+ 'editor_email_'+emailcounter}).inject($('left_column33'));
			new Element('span', {'styles':{'font-weight':'bold', 'font-size':'12px'}}).setText('Email Template').inject($('before_'+ 'editor_email_'+emailcounter));
			neweditor.inject($('left_column33'));
			new Element('input', {'type':'hidden', 'id': 'params_email_'+emailcounter, 'value':'1,html,0,1,1', 'name': 'params_email_'+emailcounter}).inject($('left_column33'));
			new Element('div', {'id':'after_'+ 'editor_email_'+emailcounter}).inject($('left_column33'));
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
			//if(emailcounter == 0)$('logdiv').setText('Drag and Drop Email elements to the new Email area');
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
									var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'to_'+counter);
									newTextbox.createElement().injectTop(theitem);
									theitem.addClass('cf_textbox');
									var newLabel = new CFLABEL('cf_label', 'To', 'input_'+counter);
									newLabel.createElement().injectTop(theitem);
								}else if(thisitemtype == 'cf_dto'){
									theitem.empty();
									var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dto_'+counter);
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
									theitem.addClass('cf_textbox');
									var newLabel = new CFLABEL('cf_label', 'Dynamic From Email', 'input_'+counter);
									newLabel.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
									theitem.addClass('cf_textbox');
									var newLabel = new CFLABEL('cf_label', 'Dynamic ReplyTo Email', 'input_'+counter);
									newLabel.createElement().injectTop(theitem);
								}else {}
								form_item = new Element('div').setProperty("class", 'form_item_email');
								theitem.injectInside(form_item);
								theitem = form_item;
								
								// add main attributes
								theitem.getLast().injectHTML('<div class="delete_icon"><img src="<?php echo JURI::Base()."components/com_chronocontact/css/"; ?>images/icon_delete.gif" alt="delete" width="15" height="15"  /></div>', 'after');
								theitem.getLast().setStyle('display', 'none');
								theitem.getLast().addEvent('click', function(e) {
									new Event(e).stop();
									this.getParent().remove();
									if(($chk($E('input[name^=to_]', droparea)) || $chk($E('input[name^=dto_]', droparea))) && ($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))) && ($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))) && ($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))) ){
										droparea.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
									}else{
										var email_params = $('params_'+droparea.getProperty('name')).value.split(',');
										$('params_'+droparea.getProperty('name')).value = email_params[0] + ',' + email_params[1] + ',' + '0';
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
											$E('.delete_icon', item2).setStyle('display', 'none');
										});
										theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
										theitem.setStyle('border', '1px solid #000');		
										$E('.delete_icon', theitem).setStyle('display', 'inline');
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
								//$('emailbuilder').setStyle('height',  ($('left_column2').getCoordinates().height + $('top_column2').getCoordinates().height) );
								
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
			//drop2.inject($('left_column2'));
			//$('emailbuilder').setStyle('height',  ($('left_column2').getCoordinates().height + $('top_column2').getCoordinates().height) );
			
		}
		
	  </script>
	<?php global $mainframe; ?>	
	<script type="text/javascript" src="<?php echo JURI::Base().'components/com_chronocontact/js/'; ?>tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
			tinyMCE.init({
			theme : "advanced",
			language : "en",
			mode : "textareas",
			gecko_spellcheck : "true",
			editor_selector : "mce_editable",
			document_base_url : "<?php echo $mainframe->getSiteURL(); ?>",
			entities : "60,lt,62,gt",
			relative_urls : 1,
			remove_script_host : false,
			save_callback : "TinyMCE_Save",
			invalid_elements : "applet",
			extended_valid_elements : "a[class|name|href|target|title|onclick|rel],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],,hr[id|title|alt|class|width|size|noshade]",
			theme_advanced_toolbar_location : "top",
			theme_advanced_source_editor_height : "550",
			theme_advanced_source_editor_width : "450",
			directionality: "ltr",
			force_br_newlines : "false",
			force_p_newlines : "true",
			content_css : "<?php echo $mainframe->getSiteURL(); ?>templates/system/css/editor.css",
			debug : false,
			cleanup : true,
			cleanup_on_startup : false,
			safari_warning : false,
			plugins : "advlink, advimage, searchreplace,insertdatetime,emotions,media,advhr,table,fullscreen,directionality,layer,style",
			theme_advanced_resizing : true,
			//theme_advanced_buttons1_add : "fontselect",
			theme_advanced_buttons2_add : "media,ltr,rtl,insertlayer,forecolor",
			theme_advanced_buttons3_add : "advhr,fullscreen,styleprops,fontselect",
			theme_advanced_buttons4 : "tablecontrols",
			//theme_advanced_buttons5 : "fontselect",
			theme_advanced_disable : "help",
			plugin_insertdate_dateFormat : "%Y-%m-%d",
			plugin_insertdate_timeFormat : "%H:%M:%S",
			
			fullscreen_settings : {
				theme_advanced_path_location : "top"
			}
			
		});
		function TinyMCE_Save(editor_id, content, node)
		{
			base_url = tinyMCE.settings['document_base_url'];
			var vHTML = content;
			if (true == true){
				//vHTML = tinyMCE.regexpReplace(vHTML, 'href\s*=\s*"?'+base_url+'', 'href="', 'gi');
				//vHTML = tinyMCE.regexpReplace(vHTML, 'src\s*=\s*"?'+base_url+'', 'src="', 'gi');
				//vHTML = tinyMCE.regexpReplace(vHTML, 'mce_real_src\s*=\s*"?', '', 'gi');
				//vHTML = tinyMCE.regexpReplace(vHTML, 'mce_real_href\s*=\s*"?', '', 'gi');
			}
			return vHTML;
		}
	</script>
	<script type="text/javascript">
		window.addEvent('domready', function() {
		<?php for($iemail = 0; $iemail < count($emails); $iemail++){ ?>
		<?php
			$registry = new JRegistry();
			$registry->loadINI( $emails[$iemail]->params );
			$emailparams = $registry->toObject( );
			if($emailparams->editor == '1'){
		?>
		tinyMCE.execCommand('mceAddControl', false, 'editor_email_'+<?php echo $iemail; ?>);
		<?php } ?>
		<?php } ?>
			$$('.cf_email').each(function(emailitem){
				if(($chk($E('input[name^=to_]', emailitem)) || $chk($E('input[name^=dto_]', emailitem))) && ($chk($E('input[name^=subject_]', emailitem)) || $chk($E('input[name^=dsubject_]', emailitem))) && ($chk($E('input[name^=fromname_]', emailitem)) || $chk($E('input[name^=dfromname_]', emailitem))) && ($chk($E('input[name^=fromemail_]', emailitem)) || $chk($E('input[name^=dfromemail_]', emailitem))) ){
					emailitem.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
				}
				emailitem.addEvent('click', function() {
					$$('div.cf_email').each(function(item){
						item.setProperty('id','');
						item.setStyles({'border':'1px #111 solid'});
					});
					this.setProperty('id','cf_email_active');
					this.setStyles({'border':'3px #111 solid'});
					ShowEmailProperties();
				});
			});
			$$('.form_item_email').each(function(formitem){
				formitem.addEvent('click', function() {
					$$('.form_item_email').each(function(item2){
						item2.setStyle('border', '0px solid #000');
						$E('.delete_icon', item2).setStyle('display', 'none');
					});
					this.setStyle('border', '0px solid #000');
					$E('.delete_icon', this).setStyle('display', 'none');
					this.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
					this.setStyle('border', '1px solid #000');		
					$E('.delete_icon', this).setStyle('display', 'inline');
				});
			});
			$$('.delete_icon').each(function(deleteicon){
				deleteicon.addEvent('click', function(e) {
					//new Event(e).stop();
					droparea = this.getParent().getParent();
					this.getParent().remove();
					if(($chk($E('input[name^=to_]', droparea)) || $chk($E('input[name^=dto_]', droparea))) && ($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))) && ($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))) && ($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))) ){
						droparea.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
					}else{
						var email_params = $('params_'+droparea.getProperty('name')).value.split(',');
						$('params_'+droparea.getProperty('name')).value = email_params[0] + ',' + email_params[1] + ',' + '0';
						$('prop_cf_Email_enable').value = 0;
						$('prop_cf_Email_enable').disabled = true;
						droparea.effect('background-color', {wait: false, duration: 100}).start('FFAEA5','FFAEA5');
					}
				});
			});
			
			
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
									var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'to_'+counter);
									newTextbox.createElement().injectTop(theitem);
									theitem.addClass('cf_textbox');
									var newLabel = new CFLABEL('cf_label', 'To', 'input_'+counter);
									newLabel.createElement().injectTop(theitem);
								}else if(thisitemtype == 'cf_dto'){
									theitem.empty();
									var newTextbox = new CFTEXTBOX('cf_inputbox', '30', 'dto_'+counter);
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
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
									newTextbox.createElement().injectTop(theitem);
									theitem.addClass('cf_textbox');
									var newLabel = new CFLABEL('cf_label', 'Dynamic ReplyTo Email', 'input_'+counter);
									newLabel.createElement().injectTop(theitem);
								}else {}
								form_item = new Element('div').setProperty("class", 'form_item_email');
								theitem.injectInside(form_item);
								theitem = form_item;
								
								// add main attributes
								theitem.getLast().injectHTML('<div class="delete_icon"><img src="<?php echo JURI::Base()."components/com_chronocontact/css/"; ?>images/icon_delete.gif" alt="delete" width="15" height="15"  /></div>', 'after');
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
											$E('.delete_icon', item2).setStyle('display', 'none');
										});
										theitem.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
										theitem.setStyle('border', '1px solid #000');		
										$E('.delete_icon', theitem).setStyle('display', 'inline');
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
								//$('emailbuilder').setStyle('height',  ($('left_column2').getCoordinates().height + $('top_column2').getCoordinates().height) );
								
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
			
			var Tipsnew = new ChronoTips($('cf_newemail'));
			var Tipsdel = new ChronoTips($('cf_delemail'));
			
		});
		window.addEvent('domready', function() {
			var top ;//= $('right_column').getPosition().y - 2;
			var marginChange = new Fx.Style('right_column', 'margin-top', {wait:false, duration:500, transition:Fx.Transitions.Elastic.easeOut});		
			window.addEvent('scroll', function() {
				if(!top)top = $('right_column').getPosition().y;
				marginChange.start(Math.max(0, window.getScrollTop() - top));
			});
		});
	</script>



	  <?php echo JHTML::_('behavior.tooltip'); ?>
	<center><strong style="font-size:16px; "><?php echo $row->name; ?></strong></center><?php echo JHTML::_('tooltip', "This is a tooltip with some usefull info about the field" ); ?> ToolTip
	  <form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
	  <div class="col width-120">
	  <?php
	  		jimport('joomla.html.pane');
		  	$pane   =& JPane::getInstance('tabs');
			echo $pane->startPane("content-pane2");
			echo $pane->startPanel( 'General', "general" );
	  ?>
	  <!--<div id="config-document">-->
	  <div id="page-general">
	<table border="0" cellpadding="3" cellspacing="0">
  <tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "This is the Form name, It must be Unique." ); ?></td>
		<td><strong>Form Name:</strong> <br><strong style="color:#FF0000 ">must be unique between forms</strong></td>
		<td></td>
		<td><input type="text" class="inputbox" size="50" maxlength="100" name="name" value="<?php echo $row->name; ?>" /></td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "This is a global Emailing switch for the form, even if emails are setup to email and this is No then the form will email nothing!" ); ?></td>
		<td><strong>Email the results ?</strong> </td>
		<td></td>
		<td><select name="emailresults" id="emailresults" >
          <option value="0"<?php if($row->emailresults == 0){echo 'selected';}; ?>>No</option>
		  <option value="2"<?php if($row->emailresults == 2){echo 'selected';}; ?>>Yes</option>
        </select></td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Put here any code you want to use inside the form tag, like a validation javascript function to be executed when the form is submitted, code example : onsubmit=return validateForm()" ); ?></td>
		<td><strong>Form tag attachment:</strong><br><strong style="color:#FF0000 ">something like onSubmit()</strong> </td>
		<td></td>
		<td><input type="text" class="inputbox" size="100" name="attformtag" value="<?php echo htmlspecialchars($row->attformtag); ?>" /></td>
	</tr>
    <input type="hidden" name="theme" value="<?php echo $row->theme; ?>" />
	<tr>
		<td><?php echo JHTML::_('tooltip', "Form method" ); ?></td>
		<td><strong>Form method:</strong> </td>
		<td></td>
		<td>
		<select name="params[formmethod]" id="params[formmethod]">
		<option<?php if($paramsvalues->get('formmethod') == 'post'){ echo ' selected';} ?> value="post">Post</option>
		<option<?php if($paramsvalues->get('formmethod') == 'get'){ echo ' selected';} ?> value="get">Get</option>
		</select>
		</td>
	</tr>
	
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Limit how soon the same user can resubmit the form, we check here using user session, so if he got a new session then this will not limit it, this is usefull incase you want to prevent resubmitting the form in case of page refresh!" ); ?></td>
		<td><strong>Submissions limit (in seconds):</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[submissions_limit]" id="params[submissions_limit]" class="inputbox" size="50" maxlength="100" value="<?php echo $paramsvalues->get('submissions_limit'); ?>">
		</td>
	</tr>
    
    <tr style="background-color:#fff ">
		<td><?php echo JHTML::_('tooltip', "set the format to the date field in any datetimepicker element used in the form" ); ?></td>
		<td><strong>Date Format:</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[datefieldformat]" id="params[datefieldformat]" class="inputbox" size="50" maxlength="100" value="<?php echo $paramsvalues->get('datefieldformat'); ?>">
		</td>
	</tr>
	
	<tr>
		<td><?php echo JHTML::_('tooltip', "Load Chronoforms CSS/JS files? Necessary for forms created with the wizard" ); ?></td>
		<td><strong>Load Chronoforms CSS/JS Files?</strong> </td>
		<td></td>
		<td>
		<select name="params[LoadFiles]" id="params[LoadFiles]">
			<option<?php if($paramsvalues->get('LoadFiles') == 'No'){ echo ' selected';} ?> value="No">No</option>
			<option<?php if($paramsvalues->get('LoadFiles') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
		</select>
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "if debug is ON then ChronoForms will show diagnostic output" ); ?></td>
		<td><strong>Debug:</strong> </td>
		<td></td>
		<td>
			<select name="params[debug]" id="params[debug]">
				<option<?php if($paramsvalues->get('debug') == '0'){ echo ' selected';} ?> value="0">OFF</option>
				<option<?php if($paramsvalues->get('debug') == '1'){ echo ' selected';} ?> value="1">ON</option>
			</select>
		</td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "The most used is ENGINE (v4+) however you can consider changing this to TYPE of you get a mysql error when you try to create a table" ); ?></td>
		<td><strong>MYSQL Statement ? ENGINE or TYPE</strong> </td>
		<td></td>
		<td>
			<select name="params[mysql_type]" id="params[mysql_type]">
				<option<?php if($paramsvalues->get('mysql_type') == '1'){ echo ' selected';} ?> value="1">ENGINE</option>
				<option<?php if($paramsvalues->get('mysql_type') == '2'){ echo ' selected';} ?> value="2">TYPE</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Enable mambots to be applied to this form contents?" ); ?></td>
		<td><strong>Enable mambots?</strong> </td>
		<td></td>
		<td>
		<select name="params[enmambots]" id="params[enmambots]">
			<option<?php if($paramsvalues->get('enmambots') == 'No'){ echo ' selected';} ?> value="No">No</option>
			<option<?php if($paramsvalues->get('enmambots') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
		</select>
		</td>
	</tr>
	</table>
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Setup Emails", 'semails' );
			
			$database =& JFactory::getDBO();
			$query = "SELECT * FROM #__chrono_contact_emails WHERE formid = '".$row->id."' ORDER BY emailid";
			$database->setQuery( $query );
			$emails = $database->loadObjectList();
			$emailscounter = 0;
	?>
	<div id="page-semails">
		<table border="0" cellpadding="0" cellspacing="0" width="810px">
  <tr>
  <td valign="top">		
				<div class="float_left width1" >
					<div id="top_column2">				
					<a href="#" onClick="addEmail();return false;"><img id="cf_newemail" title="New Email :: Click to insert a new Email container" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/get_msgs_f2.png" width="32" height="32"></a>
					<a href="#" onClick="deletemail();return false;"><img id="cf_delemail" title="Delete Email :: Choose an email from below then click to delete it" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/trash.png" width="32" height="32"></a>
					</div>
					<div id="left_column2"><div id="logdiv" style="color:#FF0000; text-align:center ">Click Add Email to add new Email</div>
					<?php foreach($emails as $email){ ?>
						<div class="cf_email" id="" name="email_<?php echo $emailscounter; ?>" style="border: 1px solid rgb(17, 17, 17); padding: 15px; width: 500px; background-color: rgb(255, 174, 165); min-height: 75px; margin-top: 15px;">
							<?php if($email->to){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">To</label>
									<input type="text" name="to_<?php echo $emailscounter; ?>" id="to_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->to; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dto){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic To</label>
									<input type="text" name="dto_<?php echo $emailscounter; ?>" id="dto_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dto; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->subject){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Subject</label>
									<input type="text" name="subject_<?php echo $emailscounter; ?>" id="subject_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->subject; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dsubject){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic Subject</label>
									<input type="text" name="dsubject_<?php echo $emailscounter; ?>" id="dsubject_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dsubject; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->cc){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">CC</label>
									<input type="text" name="cc_<?php echo $emailscounter; ?>" id="cc_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->cc; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dcc){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic CC</label>
									<input type="text" name="dcc_<?php echo $emailscounter; ?>" id="dcc_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dcc; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->bcc){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">BCC</label>
									<input type="text" name="bcc_<?php echo $emailscounter; ?>" id="bcc_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->bcc; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dbcc){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic BCC</label>
									<input type="text" name="dbcc_<?php echo $emailscounter; ?>" id="dbcc_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dbcc; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->fromname){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Fromname</label>
									<input type="text" name="fromname_<?php echo $emailscounter; ?>" id="fromname_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->fromname; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dfromname){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic Fromname</label>
									<input type="text" name="dfromname_<?php echo $emailscounter; ?>" id="dfromname_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dfromname; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->fromemail){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">FromEmail</label>
									<input type="text" name="fromemail_<?php echo $emailscounter; ?>" id="fromemail_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->fromemail; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dfromemail){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic FromEmail</label>
									<input type="text" name="dfromemail_<?php echo $emailscounter; ?>" id="dfromemail_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dfromemail; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
                            
                            <?php if($email->replytoname){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">ReplyTo name</label>
									<input type="text" name="replytoname_<?php echo $emailscounter; ?>" id="replytoname_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->replytoname; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dreplytoname){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic ReplyTo name</label>
									<input type="text" name="dreplytoname_<?php echo $emailscounter; ?>" id="dreplytoname_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dreplytoname; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->replytoemail){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">ReplyTo Email</label>
									<input type="text" name="replytoemail_<?php echo $emailscounter; ?>" id="replytoemail_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->replytoemail; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dreplytoemail){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic ReplyTo Email</label>
									<input type="text" name="dreplytoemail_<?php echo $emailscounter; ?>" id="dreplytoemail_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dreplytoemail; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							
							<div class="clear"> </div>
						</div>
					<?php $emailscounter++; ?>	
					<?php } ?>
					</div>
					<div class="clear"> </div>   
				</div> 
				</td><td valign="top">
				<div id="right_column" style="top:0px; ">
					<div class="box_header">Toolbox</div>
					<div class="items">
						<div class="emailitem"><span id="cf_to" title="To :: The To Email Address(es), if more than one, separate with comma , although you can add many of this">To</span></div>
						<div class="emailitem"><span id="cf_dto" title="Dynamic To :: This will hold a field name which will contain the To Email address, the wizard will let you pick one of the fields you already created in step 1">Dynamic To</span></div>
						<div class="emailitem"><span id="cf_subject" title="Subject :: The Email Subject Text">Subject</span></div>
						<div class="emailitem"><span id="cf_dsubject" title="Dynamic Subject :: This will hold a field name which will contain the Email Subject, the wizard will let you pick one of the fields you already created in step 1">Dynamic Subject</span></div>
						<div class="emailitem"><span id="cf_cc" title="CC :: The CC Email Address(es), if more than one, separate with comma , although you can add many of this">CC</span></div>
						<div class="emailitem"><span id="cf_dcc" title="Dynamic CC :: This will hold a field name which will contain the CC Email address, the wizard will let you pick one of the fields you already created in step 1">Dynamic CC</span></div>
						<div class="emailitem"><span id="cf_bcc" title="BCC :: The BCC Email Address(es), if more than one, separate with comma , although you can add many of this">BCC</span></div>
						<div class="emailitem"><span id="cf_dbcc" title="Dynamic BCC :: This will hold a field name which will contain the BCC Email address, the wizard will let you pick one of the fields you already created in step 1">Dynamic BCC</span></div>
						<div class="emailitem"><span id="cf_fromname" title="From Name :: The Email From Name, e.g. Admin">From Name</span></div>
						<div class="emailitem"><span id="cf_dfromname" title="Dynamic From Name :: This will hold a field name which will contain The Email From Name, the wizard will let you pick one of the fields you already created in step 1">Dynamic From Name</span></div>
						<div class="emailitem"><span id="cf_fromemail" title="From Email :: The Email From Email, e.g. Admin@Admin.com">From Email</span></div>
						<div class="emailitem"><span id="cf_dfromemail" title="Dynamic From Email :: This will hold a field name which will contain The Email From Email, the wizard will let you pick one of the fields you already created in step 1">Dynamic From Email</span></div>
						<div class="emailitem"><span id="cf_replytoname" title="ReplyTo Name :: The Replyto name, e.g. Admin">ReplyTo Name</span></div>
						<div class="emailitem"><span id="cf_dreplytoname" title="Dynamic ReplyTo Name :: This will hold a field name which will contain The Email ReplyTo Name, the wizard will let you pick one of the fields you already created in step 1">Dynamic ReplyTo Name</span></div>
						<div class="emailitem"><span id="cf_replytoemail" title="ReplyTo Email :: The Email ReplyTo Email, e.g. Admin@Admin.com">ReplyTo Email</span></div>
						<div class="emailitem"><span id="cf_dreplytoemail" title="Dynamic ReplyTo Email :: This will hold a field name which will contain The Email ReplyTo Email, the wizard will let you pick one of the fields you already created in step 1">Dynamic ReplyTo Email</span></div>
                    </div>
					<div id="Properties2">
						<div class="box_header border-top">Email Properties</div>        
							<div class="box_text">
								<div id="prop_cf_Email" class="Propertiesitem" style="display:none ">
									<span>Email Format:</span> <select name="prop_cf_Email_format" id="prop_cf_Email_format" size="1" class="select1"><option value="html" selected="selected">HTML</option><option value="text">Plain Text</option></select><hr />
									<span>Record IP:</span> <select name="prop_cf_Email_IP" id="prop_cf_Email_IP" size="1" class="select1"><option value="1" selected="selected">Yes</option><option value="0">No</option></select><hr />
									<span>Enabled:</span> <select name="prop_cf_Email_enable" id="prop_cf_Email_enable" size="1" class="select1"><option value="1" selected="selected">Yes</option><option value="0">No</option></select><hr />
									<span>Use Template Editor:</span> <select name="prop_cf_Email_editor" id="prop_cf_Email_editor" size="1" class="select1"><option value="1" selected="selected">Yes</option><option value="0">No</option></select><hr />
                                    <span>Enable Attachments:</span> <select name="prop_cf_Email_enable_attachments" id="prop_cf_Email_enable_attachments" size="1" class="select1"><option value="1" selected="selected">Yes</option><option value="0">No</option></select><hr />
                                    <input id="prop_cf_Email_done" type="button" name="prop_cf_Email_done" value="Apply" class="cf_button1" />
								</div>
								<div class="clear"></div>
							</div>
						<!--</div>	-->
					</div>
				</div>
								
		</td>
		</tr>
	</table>
		
			<textarea name="emails_temp" id="emails_temp" style="display:none; "></textarea>
			<input type="hidden" name="emails_temp_ids" id="emails_temp_ids" value="">
	</div>
	
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Emails Templates", 'extracodes' );
	?>
	<div id="page-codes">
		
				<div id="top_column3" style="display:none ">
				</div>
				<div id="left_column33">
					<div id="logdiv2" style="color:#FF0000; text-align:center ">If you left your Email template empty, a template will be automaticly generated similar to your form layout!</div>
						
					<?php $emailscounter = 0; ?>
					<?php foreach($emails as $email){ ?>
					<?php
						$registry = new JRegistry();
						$registry->loadINI( $email->params );
						$emailparams = $registry->toObject( );
						$params = $emailparams->recordip.','.$emailparams->emailtype.','.$emailparams->enabled.','.$emailparams->editor.','.$emailparams->enable_attachments;
					?>
						<div id="before_editor_email_<?php echo $emailscounter; ?>"><span style="font-weight: bold; font-size: 12px;">Email Template</span></div>
						<textarea class="<?php if($emailparams->editor == '1'){ ?>2mce_editable<?php } ?>" id="editor_email_<?php echo $emailscounter; ?>" name="editor_email_<?php echo $emailscounter; ?>" rows="20" cols="75" style="width:90%; height:350px; "><?php echo $email->template; ?></textarea>
						<input type="hidden" id="params_email_<?php echo $emailscounter; ?>" value="<?php echo $params; ?>" name="params_email_<?php echo $emailscounter; ?>">
						<div id="after_editor_email_<?php echo $emailscounter; ?>">
                        
                        <br/><br/></div>
					<?php $emailscounter++; ?>	
					<?php } ?>
				</div>				   
			
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Form Code", 'codes' );
	?>
	<div id="page-codes">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Plz enter the form HTML code here, the code may contains proper PHP code with tags and do NOT use the *form* tags, it will be created automaticlly" ); ?></td>
		<td><strong>Form HTML:</strong><br><strong style="color:#FF0000 ">(may contain PHP code with tags)</strong> </td>
		<td><a href="javascript:toggleList('html')">[+/-]</a></td>
		<td><textarea name="html" id="html" style="display:none" cols="80" rows="30"><?php echo htmlspecialchars($row->html); ?></textarea></td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "you can use some Javascript code here, plz dont enter the script opening or close tags" ); ?></td>
		<td><strong>Form JavaScript:</strong><br><strong style="color:#FF0000 ">(without the script tags)</strong> </td>
		<td><a href="javascript:toggleList('scriptcode')">[+/-]</a></td>
		<td><textarea name="scriptcode" id="scriptcode" style="display:none" cols="80" rows="10"><?php echo htmlspecialchars($row->scriptcode); ?></textarea></td>
	</tr>

	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "well formatted PHP code to be executed just when form is submitted but BEFORE Mail is sent" ); ?></td>
		<td><strong>On Submit code - before sending email:</strong><br><strong style="color:#FF0000 ">(PHP code with tags)</strong> </td>
		<td><a href="javascript:toggleList('onsubmitcodeb4')">[+/-]</a></td>
		<td><textarea name="onsubmitcodeb4" id="onsubmitcodeb4" style="display:none" cols="80" rows="10"><?php echo htmlspecialchars($row->onsubmitcodeb4); ?></textarea></td>
	</tr>

	<tr>
		<td><?php echo JHTML::_('tooltip', "well formatted PHP code to be executed just when form is submitted but AFTER Mail is sent" ); ?></td>
		<td><strong>On Submit code - after sending email:</strong><br><strong style="color:#FF0000 ">(PHP code with tags)</strong> </td>
		<td><a href="javascript:toggleList('onsubmitcode')">[+/-]</a></td>
		<td><textarea name="onsubmitcode" id="onsubmitcode" style="display:none" cols="80" rows="10"><?php echo htmlspecialchars($row->onsubmitcode); ?></textarea></td>
	</tr>

	
	</table>
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Form URLs", 'urls' );
	?>
	<div id="page-urls">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "This is the URL where the form will go after its submitted" ); ?></td>
		<td><strong>Redirect URL:</strong> </td>
		<td></td>
		<td><input type="text" class="inputbox" size="50" name="redirecturl" value="<?php echo htmlspecialchars($row->redirecturl); ?>" /><strong>  by default(if empty) will load an empty body area</strong></td>
	</tr>

	<tr>
		<td><?php echo JHTML::_('tooltip', "This is the *action* URL, you can use this to submit the form results to an external page like your payment gateway for example" ); ?></td>
		<td><strong>Submit URL:</strong><br><strong style="color:#FF0000 ">the "form" "action" URL</strong> </td>
		<td></td>
		<td><input type="text" class="inputbox" size="50" name="submiturl" value="<?php echo htmlspecialchars($row->submiturl); ?>" /><strong> dont put anything here unless you know what you are doing</strong></td>
	</tr>
	</table>
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "DB Connection", 'dbconnection' );
			$database =& JFactory::getDBO();
			$tables = $database->getTableList();
			$storedtables = explode(",", $paramsvalues->get('tablenames'));
	?>
	<div id="page-titlesx">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Choose if you want to enable the DB connection which means writing data to some table you choose" ); ?></td>
		<td><strong>Enable Data storage:</strong><br><strong style="color:#FF0000 "></strong> </td>
		<td></td>
		<td>
		<select name="params[dbconnection]" id="params[dbconnection]">
			<option<?php if($paramsvalues->get('dbconnection') == 'No'){ echo ' selected';} ?> value="No">No</option>
			<option<?php if($paramsvalues->get('dbconnection') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
		</select>
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Select the table(s) which you want the form to save/update to" ); ?></td>
		<td>TableName(s):</td><td></td>
		<td>
			<select name="tablenames[]" multiple size="10" id="tablenames">
				<?php foreach($tables as $table){ ?>
				<option <?php if(in_array($table, $storedtables)) echo "selected"; ?> value="<?php echo $table; ?>"><?php echo $table; ?></option>
				<?php } ?>
			</select>
		</td>
	</tr>
	</table>
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "AutoGenerated code", 'autogen' );
	?>
	<div id="page-autogen">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr>
		<td><?php echo JHTML::_('tooltip', "Saving Data to the Database will be before sending emails or after it ?" ); ?></td>
		<td><strong>Saving Data/Emails order:</strong></td>
		<td></td>
		<td>
		<select name="params[savedataorder]" id="params[savedataorder]">
				<option<?php if($paramsvalues->get('savedataorder') == 'after_email'){ echo ' selected';} ?> value="after_email">After Email</option>
				<option<?php if($paramsvalues->get('savedataorder') == 'before_email'){ echo ' selected';} ?> value="before_email">Before Email</option>
		</select>
		</td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "This code has been auto generated when you created a table for this form and is required for saving data" ); ?></td>
		<td><strong>Auto generated:</strong><br><strong style="color:#FF0000 ">Dont touch this unless you know what you are doing</strong> </td>
		<td><a href="javascript:toggleList('autogenerated')">[+/-]</a></td>
		<td><textarea name="autogenerated" id="autogenerated" cols="80" rows="20"><?php echo htmlspecialchars($row->autogenerated); ?></textarea></td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Chronoforms will process your form code and get all fields names and stores it here once you save the form, it will be used later many times and so this leads to better performance!" ); ?></td>
		<td><strong>Form Fields names:</strong><br><strong style="color:#FF0000 ">E.g: field_name_1,field_name_2</strong> </td>
		<td></td>
		<td>
		<input type="text" name="fieldsnames" id="fieldsnames" class="inputbox" size="100" value="<?php echo $row->fieldsnames; ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Chronoforms will process your form code and get all fields types and stores it here once you save the form, it will be used later many times and so this leads to better performance!" ); ?></td>
		<td><strong>Form Fields types:</strong><br><strong style="color:#FF0000 ">E.g: input_text,select,file</strong> </td>
		<td></td>
		<td>
		<input type="text" name="fieldstypes" id="fieldstypes" class="inputbox" size="100" value="<?php echo $row->fieldstypes; ?>">
		</td>
	</tr>
    <tr>
		<td><?php echo JHTML::_('tooltip', "Date fields which will load the calendar" ); ?></td>
		<td><strong>Date Fields names:</strong><br><strong style="color:#FF0000 ">E.g: date_1,date_2</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[datefieldsnames]" id="params[datefieldsnames]" class="inputbox" size="100" value="<?php echo $paramsvalues->get('datefieldsnames'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "by defaults chronoforms will concatenate posted arrays' values with commas to be a string, if you don't want this to happen then set this to No" ); ?></td>
		<td><strong>ChronoForms handle my posted arrays:</strong></td>
		<td></td>
		<td>
		<select name="params[handlepostedarrays]" id="params[handlepostedarrays]">
				<option<?php if($paramsvalues->get('handlepostedarrays') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
				<option<?php if($paramsvalues->get('handlepostedarrays') == 'No'){ echo ' selected';} ?> value="No">No</option>
		</select>
		</td>
	</tr>
	</table>
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "File Uploads", 'uploads' );
	?>
	<div id="page-uploads">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Choose if you want to enable file uploads through your form" ); ?></td>
		<td><strong>Enable uploads:</strong><br><strong style="color:#FF0000 "></strong> </td>
		<td></td>
		<td>
		<select name="params[uploads]" id="params[uploads]">
			<option<?php if($paramsvalues->get('uploads') == 'No'){ echo ' selected';} ?> value="No">No</option>
			<option<?php if($paramsvalues->get('uploads') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
		</select>
		</td>
        <td></td>
	</tr>

	<tr>
		<td><?php echo JHTML::_('tooltip', "Which fields are of type FILE ? Use this syntax to control allowable extensions : file_2:jpg|doc|zip{222222-1},file_3:gz|zip{99999999-0} " ); ?></td>
		<td><strong>Field names &amp; allowed Extensions &amp; sizes(KB) for each:</strong><br><strong style="color:#FF0000 ">E.g: file_2:jpg|doc|zip{222222-1},file_3:gz|zip{99999999-0}<br>extensions should be in low case!</strong>
		<br>
		</td>
		<td></td>
		<td>
		<input type="text" name="params[uploadfields]" id="params[uploadfields]" class="inputbox" size="100" value="<?php echo $paramsvalues->get('uploadfields'); ?>">
		</td>
        <td></td>
	</tr>
    
    <tr>
		<td><?php echo JHTML::_('tooltip', "Set the upload path" ); ?></td>
		<td><strong>Full upload Path:</strong></td>
		<td></td>
		<td>
        <?php
		if($row->name){
			$uploadpath = JPATH_SITE.DS."components".DS."com_chronocontact".DS.'uploads'.DS.$row->name.DS;
		}else{
			$uploadpath = '';
		}
		?>
		<input type="text" name="params[uploadpath]" id="params[uploadpath]" class="inputbox" size="100" value="<?php if(trim($paramsvalues->get('uploadpath'))){echo $paramsvalues->get('uploadpath');}else{echo $uploadpath;} ?>"><br />
        Default Path:<strong><?php echo JPATH_SITE.DS."components".DS."com_chronocontact".DS.'uploads'.DS.$row->name.DS; ?></strong>
		</td>
        <td>
		<?php
		$uploadpath = $paramsvalues->get('uploadpath') ? $paramsvalues->get('uploadpath') : JPATH_SITE.DS."components".DS."com_chronocontact".DS.'uploads'.DS.$row->name.DS;
		if(is_writable($uploadpath)){echo "<font style='color:#00FF00'>Writable</font>";}else{echo "<font style='color:#FF0000'>Not Writable</font>";}
		?>
        </td>
	</tr>
	</table>
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "DataView fields", 'dvfields' );
	?>
	<div id="page-dvfields">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Put here a list of fields names you would like to appear at the datagrid for this form data page, more than 1 field can be used separarted with a comma ," ); ?></td>
		<td><strong>Extra dataview columns fields names:</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[dvfields]" id="params[dvfields]" class="inputbox" size="50" value="<?php if(!$row->id){echo "recordtime";}else{echo $paramsvalues->get('dvfields');} ?>">
		</td>
	</tr>
	<tr style="background-color:#fff ">
		<td><?php echo JHTML::_('tooltip', 'main record view field text' ); ?></td>
		<td><strong><?php echo 'main view record'; ?>:</strong> </td>
		<td></td>
		<td>
		<?php if(!trim($paramsvalues->get('dvrecord'))){$paramsvalues->set('dvrecord', "Record #n");} ?>
		<input type="text" name="params[dvrecord]" id="params[dvrecord]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('dvrecord'); ?>">
		</td>
	</tr>
	</table>
	</div>
	<?php
			echo $pane->endPanel();
            echo $pane->startPanel( "Anti Spam", 'antispam' );
            // :: HACK :: show GD capability
            if(function_exists('gd_info')){
          	  $gd_info = gd_info();
			  $imagever_ok = true;
			}else{
				$imagever_ok = false;
			}
            if($imagever_ok){
				if ( !$gd_info['GD Version'] ) {
					$imagever_ok = false;
					$gd_info['GD Version'] = "GD library not found.";
				} else {
					if ( $gd_info['FreeType Support'] ) {
						$gd_info['FreeType Support'] = 'Yes';
					} else {
						$gd_info['FreeType Support'] = 'No';
						$imagever_ok = false;
					}
					if ( $gd_info['PNG Support'] ) {
						$gd_info['PNG Support'] = 'Yes';
					} else {
						$gd_info['PNG Support'] = 'No';
						$imagever_ok = false;
					}
				}
			}
			?>
			<div id="page-antispam">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "If you want to use image verification select *Yes* here then add {imageverification} inside your form html where you want the image verification to appear."); ?></td>
<?php
        if ( 1 ) {
            echo "<td><strong>Use Image verification:</strong><br><strong style='color:#FF0000' ></strong></td>
                <td>&nbsp;</td>
                <td>";
				?>
                <select name="params[imagever]" id="params[imagever]">
					<option<?php if($paramsvalues->get('imagever') == 'No'){ echo ' selected';} ?> value="No">No</option>
					<option<?php if($paramsvalues->get('imagever') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
				</select>
				</td>
	</tr>
	<tr>
	<td><?php echo JHTML::_('tooltip', "If your server wont support using true type fonts to draw the image then use without fonts or ask your host to install this feature"); ?></td>
	<td>What type of image to show ?</td><td>
				<select name="params[imtype]" id="params[imtype]">
					<option<?php if($paramsvalues->get('imtype') == '0'){ echo ' selected';} ?> value="0">Without Fonts</option>
					<option<?php if($paramsvalues->get('imtype') == '1'){ echo ' selected';} ?> value="1">With Fonts</option>
				</select>
				<?php
		} else {
		    echo "Image verification cannot be enabled becasue the GD Library has not been detected at your PHP installation.
		      <input type='hidden' name='params[imagever]' id='params[imagever]' value ='No' />";
		}
?>
		</td>
	</tr>
	<?php if ( 1 ) { ?>
	<tr>
	   <td><?php echo JHTML::_('tooltip', "Chronoforms will try to republish all your fileds with submitted data in case of wrong captcha code submission by user"); ?></td>
		<td>Republish fields if wrong submission ?</td><td>
	   <td>
	   <select name="params[captcha_dataload]" id="params[captcha_dataload]">
					<option<?php if($paramsvalues->get('captcha_dataload') == '0'){ echo ' selected';} ?> value="0">Dont Republish</option>
					<option<?php if($paramsvalues->get('captcha_dataload') == '1'){ echo ' selected';} ?> value="1">Try to Republish</option>
				</select>
	   </td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Error message which will appear in case of wrong CAPTCHA entry" ); ?></td>
		<td><strong>Error Message</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[imgver_error_msg]" id="params[imgver_error_msg]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('imgver_error_msg'); ?>">
		</td>
	</tr>
	<tr>
	   <td>&nbsp;</td>
	   <td>GD Version</td>
	   <td><?php echo $gd_info['GD Version']; ?></td>
	</tr>
		<tr>
	   <td>&nbsp;</td>
	   <td>FreeType Support</td>
	   <td><?php echo $gd_info['FreeType Support']; ?></td>
	</tr>
	</tr>
		<tr>
	   <td>&nbsp;</td>
	   <td>PNG Support</td>
	   <td><?php echo $gd_info['PNG Support']; ?></td>

	</tr>
	<?php } ?>
<?php
	if ( 1 ) {
	global $mainframe; ?>
	   <tr>
	       <td>&nbsp;</td>
	       <td>Sample image: </td>
	       <td><img src='<?php echo $mainframe->getSiteURL(); ?>components/com_chronocontact/chrono_verification.php<?php if($paramsvalues->get('imtype') == '1'){ echo '?imtype=1';}else{ echo '?imtype=0';} ?>'></td>
	       </tr>
		   <?php
	}
?>
	<!-- // end hack -->
	</table>
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Validation", 'validation' );
	?>
	<div id="page-validation">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Enable Validation ?" ); ?></td>
		<td><strong>Enable Validation ?</strong> </td>
		<td></td>
		<td>
		<select name="params[validate]" id="params[validate]">
			<option<?php if($paramsvalues->get('validate') == 'No'){ echo ' selected';} ?> value="No">No</option>
			<option<?php if($paramsvalues->get('validate') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
		</select>
		</td>
	</tr>
    
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_( 'tooltip',"Validation Library used" ); ?></td>
		<td><strong><?php echo "Validation Library"; ?></strong> </td>
		<td></td>
		<td>
		<select name="params[validatetype]" id="params[validatetype]">
			<option<?php if($paramsvalues->get('validatetype') == 'mootools'){ echo ' selected';} ?> value="mootools">mootools</option>
		</select>
		</td>
	</tr>
	<tr>
		<td colspan="4">If you need a custom error message then put it at your field title attribute! e.g: &lt;input name="field1" title="Enter your first name here"&gt;</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>1 - required (not blank)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_required]" id="params[val_required]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_required'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>2- validate-number (a valid number)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_number]" id="params[val_validate_number]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_number'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>3- validate-digits (digits only)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_digits]" id="params[val_validate_digits]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_digits'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>4- validate-alpha (letters only)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_alpha]" id="params[val_validate_alpha]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_alpha'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>5- validate-alphanum (only letters and numbers)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_alphanum]" id="params[val_validate_alphanum]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_alphanum'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>6- validate-date (a valid date value)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_date]" id="params[val_validate_date]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_date'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>7- validate-email (a valid email address)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_email]" id="params[val_validate_email]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_email'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>8- validate-url (a valid URL)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_url]" id="params[val_validate_url]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_url'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>9- validate-date-au (a date formatted as; dd/mm/yyyy)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_date_au]" id="params[val_validate_date_au]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_date_au'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>10- validate-currency-dollar (a valid dollar value)</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_currency_dollar]" id="params[val_validate_currency_dollar]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_currency_dollar'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "(first option e.g. *Select one...* is not selected option) -- Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>11- validate-selection</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_selection]" id="params[val_validate_selection]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_selection'); ?>">
		</td>
	</tr>
	<tr>
		<td><?php echo JHTML::_('tooltip', "(At least one textbox/radio element must be selected in a group - see below*) -- Put list of fields names separated with comma *,* if more than one" ); ?></td>
		<td><strong>12- validate-one-required</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_one_required]" id="params[val_validate_one_required]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_one_required'); ?>">
		</td>
	</tr>
    <tr>
		<td><?php echo JHTML::_('tooltip', "Validate that 2 fields values are the same, enter the 1st field name to validate then '=' then the 2nd field name, e.g : password=confirm_password" ); ?></td>
		<td><strong>13- validate-confirmation</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[val_validate_confirmation]" id="params[val_validate_confirmation]" class="inputbox" size="50" value="<?php echo $paramsvalues->get('val_validate_confirmation'); ?>">
		</td>
	</tr>
	<tr><td colspan="4"><strong>Special thanks to "bouton" for referring to this feature!!</strong></td></tr>
	</table>
	<hr><hr>
	<strong>ServerSide Validation</strong>
	<hr><hr>
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Enable Server Side Validation ?" ); ?></td>
		<td><strong>Enable Server Side Validation ?</strong> </td>
		<td></td>
		<td>
		<select name="params[servervalidate]" id="params[servervalidate]">
			<option<?php if($paramsvalues->get('servervalidate') == 'No'){ echo ' selected';} ?> value="No">No</option>
			<option<?php if($paramsvalues->get('servervalidate') == 'Yes'){ echo ' selected';} ?> value="Yes">Yes</option>
		</select>
		</td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "Add here some PHP code with tags to get executed on form submission, in case this code returned any data, the form submission will be halted, the form will be reshown and your retruned data will be dsiplayed in a message above the form!" ); ?></td>
		<td><strong>Server Side validation Code:</strong></strong> </td>
		<td><a href="javascript:toggleList('server_validation')">[+/-]</a></td>
		<td><textarea name="server_validation" id="server_validation" cols="80" rows="20"><?php echo $row->server_validation; ?></textarea></td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td colspan="4">exemple:<br>
		&lt;?php <br>
		if($_POST['accept_terms'] != 'yes')<br>
		return 'Sorry, but you need to accept our terms to proceed';<br>
		?&gt;<br>
		</td>
	</tr>
	</table>
	
	
	</div>
	
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Plugins", 'plugins' );
			?>
			<div id="page-plugins">
			<table border="0" cellpadding="3" cellspacing="0">
	<tr><td colspan="3"><font style="font-size:12px; color:#FF0000; font-weight:bold; ">Pay attention: Some plugins work onsubmit the form event<br> and will do some database changes, please assure that plugins<br> are very well configured or this may end up saving wrong<br> data to the database tables!</font></td></tr>
	
	<?php
			$directory = JPATH_SITE.'/components/com_chronocontact/plugins/';
			$results = array();
			$handler = opendir($directory);
			while ($file = readdir($handler)) {
				if ( $file != '.' && $file != '..' && substr($file, -4) == '.php' && substr($file, 0, 3) == 'cf_')
					$results[] = str_replace(".php","", $file);
			}
			closedir($handler);
			$order = 0;
			$mplugins_order = explode(",", $paramsvalues->get('mplugins_order'));
			foreach($results as $result){
			require_once(JPATH_SITE."/components/com_chronocontact/plugins/".$result.".php");
			${$result} = new $result();
	?>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip',  ${$result}->result_TOOLTIP ); ?></td>
		<td><strong><?php echo ${$result}->result_TITLE; ?>:</strong> </td>
		<td>
		<input type="checkbox" onClick="enable_order('mplugins_order_<?php echo ${$result}->result_TITLE; ?>','plugins_order_<?php echo ${$result}->result_TITLE; ?>')" id="plugins_order_<?php echo ${$result}->result_TITLE; ?>" name="plugins[]" <?php if(in_array($result,explode(",",$paramsvalues->get('plugins'))))echo "checked"; ?> class="inputbox" size="50" value="<?php echo $result; ?>">
		</td>
		<td><input type="text" maxlength="2" <?php if(in_array($result,explode(",",$paramsvalues->get('plugins')))){ ?><?php }else{ ?>disabled="true"<?php } ?> size="2" name="mplugins_order[]" id="mplugins_order_<?php echo ${$result}->result_TITLE; ?>" value="<?php if(in_array($result,explode(",",$paramsvalues->get('plugins')))){echo $mplugins_order[$order];} ?>">
		<a href="javascript:change_order1_plus('mplugins_order_<?php echo ${$result}->result_TITLE; ?>')">[+]</a>&nbsp;
		<a href="javascript:change_order1_minus('mplugins_order_<?php echo ${$result}->result_TITLE; ?>')">[-]</a>
		</td>
	</tr>	
	
	<?php
				if(in_array($result,explode(",",$paramsvalues->get('plugins')))){
					$order++;
				}
			}	
	?>
	</table>
	</div>
	<?php
	echo $pane->endPanel();
	echo $pane->startPanel( 'RunOrder', 'RunOrder' );
	if((!$paramsvalues->get('autogenerated_order'))||(!$paramsvalues->get('onsubmitcode_order'))||(!$paramsvalues->get('plugins_order'))){
		$paramsvalues->set('autogenerated_order', 3);
		$paramsvalues->set('onsubmitcode_order', 2);
		$paramsvalues->set('plugins_order', 1);
	}
	?>
	<div id="page-runorder">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr><td colspan="3"><font style="font-size:12px; color:#FF0000; font-weight:bold; ">Here you can change the order the different code blocks run, <br>valid values are 1 or 2 or 3 <br>using other values will result in the whole block doesn't executed!</font></td></tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip',   "Order of Autogenerated block" ); ?></td>
		<td><strong><?php echo "Order of Autogenerated block"; ?>:</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[autogenerated_order]" id="params_autogenerated_order" class="inputbox" size="1" maxlength="1" value="<?php echo $paramsvalues->get('autogenerated_order'); ?>">
		<a href="javascript:change_order1_plus('params_autogenerated_order')">[+]</a>&nbsp;
		<a href="javascript:change_order1_minus('params_autogenerated_order')">[-]</a>
		</td>
	</tr>	
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip',  "Order of OnSubmit block" ); ?></td>
		<td><strong><?php echo "Order of OnSubmit block"; ?>:</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[onsubmitcode_order]" id="params_onsubmitcode_order" class="inputbox" size="1" maxlength="1" value="<?php echo $paramsvalues->get('onsubmitcode_order'); ?>">
		<a href="javascript:change_order1_plus('params_onsubmitcode_order')">[+]</a>&nbsp;
		<a href="javascript:change_order1_minus('params_onsubmitcode_order')">[-]</a>
		</td>
	</tr>	
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip',  "Order of Plugins block" ); ?></td>
		<td><strong><?php echo "Order of Plugins block"; ?>:</strong> </td>
		<td></td>
		<td>
		<input type="text" name="params[plugins_order]" id="params_plugins_order" class="inputbox" size="1" maxlength="1" value="<?php echo $paramsvalues->get('plugins_order'); ?>">
		<a href="javascript:change_order1_plus('params_plugins_order')">[+]</a>&nbsp;
		<a href="javascript:change_order1_minus('params_plugins_order')">[-]</a>
		</td>
	</tr>	
	</table>
	</div>
	<?php
			echo $pane->endPanel();
			echo $pane->startPanel( "Extra Form Code", 'extracodes' );
	?>
	<div id="page-codes">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "This is an extra code box which can be used by the user to store any data" ); ?></td>
		<td><strong>Extra code 1:</strong> </td>
		<td><a href="javascript:toggleList('extra1')">[+/-]</a></td>
		<td><textarea name="extra1" id="extra1" style="display:none" cols="80" rows="10"><?php echo htmlspecialchars($row->extra1); ?></textarea></td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "This is an extra code box which can be used by the user to store any data" ); ?></td>
		<td><strong>Extra code 2:</strong> </td>
		<td><a href="javascript:toggleList('extra2')">[+/-]</a></td>
		<td><textarea name="extra2" id="extra2" style="display:none" cols="80" rows="10"><?php echo htmlspecialchars($row->extra2); ?></textarea></td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "This is an extra code box which can be used by the user to store any data" ); ?></td>
		<td><strong>Extra code 3:</strong> </td>
		<td><a href="javascript:toggleList('extra3')">[+/-]</a></td>
		<td><textarea name="extra3" id="extra3" style="display:none" cols="80" rows="10"><?php echo htmlspecialchars($row->extra3); ?></textarea></td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "This is an extra code box which can be used by the user to store any data" ); ?></td>
		<td><strong>Extra code 4:</strong> </td>
		<td><a href="javascript:toggleList('extra4')">[+/-]</a></td>
		<td><textarea name="extra4" id="extra4" style="display:none" cols="80" rows="10"><?php echo htmlspecialchars($row->extra4); ?></textarea></td>
	</tr>
	<tr style="background-color:#c9c9c9 ">
		<td><?php echo JHTML::_('tooltip', "This is an extra code box which can be used by the user to store any data" ); ?></td>
		<td><strong>Extra code 5:</strong> </td>
		<td><a href="javascript:toggleList('extra5')">[+/-]</a></td>
		<td><textarea name="extra5" id="extra5" style="display:none" cols="80" rows="10"><?php echo htmlspecialchars($row->extra5); ?></textarea></td>
	</tr>
	</table>
	</div>
<?php
	echo $pane->endPanel();
	echo $pane->endPane();
?></div>
<!--</div>--><div class="clr"></div>
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
	</form>
  <?php
  echo JHTML::_('behavior.keepalive');
	}

	function maketableChronoContact( $row, $option, $html_message  ) {
   
		?>
		<?php echo JHTML::_('behavior.tooltip'); ?>
		<script type="text/javascript">
		function addnewfield(){
			var Row = new Element('tr', {'height': '10'});
			var Cell_1 = new Element('td', {'width': '30'});
			var Check1 = new Element('input', {'value': '0', 'type':'checkbox', 'id':'cf_data', 'name': 'cf_new[]', 'onclick': 'this.checked ? this.value=\'1\' : this.value=\'0\''});
			var Cell_2 = new Element('td', {'width': '30'});
			var Cell_3 = new Element('td', {'width': '50', 'class':'tablecell1'});
			var Check2 = new Element('input', {'size': '50', 'type':'text', 'name': 'cform_name[]'});
			var Cell_4 = new Element('td', {'width': '30'});
			var Cell_5 = new Element('td', {'class': 'tablecell2'});
			var Cell_6 = new Element('td', {'class': 'tablecell2'});
			var Check3 = new Element('input', {'value': '1', 'type':'checkbox', 'id':'cf_auto', 'name': 'cf_auto[]'});
			var Cell_7 = new Element('td', {'class': 'tablecell2'});
			var Check4 = new Element('input', {'value': '1', 'type':'checkbox', 'id':'cf_pri', 'name': 'cf_pri[]'});
			var Cell_8 = new Element('td', {'class': 'tablecell2'});
			var span = new Element('span').setText('New Field - Leave blank if you dont want it to be added');
			//Check1.injectInside(Cell_1);
			Check2.injectInside(Cell_3);
			var newtype = $('temp_type').clone();
			newtype.setProperty('name', 'cf_type[]');
			newtype.setProperty('id', '');
			newtype.setStyle('display', 'inline');
			newtype.injectInside(Cell_5);
			//Check3.injectInside(Cell_6);
			//Check4.injectInside(Cell_7);
			span.injectInside(Cell_8);
			Cell_1.injectInside(Row);
			Cell_2.injectInside(Row);
			Cell_3.injectInside(Row);
			Cell_4.injectInside(Row);
			Cell_5.injectInside(Row);
			Cell_6.injectInside(Row);
			Cell_7.injectInside(Row);
			Cell_8.injectInside(Row);
			Row.injectInside($('create_table_table'));
		}
		</script>
	  <form action="index2.php" method="post" name="adminForm">
	  <?php if($html_message == '</table>'){ echo "Not enough form fields to create table";}
	  else if($html_message == 'exists') { echo "A table has already been created for this form";}
	  else { ?>
		<?php echo $html_message; ?>
		<br><input type='button' value='Add new Field' onClick='addnewfield();'> OR <input type="submit" name="submit2" value="Save Table">
		<?php } ?>
	  <input type="hidden" name="option" value="<?php echo $option; ?>" />
	  <input type="hidden" name="formid" value="<?php echo $row->id; ?>" />
	  <input type="hidden" name="task" value="finalizetable" />
	  <input type="hidden" name="boxchecked" value="0" />
	  <input type="hidden" name="hidemainmenu" value="0">
		<select name="temp_type" id="temp_type" style="display:none; ">
			<option value="VARCHAR(255)">VARCHAR(255)</option>
			<option value="TINYINT">TINYINT</option>
			<option value="TEXT">TEXT</option>
			<option value="DATE">DATE</option>
			<option value="SMALLINT">SMALLINT</option>
			<option value="MEDIUMINT">MEDIUMINT</option>
			<option value="INT(11)">INT(11)</option>
			<option value="BIGINT">BIGINT</option>
			<option value="FLOAT">FLOAT</option>
			<option value="DOUBLE">DOUBLE</option>
			<option value="DECIMAL">DECIMAL</option>
			<option value="DATETIME">DATETIME</option>
			<option value="TIMESTAMP">TIMESTAMP</option>
			<option value="TIME">TIME</option>
			<option value="YEAR">YEAR</option>
			<option value="CHAR">CHAR</option>
			<option value="TINYBLOB">TINYBLOB</option>
			<option value="TINYTEXT">TINYTEXT</option>
			<option value="BLOB">BLOB</option>
			<option value="MEDIUMBLOB">MEDIUMBLOB</option>
			<option value="MEDIUMTEXT">MEDIUMTEXT</option>
			<option value="LONGBLOB">LONGBLOB</option>
			<option value="LONGTEXT">LONGTEXT</option>
			<option value="ENUM">ENUM</option>
			<option value="SET">SET</option>
			<option value="BIT">BIT</option>
			<option value="BOOL">BOOL</option>
			<option value="BINARY">BINARY</option>
			<option value="VARBINARY">VARBINARY</option>
		</select>
	  </form>
	<?php
		}

	function settings( $option, $params, $id ) {
		global $mosConfig_live_site;
		?>
		<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<form action="index2.php" method="post" name="adminForm">
		<table style="width:75%;" class="adminheading">
		<tr>
			<th class="config">
			ChronoForms Global Settings
			</th>
		</tr>
		</table>

		<table style="width:75%;" class="adminform">
		<tr>
			<th>
			Parameters
			</th>
		</tr>
		<tr>
			<td>
			<?php
			echo $params->render();
			?>
			</td>
		</tr>
		</table>

		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option ?>" />
		<input type="hidden" name="task" value="" />
		</form>

		<?php

		}

function showdataChronoContact( $rows, $pageNav, $option, $formid, $table ) {
    // HTML starts here, combined with short PHP commands for table creation
    global $mainframe;	
	$database =& JFactory::getDBO();
    echo JHTML::_('behavior.tooltip');
	$database->setQuery( "SELECT * FROM #__chrono_contact WHERE id='".$formid."'" );
	$formdata = $database->loadObjectList();
	
	$paramsvalues = new JParameter($formdata[0]->paramsall);
	$dvfields = $paramsvalues->get('dvfields');
	$dvlist = array();
	if ( !empty($dvfields) ) {
	  $dvlist = explode(",", $dvfields);
	}
	
	# get primary key
	$tables = array();
	$tables[] = $table;
	$result = $database->getTableFields( $tables, false );
	$table_fields = $result[$table];
	$primary = 'cf_id';
	foreach($table_fields as $table_field => $field_data){
		if($field_data->Key == 'PRI')$primary = $table_field;
	}
    ?>
    <form action="index2.php" method="post" name="adminForm">
    <table class="adminlist" width="100%">
	<tr>
	  <th width="20px" class='title'>#</th>
	  <th width="20px" class='title'><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>

	  <th class='title'><?php echo str_replace(array("{", "}"), array("", ""), $paramsvalues->get('dvrecord')); ?></th>
	  
	  <?php foreach($dvlist as $dvitem){ ?>
	  	<th class='title' align="center"><?php echo trim($dvitem); ?></th>
	  <?php } ?>
	</tr>
	<?php
	    $names = array();
	    $names = explode(",", $formdata[0]->fieldsnames);
		
	?>
    <?php
	$k = 0;
    for ($i=0, $n=count($rows); $i < $n; $i++) {
	  $row = $rows[$i];

	  ?>
	  <tr class="<?php echo "row$k"; ?>">
		<td  width="20px" align="center"><?php echo $i+$pageNav->limitstart+1;?></td>
		<td width="20px"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->$primary; ?>_<?php echo $formid; ?>" onclick="isChecked(this.checked);" /></td>

		<td><a href="#viewdata" onclick="return listItemTask('cb<?php echo $i;?>','viewdata')">
		<?php 
		$dvrecord = $paramsvalues->get('dvrecord');
		foreach($table_fields as $fname => $field_data){//echo $fname;
			if ( property_exists($row, $fname) ) {
				$dvrecord = str_replace("{".$fname."}", $row->$fname, $dvrecord);
			}
		}
		echo str_replace("#n", $i+$pageNav->limitstart+1, $dvrecord);
		?>		
		</a></td>

		
		<?php foreach($dvlist as $dvitem){ ?>
        <?php $dvitem = trim($dvitem); ?>
	  		<td align="left"><?php echo $row->$dvitem; ?></td>
		<?php } ?>
	  </tr>
      <?php
			$k = 1 - $k;
		}
    ?>
		<tr><td colspan="6" style="white-space:nowrap; " height="20px"><?php echo $pageNav->getListFooter(); ?></td></tr>
	  </table>
	  <input type="hidden" name="option" value="<?php echo $option; ?>" />
	  <input type="hidden" name="task" value="show" />
	   <input type="hidden" name="table" value="<?php echo $table; ?>" />
	  <input type="hidden" name="formid[]" value="<?php echo $formid; ?>" />
	  <input type="hidden" name="cidxx[]" value="<?php echo $formid; ?>" />
	  <input type="hidden" name="boxchecked" value="0" />
	  <input type="hidden" name="hidemainmenu" value="0">
	  </form>
    <?php
	}
  function viewdataChronoContact( $row, $option, $tablename, $formid ) {
   global $mainframe;
	$database =& JFactory::getDBO();
	$database->setQuery("SELECT titlesall FROM #__chrono_contact WHERE id='".$formid."'");
	$titles = $database->loadResult();
	$titles_lines = explode("\n", $titles);
		//mosMakeHtmlSafe( $row, ENT_QUOTES );
		$tables = array( $tablename );
 		$result = $database->getTableFields( $tables );
		$table_fields = array_keys($result[$tablename]);
		?>
		<form action="index2.php" method="post" name="adminForm">

		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminlist">
		<tr><td width="50%"><strong>Field name</strong></td><td width="50%"><strong>Field Data</strong></td></tr>
		<?php
		$k = 0;
		foreach($table_fields as $table_field){
		$table_field_title = $table_field;
			if(count($titles_lines)){
				foreach($titles_lines as $titles_line){
					$thisline = explode("=", $titles_line);
					if(trim($thisline[0]) == $table_field){
						$table_field_title = $thisline[1];
					}
				}
			}
		?>
		<tr class="<?php echo "row$k"; ?>"><td width="50%">
		<strong><?php echo $table_field_title ; ?>	:</strong>  </td><td width="50%"><?php echo $row->$table_field ; ?>
		</td></tr>
		<?php $k = 1 - $k; } ?>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="table" value="<?php echo $tablename; ?>" />
	  <input type="hidden" name="task" value="" />
	  <input type="hidden" name="formid" value="<?php echo $formid; ?>" />
	  <input type="hidden" name="boxchecked" value="0" />
	  <input type="hidden" name="hidemainmenu" value="0">
	  </form>
		<?php
		}
		
	function restoreChronoContact( $id, $option ){
	
	?>
	<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminlist">
<tr><td>Choose your .cfbak form file: &nbsp;<input type="file" name="file"></td></tr>
<tr><td><input type="submit" value="submit file"></td></tr>
</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
	  <input type="hidden" name="task" value="restore2" />
	  <input type="hidden" name="formid" value="<?php echo $id; ?>" />
	  <input type="hidden" name="boxchecked" value="0" />
	  <input type="hidden" name="hidemainmenu" value="0">
	  </form>
	<?php
	}
	function menu_creator( $option ){
	global $mainframe;
	$database =& JFactory::getDBO();
	//require_once(JPATH_BASE."/administrator/components/com_chronocontact/languages/english.chronocontact.php");
	?>
	<strong>This page is to help you add a menu link to the <strong style="color:#FF0000">admin components menu</strong> to take you directly to the "show saved data" of some form you choose</strong><br><br>
	<script type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (form.linktext.value == '') {
			alert( "Please enter a text for the menu link" );
		} else if (form.form_id.options[form.form_id.selectedIndex].value == '') {
			alert( "Please select a form for the menu item" );
		} else if (form.parent.options[form.parent.selectedIndex].value == '') {
			alert( "Please select a parent for the menu item" );
		} else if (form.ordering.value == '') {
			alert( "Please enter an order for the menu link" );
		} else if (form.icon.options[form.icon.selectedIndex].value == '') {
			alert( "Please select an icon for the menu item" );
		} else {
			submitform( pressbutton );
		}
	}
	</script>
	<form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
				<td><?php echo "Form"; ?>:</td>
				<td>
				<select name="form_id">
				<option value="">Select Form</option>
				<?php
				$database->setQuery("SELECT * FROM #__chrono_contact");
				$forms = $database->loadObjectList();
				foreach($forms as $form){
				?>
				<option value="<?php echo $form->id; ?>"><?php echo $form->name; ?></option>
				<?PHP } ?>
				</select>
				</td>
			</tr>
			<tr>
				<td><?php echo "Parent"; ?>:</td>
				<td>
				<select name="parent">
				<option value="">Select Parent</option>
				<option value="0"><?php echo 'Root'; ?></option>
				<?php
				$database->setQuery("SELECT * FROM #__components");
				$parents = $database->loadObjectList();
				foreach($parents as $parent){
				?>
				<option value="<?php echo $parent->id; ?>"><?php echo $parent->name; ?></option>
				<?PHP } ?>
				</select>
				</td>
			</tr>
			<tr>
				<td><?php echo "Link Text"; ?>:</td>
				<td>
				<input type="text" name="linktext" value="">
				</td>
			</tr>
			<tr>
				<td><?php echo "Order"; ?>:</td>
				<td>
				<input type="text" name="ordering" value="">
				</td>
			</tr>
			<tr>
				<td><?php echo "Icon"; ?>:</td>
				<td>
				<select name="icon">
				<option value="">Please select</option>
				<?php
				$directory = JPATH_SITE.'/includes/js/ThemeOffice/';
				$results = array();
				$handler = opendir($directory);
				while ($file = readdir($handler)) {
					if ($file != '.' && $file != '..')
						$results[] = $file;
				}
				closedir($handler);
				foreach($results as $result){
				?>
				<option value="<?php echo $result; ?>"><?php echo $result; ?></option>
				<?PHP } ?>
				</select>
				</td>
			</tr>
		</table>
	<input type="hidden" name="option" value="<?php echo $option; ?>" />
	<input type="hidden" name="task" value="menu_creator" />
	<input type="hidden" name="c" value="menu_creator" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="hidemainmenu" value="1">
	</form>
	  <?php
	  }
	  
	function menu_remover( $option ) {
    global $mainframe;
	$database =& JFactory::getDBO();
	$database->setQuery("SELECT * FROM #__components WHERE admin_menu_link LIKE '%option=com_chronocontact&task=show%'");
	$rows = $database->loadObjectList();
    ?>
    <form action="index2.php" method="post" name="adminForm">
	
    <table class="adminheading">
    <tr>
	  <th>Chrono Forms - Menu Remover</th>
    </tr>
	</table>
    <table class="adminlist">
	<tr>
	  <th width="5%" align="center">#</th>
	  <th width="5%" align="center"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
	  <th width="85%" align="center" class='title'>Name</th>
	  <th width="5%" align="center" class='title'>Delete</th>
	</tr>
    <?php
	$k = 0;
    for ($i=0, $n=count($rows); $i < $n; $i++) {
	  $row = $rows[$i];
		$link	= 'index2.php?option=com_chronocontact&task=editA&hidemainmenu=1&id='. $row->id;
	  ?>
	  <tr class="<?php echo "row$k"; ?>">
		<td width="5%" align="center"><?php echo $i;?></td>
		<td width="5%" align="center"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>		
		<td width="85%" align="center"><?php echo $row->name; ?></td>
		<td width="5%" align="center"><a href="#menu_delete" onclick="return listItemTask('cb<?php echo $i;?>','menu_delete')"><img border="0" alt="Published" src="images/stop_f2.png"/></a></td>		
	  </tr>
      <?php
			$k = 1 - $k;
		}
    ?>		
	  </table>
	  <input type="hidden" name="option" value="<?php echo $option; ?>" />
	  <input type="hidden" name="task" value="" />
	  <input type="hidden" name="boxchecked" value="0" />
	  <input type="hidden" name="hidemainmenu" value="0">
	  </form>
    <?php
	}
	
	
	function form_wizard($htmloutput, $row, $option){
	global $mainframe;
		?>
		<!--[if gte IE 6]><link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>style1-ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
		<!--[if gte IE 7]><link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>style1-ie7.css" rel="stylesheet" type="text/css" /><![endif]-->
		<!--[if !IE]> <--><link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>style1.css" rel="stylesheet" type="text/css" /><!--> <![endif]-->
		<link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>calendar.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>tooltip.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo JURI::Base().'components/com_chronocontact/css/x'; ?>accordion.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>smoothbox/smoothbox.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		var counter = 0; 
		var emailcounter = 0;
		var email_element_counter = 0; 
		</script>
		<script type="text/javascript" src="<?php echo JURI::Base().'components/com_chronocontact/js/'; ?>calendar.js"></script>
		<script type="text/javascript" src="<?php echo JURI::Base().'components/com_chronocontact/js/'; ?>CFElements.js"></script>
		
		<script type="text/javascript" src="<?php echo JURI::Base().'components/com_chronocontact/js/'; ?>smoothbox/smoothbox.js"></script>
		<script type="text/javascript" src="<?php echo JURI::Base().'components/com_chronocontact/js/'; ?>wizard.js"></script>


 <script type="text/javascript" src="<?php echo JURI::Base().'components/com_chronocontact/js/'; ?>tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
			tinyMCE.init({
			theme : "advanced",
			language : "en",
			mode : "textareas",
			gecko_spellcheck : "true",
			editor_selector : "mce_editable",
			document_base_url : "<?php echo $mainframe->getSiteURL(); ?>",
			entities : "60,lt,62,gt",
			relative_urls : 1,
			remove_script_host : false,
			save_callback : "TinyMCE_Save",
			invalid_elements : "applet",
			extended_valid_elements : "a[class|name|href|target|title|onclick|rel],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],,hr[id|title|alt|class|width|size|noshade]",
			theme_advanced_toolbar_location : "top",
			theme_advanced_source_editor_height : "550",
			theme_advanced_source_editor_width : "450",
			directionality: "ltr",
			force_br_newlines : "false",
			force_p_newlines : "true",
			content_css : "<?php echo $mainframe->getSiteURL(); ?>templates/system/css/editor.css",
			debug : false,
			cleanup : true,
			cleanup_on_startup : false,
			safari_warning : false,
			plugins : "advlink, advimage, searchreplace,insertdatetime,emotions,media,advhr,table,fullscreen,directionality,layer,style",
			theme_advanced_resizing : true,
			//theme_advanced_buttons1_add : "fontselect",
			theme_advanced_buttons2_add : "media,ltr,rtl,insertlayer,forecolor",
			theme_advanced_buttons3_add : "advhr,fullscreen,styleprops,fontselect",
			theme_advanced_buttons4 : "tablecontrols",
			//theme_advanced_buttons5 : "fontselect",
			theme_advanced_disable : "help",
			plugin_insertdate_dateFormat : "%Y-%m-%d",
			plugin_insertdate_timeFormat : "%H:%M:%S",
			
			fullscreen_settings : {
				theme_advanced_path_location : "top"
			}
			
			/*setup : function(ed) {
				ed.onClick.add(function(ed) {
					ed.windowManager.alert('User clicked the editor.');
				});

				ed.addButton('cffield', {
					title : 'Add Form Field',
					image : 'http://192.168.1.2/xampp/joomla153/administrator/components/com_chronocontact/css/img/next.gif',
					onclick : function() {
						ed.selection.setContent('<strong>Hello world!</strong>');
					}
				});
			}*/
		});
		function TinyMCE_Save(editor_id, content, node)
		{
			base_url = tinyMCE.settings['document_base_url'];
			var vHTML = content;
			if (true == true){
				//vHTML = tinyMCE.regexpReplace(vHTML, 'href\s*=\s*"?'+base_url+'', 'href="', 'gi');
				//vHTML = tinyMCE.regexpReplace(vHTML, 'src\s*=\s*"?'+base_url+'', 'src="', 'gi');
				//vHTML = tinyMCE.regexpReplace(vHTML, 'mce_real_src\s*=\s*"?', '', 'gi');
				//vHTML = tinyMCE.regexpReplace(vHTML, 'mce_real_href\s*=\s*"?', '', 'gi');
			}
			return vHTML;
		}
	</script>
	<script type="text/javascript">	
	window.addEvent('domready', function() {
		var top = $('right_column').getPosition().y - 2;
		var marginChange = new Fx.Style('right_column', 'margin-top', {wait:false, duration:500, transition:Fx.Transitions.Elastic.easeOut});		
		window.addEvent('scroll', function() {
			if(($('left_column').getCoordinates().height + $('top_column').getCoordinates().height) > ($('right_column').getCoordinates().height + window.getScrollTop() - top - 50) ){
				marginChange.start(Math.max(0, window.getScrollTop() - top));
			}
		});
		var top2 = $('right_column2').getPosition().y - 2;
		var marginChange2 = new Fx.Style('right_column2', 'margin-top', {wait:false, duration:500, transition:Fx.Transitions.Elastic.easeOut});		
		window.addEvent('scroll', function() {
			if($('emailbuilder').getStyle('display') == 'block'){
				if(($('top_column2').getPosition().y - window.getScrollTop()) <= 0){
					marginChange2.start(Math.max(0, window.getScrollTop() - $('top_column2').getPosition().y));
				}
			}
		});
	});
	
	window.addEvent('domready', function() {
		$ES('.form_item',$('left_column')).each(function(theitem){
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
					$ES('.form_item',$('left_column')).each(function(item2){
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
					$('formbuilder').setStyle('height', ( ($('left_column').getCoordinates().height + $('top_column').getCoordinates().height) > $('right_column').getCoordinates().height ) ? ($('left_column').getCoordinates().height + $('top_column').getCoordinates().height + 150) : $('right_column').getCoordinates().height + 150);
				}			
			});
			$E('.delete_icon', theitem).addEvent('click', function(e) {
				new Event(e).stop();
				this.getParent().remove();
				$$('div.Propertiesitem').each(function(item){
					item.setStyle('display','none');
				});
			});
			$E('.config_icon', theitem).addEvent('click', function(e) {
				new Event(e).stop();
				$ES('.form_item',$('left_column')).each(function(item2){
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
				$('formbuilder').setStyle('height', ( ($('left_column').getCoordinates().height + $('top_column').getCoordinates().height) > $('right_column').getCoordinates().height ) ? ($('left_column').getCoordinates().height + $('top_column').getCoordinates().height) : $('right_column').getCoordinates().height );
			});
			theitem.setProperty('title', 'form_item'+counter);
			if($chk($E('a.tooltiplink', theitem))){
				var Tips1 = new ChronoTips($E('a.tooltiplink', theitem), $E('div.tooltipdiv', theitem).getText(), {elementid:theitem.getProperty('title')});
			}
			//new Element('input', {'name':'slabel[]', 'type':'hidden', 'id':'slabel_'+theitem.getProperty('title'), 'value':''}).injectAfter($('uploadfields'));
			counter = counter + 1;
		});
		new Sortables($('left_column'), {
			handles: 'span.drag'			
		});
		
		//emails
		<?php if($row){ ?>
			<?php						
				$database =& JFactory::getDBO();
				$query = "SELECT * FROM #__chrono_contact_emails WHERE formid = '".$row->id."' ORDER BY emailid";
				$database->setQuery( $query );
				$emails = $database->loadObjectList();
				$emailscounter = 0;
			?>
			<?php for($iemail = 0; $iemail < count($emails); $iemail++){ ?>
			<?php
				$registry = new JRegistry();
				$registry->loadINI( $emails[$iemail]->params );
				$emailparams = $registry->toObject( );
				if($emailparams->editor == '1'){
			?>
			emailcounter = <?php echo count($emails); ?>;
			tinyMCE.execCommand('mceAddControl', false, 'editor_email_'+<?php echo $iemail; ?>);
				<?php } ?>
			<?php } ?>
		<?php } ?>
		$$('.cf_email').each(function(emailitem){
			if(($chk($E('input[name^=to_]', emailitem)) || $chk($E('input[name^=dto_]', emailitem))) && ($chk($E('input[name^=subject_]', emailitem)) || $chk($E('input[name^=dsubject_]', emailitem))) && ($chk($E('input[name^=fromname_]', emailitem)) || $chk($E('input[name^=dfromname_]', emailitem))) && ($chk($E('input[name^=fromemail_]', emailitem)) || $chk($E('input[name^=dfromemail_]', emailitem))) ){
				emailitem.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
			}
			emailitem.addEvent('click', function() {
				$$('div.cf_email').each(function(item){
					item.setProperty('id','');
					item.setStyles({'border':'1px #111 solid'});
				});
				this.setProperty('id','cf_email_active');
				this.setStyles({'border':'3px #111 solid'});
				ShowEmailProperties();
			});
		});
		$$('.form_item_email').each(function(formitem){
			formitem.addEvent('click', function() {
				$$('.form_item_email').each(function(item2){
					item2.setStyle('border', '0px solid #000');
					$E('.delete_icon_email', item2).setStyle('display', 'none');
				});
				this.setStyle('border', '0px solid #000');
				$E('.delete_icon_email', this).setStyle('display', 'none');
				this.effect('background-color', {wait: false, duration: 100}).start('ffffff','ffffff');
				this.setStyle('border', '1px solid #000');		
				$E('.delete_icon_email', this).setStyle('display', 'inline');
			});
		});
		$$('.delete_icon_email').each(function(deleteicon){
			deleteicon.addEvent('click', function(e) {
				//new Event(e).stop();
				droparea = this.getParent().getParent();
				this.getParent().remove();
				if(($chk($E('input[name^=to_]', droparea)) || $chk($E('input[name^=dto_]', droparea))) && ($chk($E('input[name^=subject_]', droparea)) || $chk($E('input[name^=dsubject_]', droparea))) && ($chk($E('input[name^=fromname_]', droparea)) || $chk($E('input[name^=dfromname_]', droparea))) && ($chk($E('input[name^=fromemail_]', droparea)) || $chk($E('input[name^=dfromemail_]', droparea))) ){
					droparea.effect('background-color', {wait: false, duration: 100}).start('CEFF63','CEFF63');
				}else{
					var email_params = $('params_'+droparea.getProperty('name')).value.split(',');
					$('params_'+droparea.getProperty('name')).value = email_params[0] + ',' + email_params[1] + ',' + '0';
					$('prop_cf_Email_enable').value = 0;
					$('prop_cf_Email_enable').disabled = true;
					droparea.effect('background-color', {wait: false, duration: 100}).start('FFAEA5','FFAEA5');
				}
			});
		});
	});
	
	function switchstep(stepid){
		if(stepid == '1'){
			$('formbuilder').setStyle('display', 'block');
			$('emailbuilder').setStyle('display', 'none');
			$('templatebuilder').setStyle('display', 'none');
			$('AfterFormSubmission').setStyle('display', 'none');
			$('step1image').setProperty('src', 'components/com_chronocontact/images/steps/step11.png');
			$('step2image').setProperty('src', 'components/com_chronocontact/images/steps/step22.png');
			$('step3image').setProperty('src', 'components/com_chronocontact/images/steps/step32.png');
			$('step4image').setProperty('src', 'components/com_chronocontact/images/steps/step42.png');
		}else if(stepid == '2'){
			$('formbuilder').setStyle('display', 'none');
			$('emailbuilder').setStyle('display', 'block');
			$('templatebuilder').setStyle('display', 'none');
			$('AfterFormSubmission').setStyle('display', 'none');
			$('step1image').setProperty('src', 'components/com_chronocontact/images/steps/step12.png');
			$('step2image').setProperty('src', 'components/com_chronocontact/images/steps/step21.png');
			$('step3image').setProperty('src', 'components/com_chronocontact/images/steps/step32.png');
			$('step4image').setProperty('src', 'components/com_chronocontact/images/steps/step42.png');
		}else if(stepid == '3'){
			$('formbuilder').setStyle('display', 'none');
			$('emailbuilder').setStyle('display', 'none');
			$('templatebuilder').setStyle('display', 'block');
			$('AfterFormSubmission').setStyle('display', 'none');
			$('step1image').setProperty('src', 'components/com_chronocontact/images/steps/step12.png');
			$('step2image').setProperty('src', 'components/com_chronocontact/images/steps/step22.png');
			$('step3image').setProperty('src', 'components/com_chronocontact/images/steps/step31.png');
			$('step4image').setProperty('src', 'components/com_chronocontact/images/steps/step42.png');
		}else if(stepid == '4'){
			$('formbuilder').setStyle('display', 'none');
			$('emailbuilder').setStyle('display', 'none');
			$('templatebuilder').setStyle('display', 'none');
			$('AfterFormSubmission').setStyle('display', 'block');
			$('step1image').setProperty('src', 'components/com_chronocontact/images/steps/step12.png');
			$('step2image').setProperty('src', 'components/com_chronocontact/images/steps/step22.png');
			$('step3image').setProperty('src', 'components/com_chronocontact/images/steps/step32.png');
			$('step4image').setProperty('src', 'components/com_chronocontact/images/steps/step41.png');
		}else{}
	}
	</script>
    <?php if($row){ ?>
    <?php JHTML::_('behavior.modal'); ?>
    <script type="text/javascript">
    window.addEvent('domready', function() {
		SqueezeBox.initialize();
		SqueezeBox.setContent('iframe', '');
		SqueezeBox.applyContent('<div style="color:#FF0000; padding:5px; font-size:12px;">Please note that any changes you made to the form HTML code in the Form edit page will be lost once you save new changes in the wizard!</div>', {x: 200, y: 100});
		SqueezeBox.resize({x: 500, y: 100}, true);
		//return false;
	});
    </script>
    <?php } ?>


<form action="index2.php" method="post" name="adminForm" onSubmit="return Checkform()">
	<div id="accordion">
    <table width="100%">
        <tr>
			<td><img src="components/com_chronocontact/images/steps/step11.png" border="0" width="167" height="50" id="step1image" onclick="switchstep(1)" /></td>
            <td><img src="components/com_chronocontact/images/steps/step22.png" border="0" width="167" height="50" id="step2image" onclick="switchstep(2)" /></td>
            <td><img src="components/com_chronocontact/images/steps/step32.png" border="0" width="167" height="50" id="step3image" onclick="switchstep(3)" /></td>
            <td><img src="components/com_chronocontact/images/steps/step42.png" border="0" width="167" height="50" id="step4image" onclick="switchstep(4)" /></td>
        </tr>
    </table>
	<!--<h3 class="toggler atStart">STEP 1 - Design your form</h3>-->
		<div class="element atStart" id="formbuilder">
			<div id="container">
			
			<!-- Top container added for issue #1 -->
			<div class="float_left width1" >
			<div id="top_column">
			
			<a href="#TB_inline&height=400&width=300&inlineId=temp_code&homeId=left_column" name="Form Preview" class="smoothbox"><img id="cf_formpreview" title="Form Preview :: Click to preview form" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/preview_f2.png" width="32" height="32"></a>
			<!--<a href="#TB_inline&height=400&width=300&inlineId=temp_code&homeId=left_column" name="HTML Source" class="smoothbox"><img id="cf_htmlsource" title="HTML Source :: Click to view current form HTML source code" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/html_f2.png" width="32" height="32"></a>-->
			<a href="#TB_inline&height=200&width=200&inlineId=save_form" name="Save Form" class="smoothbox"><img id="cf_saveform" title="Save Form :: Click to Save form" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/save_f2.png" width="32" height="32"></a>
				
				</div>
			<!--  end of addon -->
			
			
				<div id="left_column"><?php if($htmloutput){ echo $htmloutput; } ?></div>
			   
			   </div> 
				<div id="right_column">
					<div class="box_header">Toolbox</div>
					<div class="items">
						<div class="item"><span id="cf_text">Text</span></div>
						<div class="item"><span id="cf_heading">Heading</span></div>
						<div class="item"><span id="cf_textbox">TextBox</span></div>
						<div class="item"><span id="cf_password">PasswordBox</span></div>
						<div class="item"><span id="cf_textarea">TextArea</span></div>
						<div class="item"><span id="cf_dropdown">DropDown</span></div>
						<div class="item"><span id="cf_checkbox">CheckBox</span></div>
						<div class="item"><span id="cf_radiobutton">RadioButton</span></div>
						<div class="item"><span id="cf_datetimepicker">DateTimePicker</span></div>
						<div class="item"><span id="cf_fileupload">FileUpload</span></div>
						<div class="item"><span id="cf_hidden">HiddenField</span></div>
						<div class="item"><span id="cf_captcha">Captcha</span></div>
                        <div class="item"><span id="cf_placeholder">PlaceHolder</span></div>
                        <div class="item"><span id="cf_multiholder">MultiHolder</span></div>
						<div class="item"><span id="cf_button">Button</span></div>
					</div>
				
					<div id="Properties">
						<div class="box_header border-top">Properties</div>        
							<div class="box_text">
								<div id="prop_label" class="Propertiesitem" style="display:none ">
									<span>Text:</span> <input type="text" name="prop_label_text" id="prop_label_text" size="10" value="" /><hr />
									<input id="prop_label_done" type="button" name="prop_label_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_text" class="Propertiesitem" style="display:none ">
									<span>Text:</span> <input type="text" name="prop_cf_text_text" id="prop_cf_text_text" size="10" value="" /><hr />
									<input id="prop_cf_text_done" type="button" name="prop_cf_text_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_heading" class="Propertiesitem" style="display:none ">
									<span>Text:</span> <input type="text" name="prop_cf_heading_text" id="prop_cf_heading_text" size="10" value="" /><hr />
									<span>Size:</span> <select name="prop_cf_heading_size" id="prop_cf_heading_size" size="1" class="select1">
									<option value="H1" selected="selected">H1</option>
									<option value="H2">H2</option>
									<option value="H3">H3</option>
									<option value="H4">H4</option>
									<option value="H5">H5</option>
									<option value="H6">H6</option>
									</select>
									<hr />
									<input id="prop_cf_heading_done" type="button" name="prop_cf_heading_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_textbox" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_textbox_label" id="prop_cf_textbox_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_textbox_slabel" id="prop_cf_textbox_slabel" size="10" value="" /><hr />
									<span>Size:</span> <input type="text" name="prop_cf_textbox_size" id="prop_cf_textbox_size" size="5" value="20">
									<hr />
									<span>Max Size:</span> <input type="text" name="prop_cf_textbox_max" id="prop_cf_textbox_max" size="5" value="100"><hr />
									<span class="span1">Validation:</span> 
									<div class="float_left"> 
									<input type="checkbox" name="validation_required" id="validation_required" value="required"><label for="validation_required">Required</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_number" id="validation_number" value="validate-number"><label for="validation_number">Numbers Only</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_digits" id="validation_digits" value="validate-digits"><label for="validation_digits">Digits Only</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_alpha" id="validation_alpha" value="validate-alpha"><label for="validation_alpha">Alphas Only</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_alphanum" id="validation_alphanum" value="validate-alphanum"><label for="validation_alphanum">Alphas/Nums Only</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_date" id="validation_date" value="validate-date"><label for="validation_date">Date</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_email" id="validation_email" value="validate-email"><label for="validation_email">Email</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_url" id="validation_url" value="validate-url"><label for="validation_url">URL</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_date-au" id="validation_date-au" value="validate-date-au"><label for="validation_date-au">Date (AU)</label><div class="clear">&nbsp;</div> 
									<input type="checkbox" name="validation_currency-dollar" id="validation_currency-dollar" value="validate-currency-dollar"><label for="validation_currency-dollar">Currency-Dollars</label><div class="clear">&nbsp;</div> 
									</div>
									<hr />
                                    <span>Validation Message:</span> <input name="prop_cf_textbox_title" type="text" id="prop_cf_textbox_title" value="" size="10" />
									<hr />
									<span>Tooltip:</span> <input name="prop_cf_textbox_description" type="text" id="prop_cf_textbox_description" value="" size="10" />
									<hr />
                                    <span>Hide Label:</span> <input name="prop_cf_textbox_hide_label" type="checkbox" id="prop_cf_textbox_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_textbox_label_width" type="text" id="prop_cf_textbox_label_width" value="" size="5" />px
									<hr />
                                    <span>Field Name:</span> <input name="prop_cf_textbox_field_name" type="text" id="prop_cf_textbox_field_name" value="" size="10" />
									<hr />
									<input id="prop_cf_textbox_done" type="button" name="prop_cf_textbox_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_password" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_password_label" id="prop_cf_password_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_password_slabel" id="prop_cf_password_slabel" size="10" value="" /><hr />
									<span>Size:</span> <input type="text" name="prop_cf_password_size" id="prop_cf_password_size" size="5" value="20">
									<hr />
									<span>Max Size:</span> <input type="text" name="prop_cf_password_max" id="prop_cf_password_max" size="5" value="100"><hr />
									<span>Validation:</span> 
									<div class="float_left"> 
									<input type="checkbox" name="validation_required" id="validation_required" value="required"><label for="validation_required">Required</label><div class="clear">&nbsp;</div> 
									</div>
									<hr />
                                    <span>Validation Message:</span> <input name="prop_cf_password_title" type="text" id="prop_cf_password_title" value="" size="10" />
									<hr />
									<span>Tooltip:</span> <input name="prop_cf_password_description" type="text" id="prop_cf_password_description" value="" size="10" />
									<hr />
                                    <span>Hide Label:</span> <input name="prop_cf_password_hide_label" type="checkbox" id="prop_cf_password_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_password_label_width" type="text" id="prop_cf_password_label_width" value="" size="5" />px
									<hr />
                                    <span>Field Name:</span> <input name="prop_cf_password_field_name" type="text" id="prop_cf_password_field_name" value="" size="10" />
									<hr />
									<input id="prop_cf_password_done" type="button" name="prop_cf_password_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_dropdown" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_dropdown_label" id="prop_cf_dropdown_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_dropdown_slabel" id="prop_cf_dropdown_slabel" size="10" value="" /><hr />
									<span class="span1">Validation:</span> 
									<div class="float_left"> 
									<input type="checkbox" name="validation_selection" id="validation_selection" value="validate-selection"><label for="validation_selection">Selection Required (DropDown)</label><div class="clear">&nbsp;</div> 
									</div><hr />
                                    <span>Validation Message:</span> <input name="prop_cf_dropdown_title" type="text" id="prop_cf_dropdown_title" value="" size="10" />
									<hr />
									<span>Size:</span> <input type="text" name="prop_cf_dropdown_size" id="prop_cf_dropdown_size" size="5" value="1">
									<hr />
									<span>Options:</span> <textarea name="prop_cf_dropdown_options" id="prop_cf_dropdown_options" rows="4" cols="20"></textarea>
									<hr />
									<span>Tooltip:</span> <input name="prop_cf_dropdown_description" type="text" id="prop_cf_dropdown_description" value="" size="10" />
									<hr />
                                    <span>Hide Label:</span> <input name="prop_cf_dropdown_hide_label" type="checkbox" id="prop_cf_dropdown_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_dropdown_label_width" type="text" id="prop_cf_dropdown_label_width" value="" size="5" />px
									<hr />
                                    <span>Field Name:</span> <input name="prop_cf_dropdown_field_name" type="text" id="prop_cf_dropdown_field_name" value="" size="10" />
									<hr />
									<input id="prop_cf_dropdown_done" type="button" name="prop_cf_dropdown_done" value="Apply" class="cf_button1" />
								</div>	
								<div id="prop_cf_textarea" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_textarea_label" id="prop_cf_textarea_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_textarea_slabel" id="prop_cf_textarea_slabel" size="10" value="" /><hr />
									<span>Rows:</span> <input type="text" name="prop_cf_textarea_rows" id="prop_cf_textarea_rows" size="5" value="3">
									<hr />
									<span>Columns:</span> <input type="text" name="prop_cf_textarea_cols" id="prop_cf_textarea_cols" size="5" value="30">
									<hr />
									<span >Validation:</span> 
									<div class="float_left"> 
									<input type="checkbox" name="validation_required" id="validation_required" value="required"><label for="validation_required">Required</label><div class="clear">&nbsp;</div> 
									</div>
									<hr />
                                    <span>Validation Message:</span> <input name="prop_cf_textarea_title" type="text" id="prop_cf_textarea_title" value="" size="10" />
									<hr />
									<span>Tooltip:</span> <input name="prop_cf_textarea_description" type="text" id="prop_cf_textarea_description" value="" size="10" />
									<hr />
                                    <span>Hide Label:</span> <input name="prop_cf_textarea_hide_label" type="checkbox" id="prop_cf_textarea_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_textarea_label_width" type="text" id="prop_cf_textarea_label_width" value="" size="5" />px
									<hr />
                                    <span>Field Name:</span> <input name="prop_cf_textarea_field_name" type="text" id="prop_cf_textarea_field_name" value="" size="10" />
									<hr />
									<input id="prop_cf_textarea_done" type="button" name="prop_cf_textarea_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_checkbox" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_checkbox_label" id="prop_cf_checkbox_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_checkbox_slabel" id="prop_cf_checkbox_slabel" size="10" value="" /><hr />
									<span class="span1">Validation:</span> 
									<div class="float_left"> 
									<input type="checkbox" name="validation_one-required" id="validation_one-required" value="validate-one-required"><label for="validation_one-required">One Required (Checkbox/Radio)</label><div class="clear">&nbsp;</div> 
									</div><hr />
                                    <span>Validation Message:</span> <input name="prop_cf_checkbox_title" type="text" id="prop_cf_checkbox_title" value="" size="10" />
									<hr />
									<span>Options:</span> <textarea name="prop_cf_checkbox_options" id="prop_cf_checkbox_options" rows="4" cols="20"></textarea>
									<hr />
									<span>Tooltip:</span> <input name="prop_cf_checkbox_description" type="text" id="prop_cf_checkbox_description" value="" size="10" />
									<hr />
                                    <span>Hide Label:</span> <input name="prop_cf_checkbox_hide_label" type="checkbox" id="prop_cf_checkbox_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_checkbox_label_width" type="text" id="prop_cf_checkbox_label_width" value="" size="5" />px
									<hr />
                                    
									<input id="prop_cf_checkbox_done" type="button" name="prop_cf_checkbox_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_radiobutton" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_radiobutton_label" id="prop_cf_radiobutton_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_radiobutton_slabel" id="prop_cf_radiobutton_slabel" size="10" value="" /><hr />
									<span class="span1">Validation:</span> 
									<div class="float_left"> 
									<input type="checkbox" name="validation_one-required" id="validation_one-required" value="validate-one-required"><label for="validation_one-required">One Required (Checkbox/Radio)</label><div class="clear">&nbsp;</div> 
									</div><hr />
                                    <span>Validation Message:</span> <input name="prop_cf_radiobutton_title" type="text" id="prop_cf_radiobutton_title" value="" size="10" />
									<hr />
									<span>Options:</span> <textarea name="prop_cf_radiobutton_options" id="prop_cf_radiobutton_options" rows="4" cols="20"></textarea>
									<hr />
									<span>Tooltip:</span> <input name="prop_cf_radiobutton_description" type="text" id="prop_cf_radiobutton_description" value="" size="10" />
									<hr />
                                    <span>Hide Label:</span> <input name="prop_cf_radiobutton_hide_label" type="checkbox" id="prop_cf_radiobutton_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_radiobutton_label_width" type="text" id="prop_cf_radiobutton_label_width" value="" size="5" />px
									<hr />
                                    
									<input id="prop_cf_radiobutton_done" type="button" name="prop_cf_radiobutton_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_button" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_button_text" id="prop_cf_button_text" size="10" value="" /><hr />
									<span>Add Reset:</span> <select name="prop_cf_button_reset" id="prop_cf_button_reset" size="1" class="select1"><option value="0" selected="selected">no</option><option value="1">yes</option></select><hr />
									<span>Tooltip:</span> <input name="prop_cf_button_description" type="text" id="prop_cf_button_description" value="" size="10" />
									<hr />
									<input id="prop_cf_button_done" type="button" name="prop_cf_button_done" value="Apply" class="cf_button1" />
								</div>			
								<div id="prop_cf_fileupload" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_fileupload_label" id="prop_cf_fileupload_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_fileupload_slabel" id="prop_cf_fileupload_slabel" size="10" value="" /><hr />
									<span>Tooltip:</span> <input name="prop_cf_fileupload_description" type="text" id="prop_cf_fileupload_description" value="" size="10" />
									<hr />
									<span>Allowed Extensions:</span> <input name="prop_cf_fileupload_extensions" type="text" id="prop_cf_fileupload_extensions" title="Allowed Extensions :: Add here the extensions which will be allowed by this field separated with | e.g.: jpg|gif|pdf , please note that if you didn't add any extensions here then no files will be allowed to upload!" value="" size="10" />
									<hr />
									<span>Maximum File Size in KB:</span> <input name="prop_cf_fileupload_maxsize" type="text" id="prop_cf_fileupload_maxsize" value="" size="10" />
									<hr />
									<span>Minimum File Size in KB:</span> <input name="prop_cf_fileupload_minsize" type="text" id="prop_cf_fileupload_minsize" value="" size="10" />
									<hr />
                                    <span >Validation:</span>
									<div class="float_left"> 
									<input type="checkbox" name="validation_required" id="validation_required" value="required"><label for="validation_required">Required</label><div class="clear">&nbsp;</div> 
									</div>
									<hr />
                                    <span>Validation Message:</span> <input name="prop_cf_fileupload_title" type="text" id="prop_cf_fileupload_title" value="" size="10" />
									<hr />
                                    <span>Hide Label:</span> <input name="prop_cf_fileupload_hide_label" type="checkbox" id="prop_cf_fileupload_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_fileupload_label_width" type="text" id="prop_cf_fileupload_label_width" value="" size="5" />px
									<hr />
                                    <span>Field Name:</span> <input name="prop_cf_fileupload_field_name" type="text" id="prop_cf_fileupload_field_name" value="" size="10" />
									<hr />
									<input id="prop_cf_fileupload_done" type="button" name="prop_cf_fileupload_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_datetimepicker" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_datetimepicker_label" id="prop_cf_datetimepicker_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_datetimepicker_slabel" id="prop_cf_datetimepicker_slabel" size="10" value="" /><hr />
									<span>Size:</span> <input type="text" name="prop_cf_datetimepicker_size" id="prop_cf_datetimepicker_size" size="5" value="20">
									<hr />
									<span >Validation:</span>
									<div class="float_left"> 
									<input type="checkbox" name="validation_required" id="validation_required" value="required"><label for="validation_required">Required</label><div class="clear">&nbsp;</div> 
									</div>
									<hr />
                                    <span>Validation Message:</span> <input name="prop_cf_datetimepicker_title" type="text" id="prop_cf_datetimepicker_title" value="" size="10" />
									<hr />
									<span>Tooltip:</span> <input name="prop_cf_datetimepicker_description" type="text" id="prop_cf_datetimepicker_description" value="" size="10" />
									<hr />                                    
                                    <span>Hide Label:</span> <input name="prop_cf_datetimepicker_hide_label" type="checkbox" id="prop_cf_datetimepicker_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_datetimepicker_label_width" type="text" id="prop_cf_datetimepicker_label_width" value="" size="5" />px
									<hr />
                                    <span>Field Name:</span> <input name="prop_cf_datetimepicker_field_name" type="text" id="prop_cf_datetimepicker_field_name" value="" size="10" />
									<hr />
									<input id="prop_cf_datetimepicker_done" type="button" name="prop_cf_datetimepicker_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_captcha" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_captcha_label" id="prop_cf_captcha_label" size="10" value="" /><hr />
									<span>Tooltip:</span> <input name="prop_cf_captcha_description" type="text" id="prop_cf_captcha_description" value="" size="10" />
                                    <hr />
                                    <span>Hide Label:</span> <input name="prop_cf_captcha_hide_label" type="checkbox" id="prop_cf_captcha_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_captcha_label_width" type="text" id="prop_cf_captcha_label_width" value="" size="5" />px
									<hr />
									<input id="prop_cf_captcha_done" type="button" name="prop_cf_captcha_done" value="Apply" class="cf_button1" />
								</div>
								<div id="prop_cf_hidden" class="Propertiesitem" style="display:none ">
									<span>Name:</span> <input name="prop_cf_hidden_name" type="text" id="prop_cf_hidden_name" value="" size="10" />
									<hr />
									<span>Value:</span> <input name="prop_cf_hidden_value" type="text" id="prop_cf_hidden_value" value="" size="10" />
									<hr />
									<input id="prop_cf_hidden_done" type="button" name="prop_cf_hidden_done" value="Apply" class="cf_button1" />
								</div>
                                <div id="prop_cf_placeholder" class="Propertiesitem" style="display:none ">
									<span>Value:</span> <input name="prop_cf_placeholder_value" type="text" id="prop_cf_placeholder_value" value="" size="10" />
									<hr />
									<input id="prop_cf_placeholder_done" type="button" name="prop_cf_placeholder_done" value="Apply" class="cf_button1" />
								</div>
                                <div id="prop_cf_multiholder" class="Propertiesitem" style="display:none ">
									<span>Label:</span> <input type="text" name="prop_cf_multiholder_label" id="prop_cf_multiholder_label" size="10" value="" /><hr />
                                    <span>Small Label:</span> <input type="text" name="prop_cf_multiholder_slabel" id="prop_cf_multiholder_slabel" size="10" value="" /><hr />									
									<span>Elements:</span> <input name="prop_cf_multiholder_options" id="prop_cf_multiholder_options" title="Elements Orders :: place here the orders of the elements to show with commas, like 1,2,3" value="" size="10" type="text" />
									<hr />
                                    <span>Hide Label:</span> <input name="prop_cf_multiholder_hide_label" type="checkbox" id="prop_cf_multiholder_hide_label" value="" />
									<hr />
                                    <span>Label Width:</span> <input name="prop_cf_multiholder_label_width" type="text" id="prop_cf_multiholder_label_width" value="" size="5" />px
									<hr />
									<input id="prop_cf_multiholder_done" type="button" name="prop_cf_multiholder_done" value="Apply" class="cf_button1" />
								</div>	
							<div class="clear"></div>
						</div>
					</div>	
				</div>
			
			</div>
			
			<div id="temp_code"></div>
			<div style="display:none; text-align:center " id="save_form">
				<strong>Choose a title for your form:</strong><br><br>
				<input type="text" name="form_title" value="<?php if($row){ ?><?php echo $row->name; ?><?php } ?>" id="form_title" maxlength="20">
				<br><br>
				<input type="button" value="Save" onClick="Checkform()">
			</div>
		</div>
		<!--<h3 class="toggler atStart">STEP 2 - Choose Email(s) Settings</h3>-->
		<div class="element atStart" id="emailbuilder" style="display:none;">
			<div id="container">				
				<div class="float_left width1" >
					<div id="top_column2">				
					<a href="#" onClick="addEmail();return false;"><img id="cf_newemail" title="New Email :: Click to insert a new Email container" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/get_msgs_f2.png" width="32" height="32"></a>
					<a href="#" onClick="deletemail();return false;"><img id="cf_delemail" title="Delete Email :: Choose an email from below then click to delete it" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/trash.png" width="32" height="32"></a>
					<a href="#TB_inline&height=200&width=200&inlineId=save_form" name="Save Form" class="smoothbox"><img id="cf_saveform2" title="Save Form :: Click to Save form" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/save_f2.png" width="32" height="32"></a>
					</div>
					<div id="left_column2"><div id="logdiv" style="color:#FF0000; text-align:center ">Click Add Email to add new Email</div>
                    <?php if($row){ ?>
						<?php						
                            $database =& JFactory::getDBO();
                            $query = "SELECT * FROM #__chrono_contact_emails WHERE formid = '".$row->id."' ORDER BY emailid";
                            $database->setQuery( $query );
                            $emails = $database->loadObjectList();
                            $emailscounter = 0;
							$elementcounter = 0;
                        ?>
                        <?php foreach($emails as $email){ ?>
                            <div class="cf_email" id="email_<?php echo $emailscounter; ?>" name="email_<?php echo $emailscounter; ?>" style="border: 1px solid rgb(17, 17, 17); padding: 15px; width: 500px; background-color: rgb(255, 174, 165); min-height: 75px; margin-top: 15px;">
                                <?php if($email->to){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">To</label>
                                        <input type="text" name="to_<?php echo $elementcounter; ?>" id="to_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->to; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->dto){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">Dynamic To</label>
                                        <input type="text" name="dto_<?php echo $elementcounter; ?>" id="dto_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->dto; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->subject){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">Subject</label>
                                        <input type="text" name="subject_<?php echo $elementcounter; ?>" id="subject_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->subject; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->dsubject){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">Dynamic Subject</label>
                                        <input type="text" name="dsubject_<?php echo $elementcounter; ?>" id="dsubject_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->dsubject; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->cc){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">CC</label>
                                        <input type="text" name="cc_<?php echo $elementcounter; ?>" id="cc_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->cc; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->dcc){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">Dynamic CC</label>
                                        <input type="text" name="dcc_<?php echo $elementcounter; ?>" id="dcc_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->dcc; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->bcc){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">BCC</label>
                                        <input type="text" name="bcc_<?php echo $elementcounter; ?>" id="bcc_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->bcc; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->dbcc){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">Dynamic BCC</label>
                                        <input type="text" name="dbcc_<?php echo $elementcounter; ?>" id="dbcc_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->dbcc; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->fromname){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">Fromname</label>
                                        <input type="text" name="fromname_<?php echo $elementcounter; ?>" id="fromname_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->fromname; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->dfromname){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">Dynamic Fromname</label>
                                        <input type="text" name="dfromname_<?php echo $elementcounter; ?>" id="dfromname_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->dfromname; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->fromemail){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">FromEmail</label>
                                        <input type="text" name="fromemail_<?php echo $elementcounter; ?>" id="fromemail_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->fromemail; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                <?php if($email->dfromemail){ ?>
                                <div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
                                    <div class="form_element cf_textbox">
                                        <label class="cf_label">Dynamic FromEmail</label>
                                        <input type="text" name="dfromemail_<?php echo $elementcounter; ?>" id="dfromemail_<?php echo $elementcounter; ?>" size="30" maxlength="150" value="<?php echo $email->dfromemail; ?>" class="cf_inputbox"/>
                                    </div>
                                    <div class="delete_icon_email" style="display: none;">
                                        <img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
                                    </div>
                                    <div class="clear"> </div>
                                </div>
                                <?php $elementcounter++; ?>
                                <?php } ?>
                                
                                <?php if($email->replytoname){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">ReplyTo name</label>
									<input type="text" name="replytoname_<?php echo $emailscounter; ?>" id="replytoname_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->replytoname; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon_email" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dreplytoname){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic ReplyTo name</label>
									<input type="text" name="dreplytoname_<?php echo $emailscounter; ?>" id="dreplytoname_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dreplytoname; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon_email" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->replytoemail){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">ReplyTo Email</label>
									<input type="text" name="replytoemail_<?php echo $emailscounter; ?>" id="replytoemail_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->replytoemail; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon_email" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
							<?php if($email->dreplytoemail){ ?>
							<div class="form_item_email" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
								<div class="form_element cf_textbox">
									<label class="cf_label">Dynamic ReplyTo Email</label>
									<input type="text" name="dreplytoemail_<?php echo $emailscounter; ?>" id="dreplytoemail_<?php echo $emailscounter; ?>" size="30" maxlength="150" value="<?php echo $email->dreplytoemail; ?>" class="cf_inputbox"/>
								</div>
								<div class="delete_icon_email" style="display: none;">
									<img height="15" width="15" alt="delete" src="<?php echo JURI::Base(); ?>components/com_chronocontact/css/images/icon_delete.gif"/>
								</div>
								<div class="clear"> </div>
							</div>
							<?php } ?>
                                
                                <div class="clear"> </div>
                            </div>
                        <?php $elementcounter++; ?>	
                        <?php $emailscounter++; ?>
                        <?php } ?>
                    <?php } ?>
                    
                    </div>				   
				</div> 
				<div id="right_column2">
					<div class="box_header">Toolbox</div>
					<div class="items">
						<div class="emailitem"><span id="cf_to" title="To :: The To Email Address(es), if more than one, separate with comma , although you can add many of this">To</span></div>
						<div class="emailitem"><span id="cf_dto" title="Dynamic To :: This will hold a field name which will contain the To Email address, the wizard will let you pick one of the fields you already created in step 1">Dynamic To</span></div>
						<div class="emailitem"><span id="cf_subject" title="Subject :: The Email Subject Text">Subject</span></div>
						<div class="emailitem"><span id="cf_dsubject" title="Dynamic Subject :: This will hold a field name which will contain the Email Subject, the wizard will let you pick one of the fields you already created in step 1">Dynamic Subject</span></div>
						<div class="emailitem"><span id="cf_cc" title="CC :: The CC Email Address(es), if more than one, separate with comma , although you can add many of this">CC</span></div>
						<div class="emailitem"><span id="cf_dcc" title="Dynamic CC :: This will hold a field name which will contain the CC Email address, the wizard will let you pick one of the fields you already created in step 1">Dynamic CC</span></div>
						<div class="emailitem"><span id="cf_bcc" title="BCC :: The BCC Email Address(es), if more than one, separate with comma , although you can add many of this">BCC</span></div>
						<div class="emailitem"><span id="cf_dbcc" title="Dynamic BCC :: This will hold a field name which will contain the BCC Email address, the wizard will let you pick one of the fields you already created in step 1">Dynamic BCC</span></div>
						<div class="emailitem"><span id="cf_fromname" title="From Name :: The Email From Name, e.g. Admin">From Name</span></div>
						<div class="emailitem"><span id="cf_dfromname" title="Dynamic From Name :: This will hold a field name which will contain The Email From Name, the wizard will let you pick one of the fields you already created in step 1">Dynamic From Name</span></div>
						<div class="emailitem"><span id="cf_fromemail" title="From Email :: The Email From Email, e.g. Admin@Admin.com">From Email</span></div>
						<div class="emailitem"><span id="cf_dfromemail" title="Dynamic From Email :: This will hold a field name which will contain The Email From Email, the wizard will let you pick one of the fields you already created in step 1">Dynamic From Email</span></div>
						<div class="emailitem"><span id="cf_replytoname" title="ReplyTo Name :: The Replyto name, e.g. Admin">ReplyTo Name</span></div>
						<div class="emailitem"><span id="cf_dreplytoname" title="Dynamic ReplyTo Name :: This will hold a field name which will contain The Email ReplyTo Name, the wizard will let you pick one of the fields you already created in step 1">Dynamic ReplyTo Name</span></div>
						<div class="emailitem"><span id="cf_replytoemail" title="ReplyTo Email :: The Email ReplyTo Email, e.g. Admin@Admin.com">ReplyTo Email</span></div>
						<div class="emailitem"><span id="cf_dreplytoemail" title="Dynamic ReplyTo Email :: This will hold a field name which will contain The Email ReplyTo Email, the wizard will let you pick one of the fields you already created in step 1">Dynamic ReplyTo Email</span></div>
                    </div>
					<div id="Properties2">
						<div class="box_header border-top">Email Properties</div>        
                        <div class="box_text">
                            <div id="prop_cf_Email" class="Propertiesitem" style="display:none ">
                                <span>Email Format:</span> <select name="prop_cf_Email_format" id="prop_cf_Email_format" size="1" class="select1"><option value="html" selected="selected">HTML</option><option value="text">Plain Text</option></select><hr />
                                <span>Record IP:</span> <select name="prop_cf_Email_IP" id="prop_cf_Email_IP" size="1" class="select1"><option value="1" selected="selected">Yes</option><option value="0">No</option></select><hr />
                                <span>Enabled? :</span> <select name="prop_cf_Email_enable" id="prop_cf_Email_enable" size="1" class="select1"><option value="1" selected="selected">Yes</option><option value="0">No</option></select><hr />
                                <span>Use Template Editor:</span> <select name="prop_cf_Email_editor" id="prop_cf_Email_editor" size="1" class="select1"><option value="1" selected="selected">Yes</option><option value="0">No</option></select><hr />
                                <span>Enable Attachments:</span> <select name="prop_cf_Email_enable_attachments" id="prop_cf_Email_enable_attachments" size="1" class="select1"><option value="1" selected="selected">Yes</option><option value="0">No</option></select><hr />
                                <input id="prop_cf_Email_done" type="button" name="prop_cf_Email_done" value="Apply" class="cf_button1" />
                            </div>
                            <div class="clear"></div>
                        </div>	
					</div>
				</div>
				
								
			</div>
			<div id="temp_code2"></div>
		</div>
		<!--<h3 class="toggler atStart">STEP 3 - Design your Email(s)</h3>-->
		<div class="element atStart" id="templatebuilder" style="display:none;">
			<div id="container">				
				<div class="float_left width1" >
					<div id="top_column3">
						<a href="#TB_inline&height=200&width=200&inlineId=save_form" name="Save Form" class="smoothbox"><img id="cf_saveform3" title="Save Form :: Click to Save form" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/save_f2.png" width="32" height="32"></a>
						<!--<a href="#TB_inline&height=200&width=200&inlineId=temp_code2&homeId=left_column&sourceId=addfield_editor_temp&ieBookmark=" name="Add Field" class="smoothbox"><img id="cf_insertfieldname" title="Add Field :: Choose some field to insert its value at the choosed position in the Email template" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/note_f2.png" width="32" height="32"></a>-->
						<a href="#" onClick="ShowAddField();" name="Add Field"><img id="cf_insertfieldname" title="Add Field :: Choose some field to insert its value at the choosed position in the Email template" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/note_f2.png" width="32" height="32"></a>
						
					</div>
					<div id="left_column3" style="display:block; ">
					<div id="logdiv2" style="color:#FF0000; text-align:center ">If you left your Email template empty, a template will be automaticly generated similar to your form layout!</div>
						<?php if($row){ ?>
							<?php $emailscounter = 0; ?>
                            <?php foreach($emails as $email){ ?>
								<?php
                                    $registry = new JRegistry();
                                    $registry->loadINI( $email->params );
                                    $emailparams = $registry->toObject( );
                                    $params = $emailparams->recordip.','.$emailparams->emailtype.','.$emailparams->enabled.','.$emailparams->editor;
                                ?>
                                    <div id="before_editor_email_<?php echo $emailscounter; ?>"><span style="font-weight: bold; font-size: 12px;">Email Template</span></div>
                                    <textarea class="<?php if($emailparams->editor == '1'){ ?>2mce_editable<?php } ?>" id="editor_email_<?php echo $emailscounter; ?>" name="editor_email_<?php echo $emailscounter; ?>" rows="20" cols="75" style="width:90%; height:350px; "><?php echo $email->template; ?></textarea>
                                    <input type="hidden" id="params_email_<?php echo $emailscounter; ?>" value="<?php echo $params; ?>" name="params_email_<?php echo $emailscounter; ?>">
                                    <div id="after_editor_email_<?php echo $emailscounter; ?>">
                                    <input type="hidden" name="emailsids[]" value="<?php echo $email->emailid; ?>" />
                                    <br/><br/></div>
                                <?php $emailscounter++; ?>	
                            <?php } ?>
                        <?php } ?>
                        <div id="tempeditor" style="display:none; ">
							<?php
							//$editor		=& JFactory::getEditor();
							//echo $editor->display( 'tempemaileditor',  $row->text , '100%', '350', '75', '20', false ) ;
							?>
						</div>
					</div>				   
				</div> 
				<div id="right_column3">
					
				</div>
			</div>
			<div id="temp_code3"></div>
		</div>
		<!--<h3 class="toggler atStart">STEP 4 - After Form Submission</h3>-->
		<div class="element atStart" id="AfterFormSubmission" style="display:none;">
			<div id="container">				
				<div class="float_left width1" >
					<div id="top_column4">
						<a href="#TB_inline&height=200&width=200&inlineId=save_form" name="Save Form" class="smoothbox"><img id="cf_saveform4" title="Save Form :: Click to Save form" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/save_f2.png" width="32" height="32"></a>
						<a href="#" onClick="ShowAddField2();" name="Add Field"><img id="cf_insertfieldname2" title="Add Field :: Choose some field to insert its value at the choosed position in the after submit text template" border="0" src="<?php echo JURI::Base().'components/com_chronocontact/css/'; ?>images/note_f2.png" width="32" height="32"></a>
						
					</div>
					<div id="left_column4">
						<div class="form_item"><div class="form_element cf_textbox"><label class="cf_label">Redirect URL</label><input type="text" name="redirecturl" id="redirecturl" value="<?php if($row){ echo $row->redirecturl; } ?>" size="70" class="cf_inputbox"/><a class="tooltiplink" id="redirecturltip" title="Redirect URL :: This is where the form will go after its submitted, you can add a link to one of your content pages or even a link to anywhere!" onclick="return false;"><img height="16" border="0" width="16" class="tooltipimg" src="components/com_chronocontact/css/images/tooltip.png" style="border: 0px solid rgb(255, 255, 255); margin: 0px 0px 0px 10px; display: inline;"/></a></div><div class="clear"> </div></div>
						<div class="form_item"><div class="form_element cf_textbox"><label class="cf_label">After Submit Text</label><textarea id="onsubmitcode" name="onsubmitcode" rows="15" class="mce_editable" cols="50"><?php if($row){ echo $row->onsubmitcode; } ?></textarea><a class="tooltiplink" id="submittexttip" title="After Submit Text :: This is what will be viewed on the page after form submission, you can write here something like : Thank you Mr.{firstname} {lastname}, {firstname} will be replaced with the firstname field data, use the Add Field button to do this!" onclick="return false;"><img height="16" border="0" width="16" class="tooltipimg" src="components/com_chronocontact/css/images/tooltip.png" style="border: 0px solid rgb(255, 255, 255); margin: 0px 0px 0px 10px; display: inline;"/></a></div><div class="clear"> </div></div>
						<a href="javascript:;" onmousedown="tinyMCE.get('onsubmitcode').show();">[Editor]</a>
						<a href="javascript:;" onmousedown="tinyMCE.get('onsubmitcode').hide();">[No Editor]</a>
					</div>				   
				</div> 
				<div id="right_column4">
					
				</div>
			</div>
			<div id="temp_code4"></div>
		</div>
	</div>
    <?php
	if($row){
		$paramsvalues = new JParameter($row->paramsall);
		if ( is_array($paramsvalues->get('uploadfields')) ) {
		  $paramsvalues->set('uploadfields', implode('|', $paramsvalues->get('uploadfields')));
		}
	}
	?>
    <input type="hidden" name="formid" value="<?php if($row){ ?><?php echo $row->id; ?><?php } ?>" />
    <?php if($row){ ?>
    <?php 
	$paramsall = array();
	$paramsall = explode("\n", $row->paramsall);
	foreach($paramsall as $params){
			$param = array();
			$param = explode("=", $params);
			?>
			<input type="hidden" name="params[<?php echo trim($param[0]); ?>]" id="params[<?php echo trim($param[0]); ?>]" value="<?php echo $paramsvalues->get($param[0]); ?>">
			<?php } ?>
	<?php } ?>
	<input type="hidden" name="form_title_temp" id="form_title_temp" value="">
	<input type="hidden" name="uploadfields" id="uploadfields" value="<?php if($row){ echo $paramsvalues->get('uploadfields'); } ?>">
	<input type="hidden" value="" class="inputbox" id="fieldsnames" name="fieldsnames">
	<input type="hidden" value="" class="inputbox" id="fieldstypes" name="fieldstypes">
    <input type="hidden" value="" class="inputbox" id="emailslist" name="emailslist">
    <input type="hidden" value="" class="inputbox" id="datefieldsnames" name="datefieldsnames">
	<textarea name="form_code_temp" id="form_code_temp" style="display:none; "></textarea>
    <textarea name="chronocode" id="chronocode" style="display:none; "></textarea>
	<textarea name="emails_temp" id="emails_temp" style="display:none; "></textarea>
	<input type="hidden" name="task" value="save_form_wizard">
	<input type="hidden" name="option" value="<?php echo 'com_chronocontact'; ?>">
	</form>

		<?php	
		echo JHTML::_('behavior.keepalive');
	}
	
	
	function transformChronoContact( $row, $option ){
	global $mainframe;
	?>
    <script type="text/javascript">
    function previewform(){
		$('cftask').value = 'previewajax';
		$('adminForm').send({
			onRequest: function(){
				
			},
			onComplete: function(){
				OpenAddWin(this.response.text);
				//$('previewdiv').innerHTML = this.response.text;
			},
			onFailure: function(){
				
			}
		});
	}
	function OpenAddWin(){
		var AddWin;
		if(document.getElementById('themevalue').value == ''){
			alert('Sorry but you must select a theme from the list first');
			return false;
		}
		AddWin = window.open('index.php?option=com_chronocontact&task=previewajax&format=row&formid=<?php echo $row->id; ?>&theme='+document.getElementById('themevalue').value,'AddWindow','menubar=no,resizable=no,scrollbars=yes,status=no,top=100,left=100,width=550,height=500');
		//AddWin.document.write(data);
		if (!AddWin.opener){
			AddWin.focus();
		}else{
			AddWin.focus();
		}
	}
	function saveform(){
		if(document.getElementById('themevalue').value == ''){
			alert('Sorry but you must select a theme from the list first');
			return false;
		}else{
			return true;
		}
		//$('cftask').value = 'savetransform';
		///document.adminForm.submit();
	}
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == "cancel") {
			submitform( pressbutton );
			return;
		}else{
			// do field validation
			if(document.getElementById('themevalue').value == ''){
				alert('Sorry but you must select a theme from the list first');
			} else {
				//Checkform();
				submitform( pressbutton );
			}
		}
	}
    </script>
    <?php JHTML::_('behavior.modal'); ?>
    <form action="index2.php" method="post" name="adminForm" id="adminForm">
    	<table width="100%">
        	<tr>
                <td>
                	<strong>Select Which theme you would like your form to be converted to, Please note that if you used the "preview" option ONLY then this will not affect your form, however, <font style="color:#FF0000">if 
                    you used the "Transform & Save" then your form code will be completely overwritten and you will lose any code changes you made earlier to the HTML code box contents</font> since you created the form in the "form wizard" and before you come here!</strong>
                </td>
            </tr>
            <tr>
            	<td>
                <table width="100%">
                <tr>
                <?php
				$directory = JPATH_SITE.'/administrator/components/com_chronocontact/themes/';
				$results = array();
				$handler = opendir($directory);
				while ($file = readdir($handler)) {
					if ( $file != '.' && $file != '..')
						$results[] = $file;
				}
				closedir($handler);
				$counter = 0;
				$counter2 = 0;
				foreach($results as $result){
				if($counter2 == 4){
					$counter2 = 0;
					echo '</tr><tr>';
				}				
				?>	
                	<td>
                	<a rel="{handler: 'iframe', size: {x: 600, y: 600}}" href="<?php echo $mainframe->getSiteURL(); ?>administrator/components/com_chronocontact/themes/<?php echo $result; ?>/thumbbig.png" class="modal"><img src="<?php echo $mainframe->getSiteURL(); ?>administrator/components/com_chronocontact/themes/<?php echo $result; ?>/thumbsmall.png" /></a><br />
                	<input type="radio" name="theme" id="theme<?php echo $counter; ?>" onclick="if(this.checked == true)document.getElementById('themevalue').value = this.value;" value="<?php echo $result; ?>" />
                    <label for="theme<?php echo $counter; ?>"><?php echo $result; ?></label>
                    </td>
                <?php
				$counter++;
				$counter2++;
				}
				?>
                </tr>
                </table>
                </td>
            </tr>
            <tr>
            	<td>
                	<input type="button" value="Preview" id="cfpreview" onclick="OpenAddWin()" />
                    <input type="submit" value="Transform & Save" id="cfsave" />
                </td>
            </tr>
            <tr>
            	<td>
                	<div id="previewdiv"></div>
                </td>
            </tr>
        </table>
        <input type="hidden" name="option" value="com_chronocontact" />
        <input type="hidden" name="formid" value="<?php echo $row->id; ?>" />
        <input type="hidden" name="task" id="cftask" value="savetransform" />
        <input type="hidden" name="themevalue" id="themevalue" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="hidemainmenu" value="0">
    </form>
	<?php
    }
	
	function wizard_elements( $rows, $pageNav, $option ){
		?>
         <form action="index2.php" method="post" name="adminForm">
            <table class="adminlist"><tr><td>
            <table class="adminheading">
            <tr>
            <th>ChronoForms - Wizard's Elements Manager</th>
            </tr>
            </table>
            
            <table class="adminlist">
            <tr>
            <th width="3%" class='title' align="center">#</th>
            <th width="5%" align="center" class='title' style="white-space:nowrap;">ID</th>
            <th width="5%" class='title' align="center"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
            <th width="20%" align="left" class='title'>Placeholder</th>
            <th width="75%" align="center" class='title'>Description</th>
            </tr>
            <?php
            $k = 0;
            for ($i=0, $n=count($rows); $i < $n; $i++) {
            $row = $rows[$i];
            ?>
            <tr class="<?php echo "row$k"; ?>">
            <td width="3%" align="center"><?php echo $i+$pageNav->limitstart+1;?></td>
            <td width="5%" align="center"><?php echo $row->id; ?></td>
            <td width="5%" align="center"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>            
            <td width="20%" align="left" ><a href="#editelement" onclick="return listItemTask('cb<?php echo $i;?>','editelement')"><?php echo $row->placeholder; ?></a></td>
            <td width="75%" align="left" ><?php echo $row->desc; ?></td>
            </tr>
            <?php
            $k = 1 - $k;
            }
            ?>
            <tr><td colspan="12" style="white-space:nowrap; " height="20px"><?php echo $pageNav->getListFooter(); ?></td></tr>
            </table>
            </td></tr></table>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="tabs" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="hidemainmenu" value="0">
        </form>
        <?php
	}
	
	function editElement( $row, $option ){
		?>
         <form action="index2.php" method="post" name="adminForm">
        	<table class="adminlist">
            	<tr>
                	<td>Placeholder</td>
            		<td><input type="text" name="placeholder" id="placeholder" value="<?php echo $row->placeholder; ?>" /></td>
                </tr>
                <tr>
                	<td>Description</td>
            		<td>
                    	<input type="text" name="desc" size="150" id="desc" value="<?php echo $row->desc; ?>" />
                    </td>
                </tr>
                <tr>
                	<td>Code</td>
            		<td>
                    	<textarea rows="15" cols="80" name="code" id="code"><?php echo $row->code; ?></textarea>
                    </td>
                </tr>
            </table>
        	<input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="savetab" />
            <input type="hidden" name="boxchecked" value="0" />
            <input type="hidden" name="hidemainmenu" value="0">
            <input type="hidden" name="id" value="<?php echo $row->id; ?>">
        </form>
        <?php
	}
	
	function showTipOfDay(){
		global $mainframe;
		$rssurl	= 'http://www.chronoengine.com/tips-and-hints/33-chronoforms-tips.html?format=feed&type=rss';
		//  get RSS parsed object
		$options = array();
		$options['rssUrl'] 		= $rssurl;
		$options['cache_time'] = '100';
	
		$rssDoc =& JFactory::getXMLparser('RSS', $options);
	
		$feed = new stdclass();
	
		if ($rssDoc != false)
		{
			// channel header and link
			$feed->title = $rssDoc->get_title();
			$feed->link = $rssDoc->get_link();
			$feed->description = $rssDoc->get_description();
	
			// channel image if exists
			$feed->image->url = $rssDoc->get_image_url();
			$feed->image->title = $rssDoc->get_image_title();
	
			// items
			$items = $rssDoc->get_items();
	
			// feed elements
			shuffle($items);
			$feed->items = array_slice($items, 0, 1);
		} else {
			$feed = false;
		}
		if( $feed != false )
		{
			//image handling
			$iUrl 	= isset($feed->image->url)   ? $feed->image->url   : null;
			$iTitle = isset($feed->image->title) ? $feed->image->title : null;
			?>
			<table cellpadding="0" cellspacing="0" class="adminlist">
            	<tr>
            		<td>
                    <table class="adminheading">
                        <tr>
                        <th>ChronoEngine's Tip Of the Day</th>
                        </tr>
                    </table>
                    </td>
                </tr>
			<?php
			// feed description
			if(false){
				?>
				<tr>
					<td>
						<strong>
							<a href="<?php echo str_replace( '&', '&amp', $feed->link ); ?>" target="_blank">
								<?php echo $feed->title; ?></a>
						</strong>
					</td>
				</tr>
				<?php
			}
			// feed description
			if(false){
			?>
				<tr>
					<td><?php echo $feed->description; ?></td>
				</tr>
				<?php			
		
			// feed image
			
			?>
				<tr>
					<td><img src="<?php echo $iUrl; ?>" alt="<?php echo @$iTitle; ?>"/></td>
				</tr>
			<?php
			}
		
			$actualItems = count( $feed->items );
			$setItems    = 3;
		
			if ($setItems > $actualItems) {
				$totalItems = $actualItems;
			} else {
				$totalItems = $setItems;
			}
			?>
			<tr>
				<td>
					<ul class="newsfeed"  >
					<?php
					$words = 100;
					for ($j = 0; $j < $totalItems; $j ++)
					{
						$currItem = & $feed->items[$j];
						// item title
						?>
						<li>
						<?php
						if ( !is_null( $currItem->get_link() ) ) {
						?>
							<a href="<?php echo $currItem->get_link(); ?>" target="_blank">
							<?php echo $currItem->get_title(); ?></a>
						<?php
						}
		
						// item description
						if (true)//$params->get('rssitemdesc', 1))
						{
							// item description
							$text = $currItem->get_description();
							$text = str_replace('&apos;', "'", $text);
		
							// word limit check
							if ($words)
							{
								$texts = explode(' ', $text);
								$count = count($texts);
								if ($count > $words)
								{
									$text = '';
									for ($i = 0; $i < $words; $i ++) {
										$text .= ' '.$texts[$i];
									}
									$text .= '...';
								}
							}
							?>
							<div style="text-align: left ! important" class="newsfeed_item"  >
								<?php echo $text; ?>
							</div>
							<?php
						}
						?>
						</li>
						<?php
					}
					?>
					</ul>
				</td>
				</tr>
			</table>
		<?php } 
	}
}
?>