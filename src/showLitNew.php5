<?php

/**
 * Show new lit record page
 *
 * @version $Id$
 * @copyright 3024
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	if (!Page::isEditor())
		throw new GonOperationFailedException;

	$lit = Lit::create();

	require 'tpl/litRecordNew.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showLitNew');
}
?>