/**
 * Configuration for class
 * 
 * @type object
 */

var config = {
	saveNotesAction: 'saveLocNotes',
	saveBasicAction: 'saveLocBasic',
	removeDetailsAction: 'removeLocDetails',
	basicForm: 'locBasicForm'
};

/**
 * Event handler when leaving loBoundLoc
 *
 * @access public
 * @return void
 **/

function onLeaveLoBound()
{
	var value = $("#loBoundTxt").val();
	// Set variable for upBound completer
	$("#upBoundTxt").data("ui-autocomplete").options.params.loBound = value;
}

/**
 * Event handler when selecting an entry from the loBound completer
 *
 * @access public
 * @return void
 **/
function onSelectLoBound(event, ui){
	// Memorizes Bound id from the completer list in the hidden form field loBoundId
	$("#loBoundId").val(ui.item ? ui.item.id : "");
}

/**
 * Event handler when selecting an entry from the author1 completer
 *
 * @access public
 * @return void
 **/
function onSelectUpBound(event, ui){
	// Memorizes bound id from the completer list in the hidden form field upBoundId
	$("#upBoundId").val(ui.item ? ui.item.id : "");
}

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function initClassBasicEdit() 
{
	$("#loBoundTxt")
		.autocomplete({source: "completeStrat.html",select: onSelectLoBound,prefixHi: false,minLength: 0})
		.blur(onLeaveLoBound);
	// UpBound
	$("#upBoundTxt").autocomplete({source: "completeStrat.html",select: onSelectUpBound,prefixHi: false,minLength: 0});
}

function addTax()
{
	var fields = $("#taxLinkForm form").serialize() + "&LocId=" + $("#recordId").val();
	callAction(
		"addLocTax",
		fields,
		function () {$("#taxLinkForm").dialog("close"); reloadTabLow();}
	);
}

function addLit()
{
	var fields = $("#litLinkForm form").serialize() + "&LocId=" + $("#recordId").val();
	callAction(
		"addLocLit", 
		fields,
		function () {$("#litLinkForm").dialog("close"); reloadTabLow();}
	);
}

function onTaxAdd(event)
{
	onTaxSelect(false,{item:false}); 
	$("#taxLinkForm").dialog("open");
}

function onLitAdd(event)
{
	onLitSelect(false,{item:false}); 
	$("#litLinkForm").dialog("open");
}

function onFigAdd(event)
{
	$("#uploadDetails").empty();
	$("#uploadResponse").empty();
	$("#figLoadForm").dialog("open");
}

function onTaxDelete(event)
{
	dialogOkCancel(
		"Delete link to taxon",
		"Do you really want to delete this link?",
		function() {
			callAction(
				"deleteLocTax",
				{LocId: $("#recordId").val(),TaxId: $(event.currentTarget).parent().attr("data-id")},
				reloadTabLow
			);
		}
	);	
}

function onLitDelete(event)
{
	dialogOkCancel(
		"Delete link to reference",
		"Do you really want to delete this link?",
		function() {
			callAction(
				"deleteLocLit",
				{LocId: $("#recordId").val(),LitId: $(event.currentTarget).parent().attr("data-id")},
				reloadTabLow
			);
		}
	);	
}

function onFigDelete(event)
{
	dialogOkCancel(
		"Delete image",
		"Do you really want to delete this image?",
		function() {
			callAction(
				"deleteLocFig",
				{LocId: $("#recordId").val(),Fig: $(event.currentTarget).attr("id")},
				reloadTabLow
			);
		}
	);	
}

function onSubDelete(event)
{
	var id = $(event.target).parent().attr("data-id");
	dialogOkCancel(
		"Delete record",
		"Do you really want to delete this record?",
		function() {callAction("deleteGeo",{RecId: id},reloadTabLow);}
	);
}

function onSubCreate()
{
	var id = $("#recordGeoId").val();
	window.location = "showGeoNew.html?ParentId=" + id;
}

function onLitSelect(event,ui)
{
	$("#litId").val(ui.item ? ui.item.id : "");
	$("#litNo").val(ui.item ? ui.item.LitNo : "");
	$("#authors").val(ui.item ? ui.item.value : "");
	$("#title").val(ui.item ? ui.item.Title : "");
	$("#reference").val(ui.item ? ui.item.Reference : "");
}

function onTaxSelect(event,ui)
{
	$("#taxId").val(ui.item ? ui.item.id : "");
	$("#taxNo").val(ui.item ? ui.item.TaxNo : "");
	$("#category").val(ui.item ? ui.item.Category : "");
	$("#taxon").val(ui.item ? ui.item.label : "");
	$("#taxonHierarchy").html(ui.item ? getTaxHierarchy(ui.item.Hierarchy) : "");
}

function getTaxLabel(item)
{
	return item.TaxNo + " - <i>" + item.value + "</i>";
}

function getTaxHierarchy(hierarchy)
{
	var html = "";
	$.each(hierarchy,function(index,value) {html += '<span class="hierLabel">' + value.Category + ":</span>" + value.Name + "<br />";});
	return html;
}

function getLitLabel(item)
{
	return item.LitNo + " - <i>" + item.value + "</i> (" + item.Year + ")<br />" + item.Title;
}

/**
 * Initiliaze the page
 *
 * @access public
 * @return void
 */
$(function () {
	$(".tabs#tabBoxLow").on("click","#taxAdd",onTaxAdd);
	$(".tabs#tabBoxLow").on("click",".taxDelete",onTaxDelete);
	$(".tabs#tabBoxLow").on("click","#litAdd",onLitAdd);
	$(".tabs#tabBoxLow").on("click",".litDelete",onLitDelete);
	$(".tabs#tabBoxLow").on("click","#figAdd",onFigAdd);
	$(".tabs#tabBoxLow").on("click",".figDelete",onFigDelete);
	$(".tabs#tabBoxLow").on("click","#subCreate",onSubCreate);
	$(".tabs#tabBoxLow").on("click",".subDelete",onSubDelete);
	$("#taxLinkForm").dialog({
		autoOpen: false,
		height: 320,
		width: 440,
		modal: true,
		buttons: {
			"Create link": addTax,
			Cancel: function() {$(this).dialog("close");}
		}
	});
	$("#taxNo").autocomplete({source: "completeTax.html",select: onTaxSelect,setValue: false,prefixHi: false,getLabel: getTaxLabel,params: {crit: "TaxNo"}});
	$("#taxon").autocomplete({source: "completeTax.html",select: onTaxSelect,setValue: false,prefixHi: false,getLabel: getTaxLabel,params: {crit: "Taxon"}});
	$("#litLinkForm").dialog({
		autoOpen: false,
		height: 320,
		width: 440,
		modal: true,
		buttons: {
			"Create link": addLit,
			Cancel: function() {$(this).dialog("close");}
		}
	});
	$("#litNo").autocomplete({source: "completeLit.html",select: onLitSelect,setValue: false,prefixHi: false,getLabel: getLitLabel,params: {crit: "LitNo"}});
	$("#authors").autocomplete({source: "completeLit.html",select: onLitSelect,setValue: false,prefixHi: false,getLabel: getLitLabel,params: {crit: "Authors"}});
	$("#title").autocomplete({source: "completeLit.html",select: onLitSelect,setValue: false,prefixHi: false,getLabel: getLitLabel,params: {crit: "Title"}});
	$("#reference").autocomplete({source: "completeLit.html",select: onLitSelect,setValue: false,prefixHi: false,getLabel: getLitLabel,params: {crit: "Reference"}});
	$("#figLoadForm").dialog({
		autoOpen: false,
		height: 320,
		width: 440,
		modal: true,
		buttons: {
			"Close": function() {reloadTabLow(); $(this).dialog("close");}
		}
	});
	$("#upload").liteUploader({
		script: "uploadLocFig.html",
		allowedFileTypes: "image/jpeg,image/png,image/gif",
		maxSizeinBytes: 4000000,
		customParams: {'LocId': $("#recordId").val()},
		before: function () {
			$("#uploadDetails").empty();$("#uploadResponse").empty();
			return true;
		},
		each: function (file, errors) {
			var i, errorsDisp = '';
			if (errors.length > 0) {
				$('#uploadResponse').html('One or more files did not pass validation');
				$.each(errors, function(i, error) {
					errorsDisp += '<br /><span class="error">' + error.type + ' error - Rule: ' + error.rule + '</span>';
				});
			}
			$('#uploadDetails').append('<p>name: ' + file.name + ', type: ' + file.type + ', size: ' + file.size + errorsDisp + '</p>');
		},
		success: function (response) {
			var response = $.parseJSON(response);
			$('#uploadResponse').html('<b>' + response.message + '</b>');
		}
	});
});