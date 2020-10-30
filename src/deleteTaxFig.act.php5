<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showTax"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	// Get parameters
	$fig = Page::getString("Fig");
	$taxId = Page::getString("TaxId");

	if (!Record::isIdValid($taxId))
		throw New GonInvalidArgumentException;

	$tax = Tax::loadFromTaxId($taxId);

	if (!isset($tax))
		Page::error('Specified TaxId does not exist');

	$archive = Tax::deleteFig($fig);
	Log::logImageDelete($taxId,"Tax",$archive,"Fig");
	Log::updateImageAdd($taxId,$fig,$archive);

	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>
