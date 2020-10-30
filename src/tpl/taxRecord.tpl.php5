<!DOCTYPE html>
<html>
<head>
<title><?php echo($tax->getTaxonomyShortString()); ?> - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery.liteuploader.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEditTax.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecord.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main">

<?php require 'tpl/header.tpl.php5'; ?>

<input id="printLink" type="hidden" value="showTaxPrint.html<?php echo "?TaxId=".$tax->TaxId; ?>" />
<input id="recordId" type="hidden" value="<?php echo $tax->TaxId; ?>" />
<input id="recordCatId" type="hidden" value="<?php echo $tax->CatId; ?>" />
<?php require 'tpl/toolbar.tpl.php5'; ?>

<?php if (Page::isEditor()): ?>
<?php require 'tpl/locLinkForm.tpl.php5'; ?>
<?php require 'tpl/litLinkForm.tpl.php5'; ?>
<?php require 'tpl/figLoadForm.tpl.php5'; ?>
<?php endif; ?>
<?php if (!$tax->isEditable()): ?>
<div id="recArchive" class="box">This is an archived record version</div>
<?php endif; ?>
<div id="recTitle" class="box"><span id="recNo">TaxNo: <?php echo($tax->TaxNo); ?></span><?php echo($tax->getTaxonomyShortString()); ?></div>

<div id="tabBoxUp" class="tabs">
	<ul>
		<li id="taxBasic"><a href="#taxBasicPanel">Taxonomy</a></li>
<?php if ($tax->hasMorph()): ?>
		<li id="taxMorph"><a href="taxMorph.html<?php echo "?RecordId=".$tax->TaxId; ?>">Morphology</a></li>
<?php endif; ?>
<?php if (Page::isLoggedIn()): ?>
<?php if ($tax->isEditable()): ?>
		<li id="verHist"><a href="verHistory.html<?php echo "?RecordId=".$tax->TaxId; ?>">Version History</a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
	<div id="taxBasicPanel">
<?php require 'tpl/taxBasic.tpl.php5'; ?>
	</div>
</div>

<div id="tabBoxLow" class="tabs">
	<ul>
		<li id="taxNotes"><a href="taxNotes.html<?php echo "?TaxId=".$tax->TaxId; ?>">Notes</a></li>
<?php if ($tax->isEditable()): ?>
		<li id="taxFig"><a href="taxFig.html<?php echo "?TaxId=".$tax->TaxId; ?>">Figures <span class="recCount">(<?php echo($figCount); ?>)</span></a></li>
<?php if ($cat->Type == 0): ?>
		<li id="taxLit"><a href="taxLit.html<?php echo "?TaxId=".$tax->TaxId; ?>">Literature <span class="recCount">(<?php echo($litCount); ?>)</span></a></li>
		<li id="taxLoc"><a href="taxLoc.html<?php echo "?TaxId=".$tax->TaxId; ?>">Localities <span class="recCount">(<?php echo($locCount); ?>)</span></a></li>
<?php else: ?>
		<li id="taxSub"><a href="taxSub.html<?php echo "?TaxId=".$tax->TaxId; ?>">Sub categories <span class="recCount">(<?php echo($subCount); ?>)</span></a></li>
		<li id="taxSpc"><a href="taxSpc.html<?php echo "?TaxId=".$tax->TaxId; ?>">Species <span class="recCount">(<?php echo($spcCount); ?> / <?php echo($spcQualCount); ?> valid)</span></a></li>
		<li id="taxLit"><a href="taxLit.html<?php echo "?TaxId=".$tax->TaxId; ?>">Literature <span class="recCount">(<?php echo($litCount); ?>)</span></a></li>
<?php endif; ?>
<?php endif; ?>
	</ul>
</div>

</div>

</body>
</html>