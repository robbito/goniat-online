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

<h2 style="margin-top:10px"><?php echo $litNum ?> records found. Please select:</h2>
<table class="litSel" width="100%" cellspacing="0" cellpadding="0">
<?php foreach($sel as $lit): ?>
<tr>
<td class="link" rowspan="3">
<a href="showLit.html?LitId=<?php echo $lit->LitId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="authors">
<?php echo $lit->getAuthors()." ".$lit->Year; ?>
</td>
</tr>
<tr>
<td class="title">
<?php echo $lit->Title; ?>
</td>
</tr>
<tr>
<td class="ref">
<?php echo $lit->Reference; ?>
</td>
</tr>
<?php endforeach; ?>
</table>

</div>
</body>
</html>