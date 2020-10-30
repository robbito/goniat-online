function saveForm(event)
{
	callAction("editAccount",$("#editAccount").serialize());	
}
	
$(function() {
    $(".tabs").tabs({heightStyle: "fill"});
	$("#tabBoxLow").on("click","button.save",saveForm);
});