<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("taxHierarchy"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$parentId = Page::getString("ParentId");
	$catId = Page::getString("CatId");

	if (!Record::isIdValid($catId)) {
		sendResponse("error","Invalid argument");
	}
	
	$cat = Cat::loadFromCatId($catId);
	
	if (!isset($cat)) {
		sendResponse("error","Invalid argument");
	}
	
	$parent = null;
	if (Record::isIdValid($parentId)) {
		$parent = Cat::loadFromCatId($parentId);
		if (!isset($parent)) {
			sendResponse("error","Invalid argument");
		}
		if ($cat->Type >= $parent->Type) {
			sendResponse("error","The parent type is not valid");
		}
	}
	
	$cat->moveNode($parent);
	
	sendResponse("success","Record was successfully moved");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>