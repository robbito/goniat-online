<?php

/**
 * Start page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	// This page is for admins only
	if (!Page::isLoggedIn())
		redirect('index');
	
	$account = Page::getAccount();
	
	require 'tpl/accountSettings.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'accountSettings');
}

?>
