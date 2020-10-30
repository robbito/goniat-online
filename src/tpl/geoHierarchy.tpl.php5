<!DOCTYPE html>
<html>
<head>
<title>Geography - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/geoHierarchy.js"></script>
<?php if (Page::isEditor()): ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/geoHierarchyEdit.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main">

<?php require 'tpl/header.tpl.php5'; ?>
<input id="helpLink" type="hidden" value="browse_geographical_hierarchy.htm" />
<?php if (Page::isEditor()): ?>
<div id="geoSelectForm">
<input id="geoId" type="hidden" value="" />
<input id="geoName" type="hidden" value="" />
<?php require 'tpl/geoHierarchySelect.tpl.php5'; ?>
</div>	
<?php endif; ?>

<?php require 'tpl/toolbar.tpl.php5'; ?>
<br />
<?php if (Page::isEditor()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="newRecord" type="button">New Top-Level Region</button>
		</div>
	</div>
<?php endif; ?>
<div class="hierarchy">
<?php foreach ($geos as $geo): ?>
<div data-id="<?php echo $geo->GeoId; ?>" class="entry collapsed">
<h3>
<?php if ($geo->Type != 0): ?>
<div class="status"></div>
<?php endif; ?>
<?php echo($geo->getTypeText().' '.$geo->Name); ?>
<a href="showLocGeo.html?GeoId=<?php echo $geo->GeoId; ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php if (Page::isEditor()): ?>
<div class="tools" data-id="<?php echo $geo->GeoId; ?>" data-name="<?php echo($geo->getTypeText().' '.$geo->Name); ?>">
<?php if ($geo->Type != 0): ?>
<button class="create">New Child</button>
<?php endif; ?>
<button class="move">Move</button>
<button class="delete">Delete</button>
</div>
<?php endif; ?>
</h3>
<?php if ($geo->Type != 0): ?>
<div class="children">
Loading...
</div>
<?php endif; ?>
</div>
<?php endforeach; ?>
</div>

</div>

</body>
</html>