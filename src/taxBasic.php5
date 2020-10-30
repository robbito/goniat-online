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
	
	$taxId = Page::postString('RecordId');
	$edit = Page::postBool('Edit');

	if (!Record::isIdValid($taxId)) {
		throw new GonInvalidArgumentException(array('TaxId' => $taxId));
	}

	$tax = Tax::loadFromTaxId($taxId);

	if (!isset($tax)) {
		Page::error('Specified TaxId does not exist');
	}
	
	$taxonomy = $tax->getTaxonomy();
	$author = $tax->getAuthor();
	$lowerBoundary = $tax->getLowerBoundary();
	$upperBoundary = $tax->getUpperBoundary();
	$notes = $tax->getNotes();

	if ($edit) {
		if (!Page::isEditor()) {
			throw new GonOperationFailedException;
		}
		require 'tpl/taxBasicEdit.tpl.php5';
	}
	else {
		require 'tpl/taxBasic.tpl.php5';
	}
}
catch (GonException $e) {
	HandleException($e,'taxBasic');
}
