<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("browseBnd","showBnd"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	// Get parameters
	$bndId = Page::getString("RecId");
	// Check parameters
	if (!Record::isIdValid($bndId)) {
		sendResponse("error","Invalid argument");
	}

	$bnd = Bnd::loadFromBndId($bndId);
	if (is_null($bnd)) {
		sendResponse("error","Invalid argument");
	}
	if (!$bnd->isDeletable()) {
		sendResponse("error","Invalid argument");
	}

	$locCount = $bnd->getLocCount();
	$taxCount = $bnd->getTaxCount();
	if ($locCount || $taxCount) {
		$msg = "This boundary is still used in some ";
		if ($locCount)
			$msg .= "localities";
		if ($locCount && $taxCount)
			$msg .= " and ";
		if ($taxCount)
			$msg .= "taxa";
		$msg .= ". Please delete these links first.";
		sendResponse("error",$msg);
	}
	$bnd->delete();
	Log::logRecordDelete($bndId,"Bnd");

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

