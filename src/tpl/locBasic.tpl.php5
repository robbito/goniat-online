<?php if (Page::isEditor() && $loc->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicRemoveDetails" type="button">Remove Locality Details</button>
			<button id="basicEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>
<table class="record-content" cellspacing="0" cellpadding="0">
<?php foreach ($geography as $geo): ?>
<tr id="name">
<td class="label">
<?php htmlOut($geo->getTypeText()); ?>:
</td>
<td class="value">
<?php htmlOut($geo->Name); ?>
<?php if ($geo->GeoId != $loc->GeoId): ?>
<a href="showLocGeo.html?GeoId=<?php echo($geo->GeoId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
<tr id="lowBound">
<td class="label">
Lower Boundary:
</td>
<td class="value">
<?php if (isset($lowerBoundary)): ?>
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
<?php if (isset($upperBoundary)): ?>
<?php htmlOut($upperBoundary->Name); ?>, <?php htmlOut($upperBoundary->MillYears); ?> million years
<a href="showBnd.html?BndId=<?php echo($upperBoundary->BndId); ?>"><img title="View Details" src="img/link-small.png" /></a>
<?php endif; ?>
</td>
</tr>
<tr id="geoRef">
<td class="label">
Georeference:
</td>
<td class="value">
<?php htmlOut($loc->GeoRef); ?>
</td>
</tr>
</table>