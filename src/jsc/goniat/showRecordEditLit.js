/**
 * Configuration for class
 * 
 * @type object
 */

var config = {
	deleteAction: 'deleteLit',
	saveNotesAction: 'saveLitNotes',
	saveBasicAction: 'saveLitBasic',
	basicForm: 'litBasicForm'
};

/**
 * Event handler when selecting an entry from the loBound completer
 *
 * @access public
 * @return void
 **/
function onSelectAut1(event, ui){
	// Memorizes author id from the completer list in the hidden form field aut1Id
	$("#aut1Id").val(ui.item ? ui.item.id : "");
}

/**
 * Event handler when selecting an entry from the author2 completer
 *
 * @access public
 * @return void
 **/
function onSelectAut2(event, ui){
	// Memorizes author id from the completer list in the hidden form field aut2id
	$("#aut2Id").val(ui.item ? ui.item.id : "");
}

/**
 * Event handler when selecting an entry from the author3 completer
 *
 * @access public
 * @return void
 **/
function onSelectAut3(event, ui){
	// Memorizes author id from the completer list in the hidden form field aut2id
	$("#aut3Id").val(ui.item ? ui.item.id : "");
}

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function initClassBasicEdit() 
{
	// AUthor 1
	$("#aut1Txt").autocomplete({source: "completeAut.html",select: onSelectAut1,prefixHi: false,minLength: 0});
	// Author 2
	$("#aut2Txt").autocomplete({source: "completeAut.html",select: onSelectAut2,prefixHi: false,minLength: 0});
	// Author 3
	$("#aut3Txt").autocomplete({source: "completeAut.html",select: onSelectAut3,prefixHi: false,minLength: 0});
}

function addTax()
{
	var fields = $("#taxLinkForm form").serialize() + "&LitId=" + $("#recordId").val();
	callAction(
		"addTaxLit",
		fields,
		function () {$("#taxLinkForm").dialog("close"); reloadTabLow();}
	);
}

function addLoc()
{
	var fields = $("#locLinkForm form").serialize() + "&LitId=" + $("#recordId").val();
	callAction(
		"addLocLit", 
		fields,
		function () {$("#locLinkForm").dialog("close"); reloadTabLow();}
	);
}

function onTaxAdd(event)
{
	onTaxSelect(false,{item:false}); 
	$("#taxLinkForm").dialog("open");
}

function onLocAdd(event)
{
	onLocSelect(false,{item:false}); 
	$("#locLinkForm").dialog("open");
}

function onTaxDelete(event)
{
	dialogOkCancel(
		"Delete link to taxon",
		"Do you really want to delete this link?",
		function() {
			callAction(
				"deleteTaxLit",
				{LitId: $("#recordId").val(),TaxId: $(event.currentTarget).parent().attr("data-id")},
				reloadTabLow
			);
		}
	);	
}

function onLocDelete(event)
{
	dialogOkCancel(
		"Delete link to locality",
		"Do you really want to delete this link?",
		function() {
			callAction(
				"deleteLocLit",
				{LitId: $("#recordId").val(),LocId: $(event.currentTarget).parent().attr("data-id")},
				reloadTabLow
			);
		}
	);	
}

function onLocSelect(event,ui)
{
	$("#locId").val(ui.item ? ui.item.id : "");
	$("#locNo").val(ui.item ? ui.item.LocNo : "");
	$("#locality").val(ui.item ? ui.item.label : "");
	$("#locHierarchy").html(ui.item ? getLocHierarchy(ui.item.Hierarchy) : "");
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
	$.each(hierarchy,function(index,value) {html += '<span class="hierLabel">' + value.Category + ":</span>" + value.Name + "<br />"});
	return html;
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

/**
 * Initialize the page
 *
 * @access public
 * @return void
 */
$(function () {
	$(".tabs#tabBoxLow").on("click","#taxAdd",onTaxAdd);
	$(".tabs#tabBoxLow").on("click",".taxDelete",onTaxDelete);
	$(".tabs#tabBoxLow").on("click","#locAdd",onLocAdd);
	$(".tabs#tabBoxLow").on("click",".locDelete",onLocDelete);
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
});