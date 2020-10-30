<div class="notes">
<?php if ($editable && Page::isEditor()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="notesEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>
	<div class="content">
<?php echo $notes; ?>
	</div>
</div>