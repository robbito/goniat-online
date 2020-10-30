<?php if (Page::isEditor() && $tax->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
<?php if ($tax->hasMorph()) : ?>
			<button id="basicRemoveMorph" type="button">Remove Morphology</button>
<?php else: ?>
			<button id="basicAddMorph" type="button">Add Morphology</button>
<?php endif; ?>
			<button id="basicRemoveDetails" type="button">Remove Taxon Details</button>
			<button id="basicEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<?php foreach ($taxonomy as $cat): ?>
<tr id="name">
<td class="label">
<?php htmlOut($cat->getTypeText()); ?>:
</td>
<td class="value">
<?php htmlOut($cat->Name); ?>
<?php if ($cat->CatId != $tax->CatId): ?>
<a href="showTaxCat.html?CatId=<?php echo($cat->CatId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
<tr id="qualifier">
<td class="label">
Qualifier:
</td>
<td class="value" title="<?php echo $tax->getQualifierDesc(); ?>">
<?php echo $tax->getQualifierText() ?>
</td>
</tr>
<tr id="author">
<td class="label">
Author:
</td>
<td class="value">
<?php if (!is_null($author)): ?>
	<?php htmlOut(str_replace('_'," ",$author->LastName).' '.$tax->Pages); ?>
	<a href="showAut.html?AutId=<?php echo($author->AutId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>
<?php
	// Handle conditional display of Valid field
	if ($tax->Valid != ''):
?>
<tr id="valid">
<td class="label">
Valid:
</td>
<td class="value">
<?php htmlOut($tax->Valid,true); ?>
</td>
</tr>
<?php endif; ?>
<tr id="lowBound">
<td class="label">
Lower Boundary:
</td>
<td class="value">
<?php if (!is_null($lowerBoundary)) : ?>
<?php htmlOut($lowerBoundary->Name); ?>, <?php htmlOut($lowerBoundary->MillYears); ?> million years
<a href="showBnd.html?BndId=<?php echo($lowerBoundary->BndId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>
<tr id="upBound">
<td class="label">
Upper Boundary:
</td>
<td class="value">
<?php if (!is_null($upperBoundary)): ?>
<?php htmlOut($upperBoundary->Name); ?>, <?php htmlOut($upperBoundary->MillYears); ?> million years
<a href="showBnd.html?BndId=<?php echo($upperBoundary->BndId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>
</table>