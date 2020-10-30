<?php

/**
 * Show bnd record page
 *
 * @version $Id$
 * @copyright 3024
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$bndId = Page::getString('BndId');

	if (!Record::isIdValid($bndId))
		throw new GonInvalidArgumentException;

	$bnd = Bnd::loadFromBndId($bndId);

	if (!isset($bnd)) {
		$msg = 'Specified BndId does not exist';
		require 'tpl/error.tpl.php5';
		exit();
	}

	$locCount = $bnd->getLocCount();
	$taxCount = $bnd->getTaxCount();

	require 'tpl/bndRecord.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showBnd');
}
?>