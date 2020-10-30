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

function getFeatureHTML($arg_tax,$arg_feature,$arg_class = 0)
{
	$feature = $arg_tax->getFeature($arg_feature,$arg_class);

	if (is_null($feature) || $feature === '')
		return '&nbsp;';

	return $feature;
}

function getFeatureTitle($arg_tax,$arg_feature,$arg_class = 0)
{
	return '';
}

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
	$taxId = Page::getString('TaxId');

	if (!Record::isIdValid($taxId))
		throw New GonInvalidArgumentException;

	$tax = Tax::loadFromTaxId($taxId);

	if (!isset($tax)) {
		$msg = 'Specified TaxId does not exist';
		require 'tpl/error.tpl.php5';
		exit();
	}

	$taxonomy = $tax->getTaxonomy();
	$cat = end($taxonomy);
	$author = $tax->getAuthor();
	$lowerBoundary = $tax->getLowerBoundary();
	$upperBoundary = $tax->getUpperBoundary();
	$figCount = $tax->getFigureCount();
	$figs = null;
	if ($figCount)
		$figs = $tax->getFigures();
	$litCount = $tax->getLitCount();
	$lits = null;
	if ($litCount)
		$lits = Lit::loadFromTaxId($taxId);
	$locCount = $tax->GetLocCount();
	$locs = null;
	if ($locCount)
		$locs = Loc::sortByGeography(Loc::loadFromTaxId($taxId));
	$notes = injectRecordLinks($tax->getNotes());
	$subCount = 0;
	$spcCount = 0;

	if ($cat->Type != 0) {
		$subCount = $cat->getChildrenCount();
		$spcCount = $cat->getSiblingsCount(0);
		$spcQualCount = $cat->GetSiblingsQualifiedCount(0,'1,9,10,15,16');
	}

	require 'tpl/taxRecordPrint.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showTaxPrint');
}
?>