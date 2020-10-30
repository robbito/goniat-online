
function onCreate(event)
{
	var id = $(event.target).parent().attr("data-id");
	window.location = "showGeoNew.html?ParentId=" + id;
}

function onCreateTopLevel(event)
{
	window.location = "showGeoNew.html?ParentId=";
}
	
function onDelete()
{
	var id = $(event.target).parent().attr("data-id");
	dialogOkCancel(
		"Delete record",
		"Do you really want to delete this record?",
		function() {callAction("deleteGeo",{RecId: id},function() {window.location.reload();});}
	);
}

function onSelect()
{
	var newParent = $(event.target).parent().attr("data-id");
	var newName = $(event.target).parent().attr("data-name");
	dialogOkCancel(
		"Move record",
		"Do you really want to move '" + $("#geoName").val() +"' to '" + newName + "'?",
		function() {
			callAction(
				"moveGeo", 
				{GeoId: $("#geoId").val(), ParentId: newParent},
				function () {$("#geoSelectForm").dialog("close"); window.location.reload();}
			);
		});
}
	
function onMove()
{
	var recordId = $(event.target).parent().attr("data-id");
	var recordName = $(event.target).parent().attr("data-name");
	$("#geoId").val(recordId);
	$("#geoName").val(recordName);
	$("#geoSelectForm").dialog("open");
}

$(function () {
	$(".hierarchy").on("click",".move",onMove);
	$(".hierarchy").on("click",".delete",onDelete);
	$(".hierarchy").on("click",".create",onCreate);
	$("#geoSelectForm").dialog({
		title: "Select new parent",
		autoOpen: false,
		height: 600,
		width: 600,
		modal: true,
		buttons: {
			Cancel: function() {$(this).dialog("close");}
		}
	});
	$("#geoSelectForm").on("click",".select",onSelect);
	$("#newRecord").click(onCreateTopLevel);
});