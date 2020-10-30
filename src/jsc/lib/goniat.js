// jQuery overrides and extensions

$.widget( "ui.autocomplete", $.ui.autocomplete, {
	options: {params: {}, prefixHi: true, setValue: true, getLabel: function(item) {return item.label;}},
	_search: function( value ) {
		this.pending++;
		this.element.addClass( "ui-autocomplete-loading" );
		this.cancelSearch = false;
		$.extend( this.options.params , { term: value } );
		this.source( this.options.params , this._response() );
	},
	_renderItem: function( ul, item ) {
		return $( "<li>" )
			.append(
				$( "<a>" ).html(
					this.options.getLabel(item).replace(
						new RegExp((this.options.prefixHi ? '^(' : '(') + $.ui.autocomplete.escapeRegex(this.term) + ')', 'i'),
						'<span class="ui-autocomplete-queried">$1</span>'
					)
				)
			)
			.appendTo( ul );
	},
	_value: function() {
		if (this.options.setValue == true || arguments.length == 0)
			return this.valueMethod.apply( this.element, arguments );
		return this.valueMethod.apply( this.element );
	},

});

$.fn.watch = function(props, func, interval, id) {
    /// <summary>
    /// Allows you to monitor changes in a specific
    /// CSS property of an element by polling the value.
    /// when the value changes a function is called.
    /// The function called is called in the context
    /// of the selected element (ie. this)
    /// </summary>    
    /// <param name="prop" type="String">CSS Property to watch. If not specified (null) code is called on interval</param>    
    /// <param name="func" type="Function">
    /// Function called when the value has changed.
    /// </param>    
    /// <param name="func" type="Function">
    /// optional id that identifies this watch instance. Use if
    /// if you have multiple properties you're watching.
    /// </param>
    /// <param name="id" type="String">A unique ID that identifies this watch instance on this element</param>  
    /// <returns type="jQuery" /> 
    if (!interval)
        interval = 200;
    if (!id)
        id = "_watcher";

    return this.each(function() {
        var _t = this;
        var el = $(this);
        var fnc = function() { __watcher.call(_t, id) };
        var itId = null;

        if (this.attachEvent)
            el.bind("propertychange." + id, fnc);
        else if (this.addEventListener)
            el.bind("DOMAttrModified." + id, fnc);
        else
            itId = setInterval(fnc, interval);

        var data = { id: itId,
            props: props.split(","),
            func: func,
            vals: []
        };
        $.each(data.props, function(i) { data.vals[i] = el.css(data.props[i]); });
        el.data(id, data);
    });

    function __watcher(id) {
        var el = $(this);
        var w = el.data(id);

        var changed = false;
        var i = 0;
        for (i; i < w.props.length; i++) {
            var newVal = el.css(w.props[i]);
            if (w.vals[i] != newVal) {
                w.vals[i] = newVal;
                changed = true;
                break;
            }
        }
        if (changed && w.func) {
            var _t = this;
            w.func.call(_t, w, i)
        }
    }
}
$.fn.unwatch = function(id) {
    this.each(function() {
        var w = $(this).data(id);
        var el = $(this);
        el.removeData();

        if (this.attachEvent)
            el.unbind("propertychange." + id, fnc);
        else if (this.addEventListener)
            el.unbind("DOMAttrModified." + id, fnc);
        else
            clearInterval(w.id);
    });
    return this;
}

function callAction(action,data,success,error)
{
	$.getJSON(action + ".act.html",
		data,
		function (response) {
			if (response.status === "success") {
				if (response.msg !== undefined) {
					$("<p>").html(response.msg).dialog({
						modal: true,
						title: "Operation succeeded",
						buttons: {
							Ok: function() {$(this).dialog("close");}
						},
						close: function() {
							if (response.url !== undefined)
								window.location.replace(response.url);
							else if (success !== undefined)
								success(response);
						}
					});
				}
				else if (response.url !== undefined)
					window.location.replace(response.url);
				else if (success !== undefined)
					success(response);

			}
			else if (response.status === "error") {
				if (response.msg !== undefined) {
					$("<p>").html(response.msg).dialog({
						modal: true,
						title: "Operation failed",
						buttons: {
							Ok: function() {$(this).dialog("close");}
						},
						close: function() {
							if (response.url !== undefined)
								window.location.replace(response.url);
							else if (error !== undefined)
								error(response);
						}
					});
				}
				else if (response.url !== undefined)
					window.location.replace(response.url);
				else if (error !== undefined)
					error(response);
			}
		}
	);
}

function dialogOkCancel(title,msg,callbackOk)
{
	$("<p>").html(msg).dialog({
		title: title,
		modal: true,
		buttons: {
			Ok: function() {
				$(this).dialog("close");
				callbackOk();
			},
			Cancel: function() {
				$(this).dialog("close");
			}
		}
	});	
}
