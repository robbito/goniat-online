/**
 * Configuration for class
 * 
 * @type object
 */

var config = {
	deleteAction: 'deleteGeo',
	saveNotesAction: 'saveGeoNotes',
	saveBasicAction: 'saveGeoBasic',
	addDetailsAction: 'addLocDetails',
	basicForm: 'geoBasicForm'
};

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
	var id = $("#recordId").val();
	window.location = "showGeoNew.html?ParentId=" + id;
}

function initClassBasicEdit() 
{
}

$(function () {
	$(".tabs#tabBoxLow").on("click","#subCreate",onSubCreate);
	$(".tabs#tabBoxLow").on("click",".subDelete",onSubDelete);
});