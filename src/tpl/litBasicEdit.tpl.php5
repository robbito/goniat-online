<?php if (Page::isEditor() && $lit->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="basicCancel" type="button">Cancel</button>
			<button id="basicSave" type="button">Save</button>
		</div>
	</div>
<?php endif; ?>
<form id="litBasicForm">
<table class="record-content" cellspacing="0" cellpadding="0">
<tr id="author1">
<td class="label">
1st Author:
</td>
<td class="value">
<input id="aut1Id" name="Author1Id" type="hidden" value="<?php if (isset($author1)) echo $author1->AutId; ?>" />
<input id="aut1Txt" class="short" name="Author1" type="text" value="<?php if (isset($author1)) echo $author1->getName(); ?>" />
</td>
</tr>
<tr id="author2">
<td class="label">
2nd Author:
</td>
<td class="value">
<input id="aut2Id" name="Author2Id" type="hidden" value="<?php if (isset($author2)) echo $author2->AutId; ?>" />
<input id="aut2Txt" class="short" name="Author2" type="text" value="<?php if (isset($author2)) echo $author2->getName(); ?>" />
</td>
</tr>
<tr id="author3">
<td class="label">
3rd Author:
</td>
<td class="value">
<input id="aut3Id" name="Author3Id" type="hidden" value="<?php if (isset($author3)) echo $author3->AutId; ?>" />
<input id="aut3Txt" class="short" name="Author3" type="text" value="<?php if (isset($author3)) echo $author3->getName(); ?>" />
</td>
</tr>

<tr id="year">
<td class="label">
Year:
</td>
<td class="value">
<input class="veryshort" id="year" name="Year" type="text" value="<?php htmlOut($lit->Year); ?>" />
</td>
</tr>

<tr id="title">
<td class="label">
Title:
</td>
<td class="value">
	<textarea id="title" rows="2" name="Title"><?php echo $lit->Title; ?></textarea>
</td>
</tr>

<tr id="reference">
<td class="label">
Reference:
</td>
<td class="value">
	<textarea id="reference" rows="2" name="Reference"><?php echo $lit->Reference; ?></textarea>
</td>
</tr>

<tr id="keywords">
<td class="label">
Keywords:
</td>
<td class="value">
<input id="keywords" name="Keywords" type="text" value="<?php echo $lit->Short; ?>" />
</td>
</tr>

<tr id="url">
<td class="label">
Link:
</td>
<td class="value">
<input id="url" name="Url" type="text" value="<?php echo $lit->Url; ?>" />
</td>
</tr>

</table>
</form>