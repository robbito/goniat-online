<?php

/**
 * Show geo hierarchy page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();

	$select = false;
	$geos = Geo::loadHierarchy();

	require 'tpl/geoHierarchy.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'geoHierarchy');
}
?>