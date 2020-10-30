<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showAut"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$autId = Page::getString("recordId");
	$lastName = Page::getString("LastName");
	$firstName = Page::getString("FirstName");

	if (!Record::isIdValid($autId))
		sendResponse("error","Invalid argument");
	
	if ($lastName == "")
		sendResponse ("error","Last name cannot be emtpy. Please enter last name.");

	$aut = Aut::loadFromAutId($autId);

	if ($aut->Status != 0)
		sendResponse("error","Cannot modify archive record");

	// Check for changes
	if ($lastName == $aut->LastName && 
			$firstName == $aut->FirstName)
		sendResponse("success","No changes detected");
	
	// Create archive record as copy
	$archiveAut = $aut->createArchive();
		
	$aut->LastName = $lastName;
	$aut->FirstName = $firstName;
	// Change aut
	$aut->save();
	// Create log entry
	Log::logRecordModify($aut->AutId, $archiveAut->AutId,"Aut");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>