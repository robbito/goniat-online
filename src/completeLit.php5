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
		case "LitNo" :
			$records[] = Lit::loadFromLitNo($term);
			break;
		case "Authors" :
			$records = Lit::loadFromAuthor($term);
			break;
		case "Title" :
			$records = Lit::loadFromTitle($term);
			break;
		case "Reference" :
			$records = Lit::loadFromReference($term);
			break;
	}

	$count = count($records);
	$lits = array();

	for ($i = 0; $i < $count; $i++) {
		$lit = $records[$i];
		$lits[] = array("id" => $lit->LitId, "value" => $lit->getAuthors(),"Year" => $lit->Year,"LitNo" => $lit->LitNo,"Title" => $lit->Title,"Reference" => $lit->Reference);
	}

	echo json_encode($lits);
}
catch (GonException $e) {
	HandleException($e,'completeLit');
}
?>