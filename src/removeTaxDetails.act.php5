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

	$litCount = $tax->getLitCount();
	$locCount = $tax->getLocCount();
	
	if ($litCount || $locCount) {
		$msg = "This taxon is still linked to some ";
		if ($litCount)
			$msg .= "references";
		if ($litCount && $locCount)
			$msg .= " and ";
		if ($locCount)
			$msg .= "localities";
		$msg .= ". Please delete these links first.";
		sendResponse("error",$msg);
	}
	
	$figCount = $tax->getFigureCount();
	
	if ($figCount) {
		sendResponse("error","This taxon has figures. Please delete the figures first.");
	}
	
	// Mark deleted
	$tax->delete();
	// Create log entry
	Log::logRecordDelete($tax->TaxId,"Tax");
	
	sendResponse("success",null,"showTaxCat.html?CatId=".$tax->CatId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}