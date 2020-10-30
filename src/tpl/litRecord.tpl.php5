<!DOCTYPE html>
<html>
<head>
<title><?php echo($lit->getAuthors()." ".$lit->Year); ?> - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEditLit.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecord.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" id="litRecord">

<?php require 'tpl/header.tpl.php5'; ?>

<input id="printLink" type="hidden" value="showLitPrint.html<?php echo "?LitId=".$lit->LitId; ?>" />
<input id="recordId" type="hidden" value="<?php echo $lit->LitId; ?>" />
<?php require 'tpl/toolbar.tpl.php5'; ?>

<?php if (Page::isEditor()): ?>
<?php require 'tpl/taxLinkForm.tpl.php5'; ?>
<?php require 'tpl/locLinkForm.tpl.php5'; ?>
<?php endif; ?>
<?php if (!$lit->isEditable()): ?>
<div id="recArchive" class="box">This is an archived record version</div>
<?php endif; ?>
<div id="recTitle" class="box"><span id="recNo">LitNo: <?php echo($lit->LitNo); ?></span><?php echo($lit->getAuthors()." ".$lit->Year); ?></div>	
	
<div id="tabBoxUp" class="tabs">
	<ul>
		<li id="litBasic"><a href="#litBasicPanel">Description</a></li>
<?php if (Page::isLoggedIn()): ?>
<?php if ($lit->isEditable()): ?>
		<li id="verHist"><a href="verHistory.html<?php echo "?RecordId=".$lit->LitId; ?>">Version History</a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
	<div id="litBasicPanel">
<?php require "tpl/litBasic.tpl.php5" ?>
	</div>
</div>

<div id="tabBoxLow" class="tabs">
	<ul>
		<li id="litNotes"><a href="litNotes.html<?php echo "?LitId=".$lit->LitId; ?>">Notes</a></li>
<?php if ($lit->isEditable()): ?>
		<li id="litTax"><a href="litTax.html<?php echo "?LitId=".$lit->LitId; ?>">Taxa <span class="recCount">(<?php echo($taxCount); ?>)</span></a></li>
		<li id="litLoc"><a href="litLoc.html<?php echo "?LitId=".$lit->LitId; ?>">Localities <span class="recCount">(<?php echo($locCount); ?>)</span></a></li>
<?php endif; ?>
	</ul>
</div>

</div>

</body>
</html>