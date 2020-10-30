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
	
	if (!Page::isEditor()) {
		throw new GonOperationFailedException;
	}

	$term = Page::getString('term');
	$crit = Page::getString('crit');

	//Check parameters
	if (!isset($term) || !isset($crit) || strlen($term) > 50) {
		throw new GonInvalidArgumentException;
	}

	$records = array();
	
	switch ($crit) {
		case "TaxNo" :
			$records[] = Tax::loadFromTaxNo($term);
			break;
		case "Taxon" :
			$records = Tax::loadFromTaxon($term);
			break;
	}

	$count = count($records);
	$taxs = array();

	for ($i = 0; $i < $count; $i++) {
		$tax = $records[$i];
		$taxonomy = $tax->getTaxonomy();
		$value = $tax->getTaxonomyShortStringSmart($taxonomy);
		$cat = array_pop($taxonomy);
		$hierarchy = array();
		foreach ($taxonomy as $cat) {
			$hierarchy[] = array("Category" => $cat->getTypeText(),"Name" => $cat->Name);
		}
		$taxs[] = array("id" => $tax->TaxId, "value" => $value,"TaxNo" => $tax->TaxNo,"Category" => $cat->getTypeText(),"Taxon" => $cat->Name,"TaxNo" => $tax->TaxNo,"Hierarchy" => $hierarchy);
	}

	echo json_encode($taxs);
}
catch (GonException $e) {
	HandleException($e,'completeTax');
}
