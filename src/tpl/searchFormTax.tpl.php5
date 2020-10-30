<form action="searchTax.html" method="get">
<input id="searchTaxCatActive" class="searchActive" name="searchCatActive" type="hidden" value="true" />
<input id="searchTaxStratActive" class="searchActive" name="searchStratActive" type="hidden" value="false" />
<?php //<input id="searchMorphActive" class="searchActive" name="searchMorphActive" type="hidden" value="false" /> ?>
<input id="searchTaxNoActive" class="searchActive" name="searchTaxNoActive" type="hidden" value="false" />

<div id="searchTaxCat" class="group">
<h3><div class="status"></div>Taxonomy</h3>
<table cellspacing="0" cellpadding="0">
<tr id="tax1">
<td class="type">

<select id="taxType1" name="Type1" class="type">
<option value="7">Suborder</option>
<option value="6">Superfamily</option>
<option value="5">Family</option>
<option value="4">Subfamily</option>
<option value="3" selected="selected">Genus</option>
<option value="2">Subgenus</option>
<option value="1">Nomspecies</option>
<option value="0">Species</option>
</select>

</td>

<td class="name">

<input id="taxName1" name="Taxon1" class="name" type="text" />

<div class="tip">Type first letters to display selection list</div>

</td>
</tr>

<tr id="tax2">
<td>

<select id="taxType2" name="Type2" class="type">
<option value="-1" selected="selected"></option>
<option value="7">Suborder</option>
<option value="6">Superfamily</option>
<option value="5">Family</option>
<option value="4">Subfamily</option>
<option value="3">Genus</option>
<option value="2">Subgenus</option>
<option value="1">Nomspecies</option>
<option value="0">Species</option>
</select>

</td>
<td>
<input id="taxName2" name="Taxon2" class="name" type="text" disabled="disabled" />
<div class="tip">Type or press down for selection list</div>
</td>
</tr>
<tr id="tax3" style="display:none">
<td>
<select id="taxType3" name="Type3" class="type">
<option value="-1" selected="selected"></option>
<option value="7">Suborder</option>
<option value="6">Superfamily</option>
<option value="5">Family</option>
<option value="4">Subfamily</option>
<option value="3">Genus</option>
<option value="2">Subgenus</option>
<option value="1">Nomspecies</option>
<option value="0">Species</option>
</select>
</td>
<td>
<input id="taxName3" name="Taxon3" class="name" type="text" disabled="disabled" />
<div class="tip">Type or press down for selection list</div>
</td>
</tr>
</table>
</div>

<div id="searchTaxStrat" class="group collapsed">
<h3><div class="status"></div>Stratigraphy</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="label">
Lower Boundary:
</td>
<td>
<input id="loBoundTax" name="LoBound" type="text" />
<div class="tip">Million years or name. Type for selection list</div>
</td>
</tr>
<tr>
<td class="label">
Upper Boundary:
</td>
<td>
<input id="upBoundTax" name="UpBound" type="text" />
<div class="tip">Million years or name. Type for selection list</div>
</td>
</tr>
</table>
</div>

<?php
//<div id="searchMorph" class="group collapsed">
//<h3><div class="status"></div>Morphology</h3>
//</div>
?>

<div id="searchTaxNo" class="group collapsed exclusive">
<h3><div class="status"></div>TaxNo</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="label">
TaxNo:
</td>
<td>
<input name="TaxNo" type="text" />
</td>
</tr>
</table>
</div>
<div class="submit">
	<button class="submit" type="submit">Start Search</button>
</div>
</form>
