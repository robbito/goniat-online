<?php if (count($cats)): ?>
<table class="tax" cellspacing="0" cellpadding="0">
<tr>
<th>&nbsp;</th>
<th>Taxon</th>
</tr>
<?php foreach ($cats as $name => $catId): ?>
<tr>
<td class="link">
<a href="showTaxCat.html?CatId=<?php echo $catId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<?php $qual = array_key_exists($catId,$qualifiers) ? $qualifiers[$catId] : null; ?>
<?php if (!Tax::isValid($qual)): ?>
<td class="taxon invalid">
<?php else: ?>
<td class="taxon">
<?php endif; ?>
<?php htmlOut($name); ?>
<?php if (!Tax::isValid($qual)) echo "<span class=\"qual\">(Qualifier: ".Tax::_getQualifierText($qual).")</span>"; ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<table class="tax">
<tr>
<td>
No entries
</td>
</tr>
</table>
<?php endif; ?>