<?php

/**
 * Show geo children page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$geoId = Page::getString('GeoId');
	$select = Page::getBool('Select');

	if (!Record::isIdValid($geoId))
		throw New GonInvalidArgumentException;

	// Load children
	$geos = Geo::loadFromParentId($geoId);

	require 'tpl/geoChildren.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'geoChildren');
}
?>