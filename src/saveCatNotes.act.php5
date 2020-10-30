<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showCat","showTaxCat"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error", "Invalid operation");
	}
	
	$catId = Page::getString("recordId");

	if (!Record::isIdValid($catId)) {
		sendResponse("error", "Invalid argument");
	}
	
	$notes = Page::getHtmlString("notesContent");
	
	$cat = Cat::loadFromCatId($catId);
	
	if ($cat->Status != 0) {
		sendResponse("error", "Cannot modify archive record");
	}
	
	if ($cat->getNotes() == $notes) {
		sendResponse("success", "No changes detected");
	}
	
	$archive = $cat->createArchive();
	$cat->saveNotes($notes);
	Log::logRecordModify($cat->CatId, $archive->CatId,"Cat");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}
