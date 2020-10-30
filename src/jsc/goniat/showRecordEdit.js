function reloadTabLow()
{
	var tabs = $('.tabs#tabBoxLow');
	tabs.tabs('load',tabs.tabs("option","active"));
	$('.tabs#tabBoxUp').tabs('load',-1);
}

function onNotesSave()
{
	callAction(config.saveNotesAction,{recordId: $("#recordId").val(),notesContent: $("div.notes .content").val()},reloadTabLow);
}

function onNotesCancel()
{
	reloadTabLow();
}

function onNotesEdit(event)
{
	$("div.notes .edit-toolbar").hide();
	$("div.notes .content").jqte({sub: false, sup: false, rule: false});
	$("div.notes .jqte_toolbar").append('<div class="buttons"><button id="notesCancel" type="button">Cancel</button><button id="notesSave" type="button">Save</button></div>');
	$("div.notes .jqte_linkform").watch("display",calcEditorSize);
	calcEditorSize();
}

function onBasicAddDetails(event)
{
	callAction(config.addDetailsAction,{RecId: $("#recordId").val()},function() {window.location.reload();});
}

function onBasicRemoveDetails(event)
{
	var msg = config.removeDetailsMessage || '';
	dialogOkCancel(
		"Remove details",
		msg + "Do you really want to remove the record details?",
		function() {callAction(config.removeDetailsAction,{RecId: $("#recordId").val()},function() {window.location.reload();});}
	);
}

function onBasicDelete(event)
{
	dialogOkCancel(
		"Delete record",
		"Do you really want to delete this record?",
		function() {callAction(config.deleteAction,{RecId: $("#recordId").val()},function() {window.location.reload();});}
	);
}

function onBasicEdit(event)
{
	var panel = $(this).parent().parent().parent();
	panel.load(panel.attr("id").substr(0,8) + ".html",{RecordId: $("#recordId").val(),Edit : true},initClassBasicEdit);
}

function onBasicSave(event)
{
	var panel = $(this).parent().parent().parent();
	var fields = $("#" + config.basicForm).serialize() + "&recordId=" + $("#recordId").val();
	callAction(
		config.saveBasicAction,
		fields,
		function() {
			panel.load(panel.attr("id").substr(0,8) + ".html",{RecordId: $("#recordId").val(),Edit : false});
		}
	);
}

function onBasicCancel(event)
{
	if ($("#recordId").val() == "")
		window.history.back();
	else {
		var panel = $(this).parent().parent().parent();
		panel.load(panel.attr("id").substr(0,8) + ".html",{RecordId: $("#recordId").val(),Edit : false});
	}
}

function onLogDelete(event)
{
	dialogOkCancel(
		"Delete log entry",
		"Do you really want to delete this log entry?",
		function() {callAction("deleteLog",{logId: $(event.currentTarget).attr("id")},function() {$('.tabs#tabBoxUp').tabs('load',-1);});}
	);
}
	
function calcEditorSize()
{
	var editor = $("div.notes .jqte_editor");
	var	height = $("div.notes .jqte").innerHeight() - $("div.notes .jqte_toolbar").outerHeight() - parseInt(editor.css("padding-top")) - parseInt(editor.css("padding-bottom"));
	if ($("div.notes .jqte_linkform").is(":visible"))
		height -= $("div.notes .jqte_linkform").outerHeight();
	editor.height(height);
}

/**
 * Initialize the page
 *
 * @access public
 * @return void
 */
$(function () {
	// Set up the tabs of the upper pane
	$(".tabs#tabBoxUp").tabs();
	$(".tabs#tabBoxUp").on("click",".logDelete",onLogDelete);
	$(".tabs#tabBoxUp").on("click","#basicDelete",onBasicDelete);
	$(".tabs#tabBoxUp").on("click","#basicAddDetails",onBasicAddDetails);
	$(".tabs#tabBoxUp").on("click","#basicRemoveDetails",onBasicRemoveDetails);
	$(".tabs#tabBoxUp").on("click","#basicEdit",onBasicEdit);
	$(".tabs#tabBoxUp").on("click","#basicSave",onBasicSave);
	$(".tabs#tabBoxUp").on("click","#basicCancel",onBasicCancel);
	$(".tabs#tabBoxLow").tabs({
		heightStyle: "fill",
		beforeLoad: function(event, ui) {
			$(ui.panel).html('<div class="load-indicator"><img src="img/goniat/indicator.gif" /><br />Loading</div>');
		},
		load: function(event, ui) {
			$(ui.panel).find("div.notes .content").height($("div.notes").innerHeight() - $("div.notes .edit-toolbar").outerHeight());
			var recCount = $(ui.panel).find("span.recCount").html();
			if (recCount)
				$(ui.tab).find("span.recCount").html(recCount);
		}
    });
    $(".box").addClass( "ui-widget ui-widget-content ui-corner-all" );
	$(".tabs#tabBoxLow").on("click","#notesEdit",onNotesEdit);
	$(".tabs#tabBoxLow").on("click","#notesSave",onNotesSave);
	$(".tabs#tabBoxLow").on("click","#notesCancel",onNotesCancel);
});