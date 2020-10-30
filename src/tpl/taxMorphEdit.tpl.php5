<?php if (Page::isEditor() && $tax->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
			<button id="morphCancel" type="button">Cancel</button>
			<button id="morphSave" type="button">Save</button>
		</div>
	</div>
<?php endif; ?>

<form id="taxMorphForm">
<table class="features" cellspacing="0" cellpadding="0">
<tr>
<td colspan="12" class="featGroup">A Conch Form</td>
</tr>
<tr>

<td class="featLabel">Max. diameter:</td>
<td class="featValue">
	<input name="A21" type="text" value="<?php echo($tax->getFeature('A21',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Diameter:</td>
<td class="featValue">
	<input name="A23" type="text" value="<?php echo($tax->getFeature('A23',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Whorl width:</td>
<td class="featValue">
	<input name="A24" type="text" value="<?php echo($tax->getFeature('A24',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Whorl height:</td>
<td class="featValue">
	<input name="A25" type="text" value="<?php echo($tax->getFeature('A25',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

</tr>
<tr>

<td class="featLabel">Umbilicus:</td>
<td class="featValue">
	<input name="A26" type="text" value="<?php echo($tax->getFeature('A26',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Aperture height:</td>
<td class="featValue">
	<input name="A27" type="text" value="<?php echo($tax->getFeature('A27',0)); ?>"></input>
</td>

<td class="featFill" colspan="7">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">General:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="A22-1" type="text" value="<?php echo($tax->getFeature('A22',1)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td class="empty">
&nbsp;
</td>
<td>
	<input name="A22-0" type="text" value="<?php echo($tax->getFeature('A22',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Aperturally:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="A29-1" type="text" value="<?php echo($tax->getFeature('A29',1)); ?>"></input>
</td>
<td>
	<input name="A29-2" type="text" value="<?php echo($tax->getFeature('A29',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="A29-0" type="text" value="<?php echo($tax->getFeature('A29',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Outline of venter:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="A30-1" type="text" value="<?php echo($tax->getFeature('A30',1)); ?>"></input>
</td>
<td>
	<input name="A30-2" type="text" value="<?php echo($tax->getFeature('A30',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="A30-0" type="text" value="<?php echo($tax->getFeature('A30',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Special form of v.:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="A31-1" type="text" value="<?php echo($tax->getFeature('A31',1)); ?>"></input>
</td>
<td>
	<input name="A31-2" type="text" value="<?php echo($tax->getFeature('A31',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="A31-0" type="text" value="<?php echo($tax->getFeature('A31',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

</tr>
<tr>

<td class="featLabel">Flanks:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="A32-1" type="text" value="<?php echo($tax->getFeature('A32',1)); ?>"></input>
</td>
<td>
	<input name="A32-2" type="text" value="<?php echo($tax->getFeature('A32',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="A32-0" type="text" value="<?php echo($tax->getFeature('A32',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Umbilical width:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="A33-1" type="text" value="<?php echo($tax->getFeature('A33',1)); ?>"></input>
</td>
<td>
	<input name="A33-2" type="text" value="<?php echo($tax->getFeature('A33',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="A33-0" type="text" value="<?php echo($tax->getFeature('A33',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Umbilical edge:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="A34-1" type="text" value="<?php echo($tax->getFeature('A34',1)); ?>"></input>
</td>
<td>
	<input name="A34-2" type="text" value="<?php echo($tax->getFeature('A34',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="A34-0" type="text" value="<?php echo($tax->getFeature('A34',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featFill" colspan="4">&nbsp;</td>

</tr>

<tr>
<td colspan="12" class="featGroup">B Growth Lines</td>
</tr>
<tr>

<td class="featLabel">Pattern:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="B35-1" type="text" value="<?php echo($tax->getFeature('B35',1)); ?>"></input>
</td>
<td>
	<input name="B35-2" type="text" value="<?php echo($tax->getFeature('B35',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="B35-0" type="text" value="<?php echo($tax->getFeature('B35',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Direction:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="B36-1" type="text" value="<?php echo($tax->getFeature('B36',1)); ?>"></input>
</td>
<td>
	<input name="B36-2" type="text" value="<?php echo($tax->getFeature('B36',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="B36-0" type="text" value="<?php echo($tax->getFeature('B36',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Overall course:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="B37-1" type="text" value="<?php echo($tax->getFeature('B37',1)); ?>"></input>
</td>
<td>
	<input name="B37-2" type="text" value="<?php echo($tax->getFeature('B37',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="B37-0" type="text" value="<?php echo($tax->getFeature('B37',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Ventrolat. salient:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="B38-1" type="text" value="<?php echo($tax->getFeature('B38',1)); ?>"></input>
</td>
<td>
	<input name="B38-2" type="text" value="<?php echo($tax->getFeature('B38',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="B38-0" type="text" value="<?php echo($tax->getFeature('B38',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">Course on venter:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="B39-1" type="text" value="<?php echo($tax->getFeature('B39',1)); ?>"></input>
</td>
<td>
	<input name="B39-2" type="text" value="<?php echo($tax->getFeature('B39',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="B39-0" type="text" value="<?php echo($tax->getFeature('B39',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featFill" colspan="10">&nbsp;</td>

</tr>

<tr>
<td colspan="12" class="featGroup">C Ribs and Nodes</td>
</tr>
<tr>

<td class="featLabel">Ribs,Nodes/whorl:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td class="empty">
&nbsp;
</td>
<td class="empty">
&nbsp;
</td>
<td>
	<input name="C40-0" type="text" value="<?php echo($tax->getFeature('C40',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Form of ribs:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="C41-1" type="text" value="<?php echo($tax->getFeature('C41',1)); ?>"></input>
</td>
<td>
	<input name="C41-2" type="text" value="<?php echo($tax->getFeature('C41',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="C41-0" type="text" value="<?php echo($tax->getFeature('C41',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Pattern:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="C42-1" type="text" value="<?php echo($tax->getFeature('C42',1)); ?>"></input>
</td>
<td>
	<input name="C42-2" type="text" value="<?php echo($tax->getFeature('C42',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="C42-0" type="text" value="<?php echo($tax->getFeature('C42',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Position of ribs:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="C43-1" type="text" value="<?php echo($tax->getFeature('C43',1)); ?>"></input>
</td>
<td>
	<input name="C43-2" type="text" value="<?php echo($tax->getFeature('C43',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="C43-0" type="text" value="<?php echo($tax->getFeature('C43',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">Direction:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="C44-1" type="text" value="<?php echo($tax->getFeature('C44',1)); ?>"></input>
</td>
<td>
	<input name="C44-2" type="text" value="<?php echo($tax->getFeature('C44',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="C44-0" type="text" value="<?php echo($tax->getFeature('C44',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Course:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="C45-1" type="text" value="<?php echo($tax->getFeature('C45',1)); ?>"></input>
</td>
<td>
	<input name="C45-2" type="text" value="<?php echo($tax->getFeature('C45',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="C45-0" type="text" value="<?php echo($tax->getFeature('C45',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Form of nodes:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="C46-1" type="text" value="<?php echo($tax->getFeature('C46',1)); ?>"></input>
</td>
<td>
	<input name="C46-2" type="text" value="<?php echo($tax->getFeature('C46',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="C46-0" type="text" value="<?php echo($tax->getFeature('C46',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Position of nodes:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="C47-1" type="text" value="<?php echo($tax->getFeature('C47',1)); ?>"></input>
</td>
<td>
	<input name="C47-2" type="text" value="<?php echo($tax->getFeature('C47',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="C47-0" type="text" value="<?php echo($tax->getFeature('C47',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>
<td colspan="12" class="featGroup">D Constrictions</td>
</tr>

<tr>

<td class="featLabel">Constr./whorl:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td class="empty">
&nbsp;
</td>
<td class="empty">
&nbsp;
</td>
<td>
	<input name="D48-0" type="text" value="<?php echo($tax->getFeature('D48',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Form:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="D49-1" type="text" value="<?php echo($tax->getFeature('D49',1)); ?>"></input>
</td>
<td>
	<input name="D49-2" type="text" value="<?php echo($tax->getFeature('D49',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="D49-0" type="text" value="<?php echo($tax->getFeature('D49',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Pattern:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="D50-1" type="text" value="<?php echo($tax->getFeature('D50',1)); ?>"></input>
</td>
<td>
	<input name="D50-2" type="text" value="<?php echo($tax->getFeature('D50',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="D50-0" type="text" value="<?php echo($tax->getFeature('D50',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Position:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="D51-1" type="text" value="<?php echo($tax->getFeature('D51',1)); ?>"></input>
</td>
<td>
	<input name="D51-2" type="text" value="<?php echo($tax->getFeature('D51',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="D51-0" type="text" value="<?php echo($tax->getFeature('D51',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>
<td colspan="12" class="featGroup">E Grooves</td>
</tr>
<tr>

<td class="featLabel">Number:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="E52-1" type="text" value="<?php echo($tax->getFeature('E52',1)); ?>"></input>
</td>
<td>
	<input name="E52-2" type="text" value="<?php echo($tax->getFeature('E52',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="E52-0" type="text" value="<?php echo($tax->getFeature('E52',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featFill" colspan="10">&nbsp;</td>

</tr>

<tr>
<td colspan="12" class="featGroup">F Spirals</td>
</tr>
<tr>

<td class="featLabel">Number:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td class="empty">
&nbsp;
</td>
<td class="empty">
&nbsp;
</td>
<td>
	<input name="F53-0" type="text" value="<?php echo($tax->getFeature('F53',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Form:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="F54-1" type="text" value="<?php echo($tax->getFeature('F54',1)); ?>"></input>
</td>
<td>
	<input name="F54-2" type="text" value="<?php echo($tax->getFeature('F54',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="F54-0" type="text" value="<?php echo($tax->getFeature('F54',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Strength:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="F55-1" type="text" value="<?php echo($tax->getFeature('F55',1)); ?>"></input>
</td>
<td>
	<input name="F55-2" type="text" value="<?php echo($tax->getFeature('F55',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="F55-0" type="text" value="<?php echo($tax->getFeature('F55',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Position:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<?php if ($tax->hasMorphB()): ?>
<td>
	<input name="F56-1" type="text" value="<?php echo($tax->getFeature('F56',1)); ?>"></input>
</td>
<td>
	<input name="F56-2" type="text" value="<?php echo($tax->getFeature('F56',2)); ?>"></input>
</td>
<?php else: ?>
<td class="emptyB">
	&nbsp;
</td>
<td class="emptyB">
	&nbsp;
</td>
<?php endif; ?>
<td>
	<input name="F56-0" type="text" value="<?php echo($tax->getFeature('F56',0)); ?>"></input>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>
<td colspan="12" class="featGroup">G Suture</td>
</tr>
<tr>

<td colspan="12">

<table class="featuresInner" cellspacing="0" cellpadding="0">
<tr>
<td class="featLabel">(1) Ventral  lobe:</td>
<td class="featValue featCompl">
	<input name="G57-0" type="text" value="<?php echo($tax->getFeature('G57',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If simple:</td>
<td class="featValue featCompl">
	<input name="G58-0" type="text" value="<?php echo($tax->getFeature('G58',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If div., height of median saddle:</td>
<td class="featValue featCompl">
	<input name="G59-0" type="text" value="<?php echo($tax->getFeature('G59',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>
</tr>

<tr>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Form of ventral lobe:</td>
<td class="featValue featCompl">
	<input name="G60-0" type="text" value="<?php echo($tax->getFeature('G60',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Form of ventral prong:</td>
<td class="featValue featCompl">
	<input name="G61-0" type="text" value="<?php echo($tax->getFeature('G61',0)); ?>"></input>
</td>

<td class="featFill" colspan="4">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">(2) Ventrolateral saddle:</td>
<td class="featValue featCompl">
	<input name="G62-0" type="text" value="<?php echo($tax->getFeature('G62',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Outline:</td>
<td class="featValue featCompl">
	<input name="G63-0" type="text" value="<?php echo($tax->getFeature('G63',0)); ?>"></input>
</td>

<td class="featFill" colspan="4">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">(3) First lateral lobe:</td>
<td class="featValue featCompl">
	<input name="G64-0" type="text" value="<?php echo($tax->getFeature('G64',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Outline:</td>
<td class="featValue featCompl">
	<input name="G65-0" type="text" value="<?php echo($tax->getFeature('G65',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Width v. lobe/Width 1st lat. lobe:</td>
<td class="featValue featCompl">
	<input name="G66-0" type="text" value="<?php echo($tax->getFeature('G66',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">(4) Following saddles:</td>
<td class="featValue featCompl">
	<input name="G67-0" type="text" value="<?php echo($tax->getFeature('G67',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">(5) Add. lobes on flanks:</td>
<td class="featValue featCompl">
	<input name="G68-0" type="text" value="<?php echo($tax->getFeature('G68',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">(6) Number of add. lobes:</td>
<td class="featValue featCompl">
	<input name="G69-0" type="text" value="<?php echo($tax->getFeature('G69',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">(7) Form of dorsal lobe:</td>
<td class="featValue featCompl">
	<input name="G70-0" type="text" value="<?php echo($tax->getFeature('G70',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Sutural elements:</td>
<td colspan="4" class="featValue featValueLong">
	<input name="G71" type="text" value="<?php echo($tax->getFeature('G71',0)); ?>"></input>
</td>

<td class="featGap">&nbsp;</td>

</tr>

</table>

</td>

</tr>

</table>
</form>