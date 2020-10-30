<?php

/**
 * Get geo notes
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$geoId = Page::getString('GeoId');

	if (!Record::isIdValid($geoId)) {
		throw new GonInvalidArgumentException(array('GeoId' => $geoId));
	}

	$geo = Geo::loadFromGeoId($geoId);
	$editable = $geo->isEditable();
	if (Page::IsEditor() && $editable) {
		$notes = $geo->getNotes();
	}
	else {
		$notes = injectRecordLinks($geo->getNotes());
	}

	require 'tpl/notes.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'geoNotes');
}

?>