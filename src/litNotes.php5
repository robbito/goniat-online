<?php

/**
 * Get tax literature
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();
	
	$litId = Page::getString('LitId');

	if (!Record::isIdValid($litId)) {
		throw new GonInvalidArgumentException(array('LitId' => $litId));
	}

	$lit = Lit::loadFromLitId($litId);
	$editable = $lit->isEditable();
	if (Page::IsEditor() && $editable) {
		$notes = $lit->getNotes();
	} else {
		$notes = injectRecordLinks($lit->getNotes());
	}

	require 'tpl/notes.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'litNotes');
}

?>