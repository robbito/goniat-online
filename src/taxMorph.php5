<?php

/**
 * Get tax literature
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

function getFeatureHTML($arg_tax,$arg_feature,$arg_class = 0)
{
	$feature = $arg_tax->getFeature($arg_feature,$arg_class);

	if (is_null($feature) || $feature === '')
		return '&nbsp;';

	return $feature;
}

function getFeatureTitle($arg_tax,$arg_feature,$arg_class = 0)
{
	$featureText = $arg_tax->getFeatureText($arg_feature,$arg_class);

	if (is_null($featureText))
		return ' class="emptyB"';

	if ($featureText === '')
		$featureText = 'empty';
	
	return ' title="'.htmlSafe($featureText).'"';
}

try {
	Page::init(false);
	Page::blockDirect();
	
	$taxId = Page::getString('RecordId');
	$edit = Page::getBool('Edit');

	if (!Record::isIdValid($taxId))
		throw new GonInvalidArgumentException(array('TaxId' => $taxId));

	$tax = Tax::loadFromTaxId($taxId);

	if (!isset($tax)) {
		Page::error('Specified TaxId does not exist');
	}

	if ($edit) {
		if (!Page::isEditor()) {
			throw new GonOperationFailedException;
		}
		require 'tpl/taxMorphEdit.tpl.php5';
	}
	else {
		require 'tpl/taxMorph.tpl.php5';
	}
}
catch (GonException $e) {
	HandleException($e,'taxMorph');
}

?>