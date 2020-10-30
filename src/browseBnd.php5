<?php

/**
 * Browse boundaries
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$sel = Bnd::loadAll();
	$bndNum = count($sel);
	require 'tpl/bndSelection.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'browseBnd');
}
?>