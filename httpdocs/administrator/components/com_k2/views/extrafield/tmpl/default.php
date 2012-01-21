<?php
/**
 * @version		$Id: default.php 536 2010-08-04 11:56:59Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2010 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<script type="text/javascript">
	//<![CDATA[
	function submitbutton(pressbutton) {

		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		if (trim( document.adminForm.group.value ) == "") {
			alert( '<?php echo JText::_('Please select a group or create a new one', true); ?>' );
		}
		else if (trim( document.adminForm.name.value ) == "") {
			alert( '<?php echo JText::_('Name cannot be empty', true); ?>' );
		}
		else {
			submitform( pressbutton );
		}
	}

	function addOption(){
		var div = new Element('div').injectInside($('select_dd_options'));
		var input = new Element('input',{'name':'option_name[]','type':'text'}).injectInside(div);
		var input = new Element('input',{'name':'option_value[]','type':'hidden'}).injectInside(div);
		var input = new Element('input',{'value':'<?php echo JText::_('Remove',true); ?>','type':'button', events: { click: function() {this.getParent().remove();} }}).injectInside(div);
	}

	function renderExtraFields(fieldType,fieldValues,isNewField){
		var target = $('exFieldsTypesDiv');
		var currentType = '<?php echo $this->row->type; ?>';

		switch (fieldType){

			case 'textfield':

			if (isNewField || currentType!=fieldType)
				var input = new Element('input',{'name':'option_value[]','type':'text'}).injectInside(target);
			else
				var input = new Element('input',{'name':'option_value[]','type':'text','value':fieldValues[0].value}).injectInside(target);

			var notice = new Element('span').setHTML('(<?php echo JText::_('optional', true); ?>)').injectInside(target);
			break;

			case 'labels':

			if (isNewField || currentType!=fieldType)
				var input = new Element('input',{'name':'option_value[]','type':'text'}).injectInside(target);
			else
				var input = new Element('input',{'name':'option_value[]','type':'text','value':fieldValues[0].value}).injectInside(target);

			var notice = new Element('span').setHTML('<?php echo JText::_('Comma separated values', true); ?> (<?php echo JText::_('optional', true); ?>)').injectInside(target);
			break;

			case 'textarea':
			if (isNewField || currentType!=fieldType){
				var textarea = new Element('textarea',{'name':'option_value[]','cols':'40', 'rows':'10'}).injectInside(target);
				var br = new Element('br').injectInside(target);
				var label = new Element('label').setHTML('<?php echo JText::_('Use editor', true); ?>').injectInside(target);
				var input = new Element('input',{'name':'option_editor[]','type':'checkbox','value':'1'}).injectInside(target);
			}
			else {
				var textarea = new Element('textarea',{'name':'option_value[]','cols':'40', 'rows':'10','value':fieldValues[0].value}).injectInside(target);
				var br = new Element('br').injectInside(target);
				var label = new Element('label').setHTML('<?php echo JText::_('Use editor', true); ?>').injectInside(target);
				var input = new Element('input',{'name':'option_editor[]','type':'checkbox','value':'1'}).injectInside(target);
				if(fieldValues[0].editor){
					input.setProperty('checked',true);
				}
				else {
					input.setProperty('checked',false);
				}
			}
			var br = new Element('br').injectInside(target);
			var br = new Element('br').injectInside(target);
			var notice = new Element('span').setHTML('(<?php echo JText::_('all settings above are optional', true); ?>)').injectInside(target);
			break;

			case 'select':
			case 'multipleSelect':
			case 'radio':
			var input = new Element('input',{'value':'<?php echo JText::_('Add an option', true); ?>','type':'button', events: { click: function() {addOption();} }}).injectInside(target);
			var br = new Element('br').injectInside(target);
			var div = new Element('div',{'id':'select_dd_options'}).injectInside(target);
			if (isNewField || currentType!=fieldType) {
				addOption();
			}
			else {
				$each(fieldValues, function(value){
					var div = new Element('div').injectInside($('select_dd_options'));
					var input = new Element('input',{'name':'option_name[]','type':'text','value':value.name}).injectInside(div);
					var input = new Element('input',{'name':'option_value[]','type':'hidden','value':value.value}).injectInside(div);
					var input = new Element('input',{'value':'<?php echo JText::_('Remove',true); ?>','type':'button', events: { click: function() {this.getParent().remove();} }}).injectInside(div);
				});

			}
			break;

			case 'link':
			if (isNewField || currentType!=fieldType) {
				var label = new Element('label').setHTML('<?php echo JText::_('Link text', true); ?>').injectInside(target);
				var input = new Element('input',{'name':'option_name[]','type':'text'}).injectInside(target);
				var br = new Element('br').injectInside(target);
				var label = new Element('label').setHTML('<?php echo JText::_('URL', true); ?>').injectInside(target);
				var input = new Element('input',{'name':'option_value[]','type':'text'}).injectInside(target);
				var br = new Element('br').injectInside(target);
				var label = new Element('label').setHTML('<?php echo JText::_('Open in', true); ?>').injectInside(target);
				var select = new Element('select',{'name':'option_target[]'}).injectInside(target);
				var option = new Element('option',{'value':'same'}).setHTML('<?php echo JText::_('Same window', true); ?>').injectInside(select);
				var option = new Element('option',{'value':'new'}).setHTML('<?php echo JText::_('New window', true); ?>').injectInside(select);
				var option = new Element('option',{'value':'popup'}).setHTML('<?php echo JText::_('Classic Javascript popup', true); ?>').injectInside(select);
				var option = new Element('option',{'value':'lightbox'}).setHTML('<?php echo JText::_('Lightbox popup', true); ?>').injectInside(select);
			}
			else {
				var label = new Element('label').setHTML('<?php echo JText::_('Link text', true); ?>').injectInside(target);
				var input = new Element('input',{'name':'option_name[]','type':'text','value':fieldValues[0].name}).injectInside(target);
				var br = new Element('br').injectInside(target);
				var label = new Element('label').setHTML('<?php echo JText::_('URL', true); ?>').injectInside(target);
				var input = new Element('input',{'name':'option_value[]','type':'text','value':fieldValues[0].value}).injectInside(target);
				var br = new Element('br').injectInside(target);
				var label = new Element('label').setHTML('<?php echo JText::_('Open in', true); ?>').injectInside(target);
				var select = new Element('select',{'name':'option_target[]'}).injectInside(target);
				var options = new Array();
				options[0] = new Element('option',{'value':'same'}).setHTML('<?php echo JText::_('Same window', true); ?>').injectInside(select);
				options[1] = new Element('option',{'value':'new'}).setHTML('<?php echo JText::_('New window', true); ?>').injectInside(select);
				options[2] = new Element('option',{'value':'popup'}).setHTML('<?php echo JText::_('Classic Javascript popup', true); ?>').injectInside(select);
				options[3] = new Element('option',{'value':'lightbox'}).setHTML('<?php echo JText::_('Modal (lightbox) popup', true); ?>').injectInside(select);
				options.each(function(el) {
					if (el.value==fieldValues[0].target){
						el.setProperty('selected','selected');
					}
				});

			}

			var br = new Element('br').injectInside(target);
			var br = new Element('br').injectInside(target);
			var notice = new Element('span').setHTML('(<?php echo JText::_('all settings above are optional', true); ?>)').injectInside(target);
			break;

			case 'csv':
				if (isNewField || currentType!=fieldType){
					var input = new Element('input',{'name':'csv_file','type':'file'}).injectInside(target);
					var input = new Element('input',{'name':'option_value[]','type':'hidden'}).injectInside(target);
				}
				else {
					var input = new Element('input',{'name':'csv_file','type':'file'}).injectInside(target);
					var input = new Element('input',{'name':'option_value[]','type':'hidden', 'value':Json.toString(fieldValues[0].value)}).injectInside(target);
					var table = new Element('table', {'class':'csvTable'}).injectInside(target);
					fieldValues[0].value.each(function(row, index) {
						var tr = new Element('tr').injectInside(table);
						row.each(function(cell){
							if(index>0){
								var td = new Element('td').setHTML(cell).injectInside(tr);
							}
							else {
								var th = new Element('th').setHTML(cell).injectInside(tr);
							}
						})
					});
					var label = new Element('label').setHTML('<?php echo JText::_('Reset value', true); ?>').injectInside(target);
					var input = new Element('input',{'name':'K2ResetCSV','type':'checkbox'}).injectInside(target);
					var br = new Element('br',{'class':'clr'}).injectInside(target);
				}
				var notice = new Element('span').setHTML('(<?php echo JText::_('optional', true); ?>)').injectInside(target);
				break;

			default:
			var title = new Element('span',{'class':'notice'}).setHTML('<?php echo JText::_('Please select a field type from the list above', true); ?>').injectInside(target);
			break;

		}

	}

	window.addEvent('domready', function(){

		<?php echo ($this->row->group)? "$('groupContainer').setStyle('opacity',0)":""?>

		$('groups').addEvent('change', function(){

		var selectedValue = this.value;

		    if (selectedValue == '0') {
		        $('group').setProperty('value', '');
			$('isNew').setProperty('value', '1');
		        new Fx.Style($('groupContainer'), 'opacity', {
		            duration: 1000
		        }).start(1);
		    }

		    else {
		        new Fx.Style($('groupContainer'), 'opacity', {
		            duration: 1000
		        }).start(0).chain(function(){
		            $('group').setProperty('value', selectedValue);
				$('isNew').setProperty('value', '0');
		        });
		    }

		});

		var newField= <?php echo ($this->row->id)?0:1; ?>;

		if (!newField) {
			var values = Json.evaluate($('value').getProperty('value'));
		}
		else {
			var values=new Array();
			values[0]=" ";
		}

		renderExtraFields('<?php echo $this->row->type; ?>',values,newField);

	    $('type').addEvent('change', function(){

			var selectedType=this.value;

			new Fx.Style($('exFieldsTypesDiv'), 'opacity', {
				duration: 500
			}).start(0).chain(function(){
			$('exFieldsTypesDiv').empty();

			renderExtraFields(selectedType,values,newField);
				new Fx.Style($('exFieldsTypesDiv'), 'opacity', {
					duration: 500
				}).start(1);
			});

		});

	});
	//]]>
</script>

<form action="index.php" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm">

	<fieldset class="adminform">
		<legend><?php echo JText::_('Details');?></legend>

    <table class="admintable">
      <tr>
        <td class="key"><?php echo JText::_('Name'); ?></td>
        <td><input class="text_area" type="text" name="name" id="name" value="<?php echo $this->row->name; ?>" size="50" maxlength="250" /></td>
      </tr>
      <tr>
        <td class="key"><?php echo JText::_('Published'); ?></td>
        <td><?php echo $this->lists['published']; ?></td>
      </tr>
      <tr>
        <td class="key"><?php echo JText::_('Group'); ?></td>
        <td>
	        <?php echo $this->lists['group']; ?>
	        <div id="groupContainer">
	        	<span><?php echo JText::_('New group name'); ?></span>
	        	<input id="group" type="text" name="group" value="<?php echo $this->row->group; ?>" />
	        </div>
        </td>
      </tr>
      <tr>
        <td class="key"><?php echo JText::_('Type'); ?></td>
        <td><?php echo $this->lists['type']; ?></td>
      </tr>
      <tr>
        <td class="key"><?php echo JText::_('Default values'); ?></td>
        <td><div id="exFieldsTypesDiv"></div></td>
      </tr>
    </table>

	</fieldset>

  <input type="hidden" name="id" value="<?php echo $this->row->id; ?>" />
  <input type="hidden" name="isNew" id="isNew" value="<?php echo ($this->row->group)?'0':'1'; ?>" />
  <input type="hidden" name="option" value="<?php echo $option; ?>" />
  <input type="hidden" name="view" value="<?php echo JRequest::getVar('view'); ?>" />
  <input type="hidden" name="task" value="<?php echo JRequest::getVar('task'); ?>" />
  <input type="hidden" id="value" name="value" value="<?php echo htmlentities($this->row->value); ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>

</form>
