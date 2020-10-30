<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showCat","showTaxCat"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	
	$catId = Page::getString("RecId");
	
	if (!Record::isIdValid($catId)) {
		sendResponse("error","Invalid argument");
	}
	
	$cat = Cat::loadFromCatId($catId);
	
	if (!isset($cat)) {
		sendResponse("error","Invalid argument");
	}

	$tax = Tax::create();
			
	$tax->CatId = $catId;
	// Change aut
	$tax->save();
	// Create log entry
	Log::logRecordCreate($tax->TaxId,"Tax");
	
	sendResponse("success",null,"showTaxCat.html?CatId=".$catId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}