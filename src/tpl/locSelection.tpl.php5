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

<h2 style="margin-top:10px"><?php echo $geoNum ?> records found. Please select:</h2>
<table class="locSel" width="100%" cellspacing="0" cellpadding="0">
<?php foreach($sel as $name => $rec): ?>
<tr>
<td class="link" rowspan="2">
<?php if (isset($rec[1])): ?>
<a href="showLoc.html?LocId=<?php echo $rec[1]->LocId; ?>">
<?php else: ?>
<a href="showGeo.html?GeoId=<?php echo $rec[0]->GeoId; ?>">
<?php endif; ?>
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="geo">
<?php echo $name ?>
</td>
</tr>
<tr>
<?php if (isset($rec[1])): ?>
<td class="layer">
<?php echo $rec[0]->Name; ?>
</td>
<?php endif; ?>
</tr>
<?php endforeach; ?>
</table>

</div>
</body>
</html>