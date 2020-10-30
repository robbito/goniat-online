<!DOCTYPE html>
<html>
<head>
<title><?php echo($tax->getTaxonomyShortString()); ?> - GONIAT-Online</title>
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
<input type="checkbox" class="section" name="morphology">Morphology</input><br />
<input type="checkbox" class="section" name="notes" checked="checked">Notes</input><br />
<input type="checkbox" class="section" name="literature" checked="checked">Literature</input><br />
<?php if ($cat->Type == 0): ?>
<input type="checkbox" class="section" name="localities" checked="checked">Localities</input><br />
<?php endif; ?>
<input type="checkbox" class="section" name="figures" checked="checked">Figures</input><br />
<?php if ($cat->Type != 0): ?>
<input type="checkbox" class="section" name="subcat" checked="checked">Sub categories</input><br />
<input type="checkbox" class="section" name="species" checked="checked">Species</input><br />
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
<h1><?php echo($tax->getTaxonomyShortString()); ?></h1>
TaxNo: <?php echo($tax->TaxNo); ?><br />
Printed: <?php echo(date("Y-m-d",time())); ?>
</div>

<div id="taxonomySection" class="PrintSection">
<h2>Taxonomy</h2>
<?php require "tpl/taxBasic.tpl.php5" ?>
</div>

<div id="morphologySection" class="PrintSection" style="display: none">
<h2>Morphology</h2>
<?php require 'tpl/taxMorph.tpl.php5'; ?>
</div>

<div id="notesSection" class="PrintSection">
<h2>Notes</h2>
<?php require "tpl/notes.tpl.php5" ?>
</div>

<div id="literatureSection" class="PrintSection Relations">
<h2>Literature</h2>
<?php require ('tpl/taxLit.tpl.php5'); ?>
</div>

<?php if ($cat->Type == 0): ?>
<div id="localitiesSection" class="PrintSection Relations">
<h2>Localities</h2>
<?php require ('tpl/taxLoc.tpl.php5'); ?>
</div>
<?php endif; ?>

<div id="figuresSection" class="PrintSection">
<h2>Figures</h2>
<?php require ('tpl/taxFig.tpl.php5'); ?>
</div>

<?php if ($cat->Type != 0): ?>

<div id="subcatSection" class="PrintSection Relations">
<h2>Sub categories</h2>
<?php loadSubcat($tax); ?>
<?php require ('tpl/catSub.tpl.php5'); ?>
</div>

<div id="speciesSection" class="PrintSection Relations">
<h2>Species</h2>
<?php loadSpecies($tax); ?>
<?php require ('tpl/catSpc.tpl.php5'); ?>
</div>

<?php endif; ?>

</div>
	
</body>
</html>