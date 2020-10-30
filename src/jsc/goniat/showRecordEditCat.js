/**
 * Configuration for class
 * 
 * @type object
 */

var config = {
	deleteAction: 'deleteCat',
	saveNotesAction: 'saveCatNotes',
	saveBasicAction: 'saveCatBasic',
	addDetailsAction: 'addTaxDetails',
	basicForm: 'catBasicForm'
};

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
	var id = $("#recordId").val();
	window.location = "showCatNew.html?ParentId=" + id;
}

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function initClassBasicEdit() 
{
}

$(function () {
	$(".tabs#tabBoxLow").on("click","#subCreate",onSubCreate);
	$(".tabs#tabBoxLow").on("click",".subDelete",onSubDelete);
});
