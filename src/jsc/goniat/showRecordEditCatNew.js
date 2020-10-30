/**
 * Configuration for class
 * 
 * @type object
 */

var config = {
	saveBasicAction: 'createCatBasic',
	basicForm: 'catBasicForm'
};

function restrictType()
{
	var el = $("select#type");
	var max = parseInt(el.attr("data-max"));
	var dom = el.get(0);
	while (dom.options[0].value >= max)
		dom.options[0].remove();
	if (el.val() >= max) {
		el.val(-1);
		el.change();
	}
}

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function initClassBasicEdit() 
{
	restrictType();
}

/**
 * Initialize the page
 *
 * @access public
 * @return void
 */
$(function () {
	initClassBasicEdit();
});