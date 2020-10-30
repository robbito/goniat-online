<?php if (Page::isEditor() && $tax->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicCancel" type="button">Cancel</button>
			<button id="basicSave" type="button">Save</button>
		</div>
	</div>
<?php endif; ?>
<form id="taxBasicForm">
<table class="record-content" cellspacing="0" cellpadding="0">
<?php foreach ($taxonomy as $cat): ?>
<tr id="name">
<td class="label">
<?php htmlOut($cat->getTypeText()); ?>:
</td>
<td class="value">
<?php if ($cat->CatId != $tax->CatId): ?>
<?php htmlOut($cat->Name); ?>
<?php else: ?>
<input type="text" name="Name" value="<?php echo $cat->Name; ?>" />
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
<tr id="qualifier">
<td class="label">
Qualifier:
</td>
<td class="value">
<select name="Qualifier">
<?php $i = 0; foreach ($tax->getQualifiers() as $qual): ?>
	<option value ="<?php echo $i; ?>"<?php if ($i == $tax->Qualifier) echo ' selected="selected"'; ?>><?php echo $qual; ?> - <?php echo Tax::_getQualifierDesc($i); ?></option>
<?php $i++; endforeach; ?>
</select>
</td>
</tr>
<tr id="author">
<td class="label">
Author:
</td>
<td class="value">
<input id="authorId" name="AuthorId" type="hidden" value="<?php if (isset($author)) echo $author->AutId; ?>" />
<input id="authorTxt" name="Author" type="text" value="<?php if (isset($author)) echo $author->LastName; ?>" />
</td>
<tr>
<td class="label">
Year/Pages:
</td>
<td class="value">
<input id="pages" name="Pages" type="text" value="<?php echo $tax->Pages; ?>" />
</td>
</tr>
<tr id="valid">
<td class="label">
Valid:
</td>
<td class="value">
<input id="valid" name="Valid" type="text" value="<?php echo $tax->Valid; ?>" />
</td>
</tr>
<tr id="lowBound">
<td class="label">
Lower Boundary:
</td>
<td class="value">
<input id="loBoundId" name="LoBoundId" type="hidden" value="<?php if (isset($lowerBoundary)) echo $lowerBoundary->BndId; ?>" />
<input id="loBoundTxt" name="LoBound" type="text" value="<?php  if (isset($lowerBoundary)) echo $lowerBoundary->getSelectString(); ?>" />
</td>
</tr>
<tr id="upBound">
<td class="label">
Upper Boundary:
</td>
<td class="value">
<input id="upBoundId" name="UpBoundId" type="hidden" value="<?php if (isset($upperBoundary)) echo $upperBoundary->BndId; ?>" />
<input id="upBoundTxt" name="UpBound" type="text" value="<?php if (isset($upperBoundary)) echo $upperBoundary->getSelectString(); ?>" />
</td>
</tr>
</table>
</form>