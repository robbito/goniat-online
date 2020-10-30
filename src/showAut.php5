<?php

/**
 * Show aut record page
 *
 * @version $Id$
 * @copyright 3024
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$autId = Page::getString('AutId');

	if (!Record::isIdValid($autId))
		throw new GonInvalidArgumentException;

	$aut = Aut::loadFromAutId($autId);

	if (!isset($aut)) {
		$msg = 'Specified AutId does not exist';
		require 'tpl/error.tpl.php5';
		exit();
	}

	$litCount = $aut->getLitCount();
	$taxCount = $aut->getTaxCount();

	require 'tpl/autRecord.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showAut');
}
?>