<?php if (Page::isEditor() && $loc->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicCancel" type="button">Cancel</button>
			<button id="basicSave" type="button">Save</button>
		</div>
	</div>
<?php endif; ?>
<form id="locBasicForm">
<table class="record-content" cellspacing="0" cellpadding="0">
<?php foreach ($geography as $geo): ?>
<tr id="name">
<td class="label">
<?php htmlOut($geo->getTypeText()); ?>:
</td>
<td class="value">
<?php if ($geo->GeoId != $loc->GeoId): ?>
<?php htmlOut($geo->Name); ?>
<?php else: ?>
<input type="text" name="Name" value="<?php echo $geo->Name; ?>" />
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
<tr id="lowBound">
<td class="label">
Lower Boundary:
</td>
<td class="value">
<input id="loBoundId" name="LoBoundId" type="hidden" value="<?php if (isset($lowerBoundary)) echo $lowerBoundary->BndId; ?>" />
<input id="loBoundTxt" name="LoBound" type="text" value="<?php if (isset($lowerBoundary)) echo $lowerBoundary->getSelectString(); ?>" />
</td>
</tr>
<tr id="upBound">
<td class="label">
Upper Boundary:
</td>
<td class="value">
<input id="upBoundId" name="UpBoundId" type="hidden" value="<?php  if (isset($upperBoundary)) echo $upperBoundary->BndId; ?>" />
<input id="upBoundTxt" name="UpBound" type="text" value="<?php if (isset($upperBoundary)) echo $upperBoundary->getSelectString(); ?>" />
</td>
</tr>
<tr id="geoRef">
<td class="label">
Georeference:
</td>
<td class="value">
<input id="geoRef" name="GeoRef" type="text" value="<?php echo $loc->GeoRef; ?>" />
</td>
</tr>
</table>
</form>