/**
 *
 * @access public
 * @return void
 **/
function sectionToggle(event) {
	if (event.target.checked == false)
		$("#" + event.target.name + "Section").slideUp();
	else
		$("#" + event.target.name + "Section").slideDown();
	moveSettings();
}

/**
 *
 * @access public
 * @return void
 **/
function moveSettings(event) {
	$('#printSettings').css('top',window.scrollY + 20 + 'px');
}

/**
 * Initiliaze the page
 *
 * @access public
 * @return void
 */
$(function() {
	$('#printSettings').css({opacity : 0.8});
	$('input.section').click(sectionToggle);
	$(window).scroll(moveSettings);
});