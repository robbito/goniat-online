<?php

/**
 * Show new bnd record page
 *
 * @version $Id$
 * @copyright 3024
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	if (!Page::isEditor()) {
		throw new GonOperationFailedException;
	}

	$bnd = Bnd::create();

	require 'tpl/bndRecordNew.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showBndNew');
}
?>