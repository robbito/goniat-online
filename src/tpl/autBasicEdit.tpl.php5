<?php if (Page::isEditor() && $aut->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicCancel" type="button">Cancel</button>
			<button id="basicSave" type="button">Save</button>
		</div>
	</div>
<?php endif; ?>
<form id="autBasicForm">
<table class="record-content" cellspacing="0" cellpadding="0">
<tr id="last">
<td class="label">
Last name:
</td>
<td class="value">
<input id="last" class="short" name="LastName" type="text" value="<?php echo $aut->LastName; ?>" />
</td>
</tr>

<tr id="first">
<td class="label">
First name:
</td>
<td class="value">
<input id="firstName" class="short" name="FirstName" type="text" value="<?php echo $aut->FirstName; ?>" />
</td>
</tr>

</table>
</form>