<?php if (Page::isEditor() && $lit->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
<?php if ($lit->IsDeletable()): ?>
			<button id="basicDelete" type="button">Delete</button>
<?php endif; ?>
			<button id="basicEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<tr id="author1">
<td class="label">
1st Author:
</td>
<td class="value">
<?php if (isset($author1)): ?>
<?php htmlOut($author1->getName()); ?>
<a href="showAut.html?AutId=<?php echo($author1->AutId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>

<tr id="author2">
<td class="label">
2nd Author:
</td>
<td class="value">
<?php if (isset($author2)): ?>
<?php htmlOut($author2->getName()); ?>
<a href="showAut.html?AutId=<?php echo($author2->AutId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>

<tr id="author3">
<td class="label">
3rd Author:
</td>
<td class="value">
<?php if (isset($author3)): ?>
<?php htmlOut($author3->getName()); ?>
<a href="showAut.html?AutId=<?php echo($author3->AutId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>

<tr id="year">
<td class="label">
Year:
</td>
<td class="value">
<?php htmlOut($lit->Year); ?>
</td>
</tr>

<tr id="title">
<td class="label">
Title:
</td>
<td class="value">
<?php echo $lit->Title ?>
</td>
</tr>

<tr id="ref">
<td class="label">
Reference:
</td>
<td class="value">
<?php echo $lit->Reference ?>
</td>
</tr>

<tr id="keywords">
<td class="label">
Keywords:
</td>
<td class="value">
<?php htmlOut($lit->Short) ?>
</td>
</tr>

<tr id="url">
<td class="label">
Link:
</td>
<td class="value">
	<a href="<?php htmlOut($lit->Url) ?>"><?php htmlOut($lit->Url) ?></a>
</td>
</tr>

</table>