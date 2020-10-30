<!DOCTYPE html>
<html>
<head>
<title>GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/manageUsers.js"></script>
</head>
<body>
<div class="main" id="main">

<?php require 'tpl/header.tpl.php5'; ?>
<input id="helpLink" type="hidden" value ="manage_users.html" />
</script>
<?php require 'tpl/toolbar.tpl.php5'; ?>

<div id="tabBoxLow" class="tabs">
	<ul>
		<li id="usersTab"><a href="accounts.html">All users</a></li>
		<li id="createAccountTab"><a href="#accountPanel">Create account</a></li>
	</ul>
	<div id="accountPanel">
		<form id="createAccount">
			<fieldset>
				<input type="hidden" name="accountId" id="accountId" value="" />
				<label for="user">User name:</label>
				<input type="text" name="user" id="user" value="" /><br />
				<label for="email">E-mail:</label>
				<input type="text" name="email" id="email" value="" /><br />
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" value="" /><br />
				<label for="perm">Permission:</label>
				<select name="perm" id="perm">
					<option value="0">Administrator</option>
					<option value="1">Editor</option>
					<option value="2">Commentor</option>
				</select><br />
				<label for="status" id="status">Status:</label>
				<select name="status">
					<option value="0">Active</option>
					<option value="1">Inactive</option>
				</select><br />
				<button type="button" class="save">Save</button>
				<button type="button" class="reset">Reset form</button>
			</fieldset>
		</form>
	</div>
</div>

</div>
</body>
</html>