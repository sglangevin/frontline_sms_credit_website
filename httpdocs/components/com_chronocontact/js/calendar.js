/*
 * Calendar Emoxion
 * with Mootools
 * Manuel Garcia (thekeeper)
 * http://www.mgarcia.info
 * Version 0.2
 *
 * Copyright (c) 2007 Manuel Garcia
 * http://www.opensource.org/licenses/mit-license.php
 */

window.addEvent('domready', function() {
	$$('input.ncalendar').each(function(el){
    el.addEvent('click', function(event) {
				new Calendar(el);
			});
	});
});

var Calendar = new Class({
    initialize: function(el,open,Config) {
   this.input = $(el);
			var lng = new Object();

			// Firefox? IE ?
			try {  var nav = navigator.language.substr(0,2); }
			catch (e)	{ var nav = navigator.userLanguage;}

			lng['en'] = {
      	month : ['January','February','March','April','May','June','July','August','September','October','November','December'],
      	day : ['S','M','T','W','T','F','S'],
      	first: 0 // First day of week => Monday
			}
      lng['es'] = {
      	month : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
      	day : ['L','M','M','J','V','S','D'],
      	first: 1 // First day of week => Monday
			};
			lng['pl'] = {
      	month : ['Styczen', 'Luty', 'Marzec', 'Kwiecien', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpien', 'Wrzesien', 'Pazdziernik', 'Listopad', 'Grudzien'],
				day : ['P','W','S','C','P','S','N'],
				first: 1 // Sunday
      }
      lng['nl'] = {
      	month : ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
      	day : ['M','D','W','D','V','Z','Z'],
      	first: 1 // Monday
      }
                
			lng = (!lng[nav])? lng['en'] : lng =  lng[nav] ;
      /* configuration */
      if (!Config)
	      this.config = {
						Lng: lng,
					  imgNext: 'components/com_chronocontact/css/img/next.gif',
					  imgPrev: 'components/com_chronocontact/css/img/prev.gif',
					  imgCancel: 'components/com_chronocontact/css/img/close.gif',
					  maxDate: new Date('01/01/2099'),
					  minDate: new Date('01/01/1222'),
					  format: 'd/m/y'
				};

      this.month_name = this.config.Lng.month;
      this.day_name =  this.config.Lng.day;
			this.create_calendar();
    },
    create_calendar: function() {

     var position = this.input.getCoordinates();
     if ($('ncalendar')) $('ncalendar').remove();
      // content div  //
      this.div = new Element('div')
      .setStyles({'top':(position.top+position.height)+'px', 'left':(position.left)+'px'}).setProperty('id', 'ncalendar').injectInside(document.body);
      this.div.makeDraggable();
      this.nav();
      this.setdate(this.input.getProperty('value'));
			this.effect(this.div,'show');
		} ,
		nav: function (today) {
		  // nav
      this.calendardiv = new Element('div').injectInside(this.div).addClass('cf_calheader')
      this.title = new Element('span').injectInside(this.calendardiv).addClass('month');
      // next month
      this.next = new Element('img').setProperty('src', this.config.imgNext).injectAfter(this.title);
      // before month
      this.before = new Element('img').setProperty('src', this.config.imgPrev).injectBefore(this.title);
			// close
			this.close = new Element('img').setProperty('src', this.config.imgCancel).injectAfter(this.next);
			// table
			this.table = new Element('table').injectInside(this.div);
			var thead = new Element('thead').injectInside(this.table);
   		var tr = new Element('tr').injectInside(thead);

      this.day_name.each(function (day) {
				var td = new Element('th').appendText(day).injectInside(tr);
			});

			var localThis = this;
			this.close.addEvent('click', function(e) {
          localThis.div.remove();
  		});
		},
		setdate : function(date) {
			// reset event nav
			this.next.removeEvents('click');
			this.before.removeEvents('click');

			if (!this.validate_date(date)) {
        this.today = new Date();
		    this.today.setDate(1);
      } else {
      	var dateinp = date.split('/');
    		this.today = new Date(dateinp[2],dateinp[1]-1,dateinp[0],0,0,0);
			}

      this.next_m = this.today.getMonth();
      this.next_m++;

      this.title.innerHTML = this.month_name[this.today.getMonth()]+' ' + this.today.getFullYear();
           
      this.title.addEvent('click', function (e) {
        if ($('listYear')) $('listYear').remove();
        var div = new Element('div').injectAfter(localThis.title).setProperty('id','listYear');
        var date = localThis.today;
        var ul = new Element('ul').injectInside(div);
      
        for (var a=(date.getFullYear()-2); a<= (date.getFullYear()+2);a++) {
          var li = new Element('li').setHTML(a).injectInside(ul)
          .setProperty('id',a)
          .addEvent('click', function (e) {
            localThis.tbody.remove();
            localThis.setdate(date.getDate()+'/'+date.getMonth()+'/'+this.getProperty('id'));
            div.remove();
          });
        }
        localThis.effect(div,'show');
      });
  		var localThis = this;

			// event next
			
			if (this.today < this.config.maxDate ) {
  			this.next.addEvent('click', function(e) {
            var date = localThis.today;
       	    date.setMonth(localThis.next_m+1,1);
  	        localThis.tbody.remove();
            localThis.setdate(date.getDate()+'/'+date.getMonth()+'/'+date.getFullYear());
    		});
  		}
  		// event before
  		if (this.today > this.config.minDate ) {
  			this.before.addEvent('click', function(e) {
            var date = localThis.today;
       	    date.setMonth(localThis.next_m-1,1);
            localThis.tbody.remove();
            localThis.setdate(date.getDate()+'/'+date.getMonth()+'/'+date.getFullYear());
    		});
  		}
			var LastMonth = new Date(this.today.getFullYear(),this.next_m-2,1,0,0,0);

			var last = LastMonth.getMonth();
			// total days the last month
			var counter = 0;
			for (var b = 1; b <= (30 +  this.config.Lng.first); b++) {
			  LastMonth.setDate(b);
 				if ( LastMonth.getMonth() == last) {
 				  counter++;
 				}
			}

			this.tbody = new Element('tbody').injectInside(this.table);
			var first_day = this.today;
			var last_day = this.today;
			this.month = this.today.getMonth();
   		var tr = new Element('tr').injectInside(this.tbody);

  		var day=0;

			/* first day week */
			first_day.setDate(1);
			var rest = (!first_day.getDay())? 6: first_day.getDay()-1;
			counter = counter - rest;
			for (var i= this.config.Lng.first; i <= 6; i++) {
			   if (first_day.getDay() == i) {
			    break;
      	 } else {
					counter++;
					LastMonth.setDate(counter);
					if (LastMonth.getMonth() == this.today.getMonth()) LastMonth.setMonth(this.today.getMonth()-1);
      	  this.create_td(tr,counter,LastMonth,'noday');
        }
   		}
			(this.config.Lng.first)? brea_k = 1:brea_k = 0;
   /* everydays */
      var date_s = this.today;
      var class_Css;
      var brea_k; // breaking week
  	  var daycounter = 0;
     	for (var i = 1; i <= 30; i++) {
    		date_s.setDate(i);
 				if (date_s.getMonth() == this.month) {
       		daycounter++;
		      if (date_s.getDay() == brea_k) {
						var tr = new Element('tr').injectInside(this.tbody);
					}
          class_Css = (!date_s.getDay())? 'sunday' : '';
					this.create_td(tr,i,date_s,class_Css);
				}
			}
			  this.today.setMonth(this.month);
       	this.today.setDate(daycounter);
       	var NextMonth = new Date(this.today.getFullYear(),this.today.getMonth()+1,1,0,0,0);
		    // finish month
			  var num = date_s.getDay();
			  num = (brea_k)? 7 - num: 6 - num;
			  var b;
			  b = (brea_k)? 0 : 6 ;
        if (this.today.getDay() != b) {
				  for (var i= 1; i <= (num); i++) {
				      NextMonth.setDate(i);
							this.create_td(tr,i,NextMonth,'noday');
					}
    		}
			this.effect(this.tbody,'show');
    },
		create_td: function(tr,i,date,class_Css) {
        var localThis = this;
				var td = new Element('td');
				if (date) {
				  var day = date.getDate();
				  var month = (date.getMonth()+1);
				  //  9 to 09 or another number <= 9
				  if (day <= 9) day = "0"+ day;
				  if (month <= 9) month = "0"+ month;
          var ft = localThis.config.format;	  
          
          var tddate = ft.replace('d',day);
				  tddate = tddate.replace('m',month);
				  tddate = tddate.replace('y',date.getFullYear());
				  
        	td.setProperty('id', tddate);
        }
       
        if (this.config.minDate < date) {
          if (this.config.maxDate > date) {
          td.addEvent('click', function(e) {
         			 localThis.input.value = this.id;
  						 localThis.effect(localThis.div,'fade');
  						 localThis.div.remove();
    			});
    			} else {
            td.addEvent('click', function(e) {
         			alert('Max. Date ' + localThis.config.maxDate);
    			});
          }
  			} else {
          td.addEvent('click', function(e) {
         			alert('Min. Date ' + localThis.config.minDate);
    			});
        }
  			td.addEvent('mouseover', function(e) {
						 this.addClass('dayselected');
  			});
  			td.addEvent('mouseout', function(e) {
						 this.removeClass('dayselected');
  			});

    		if (class_Css) td.addClass(class_Css);
    		// Today ??
    		var today = new Date();
				today = today.getDate() + "/" + (today.getMonth()+1) + "/" + today.getFullYear();
				if (date) var date_td = date.getDate() + "/" + (date.getMonth()+1) + "/" + date.getFullYear();
				if (today == date_td) td.addClass('isToday');

  		  td.appendText(i);
				td.injectInside(tr);
		},
		effect: function(div,op) {
		  var ef = new Fx.Style(div, 'opacity', {
				duration: 500,
				transition: Fx.Transitions.quartInOut
			});
			(op == 'fade')? ef.start(1,0): ef.start(0,1);
		},
		validate_date: function (date) {
		  		var regex = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
		  		return date.test(regex);
		}
});
