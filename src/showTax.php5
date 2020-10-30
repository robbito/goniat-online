<?php

/**
 * Show tax record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$taxId = Page::getString('TaxId');

	if (!Record::isIdValid($taxId)) {
		throw New GonInvalidArgumentException;
	}

	$tax = Tax::loadFromTaxId($taxId);

	if (!isset($tax)) {
		Page::error('Specified TaxId does not exist');
	}

	$taxonomy = $tax->getTaxonomy();
	$cat = end($taxonomy);
	$author = $tax->getAuthor();
	$lowerBoundary = $tax->getLowerBoundary();
	$upperBoundary = $tax->getUpperBoundary();
	$figCount = $tax->getFigureCount();
	$litCount = $tax->getLitCount();
	$locCount = $tax->GetLocCount();
	$notes = injectRecordLinks($tax->getNotes());
	$subCount = 0;
	$spcCount = 0;
	$lits = null;
	$editable = false;

	if ($cat->Type != 0) {
		$subCount = $cat->getChildrenCount();
		$spcCount = $cat->getSiblingsCount(0);
		$spcQualCount = $cat->GetSiblingsQualifiedCount(0,'1,9,10,15,16');
		if ($litCount) {
			$lits = Lit::loadFromTaxId($taxId);
		}
	}

	require 'tpl/taxRecord.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showTax');
}
