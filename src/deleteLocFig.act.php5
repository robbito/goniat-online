<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLoc"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	// Get parameters
	$fig = Page::getString("Fig");
	$locId = Page::getString("LocId");

	if (!Record::isIdValid($locId))
		throw New GonInvalidArgumentException;

	$loc = Loc::loadFromLocId($locId);

	if (!isset($loc))
		Page::error('Specified LocId does not exist');

	$archive = Loc::deleteFig($fig);
	Log::logImageDelete($locId,"Loc",$archive,"Fig");
	Log::updateImageAdd($locId,$fig,$archive);

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>
