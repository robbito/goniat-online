<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showCat","showTaxCat","showTax","taxHierarchy"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	// Get parameters
	$catId = Page::getString("RecId");
	// Check parameters
	if (!Record::isIdValid($catId)) {
		sendResponse("error","Invalid argument");
	}

	$cat = Cat::loadFromCatId($catId);
	if (is_null($cat)) {
		sendResponse("error","Invalid argument");
	}

	$subCount = $cat->getChildrenCount();
	if ($subCount) {
		sendResponse("error","This record still has some sub taxa. Please delete them first.");
	}
	
	$tax = Tax::loadFromCatId($catId);
	if (isset($tax)) {
		sendResponse("error","This record has taxon details connected. Please delete them first.");
	}
	
	if (!$cat->isDeletable()) {
		sendResponse("error","Invalid argument");
	}

	$cat->delete();
	Log::logRecordDelete($catId,"Cat");

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

