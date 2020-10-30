<!DOCTYPE html>
<html>
<head>
<title><?php echo $loc->getLayerString(); ?> - GONIAT-Online</title>
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
<input type="checkbox" class="section" name="layer" checked="checked">Description</input><br />
<input type="checkbox" class="section" name="notes" checked="checked">Notes</input><br />
<input type="checkbox" class="section" name="figures" checked="checked">Figures</input><br />
<?php if ($geo->Type == 0): ?>
<input type="checkbox" class="section" name="taxa" checked="checked">Taxa</input><br />
<?php endif; ?>
<input type="checkbox" class="section" name="literature" checked="checked">Literature</input><br />
<?php if ($geo->Type != 0): ?>
<input type="checkbox" class="section" name="subgeo" checked="checked">Sub regions</input><br />
<?php endif; ?>
</div>
<p style="text-align:center;margin-bottom: 5px;">
<input type="button" onclick="window.print();" value="Print"/>
<input type="button" onclick="window.close();" value="Close"/></p>
</div>

<div id="bannerSection" class="PrintSection">
<?php require 'tpl/header.tpl.php5'; ?>
</div>

<div id="headerSection" class="PrintSection">
<h1><?php echo($loc->getLayerString()); ?></h1>
LocNo: <?php echo($loc->LocNo); ?><br />
Printed: <?php echo(date("Y-m-d",time())); ?>
</div>

<div id="layerSection" class="PrintSection">
<h2>Description</h2>
<?php require "tpl/locBasic.tpl.php5" ?>
</div>

<div id="notesSection" class="PrintSection">
<h2>Notes</h2>
<?php require "tpl/notes.tpl.php5" ?>
</div>

<div id="figuresSection" class="PrintSection">
<h2>Figures</h2>
<?php require ('tpl/locFig.tpl.php5'); ?>
</div>

<?php if ($geo->Type == 0): ?>
<div id="taxaSection" class="PrintSection Relations">
<h2>Taxa</h2>
<?php require ('tpl/litTax.tpl.php5'); ?>
</div>
<?php endif; ?>

<div id="literatureSection" class="PrintSection Relations">
<h2>Literature</h2>
<?php require ('tpl/taxLit.tpl.php5'); ?>
</div>

<?php if ($geo->Type != 0): ?>

<div id="subcatSection" class="PrintSection Relations">
<h2>Sub categories</h2>
<?php loadSubgeo($loc); ?>
<?php require ('tpl/geoSub.tpl.php5'); ?>
</div>

<?php endif; ?>

</div>

</body>
</html>