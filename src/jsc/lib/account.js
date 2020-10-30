$(function() {
	$("#accountMenu")
		.hide()
		.menu();
	$("#doMenu")
		.click(function() {
			$("#accountMenu").show().position({
				my: "right top",
				at: "right bottom",
				of: this
			});
			$(document).one("click", function() {
				$("#accountMenu").hide();
			});
			return false;
		});
});
