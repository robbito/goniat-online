<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showLitNew"));

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

	if ($litId != '')
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

	$lit = Lit::create();
		
	$lit->Author1Id = $author1Id;
	$lit->Author2Id = $author2Id;
	$lit->Author3Id = $author3Id;
	$lit->Year = $year;
	$lit->Title = $title;
	$lit->Reference = $reference;
	$lit->Short = $keywords;
	// Change loc
	$lit->save();
	// Create log entry
	Log::logRecordCreate($lit->LitId,"Lit");
	
	sendResponse("success","Record was successfully created","showLit.html?LitId=".$lit->LitId);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>