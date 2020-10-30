<?php if (count($hist)): ?>
<table class="log" cellspacing="0" cellpadding="0">
<tr>
<th>Date</th>
<th>Type</th>
<th>User</th>
<?php if (isset($showTable) && $showTable === true): ?>
<th>Table</th>
<?php endif; ?>
<th>&nbsp;</th>
</tr>
<?php foreach ($hist as $log): ?>
<tr>
<td class="timestamp">
<?php htmlOut($log->getTimestampString()); ?>
</td>
<td class="type">
<?php htmlOut($log->getTypeString()); ?>
</td>
<td class="user">
<?php echo $log->getUserName(); ?>
</td>
<?php if (isset($showTable) && $showTable === true): ?>
<td class="table">
<?php echo $log->getTableInfo(); ?>
</td>
<?php endif; ?>
<td class="link">
<?php if ($log->isRecord() && $log->OtherId != ''): ?>
<a href="show<?php echo $log->OtherClass; ?>.html?<?php echo $log->OtherClass; ?>Id=<?php echo $log->OtherId; ?>">
<img title="View Previous Version" src="img/link.png" />
</a>
<?php elseif ($log->isRelation()): ?>
<?php if ($log->RecordId !== $recordId): ?>
<a href="show<?php echo $log->RecordClass; ?>.html?<?php echo $log->RecordClass; ?>Id=<?php echo $log->RecordId; ?>">
<img title="View Related Record" src="img/link.png" />
</a>
<?php endif; ?>
<?php if ($log->OtherId !== $recordId): ?>
<a href="show<?php echo $log->OtherClass; ?>.html?<?php echo $log->OtherClass; ?>Id=<?php echo $log->OtherId; ?>">
<img title="View Related Record" src="img/link.png" />
</a>
<?php endif; ?>
<?php elseif ($log->isImage()): ?>
<a  target="_blank" href="show<?php echo $log->RecordClass; ?>Fig.html?Fig=<?php echo $log->OtherId; if ($log->OtherClass == "Arc") echo "&Archive=true";?>">
<img title="View Image" src="img/link.png" />
</a>
<?php endif; ?>
<?php if (Page::isAdmin()): ?>
<a class="logDelete" id="<?php echo $log->LogId; ?>">
<img title="Delete log entry" src="img/delete.png" />
</a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<table class="lit Empty">
<tr>
<td>
No entries
</td>
</tr>
</table>
<?php endif; ?>