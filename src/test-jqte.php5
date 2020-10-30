<?php
require 'inc/gon.inc.php5';
Page::init(false);
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php require 'tpl/include.tpl.php5'; ?>
		<link href="css/jquery-te-1.4.0.css" rel="stylesheet">
		<script language="JavaScript" type="text/javascript" src="jsc/lib/jquery-te-1.4.0.js"></script>
		<style>
			body {
				text-align: left;
			}
			#container {
				height: 300px;
				border: 1px solid #999;
				overflow: hidden;
			}
			#text {
				height: 100%;
			}
			#container .jqte_editor {
				height:  200px;
				resize: none;
			}
		</style>
	</head>
	<body>
		<div id="container">
		<p id="text">TODO write content</div>
		</div>
	</body>
	<script>
		$("#text").jqte();
	</script>
</html>
