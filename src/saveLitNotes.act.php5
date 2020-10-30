<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLit"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error", "Invalid operation");
	}
	
	$litId = Page::getString("recordId");

	if (!Record::isIdValid($litId)) {
		sendResponse("error", "Invalid argument");
	}
	
	$notes = Page::getHtmlString("notesContent");
	
	$lit = Lit::loadFromLitId($litId);
	
	if ($lit->Status != 0) {
		sendResponse("error", "Cannot modify archive record");
	}
	
	if ($lit->getNotes() == $notes) {
		sendResponse("success", "No changes detected");
	}
	
	$archive = $lit->createArchive();
	$lit->saveNotes($notes);
	Log::logRecordModify($lit->LitId, $archive->LitId,"Lit");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}
