<?php

/**
 * Show cat record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$catId = Page::getString('CatId');

	if (!Record::isIdValid($catId)) {
		throw New GonInvalidArgumentException;
	}

	$cat = Cat::loadFromCatId($catId);

	if (!isset($cat)) {
		Page::error('Specified CatId does not exist');
	}

	$catIds = array();
	$taxonomy = $cat->getTaxonomy();
	$cats = Cat::loadFromParentId($cat->CatId);
	$subCount = count($cats);
	// Extract Cat Ids
	foreach ($cats as $catTmp) {
		$catIds[] = $catTmp->CatId;
	}
	// Load Qualifiers
	$qualifiers = Tax::loadQualifiersFromCatSet($catIds);
	$spcCount = $cat->getSiblingsCount(0);
	$spcQualCount = $cat->GetSiblingsQualifiedCount(0,'1,9,10,15,16');

	require 'tpl/catRecord.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showCat');
}
?>