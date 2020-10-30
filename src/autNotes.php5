<?php

/**
 * Get aut notes
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$autId = Page::getString('AutId');

	if (!Record::isIdValid($autId)) {
		throw new GonInvalidArgumentException(array('AutId' => $autId));
	}

	$aut = Aut::loadFromAutId($autId);
	$editable = $aut->isEditable();
	if (Page::IsEditor() && $editable) {
		$notes = $aut->getNotes();
	}
	else {
		$notes = injectRecordLinks($aut->getNotes());
	}

	require 'tpl/notes.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'autNotes');
}

?>