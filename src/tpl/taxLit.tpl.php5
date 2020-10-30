<?php if ($editable && Page::isEditor()): ?>
<div class="editContainer">
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="litAdd" type="button">Add Link</button>
		</div>
	</div>
	<span class="recCount">(<?php echo count($lits); ?>)</span>
<?php endif; ?>
<?php if (count($lits)): ?>
<table class="lit" cellspacing="0" cellpadding="0">
<tr>
<th>&nbsp;</th>
<th>Authors</th>
<th>Year</th>
<th>Title</th>
</tr>
<?php foreach ($lits as $lit): ?>
<tr>
<td class="link">
<a href="showLit.html?LitId=<?php echo $lit->LitId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="authors">
<?php htmlOut($lit->getAuthors()); ?>
</td>
<td class="year">
<?php htmlOut($lit->Year); ?>
</td>
<td class="title">
<?php if ($editable && Page::isEditor()): ?>
<div class="tools" data-id="<?php echo $lit->LitId; ?>">
<button class="litDelete">Delete Link</button>
</div>
<?php endif; ?>
<?php echo $lit->Title; ?>
	<div class="ref">
<?php echo $lit->Reference; ?>
	</div>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<table class="lit Empty">
<tr>
<td>
No entries
</td>
</tr>
</table>
<?php endif; ?>
<?php if ($editable && Page::isEditor()): ?>
</div>
<?php endif; ?>