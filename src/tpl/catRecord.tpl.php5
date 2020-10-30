<!DOCTYPE html>
<html>
<head>
<title><?php echo $cat->getTypeText().' '.$cat->Name; ?> - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEditCat.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecord.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" id="catRecord">

<?php require 'tpl/header.tpl.php5'; ?>

<input id="printLink" type="hidden" value="showCatPrint.html<?php echo "?CatId=".$cat->CatId; ?>" />
<input id="recordId" type="hidden" value="<?php echo $cat->CatId; ?>" />
<?php require 'tpl/toolbar.tpl.php5'; ?>
<?php if (!$cat->isEditable()): ?>
<div id="recArchive" class="box">This is an archived record version</div>
<?php endif; ?>
<div id="recTitle" class="box"><?php echo $cat->getTypeText().' '.$cat->Name; ?></div>
	
<div id="tabBoxUp" class="tabs">
	<ul>
		<li id="catBasic"><a href="#catBasicPanel">Taxonomy</a></li>
<?php if (Page::isLoggedIn()): ?>
<?php if ($cat->isEditable()): ?>
		<li id="verHist"><a href="verHistory.html<?php echo "?RecordId=".$cat->CatId; ?>">Version History</a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
	<div id="catBasicPanel">
<?php require 'tpl/catBasic.tpl.php5'; ?>		
	</div>
</div>

<div id="tabBoxLow" class="tabs">
	<ul>
		<li id="catSub"><a href="catSub.html<?php echo "?CatId=".$cat->CatId; ?>">Sub categories <span class="recCount">(<?php echo($subCount); ?>)</span></a></li>
		<li id="catSpc"><a href="catSpc.html<?php echo "?CatId=".$cat->CatId; ?>">Species <span class="recCount">(<?php echo($spcCount); ?> / <?php echo($spcQualCount); ?> valid)</span></a></li>
		<li id="catNotes"><a href="catNotes.html<?php echo "?CatId=".$cat->CatId; ?>">Notes</a></li>
	</ul>
</div>	

</div>

</body>
</html>