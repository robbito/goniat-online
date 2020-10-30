<?php

/**
 * Show new aut record page
 *
 * @version $Id$
 * @copyright 3024
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	if (!Page::isEditor())
		throw new GonOperationFailedException;

	$aut = Aut::create();

	require 'tpl/autRecordNew.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showAutNew');
}
?>