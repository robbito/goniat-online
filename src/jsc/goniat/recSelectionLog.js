function onLogDelete(event)
{
	dialogOkCancel(
		"Delete log entry",
		"Do you really want to delete this log entry?",
		function() {callAction("deleteLog",{logId: $(event.currentTarget).attr("id")},function() {window.location.reload()});}
	);
}

/**
 * Initialize the page
 *
 * @access public
 * @return void
 */
$(function () {
	$("table.log").on("click",".logDelete",onLogDelete);
});