<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showGeo","showLocGeo","showLoc","locHierarchy"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	// Get parameters
	$geoId = Page::getString("RecId");
	// Check parameters
	if (!Record::isIdValid($geoId)) {
		sendResponse("error","Invalid argument");
	}

	$geo = Geo::loadFromGeoId($geoId);
	if (is_null($geo)) {
		sendResponse("error","Invalid argument");
	}

	$subCount = $geo->getSubCount();
	if ($subCount) {
		sendResponse("error","This record still has some sub regions. Please delete them first.");
	}
	
	$loc = Loc::loadFromGeoId($geoId);
	if (isset($loc)) {
		sendResponse("error","This record has locality details connected. Please delete them first.");
	}
	
	if (!$geo->isDeletable()) {
		sendResponse("error","Invalid argument");
	}

	$geo->delete();
	Log::logRecordDelete($geoId,"Geo");

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

