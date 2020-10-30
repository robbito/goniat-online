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

	$countTax = Tax::getRecordCount();
	$countLit = Lit::getRecordCount();
	$countLoc = Loc::getRecordCount();
	
	require 'tpl/index.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'index');
}
