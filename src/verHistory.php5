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
	
	$recordId = Page::getString('RecordId');

	if (!Record::isIdValid($recordId))
		throw new GonInvalidArgumentException(array('RecordId' => $recordId));

	$hist = Log::loadFromRecordId($recordId);

	require 'tpl/verHistory.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'verHistory');
}

?>