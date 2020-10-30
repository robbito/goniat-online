<?php

/**
 * Get bnd basic form
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$bndId = Page::postString('RecordId');
	$edit = Page::postBool('Edit');

	if (!Record::isIdValid($bndId)) {
		throw New GonInvalidArgumentException;
	}

	$bnd = Bnd::loadFromBndId($bndId);

	if (!isset($bnd)) {
		Page::error('Specified BndId does not exist');
	}

	if ($edit) {
		if (!Page::isEditor()) {
			throw new GonOperationFailedException;
		}
		require 'tpl/bndBasicEdit.tpl.php5';
	}
	else {
		require 'tpl/bndBasic.tpl.php5';
	}
}
catch (GonException $e) {
	HandleException($e,'bndBasic');
}
