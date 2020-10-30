<?php

/**
 * Show loc figure
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$fig = Page::getString("Fig");
	$archive = Page::getBool("Archive");

	if (preg_match("/LOC\d{1,5}[A-Z]?(\-\d+)?\.[BMP|JPG|PNG|GIF|JPEG]/i",$fig) == 0)
		throw new GonInvalidArgumentException;

	require "tpl/figureBig.tpl.php5";
}
catch (GonException $e) {
	HandleException($e,'showLocFig');
}
?>