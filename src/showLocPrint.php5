<?php

/**
 * Show loc record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$editable = false;
	$locId = Page::getString('LocId');

	if (!Record::isIdValid($locId))
		throw New GonInvalidArgumentException;

	$loc = Loc::loadFromLocId($locId);

	if (!isset($loc)) {
		$msg = 'Specified LocId does not exist';
		require 'tpl/error.tpl.php5';
		exit();
	}

	$geography = $loc->getGeography();
	$geo = end($geography);
	$lowerBoundary = $loc->getLowerBoundary();
	$upperBoundary = $loc->getUpperBoundary();

	$figs = $loc->getFigures();
	$figCount = count($figs);

	if ($geo->Type == 0) {
		$taxa = Tax::loadFromLocIdSorted($locId);
		$taxCount = count($taxa);
	}

	$lits = Lit::loadFromLocId($locId);
	$litCount = count($lits);

	if ($geo->Type != 0) {
		$geos = Geo::loadFromParentId($geo->GeoId);
	}

	$notes = injectRecordLinks($loc->getNotes());

	require 'tpl/locRecordPrint.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showLocPrint');
}
?>