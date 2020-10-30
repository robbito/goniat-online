<?php if ($editable && Page::isEditor()): ?>
<div class="editContainer">
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="taxAdd" type="button">Add Link</button>
		</div>
	</div>
	<span class="recCount">(<?php echo count($taxa); ?>)</span>
<?php endif; ?>
<?php if (count($taxa)): ?>
<table class="tax" cellspacing="0" cellpadding="0">
<tr>
<th>&nbsp;</th>
<th>Taxon</th>
</tr>
<?php foreach ($taxa as $name => $tax): ?>
<tr>
<td class="link">
<a href="showTax.html?TaxId=<?php if (!is_null($tax)) echo $tax->TaxId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<?php if (!is_null($tax) && !Tax::isValid($tax->Qualifier)): ?>
<td class="taxon invalid">
<?php else: ?>
<td class="taxon">
<?php endif; ?>
<?php htmlOut($name); ?>
<?php if (!is_null($tax) && !Tax::isValid($tax->Qualifier)) echo "<span class=\"qual\">(Qualifier: ".Tax::_getQualifierText($tax->Qualifier).")</span>"; ?>
<?php if ($editable && Page::isEditor()): ?>
<div class="tools" data-id="<?php if (!is_null($tax)) echo $tax->TaxId; ?>">
<button class="taxDelete">Delete Link</button>
</div>
<?php endif; ?>
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
<?php if ($editable && Page::isEditor()): ?>
</div>
<?php endif; ?>