<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showTax"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error", "Invalid operation");
	}
	
	$taxId = Page::getString("recordId");

	if (!Record::isIdValid($taxId)) {
		sendResponse("error", "Invalid argument");
	}
	
	$notes = Page::getHtmlString("notesContent");
	
	$tax = Tax::loadFromTaxId($taxId);
	
	if ($tax->Status != 0) {
		sendResponse("error", "Cannot modify archive record");
	}
	
	if ($tax->getNotes() == $notes) {
		sendResponse("success", "No changes detected");
	}
	
	$archive = $tax->createArchive();
	$tax->saveNotes($notes);
	Log::logRecordModify($tax->TaxId, $archive->TaxId,"Tax");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}
