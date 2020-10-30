<?php

/**
 * Get tax literature
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

	$lits = Lit::loadFromTaxId($taxId);

	require 'tpl/taxLit.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'taxLit');
}

?>