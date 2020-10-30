<?php if (count($cats)): ?>
<?php foreach ($cats as $cat): ?>
<div data-id="<?php echo $cat->CatId; ?>"<?php if ($select) echo ' data-select="true"'; ?> class="entry collapsed">
<?php $qual = array_key_exists($cat->CatId,$qualifiers) ? $qualifiers[$cat->CatId] : null; ?>
<?php if ($qual != null && !Tax::isValid($qual)): ?>
<h2 class="invalid">
<?php else: ?>
<h2>
<?php endif; ?>
<?php if ($cat->Type != 0): ?>
<div class="status"></div>
<?php endif; ?>
<?php echo($cat->getTypeText().' '.$cat->Name); ?>
<a href="showTaxCat.html?CatId=<?php echo $cat->CatId; ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php if ($qual != null && !Tax::isValid($qual)) echo "<span class=\"qual\">(Qualifier: ".Tax::_getQualifierText($qual).")</span>"; ?>
<?php if (Page::isEditor()): ?>
<div class="tools" data-id="<?php echo $cat->CatId; ?>" data-name="<?php echo($cat->getTypeText().' '.$cat->Name); ?>">
<?php if ($cat->Type != 0): ?>
<?php if ($select): ?>
<button class="select">Select</button>
<?php else: ?>
<button class="create">New Child</button>
<?php endif; ?>
<?php endif; ?>
<?php if (!$select): ?>
<button class="move">Move</button>
<button class="delete">Delete</button>
<?php endif; ?>
</div>
<?php endif; ?>
</h2>
<?php if ($cat->Type != 0): ?>
<div class="children">
Loading...
</div>
<?php endif; ?>
</div>
<?php endforeach; ?>
<?php else: ?>
No sub categories
<?php endif; ?>