<!DOCTYPE html>
<html>
<head>
<title>GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/recSelectionLog.js"></script>
<?php else: ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" style="height: auto">

<?php require 'tpl/header.tpl.php5'; ?>

<?php require 'tpl/toolbar.tpl.php5'; ?>

<h2 style="margin-top:10px">Version log</h2>

<?php $showTable = true; ?>
<?php require 'tpl/verHistory.tpl.php5'; ?>

</div>
</body>
</html>