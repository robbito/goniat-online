<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showCat","showTaxCat"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	
	$catId = Page::getString("recordId");
	$name = Page::getString("Name");

	if (!Record::isIdValid($catId)) {
		sendResponse("error","Invalid argument");
	}
	
	if ($name == "") {
		sendResponse("error","Name cannot be empty");
	}
	

	$cat = Cat::loadFromCatId($catId);

	if ($cat->Status != 0) {
		sendResponse("error","Cannot modify archive record");
	}

	// Check for changes
	if ($name == $cat->Name) {
		sendResponse("success","No changes detected");
	}
	
	// Create archive record as copy 
	$archiveCat = $cat->createArchive();
	$cat->Name = $name;
	$cat->save();
	Log::logRecordModify($cat->CatId,$archiveCat->CatId, "Cat");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>