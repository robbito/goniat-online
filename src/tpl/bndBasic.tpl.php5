<?php if (Page::isEditor() && $bnd->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
<?php if ($bnd->IsDeletable()): ?>
			<button id="basicDelete" type="button">Delete</button>
<?php endif; ?>
			<button id="basicEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<tr id="mill">
<td class="label">
Million years:
</td>
<td class="value">
<?php echo number_format($bnd->MillYears,1); ?>
</td>
</tr>

<tr id="code">
<td class="label">
Code:
</td>
<td class="value">
<?php htmlOut($bnd->Code); ?>
</td>
</tr>

<tr id="name">
<td class="label">
Name:
</td>
<td class="value">
<?php htmlOut($bnd->Name); ?>
</td>
</tr>

<tr id="type">
<td class="label">
Type:
</td>
<td class="value">
<?php htmlOut($bnd->Type); ?>
</td>
</tr>

</table>