<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showGeoNew"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$parentId = Page::getString("ParentId");
	$geoId = Page::getString("recordId");
	$name = Page::getString("Name");
	$type = Page::getInt("Type");

	if ($geoId != "") {
		sendResponse("error","Invalid argument");
	}
	
	if ($name == "") {
		sendResponse ("error","Name cannot be empty");
	}
	
	$parent = null;
	
	if (Record::isIdValid($parentId)) {
		$parent = Geo::loadFromGeoId($parentId);
	
		if ($parent->Type == 0) {
			sendResponse ("error","Invalid argument");
		}
	}
	else {
		$parentId = null;
	}
	
	$geo = Geo::create();
	
	$geo->ParentId = $parentId;
	$geo->Name = $name;
	$geo->Type = $type;
	$geo->save();
	Log::logRecordCreate($geo->GeoId,"Geo");
	
	sendResponse("success","Record was successfully created","showGeo.html?GeoId=".$geo->GeoId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>