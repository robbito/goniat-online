<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLoc","showLit"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	// Get parameters
	$locId = Page::getString("LocId");
	$litId = Page::getString("LitId");
	// Check parameters
	if (!Record::isIdValid($locId) || !Record::isIdValid($litId))
		sendResponse("error","Invalid argument");
	
	$loc = Loc::loadFromLocId($locId);
	if (is_null($loc))
		sendResponse("error","Invalid argument");

	$loc->addLitLink($litId);
	Log::logRelationCreate($locId,"Loc",$litId,"Lit");

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>
