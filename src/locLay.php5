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

	$locId = Page::getString('LocId');

	if (!Record::isIdValid($locId))
		throw new GonInvalidArgumentException(array('LocId' => $locId));
	
	$loc = Loc::loadFromLocId($locId);
	$geo = Geo::loadFromGeoId($loc->GeoId);

	$geos = Geo::loadPathsFromAncestorId($loc->GeoId,$geo->Type - 1);

	require 'tpl/geoLay.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'locLay');
}

?>