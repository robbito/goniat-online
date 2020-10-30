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
	
	$catId = Page::postString('RecordId');
	$edit = Page::postBool('Edit');

	if (!Record::isIdValid($catId)) {
		throw New GonInvalidArgumentException;
	}

	$cat = Cat::loadFromCatId($catId);

	if (!isset($cat)) {
		Page::error('Specified GeoId does not exist');
	}

	$taxonomy = Cat::loadPathFromCatId($cat->CatId);

	if ($edit) {
		if (!Page::isEditor())
			throw new GonOperationFailedException;
		require 'tpl/catBasicEdit.tpl.php5';
	}
	else {
		require 'tpl/catBasic.tpl.php5';
	}
}
catch (GonException $e) {
	HandleException($e,'catBasic');
}
?>