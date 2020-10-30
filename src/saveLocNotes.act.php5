<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLoc"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error", "Invalid operation");
	}
	
	$locId = Page::getString("recordId");

	if (!Record::isIdValid($locId)) {
		sendResponse("error", "Invalid argument");
	}
	
	$notes = Page::getHtmlString("notesContent");
	
	$loc = Loc::loadFromLocId($locId);
	
	if ($loc->Status != 0) {
		sendResponse("error", "Cannot modify archive record");
	}
	
	if ($loc->getNotes() == $notes) {
		sendResponse("success", "No changes detected");
	}
	
	$archive = $loc->createArchive();
	$loc->saveNotes($notes);
	Log::logRecordModify($loc->LocId, $archive->LocId,"Loc");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}
