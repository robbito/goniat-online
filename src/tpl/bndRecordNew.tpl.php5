<!DOCTYPE html>
<html>
<head>
<title>New boundary - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<?php if (Page::isEditor()): ?>
<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEditBndNew.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/showRecordEdit.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main" id="bndRecord">

<?php require 'tpl/header.tpl.php5'; ?>

<input id="recordId" type="hidden" value="" />
<?php require 'tpl/toolbar.tpl.php5'; ?>

<div id="recTitle" class="box">New boundary</div>	
	
<div id="tabBoxUp" class="tabs">
	<ul>
		<li id="bndBasic"><a href="#bndBasicPanel">Description</a></li>
	</ul>
	<div id="bndBasicPanel">
<?php require "tpl/bndBasicEdit.tpl.php5" ?>
	</div>
</div>

<br />
To edit additional information, normally shown here, please save the new record.
<br /><br />
</div>

</body>
</html>