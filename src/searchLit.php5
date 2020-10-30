<?php

/**
 * Search for lit record page
 *
 * @version $Id$
 * @copyright 2007
 */

require 'inc/gon.inc.php5';

try {
	Page::init();
	
	$autActive = Page::getBool('searchAutActive');
	$titleActive = Page::getBool('searchTitleActive');
	$keyActive = Page::getBool('searchKeyActive');
	$litNoActive = Page::getBool('searchLitNoActive');
	$litNo = Page::getInt('LitNo');
	$author1 = Page::getString('Author1');
	$author1id = Page::getString('Author1Id');
	$author2 = Page::getString('Author2');
	$author2id = Page::getString('Author2Id');
	$year = Page::getString('Year');
	$title = Page::getString('Title');
	$keywords = Page::getString('Keywords');

	if (!$autActive && !$litNoActive) {
		if ($litNo != 0)
			$litNoActive = true;
		else {
			if (isset($author1))
				$autActive = true;
		}
	}

	if ($autActive) {
		if ((!isset($author1id) || empty($author1id)) && (!isset($author1) || empty($author1)) && (!isset($year) || empty($year)))
			$autActive = false;
	}

	if ($litNoActive) {
		if ($litNo == 0) {
			throw new GonException('No valid LitNo specified');
		}

		$lit = Lit::loadFromLitNo($litNo);

		if (!isset($lit)) {
			$msg = 'Specified LitNo does not exist';
			require 'tpl/error.tpl.php5';
			exit();
		}

		Page::redirect('showLit','LitId='.$lit->LitId);
	}
	else {
		$params = array();
		$litQuery = "SELECT {columns} FROM lit a,aut b";
		$litWhere = "a.Author1Id=b.AutId AND a.Status=0";
		if ($autActive) {
			$litQueryTmp = "";
			$litWhereTmp = "";
			if (isset($author1id) && strlen($author1id) == 32) {
				$litWhere .= " AND (a.Author1Id='{Aut1Id}' OR a.Author2Id='{Aut1Id}' OR a.Author3Id='{Aut1Id}')";
				$params['Aut1Id'] = $author1id;
			}
			else if (isset($author1) && !empty($author1)) {
				$litQueryTmp .= ",aut c";
				$litWhereTmp =	" AND (a.Author1Id=c.AutId OR a.Author2Id=c.AutId OR a.Author3Id=c.AutId) AND".
								" c.LastName LIKE '{Aut1}%'";
				$params['Aut1'] = $author1;
			}
			if (isset($author2id) && strlen($author2id) == 32) {
				$litWhere .= " AND (a.Author1Id='{Aut2Id}' OR a.Author2Id='{Aut2Id}' OR a.Author3Id='{Aut2Id}')";
				$params['Aut2Id'] = $author2id;
			}
			else if (isset($author2) && !empty($author2)) {
				$litQueryTmp .= ",aut c";
				if (isset($author1) && !empty($author1)) {
					$litWhereTmp =	" AND (a.Author1Id=c.AutId OR a.Author2Id=c.AutId OR a.Author3Id=c.AutId)".
								 	" AND (c.LastName LIKE '{Aut1}%' OR c.LastName LIKE '{Aut2}%')";
				}
				else {
					$litWhereTmp =	" AND (a.Author1Id=c.AutId OR a.Author2Id=c.AutId OR a.Author3Id=c.AutId) AND".
									" c.LastName LIKE '{Aut2}%'";
				}
				$params['Aut2'] = $author2;
			}
			$litQuery .= $litQueryTmp;
			$litWhere .= $litWhereTmp;
			if (isset($year) && strlen($year)) {
				$litWhere .= " AND a.Year LIKE '{Year}%'";
				$params['Year'] = $year;
			}
		}

		if ($titleActive && strlen($title)) {
			$title = str_replace(",",";",$title);
			$words = explode(";",$title);
			$crits = array();
			$i = 1;
			foreach ($words as $word) {
				$crits[] = "a.Title LIKE '%{Title".$i."}%'";
				$params["Title".$i] = trim($word);
				$i++;
			}
			$litWhere .= " AND ".implode(" AND ",$crits);
		}
		else
			$titleActive = false;

		if ($keyActive && strlen($keywords)) {
			$keywords = str_replace(",",";",$keywords);
			$words = explode(";",$keywords);
			$crits = array();
			$i = 1;
			foreach ($words as $word) {
				$crits[] = "a.Short LIKE '%{Key".$i."}%'";
				$params["Key".$i] = trim($word);
				$i++;
			}
			$litWhere .= " AND ".implode(" AND ",$crits);
		}
		else
			$keyActive = false;

		if (!$keyActive && !$autActive && !$titleActive) {
			throw new GonException("No search criteria specified!");
		}

		// Assemble query
		$litQuery .= " WHERE ".$litWhere;
		$litQuery .= " ORDER BY b.LastName,b.FirstName,a.Year";

		$sel = Lit::getSelectionListFromQuery($litQuery,$params);
		$litNum = count($sel);
		require 'tpl/litSelection.tpl.php5';
	}

}
catch (GonException $e) {
	HandleException($e,'showLitRecord');
}
?>