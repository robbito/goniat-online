<!DOCTYPE html>
<html>
<head>
<title><?php echo $cat->getTypeText().' '.$cat->Name; ?> - GONIAT-Online</title>
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
<input type="checkbox" class="section" name="taxonomy" checked="checked">Taxonomy</input><br />
<input type="checkbox" class="section" name="subcat" checked="checked">Sub categories</input><br />
<input type="checkbox" class="section" name="species" checked="checked">Species</input><br />
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
<h1><?php echo($cat->getTypeText().' '.$cat->Name); ?></h1>
Printed: <?php echo(date("Y-m-d",time())); ?>
</div>

<div id="taxonomySection" class="PrintSection">
<h2>Taxonomy</h2>
<?php require "tpl/catBasic.tpl.php5" ?>
</div>

<div id="subcatSection" class="PrintSection Relations">
<h2>Sub categories</h2>
<?php loadSubcat($cat); ?>
<?php require ('tpl/catSub.tpl.php5'); ?>
</div>

<div id="speciesSection" class="PrintSection Relations">
<h2>Species</h2>
<?php loadSpecies($cat); ?>
<?php require ('tpl/catSpc.tpl.php5'); ?>
</div>

<div id="notesSection" class="PrintSection">
<h2>Notes</h2>
<?php require "tpl/notes.tpl.php5" ?>
</div>

</body>
</html>