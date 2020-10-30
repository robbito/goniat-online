<?php

/**
 * Get cat notes
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();

	$catId = Page::getString('CatId');

	if (!Record::isIdValid($catId)) {
		throw new GonInvalidArgumentException(array('CatId' => $catId));
	}

	$cat = Cat::loadFromCatId($catId);
	$editable = $cat->isEditable();
	if (Page::IsEditor() && $editable) {
		$notes = $cat->getNotes();
	}
	else {
		$notes = injectRecordLinks($cat->getNotes());
	}

	require 'tpl/notes.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'catNotes');
}

?>