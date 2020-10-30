<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLit"));

	// Check permission of current user
	if (!Page::isEditor())
		sendResponse("error","Invalid operation");
	
	$litId = Page::getString("recordId");
	$author1Id = Page::getString("Author1Id");
	$author1Txt = Page::getString("Author1");
	$author2Id = Page::getString("Author2Id");
	$author2Txt = Page::getString("Author2");
	$author3Id = Page::getString("Author3Id");
	$author3Txt = Page::getString("Author3");
	$year = Page::getString("Year");
	$title = Page::getString("Title");
	$reference = Page::getString("Reference");
	$keywords = Page::getString("Keywords");
	$url = Page::getString("Url");

	if (!Record::isIdValid($litId))
		sendResponse("error","Invalid argument");
	
	if ($author1Txt == "")
		$author1Id = "";
	elseif ($author1Id == "")
		sendResponse ("error","Specified 1st author does not exist. Please create author record first.");

	if ($author2Txt == "")
		$author2Id = "";
	elseif ($author2Id == "")
		sendResponse ("error","Specified 2nd author does not exist. Please create author record first.");

	if ($author3Txt == "")
		$author3Id = "";
	elseif ($author3Id == "")
		sendResponse ("error","Specified 3rd author does not exist. Please create author record first.");

	if ($author1Id == "")
		sendResponse ("error","1st author cannot be empty");

	if ($author2Id == "" && $author3Id != "") {
		$author2Id = $author3Id;
		$author3Id = "";
	}
	
	if ($author2Txt == "")
		$author2Id = "";

	if ($author3Txt == "")
		$author3Id = "";
	
	if ($url !== "" && substr($url,0,3) === "www") {
		$url = "http://".$url;
	}

	$lit = Lit::loadFromLitId($litId);

	if ($lit->Status != 0)
		sendResponse("error","Cannot modify archive record");

	// Check for changes
	if ($author1Id == $lit->Author1Id && 
			$author2Id == $lit->Author2Id && 
			$author3Id == $lit->Author3Id && 
			$year == $lit->Year &&
			$title == $lit->Title &&
			$reference == $lit->Reference &&
			$keywords == $lit->Keywords &&
			$url == $lit->Url)
		sendResponse("success","No changes detected");
	
	// Create archive record as copy 
	$archiveLit = $lit->createArchive();
		
	$lit->Author1Id = $author1Id;
	$lit->Author2Id = $author2Id;
	$lit->Author3Id = $author3Id;
	$lit->Year = $year;
	$lit->Title = $title;
	$lit->Reference = $reference;
	$lit->Short = $keywords;
	$lit->Url = $url;
	// Change loc
	$lit->save();
	// Create log entry
	Log::logRecordModify($lit->LitId, $archiveLit->LitId,"Lit");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>