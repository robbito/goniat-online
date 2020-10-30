<?php

/**
 * Show cat record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();

	$account = Account::getCurrentAccount();
	$cats = Cat::loadHierarchy();

	require 'tpl/taxHierarchy.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'taxHierarchy');
}
?>