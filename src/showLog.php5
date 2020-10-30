<?php

/**
 * Get loc notes
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	if (!Page::isAdmin()) {
		throw new GonInvalidArgumentException;
	}	

	$recordId = '';
	$hist = Log::loadAll(100);

	require 'tpl/showLog.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showLog');
}

?>