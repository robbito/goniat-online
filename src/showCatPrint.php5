<?php

/**
 * Show tax record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

$cats = array();
$qualifiers = array();

function loadSubcat($arg_tag)
{
	global $cats,$qualifiers;
	$cats = Cat::loadFromParentId($arg_tag->CatId);
	// Extract Cat Ids
	$catIds = array();
	foreach ($cats as $cat)
		$catIds[] = $cat->CatId;
	// Load Qualifiers
	$qualifiers = Tax::loadQualifiersFromCatSet($catIds);
}

function loadSpecies($arg_tag)
{
	global $cats,$qualifiers;
	$cats = Cat::loadPathsFromAncestorId($arg_tag->CatId,3);
	$qualifiers = Tax::loadQualifiersFromCatSet(array_values($cats));
}

try {
	Page::init();
	
	$editable = false;
	$catId = Page::getString('CatId');

	if (!Record::isIdValid($catId))
		throw New GonInvalidArgumentException;

	$cat = Cat::loadFromCatId($catId);

	if (!isset($cat)) {
		$msg = 'Specified CatId does not exist';
		require 'tpl/error.tpl.php5';
		exit();
	}

	$catIds = array();
	$taxonomy = Cat::loadPathFromCatId($cat->CatId);

	$subCount = $cat->getChildrenCount();

	$spcCount = $cat->getSiblingsCount(0);
	$spcQualCount = $cat->GetSiblingsQualifiedCount(0,'1,9,10,15,16');

	$notes = injectRecordLinks($cat->getNotes());

	require 'tpl/catRecordPrint.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showCatPrint');
}
?>