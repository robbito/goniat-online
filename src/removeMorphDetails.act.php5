<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showTax"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	
	$taxId = Page::getString("RecId");
	
	if (!Record::isIdValid($taxId)) {
		sendResponse("error","Invalid argument");
	}
	
	$tax = Tax::loadFromTaxId($taxId);
	
	if (!isset($tax)) {
		sendResponse("error","Invalid argument");
	}
	$archiveTax = $tax->createArchive();
	// Mark deleted
	$tax->createArchiveMorph($archiveTax->TaxId,true,true);
	// Create log entry
	Log::logRecordModify($tax->TaxId, $archiveTax->TaxId,"Tax");
	
	sendResponse("success",null,"showTax.html?TaxId=".$tax->TaxId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}