<?php

/**
 * Get loc basic form
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$geoId = Page::postString('RecordId');
	$edit = Page::postBool('Edit');

	if (!Record::isIdValid($geoId))
		throw New GonInvalidArgumentException;

	$geo = Geo::loadFromGeoId($geoId);

	if (!isset($geo))
		Page::error('Specified GeoId does not exist');

	$geography = $geo->getGeography();

	if ($edit) {
		if (!Page::isEditor())
			throw new GonOperationFailedException;
		require 'tpl/geoBasicEdit.tpl.php5';
	}
	else {
		require 'tpl/geoBasic.tpl.php5';
	}
}
catch (GonException $e) {
	HandleException($e,'geoBasic');
}
?>