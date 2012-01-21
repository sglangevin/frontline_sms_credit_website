<script type="text/javascript">			
	Element.extend({
		getInputByName : function(nome) {
			el = this.getFormElements().filterByAttribute('name','=',nome)
			return (el)?(el.length == 1)?el[0]:el:false;
		},
		setValue: function(value,append){ 
			if(value) { 
				value = value.toString(); 
				value = value.replace(/%25/g,"%"); 
				value = value.replace(/%26/g,"&"); 
				value = value.replace(/%2b/g,"+"); 
			} 
			switch(this.getTag()){ 
				case 'select': case 'select-one': 
					//this.value = value; 
					if ($type(value.split(","))=='array') value.split(",").each(function(v,i){value.split(",")[i]=v.toString()});
					sel = function(option) {
						if (($type(value.split(","))=='array'&&value.split(",").contains(option.value))||(option.value==value))option.selected = true
						else option.selected = false;
					}
					$each(this.options,sel);
					break; 
				case 'hidden': case 'text': case 'textarea': case 'input': 
					if(['checkbox', 'radio'].test(this.type)) { 	 
						//alert(value.split(",").contains(this.value)); alert ($type(value.split(","))); alert(this.name);
						//if(['1', 'checked', 'on', 'true', 'yes'].test(value)) this.checked = true; else this.checked = false; 
						//this.checked=((this.value==value)||(this.value == ','+value+',')||(this.value == '['+value+',')||(this.value == ','+value+']')||(this.value == '['+value+']'));
						this.checked=(($type(value.split(","))=='array')?value.split(",").contains(this.value):(this.value==value));
					} else if(['file'].test(this.type)) { 
						//do nothing
					} else {
						if(append) this.value += value; else this.value = value; 
					} 
					break; 
				case 'img': 
					this.src = value; 
					break; 
				//default: 
					//value=value.replace(//gi,"“"); value=value.replace(//gi,"”"); 
					//if(append) {this.innerHTML += value;} else {this.innerHTML = value;} 
					//if(append && this.scrollHeight) this.scrollTop = this.scrollHeight; 
					//break; 
			} 
			return this; 
		}
	});
	window.addEvent('domready', function() {
		<?php $post = $posted; ?>
		<?php foreach($post as $data => $value){ ?>
		<?php if(is_array($value)){$value = "".implode(",", $value).""; $data = $data."[]";} ?>
			$('<?php echo "ChronoContact_".$MyForm->formrow->name; ?>').getInputByName('<?php echo $data; ?>').setValue(<?php echo preg_replace('/[\n\r]+/', '\n', "'".$value."'"); ?>, '');
		<?php } ?>			
	});
</script>