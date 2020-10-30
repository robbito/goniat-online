/**
 * Global variables
 */

/**
 * Event handler when clicking a toolbar button
 *
 * @access public
 * @param event
 * @return void
 */
function buttonClick(event)
{
	switch (event.target.id) {
		case 'home':
			window.location = 'index.html';
			break;
		default:
			alert(event.target.id + ": Not yet implemented");
	} // switch
}

/**
 * Event handler when clicking a toolbar button
 *
 * @access public
 * @param event
 * @return void
 */

function onDelete(event)
{
	dialogOkCancel(
		"Delete record",
		"Do you really want to delete this record?",
		function() {callAction(config.deleteAction,{RecId: $(event.currentTarget).parent().attr("data-id")},function() {window.location.reload();});}
	);
}

/**
 * Event handler when clicking a toolbar button
 *
 * @access public
 * @param event
 * @return void
 */

function onNew(event)
{
	window.location.href = config.newUrl;
}

/**
 * Initiliaze the page
 *
 * @access public
 * @return void
 */
$(function () {
	// Set up toolbar buttons
	$('div.ToolbarButton').click(buttonClick);
	$('#newRecord').click(onNew);
	$("table").on("click",".delete",onDelete);
});