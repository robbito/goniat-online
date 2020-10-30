<!DOCTYPE html>
<html>
<head>
<title>GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/accountSettings.js"></script>
</head>
<body>
<div class="main" id="main">

<?php require 'tpl/header.tpl.php5'; ?>
<input id="helpLink" type="hidden" value ="account_settings.html" />
</script>
<?php require 'tpl/toolbar.tpl.php5'; ?>

<div id="tabBoxLow" class="tabs">
	<ul>
		<li id="editAccountTab"><a href="#accountPanel">My account</a></li>
	</ul>
	<div id="accountPanel">
		<form id="editAccount">
			<fieldset>
				<input type="hidden" name="accountId" id="accountId" value="<?php echo $account->AccountId; ?>" />
				<label for="user">User name:</label>
				<input type="text" name="user" id="user" value="<?php echo $account->User; ?>" /><br />
				<label for="email">E-mail:</label>
				<input type="text" name="email" id="email" value="<?php echo $account->Email; ?>" /><br />
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" value="**unchanged**" /><br />
				<label>Permission:</label>
				<?php echo $account->getPermString(); ?>
				<br />
				<button type="button" class="save">Save</button>
			</fieldset>
		</form>
	</div>
</div>

</div>
</body>
</html>