<?php if ($editable && Page::isEditor()): ?>
<div class="editContainer">
	<div class="edit-toolbar">
		<div class="buttons">
<?php if ($geo->Type != 0): ?>
			<button id="subCreate" type="button">Create Sub Region</button>
<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
<?php if (count($geos)): ?>
<table class="geo" cellspacing="0" cellpadding="0">
<tr>
<th>&nbsp;</th>
<th>Type</th>
<th>Region</th>
</tr>
<?php foreach ($geos as $geo): ?>
<tr>
<td class="link">
<a href="showLocGeo.html?GeoId=<?php echo $geo->GeoId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="type">
<?php htmlOut($geo->getTypeText()); ?>
</td>
<td class="name">
<?php htmlOut($geo->Name); ?>
<?php if ($editable && Page::isEditor()): ?>
<div class="tools" data-id="<?php echo $geo->GeoId; ?>">
<button class="subDelete">Delete</button>
</div>
<?php endif; ?>

</td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<table class="geo" cellspacing="0" cellpadding="0">
<tr>
<td>
No entries
</td>
</tr>
</table>
<?php endif; ?>
<?php if ($editable && Page::isEditor()): ?>
</div>
<?php endif; ?>