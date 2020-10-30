
function onCreate(event)
{
	var id = $(event.target).parent().attr("data-id");
	window.location = "showCatNew.html?ParentId=" + id;
}

function onCreateTopLevel(event)
{
	window.location = "showCatNew.html?ParentId=";
}
	
function onDelete()
{
	var id = $(event.target).parent().attr("data-id");
	dialogOkCancel(
		"Delete record",
		"Do you really want to delete this record?",
		function() {callAction("deleteCat",{RecId: id},function() {window.location.reload();});}
	);
}

function onSelect()
{
	var newParent = $(event.target).parent().attr("data-id");
	var newName = $(event.target).parent().attr("data-name");
	dialogOkCancel(
		"Move record",
		"Do you really want to move '" + $("#catName").val() +"' to '" + newName + "'?",
		function() {
			callAction(
				"moveCat", 
				{CatId: $("#catId").val(), ParentId: newParent},
				function () {$("#catSelectForm").dialog("close"); window.location.reload();}
			);
		});
}
	
function onMove()
{
	var recordId = $(event.target).parent().attr("data-id");
	var recordName = $(event.target).parent().attr("data-name");
	$("#catId").val(recordId);
	$("#catName").val(recordName);
	$("#catSelectForm").dialog("open");
}

$(function () {
	$(".hierarchy").on("click",".move",onMove);
	$(".hierarchy").on("click",".delete",onDelete);
	$(".hierarchy").on("click",".create",onCreate);
	$("#catSelectForm").dialog({
		title: "Select new parent",
		autoOpen: false,
		height: 600,
		width: 600,
		modal: true,
		buttons: {
			Cancel: function() {$(this).dialog("close");}
		}
	});
	$("#catSelectForm").on("click",".select",onSelect);
	$("#newRecord").click(onCreateTopLevel);
});