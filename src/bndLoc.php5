<?php

/**
 * Get boundary taxa
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$bndId = Page::getString('BndId');

	if (!Record::isIdValid($bndId))
		throw new GonInvalidArgumentException(array('BndId' => $bndId));

	$bnd = Bnd::loadFromBndId($bndId);
	$editable = false;

	$locs = Loc::sortByGeography(Loc::loadFromBndId($bndId));

	require 'tpl/taxLoc.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'bndLoc');
}

?>