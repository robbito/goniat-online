<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showTax"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	
	$taxId = Page::getString("recordId");
	$name = Page::getString("Name");
	$authorId = Page::getString("AuthorId");
	$authorTxt = Page::getString("Author");
	$pages = Page::getString("Pages");
	$qualifier = Page::getInt("Qualifier");
	$valid = Page::getString("Valid");
	$loBoundId = Page::getString("LoBoundId");
	$loBoundTxt = Page::getString("LoBound");
	$upBoundId = Page::getString("UpBoundId");
	$upBoundTxt = Page::getString("UpBound");

	if (!Record::isIdValid($taxId)) {
		sendResponse("error","Invalid argument");
	}
	
	if ($name == "") {
		sendResponse("error","Name cannot be empty");
	}

	if ($authorTxt == "") {
		$authorId = "";
	}
	elseif ($authorId == "") {
		sendResponse("error","Specified author does not exist. Please create author record first.");
	}

	if ($loBoundTxt == "") {
		$loBoundId = "";
	}
	elseif ($loBoundId == "") {
		sendResponse("error","Specified lower boundary does not exist. Please create boundary record first.");
	}

	if ($upBoundTxt == "") {
		$upBoundId = "";
	}
	elseif ($upBoundId == "") {
		sendResponse("error","Specified upper boundary does not exist. Please create boundary record first.");
	}
	
	$tax = Tax::loadFromTaxId($taxId);
	$cat = Cat::loadFromCatId($tax->CatId);

	if ($tax->Status != 0) {
		sendResponse("error","Cannot modify archive record");
	}

	// Check for changes
	if ($name == $cat->Name &&
			$loBoundId == $tax->BndLoId &&
			$upBoundId == $tax->BndUpId &&
			$authorId == $tax->AutId &&
			$qualifier == $tax->Qualifier &&
			$pages == $tax->Pages &&
			$valid == $tax->Valid) {
		sendResponse("success","No changes detected");
	}
	
	// Create archive record as copy 
	$archiveCat = null;
	$archiveTax = $tax->createArchive();
	$tax->createArchiveMorph($archiveTax->TaxId);
	if ($name != $cat->Name) {
		$archiveCat = $cat->createArchive();
		$archiveTax->CatId = $archiveCat->CatId;
		$archiveTax->save();
		$cat->Name = $name;
		$cat->save();
		Log::logRecordModify($cat->CatId,$archiveCat->CatId, "Cat");
	}
		
	$tax->BndLoId = $loBoundId;
	$tax->BndUpId = $upBoundId;
	$tax->AutId = $authorId;
	$tax->Valid = $valid;
	$tax->Pages = $pages;
	if ($qualifier >= 0 && $qualifier < count(Tax::getQualifiers())) {
		$tax->Qualifier = $qualifier;
	}
	// Change loc
	$tax->save();
	// Create log entry
	Log::logRecordModify($tax->TaxId, $archiveTax->TaxId,"Tax");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>