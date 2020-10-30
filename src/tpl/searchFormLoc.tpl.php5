<form action="searchLoc.html" method="get">
<input id="searchLocGeoActive" class="searchActive" name="searchGeoActive" type="hidden" value="true" />
<input id="searchLocStratActive" class="searchActive" name="searchStratActive" type="hidden" value="false" />
<?php //<input id="searchMorphActive" class="searchActive" name="searchMorphActive" type="hidden" value="false" /> ?>
<input id="searchLocNoActive" class="searchActive" name="searchLocNoActive" type="hidden" value="false" />

<div id="searchLocGeo" class="group">
<h3><div class="status"></div>Geography</h3>
<table cellspacing="0" cellpadding="0">
<tr id="geo1">
<td class="type">

<select id="geoType1" name="Type1" class="type">
<option value="3" selected="selected">Country</option>
<option value="2">Province</option>
<option value="1">Location</option>
<option value="0">Layer</option>
</select>

</td>

<td class="name">

<input id="geoName1" name="Geo1" class="name" type="text" />

<div class="tip">Type first letters to display selection list</div>

</td>
</tr>

<tr id="geo2">
<td>

<select id="geoType2" name="Type2" class="type">
<option value="-1" selected="selected"></option>
<option value="3">Country</option>
<option value="2">Province</option>
<option value="1">Location</option>
<option value="0">Layer</option>
</select>

</td>
<td>
<input id="geoName2" name="Geo2" class="name" type="text" disabled="disabled" />
</td>
</tr>
<tr id="geo3" style="display:none">
<td>
<select id="geoType3" name="Type3" class="type">
<option value="-1" selected="selected"></option>
<option value="3">Country</option>
<option value="2">Province</option>
<option value="1">Location</option>
<option value="0">Layer</option>
</select>
</td>
<td>
<input id="geoName3" name="Geo3" class="name" type="text" disabled="disabled" />
</td>
</tr>
</table>
</div>

<div id="searchLocStrat" class="group collapsed">
<h3><div class="status"></div>Stratigraphy</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="label">
Lower Boundary:
</td>
<td>
<input id="loBoundLoc" name="LoBound" type="text" />
<div class="tip">Million years or name. Type for selection list</div>
</td>
</tr>
<tr>
<td class="label">
Upper Boundary:
</td>
<td>
<input id="upBoundLoc" name="UpBound" type="text" />
<div class="tip">Million years or name. Type for selection list</div>
</td>
</tr>
</table>
</div>

<div id="searchLocNo" class="group collapsed exclusive">
<h3><div class="status"></div>LocNo</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="label">
LocNo:
</td>
<td>
<input name="LocNo" type="text" />
</td>
</tr>
</table>
</div>
<div class="submit">
	<button class="submit" type="submit">Start Search</button>
</div>
</form>
