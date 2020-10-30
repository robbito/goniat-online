<?php

/**
 * Get tax species
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$taxId = Page::getString('TaxId');

	if (!Record::isIdValid($taxId))
		throw new GonInvalidArgumentException(array('TaxId' => $taxId));

	$tax = Tax::loadFromTaxId($taxId);
	$cats = array();

	if (isset($tax)) {
		$cats = Cat::loadPathsFromAncestorId($tax->CatId,3);
		$qualifiers = Tax::loadQualifiersFromCatSet(array_values($cats));
	}

	require 'tpl/catSpc.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'taxSpc');
}

?>