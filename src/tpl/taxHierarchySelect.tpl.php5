<div class="hierarchy" id="catHierarchy">
<div class="edit-toolbar">
	<div class="buttons" data-id="" data-name="top level">
		<button class="select" type="button">Select Top-Level</button>
	</div>
</div>
<?php foreach ($cats as $cat): ?>
<div data-id="<?php echo $cat->CatId; ?>" data-select="true" class="entry collapsed">
<h3>
<?php if ($cat->Type != 0): ?>
<div class="status"></div>
<?php endif; ?>
<?php echo($cat->getTypeText().' '.$cat->Name); ?>
<div class="tools" data-id="<?php echo $cat->CatId; ?>" data-name="<?php echo($cat->getTypeText().' '.$cat->Name); ?>">
<?php if ($cat->Type != 0): ?>
<button class="select">Select</button>
<?php endif; ?>
</div>
</h3>
<?php if ($cat->Type != 0): ?>
<div class="children">
Loading...
</div>
<?php endif; ?>
</div>
<?php endforeach; ?>
</div>