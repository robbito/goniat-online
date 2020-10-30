<?php

/**
 * Show cat record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$catId = Page::getString('CatId');
	$select = Page::getBool('Select');

	if (!Record::isIdValid($catId))
		throw New GonInvalidArgumentException;

	$catIds = array();
	$qualifiers = array();
	// Load children
	$cats = Cat::loadFromParentId($catId);
	// Extract Cat Ids
	foreach ($cats as $cat)
		$catIds[] = $cat->CatId;
	// Load Qualifiers
	$qualifiers = Tax::loadQualifiersFromCatSet($catIds);

	require 'tpl/taxChildren.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'taxChildren');
}
?>