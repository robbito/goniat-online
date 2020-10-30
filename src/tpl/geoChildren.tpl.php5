<?php if (count($geos)): ?>
<?php foreach ($geos as $geo): ?>
<div data-id="<?php echo $geo->GeoId; ?>"<?php if ($select) echo ' data-select="true"'; ?> class="entry collapsed">
<h2>
<?php if ($geo->Type != 0): ?>
<div class="status"></div>
<?php endif; ?>
<?php echo($geo->getTypeText().' '.$geo->Name); ?>
<a href="showLocGeo.html?GeoId=<?php echo $geo->GeoId; ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php if (Page::isEditor()): ?>
<div class="tools" data-id="<?php echo $geo->GeoId; ?>" data-name="<?php echo($geo->getTypeText().' '.$geo->Name); ?>">
<?php if ($geo->Type != 0): ?>
<?php if ($select): ?>
<button class="select">Select</button>
<?php else: ?>
<button class="create">New Child</button>
<?php endif; ?>
<?php endif; ?>
<?php if (!$select): ?>
<button class="move">Move</button>
<button class="delete">Delete</button>
<?php endif; ?>
</div>
<?php endif; ?>
</h2>
<?php if ($geo->Type != 0): ?>
<div class="children">
Loading...
</div>
<?php endif; ?>
</div>
<?php endforeach; ?>
<?php else: ?>
No sub regions
<?php endif; ?>