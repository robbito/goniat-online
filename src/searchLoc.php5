<?php

/**
 * Search for loc record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$geoActive = Page::getBool('searchGeoActive');
	$stratActive = Page::getBool('searchStratActive');
	$locNoActive = Page::getBool('searchLocNoActive');
	$geo1 = Page::getString('Geo1');
	$type1 = Page::getInt('Type1');
	$geo2 = Page::getString('Geo2');
	$type2 = Page::getInt('Type2');
	$geo3 = Page::getString('Geo3');
	$type3 = Page::getInt('Type3');
	$loBound = Page::getFloat('LoBound');
	$upBound = Page::getFloat('UpBound');
	$locNo = Page::getInt('LocNo');
	$locSubQuery = "";

	if (!$geoActive && !$stratActive && !$locNoActive) {
		if ($locNo != 0)
			$locNoActive = true;
		else {
			if (isset($geo1))
				$geoActive = true;
		}
	}

	if ($geoActive) {
		if (!isset($geo1) || $geo1 == "")
			$geoActive = false;
	}

	if ($stratActive) {
		if ((!isset($loBound) || $loBound == 0.0) && (!isset($upBound) || $upBound == ""))
			$stratActive = false;
		else {
			if (!isset($loBound) || $loBound == 0.0)
				$loBound = 10000.0;
			if (!isset($upBound))
					$upBound = 0.0;
		}
	}

	if ($locNoActive) {
		if ($locNo == 0) {
			throw New GonInvalidArgumentException;
		}

		$loc = Loc::loadFromLocNo($locNo);

		if (!isset($loc)) {
			$msg = 'Specified LocNo does not exist';
			require 'tpl/error.tpl.php5';
			exit();
		}

		Page::redirect('showLoc','LocId='.$loc->LocId);
	}

	if ($geoActive) {
		$geo = $geo1;
		$type = $type1;
		$parentGeo = null;
		$parentType = null;
		if (isset($geo2)) {
			$parentGeo = $geo;
			$parentType = $type;
			$geo = $geo2;
			$type = $type2;
		}
		if (isset($geo3)) {
			$parentGeo = $geo;
			$parentType = $type;
			$geo = $geo3;
			$type = $type3;
		}
		if (!$stratActive) {
			// Search for taxa according to taxonomy criteria
			$geo = Geo::loadFromName($geo,$type,$parentGeo,$parentType);
			$geoNum = count($geo);
			if (isset($geo) && $geoNum != 0) {
				if ($geoNum > 1) {
					// Handle multiple results.
					$sel = Loc::getSelectionList($geo);
					require 'tpl/locSelection.tpl.php5';
					exit();
				}
				$loc = Loc::loadFromGeoId($geo[0]->GeoId);
				if (isset($loc)) {
					Page::redirect('showLoc','LocId='.$loc->LocId);
				}
				Page::redirect('showGeo','GeoId='.$geo[0]->GeoId);
			}
			else {
				$msg = 'No record found';
				require 'tpl/error.tpl.php5';
				exit();
			}
		}
		else {
			// Build sub query with taxonomy criteria
			$locSubQuery = Geo::getQueryStringFromName($geo,$type,$parentGeo,$parentType);
		}
	}

	$params = array();
	$locQuery = "SELECT {columns} FROM loc a";
	$locWhere = "a.Status=0";
	if ($stratActive) {
		// Build stratigraphy criteria
		$locQuery .= ",bnd b,bnd c";
		$locWhere .= " AND a.BndLoId=b.BndId AND a.BndUpId=c.BndId AND b.MillYears>{UpBound} AND c.MillYears<{LoBound}";
		$params['UpBound'] = $upBound;
		$params['LoBound'] = $loBound;
	}

	if (strlen($locWhere) == 0) {
		throw new GonException('No search criteria specified');
	}

	// Assemble query
	$locQuery .= " WHERE ".$locWhere;
	if (strlen($locSubQuery)) {
		$locQuery .= " AND a.GeoId IN (".$locSubQuery.")";
	}

	$sel = Loc::getSelectionListFromQuery($locQuery,$params);
	$geoNum = count($sel);
	require 'tpl/locSelection.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'searchLoc');
}
?>