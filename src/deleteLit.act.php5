<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLit"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	// Get parameters
	$litId = Page::getString("RecId");
	// Check parameters
	if (!Record::isIdValid($litId)) {
		sendResponse("error","Invalid argument");
	}

	$lit = Lit::loadFromLitId($litId);
	if (is_null($lit)) {
		sendResponse("error","Invalid argument");
	}

	if (!$lit->isDeletable()) {
		sendResponse("error","Invalid argument");
	}

	$locCount = $lit->getLocCount();
	$taxCount = $lit->getTaxCount();
	if ($locCount || $taxCount) {
		$msg = "This reference is still used in some ";
		if ($locCount)
			$msg .= "localities";
		if ($locCount && $taxCount)
			$msg .= " and ";
		if ($taxCount)
			$msg .= "taxa";
		$msg .= ". Please delete these links first.";
		sendResponse("error",$msg);
	}
	$lit->delete();
	Log::logRecordDelete($litId,"Lit");

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

