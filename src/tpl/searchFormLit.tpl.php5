<form action="searchLit.html" method="get">
<input id="searchAutActive" class="searchActive" name="searchAutActive" type="hidden" value="true" />
<input id="searchTitleActive" class="searchActive" name="searchTitleActive" type="hidden" value="false" />
<input id="searchKeyActive" class="searchActive" name="searchKeyActive" type="hidden" value="false" />
<input id="searchLitNoActive" class="searchActive" name="searchLitNoActive" type="hidden" value="false" />

<div id="searchAut" class="group">
<h3><div class="status"></div>Authors</h3>
<input id="author1id" class="authorid" name="Author1Id" type="hidden" value="" />
<input id="author2id" class="authorid" name="Author2Id" type="hidden" value="" />
<table cellspacing="0" cellpadding="0">
<tr id="aut1">
<td class="label">
Name:
</td>
<td class="author">

<input id="author1" name="Author1" class="author" type="text" />

<div class="tip">Type first letters to display selection list</div>

</td>
</tr>

<tr id="aut2">
<td class="label">
Name:
</td>
<td>
<input id="author2" name="Author2" class="author" type="text" disabled="disabled" />
</td>
</tr>

<tr>
<td class="label">
Year:
</td>
<td>
<input id="year" name="Year" class="year" type="text" />
</td>
</tr>

</table>
</div>

<div id="searchTitle" class="group collapsed">
<h3><div class="status"></div>Title</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="label">
Title:
</td>
<td>
<input id="title" name="Title" type="text" />
</td>
</tr>
</table>
</div>

<div id="searchKey" class="group collapsed">
<h3><div class="status"></div>Keywords</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="label">
Keywords:
</td>
<td>
<input id="keywords" name="Keywords" type="text" />
<div class="tip">Separate keywords with semicolon</div>
</td>
</tr>
</table>
</div>

<div id="searchLitNo" class="group collapsed exclusive">
<h3><div class="status"></div>LitNo</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<td class="label">
LitNo:
</td>
<td>
<input name="LitNo" type="text" />
</td>
</tr>
</table>
</div>
<div class="submit">
	<button class="submit" type="submit">Start Search</button>
</div>
</form>
