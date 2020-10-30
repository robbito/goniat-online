<?php if (Page::isEditor() && $aut->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
<?php if ($aut->IsDeletable()): ?>
			<button id="basicDelete" type="button">Delete</button>
<?php endif; ?>
			<button id="basicEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<tr id="last">
<td class="label">
Last name:
</td>
<td class="value">
<?php htmlOut($aut->LastName); ?>
</td>
</tr>

<tr id="first">
<td class="label">
First name:
</td>
<td class="value">
<?php htmlOut($aut->FirstName); ?>
</td>
</tr>

</table>