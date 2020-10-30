<?php

/**
 * Get geo sub regions
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$geoId = Page::getString('GeoId');

	if (!Record::isIdValid($geoId))
		throw new GonInvalidArgumentException(array('GeoId' => $geoId));

	$geo = Geo::loadFromGeoId($geoId);
	$editable = $geo->isEditable();

	$linkBase = getLinkBase();
	$geos = Geo::loadFromParentId($geoId);

	require 'tpl/geoSub.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'geoSub');
}

?>