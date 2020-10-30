<?php

/**
 * Search for tax record
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$catActive = Page::getBool('searchCatActive');
	$stratActive = Page::getBool('searchStratActive');
//	$morphActive = $_GET['searchMorphActive'] == 'true' ? true : false;
	$morphActive = false;
	$taxNoActive = Page::getBool('searchTaxNoActive');
	$taxNo = Page::getInt('TaxNo');
	$taxon1 = Page::getString('Taxon1');
	$type1 = Page::getInt('Type1');
	$taxon2 = Page::getString('Taxon2');
	$type2 = Page::getInt('Type2');
	$taxon3 = Page::getString('Taxon3');
	$type3 = Page::getInt('Type3');
	$loBound = Page::getFloat('LoBound');
	$upBound = Page::getFloat('UpBound');
	$taxSubQuery = "";

	if (!$catActive && !$stratActive && !$taxNoActive) {
		if ($taxNo != 0)
			$taxNoActive = true;
		else {
			if (isset($taxon1))
				$catActive = true;
			if ($loBound != 0.0 || $upBound != 0.0)
				$stratActive = true;
		}
	}

	if ($taxNoActive) {
		if ($taxNo == 0) {
			throw new GonException('No valid TaxNo specified');
		}
		$tax = Tax::loadFromTaxNo($taxNo);
		if (!isset($tax)) {
			$msg = 'Specified TaxNo does not exist';
			require 'tpl/error.tpl.php5';
			exit();
		}
		Page::redirect('showTax','TaxId='.$tax->TaxId);
	}

	if ($catActive) {
		if (!isset($taxon1) || $taxon1 == "")
			$catActive = false;
	}

	if ($stratActive) {
		// Either active flag is wrong, then correct
		if ((!isset($loBound) || $loBound == 0.0) && (!isset($upBound) || $upBound == 0.0))
			$stratActive = false;
		else {
			// or normalize missing values.
			if (!isset($loBound) || $loBound == 0.0)
				$loBound = 10000.0;
			if (!isset($upBound))
				$upBound = 0.0;
		}
	}

	if ($catActive) {
		$parentTaxon = null;
		$parentType = null;
		$taxon = $taxon1;
		$type = $type1;
		if (isset($taxon2)) {
			$parentTaxon = $taxon;
			$parentType = $type;
			$taxon = $taxon2;
			$type = $type2;
		}
		if (isset($taxon3)) {
			$parentTaxon = $taxon;
			$parentType = $type;
			$taxon = $taxon3;
			$type = $type3;
		}
		if (!$stratActive && !$morphActive) {
			// Search for taxa according to taxonomy criteria
			$cat = Cat::loadFromName($taxon,$type,$parentTaxon,$parentType);
			$catNum = count($cat);
			if (isset($cat) && $catNum != 0) {
				if ($catNum > 1) {
					// Handle multiple results.
					$sel = Tax::getSelectionList($cat);
					$valNum = 0;

					// Count valid species
					foreach ($sel as $name => $rec) {
						if (!isset($rec[1]) || Tax::isValid($rec[1]->Qualifier))
							$valNum++;
					}

					require 'tpl/taxSelection.tpl.php5';
					exit();
				}
				$tax = Tax::loadFromCatId($cat[0]->CatId);
				if (isset($tax)) {
					redirect('showTax','TaxId='.$tax->TaxId);
				}
				else {
					redirect('showCat','CatId='.$cat[0]->CatId);
				}
			}
			else {
				$msg = 'No record found';
				require 'tpl/error.tpl.php5';
				exit();
			}
		}
		else {
			// Build sub query with taxonomy criteria
			$taxSubQuery = Cat::getQueryStringFromName($taxon,$type,$parentTaxon,$parentType);
		}
	}
	$params = array();
	$taxQuery = "SELECT {columns} FROM tax a";
	$taxWhere = "a.Status=0";
	if ($stratActive) {
		// Build stratigraphy criteria
		$taxQuery .= ",bnd b,bnd c";
		$taxWhere .= " AND a.BndLoId=b.BndId AND a.BndUpId=c.BndId AND b.MillYears>{UpBound} AND c.MillYears<{LoBound}";
		$params['UpBound'] = $upBound;
		$params['LoBound'] = $loBound;
	}
	if (strlen($taxWhere) == 0) {
		throw new GonException('No search criteria specified');
	}
	// Assemble query
	$taxQuery .= " WHERE ".$taxWhere;
	if (strlen($taxSubQuery)) {
		$taxQuery .= " AND a.CatId IN (".$taxSubQuery.")";
	}
	// Run species query
	$sel = Tax::getSelectionListFromQuery($taxQuery,$params);
	$catNum = count($sel);
	$valNum = 0;

	// Count valid species
	foreach ($sel as $name => $rec) {
		if (!isset($rec[1]) || Tax::isValid($rec[1]->Qualifier))
			$valNum++;
	}

	require 'tpl/taxSelection.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'searchTax');
}
?>