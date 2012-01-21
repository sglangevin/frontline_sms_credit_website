var TimeSpinner = new Class({	
	Implements: [Events, Options],

	version: 0.4,

	options : {
		increment: 15,
		separator: ':',
		range: {
			low: -1,
			high: -1
		},
		delay: 200,
		alarm: [],
		'doAlarm': Class.empty
	},

	initialize: function(obj, options, date) {
		if (!obj) { return false; }
		
		if( $defined( options ) ) {
			this.setOptions(options);
		}

		this.timespinner = obj;
		this.timespinner.disabled = false;
		this.timespinner.readonly = false;
//		this.timespinner.addClass('timespinner');
		
		this.date = new Date();
		if( $defined( date ) ) {
			if( date instanceof Date ) {
				this.date = date;
			} else {
				var m = date % 60;
				this.date.setMinutes( m );
				this.date.setHours( (date - m)/60 );
			}
		}
		this.doaction = '';

		var bp = new Element('button', { 'type': 'button' }).addClass('timespinner_plus').injectAfter(obj);
		bp.addEvent('mousedown', function() {this.doStart('inc'); }.pass('inc', this) );
		bp.addEvent('mouseup', function() {this.doStop(); }.pass('', this) );

		bp = new Element('button', { 'type': 'button' }).addClass('timespinner_minus').injectAfter(obj);
		bp.addEvent('mousedown', function() {this.doStart('dec'); }.pass('dec', this));
		bp.addEvent('mouseup', function() {this.doStop(); }.pass('', this) );

		this.fixTime();

		this.addEvent(
			'doclick', function() {
				switch( this.doaction ) {
					case 'inc' : 
						this.incTime();
						break;
					case 'dec' :
						this.decTime();
						break;
					case 'cancel' :
						this.doaction = '';
						return;
					default:
						return;
				}
	
				this.fireEvent( 'doclick', '', this.options.delay );
			}
		);

//		this.addEvent( 'doChange', this.options.doChange);
		this.addEvent( 'doAlarm', this.options.doAlarm);
	},

	doStart: function(todo) {
		this.doaction = todo;
		this.fireEvent( 'doclick', "", 0 );
	},
	doStop: function() {
		this.doaction = 'cancel';
	},

	setTime: function( val ) {
		if( val instanceof Date ) {
			this.date = val;
		} else {
			this.date.setTime( val );
		}	
		this.fixTime();	
	},
	getTime: function()  {
		return( this.date );
	},

	setInc: function( val ) {
		this.options.increment = val;
		this.fixTime();
	},
	getInc: function( val ) {
		return(this.options.increment);
	},

	fixTime: function() {
		var m = this.date.getMinutes();	
		this.date.setMinutes( m - (m % this.options.increment) );

		if( this.options.range.high > -1 ) {
			var t = this.date.getHours()*60 + this.date.getMinutes();
			if( t >= this.options.range.high ) {
				var n  = this.options.range.high % 60;
				this.date.setMinutes( n );
				this.date.setHours( (this.options.range.high - n)/60 ); 
			}
		}

		if( this.options.range.low > -1 ) {
			var t = this.date.getHours()*60 + this.date.getMinutes();
			if( t <= this.options.range.low ) {
				var n  = this.options.range.low % 60;
				this.date.setMinutes( n );
				this.date.setHours( (this.options.range.low - n)/60 ); 
			}
		}

		var h = this.date.getHours();
		m = this.date.getMinutes();
		this.timespinner.value =  (h<10 ? "0" : "") + h + this.options.separator + (m<10 ? "0" : "") + m;

		var t = this.date.getHours()*60 + this.date.getMinutes();
		this.options.alarm.each( function(val) {
			if( val == t ) {
				this.fireEvent('doAlarm', {who:this.timespinner.id,time:val}, 0 );
			}
		}, this);
	},

	incTime: function( val ) {
		if( $defined( val ) == false  ) {
			val = this.options.increment;
		}
		this.date.setTime( this.date.getTime() + (val*60000) );
		this.fixTime();
	},
	decTime: function( val ) {
		if( $defined( val ) == false  ) {
			val = this.options.increment;
		}
		this.date.setTime( this.date.getTime() - (val*60000) );
		this.fixTime();
	}
});

TimeSpinner.implement(new Events, new Options);
