<?php

/**
 * Get loc sub regions
 *
 * @version $Id$
 * @copyright 2007
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
	$editable = $geo->isEditable();

	$linkBase = getLinkBase();
	$geos = Geo::loadFromParentId($loc->GeoId);

	require 'tpl/geoSub.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'geoSub');
}

?>