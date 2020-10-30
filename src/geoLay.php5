<?php

/**
 * Get geo layers
 *
 * @version $Id$
 * @copyright 2013
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();

	$geoId = $_GET['GeoId'];

	if (!Record::isIdValid($geoId))
		throw new GonInvalidArgumentException(array('GeoId' => $geoId));
	
	$geo = Geo::loadFromGeoId($geoId);

	$geos = Geo::loadPathsFromAncestorId($geoId,$geo->Type - 1);

	require 'tpl/geoLay.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'catSpc');
}

?>