<?php if (Page::isEditor() && $geo->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicAddDetails" type="button">Add Locality Details</button>
			<button id="basicDelete" type="button">Delete</button>
			<button id="basicEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<?php foreach ($geography as $geo1): ?>
<tr id="name">
<td class="label">
<?php htmlOut($geo1->getTypeText()); ?>:
</td>
<td class="value">
<?php htmlOut($geo1->Name); ?>
<?php if ($geo1->GeoId != $geo->GeoId): ?>
<a href="showGeo.html?GeoId=<?php echo($geo1->GeoId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>