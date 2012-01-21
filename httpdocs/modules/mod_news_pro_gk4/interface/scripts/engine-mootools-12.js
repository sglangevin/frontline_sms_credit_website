window.addEvent("load", function(){	
	$$('.nsp_main').each(function(module){
		var id = module.getProperty('id');
		var $G = $Gavick[id];
		var arts_actual = 0;
		var list_actual = 0;
		var arts_block_width = module.getElement('.nsp_arts') ? module.getElement('.nsp_arts').getSize().x : null;
		var links_block_width = module.getElement('.nsp_links ul') ? module.getElement('.nsp_links ul').getSize().x : null;
		var arts = module.getElements('.nsp_art');
		var links = module.getElements('.nsp_links .list li');
		var arts_per_page = $G['news_column'] * $G['news_rows'];
		var pages_amount = Math.ceil(arts.length / arts_per_page);
		var links_pages_amount = Math.ceil(Math.ceil(links.length / $G['links_amount']) / $G['links_columns_amount']);
		var auto_anim = module.hasClass('autoanim');
		var hover_anim = module.hasClass('hover');
		var anim_speed = $G['animation_speed'];
		var anim_interval = $G['animation_interval'];
		var animation = true;
		
		if(arts.length > 0){
			for(var i = 0; i < pages_amount; i++){
				var div = new Element('div',{"class" : "nsp_art_page"});
				div.setStyles({ "width" : arts_block_width+"px", "float" : "left" });
				div.injectBefore(arts[0]);
			}	
			
			var j = 0;
			for(var i = 0; i < arts.length; i++) {
				if(i % arts_per_page == 0 && i != 0) { j++; }
				if(Browser.Engine.trident) arts[i].setStyle('width', (arts[i].getStyle('width').toInt() - 0.2) + "%");
				arts[i].injectInside(module.getElements('.nsp_art_page')[j]);
				if(arts[i].hasClass('unvisible')) arts[i].removeClass('unvisible');
			}
			
			var main_scroll = new Element('div',{"class" : "nsp_art_scroll1" });
			main_scroll.setStyles({ "width" : arts_block_width + "px", "overflow" : "hidden" });
			main_scroll.innerHTML = '<div class="nsp_art_scroll2"></div>';
			main_scroll.injectBefore(module.getElement('.nsp_art_page'));
			var long_scroll = module.getElement('.nsp_art_scroll2');
			long_scroll.setStyle('width','100000px');
			module.getElements('.nsp_art_page').injectInside(long_scroll);
			var art_scroller = new Fx.Scroll(main_scroll, {duration:$G['animation_speed'], wait:false, wheelStops:false});
		}
		
		if(links.length > 0){
			for(var i = 0; i < links_pages_amount * $G['links_columns_amount']; i++){
				var ul = new Element('ul');
				ul.setStyles({ "width" : Math.floor(links_block_width / $G['links_columns_amount']) +"px", "float" : "left" });
				ul.setProperty("class","list");
				ul.injectTop(module.getElement('.nsp_links'));
			}
			
			var k = 0;
			for(var i = 0; i < links.length; i++) {
				if(i % $G['links_amount'] == 0 && i != 0) { k++; }
				links[i].injectInside(module.getElements('.nsp_links ul.list')[k]);
				if(links[i].hasClass('unvisible')) links[i].removeClass('unvisible');
			}
			module.getElements('.nsp_links ul.list')[module.getElements('.nsp_links ul.list').length - 1].dispose();
			var link_scroll = new Element('div',{"class" : "nsp_link_scroll1" });
			link_scroll.setStyles({ "width" : links_block_width + "px", "overflow" : "hidden" });
			link_scroll.innerHTML = '<div class="nsp_link_scroll2"></div>';
			link_scroll.injectTop(module.getElement('.nsp_links'));
			var long_link_scroll = module.getElement('.nsp_link_scroll2');
			long_link_scroll.setStyle('width','100000px');
			module.getElements('.nsp_links ul.list').injectInside(long_link_scroll);
			var link_scroller = new Fx.Scroll(link_scroll, {duration:$G['animation_speed'], wait:false, wheelStops:false});
		}
		
		// top interface
		nsp_art_list(0, module, 'top');
		nsp_art_list(0, module, 'bottom');
		nsp_art_counter(0, module, 'top', pages_amount);
		nsp_art_counter(0, module, 'bottom', links_pages_amount);
		
		if(module.getElement('.nsp_top_interface .pagination')){
			module.getElement('.nsp_top_interface .pagination').getElements('li').each(function(item,i){
				item.addEvent(hover_anim ? 'mouseenter' : 'click', function(){
					art_scroller.start(i*arts_block_width, 0);
					arts_actual = i;
					
					if(Browser.Engine.presto){
			 			new Fx.Tween(module.getElements('.nsp_art_scroll2')[0], {duration:$G['animation_speed'], wait:false}).start('margin-left',-1 * arts_actual * arts_block_width);
					}
					
					nsp_art_list(i, module, 'top');
					nsp_art_counter(i, module, 'top', pages_amount);
					animation = false;
					(function(){animation = true;}).delay($G['animation_interval'] * 0.8);
				});	
			});
		}
		if(module.getElement('.nsp_top_interface .prev')){
			module.getElement('.nsp_top_interface .prev').addEvent("click", function(){
				if(arts_actual == 0) arts_actual = pages_amount - 1;
				else arts_actual--;
				art_scroller.start(arts_actual * arts_block_width, 0);
				
				if(Browser.Engine.presto){
			 		new Fx.Tween(module.getElements('.nsp_art_scroll2')[0], {duration:$G['animation_speed'], wait:false}).start('margin-left', -1 * arts_actual * arts_block_width);	
				}
				
				nsp_art_list(arts_actual, module, 'top');
				nsp_art_counter(arts_actual, module, 'top', pages_amount);
				animation = false;
				(function(){animation = true;}).delay($G['animation_interval'] * 0.8);
			});
		}
		
		if(module.getElement('.nsp_top_interface .next')){
			module.getElement('.nsp_top_interface .next').addEvent("click", function(){
				if(arts_actual == pages_amount - 1) arts_actual = 0;
				else arts_actual++;
				art_scroller.start(arts_actual * arts_block_width, 0);
				
				if(Browser.Engine.presto){
			 		new Fx.Tween(module.getElements('.nsp_art_scroll2')[0], {duration:$G['animation_speed'], wait:false}).start('margin-left', -1 * arts_actual * arts_block_width);	
				}
				
				nsp_art_list(arts_actual, module, 'top');
				nsp_art_counter(arts_actual, module, 'top', pages_amount);
				animation = false;
				(function(){animation = true;}).delay($G['animation_interval'] * 0.8);
			});
		}
		// bottom interface
		if(module.getElement('.nsp_bottom_interface .pagination')){
			module.getElement('.nsp_bottom_interface .pagination').getElements('li').each(function(item,i){
				item.addEvent(hover_anim ? 'mouseenter' : 'click', function(){
					link_scroller.start(i*links_block_width, 0);
					list_actual = i;
					
					if(Browser.Engine.presto){
			 			new Fx.Tween(module.getElements('.nsp_link_scroll2')[0], {duration:$G['animation_speed'], wait:false}).start('margin-left', -1 * list_actual * links_block_width);	
					}
					
					nsp_art_list(i, module, 'bottom', links_pages_amount);
				});	
			});
		}
		if(module.getElement('.nsp_bottom_interface .prev')){
			module.getElement('.nsp_bottom_interface .prev').addEvent("click", function(){
				if(list_actual == 0) list_actual = links_pages_amount - 1;
				else list_actual--;
				link_scroller.start(list_actual * links_block_width, 0);
				
				if(Browser.Engine.presto){
		 			new Fx.Tween(module.getElements('.nsp_link_scroll2')[0], {duration:$G['animation_speed'], wait:false}).start('margin-left', -1 * list_actual * links_block_width);	
				}
				
				nsp_art_list(list_actual, module, 'bottom', links_pages_amount);
				nsp_art_counter(list_actual, module, 'bottom', links_pages_amount);
			});
		}
		if(module.getElement('.nsp_bottom_interface .next')){
			module.getElement('.nsp_bottom_interface .next').addEvent("click", function(){
				if(list_actual == links_pages_amount - 1) list_actual = 0;
				else list_actual++;
				link_scroller.start(list_actual * links_block_width, 0);
				
				if(Browser.Engine.presto){
 					new Fx.Tween(module.getElements('.nsp_link_scroll2')[0], {duration:$G['animation_speed'], wait:false}).start('margin-left', -1 * list_actual * links_block_width);	
				}
				
				nsp_art_list(list_actual, module, 'bottom', links_pages_amount);
				nsp_art_counter(list_actual, module, 'bottom', links_pages_amount);
			});
		}
		
		if(auto_anim){
			(function(){
				if(module.getElement('.nsp_top_interface .next')){
					if(animation) module.getElement('.nsp_top_interface .next').fireEvent("click");
				}else{
					if(arts_actual == pages_amount - 1) arts_actual = 0;
					else arts_actual++;
					art_scroller.start(arts_actual * arts_block_width, 0);
					
					if(Browser.Engine.presto){
				 		new Fx.Tween(module.getElements('.nsp_art_scroll2')[0], {duration:$G['animation_speed'], wait:false}).start('margin-left', -1 * arts_actual * arts_block_width);	
					}
					nsp_art_list(arts_actual, module, 'top');
					nsp_art_counter(arts_actual, module, 'top', pages_amount);
				}
			}).periodical($G['animation_interval']);
		}
	});
	
	function nsp_art_list(i, module, position){
		if(module.getElement('.nsp_'+position+'_interface .pagination')){
			module.getElement('.nsp_'+position+'_interface .pagination').getElements('li').setProperty('class', '');
			module.getElement('.nsp_'+position+'_interface .pagination').getElements('li')[i].setProperty('class', 'active');
		}
	}
	
	function nsp_art_counter(i, module, position, num){
		if(module.getElement('.nsp_'+position+'_interface .counter')){
			module.getElement('.nsp_'+position+'_interface .counter span').innerHTML =  (i+1) + ' / ' + num;
		}
	}
});