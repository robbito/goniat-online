<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLoc","showTax"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	// Get parameters
	$locId = Page::getString("LocId");
	$taxId = Page::getString("TaxId");
	// Check parameters
	if (!Record::isIdValid($locId) || !Record::isIdValid($taxId)) {
		sendResponse("error","Invalid argument");
	}
	
	$loc = Loc::loadFromLocId($locId);
	if (is_null($loc)) {
		sendResponse("error","Invalid argument");
	}

	$loc->addTaxLink($taxId);
	Log::logRelationCreate($locId,"Loc",$taxId,"Tax");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

