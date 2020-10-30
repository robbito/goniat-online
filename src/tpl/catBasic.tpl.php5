<?php if (Page::isEditor() && $cat->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicAddDetails" type="button">Add Taxon Details</button>
			<button id="basicDelete" type="button">Delete</button>
			<button id="basicEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<?php foreach ($taxonomy as $catTmp): ?>
<tr id="name">
<td class="label">
<?php htmlOut($catTmp->getTypeText()); ?>:
</td>
<td class="value">
<?php htmlOut($catTmp->Name); ?>
<?php if ($catTmp->CatId != $cat->CatId): ?>
<a href="showTaxCat.html?CatId=<?php echo $catTmp->CatId; ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>