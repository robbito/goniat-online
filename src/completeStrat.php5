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

	$loBound = Page::getFloat('loBound');
	$value = Page::getFloat('term');
	$valueString = "";
	if ($value == 0.0)
		$valueString = Page::getString ('term');
	//Check parameters
	if ($loBound != 0.0 && $value != 0.0 && $loBound < $value)
		throw new GonInvalidArgumentException;

	$linkBase = getLinkBase();
	$record = array();
	if ($value != 0.0)
		$records = Bnd::loadFromYears($value,$loBound);
	else
		$records = Bnd::loadFromName($valueString,$loBound);
	$count = count($records);
	$bounds = array();

	for ($i = 0; $i < $count; $i++) {
		$id = $records[$i]->BndId;
		$value = $records[$i]->getSelectString();
		$bounds[] = array("id" => $id,"value" => $value);
	}

	echo json_encode($bounds);
}
catch (GonException $e) {
	HandleException($e,'completeStrat');
}
?>