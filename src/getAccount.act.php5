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
	
	sendResponse("success",null,null,$account->getData());
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>