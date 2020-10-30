<?php

/**
 * Show geo record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$geoId = Page::getString('GeoId');

	if (!Record::isIdValid($geoId)) {
		throw New GonInvalidArgumentException;
	}

	$loc = Loc::loadFromGeoId($geoId);

	if (isset($loc)) {
		Page::redirect("showLoc", "LocId=" . $loc->LocId);
	}

	$geo = Geo::loadFromGeoId($geoId);

	if (!isset($geo)) {
		Page::error('Specified GeoId does not exist');
	}

	$geography = $geo->getGeography();
	$geos = Geo::loadFromParentId($geo->GeoId);
	$subCount = count($geos);
	$layCount = $geo->getSiblingsCount(0);

	require 'tpl/geoRecord.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showGeo');
}
