<?php

/**
 * Get loc search form
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	require 'tpl/searchFormLoc.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'searchFormLoc');
}

?>