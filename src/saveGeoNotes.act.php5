<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showGeo","showLocGeo"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error", "Invalid operation");
	}
	
	$geoId = Page::getString("recordId");

	if (!Record::isIdValid($geoId)) {
		sendResponse("error", "Invalid argument");
	}
	
	$notes = Page::getHtmlString("notesContent");
	
	$geo = Geo::loadFromGeoId($geoId);
	
	if ($geo->Status != 0) {
		sendResponse("error", "Cannot modify archive record");
	}
	
	if ($geo->getNotes() == $notes) {
		sendResponse("success", "No chnages detected");
	}
	
	$archive = $geo->createArchive();
	$geo->saveNotes($notes);
	Log::logRecordModify($geo->GeoId, $archive->GeoId,"Geo");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}
