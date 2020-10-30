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
	
	if (!Page::isEditor())
		throw new GonOperationFailedException;

	$term = Page::getString('term');
	$crit = Page::getString('crit');

	//Check parameters
	if (!isset($term) || !isset($crit)|| strlen($term) > 50)
		throw new GonInvalidArgumentException;

	$records = array();
	
	switch ($crit) {
		case "LocNo" :
			$records[] = Loc::loadFromLocNo($term);
			break;
		case "Locality" :
			$records = Loc::loadFromLocality($term);
			break;
	}

	$count = count($records);
	$locs = array();

	for ($i = 0; $i < $count; $i++) {
		$loc = $records[$i];
		$geography = $loc->getGeography();
		$value = $loc->getGeographyShortStringSmart($geography);
		$geo = array_pop($geography);
		$hierarchy = array();
		foreach ($geography as $geo) {
			$hierarchy[] = array("Category" => $geo->getTypeText(),"Name" => $geo->Name);
		}
		$locs[] = array("id" => $loc->LocId, "value" => $value,"Category" => $geo->getTypeText(),"Locality" => $geo->Name, "LocNo" => $loc->LocNo,"Hierarchy" => $hierarchy);
	}

	echo json_encode($locs);
}
catch (GonException $e) {
	HandleException($e,'completeLit');
}
?>