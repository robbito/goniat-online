<!DOCTYPE html>
<html>
<head>
<title>GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/recSelectionEditBnd.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/recSelectionEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" style="height: auto">

<?php require 'tpl/header.tpl.php5'; ?>

<?php require 'tpl/toolbar.tpl.php5'; ?>

<h2 style="margin-top:10px"><?php echo $bndNum ?> records found. Please select:</h2>
<?php if (Page::isEditor()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="newRecord" type="button">New Boundary</button>
		</div>
	</div>
<?php endif; ?>
<table class="bndSel" width="100%" cellspacing="0" cellpadding="0">
<?php foreach($sel as $bnd): ?>
<tr>
<td class="link">
<a href="showBnd.html?BndId=<?php echo $bnd->BndId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="millYears">
	<?php echo number_format($bnd->MillYears,1); ?>
</td>
<td class="name">
	<?php htmlOut($bnd->Name); ?> <?php htmlOut($bnd->Code); ?>
</td>
<td class="type">
	<?php htmlOut($bnd->Type); ?>
	<?php if (Page::isEditor()): ?>
	<div class="tools" data-id="<?php echo $bnd->BndId; ?>">
	<button class="delete">Delete</button>
	</div>
	<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>

</div>
</body>
</html>