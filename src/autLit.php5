<?php

/**
 * Get aut literature
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$autId = Page::getString('AutId');

	if (!Record::isIdValid($autId)) {
		throw new GonInvalidArgumentException(array('AutId' => $autId));
	}

	$aut = Aut::loadFromAutId($autId);
	$editable = false;

	$lits = Lit::loadFromAutId($autId);

	require 'tpl/taxLit.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'autLit');
}

?>