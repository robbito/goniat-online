<?php if ($editable && Page::isEditor()): ?>
<div class="figEditContainer">
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="figAdd" type="button">Upload Images</button>
		</div>
	</div>
	<span class="recCount">(<?php echo count($figs); ?>)</span>
<?php endif; ?>
<?php if (count($figs)): ?>
<div class="table">
<?php foreach ($figs as $fig): ?>
<table class="fig" cellspacing="0" cellpadding="0">
<tr>
<td class="img">
<img src="fig/<?php echo $fig; ?>"></img>
</td>
</tr>
<tr>
<td class="caption">
<div class="zoom">
	<a target="_blank" href="showLocFig.html?Fig=<?php echo $fig; ?>">
	<img style="height:12px;margin-top:2px;" title="Zoom" src="img/link-small.png"></img></a>
<?php if ($editable && Page::isEditor()): ?>
	<a class="figDelete" id="<?php echo $fig; ?>">
	<img title="Delete Image" src="img/delete.png" /></a>
<?php endif; ?>
</div>
<?php echo $fig; ?>
</td>
</tr>
</table>
<?php endforeach; ?>
</div>
<?php else: ?>
<table class="fig">
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