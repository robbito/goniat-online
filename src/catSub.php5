<?php

/**
 * Get cat sub categories
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();

	$catId = Page::getString('CatId');

	if (!Record::isIdValid($catId))
		throw new GonInvalidArgumentException(array('CatId' => $catId));
	
	$cat = Cat::loadFromCatId($catId);
	$editable = $cat->isEditable();

	$catIds = array();
	$qualifiers = array();
	$cats = Cat::loadFromParentId($catId);
	// Extract Cat Ids
	foreach ($cats as $catTmp)
		$catIds[] = $catTmp->CatId;
	// Load Qualifiers
	$qualifiers = Tax::loadQualifiersFromCatSet($catIds);

	require 'tpl/catSub.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'catSub');
}

?>