<?php if (Page::isEditor() && $cat->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicCancel" type="button">Cancel</button>
			<button id="basicSave" type="button">Save</button>
		</div>
	</div>
<?php endif; ?>
<form id="catBasicForm">
<?php if (isset($parentId)): ?>
	<input type="hidden" name="ParentId" value="<?php echo $parentId; ?>">
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<?php foreach ($taxonomy as $catTmp): ?>
<tr id="name">
<td class="label">
<?php htmlOut($catTmp->getTypeText()); ?>:
</td>
<td class="value">
<?php if ($catTmp->CatId != $cat->CatId): ?>
<?php htmlOut($catTmp->Name); ?>
<?php else: ?>
<input type="text" name="Name" value="<?php echo $cat->Name; ?>" />
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
<?php if ($cat->CatId == ""): ?>
<tr id="name">
<td class="label">
<select id="type" name="Type" data-max="<?php if (isset($catTmp)) echo $catTmp->Type; else echo 100; ?>">
	<option value="8">Order</option>
	<option value="7">Suborder</option>
	<option value="6">Superfamily</option>
	<option value="5">Family</option>
	<option value="4">Subfamily</option>
	<option value="3">Genus</option>
	<option value="2">Subgenus</option>
	<option value="1">NomSpecies</option>
	<option value="0">Species</option>
</select>
</td>
<td class="value">
<input type="text" name="Name" value="" />
</td>
</tr>
<?php endif; ?>
</table>
</form>