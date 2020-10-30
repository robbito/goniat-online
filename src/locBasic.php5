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
	
	$locId = Page::postString('RecordId');
	$edit = Page::postBool('Edit');

	if (!Record::isIdValid($locId)) {
		throw New GonInvalidArgumentException;
	}

	$loc = Loc::loadFromLocId($locId);

	if (!isset($loc)) {
		Page::error('Specified LocId does not exist');
	}

	$geography = $loc->getGeography();
	$lowerBoundary = $loc->getLowerBoundary();
	$upperBoundary = $loc->getUpperBoundary();

	if ($edit) {
		if (!Page::isEditor()) {
			throw new GonOperationFailedException;
		}
		require 'tpl/locBasicEdit.tpl.php5';
	}
	else {
		require 'tpl/locBasic.tpl.php5';
	}
}
catch (GonException $e) {
	HandleException($e,'locBasicEdit');
}
