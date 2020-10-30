<?php if ($editable && Page::isEditor()): ?>
<div class="editContainer">
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="locAdd" type="button">Add Link</button>
		</div>
	</div>
	<span class="recCount">(<?php echo count($locs); ?>)</span>
<?php endif; ?>
<?php if (count($locs)): ?>
<table class="loc" cellspacing="0" cellpadding="0">
<tr>
<th>&nbsp;</th>
<th>Locality</th>
<th>Layer</th>
</tr>
<?php foreach ($locs as $loc): ?>
<tr>
<td class="link">
<a href="showLoc.html?LocId=<?php echo $loc->LocId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="locality">
<?php htmlOut($loc->getLocalityString()); ?>
</td>
<td class="layer">
<?php if ($editable && Page::isEditor()): ?>
<div class="tools" data-id="<?php echo $loc->LocId; ?>">
<button class="locDelete">Delete Link</button>
</div>
<?php endif; ?>
<?php htmlOut($loc->getLayerString()); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<table class="lit Empty">
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