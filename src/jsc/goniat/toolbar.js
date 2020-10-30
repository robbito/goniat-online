/**
 * Event handler when clicking a toolbar button
 *
 * @access public
 * @param DOM element
 * @return void
 */
function buttonClick(event)
{
	switch (event.target.id) {
		case 'help':
			var helpLink = $("#helpLink").val();
			if (helpLink !== undefined)
				window.open("help/HTML/index.html?" + $("#helpLink").val(),"GONIAT_Online_Help");
			else
				alert(event.target.id + ": Not implemented");
			break;
		case 'print':
			var printLink = $("#printLink").val();
			if (printLink !== undefined)
				window.open(printLink,"Print");
			else
				alert(event.target.id + ": Not implemented");
			break;
		default:
			alert(event.target.id + ": Not implemented");
			break;	
	} // switch
}

$(function () {
	$("div.ToolbarButton").click(buttonClick);
	if ($("#printLink").size() == 0)
		$("div.ToolbarButton#print").hide();
});