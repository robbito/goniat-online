/**
 * Toogle the children
 *
 * @access public
 * @param event
 * @return void
 **/
function toggleChildren(event)
{
	var group = $(event.target).parent().parent();
	// if group has not been loaded
	if (!group.hasClass('loaded')) {
		var params = "GeoId="+group.attr("data-id");
		if (group.attr("data-select") === "true")
			params += "&Select=true";
		group.find(".children").load("geoChildren.html",params).addClass("loaded");
	}
	// Toggle the collapsed class assignment
	group.toggleClass('collapsed');
}

$(function () {
	$("div.ToolbarButton").click(buttonClick);
	$(".hierarchy").on("click","div.status",toggleChildren);
});