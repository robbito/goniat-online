
function loadForm(response)
{
	$("#accountId").val(response.data.AccountId);
	$("#user").val(response.data.User);
	$("#email").val(response.data.Email);
	$("#password").val("**unchanged**");
	$("#perm").val(response.data.Perm);
	$("#status").val(response.data.Status);
	$(".tabs").tabs("option","active",1);
	$("#createAccountTab a").text("Edit account");
}

function resetForm()
{
	$("#accountId").val("");
	$("#user").val("");
	$("#email").val("");
	$("#password").val("");
	$("#perm").val(0);
	$("#status").val(0);
	$("#createAccountTab a").text("Create account");
}

function actionEdit(event)
{
	// load form
	callAction("getAccount",{accountId: $(event.target).parent().attr("id")},loadForm);
}

function actionActivate(event)
{
	dialogOkCancel(
		"Activate account",
		"Do you really want to activate this account?",
		function() {callAction("activateAccount",{accountId: $(event.target).parent().attr("id")},function() {$('.tabs').tabs('load',0);});}
	);
}

function actionDeactivate(event)
{
	dialogOkCancel(
		"Deactivate account",
		"Do you really want to deactivate this account?",
		function() {callAction("deactivateAccount",{accountId: $(event.target).parent().attr("id")},function() {$('.tabs').tabs('load',0);});}
	);
}

function actionDelete(event)
{
	dialogOkCancel(
		"Delete account",
		"Do you really want to delete this account?",
		function() {callAction("deleteAccount",{accountId: $(event.target).parent().attr("id")},function() {$('.tabs').tabs('load',0);});}
	);
}

function saveForm(event)
{
	callAction("createAccount",$("#createAccount").serialize(),function() {$('.tabs').tabs('option','active',0).tabs('load',0);resetForm();});	
}
	
$(function() {
    $(".tabs").tabs({heightStyle: "fill"});
	$("#tabBoxLow").on("click","button.edit",actionEdit);
	$("#tabBoxLow").on("click","button.act",actionActivate);
	$("#tabBoxLow").on("click","button.deact",actionDeactivate);
	$("#tabBoxLow").on("click","button.del",actionDelete);
	$("#tabBoxLow").on("click","button.reset",resetForm);
	$("#tabBoxLow").on("click","button.save",saveForm);
});