<?php

/**
 * Gets entries for morph autocomplete fields
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockDirect();

	$field = Page::getString('field');
	$term = Page::getString('term');

	//Check parameters
	if (!isset($field)) {
		throw new GonInvalidArgumentException;
	}

	$fieldBase = substr($field,0,3);
	$options = Tax::getFeatureOptions($fieldBase);
	$features = array();
//	$features[] = array("id" => "ab","label" => "<b>ab</b> - Test Test");
	foreach ($options as $id => $label) {
		if ($term === "" || strpos($id,$term) === 0)
			$features[] = array("value" => $id,"label" => "<b>".$id."</b> - ".$label);
	}
	if (count($features) == 0) {
		$features[] = array("value" => "","label" => "no options found");
	}

	echo json_encode($features);
}
catch (GonException $e) {
	HandleException($e,'completeMorph');
}
?>