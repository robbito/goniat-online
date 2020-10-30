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
	if (!Page::isAdmin())
		redirect('index');
	
	require 'tpl/manageUsers.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'manageAccounts');
}

?>
