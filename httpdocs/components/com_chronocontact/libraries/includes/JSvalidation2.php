<script type="text/javascript">
	Element.extend({
		getInputByName1 : function(nome) {
			el = this.getFormElements().filterByAttribute('name','=',nome)
			return (el)?(el.length)?el[0]:el:false;
		}
	});
	window.addEvent('domready', function() {
	$ES('input', $('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>')).each(function(field){
		if((field.getProperty('type') != 'submit')&&(field.getProperty('type') != 'reset')&&(field.getProperty('type') != 'button')&&(field.getProperty('type') != 'hidden')){
			if((field.getProperty('type') != 'radio')&&(field.getProperty('type') != 'checkbox')){
				eval("var cfvalidate_"+field.getProperty('name').replace('[]', '')+" = new LiveValidation(field, { validMessage: ' ', wait: 500, onlyOnBlur:true });");
			}
			//checkValidations(field, "cfvalidate_"+field.getProperty('name').replace('[]', ''));
			if(field.hasClass('required')){
				var fMessage_val_required = 'This field is required';
				eval("if(field.getProperty('title')){fMessage_val_required = field.getProperty('title');}")
				eval("cfvalidate_"+field.getProperty('name').replace('[]', '')+".add( Validate.Presence, { failureMessage: fMessage_val_required } );");
			}
			if(field.hasClass('validate-number')){
				var fMessage_val_validate_number = 'Please enter a valid number in this field.';
				eval("if(field.getProperty('title')){fMessage_val_validate_number = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Numericality, { notANumberMessage: fMessage_val_validate_number } );");
			}
			if(field.hasClass('validate-digits')){
				var fMessage_val_validate_digits = 'Please use numbers only in this field. please avoid spaces or other characters such as dots or commas.';
				eval("if(field.getProperty('title')){fMessage_val_validate_digits = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Numericality, { notAnIntegerMessage: fMessage_val_validate_digits } );");
			}
			if(field.hasClass('validate-alpha')){
				var fMessage_val_validate_alpha = 'Please use letters only (a-z) in this field.';
				eval("if(field.getProperty('title')){fMessage_val_validate_alpha = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Format, { pattern: /^[a-zA-Z ]+$/, failureMessage: fMessage_val_validate_alpha } );");
			}
			if(field.hasClass('validate-alphanum')){
				var fMessage_val_validate_alphanum = 'Please use only letters (a-z) or numbers (0-9) only in this field. No spaces or other characters are allowed.';
				eval("if(field.getProperty('title')){fMessage_val_validate_alphanum = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Format, { pattern: !/\W/, failureMessage: fMessage_val_validate_alphanum } );");
			}
			if(field.hasClass('validate-date')){
				var fMessage_val_validate_date = 'Please enter a valid date in this format yyyy/mm/dd';
				eval("if(field.getProperty('title')){fMessage_val_validate_date = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Format, { pattern: /(19|20)[0-9][0-9][- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])/, failureMessage: fMessage_val_validate_date } );");
			}
			if(field.hasClass('validate-email')){
				var fMessage_val_validate_email = 'Please enter a valid email address. For example fred@'+'domain.com .';
				eval("if(field.getProperty('title')){fMessage_val_validate_email = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Email, { failureMessage: fMessage_val_validate_email } );");
			}
			if(field.hasClass('validate-url')){
				var fMessage_val_validate_validate_url = 'Please enter a valid URL.';
				var url_regex = /^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i;
				eval("if(field.getProperty('title')){fMessage_val_validate_validate_url = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Format, { pattern: "+url_regex+", failureMessage: fMessage_val_validate_validate_url } );");
			}
			if(field.hasClass('validate-date-au')){
				var fMessage_val_validate_date_au = 'Please use this date format: dd/mm/yyyy. For example 17/03/2006 for the 17th of March, 2006.';
				eval("if(field.getProperty('title')){fMessage_val_validate_date_au = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Format, { pattern: /(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9][0-9]/, failureMessage: fMessage_val_validate_date_au } );");
			}
			if(field.hasClass('validate-currency-dollar')){
				var fMessage_val_validate_currency_dollar = 'Please enter a valid $ amount. For example $100.00 .';
				eval("if(field.getProperty('title')){fMessage_val_validate_currency_dollar = field.getProperty('title');}");
				eval("cfvalidate_"+field.getProperty('name')+".add( Validate.Format, { pattern: /^\$?\-?([1-9]{1}[0-9]{0,2}(\,[0-9]{3})*(\.[0-9]{0,2})?|[1-9]{1}\d*(\.[0-9]{0,2})?|0(\.[0-9]{0,2})?|(\.[0-9]{1,2})?)$/, failureMessage: fMessage_val_validate_currency_dollar } );");
			}			
			Validate.One_Required = function(elm, paramsObj){
				var paramsObj = paramsObj || {};
				var message = paramsObj.failureMessage || "Must Choose one";
				var ready = false;
				var elm = paramsObj.elm;
				var p = elm.parentNode;
				var options = p.getElementsByTagName('INPUT');
				for(i=0; i<options.length; i++){
					if(options[i].checked == true) {
					  ready = true;
					}
				}
				if(!ready){
					Validate.fail(message);
				}
				return true;
			}
			if(field.hasClass('validate-one-required')){
				var fMessage_val_validate_one_required = 'Please select one of the options.';
				//if(field.size > 1)field.options[0].selected = true;
				eval("if(field.getProperty('title')){fMessage_val_validate_one_required = field.getProperty('title');}")
				eval("var cfvalidate_"+field.getProperty('name').replace('[]', '')+" = new LiveValidation(field, { validMessage: ' ', insertAfterWhatNode : field.parentNode });");
				eval("cfvalidate_"+field.getProperty('name').replace('[]', '')+".add( Validate.One_Required, { elm : field, failureMessage: fMessage_val_validate_one_required } );");
			}			
		}
	});
	
	$ES('select', $('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>')).each(function(field){
		eval("var cfvalidate_"+field.getProperty('name').replace('[]', '')+" = new LiveValidation(field, { validMessage: ' ' });");
		if(field.hasClass('validate-selection')){
			var fMessage_val_validate_selection = 'Please make a selection';
			if(field.size > 1)field.options[0].selected = true;
			eval("if(field.getProperty('title')){fMessage_val_validate_selection = field.getProperty('title');}");
			eval("cfvalidate_"+field.getProperty('name').replace('[]', '')+".add( Validate.Presence, { failureMessage: fMessage_val_validate_selection } );");
		}
	});	
	$ES('textarea', $('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>')).each(function(field){
		eval("var cfvalidate_"+field.getProperty('name').replace('[]', '')+" = new LiveValidation(field, { validMessage: ' ' });");
		if(field.hasClass('required')){
			var fMessage_val_required = 'This field is required';
			eval("if(field.getProperty('title')){fMessage_val_required = field.getProperty('title');}")
			eval("cfvalidate_"+field.getProperty('name').replace('[]', '')+".add( Validate.Presence, { failureMessage: fMessage_val_required } );");
		}
	});
	<?php if(str_replace(" ","",$MyForm->formparams('val_validate_confirmation'))){ ?>
		<?php
			$required_fields = explode(",", str_replace(" ","",$MyForm->formparams('val_validate_confirmation')));
			foreach($required_fields as $required_field){
				$required_field_pieces = explode("=", $required_field);
			?>
				var fMessage_val_validate_confirmation = 'Please make sure that the 2 fields are matching';
				if($('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName1('<?php echo $required_field_pieces[1]; ?>').getProperty('title')){
					fMessage_val_validate_confirmation = $('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName1('<?php echo $required_field_pieces[1]; ?>').getProperty('title');
				}
				var cfvalidate_<?php echo $required_field_pieces[1]; ?> = new LiveValidation($('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName1('<?php echo $required_field_pieces[1]; ?>'), { validMessage: " " });
				cfvalidate_<?php echo $required_field_pieces[1]; ?>.add( Validate.Confirmation, { match:$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName1('<?php echo $required_field_pieces[0]; ?>'), failureMessage: fMessage_val_validate_confirmation } );
			<?php
			}
		?>
	<?php } ?>	
	
	
	});
</script>