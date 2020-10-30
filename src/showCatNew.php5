<?php

/**
 * Show new geo record page
 *
 * @version $Id$
 * @copyright 2014
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	Page::blockExcept(array("taxHierarchy","showTaxCat","showCat","showTax"));
	
	if (!Page::isEditor())
		throw new GonOperationFailedException;

	$parentId = Page::getString('ParentId');
	$parent = null;
	$taxonomy = array();

	if (Record::isIdValid($parentId)) {
		$parent = Cat::loadFromCatId($parentId);
		if (!isset($parent)) {
			Page::error('Specified ParentId does not exist');
		}
		$taxonomy = $parent->getTaxonomy();
	}

	$cat = Cat::create();

	require 'tpl/catRecordNew.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'showCatNew');
}
?>