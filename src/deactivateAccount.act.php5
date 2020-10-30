<?php

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockExcept(array("manageUsers"));

	// Check permission of current user
	if (!Page::isAdmin())
		sendResponse("error","Invalid operation");
	
	$accountId = Page::getString('accountId');

	if (!Record::isIdValid($accountId))
		sendResponse("error","Invalid argument");
	
	$account = Account::loadFromAccountId($accountId);
	$account->Status = 1;
	$account->save();
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>