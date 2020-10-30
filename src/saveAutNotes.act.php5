<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showAut"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error", "Invalid operation");
	}
	
	$autId = Page::getString("recordId");

	if (!Record::isIdValid($autId)) {
		sendResponse("error", "Invalid argument");
	}
	
	$notes = Page::getHtmlString("notesContent");
	
	$aut = Aut::loadFromAutId($autId);
	
	if ($aut->Status != 0) {
		sendResponse("error", "Cannot modify archive record");
	}
	
	if ($aut->getNotes() == $notes) {
		sendResponse("success", "No changes detected");
	}
	
	$archive = $aut->createArchive();
	$aut->saveNotes($notes);
	Log::logRecordModify($aut->AutId, $archive->AutId,"Aut");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}
