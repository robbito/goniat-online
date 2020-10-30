<!DOCTYPE html>
<html>
<head>
<title>Taxonomy - GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/toolbar.js"></script>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/taxHierarchy.js"></script>
<?php if (Page::isEditor()): ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/taxHierarchyEdit.js"></script>
<?php endif; ?>
</head>
<body>
<div class="main">

<?php require 'tpl/header.tpl.php5'; ?>
<input id="helpLink" type="hidden" value ="browse_taxonomical_hierarchy.html" />
<?php if (Page::isEditor()): ?>
<div id="catSelectForm">
<input id="catId" type="hidden" value="" />
<input id="catName" type="hidden" value="" />
<?php require 'tpl/taxHierarchySelect.tpl.php5'; ?>
</div>	
<?php endif; ?>

<?php require 'tpl/toolbar.tpl.php5'; ?>
<br />
<?php if (Page::isEditor()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="newRecord" type="button">New Top-Level Taxon</button>
		</div>
	</div>
<?php endif; ?>
<div class="hierarchy">
<?php foreach ($cats as $cat): ?>
<div data-id="<?php echo $cat->CatId; ?>" class="entry collapsed">
<h3>
<?php if ($cat->Type != 0): ?>
<div class="status"></div>
<?php endif; ?>
<?php echo($cat->getTypeText().' '.$cat->Name); ?>
<a href="showTaxCat.html?CatId=<?php echo $cat->CatId; ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php if (Page::isEditor()): ?>
<div class="tools" data-id="<?php echo $cat->CatId; ?>" data-name="<?php echo($cat->getTypeText().' '.$cat->Name); ?>">
<?php if ($cat->Type != 0): ?>
<button class="create">New Child</button>
<?php endif; ?>
<button class="move">Move</button>
<button class="delete">Delete</button>
</div>
<?php endif; ?>
</h3>
<?php if ($cat->Type != 0): ?>
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