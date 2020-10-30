<!DOCTYPE html>
<html>
<head>
<title><?php echo $geo->getGeographyString(); ?> - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordPrint.js"></script>

</head>
<body>
<div class="main print">

<div id="printSettings" class="NoPrint">
<b>Choose sections for printing:</b><br />
<div style="margin:3px;">
<input type="checkbox" class="section" name="banner" checked="checked">GONIAT banner</input><br />
<input type="checkbox" class="section" name="geo" checked="checked">Description</input><br />
<input type="checkbox" class="section" name="subgeo" checked="checked">Sub regions</input><br />
<input type="checkbox" class="section" name="notes" checked="checked">Notes</input><br />
</div>
<p style="text-align:center;margin-bottom: 5px;">
<input type="button" onclick="window.print();" value="Print"/>
<input type="button" onclick="window.close();" value="Close"/></p>
</div>

<div id="bannerSection" class="PrintSection">
<?php require 'tpl/header.tpl.php5'; ?>
</div>

<div id="headerSection" class="PrintSection">
<h1><?php echo($geo->getGeographyString()); ?></h1>
Printed: <?php echo(date("Y-m-d",time())); ?>
</div>

<div id="geoSection" class="PrintSection">
<h2>Region</h2>
<?php require "tpl/geoBasic.tpl.php5" ?>
</div>

<div id="subgeoSection" class="PrintSection Relations">
<h2>Sub regions</h2>
<?php require ('tpl/geoSub.tpl.php5'); ?>
</div>

<div id="notesSection" class="PrintSection">
<h2>Notes</h2>
<?php require "tpl/notes.tpl.php5" ?>
</div>

</div>
</body>
</html>