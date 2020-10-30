<?php

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockExcept(array("accountSettings"));

	// Check permission of current user
	if (!Page::isLoggedIn())
		sendResponse("error","Invalid operation");
	
	$accountId = Page::getString('accountId');
	$user = Page::getString('user');
	$password = Page::getString('password');
	$email = Page::getString('email');

	if (!isset($user) || strlen($user) < 3 || strlen($user) > 40)
		sendResponse("error","<b>User name</b> must be between 3 and 40 characters");

	if (!isset($password) || strlen($password) < 5 || strlen($password) > 40)
		sendResponse("error","<b>Password</b> must be between 5 and 40 characters");
	
	if ($accountId == '' || $accountId != Page::getAccount()->AccountId)
		sendResponse("error","Inbalid operation");
	
	if ($email == '' || filter_var($email, FILTER_VALIDATE_EMAIL) == false)
			sendResponse("error","<b>email address</b> is invalid");
	
	// Edit existing record
	$account = Page::getAccount();
	$userChanged = false;
	
	if ($account->User != $user)
		$userChanged = true;
	$account->User = $user;
	$account->Email = $email;
	if ($password != "**unchanged**")
		$account->setPassword($password);
	$account->save();
	sendResponse("success","The account was sucessfully updated", $userChanged ? "accountSettings" : null);
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>