<!DOCTYPE html>
<html>
<head>
<title>GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
</head>
<body>
<div class="main" style="height: auto">

<?php require 'tpl/header.tpl.php5'; ?>

<?php require 'tpl/toolbar.tpl.php5'; ?>

<h2 style="margin-top:10px"><?php echo $catNum ?> (<?php echo $valNum; ?> valid) records found. Please select:</h2>
<table class="taxSel" width="100%" cellspacing="0" cellpadding="0">
<?php foreach($sel as $name => $rec): ?>
<tr>
<td class="link" rowspan="2">
<?php if (isset($rec[1])): ?>
<a href="showTax.html?TaxId=<?php echo $rec[1]->TaxId; ?>">
<?php else: ?>
<a href="showCat.html?CatId=<?php echo $rec[0]; ?>">
<?php endif; ?>
<img title="View Details" src="img/link.png" />
</a>
</td>
<?php if (isset($rec[1]) && !Tax::isValid($rec[1]->Qualifier)): ?>
<td class="taxon invalid">
<?php else: ?>
<td class="taxon">
<?php endif; ?>
<?php echo $name ?>
<?php if (isset($rec[1]) && !Tax::isValid($rec[1]->Qualifier)) echo "<span class=\"qual\">(Qualifier: ".Tax::_getQualifierText($rec[1]->Qualifier).")</span>"; ?>
</td>
</tr>
<tr>
<td class="authors">
<?php if (isset($rec[1]) && isset($rec[1]->AutId)): ?>
<?php echo str_replace('_',' ',$rec[1]->getAuthor()->LastName)." ".$rec[1]->Pages; ?>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>

</div>
</body>
</html>