<?php if (count($geos)): ?>
<table class="loc" cellspacing="0" cellpadding="0">
<tr>
<th>&nbsp;</th>
<th>Locality</th>
<th>Layer</th>
</tr>
<?php foreach ($geos as $name => $geoId): ?>
<tr>
<td class="link">
<a href="showLocGeo.html?GeoId=<?php echo $geoId; ?>">
<img title="View Details" src="img/link.png" />
</a>
</td>
<td class="locality">
<?php htmlOut(Geo::getLocalityString($name)); ?>
</td>
<td class="layer">
<?php htmlOut(Geo::getLayerString($name)); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<table class="loc">
<tr>
<td>
No entries
</td>
</tr>
</table>
<?php endif; ?>