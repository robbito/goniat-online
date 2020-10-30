<?php if (Page::isEditor() && $geo->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicCancel" type="button">Cancel</button>
			<button id="basicSave" type="button">Save</button>
		</div>
	</div>
<?php endif; ?>
<form id="geoBasicForm">
<?php if (isset($parentId)): ?>
	<input type="hidden" name="ParentId" value="<?php echo $parentId; ?>">
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<?php foreach ($geography as $geo1): ?>
<tr id="name">
<td class="label">
<?php htmlOut($geo1->getTypeText()); ?>:
</td>
<td class="value">
<?php if ($geo1->GeoId != $geo->GeoId): ?>
<?php htmlOut($geo1->Name); ?>
<?php else: ?>
<input type="text" name="Name" value="<?php echo $geo->Name; ?>" />
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
<?php if ($geo->GeoId == ""): ?>
<tr id="name">
<td class="label">
<select id="type" name="Type" data-max="<?php if (isset($geo1)) echo $geo1->Type; else echo 100; ?>">
	<option value="4">Contintent</option>
	<option value="3">Country</option>
	<option value="2">Provice</option>
	<option value="1">Locality</option>
	<option value="0">Layer</option>
</select>
</td>
<td class="value">
<input type="text" name="Name" value="" />
</td>
</tr>
<?php endif; ?>
</table>
</form>