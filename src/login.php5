<?php

require 'inc/gon.inc.php5';

try {
	Page::init();
	Page::blockDirect();

	$loginId = Page::postString('loginId');
	$loginPw = Page::postString('loginPw');

	if (!isset($loginId) || strlen($loginId) > 40)
		throw new GonInvalidArgumentException(array('LoginId' => $loginId));

	if (!isset($loginPw) || strlen($loginPw) > 40) {
		throw new GonInvalidArgumentException(array('LoginPw' => $loginPw));
	}

	$account = Account::loadActiveFromUser($loginId);
	// Account not valid or password not correct.
	if (is_null($account) || !$account->checkPassword($loginPw)) {
		$_SESSION['Error'] = "Invalid login data.";
		$_SESSION['loginId'] = $loginId;
		$_SESSION['loginPw'] = $loginPw;
		Page::redirect();
	}
	// Check account status
	switch ($account->Status){
		case 0:
			$account->setCurrentAccount();
			unset($_SESSION['loginId']);
			unset($_SESSION['loginPw']);
			Page::redirect();
		default:
			$_SESSION['Error'] = "Invalid login data.";
			$_SESSION['loginId'] = $loginId;
			$_SESSION['loginPw'] = $loginPw;
			Page::redirect();
	}
	exit();
}
catch (GonException $e) {
	HandleException($e,"login");
}

?>