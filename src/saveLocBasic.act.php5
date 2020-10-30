<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLoc"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$locId = Page::getString("recordId");
	$name = Page::getString("Name");
	$loBoundId = Page::getString("LoBoundId");
	$loBoundTxt = Page::getString("LoBound");
	$upBoundId = Page::getString("UpBoundId");
	$upBoundTxt = Page::getString("UpBound");
	$geoRef = Page::getString("GeoRef");

	if (!Record::isIdValid($locId))
		sendResponse("error","Invalid argument");
	
	if ($name == "")
		sendResponse ("error","Name cannot be empty");

	if ($loBoundTxt == "")
		$loBoundId = "";
	elseif ($loBoundId == "")
		sendResponse ("error","Specified lower boundary does not exist. Please create boundary record first.");

	if ($upBoundTxt == "")
		$upBoundId = "";
	elseif ($upBoundId == "")
		sendResponse ("error","Specified upper boundary does not exist. Please create boundary record first.");
	
	$loc = Loc::loadFromLocId($locId);
	$geo = Geo::loadFromGeoId($loc->GeoId);

	if ($loc->Status != 0)
		sendResponse("error","Cannot modify archive record");

	// Check for changes
	if ($name == $geo->Name && $loBoundId == $loc->BndLoId && $upBoundId == $loc->BndUpId && $geoRef == $loc->GeoRef)
		sendResponse("success","No changes detected");
	
	// Create archive record as copy 
	$archiveGeo = null;
	$archiveLoc = $loc->createArchive();
	if ($name != $geo->Name) {
		$archiveGeo = $geo->createArchive();
		$archiveLoc->GeoId = $archiveGeo->GeoId;
		$archiveLoc->save();
		$geo->Name = $name;
		$geo->save();
		Log::logRecordModify($geo->GeoId,$archiveGeo->GeoId, "Geo");
	}
		
	$loc->BndLoId = $loBoundId;
	$loc->BndUpId = $upBoundId;
	$loc->GeoRef = $geoRef;
	// Change loc
	$loc->save();
	// Create log entry
	Log::logRecordModify($loc->LocId, $archiveLoc->LocId,"Loc");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>