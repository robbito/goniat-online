	<table class="acc">
		<thead>
			<tr>
				<th>User name</th>
				<th>E-mail</th>
				<th>Creation date</th>
				<th>Last login date</th>
				<th>Permission</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
<?php foreach ($accounts as $account): ?>
			<tr>
				<td><?php echo $account->User; ?></td>
				<td><?php echo $account->Email; ?></td>
				<td><?php echo $account->Created; ?></td>
				<td><?php echo $account->LastLogin; ?></td>
				<td><?php echo $account->GetPermString(); ?></td>
				<td><?php echo $account->GetStatusString(); ?></td>
				<td id="<?php echo $account->AccountId; ?>">
					<button class="edit">Edit</button>
<?php if (Page::getAccount()->AccountId != $account->AccountId): ?>
<?php if ($account->Status == 0): ?>
					<button class="deact">Deactivate</button>
<?php else: ?>
					<button class="act">Activate</button>
<?php endif; ?>
					<button class="del">Delete</button>
<?php endif; ?>
				</td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
