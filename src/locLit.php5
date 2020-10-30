<?php

/**
 * Get loc literature
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$locId = Page::getString('LocId');

	if (!Record::isIdValid($locId)) {
		throw new GonInvalidArgumentException(array('LocId' => $locId));
	}

	$loc = Loc::loadFromLocId($locId);
	$editable = $loc->isEditable();

	$lits = Lit::loadFromLocId($locId);

	require 'tpl/taxLit.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'locLit');
}

?>