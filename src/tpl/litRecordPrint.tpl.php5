<!DOCTYPE html>
<html>
<head>
<title><?php echo($lit->getAuthors()." ".$lit->Year); ?> - GONIAT-Online</title>
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
<input type="checkbox" class="section" name="literature" checked="checked">Description</input><br />
<input type="checkbox" class="section" name="notes" checked="checked">Notes</input><br />
<input type="checkbox" class="section" name="taxa" checked="checked">Taxa</input><br />
<input type="checkbox" class="section" name="localities" checked="checked">Localities</input>
</div>
<p style="text-align:center;margin-bottom: 5px;">
<input type="button" onclick="window.print();" value="Print"/>
<input type="button" onclick="window.close();" value="Close"/></p>
</div>

<div id="bannerSection" class="PrintSection">
<?php require 'tpl/header.tpl.php5'; ?>
</div>

<div id="headerSection" class="PrintSection">
<h1><?php echo($lit->getAuthors()." ".$lit->Year); ?></h1>
LitNo: <?php echo($lit->LitNo); ?><br />
Printed: <?php echo(date("Y-m-d",time())); ?>
</div>

<div id="literatureSection" class="PrintSection">
<h2>Description</h2>
<?php require "tpl/litBasic.tpl.php5" ?>
</div>

<div id="notesSection" class="PrintSection">
<h2>Notes</h2>
<?php require "tpl/notes.tpl.php5" ?>
</div>

<div id="taxaSection" class="PrintSection Relations">
<h2>Taxa</h2>
<?php 	require "tpl/litTax.tpl.php5" ?>
</div>

<div id="localitiesSection" class="PrintSection Relations">
<h2>Localities</h2>
<?php 	require "tpl/taxLoc.tpl.php5" ?>
</div>

</body>
</html>