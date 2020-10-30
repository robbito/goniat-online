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
	
	Account::delete($accountId);
	
	sendResponse("success","The account was sucessfully deleted");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>