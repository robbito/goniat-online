<?php

/**
 * Get cat species
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();

	$catId = $_GET['CatId'];

	if (!Record::isIdValid($catId))
		throw new GonInvalidArgumentException(array('CatId' => $catId));

	$cats = Cat::loadPathsFromAncestorId($catId,3);
	$qualifiers = Tax::loadQualifiersFromCatSet(array_values($cats));

	require 'tpl/catSpc.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'catSpc');
}

?>