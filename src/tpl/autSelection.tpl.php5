<!DOCTYPE html>
<html>
<head>
<title>GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/recSelectionEditAut.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/recSelectionEdit.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" style="height: auto">

<?php require 'tpl/header.tpl.php5'; ?>

<?php require 'tpl/toolbar.tpl.php5'; ?>

<h2 style="margin-top:10px"><?php echo $autNum ?> records found. Please select:</h2>
<?php if (Page::isEditor()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="newRecord" type="button">New Author</button>
		</div>
	</div>
<?php endif; ?>
<table class="autSel" width="100%" cellspacing="0" cellpadding="0">
<?php foreach($sel as $aut): ?>
<tr>
<td class="link">
<a href="showAut.html?AutId=<?php echo $aut->AutId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="name">
	<?php echo $aut->LastName; if (strlen($aut->FirstName)) echo ", ".$aut->FirstName; ?>
	<?php if (Page::isEditor()): ?>
	<div class="tools" data-id="<?php echo $aut->AutId; ?>">
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