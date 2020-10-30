<?php

/**
 * Get tax sub categories
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

	$catIds = array();
	$qualifiers = array();
	$tax = Tax::loadFromTaxId($taxId);
	$editable = $tax->isEditable();
	$cats = array();
	$cat = null;

	if (isset($tax)) {
		$cat = Cat::loadFromCatId($tax->CatId);
		$cats = Cat::loadFromParentId($tax->CatId);
		// Extract Cat Ids
		foreach ($cats as $catTmp)
			$catIds[] = $catTmp->CatId;
		// Load Qualifiers
		$qualifiers = Tax::loadQualifiersFromCatSet($catIds);
	}

	require 'tpl/catSub.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'taxSub');
}

?>