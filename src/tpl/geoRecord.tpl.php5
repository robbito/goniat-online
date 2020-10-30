<!DOCTYPE html>
<html>
<head>
<title><?php echo $geo->getGeographyString(); ?> - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEditGeo.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecord.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" id="geoRecord">

<?php require 'tpl/header.tpl.php5'; ?>

<input id="printLink" type="hidden" value="showGeoPrint.html<?php echo "?GeoId=".$geo->GeoId; ?>" />
<input id="recordId" type="hidden" value="<?php echo $geo->GeoId; ?>" />
<?php require 'tpl/toolbar.tpl.php5'; ?>

<?php if (!$geo->isEditable()): ?>
<div id="recArchive" class="box">This is an archived record version</div>
<?php endif; ?>
<div id="recTitle" class="box"><?php echo $geo->getGeographyString(); ?></div>

<div id="tabBoxUp" class="tabs">
	<ul>
		<li id="geoBasic"><a href="#geoBasicPanel">Description</a></li>
<?php if (Page::isLoggedIn()): ?>
<?php if ($geo->isEditable()): ?>
		<li id="verHist"><a href="verHistory.html<?php echo "?RecordId=".$geo->GeoId; ?>">Version History</a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
	<div id="geoBasicPanel">
<?php require "tpl/geoBasic.tpl.php5" ?>
	</div>
</div>

<div id="tabBoxLow" class="tabs">
	<ul>
<?php if ($geo->isEditable()): ?>
		<li id="geoSub"><a href="geoSub.html<?php echo "?GeoId=".$geo->GeoId; ?>">Sub regions <span class="recCount">(<?php echo($subCount); ?>)</span></a></li>
		<li id="geoLay"><a href="geoLay.html<?php echo "?GeoId=".$geo->GeoId; ?>">Layers <span class="recCount">(<?php echo($layCount); ?>)</span></a></li>
<?php endif; ?>
		<li id="geoNotes"><a href="geoNotes.html<?php echo "?GeoId=".$geo->GeoId; ?>">Notes</a></li>
	</ul>
</div>

</div>

</body>
</html>