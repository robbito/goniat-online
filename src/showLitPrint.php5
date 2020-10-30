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
	
	$editable = false;
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
	$taxa = Tax::loadFromLitIdSorted($litId);

	$locCount = $lit->GetLocCount();
	$locs = Loc::sortByGeography(Loc::loadFromLitId($litId));

	$notes = injectRecordLinks($lit->getNotes());

	require 'tpl/litRecordPrint.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showLitPrint');
}
?>