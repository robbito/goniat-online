/**
 * Restrict options of a combo box to values below a given value
 *
 * @access public
 * @param el DOM element
 * @return void
 **/
function setOptions(src,el,value)
{
	el.find("option").remove();
	$("<option>").val(-1).appendTo(el);
	$.each(	src.get(0).options,
			function(i,val) {
				if (val.value < value) 
					$(val).clone().appendTo(el); 
			} );
    // Correct the selected value if necessary
    if (el.val() >= value) {
        el.val(-1);
        el.change();
    }
}

/**
 * Event handler for field taxType1
 *
 * @access public
 * @return void
 **/
function onChangeTax1()
{
	var value = $("#taxType1").val();
	// Set variables in completer objects for taxName1 and taxName2
	$("#taxName1").data("ui-autocomplete").options.params.type = value;
	$("#taxName2").data("ui-autocomplete").options.params.parType = value;
	// Reset taxName1 value
	$("#taxName1").val("");
	// Adjust visibility of fields according to selected type
	if (value === -1) { // no selection
		$("#tax2").hide();
		$("#tax3").hide();
		$("#taxName1").prop("disabled",true);
		$("#taxName2").val("");
		$("#taxName2").prop("disabled",true);
		$("#taxName3").val("");
		$("#taxName3").prop("disabled",true);
	}
	else if (value === 0) { // Species
		$("#tax2").hide();
		$("#tax3").hide();
		$("#taxName1").prop("disabled",false);
		$("#taxName2").prop("disabled",true);
		$("#taxName3").val("");
		$("#taxName3").prop("disabled",true);
	}
	else {
		$("#tax2").show();
		$("#taxName1").prop("disabled",false);
		setOptions($("#taxType1"),$("#taxType2"),value);
	}
}

/**
 * Event handler when leaving taxName1
 *
 * @access public
 * @return void
 **/
function onLeaveTax1()
{
	var value = $("#taxName1").val();
	// Set parentValue parameter in completer for taxName2
	$("#taxName2").data("ui-autocomplete").options.params.parValue = value;
}

/**
 * Event handler for taxName2
 *
 * @access public
 * @return void
 **/
function onChangeTax2()
{
	var value = $("#taxType2").val();
	// Set variables in completer objects for taxName2 and taxName3
	$("#taxName2").data("ui-autocomplete").options.params.type = value;
	$("#taxName3").data("ui-autocomplete").options.params.parType = value;
	// Reset value in taxName2
	$("#taxName2").val("");
	// Set visibility of taxName3 according to selection
	if (value === "-1") { // no selection
		$("#tax3").hide();
		$("#taxName2").prop("disabled",true);
	}
	else if (value === "0") { // Species
		$("#tax3").hide();
		$("#taxName2").prop("disabled",false);
	}
	else {
		$("#tax3").show();
		$("#taxName2").prop("disabled",false);
		setOptions($("#taxType2"),$("#taxType3"),value);
	}
}

/**
 * Event handler when leaving taxName2
 *
 * @access public
 * @return void
 **/
function onLeaveTax2()
{
	var value = $("#taxName2").val();
	// Set variable for taxName3 completer
	$("#taxName3").data("ui-autocomplete").options.params.parValue = value;
}

/**
 * Event handler when changing taxType3
 *
 * @access public
 * @return void
 **/
function onChangeTax3()
{
	var value = $("#taxType3").val();
	// Set variable for completer of taxName3
	$("#taxName3").data("ui-autocomplete").options.params.type = value;
	// Reset value of taxName3
	$("#taxName3").val("");
	// Set status of taxName3 according to selection
	$("#taxName3").prop("disabled",value === "-1");
}

/**
 * Event handler when leaving loBoundTax
 *
 * @access public
 * @return void
 **/
function onLeaveLoBoundTax()
{
	var value = $("#loBoundTax").val();
	// Set variable for upBound completer
	$("#upBoundTax").data("ui-autocomplete").options.params.loBound = value;
}

/**
 * Event handler when leaving loBoundLoc
 *
 * @access public
 * @return void
 **/
function onLeaveLoBoundLoc()
{
	var value = $("#loBoundLoc").val();
	// Set variable for upBound completer
	$("#upBoundLoc").data("ui-autocomplete").options.params.loBound = value;
}

/**
 * Event handler when leaving author1
 *
 * @access public
 * @return void
 **/
function onChangeAut1()
{
	var value = $("#author1").val();
	// Set status of author2 according to value
	$("#author2").prop("disabled",(value === "") ? true : false);
}

/**
 * Event handler when selecting an entry from the author1 completer
 *
 * @access public
 * @return void
 **/
function onSelectAut1(event, ui){
	// Memorizes author id from the completer list in the hidden form field author1id
	$("#author1id").val(ui.item ? ui.item.id : "");
}

/**
 * Event handler when selecting an entry ftom the author2 completer
 *
 * @access public
 * @return void
 **/
function onSelectAut2(event, ui){
	// Memorizes author id from the completer list in the hidden form field author2id
	$("#author2id").val(ui.item ? ui.item.id : "");
}

/**
 * Event handler when geo1Type
 *
 * @access public
 * @return void
 **/
function onChangeGeo1()
{
	var value = $("#geoType1").val();
	// Set the completer variable for the corresponding name field to the geo type value
	$("#geoName1").data("ui-autocomplete").options.params.type = value;
	// Set the completer variable 'parent type' for the name field in the next level to the geo type value
	$("#geoName2").data("ui-autocomplete").options.params.parType = value;
	$("#geoName1").val("");
	// Set visibility of fields according to selection
	if (value === "-1") { // no selection
		$("#geo2").hide();
		$("#geo3").hide();
		$("#geoName1").prop("disabled",true);
		$("#geoName2").val("");
		$("#geoName2").prop("disabled",true);
		$("#geoName3").val("");
		$("#geoName3").prop("disabled",true);
	}
	else if (value === "0") { // layer
		$("#geo2").hide();
		$("#geo3").hide();
		$("#geoName1").prop("disabled",false);
		$("#geoName2").prop("disabled",true);
		$("#geoName3").val("");
		$("#geoName3").prop("disabled",true);
	}
	else { // all other
		$("#geo2").show();
		$("#geoName1").prop("disabled",false);
		setOptions($("#geoType1"),$("#geoType2"),value);
	}
}

/**
 * Event handler when leaving geoName1
 *
 * @access public
 * @return void
 **/
function onLeaveGeo1()
{
	var value = $("#geoName1").val();
	// Set variable in the completer of the next level
	$("#geoName2").data("ui-autocomplete").options.params.parValue = value;
}

/**
 * Event handler when changing geoType2
 *
 * @access public
 * @return void
 **/
function onChangeGeo2()
{
	var value = $("#geoType2").val();
	// Set completer variable for the corresponding name field
	$("#geoName2").data("ui-autocomplete").options.params.type = value;
	// Set completer variable for the name field in the next level
	$("#geoName3").data("ui-autocomplete").options.params.parType = value;
	$("#geoName2").val("");
	if (value === -1) { // no selection
		$("#geo3").hide();
		$("#geoName2").prop("disabled",true);
	}
	else if (value === 0) { // layer
		$("#geo3").hide();
		$("#geoName2").prop("disabled",false);
	}
	else { // all other
		$('#geo3').show();
		$("#geoName2").prop("disabled",false);
		setOptions($("#geoType1"),$("#geoType3"),value);
	}
}

/**
 * Event handler when leaving geoName2
 *
 * @access public
 * @return void
 **/
function onLeaveGeo2()
{
	var value = $("geoName2").val();
	// Memorize the value in the completer varaible of the next level
	$("#geoName3").data("ui-autocomplete").options.params.parValue = value;
}

/**
 * Event handler when changing geoType3
 * @access public
 * @return void
 **/
function onChangeGeo3()
{
	var value = $("#geoType3").val();
	// Memorize the type in the corresponding completer
	$("#geoName3").data("ui-autocomplete").options.params.type = value;
	// Set geoName3 and disable/enable
	$("#geoName3").val("");
	$("#geoName3").prop("disabled",value === "-1");
}

/**
 * Toogle a group in a search tab
 *
 * @access public
 * @param event
 * @return void
 **/
function toggleGroup(event)
{
	var group = $(this.parentNode.parentNode);
	if (group.hasClass("exclusive")) {
		// When its an exclusive group
		if (group.hasClass("collapsed")) {
			// and was collapsed before
			// Collapse all groups
			$("div.group").addClass("collapsed");
			$("input.searchActive").val(false);
		}
	}
	else {
		//When its not exclusive, collapse only exclusive groups
		$("div.exclusive").addClass("collapsed");
	}
	// Toggle the collapsed class assignment
	group.toggleClass("collapsed");
	// Set the hidden form field accordingly
	$("#" + group.attr("id") + "Active").val(group.hasClass("collapsed") ? "false" : "true");
}

/**
 * Initilize tax form
 *
 * @access public
 * @return void
 **/
function taxFormInit()
{
    // Initialize groups
    $("div.group div.status").click(toggleGroup);
    // Initialize widgets in taxonomy group
    // Set up fields
    // TaxType1
    $("#taxType1")
		.change(onChangeTax1)
		.val(3);
    // TaxName1
    $("#taxName1")
		.autocomplete({source: "completeCat.html",minLength: 2,params: {type: 3}})
		.blur(onLeaveTax1)
		.val("");
    // TaxType2
    $("#taxType2")
		.change(onChangeTax2)
		.val(-1);
    setOptions($("#taxType1"),$("#taxType2"),3);
    // TaxName2
    $("#taxName2")
		.autocomplete({source: "completeCat.html",minLength: 0,params: {parType: 3}})
		.blur(onLeaveTax2)
		.val("");
    // TaxType3
    $("#taxType3").change(onChangeTax3);
    // TaxName3
    $("#taxName3")
		.autocomplete({source: "completeCat.html",minLength: 0})
		.val("");
    // prepare combo boxes
    // Initialize widgets in stratigraphy group
	// LoBound
	$("#loBoundTax")
		.autocomplete({source: "completeStrat.html",prefixHi: false})
		.blur(onLeaveLoBoundTax);
	// UpBound
	$("#upBoundTax").autocomplete({source: "completeStrat.html",prefixHi: false});
}

/**
 * Initilize lit form
 *
 * @access public
 * @return void
 **/
function litFormInit()
{
    // Initialize groups
    $("div.group div.status").click(toggleGroup);
    // Initialize widgets in authors group
    $("#author1").keyup(onChangeAut1);
	// Author1
	$("#author1").autocomplete({source: "completeAut.html", select: onSelectAut1});
	$("#author2").autocomplete({source: "completeAut.html", select: onSelectAut2});
}

/**
 * Initilize loc form
 *
 * @access public
 * @return void
 **/
function locFormInit()
{
    // Initialize groups
    $("div.group div.status").click(toggleGroup);
    // Initialize widgets in taxonomy group
	// GeoType1
    $("#geoType1")
		.change(onChangeGeo1)
		.val(3);
	// GeoName1
	$("#geoName1")
		.autocomplete({source: "completeGeo.html",minLength: 2,params: {type: 3}})
		.blur(onLeaveGeo1)
		.val("");
	// GeoType2
    $("#geoType2")
		.change(onChangeGeo2)
		.val(-1);
    setOptions($("#geoType1"),$("#geoType2"),3);
	// GeoName2
	$("#geoName2")
		.autocomplete({source: "completeGeo.html",minLength: 0,params: {parType: 3}})
		.blur(onLeaveGeo2)
		.val("");
	// GeoType3
    $("#geoType3").change(onChangeGeo3);
	// GeoName3
	$("#geoName3").autocomplete({source: "completeGeo.html",minLength: 0}).val("");
	// LoBound
	$("#loBoundLoc")
		.autocomplete({source: "completeStrat.html",prefixHi: false})
		.blur(onLeaveLoBoundLoc);
	// UpBound
	$("#upBoundLoc").autocomplete({source: "completeStrat.html",prefixHi: false});
}


/**
 * Initilize the selected form
 *
 * @access public
 * @param event Event object
 * @param ui jQuery Ui object
 * @return void
 **/
function formInit(event,ui)
{
    switch (ui.tab.attr("id")){
        case "searchFormTax":
            taxFormInit();
            break;
        case "searchFormLit":
            litFormInit();
            break;
        case "searchFormLoc":
            locFormInit();
            break;
    } // switch
}

$(function() {
    $(".tabs").tabs({load: formInit});
});