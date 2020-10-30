<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showBndNew"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$bndId = Page::getString("recordId");
	$millYears = Page::getFloat("MillYears");
	$code = Page::getString("Code");
	$name = Page::getString("Name");
	$type = Page::getString("Type");

	if ($bndId != '')
		sendResponse("error","Invalid argument");
	
	if ($name == "")
		sendResponse ("error","Name cannot be emtpy. Please enter name.");

	if ($millYears == 0.0)
		sendResponse ("error","Million years is invalid. Please enter a number.");

	$bnd = Bnd::create();
	
	$bnd->Name = $name;
	$bnd->Code = $code;
	$bnd->Type = $type;
	$bnd->MillYears = $millYears;
	// Change aut
	$bnd->save();
	// Create log entry
	Log::logRecordCreate($bnd->BndId,"Bnd");
	
	sendResponse("success","Record was successfully created","showBnd.html?BndId=".$bnd->BndId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>