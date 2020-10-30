<?php

require 'inc/gon.inc.php5';

try {
	Page::init(false);
	Page::blockExcept(array("manageUsers"));

	// Check permission of current user
	if (!Page::isAdmin())
		sendResponse("error","Invalid operation");
	
	$accountId = Page::getString('accountId');
	$user = Page::getString('user');
	$password = Page::getString('password');
	$email = Page::getString('email');
	$perm = Page::getInt('perm');
	$status = Page::getInt('status');

	if (!isset($user) || strlen($user) < 3 || strlen($user) > 40)
		sendResponse("error","<b>User name</b> must be between 3 and 40 characters");

	if (!isset($password) || strlen($password) < 5 || strlen($password) > 40)
		sendResponse("error","<b>Password</b> must be between 5 and 40 characters");
	
	if ($accountId == '') {
		$account = Account::loadActiveFromUser($user);
		if (isset($account))
			sendResponse("error","<b>User name</b> already exists in database");
		if ($password == "**unchanged**")
			sendResponse("error","Invalid password");
	}
	
	if ($email == '' || filter_var($email, FILTER_VALIDATE_EMAIL) == false)
			sendResponse("error","<b>email address</b> is invalid");
	
	if ($perm < 0 || $perm > 2)
		sendResponse("error","Invalid permission");

	if ($status < 0 || $status > 1)
		sendResponse("error","Invalid status");
	
	if ($accountId == '') {
		// New record
		$account = Account::create();
		$account->User = $user;
		$account->Email = $email;
		$account->setPassword($password);
		$account->Perm = $perm;
		$account->Status = $status;
		$account->save();
		sendResponse("success","The account was sucessfully created");
	}
	else {
		// Edit existing record
		$account = Account::loadFromAccountId($accountId);

		if (!isset($account))
			sendResponse("error","This user doesn't exist anymore");

		$account->User = $user;
		$account->Email = $email;
		if ($password != "**unchanged**")
			$account->setPassword($password);
		if ($accountId == Page::getAccount()->AccountId) {
			if (Page::getAccount()->Perm != $perm)
				sendResponse("error","Cannot change own permission");
		}
		else
			$account->Perm = $perm;
		if ($accountId == Page::getAccount()->AccountId) {
			if (Page::getAccount()->Status != $status)
				sendResponse("error","Cannot change own status");
		}
		else
			$account->Status = $status;
		$account->save();
		sendResponse("success","The account was sucessfully updated");
	}
}
catch (GonException $e) {
	sendResponse("error",$e->getCompleteMessage());
}

?>