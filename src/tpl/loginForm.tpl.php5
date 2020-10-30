<?php if (Page::isLoggedIn()): ?>
<form id="logout">
	<span>You are logged in as</span>
	<span class="user"><?php echo Page::getAccount()->User; ?></span>
	<button id="doMenu" class="submit">Menu <img src="img/menu.png" /></button>
	<ul id="accountMenu">
		<li><a href="accountSettings.html">Account settings...</a></li>
<?php if (Page::isAdmin()): ?>
		<li><a href="manageUsers.html">Manage users...</a></li>
		<li><a href="showLog.html">View log...</a></li>
<?php endif; ?>
		<li><a href="logout.html">Logout</a></li>
	</ul>
</form>
<?php else: ?>
<form action="login.html" method="post">
	<label>User name</label>
	<input type="text" name="loginId"<?php if (isset($_SESSION['loginId'])) echo ' value="'.$_SESSION['loginId'].'"'; ?> /><br />
	<label>Password</label>
	<input type="password" name="loginPw"<?php if (isset($_SESSION['loginPw'])) echo ' value="'.$_SESSION['loginPw'].'"'; ?> /><br />
	<button class="submit" type="submit">Login</button>
<?php if (!is_null(Page::getError())): ?>
	<span class="errorMsg"><?php echo Page::getError(); ?></span>
<?php endif; ?>
</form>
<?php endif; ?>
