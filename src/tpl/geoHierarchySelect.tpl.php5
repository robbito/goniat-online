<div class="hierarchy" id="geoHierarchy">
<div class="edit-toolbar">
	<div class="buttons" data-id="" data-name="top level">
		<button class="select" type="button">Select Top-Level</button>
	</div>
</div>
<?php foreach ($geos as $geo): ?>
<div data-id="<?php echo $geo->GeoId; ?>" data-select="true" class="entry collapsed">
<h3>
<?php if ($geo->Type != 0): ?>
<div class="status"></div>
<?php endif; ?>
<?php echo($geo->getTypeText().' '.$geo->Name); ?>
<div class="tools" data-id="<?php echo $geo->GeoId; ?>" data-name="<?php echo($geo->getTypeText().' '.$geo->Name); ?>">
<?php if ($geo->Type != 0): ?>
<button class="select">Select</button>
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