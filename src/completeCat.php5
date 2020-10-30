<?php

/**
 * Searches categories for autocomplete field
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();

	$type = Page::getInt('type');
	$value = Page::getString('term');
	$parentType = Page::getInt('parType');
	$parentValue = Page::getString('parValue');

	//Check parameters
	if (strlen($value) > 30) {
		throw new GonInvalidArgumentException;
	}
	if ($type < 0 || $type > 7) {
		throw new GonInvalidArgumentException;
	}
	if (isset($parentValue))
	{
		if (strlen($parentValue) == 0 || strlen($parentValue) > 30) {
			throw new GonInvalidArgumentException;
		}
		if ($parentType < 0 || $parentType > 7 || $parentType == $type) {
			throw new GonInvalidArgumentException;
		}
	}

	$records = Cat::loadFromName($value,$type,$parentValue,$parentType);
	$prevName = '';
	$count = count($records);
	$uniqueNames = array();

	for ($i = 0; $i < $count; $i++) {
		$name = $records[$i]->Name;
		if ($name != $prevName) {
			$uniqueNames[] = array("value" => $name);
			$prevName = $name;
		}
	}

	echo json_encode($uniqueNames);
}
catch (GonException $e) {
	HandleException($e,'completeCat');
}
?>