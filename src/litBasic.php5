<?php

/**
 * Get lit basic form
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$litId = Page::postString('RecordId');
	$edit = Page::postBool('Edit');

	if (!Record::isIdValid($litId)) {
		throw New GonInvalidArgumentException;
	}

	$lit = Lit::loadFromLitId($litId);

	if (!isset($lit)) {
		Page::error('Specified LitId does not exist');
	}

	$author1 = $lit->getAuthor1();
	$author2 = $lit->getAuthor2();
	$author3 = $lit->getAuthor3();

	if ($edit) {
		if (!Page::isEditor()) {
			throw new GonOperationFailedException;
		}
		require 'tpl/litBasicEdit.tpl.php5';
	}
	else {
		require 'tpl/litBasic.tpl.php5';
	}
}
catch (GonException $e) {
	HandleException($e,'locBasicEdit');
}
