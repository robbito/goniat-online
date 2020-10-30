/**
 * Configuration for class
 * 
 * @type object
 */

var config = {
	saveNotesAction: 'saveTaxNotes',
	saveBasicAction: 'saveTaxBasic',
	saveMorphAction: 'saveTaxMorph',
	removeDetailsAction: 'removeTaxDetails',
	removeDetailsMessage: 'If existent, this function will also remove the morphological details.<br /><br />',
	basicForm: 'taxBasicForm'
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
 * Event handler when selecting an entry from the author completer
 *
 * @access public
 * @return void
 **/
function onSelectAut(event, ui){
	// Memorizes Bound id from the completer list in the hidden form field loBoundId
	$("#authorId").val(ui.item ? ui.item.id : "");
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
	$("#authorTxt").autocomplete({source: "completeAut.html",select: onSelectAut,prefixHi: false,minLength: 1, params: {all: "true"}});

	$("#loBoundTxt")
		.autocomplete({source: "completeStrat.html",select: onSelectLoBound,prefixHi: false,minLength: 0})
		.blur(onLeaveLoBound);
	// UpBound
	$("#upBoundTxt").autocomplete({source: "completeStrat.html",select: onSelectUpBound,prefixHi: false,minLength: 0});
}

function addLoc()
{
	var fields = $("#locLinkForm form").serialize() + "&TaxId=" + $("#recordId").val();
	callAction(
		"addLocTax",
		fields,
		function () {$("#locLinkForm").dialog("close"); reloadTabLow();}
	);
}

function addLit()
{
	var fields = $("#litLinkForm form").serialize() + "&TaxId=" + $("#recordId").val();
	callAction(
		"addTaxLit", 
		fields,
		function () {$("#litLinkForm").dialog("close"); reloadTabLow();}
	);
}

function onLocAdd(event)
{
	onLocSelect(false,{item:false}); 
	$("#locLinkForm").dialog("open");
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

function onLocDelete(event)
{
	dialogOkCancel(
		"Delete link to locality",
		"Do you really want to delete this link?",
		function() {
			callAction(
				"deleteLocTax",
				{TaxId: $("#recordId").val(),LocId: $(event.currentTarget).parent().attr("data-id")},
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
				"deleteTaxLit",
				{TaxId: $("#recordId").val(),LitId: $(event.currentTarget).parent().attr("data-id")},
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
				"deleteTaxFig",
				{TaxId: $("#recordId").val(),Fig: $(event.currentTarget).attr("id")},
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
		function() {callAction("deleteCat",{RecId: id},reloadTabLow);}
	);
}

function onSubCreate()
{
	var id = $("#recordCatId").val();
	window.location = "showCatNew.html?ParentId=" + id;
}

function onLitSelect(event,ui)
{
	$("#litId").val(ui.item ? ui.item.id : "");
	$("#litNo").val(ui.item ? ui.item.LitNo : "");
	$("#authors").val(ui.item ? ui.item.value : "");
	$("#title").val(ui.item ? ui.item.Title : "");
	$("#reference").val(ui.item ? ui.item.Reference : "");
}

function onLocSelect(event,ui)
{
	$("#locId").val(ui.item ? ui.item.id : "");
	$("#locNo").val(ui.item ? ui.item.LocNo : "");
	$("#locality").val(ui.item ? ui.item.label : "");
	$("#locHierarchy").html(ui.item ? getLocHierarchy(ui.item.Hierarchy) : "");
}

function getLocLabel(item)
{
	return item.LocNo + " - <i>" + item.value + "</i>";
}

function getLocHierarchy(hierarchy)
{
	var html = "";
	$.each(hierarchy,function(index,value) {html += '<span class="hierLabel">' + value.Category + ":</span>" + value.Name + "<br />"});
	return html;
}

function getLitLabel(item)
{
	return item.LitNo + " - <i>" + item.value + "</i> (" + item.Year + ")<br />" + item.Title;
}

function getMorphLabel(item)
{
	return item.id + " - <i>" + item.value + "</i>";
}

function initClassMorphEdit()
{
	$("#taxMorphForm .featValueMulti input,#taxMorphForm .featCompl input").autocomplete({
		source: "completeMorph.html",
		setValue: true,
		prefixHi: true,
		minLength: 0,
		create: function(event,ui) {
			$(this).autocomplete("option","params",{field: $(this).attr("name")});
		}
	});
}

function onMorphEdit(event)
{
	var panel = $(this).parent().parent().parent();
	panel.load("taxMorph.html?RecordId=" +  $("#recordId").val() + "&Edit=true",initClassMorphEdit);
}

function onMorphSave(event)
{
	var panel = $(this).parent().parent().parent();
	var fields = $("#taxMorphForm").serialize() + "&RecordId=" + $("#recordId").val();
	callAction(
		config.saveMorphAction,
		fields,
		function() {
			panel.load("taxMorph.html?RecordId=" + $("#recordId").val());
		}
	);
}

function onMorphAddYouth(event)
{
	var panel = $(this).parent().parent().parent();
	callAction("addMorphYouthDetails",{RecId: $("#recordId").val()},function() {
			panel.load("taxMorph.html?RecordId=" +  $("#recordId").val(),initClassMorphEdit);
	});	
}

function onMorphRemoveYouth(event)
{
	var panel = $(this).parent().parent().parent();
	dialogOkCancel(
		"Remove youth details",
		"Do you really want to remove the youth stages details?",
		function() {
			callAction("removeMorphYouthDetails",{RecId: $("#recordId").val()},function() {
				panel.load("taxMorph.html?RecordId=" +  $("#recordId").val(),initClassMorphEdit);
			});
		}
	);
}

function onMorphCancel(event)
{
	var panel = $(this).parent().parent().parent();
	panel.load("taxMorph.html?RecordId=" +  $("#recordId").val(),initClassMorphEdit);
}

function onBasicMorphAdd(event)
{
	callAction("addMorphDetails",{RecId: $("#recordId").val()});
}

function onBasicMorphRemove(event)
{
	dialogOkCancel(
		"Remove morphology details",
		"Do you really want to remove the morphology details?",
		function() {callAction("removeMorphDetails",{RecId: $("#recordId").val()});}
	);
}

/**
 * Initiliaze the page
 *
 * @access public
 * @return void
 */
$(function () {
	$(".tabs#tabBoxUp").on("click","#basicAddMorph",onBasicMorphAdd);
	$(".tabs#tabBoxUp").on("click","#basicRemoveMorph",onBasicMorphRemove);

	$(".tabs#tabBoxUp").on("click","#morphEdit",onMorphEdit);
	$(".tabs#tabBoxUp").on("click","#morphAddYouth",onMorphAddYouth);
	$(".tabs#tabBoxUp").on("click","#morphCancel",onMorphCancel);
	$(".tabs#tabBoxUp").on("click","#morphSave",onMorphSave);
	$(".tabs#tabBoxUp").on("click","#morphRemoveYouth",onMorphRemoveYouth);
	
	$(".tabs#tabBoxLow").on("click","#locAdd",onLocAdd);
	$(".tabs#tabBoxLow").on("click",".locDelete",onLocDelete);
	$(".tabs#tabBoxLow").on("click","#litAdd",onLitAdd);
	$(".tabs#tabBoxLow").on("click",".litDelete",onLitDelete);
	$(".tabs#tabBoxLow").on("click","#figAdd",onFigAdd);
	$(".tabs#tabBoxLow").on("click",".figDelete",onFigDelete);
	$(".tabs#tabBoxLow").on("click","#subCreate",onSubCreate);
	$(".tabs#tabBoxLow").on("click",".subDelete",onSubDelete);
	$("#locLinkForm").dialog({
		autoOpen: false,
		height: 320,
		width: 440,
		modal: true,
		buttons: {
			"Create link": addLoc,
			Cancel: function() {$(this).dialog("close");}
		}
	});
	$("#locNo").autocomplete({source: "completeLoc.html",select: onLocSelect,setValue: false,prefixHi: false,getLabel: getLocLabel,params: {crit: "LocNo"}});
	$("#locality").autocomplete({source: "completeLoc.html",select: onLocSelect,setValue: false,prefixHi: false,getLabel: getLocLabel,params: {crit: "Locality"}});
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
		script: "uploadTaxFig.html",
		allowedFileTypes: "image/jpeg,image/png,image/gif",
		maxSizeinBytes: 4000000,
		customParams: {'TaxId': $("#recordId").val()},
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