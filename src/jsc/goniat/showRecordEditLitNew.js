/**
 * Configuration for class
 * 
 * @type object
 */

var config = {
	saveBasicAction: 'createLitBasic',
	basicForm: 'litBasicForm'
};

/**
 * Event handler when selecting an entry from the loBound completer
 *
 * @access public
 * @return void
 **/
function onSelectAut1(event, ui){
	// Memorizes author id from the completer list in the hidden form field aut1Id
	$("#aut1Id").val(ui.item ? ui.item.id : "");
}

/**
 * Event handler when selecting an entry from the author2 completer
 *
 * @access public
 * @return void
 **/
function onSelectAut2(event, ui){
	// Memorizes author id from the completer list in the hidden form field aut2id
	$("#aut2Id").val(ui.item ? ui.item.id : "");
}

/**
 * Event handler when selecting an entry from the author3 completer
 *
 * @access public
 * @return void
 **/
function onSelectAut3(event, ui){
	// Memorizes author id from the completer list in the hidden form field aut2id
	$("#aut3Id").val(ui.item ? ui.item.id : "");
}

function initClassBasicEdit() 
{
	// AUthor 1
	$("#aut1Txt").autocomplete({source: "completeAut.html",select: onSelectAut1,prefixHi: false,minLength: 0});
	// Author 2
	$("#aut2Txt").autocomplete({source: "completeAut.html",select: onSelectAut2,prefixHi: false,minLength: 0});
	// Author 3
	$("#aut3Txt").autocomplete({source: "completeAut.html",select: onSelectAut3,prefixHi: false,minLength: 0});
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