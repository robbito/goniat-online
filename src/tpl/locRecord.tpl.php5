<!DOCTYPE html>
<html>
<head>
<title><?php echo $loc->getLayerString(); ?> - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery.liteuploader.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEditLoc.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecord.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" id="locRecord">

<?php require 'tpl/header.tpl.php5'; ?>

<input id="printLink" type="hidden" value="showLocPrint.html<?php echo "?LocId=".$loc->LocId; ?>" />
<input id="recordId" type="hidden" value="<?php echo $loc->LocId; ?>" />
<input id="recordGeoId" type="hidden" value="<?php echo $loc->GeoId; ?>" />
<?php require 'tpl/toolbar.tpl.php5'; ?>

<?php if (Page::isEditor()): ?>
<?php require 'tpl/taxLinkForm.tpl.php5'; ?>
<?php require 'tpl/litLinkForm.tpl.php5'; ?>
<?php require 'tpl/figLoadForm.tpl.php5'; ?>
<?php endif; ?>
<?php if (!$loc->isEditable()): ?>
<div id="recArchive" class="box">This is an archived record version</div>
<?php endif; ?>
<div id="recTitle" class="box"><span id="recNo">LocNo: <?php echo $loc->LocNo; ?></span><?php echo $loc->getLayerString(); ?></div>
	
<div id="tabBoxUp" class="tabs">
	<ul>
		<li id="locBasic"><a href="#locBasicPanel">Description</a></li>
<?php if (Page::isLoggedIn()): ?>
<?php if ($loc->isEditable()): ?>
		<li id="verHist"><a href="verHistory.html<?php echo "?RecordId=".$loc->LocId; ?>">Version History</a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
	<div id="locBasicPanel">
<?php require 'tpl/locBasic.tpl.php5'; ?>
	</div>
</div>

<div id="tabBoxLow" class="tabs">
	<ul>
		<li id="locNotes"><a href="locNotes.html<?php echo "?LocId=".$loc->LocId; ?>">Notes</a></li>
<?php if ($loc->isEditable()): ?>
		<li id="locFig"><a href="locFig.html<?php echo "?LocId=".$loc->LocId; ?>">Figures <span class="recCount">(<?php echo($figCount); ?>)</span></a></li>
<?php if ($geo->Type == 0): ?>		
		<li id="locTax"><a href="locTax.html<?php echo "?LocId=".$loc->LocId; ?>">Taxa <span class="recCount">(<?php echo($taxCount); ?>)</span></a></li>
		<li id="locLit"><a href="locLit.html<?php echo "?LocId=".$loc->LocId; ?>">Literature <span class="recCount">(<?php echo($litCount); ?>)</span></a></li>
<?php else: ?>
		<li id="locSub"><a href="locSub.html<?php echo "?LocId=".$loc->LocId; ?>">Sub regions <span class="recCount">(<?php echo($subCount); ?>)</span></a></li>
		<li id="locLay"><a href="locLay.html<?php echo "?LocId=".$loc->LocId; ?>">Layers <span class="recCount">(<?php echo($layCount); ?>)</span></a></li>
		<li id="locLit"><a href="locLit.html<?php echo "?LocId=".$loc->LocId; ?>">Literature <span class="recCount">(<?php echo($litCount); ?>)</span></a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
</div>

</div>

</body>
</html>