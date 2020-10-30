<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showBnd"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$bndId = Page::getString("recordId");
	$millYears = Page::getFloat("MillYears");
	$code = Page::getString("Code");
	$name = Page::getString("Name");
	$type = Page::getString("Type");

	if (!Record::isIdValid($bndId))
		sendResponse("error","Invalid argument");
	
	if ($name == "")
		sendResponse ("error","Name cannot be emtpy. Please enter name.");

	if ($millYears == 0.0)
		sendResponse ("error","Million years is invalid. Please enter a number.");

	$bnd = Bnd::loadFromBndId($bndId);

	if ($bnd->Status != 0)
		sendResponse("error","Cannot modify archive record");

	// Check for changes
	if ($name == $bnd->Name && 
			$code == $bnd->Code &&
			$type == $bnd->Type &&
			$millYears == $bnd->MillYears)
		sendResponse("success","No changes detected");
	
	// Create archive record as copy 
	$archiveBnd = $bnd->createArchive();
		
	$bnd->Name = $name;
	$bnd->Code = $code;
	$bnd->Type = $type;
	$bnd->MillYears = $millYears;
	// Change aut
	$bnd->save();
	// Create log entry
	Log::logRecordModify($bnd->BndId, $archiveBnd->BndId,"Bnd");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>