window.addEvent("domready",function(){
	var tabs = [];
	var options = [];
	var opt_iterator = -1;
	var base_table = $ES('.adminform .admintable',$$('#element-box .m')[0])[2];
	var update_url = 'http://www.gavick.com/updates.raw?task=json&tmpl=component&query=product&product=mod_news_pro_gk4';
	
	$$('.paramlist_value').each(function(el){
		if(!$E('input', el) && !$E('select', el) && !$E('textarea', el)){
			opt_iterator++;
			var div_gen = new Element('div',{"class":"gk_opt"});
			div_gen.innerHTML = '<span class="gk_text">'+el.innerHTML+'</span><span class="gk_btn">Toggle</span>';
			div_gen.injectBefore(base_table.getParent());
			tabs.push(div_gen);
			options[opt_iterator] = [];
		}else options[opt_iterator].push(el.getParent());
	});

	options.each(function(el,i){
		var div = new Element('div',{"class":"gk_opts"});
		div.innerHTML = '<td colspan="2"><table cellspacing="1" width="100%" class="paramlist admintable"><tbody></tbody></table></td>';
		div.injectAfter(tabs[i]);
		div_body = div.getElementsBySelector('tbody')[0];
		options[i].each(function(elm,j){ elm.injectInside(div_body); });
	});
	
	var update_tab = new Element('div',{"class":"gk_opt","id":"gk_update"});
	update_tab.innerHTML = '<span class="gk_text">Updates</span><span class="gk_btn">Toggle</span>';
	
	update_tab.injectAfter($$('.gk_opts').getLast());
	var update_div = new Element('div',{"class":"gk_opts"});
	
	update_div.innerHTML = '<div id="gk_update_div"><span id="gk_loader"></span>Loading update data from GavicPro Update service...</div>';
	update_div.injectAfter($$('.gk_opt').getLast());
	
	base_table.remove();
	$$('.jpane-slider')[0].remove();
	
	$('param-page').setStyle('display','none');
	
	$('gk_update').addEvent("click", function(){
		new Asset.javascript(update_url,{
	   		id: "new_script",
	   		onload: function(){
  				$('gk_update_div').innerHTML = '<p>All updates available for this module:</p>';
				$GK_UPDATE.each(function(el){
	  				$('gk_update_div').innerHTML += '<div class="gk_update"><span class="gk_update_version"><strong>Version:</strong> ' + el.version + ' </span><span class="gk_update_data"><strong>Date:</strong> ' + el.date + ' </span><span class="gk_update_link"><a href="' + el.link + '">Download this update</a></span></div>';
				});
				if($$('.gk_update').length == 0) $('gk_update_div').innerHTML += '<p>No updates available</p>';	
	   		}
		});
		
		if(window.ie){
			var $timer = (function(){
				if(typeof($GK_UPDATE) != undefined){
					$clear($timer);
					alert('Updates data downloaded');
					$('gk_update_div').innerHTML = '<p>All updates available for this module:</p>';
					$GK_UPDATE.each(function(el){
	  					$('gk_update_div').innerHTML += '<div class="gk_update"><span class="gk_update_version"><strong>Version:</strong> ' + el.version + ' </span><span class="gk_update_data"><strong>Date:</strong> ' + el.date + ' </span><span class="gk_update_link"><a href="' + el.link + '">Download this update</a></span></div>';
					});
					if($$('.gk_update').length == 0) $('gk_update_div').innerHTML += '<p>No updates available</p>';	
				}
			}).periodical(250);
		}
	});
	//
	var data_sources = [$('paramscom_sections'), $('paramscom_categories'), $('paramscom_articles'), $('paramsk2_categories'), $('paramsk2_tags'), $('paramsk2_articles')];
	//
	data_sources.each(function(el,j){
		el.getParent().getParent().setStyle('display','none');
	});
	
	$('params'+$('paramsdata_source').value).getParent().getParent().setStyle('display','');
	
	$('paramsdata_source').addEvent("change", function(){
		data_sources.each(function(el,j){
			el.getParent().getParent().setStyle('display','none');
		});
	
		$('params'+$('paramsdata_source').value).getParent().getParent().setStyle('display','');	
		$$('.gk_opts')[1].setStyle('height','auto');
	});
	$('paramsdata_source').addEvent("blur", function(){
		data_sources.each(function(el,j){
			el.getParent().getParent().setStyle('display','none');
		});
	
		$('params'+$('paramsdata_source').value).getParent().getParent().setStyle('display','');
		$$('.gk_opts')[1].setStyle('height','auto');
	});
	//
	if($('paramslinks_position').value == 'bottom') $('paramslinks_width').getParent().getParent().setStyle('display','none');
	else $('paramslinks_width').getParent().getParent().setStyle('display','');	
		
	$('paramslinks_position').addEvent('change', function(){
		if($('paramslinks_position').value == 'bottom') $('paramslinks_width').getParent().getParent().setStyle('display','none');
		else $('paramslinks_width').getParent().getParent().setStyle('display','');	
		$$('.gk_opts')[3].setStyle('height','auto');
	});

	$('paramslinks_position').addEvent('blur', function(){
		if($('paramslinks_position').value == 'bottom') $('paramslinks_width').getParent().getParent().setStyle('display','none');
		else $('paramslinks_width').getParent().getParent().setStyle('display','');
		$$('.gk_opts')[3].setStyle('height','auto');
	});
	
	var horder = $('paramsnews_header_order');
	var iorder = $('paramsnews_image_order');
	var torder = $('paramsnews_text_order');
	var inorder = $('paramsnews_info_order');
	var in2order = $('paramsnews_info2_order');
	
	horder.addEvent("change", function(){
		var unexisting = [false, false, false, false, false];
		unexisting[horder.value - 1] = true;
		unexisting[iorder.value - 1] = true;
		unexisting[torder.value - 1] = true;
		unexisting[inorder.value - 1] = true;
		unexisting[in2order.value - 1] = true;
		
		var searched = 0;
		
		if(unexisting[0] == false) searched = 1;
		if(unexisting[1] == false) searched = 2;
		if(unexisting[2] == false) searched = 3;
		if(unexisting[3] == false) searched = 4;
		if(unexisting[4] == false) searched = 5;
		
		if(iorder.value == horder.value) iorder.value = searched;
		if(torder.value == horder.value) torder.value = searched;
		if(inorder.value == horder.value) inorder.value = searched;
		if(in2order.value == horder.value) in2order.value = searched;
	});

	iorder.addEvent("change", function(){
		var unexisting = [false, false, false, false, false];
		unexisting[horder.value - 1] = true;
		unexisting[iorder.value - 1] = true;
		unexisting[torder.value - 1] = true;
		unexisting[inorder.value - 1] = true;
		unexisting[in2order.value - 1] = true;
		
		var searched = 0;
		
		if(unexisting[0] == false) searched = 1;
		if(unexisting[1] == false) searched = 2;
		if(unexisting[2] == false) searched = 3;
		if(unexisting[3] == false) searched = 4;
		if(unexisting[4] == false) searched = 5;
		
		if(horder.value == iorder.value) horder.value = searched;
		if(torder.value == iorder.value) torder.value = searched;
		if(inorder.value == iorder.value) inorder.value = searched;	
		if(in2order.value == iorder.value) in2order.value = searched;		
	});
	
	torder.addEvent("change", function(){
		var unexisting = [false, false, false, false, false];
		unexisting[horder.value - 1] = true;
		unexisting[iorder.value - 1] = true;
		unexisting[torder.value - 1] = true;
		unexisting[inorder.value - 1] = true;
		unexisting[in2order.value - 1] = true;
				
		var searched = 0;
		
		if(unexisting[0] == false) searched = 1;
		if(unexisting[1] == false) searched = 2;
		if(unexisting[2] == false) searched = 3;
		if(unexisting[3] == false) searched = 4;
		if(unexisting[4] == false) searched = 5;
		
		if(horder.value == torder.value) horder.value = searched;
		if(iorder.value == torder.value) iorder.value = searched;
		if(inorder.value == torder.value) inorder.value = searched;	
		if(in2order.value == torder.value) in2order.value = searched;	
	});
	
	inorder.addEvent("change", function(){
		var unexisting = [false, false, false, false, false];
		unexisting[horder.value - 1] = true;
		unexisting[iorder.value - 1] = true;
		unexisting[torder.value - 1] = true;
		unexisting[inorder.value - 1] = true;
		unexisting[in2order.value - 1] = true;
		
		var searched = 0;
		
		if(unexisting[0] == false) searched = 1;
		if(unexisting[1] == false) searched = 2;
		if(unexisting[2] == false) searched = 3;
		if(unexisting[3] == false) searched = 4;
		if(unexisting[4] == false) searched = 5;
		
		if(horder.value == inorder.value) horder.value = searched;
		if(torder.value == inorder.value) torder.value = searched;
		if(iorder.value == inorder.value) iorder.value = searched;	
		if(in2order.value == inorder.value) in2order.value = searched;	
	});

	in2order.addEvent("change", function(){
		var unexisting = [false, false, false, false, false];
		unexisting[horder.value - 1] = true;
		unexisting[iorder.value - 1] = true;
		unexisting[torder.value - 1] = true;
		unexisting[inorder.value - 1] = true;
		unexisting[in2order.value - 1] = true;
		
		var searched = 0;
		
		if(unexisting[0] == false) searched = 1;
		if(unexisting[1] == false) searched = 2;
		if(unexisting[2] == false) searched = 3;
		if(unexisting[3] == false) searched = 4;
		if(unexisting[4] == false) searched = 5;
		
		if(horder.value == in2order.value) horder.value = searched;
		if(torder.value == in2order.value) torder.value = searched;
		if(iorder.value == in2order.value) iorder.value = searched;	
		if(inorder.value == in2order.value) inorder.value = searched;	
	});
	
	$$('.input-pixels').each(function(el){el.getParent().innerHTML = el.getParent().innerHTML + "<span class=\"unit\">px</span>"});
	$$('.input-percents').each(function(el){el.getParent().innerHTML = el.getParent().innerHTML + "<span class=\"unit\">%</span>"});
	$$('.input-minutes').each(function(el){el.getParent().innerHTML = el.getParent().innerHTML + "<span class=\"unit\">minutes</span>"});
	$$('.input-ms').each(function(el){el.getParent().innerHTML = el.getParent().innerHTML + "<span class=\"unit\">ms</span>"});

	$$('.last-in-group').each(function(el){
		var new_tr = new Element('tr');
		var elm = el.getParent().getParent();
		new_tr.injectAfter(elm);
		new_tr.innerHTML = '<td width="40%" style="height:5px;background:#eee;" class="paramlist_key"></td><td class="paramlist_value" style="height:5px;background:#eee;"></td>';
	});
	
	$$('.text-limit').each(function(el){
		var tr = el.getParent().getParent();
		var destination = tr.getPrevious().getElements('td')[1];
		var element = tr.getElements('td input')[0];
		element.injectTop(destination);
		tr.remove();		
	});
	
	$$('.float').each(function(el){
		var tr = el.getParent().getParent();
		var destination = tr.getPrevious().getElements('td')[1];
		var element = tr.getElements('td select')[0];
		element.injectTop(destination);
		tr.remove();	
	});
	
	$$('.enabler').each(function(el){
		var tr = el.getParent().getParent();
		var destination = tr.getPrevious().getElements('td')[1];
		var element = tr.getElements('td select')[0];
		element.injectInside(destination);
		tr.remove();	
	});
	
	$$('.gk_switch').each(function(el){
		el.setStyle('display','none');
		var style = (el.value == 1) ? 'on' : 'off';
		var switcher = new Element('div',{'class' : 'switcher-'+style});
		switcher.injectAfter(el);
		switcher.addEvent("click", function(){
			if(el.value == 1){
				switcher.setProperty('class','switcher-off');
				el.value = 0;
			}else{
				switcher.setProperty('class','switcher-on');
				el.value = 1;
			}
		});
	});
	
	var acc = new Accordion($$('.gk_opt'),$$('.gk_opts'),{
		onActive:function(toggler){ toggler.setProperty("class","gk_opt active"); },
		onBackground:function(toggler){ toggler.setProperty("class","gk_opt"); },
		alwaysHide: true,
		duration:200
	});
});