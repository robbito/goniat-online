<?php

/**
 * Get tax literature
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$autId = Page::getString('AutId');

	if (!Record::isIdValid($autId))
		throw new GonInvalidArgumentException(array('AutId' => $autId));

	$aut = Aut::loadFromAutId($autId);
	$editable = false;

	$taxa = Tax::loadFromAutIdSorted($autId);

	require 'tpl/litTax.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'autTax');
}

?>