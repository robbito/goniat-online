<?php

require 'inc/gon.inc.php5';

try {

	Page::init(false);
	Page::blockExcept(array("showTax"));

	// Check permission of current user
	if (!Page::isEditor()) {
		sendResponse("error","Invalid operation");
	}
	
	$taxId = Page::getString("RecordId");
	$A21 = Page::getFloat("A21");
	$A23 = Page::getFloat("A23");
	$A24 = Page::getFloat("A24");
	$A25 = Page::getFloat("A25");
	$A26 = Page::getFloat("A26");
	$A27 = Page::getFloat("A27");
	$A22_0 = Page::getString("A22-0");
	$A22_1 = Page::getString("A22-1");
	$A29_0 = Page::getString("A29-0");
	$A29_1 = Page::getString("A29-1");
	$A29_2 = Page::getString("A29-2");
	$A30_0 = Page::getString("A30-0");
	$A30_1 = Page::getString("A30-1");
	$A30_2 = Page::getString("A30-2");
	$A31_0 = Page::getString("A31-0");
	$A31_1 = Page::getString("A31-1");
	$A31_2 = Page::getString("A31-2");
	$A32_0 = Page::getString("A32-0");
	$A32_1 = Page::getString("A32-1");
	$A32_2 = Page::getString("A32-2");
	$A33_0 = Page::getString("A33-0");
	$A33_1 = Page::getString("A33-1");
	$A33_2 = Page::getString("A33-2");
	$A34_0 = Page::getString("A34-0");
	$A34_1 = Page::getString("A34-1");
	$A34_2 = Page::getString("A34-2");
	$B35_0 = Page::getString("B35-0");
	$B35_1 = Page::getString("B35-1");
	$B35_2 = Page::getString("B35-2");
	$B36_0 = Page::getString("B36-0");
	$B36_1 = Page::getString("B36-1");
	$B36_2 = Page::getString("B36-2");
	$B37_0 = Page::getString("B37-0");
	$B37_1 = Page::getString("B37-1");
	$B37_2 = Page::getString("B37-2");
	$B38_0 = Page::getString("B38-0");
	$B38_1 = Page::getString("B38-1");
	$B38_2 = Page::getString("B38-2");
	$B39_0 = Page::getString("B39-0");
	$B39_1 = Page::getString("B39-1");
	$B39_2 = Page::getString("B39-2");
	$C40_0 = Page::getString("C40-0");
	$C41_0 = Page::getString("C41-0");
	$C41_1 = Page::getString("C41-1");
	$C41_2 = Page::getString("C41-2");
	$C42_0 = Page::getString("C42-0");
	$C42_1 = Page::getString("C42-1");
	$C42_2 = Page::getString("C42-2");
	$C43_0 = Page::getString("C43-0");
	$C43_1 = Page::getString("C43-1");
	$C43_2 = Page::getString("C43-2");
	$C44_0 = Page::getString("C44-0");
	$C44_1 = Page::getString("C44-1");
	$C44_2 = Page::getString("C44-2");
	$C45_0 = Page::getString("C45-0");
	$C45_1 = Page::getString("C45-1");
	$C45_2 = Page::getString("C45-2");
	$C46_0 = Page::getString("C46-0");
	$C46_1 = Page::getString("C46-1");
	$C46_2 = Page::getString("C46-2");
	$C47_0 = Page::getString("C47-0");
	$C47_1 = Page::getString("C47-1");
	$C47_2 = Page::getString("C47-2");
	$D48_0 = Page::getString("D48-0");
	$D49_0 = Page::getString("D49-0");
	$D49_1 = Page::getString("D49-1");
	$D49_2 = Page::getString("D49-2");
	$D50_0 = Page::getString("D50-0");
	$D50_1 = Page::getString("D50-1");
	$D50_2 = Page::getString("D50-2");
	$D51_0 = Page::getString("D51-0");
	$D51_1 = Page::getString("D51-1");
	$D51_2 = Page::getString("D51-2");
	$E52_0 = Page::getString("E52-0");
	$E52_1 = Page::getString("E52-1");
	$E52_2 = Page::getString("E52-2");
	$F53_0 = Page::getString("F53-0");
	$F54_0 = Page::getString("F54-0");
	$F54_1 = Page::getString("F54-1");
	$F54_2 = Page::getString("F54-2");
	$F55_0 = Page::getString("F55-0");
	$F55_1 = Page::getString("F55-1");
	$F55_2 = Page::getString("F55-2");
	$F56_0 = Page::getString("F56-0");
	$F56_1 = Page::getString("F56-1");
	$F56_2 = Page::getString("F56-2");
	$G57_0 = Page::getString("G57-0");
	$G58_0 = Page::getString("G58-0");
	$G59_0 = Page::getString("G59-0");
	$G60_0 = Page::getString("G60-0");
	$G61_0 = Page::getString("G61-0");
	$G62_0 = Page::getString("G62-0");
	$G63_0 = Page::getString("G63-0");
	$G64_0 = Page::getString("G64-0");
	$G65_0 = Page::getString("G65-0");
	$G66_0 = Page::getString("G66-0");
	$G67_0 = Page::getString("G67-0");
	$G68_0 = Page::getString("G68-0");
	$G69_0 = Page::getString("G69-0");
	$G70_0 = Page::getString("G70-0");
	$G71_0 = Page::getString("G71");
	
	if (!Record::isIdValid($taxId)) {
		sendResponse("error","Invalid argument");
	}
	
	$tax = Tax::loadFromTaxId($taxId);

	if ($tax->Status != 0) {
		sendResponse("error","Cannot modify archive record");
	}
	
	// The following two tests load the morphology 
	if (!$tax->hasMorph()) {
		sendResponse("error","Invalid argument");
	}
	
	if (isset($A22_1) && !$tax->hasMorphB()) {
		sendResponse("error","Invalid argument");
	}
	
	// Check for changes
	if (	$tax->isFeatureEqual("A21",$A21) &&
			$tax->isFeatureEqual("A23",$A23) &&
			$tax->isFeatureEqual("A24",$A24) &&
			$tax->isFeatureEqual("A25",$A25) &&
			$tax->isFeatureEqual("A26",$A26) &&
			$tax->isFeatureEqual("A27",$A27) &&
			$tax->isFeatureEqual("A22",$A22_0,$A22_1) &&
			$tax->isFeatureEqual("A29",$A29_0,$A29_1,$A29_2) &&
			$tax->isFeatureEqual("A30",$A30_0,$A30_1,$A30_2) &&
			$tax->isFeatureEqual("A31",$A31_0,$A31_1,$A31_2) &&
			$tax->isFeatureEqual("A32",$A32_0,$A32_1,$A32_2) &&
			$tax->isFeatureEqual("A33",$A33_0,$A33_1,$A33_2) &&
			$tax->isFeatureEqual("A34",$A34_0,$A34_1,$A34_2) &&
			$tax->isFeatureEqual("B35",$B35_0,$B35_1,$B35_2) &&
			$tax->isFeatureEqual("B36",$B36_0,$B36_1,$B36_2) &&
			$tax->isFeatureEqual("B37",$B37_0,$B37_1,$B37_2) &&
			$tax->isFeatureEqual("B38",$B38_0,$B38_1,$B38_2) &&
			$tax->isFeatureEqual("B39",$B39_0,$B39_1,$B39_2) &&
			$tax->isFeatureEqual("C40",$C40_0) &&
			$tax->isFeatureEqual("C41",$C41_0,$C41_1,$C41_2) &&
			$tax->isFeatureEqual("C42",$C42_0,$C42_1,$C42_2) &&
			$tax->isFeatureEqual("C43",$C43_0,$C43_1,$C43_2) &&
			$tax->isFeatureEqual("C44",$C44_0,$C44_1,$C44_2) &&
			$tax->isFeatureEqual("C45",$C45_0,$C45_1,$C45_2) &&
			$tax->isFeatureEqual("C46",$C46_0,$C46_1,$C46_2) &&
			$tax->isFeatureEqual("C47",$C47_0,$C47_1,$C47_2) &&
			$tax->isFeatureEqual("D48",$D48_0) &&
			$tax->isFeatureEqual("D49",$D49_0,$D49_1,$D49_2) &&
			$tax->isFeatureEqual("D50",$D50_0,$D50_1,$D50_2) &&
			$tax->isFeatureEqual("D51",$D51_0,$D51_1,$D51_2) &&
			$tax->isFeatureEqual("E52",$E52_0,$E52_1,$E52_2) &&
			$tax->isFeatureEqual("F53",$F53_0) &&
			$tax->isFeatureEqual("F54",$F54_0,$F54_1,$F54_2) &&
			$tax->isFeatureEqual("F55",$F55_0,$F55_1,$F55_2) &&
			$tax->isFeatureEqual("F56",$F56_0,$F56_1,$F56_2) &&
			$tax->isFeatureEqual("G57",$G57_0) &&
			$tax->isFeatureEqual("G58",$G58_0) &&
			$tax->isFeatureEqual("G59",$G59_0) &&
			$tax->isFeatureEqual("G60",$G60_0) &&
			$tax->isFeatureEqual("G61",$G61_0) &&
			$tax->isFeatureEqual("G62",$G62_0) &&
			$tax->isFeatureEqual("G63",$G63_0) &&
			$tax->isFeatureEqual("G64",$G64_0) &&
			$tax->isFeatureEqual("G65",$G65_0) &&
			$tax->isFeatureEqual("G66",$G66_0) &&
			$tax->isFeatureEqual("G67",$G67_0) &&
			$tax->isFeatureEqual("G68",$G68_0) &&
			$tax->isFeatureEqual("G69",$G68_0) &&
			$tax->isFeatureEqual("G70",$G70_0) &&
			$tax->isFeatureEqual("G71",$G71_0)) {
		sendResponse("success","No changes detected");
	}
	
	// Create archive record as copy 
	$archiveTax = $tax->createArchive();
	$tax->createArchiveMorph($archiveTax->TaxId);
	
	$tax->setFeature("A21",$A21);
	$tax->setFeature("A23",$A23);
	$tax->setFeature("A24",$A24);
	$tax->setFeature("A25",$A25);
	$tax->setFeature("A26",$A26);
	$tax->setFeature("A27",$A27);
	$tax->setFeature("A22",$A22_0,$A22_1);
	$tax->setFeature("A29",$A29_0,$A29_1,$A29_2);
	$tax->setFeature("A30",$A30_0,$A30_1,$A30_2);
	$tax->setFeature("A31",$A31_0,$A31_1,$A31_2);
	$tax->setFeature("A32",$A32_0,$A32_1,$A32_2);
	$tax->setFeature("A33",$A33_0,$A33_1,$A33_2);
	$tax->setFeature("A34",$A34_0,$A34_1,$A34_2);
	$tax->setFeature("B35",$B35_0,$B35_1,$B35_2);
	$tax->setFeature("B36",$B36_0,$B36_1,$B36_2);
	$tax->setFeature("B37",$B37_0,$B37_1,$B37_2);
	$tax->setFeature("B38",$B38_0,$B38_1,$B38_2);
	$tax->setFeature("B39",$B39_0,$B39_1,$B39_2);
	$tax->setFeature("C40",$C40_0);
	$tax->setFeature("C41",$C41_0,$C41_1,$C41_2);
	$tax->setFeature("C42",$C42_0,$C42_1,$C42_2);
	$tax->setFeature("C43",$C43_0,$C43_1,$C43_2);
	$tax->setFeature("C44",$C44_0,$C44_1,$C44_2);
	$tax->setFeature("C45",$C45_0,$C45_1,$C45_2);
	$tax->setFeature("C46",$C46_0,$C46_1,$C46_2);
	$tax->setFeature("C47",$C47_0,$C47_1,$C47_2);
	$tax->setFeature("D48",$D48_0);
	$tax->setFeature("D49",$D49_0,$D49_1,$D49_2);
	$tax->setFeature("D50",$D50_0,$D50_1,$D50_2);
	$tax->setFeature("D51",$D51_0,$D51_1,$D51_2);
	$tax->setFeature("E52",$E52_0,$E52_1,$E52_2);
	$tax->setFeature("F53",$F53_0);
	$tax->setFeature("F54",$F54_0,$F54_1,$F54_2);
	$tax->setFeature("F55",$F55_0,$F55_1,$F55_2);
	$tax->setFeature("F56",$F56_0,$F56_1,$F56_2);
	$tax->setFeature("G57",$G57_0);
	$tax->setFeature("G58",$G58_0);
	$tax->setFeature("G59",$G59_0);
	$tax->setFeature("G60",$G60_0);
	$tax->setFeature("G61",$G61_0);
	$tax->setFeature("G62",$G62_0);
	$tax->setFeature("G63",$G63_0);
	$tax->setFeature("G64",$G64_0);
	$tax->setFeature("G65",$G65_0);
	$tax->setFeature("G66",$G66_0);
	$tax->setFeature("G67",$G67_0);
	$tax->setFeature("G68",$G68_0);
	$tax->setFeature("G69",$G69_0);
	$tax->setFeature("G70",$G70_0);
	$tax->setFeature("G71",$G71_0);
	
/*	$archiveCat = null;
	if ($name != $cat->Name) {
		$archiveCat = $cat->createArchive();
		$archiveTax->CatId = $archiveCat->CatId;
		$archiveTax->save();
		$cat->Name = $name;
		$cat->save();
		Log::logRecordModify($cat->CatId,$archiveCat->CatId, "Cat");
	}*/
		
/*	
	// Change loc
	$tax->save();*/
	$tax->saveMorph();
	// Create log entry
	Log::logRecordModify($tax->TaxId, $archiveTax->TaxId,"Tax");
	
	sendResponse("success");
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}
