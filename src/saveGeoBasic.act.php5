<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showGeo","showLocGeo"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$geoId = Page::getString("recordId");
	$name = Page::getString("Name");

	if (!Record::isIdValid($geoId))
		sendResponse("error","Invalid argument");
	
	if ($name == "")
		sendResponse ("error","Name cannot be empty");
	

	$geo = Geo::loadFromGeoId($geoId);

	if ($geo->Status != 0)
		sendResponse("error","Cannot modify archive record");

	// Check for changes
	if ($name == $geo->Name)
		sendResponse("success","No changes detected");
	
	// Create archive record as copy 
	$archiveGeo = $geo->createArchive();
	$geo->Name = $name;
	$geo->save();
	Log::logRecordModify($geo->GeoId,$archiveGeo->GeoId, "Geo");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>