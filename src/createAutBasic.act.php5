<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showAutNew"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	
	$autId = Page::getString("recordId");
	$lastName = Page::getString("LastName");
	$firstName = Page::getString("FirstName");
	$new = false;

	if ($autId != '') {
		sendResponse("error","Invalid argument");
	}
	
	if ($lastName == "") {
		sendResponse ("error","Last name cannot be emtpy. Please enter last name.");
	}

	$aut = Aut::create();
			
	$aut->LastName = $lastName;
	$aut->FirstName = $firstName;
	// Change aut
	$aut->save();
	// Create log entry
	Log::logRecordCreate($aut->AutId,"Aut");
	
	sendResponse("success","Record was successfully created","showAut.html?AutId=".$aut->AutId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}