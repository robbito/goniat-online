<?php

/**
 * Show geo hierarchy page for selection
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();

	$geos = Geo::loadHierarchy();

	require 'tpl/geoHierarchySelect.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'geoHierarchySelect');
}
?>