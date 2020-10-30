<?php

/**
 * Browse authors
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$sel = Aut::loadAll();
	$autNum = count($sel);
	require 'tpl/autSelection.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'browseAut');
}
?>