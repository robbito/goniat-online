<?php if ($editable && Page::isEditor()): ?>
<div class="editContainer">
<?php if (isset($cat) && $cat->Type != 0): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="subCreate" type="button">Create Sub Taxon</button>
		</div>
	</div>
<?php endif; ?>
<?php endif; ?>
<?php if (count($cats)): ?>
<table class="cat" cellspacing="0" cellpadding="0">
<tr>
<th>&nbsp;</th>
<th>Type</th>
<th>Name</th>
</tr>
<?php foreach ($cats as $catTmp): ?>
<?php $qual = array_key_exists($catTmp->CatId,$qualifiers) ? $qualifiers[$catTmp->CatId] : null; ?>
<?php $isInvalid = !Tax::isValid($qual); ?>
<tr>
<td class="link">
<a href="showTaxCat.html?CatId=<?php echo $catTmp->CatId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="type<?php if ($isInvalid) echo " invalid"; ?>">
<?php htmlOut($catTmp->getTypeText()); ?>
</td>
<td class="name<?php if ($isInvalid) echo " invalid"; ?>">
<?php htmlOut($catTmp->Name); ?>
<?php if ($isInvalid) echo " <span class=\"qual\">(Qualifier: ".Tax::_getQualifierText($qual).")</span>"; ?>
<?php if ($editable && Page::isEditor()): ?>
<div class="tools" data-id="<?php echo $catTmp->CatId; ?>">
<button class="subDelete">Delete</button>
</div>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<table class="cat" cellspacing="0" cellpadding="0">
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