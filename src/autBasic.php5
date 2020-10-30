<?php

/**
 * Get aut basic form
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$autId = Page::postString('RecordId');
	$edit = Page::postBool('Edit');

	if (!Record::isIdValid($autId)) {
		throw New GonInvalidArgumentException;
	}

	$aut = Aut::loadFromAutId($autId);

	if (!isset($aut)) {
		Page::error('Specified AutId does not exist');
	}

	if ($edit) {
		if (!Page::isEditor()) {
			throw new GonOperationFailedException;
		}
		require 'tpl/autBasicEdit.tpl.php5';
	}
	else {
		require 'tpl/autBasic.tpl.php5';
	}
}
catch (GonException $e) {
	HandleException($e,'autBasic');
}
