<?php

/**
 * Get lit localities
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$litId = Page::getString('LitId');

	if (!Record::isIdValid($litId)) {
		throw new GonInvalidArgumentException(array('LitId' => $litId));
	}

	$lit = Lit::loadFromLitId($litId);
	$editable = $lit->isEditable();
	
	$locs = Loc::sortByGeography(Loc::loadFromLitId($litId));

	require 'tpl/taxLoc.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'litLoc');
}

?>