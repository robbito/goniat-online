<!DOCTYPE html>
<html>
<head>
<title><?php echo($aut->getName()); ?> - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEditAut.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecord.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" id="autRecord">

<?php require 'tpl/header.tpl.php5'; ?>

<input id="recordId" type="hidden" value="<?php echo $aut->AutId; ?>" />
<?php require 'tpl/toolbar.tpl.php5'; ?>

<?php if (!$aut->isEditable()): ?>
<div id="recArchive" class="box">This is an archived record version</div>
<?php endif; ?>
<div id="recTitle" class="box"><?php echo($aut->getName()); ?></div>	
	
<div id="tabBoxUp" class="tabs">
	<ul>
		<li id="autBasic"><a href="#autBasicPanel">Description</a></li>
<?php if (Page::isLoggedIn()): ?>
<?php if ($aut->isEditable()): ?>
		<li id="verHist"><a href="verHistory.html<?php echo "?RecordId=".$aut->AutId; ?>">Version History</a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
	<div id="autBasicPanel">
<?php require "tpl/autBasic.tpl.php5" ?>
	</div>
</div>

<div id="tabBoxLow" class="tabs">
	<ul>
<?php if ($aut->isEditable()): ?>
		<li id="autLit"><a href="autLit.html<?php echo "?AutId=".$aut->AutId; ?>">Literature <span class="recCount">(<?php echo($litCount); ?>)</span></a></li>
		<li id="autTax"><a href="autTax.html<?php echo "?AutId=".$aut->AutId; ?>">Taxa <span class="recCount">(<?php echo($taxCount); ?>)</span></a></li>
		<li id="autNotes"><a href="autNotes.html<?php echo "?AutId=".$aut->AutId; ?>">Notes</a></li>
<?php endif; ?>
	</ul>
</div>

</div>

</body>
</html>