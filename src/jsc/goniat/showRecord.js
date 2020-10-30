/**
 * Initiliaze the page
 *
 * @access public
 * @return void
 */
$(function () {
	// Set up the tabs of the upper pane
	$('.tabs#tabBoxUp').tabs();
	$('.tabs#tabBoxLow').tabs({
		heightStyle: "fill",
		beforeLoad: function(event, ui) {
			if ($(ui.panel).html())
				event.preventDefault();
			else
				$(ui.panel).html('<div class="load-indicator"><img src="img/goniat/indicator.gif" /><br />Loading</div>');
		}
    });
    $(".box").addClass( "ui-widget ui-widget-content ui-corner-all" );
});