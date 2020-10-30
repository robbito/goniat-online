<?php if (Page::isEditor() && $bnd->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicCancel" type="button">Cancel</button>
			<button id="basicSave" type="button">Save</button>
		</div>
	</div>
<?php endif; ?>
<form id="bndBasicForm">
<table class="record-content" cellspacing="0" cellpadding="0">
<tr id="mill">
<td class="label">
Million years:
</td>
<td class="value">
<input id="millYears" class="veryshort" name="MillYears" type="text" value="<?php echo $bnd->MillYears; ?>" />
</td>
</tr>

<tr id="code">
<td class="label">
Code:
</td>
<td class="value">
<input id="code" class="veryshort" name="Code" type="text" value="<?php echo $bnd->Code; ?>" />
</td>
</tr>

<tr id="name">
<td class="label">
Name:
</td>
<td class="value">
<input id="name" name="Name" type="text" value="<?php echo $bnd->Name; ?>" />
</td>
</tr>

<tr id="type">
<td class="label">
Type:
</td>
<td class="value">
<input id="type" class="veryshort" name="Type" type="text" value="<?php echo $bnd->Type; ?>" />
</td>
</tr>

</table>
</form>