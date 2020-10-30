<!DOCTYPE html>
<html>
<head>
<title><?php echo($bnd->getSelectString()); ?> - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEditBnd.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecord.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" id="bndRecord">

<?php require 'tpl/header.tpl.php5'; ?>

<input id="recordId" type="hidden" value="<?php echo $bnd->BndId; ?>" />
<?php require 'tpl/toolbar.tpl.php5'; ?>

<?php if (!$bnd->isEditable()): ?>
<div id="recArchive" class="box">This is an archived record version</div>
<?php endif; ?>
<div id="recTitle" class="box"><?php echo($bnd->getSelectString()); ?></div>	
	
<div id="tabBoxUp" class="tabs">
	<ul>
		<li id="bndBasic"><a href="#bndBasicPanel">Description</a></li>
<?php if (Page::isLoggedIn()): ?>
<?php if ($bnd->isEditable()): ?>
		<li id="verHist"><a href="verHistory.html<?php echo "?RecordId=".$bnd->BndId; ?>">Version History</a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
	<div id="bndBasicPanel">
<?php require "tpl/bndBasic.tpl.php5" ?>
	</div>
</div>

<div id="tabBoxLow" class="tabs">
	<ul>
<?php if ($bnd->isEditable()): ?>
		<li id="autTax"><a href="bndTax.html<?php echo "?BndId=".$bnd->BndId; ?>">Taxa <span class="recCount">(<?php echo($taxCount); ?>)</span></a></li>
		<li id="autLit"><a href="bndLoc.html<?php echo "?BndId=".$bnd->BndId; ?>">Localities <span class="recCount">(<?php echo($locCount); ?>)</span></a></li>
<?php endif; ?>
	</ul>
</div>

</div>

</body>
</html>