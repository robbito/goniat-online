<?php

/**
 * Show new geo record page
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	Page::blockExcept(array("locHierarchy","showLocGeo","showGeo","showLoc"));
	
	if (!Page::isEditor())
		throw new GonOperationFailedException;

	$parentId = Page::getString('ParentId');
	$parent = null;
	$geography = array();

	if (Record::isIdValid($parentId)) {
		$parent = Geo::loadFromGeoId($parentId);
		if (!isset($parent)) {
			Page::error('Specified ParentId does not exist');
		}
		$geography = $parent->getGeography();
	}

	$geo = Geo::create();

	require 'tpl/geoRecordNew.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showGeoNew');
}
?>