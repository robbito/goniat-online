<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLoc"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	
	$locId = Page::getString("RecId");
	
	if (!Record::isIdValid($locId)) {
		sendResponse("error","Invalid argument");
	}
	
	$loc = Loc::loadFromLocId($locId);
	
	if (!isset($loc)) {
		sendResponse("error","Invalid argument");
	}

	$litCount = $loc->getLitCount();
	$taxCount = $loc->getTaxCount();
	
	if ($litCount || $taxCount) {
		$msg = "This locality is still linked to some ";
		if ($litCount)
			$msg .= "references";
		if ($litCount && $taxCount)
			$msg .= " and ";
		if ($taxCount)
			$msg .= "taxa";
		$msg .= ". Please delete these links first.";
		sendResponse("error",$msg);
	}
	
	$figCount = $loc->getFigureCount();
	
	if ($figCount) {
		sendResponse("error","This locality has figures. Please delete the figures first.");
	}
	
	// Change aut
	$loc->delete();
	// Create log entry
	Log::logRecordDelete($loc->LocId,"Loc");
	
	sendResponse("success",null,"showLocGeo.html?GeoId=".$loc->GeoId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}