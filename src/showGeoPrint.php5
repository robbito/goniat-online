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
	
	$editable = false;
	$geoId = Page::getString('GeoId');

	if (!Record::isIdValid($geoId))
		throw New GonInvalidArgumentException;

	$geo = Geo::loadFromGeoId($geoId);

	if (!isset($geo)) {
		$msg = 'Specified GeoId does not exist';
		require 'tpl/error.tpl.php5';
		exit();
	}

	$geography = $geo->getGeography();
	$geos = Geo::loadFromParentId($geo->GeoId);
	$subCount = count($geos);

	$notes = $geo->getNotes();

	require 'tpl/geoRecordPrint.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showGeoPrint');
}
?>