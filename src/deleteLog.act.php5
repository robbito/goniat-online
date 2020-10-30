<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockDirect();

	// Check permission of current user
	if (!Page::isAdmin())
		sendResponse("error","Invalid operation");
	
	$logId = Page::getString('logId');

	if (!Record::isIdValid($logId))
		sendResponse("error","Invalid argument");
	
	Log::delete($logId);
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>