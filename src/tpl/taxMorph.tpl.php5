<?php if (Page::isEditor() && $tax->isEditable()): ?>
	<div class="edit-toolbar">
		<div class="buttons">
<?php if ($tax->hasMorphB()): ?>
			<button id="morphRemoveYouth" type="button">Remove Youth Stages</button>
<?php else: ?>
			<button id="morphAddYouth" type="button">Add Youth Stages</button>
<?php endif; ?>
			<button id="morphEdit" type="button">Edit</button>
		</div>
	</div>
<?php endif; ?>

<table class="features" cellspacing="0" cellpadding="0">
<tr>
<td colspan="12" class="featGroup">A Conch Form</td>
</tr>
<tr>

<td class="featLabel">Max. diameter:</td>
<td class="featValue"><?php echo(getFeatureHTML($tax,'A21')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Diameter:</td>
<td class="featValue"><?php echo(getFeatureHTML($tax,'A23')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Whorl width:</td>
<td class="featValue"><?php echo(getFeatureHTML($tax,'A24')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Whorl height:</td>
<td class="featValue"><?php echo(getFeatureHTML($tax,'A25')); ?></td>

<td class="featGap">&nbsp;</td>

</tr>
<tr>

<td class="featLabel">Umbilicus:</td>
<td class="featValue"><?php echo(getFeatureHTML($tax,'A26')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Aperture height:</td>
<td class="featValue"><?php echo(getFeatureHTML($tax,'A27')); ?></td>

<td class="featFill" colspan="7">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">General:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'A22',1)); ?>>
<?php echo(getFeatureHTML($tax,'A22',1)); ?>
</td>
<td class="empty">
&nbsp;
</td>
<td<?php echo(getFeatureTitle($tax,'A22')); ?>>
<?php echo(getFeatureHTML($tax,'A22')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Aperturally:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'A29',1)); ?>>
<?php echo(getFeatureHTML($tax,'A29',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A29',2)); ?>>
<?php echo(getFeatureHTML($tax,'A29',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A29')); ?>>
<?php echo(getFeatureHTML($tax,'A29')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Outline of venter:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'A30',1)); ?>>
<?php echo(getFeatureHTML($tax,'A30',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A30',2)); ?>>
<?php echo(getFeatureHTML($tax,'A30',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A30')); ?>>
<?php echo(getFeatureHTML($tax,'A30')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Special form of v.:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'A31',1)); ?>>
<?php echo(getFeatureHTML($tax,'A31',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A31',2)); ?>>
<?php echo(getFeatureHTML($tax,'A31',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A31')); ?>>
<?php echo(getFeatureHTML($tax,'A31')); ?>
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
<td<?php echo(getFeatureTitle($tax,'A32',1)); ?>>
<?php echo(getFeatureHTML($tax,'A32',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A32',2)); ?>>
<?php echo(getFeatureHTML($tax,'A32',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A32')); ?>>
<?php echo(getFeatureHTML($tax,'A32')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Umbilical width:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'A33',1)); ?>>
<?php echo(getFeatureHTML($tax,'A33',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A33',2)); ?>>
<?php echo(getFeatureHTML($tax,'A33',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A33')); ?>>
<?php echo(getFeatureHTML($tax,'A33')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Umbilical edge:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'A34',1)); ?>>
<?php echo(getFeatureHTML($tax,'A34',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A34',2)); ?>>
<?php echo(getFeatureHTML($tax,'A34',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'A34')); ?>>
<?php echo(getFeatureHTML($tax,'A34')); ?>
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
<td<?php echo(getFeatureTitle($tax,'B35',1)); ?>>
<?php echo(getFeatureHTML($tax,'B35',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B35',2)); ?>>
<?php echo(getFeatureHTML($tax,'B35',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B35')); ?>>
<?php echo(getFeatureHTML($tax,'B35')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Direction:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'B36',1)); ?>>
<?php echo(getFeatureHTML($tax,'B36',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B36',2)); ?>>
<?php echo(getFeatureHTML($tax,'B36',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B36')); ?>>
<?php echo(getFeatureHTML($tax,'B36')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Overall course:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'B37',1)); ?>>
<?php echo(getFeatureHTML($tax,'B37',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B37',2)); ?>>
<?php echo(getFeatureHTML($tax,'B37',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B37')); ?>>
<?php echo(getFeatureHTML($tax,'B37')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Ventrolat. salient:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'B38',1)); ?>>
<?php echo(getFeatureHTML($tax,'B38',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B38',2)); ?>>
<?php echo(getFeatureHTML($tax,'B38',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B38')); ?>>
<?php echo(getFeatureHTML($tax,'B38')); ?>
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
<td<?php echo(getFeatureTitle($tax,'B39',1)); ?>>
<?php echo(getFeatureHTML($tax,'B39',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B39',2)); ?>>
<?php echo(getFeatureHTML($tax,'B39',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'B39')); ?>>
<?php echo(getFeatureHTML($tax,'B39')); ?>
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
<td<?php echo(getFeatureTitle($tax,'C40')); ?>>
<?php echo(getFeatureHTML($tax,'C40')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Form of ribs:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'C41',1)); ?>>
<?php echo(getFeatureHTML($tax,'C41',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C41',2)); ?>>
<?php echo(getFeatureHTML($tax,'C41',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C41')); ?>>
<?php echo(getFeatureHTML($tax,'C41')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Pattern:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'C42',1)); ?>>
<?php echo(getFeatureHTML($tax,'C42',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C42',2)); ?>>
<?php echo(getFeatureHTML($tax,'C42',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C42')); ?>>
<?php echo(getFeatureHTML($tax,'C42')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Position of ribs:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'C43',1)); ?>>
<?php echo(getFeatureHTML($tax,'C43',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C43',2)); ?>>
<?php echo(getFeatureHTML($tax,'C43',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C43')); ?>>
<?php echo(getFeatureHTML($tax,'C43')); ?>
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
<td<?php echo(getFeatureTitle($tax,'C44',1)); ?>>
<?php echo(getFeatureHTML($tax,'C44',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C44',2)); ?>>
<?php echo(getFeatureHTML($tax,'C44',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C44')); ?>>
<?php echo(getFeatureHTML($tax,'C44')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Course:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'C45',1)); ?>>
<?php echo(getFeatureHTML($tax,'C45',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C45',2)); ?>>
<?php echo(getFeatureHTML($tax,'C45',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C45')); ?>>
<?php echo(getFeatureHTML($tax,'C45')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Form of nodes:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'C46',1)); ?>>
<?php echo(getFeatureHTML($tax,'C46',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C46',2)); ?>>
<?php echo(getFeatureHTML($tax,'C46',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C46')); ?>>
<?php echo(getFeatureHTML($tax,'C46')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Position of nodes:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'C47',1)); ?>>
<?php echo(getFeatureHTML($tax,'C47',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C47',2)); ?>>
<?php echo(getFeatureHTML($tax,'C47',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'C47')); ?>>
<?php echo(getFeatureHTML($tax,'C47')); ?>
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
<td<?php echo(getFeatureTitle($tax,'D48')); ?>>
<?php echo(getFeatureHTML($tax,'D48')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Form:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'D49',1)); ?>>
<?php echo(getFeatureHTML($tax,'D49',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'D49',2)); ?>>
<?php echo(getFeatureHTML($tax,'D49',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'D49')); ?>>
<?php echo(getFeatureHTML($tax,'D49')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Pattern:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'D50',1)); ?>>
<?php echo(getFeatureHTML($tax,'D50',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'D50',2)); ?>>
<?php echo(getFeatureHTML($tax,'D50',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'D50')); ?>>
<?php echo(getFeatureHTML($tax,'D50')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Position:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'D51',1)); ?>>
<?php echo(getFeatureHTML($tax,'D51',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'D51',2)); ?>>
<?php echo(getFeatureHTML($tax,'D51',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'D51')); ?>>
<?php echo(getFeatureHTML($tax,'D51')); ?>
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
<td<?php echo(getFeatureTitle($tax,'E52',1)); ?>>
<?php echo(getFeatureHTML($tax,'E52',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'E52',2)); ?>>
<?php echo(getFeatureHTML($tax,'E52',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'E52')); ?>>
<?php echo(getFeatureHTML($tax,'E52')); ?>
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
<td<?php echo(getFeatureTitle($tax,'F53')); ?>>
<?php echo(getFeatureHTML($tax,'F53')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Form:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'F54',1)); ?>>
<?php echo(getFeatureHTML($tax,'F54',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'F54',2)); ?>>
<?php echo(getFeatureHTML($tax,'F54',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'F54')); ?>>
<?php echo(getFeatureHTML($tax,'F54')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Strength:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'F55',1)); ?>>
<?php echo(getFeatureHTML($tax,'F55',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'F55',2)); ?>>
<?php echo(getFeatureHTML($tax,'F55',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'F55')); ?>>
<?php echo(getFeatureHTML($tax,'F55')); ?>
</td>
</tr>
</table>
</td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Position:</td>
<td class="featValueMulti">
<table cellspacing="0" cellpadding="0">
<tr>
<td<?php echo(getFeatureTitle($tax,'F56',1)); ?>>
<?php echo(getFeatureHTML($tax,'F56',1)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'F56',2)); ?>>
<?php echo(getFeatureHTML($tax,'F56',2)); ?>
</td>
<td<?php echo(getFeatureTitle($tax,'F56')); ?>>
<?php echo(getFeatureHTML($tax,'F56')); ?>
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
<td class="featValue"<?php echo(getFeatureTitle($tax,'G57')); ?>><?php echo(getFeatureHTML($tax,'G57')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If simple:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G58')); ?>><?php echo(getFeatureHTML($tax,'G58')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;If div., height of median saddle:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G59')); ?>><?php echo(getFeatureHTML($tax,'G59')); ?></td>

<td class="featGap">&nbsp;</td>
</tr>

<tr>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Form of ventral lobe:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G60')); ?>><?php echo(getFeatureHTML($tax,'G60')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Form of ventral prong:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G61')); ?>><?php echo(getFeatureHTML($tax,'G61')); ?></td>

<td class="featFill" colspan="4">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">(2) Ventrolateral saddle:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G62')); ?>><?php echo(getFeatureHTML($tax,'G62')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Outline:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G63')); ?>><?php echo(getFeatureHTML($tax,'G63')); ?></td>

<td class="featFill" colspan="4">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">(3) First lateral lobe:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G64')); ?>><?php echo(getFeatureHTML($tax,'G64')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Outline:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G65')); ?>><?php echo(getFeatureHTML($tax,'G65')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Width v. lobe/Width 1st lat. lobe:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G66')); ?>><?php echo(getFeatureHTML($tax,'G66')); ?></td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">(4) Following saddles:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G67')); ?>><?php echo(getFeatureHTML($tax,'G67')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">(5) Add. lobes on flanks:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G68')); ?>><?php echo(getFeatureHTML($tax,'G68')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">(6) Number of add. lobes:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G69')); ?>><?php echo(getFeatureHTML($tax,'G69')); ?></td>

<td class="featGap">&nbsp;</td>

</tr>

<tr>

<td class="featLabel">(7) Form of dorsal lobe:</td>
<td class="featValue"<?php echo(getFeatureTitle($tax,'G70')); ?>><?php echo(getFeatureHTML($tax,'G70')); ?></td>

<td class="featGap">&nbsp;</td>

<td class="featLabel">Sutural elements:</td>
<td colspan="4" class="featValue featValueLong"><?php echo(getFeatureHTML($tax,'G71')); ?></td>

<td class="featGap">&nbsp;</td>

</tr>

</table>

</td>

</tr>

</table>