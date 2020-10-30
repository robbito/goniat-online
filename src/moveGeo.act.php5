<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("locHierarchy"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$parentId = Page::getString("ParentId");
	$geoId = Page::getString("GeoId");

	if (!Record::isIdValid($geoId)) {
		sendResponse("error","Invalid argument");
	}
	
	$geo = Geo::loadFromGeoId($geoId);
	
	if (!isset($geo)) {
		sendResponse("error","Invalid argument");
	}
	
	$parent = null;
	if (Record::isIdValid($parentId)) {
		$parent = Geo::loadFromGeoId($parentId);
		if (!isset($parent)) {
			sendResponse("error","Invalid argument");
		}
		if ($geo->Type >= $parent->Type) {
			sendResponse("error","The parent type is not valid");
		}
	}
	
	$geo->moveNode($parent);
	
	sendResponse("success","Record was successfully moved");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>