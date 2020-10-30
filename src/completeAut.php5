<?php

/**
 * Searches taxa for autocomplete field
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();

	$author = Page::getString('term');
	$all = Page::getBool('all');

	//Check parameters
	if (!isset($author) || strlen($author) > 50) {
		throw new GonInvalidArgumentException;
	}

	$records = Aut::loadFromName($author,$all);
	$count = count($records);
	$authors = array();

	for ($i = 0; $i < $count; $i++) {
		$id = $records[$i]->AutId;
		$value = $records[$i]->LastName;
		if (strlen($records[$i]->FirstName))
			$value .= ", " . $records[$i]->FirstName;
		$authors[] = array("id" => $id, "value" => $value);
	}

	echo json_encode($authors);
}
catch (GonException $e) {
	HandleException($e,'completeAut');
}
?>