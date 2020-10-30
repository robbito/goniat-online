<?php

/**
 * Show lit record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$litId = Page::getString('LitId');

	if (!Record::isIdValid($litId))
		throw New GonInvalidArgument;

	$lit = Lit::loadFromLitId($litId);

	if (!isset($lit)) {
		$msg = 'Specified LitId does not exist';
		require 'tpl/error.tpl.php5';
		exit();
	}

	$author1 = $lit->getAuthor1();
	$author2 = $lit->getAuthor2();
	$author3 = $lit->getAuthor3();
	$taxCount = $lit->getTaxCount();
	$locCount = $lit->GetLocCount();
	$notes = injectRecordLinks($lit->getNotes());

	require 'tpl/litRecord.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showLit');
}
?>