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
	
	$locId = Page::getString('LocId');

	if (!Record::isIdValid($locId)) {
		throw New GonInvalidArgumentException;
	}

	$loc = Loc::loadFromLocId($locId);

	if (!isset($loc)) {
		Page::error('Specified LocId does not exist');
	}

	$geography = $loc->getGeography();
	$lowerBoundary = $loc->getLowerBoundary();
	$upperBoundary = $loc->getUpperBoundary();
	$figCount = $loc->getFigureCount();
	$taxCount = $loc->GetTaxCount();
	$litCount = $loc->getLitCount();
	$geo = Geo::loadFromGeoId($loc->GeoId);
	if ($geo->Type != 0) {
		$geos = Geo::loadFromParentId($loc->GeoId);
		$subCount = count($geos);
		$layCount = $geo->getSiblingsCount(0);
	}
	$notes = injectRecordLinks($loc->getNotes());
	$editable = false;

	require 'tpl/locRecord.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showLoc');
}
