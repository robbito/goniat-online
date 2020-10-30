<?php

/**
 * Get tax localities
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$taxId = Page::getString('TaxId');

	if (!Record::isIdValid($taxId)) {
		throw new GonInvalidArgumentException(array('TaxId' => $taxId));
	}

	$tax = Tax::loadFromTaxId($taxId);
	$editable = $tax->isEditable();

	$locs = Loc::sortByGeography(Loc::loadFromTaxId($taxId));

	require 'tpl/taxLoc.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'taxLoc');
}

?>