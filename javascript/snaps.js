// This is indexOf definition for IE6
// See: http://www.tutorialspoint.com/javascript/array_indexof.html

(function() {
	if (!Array.prototype.indexOf)
	{
	  Array.prototype.indexOf = function(elt /*, from*/)
	  {
	    var len = this.length;

	    var from = Number(arguments[1]) || 0;
	    from = (from < 0)
	         ? Math.ceil(from)
	         : Math.floor(from);
	    if (from < 0)
	      from += len;

	    for (; from < len; from++)
	    {
	      if (from in this &&
	          this[from] === elt)
	        return from;
	    }
	    return -1;
	  };
	}
})();

// Snaps is a native, fast event implemetation
// System cover browser events (onload, mouse events, ready) and cunstom events both
(function($) {
	var Stack = function(stack) {
		if(stack instanceof Array)	{			
			Array.prototype.push.apply(this, stack);
		}
			
		return this;
	};
	
	window.Stack = Stack;
	
	Stack.prototype = new Array();
	
	var push = Array.prototype.push, slice = Array.prototype.slice;
	
	$.extend(Stack.prototype, {
		length: 0,
		
		Push: function(element, position) {
			var stack = slice.call(this, 0, this.length);
			
			this.length = 0;
			
			position = position != undefined ? position : -1;
			
			if(position > stack.length) position = stack.length;
			
			if(position < 0) position = stack.length - position + 1;
			
			if(position == 0) {
				push.call(this, element);
				
				if(stack.length > 0) push.apply(this, stack);
			}
			
			else {
				push.apply(this, slice.call(stack, 0, position));
				push.call(this, element);
				push.apply(this, slice.call(stack, position, stack.length));
			}
			
			
			return this;
		},
		
		clear: function() {
			while(this.length > 0) this.pop();
		},
		
		remove: function(option) {
			var position = (typeof option == "number") ?
				option :
				this.indexOf(option);
				
			if(position < 0) return true;
			
			if(position > this.length) return true;
			
			var stack = this.buildArray();
			
			this.length = 0;
			
			push.apply(this, slice.call(stack, 0, position));
			push.apply(this, slice.call(stack, position + 1, stack.length));
		},
		
		// adds element before element at position in argument or element in argument
		before: function(position) {
			
			if (typeof position != "number") {
				position = this.indexOf(option);
				
				if(position < 0) {
					return false;
				}
			}
			
			else if(position > this.length)
				return false;
				
			else if(position < 0){
				if(position > this.length + 1) 
					return false;
					
				position = this.length - position + 1;
				
				
			}
			
				
			
			var stack = this.buildArray();
			
			
		},

		after: function(element) {

		},
		
		has: function(element) {

		},
		
		position: function(element) {

		},	
		
		next: function() {

		},
		
		reset: function() {
			
		},
		
		actually: function() {
			
		},
		
		
		buildArray: function(){
			return slice.call(this, 0, this.length);
		}
	});
	
	Stack.prototype.push = Stack.prototype.Push;
	
	Stack.prototype.constructor = Array;
	
	
	var snaps = {}; // private 
	
	var Flick = function(Snap, async, base) {
		this.time = (new Date()).getTime();
		this.current = null;
		this.snap = Snap;
		this.base = base || {};
		
		snaps[Snap].queue = [];
		
		var flick = this,
			snap = snaps[Snap];
		
		var flicking = function() {
			var l = snap.stack.length, 
				subject, 
				i = -1;
			
			snap.loading = true;
			
			while(++i < l && !flick.holded) {
				this.current = subject = snap.stack[i];
				
				snap.current = i;
				
				subject.call(this.base, flick);
			}
		};
		
		if(async) 
			setTimeout(flicking, 0);
		else
			flicking.call();
	};
	
	Flick.prototype = {
		
		hold: function() {
			this.holded = true;
		},
		
		release: function() {
			var snap = snaps[this.snap];
			
			if(!this.holded) {
				warn("Snap is not stopped!");
				return;
			}

			if(snap.current >= snap.stack.length) {
				warn("already done flick");
			}
			
			this.holded = false;
			
			while(++snap.current < snap.stack.length && !this.holded) {
			
				this.snap.current = subject = snap.stack[snap.current];
				
				subject.call(this.base, this);
			}
		},
		
		howOld: function() {
			return (new Date()).getTime() - this.time;
		}
	}
	
	var Snap = function(name) {
		this.name = name;
		snaps[this] = {stack: new Stack(), owners: [], queue: [], currents: new Stack()};
	};
	
	Snap.prototype = {
		name: null,
		
		flick: function(async) {
			if(!this.can(true)) return;
			
			return new Flick(this, async);
			
		},
		
		front: function(func) {
			if(this.can(true))
				snaps[this].stack.push(func, 0);
		},
		
		somewhere: function(func) {
			if(this.can(true))
				snaps[this].stack.indexOf(func) >= 0;
		},
		
		watch: function(func) {
			if(!this.can(true)) return;
			
			snaps[this].stack.push(func);
		},
		
		end: function(func) {
			snaps[this].push(func, 0);
		},
		
		take: function(func) {
			if(this.can(true))
				snaps[this].owners.push(arguments.callee.caller);
		},
		
		pass: function(func) {
			if(this.can(true))
				snaps[this].owners.push(func);
		},
		
		can: function(indirectly) {
			if(snaps[this].owners.length < 1) return true;
			
			var caller;
			
			if(typeof inderectly == "function" ) {
				caller = inderecly;
			} else {
			    caller = indirectly === true ? 
					arguments.callee.caller.caller : 
					arguments.callee.caller;
			}
			
			return snaps[this].owners.indexOf(caller) >= 0
		},
		
		freeze: function() {
			snaps[this].holded = true;
			snaps[this].freezed = true;
		},
		
		hold: function() {
			snaps[this].holded = true;
			//this.current && this.current.hold();
		}
	};
	
	// $.snaps = Class.construct("join").static( <-- Class module not ready
	var Snaps = function(first, second) {
		
		if(typeof first == "string" && typeof first == "function") {
			return Snaps
		}
	
	};
	
	$.extend(Snaps, {
		snaps: {},
		
		when: function(snap, listener, before) {
		},
		
		snap: function(name) {
			
		},
		
		forget: function(name, callback) {
			
		},
		
		take: function(name, who) {
			who = who || arguments.callee.caller;
		}
	});
	
	window.Snaps = Snaps.prototype = Snaps;
	
})(jSimply);