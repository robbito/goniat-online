<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showTax","showLit"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	// Get parameters
	$taxId = Page::getString("TaxId");
	$litId = Page::getString("LitId");
	// Check parameters
	if (!Record::isIdValid($taxId) || !Record::isIdValid($litId))
		sendResponse("error","Invalid argument");
	
	$tax = Tax::loadFromTaxId($taxId);
	if (is_null($tax))
		sendResponse("error","Invalid argument");

	$tax->addLitLink($litId);
	Log::logRelationCreate($taxId,"Tax",$litId,"Lit");

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>
