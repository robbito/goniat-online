<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("manageUsers"));

	// Check permission of current user
	if (!Page::isAdmin())
		Page::error("Not allowed.");

	$accounts = Account::loadAll();

	require 'tpl/accounts.tpl.php5';
}
catch (GonException $e) {
	HandleError($e);
}

?>