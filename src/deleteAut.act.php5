<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("browseAut","showAut"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	// Get parameters
	$autId = Page::getString("RecId");
	// Check parameters
	if (!Record::isIdValid($autId)) {
		sendResponse("error","Invalid argument");
	}

	$aut = Aut::loadFromAutId($autId);
	if (is_null($aut)) {
		sendResponse("error","Invalid argument");
	}

	if (!$aut->isDeletable()) {
		sendResponse("error","Invalid argument");
	}

	$litCount = $aut->getLitCount();
	$taxCount = $aut->getTaxCount();
	if ($litCount || $taxCount) {
		$msg = "This author is still used in some ";
		if ($litCount)
			$msg .= "references";
		if ($litCount && $taxCount)
			$msg .= " and ";
		if ($taxCount)
			$msg .= "taxa";
		$msg .= ". Please delete these links first.";
		sendResponse("error",$msg);
	}
	$aut->delete();
	Log::logRecordDelete($autId,"Aut");

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

