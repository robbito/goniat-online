<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showGeo","showLocGeo"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	
	$geoId = Page::getString("RecId");
	
	if (!Record::isIdValid($geoId)) {
		sendResponse("error","Invalid argument");
	}
	
	$geo = Geo::loadFromGeoId($geoId);
	
	if (!isset($geo)) {
		sendResponse("error","Invalid argument");
	}

	$loc = Loc::create();
			
	$loc->GeoId = $geoId;
	// Change aut
	$loc->save();
	// Create log entry
	Log::logRecordCreate($loc->LocId,"Loc");
	
	sendResponse("success",null,"showLocGeo.html?GeoId=".$geoId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}