<script type="text/javascript">
	Element.extend({
		getInputByName2 : function(nome) {
			el = this.getFormElements().filterByAttribute('name','=',nome)
			return (el)?(el.length)?el:el:false;
		}
	});
	window.addEvent('domready', function() {
		<?php if(str_replace(" ","",$MyForm->formparams('val_required'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_required')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('required');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_number'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_number')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-number');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_digits'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_digits')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-digits');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_alpha'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_alpha')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-alpha');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_alphanum'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_alphanum')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-alphanum');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_date'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_date')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-date');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_email'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_email')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-email');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_url'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_url')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-url');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_date_au'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_date_au')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-date-au');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_currency_dollar'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_currency_dollar')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-currency-dollar');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_selection'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_selection')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-selection');
		});
		<?php } ?>
		<?php if(str_replace(" ","",$MyForm->formparams('val_validate_one_required'))){ ?>
		('<?php echo str_replace(" ","",$MyForm->formparams('val_validate_one_required')); ?>').split(',').each(function(field){
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName2(field).addClass('validate-one-required');
		});
		<?php } ?>
	});
</script>