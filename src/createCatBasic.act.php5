<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showCatNew"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$parentId = Page::getString("ParentId");
	$catId = Page::getString("recordId");
	$name = Page::getString("Name");
	$type = Page::getInt("Type");

	if ($catId != "") {
		sendResponse("error","Invalid argument");
	}
	
	if ($name == "") {
		sendResponse ("error","Name cannot be empty");
	}
	
	$parent = null;
	
	if (Record::isIdValid($parentId)) {
		$parent = Cat::loadFromCatId($parentId);
	
		if ($parent->Type == 0) {
			sendResponse ("error","Invalid argument");
		}
	}
	else {
		$parentId = null;
	}
	
	$cat = Cat::create();
	
	$cat->ParentId = $parentId;
	$cat->Name = $name;
	$cat->Type = $type;
	$cat->save();
	Log::logRecordCreate($cat->CatId,"Cat");
	
	sendResponse("success","Record was successfully created","showCat.html?CatId=".$cat->CatId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>