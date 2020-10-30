<?php

require 'inc/gon.inc.php5';

try {

	$account = Account::create();
	$account->User = 'admin';
	$account->setPassword('admin');
	$account->Email = 'kullmann@elementec.de';
	$account->Created = date("Y-m-d H:i:s",time());
	$account->LastLogin = null;
	$account->Perm = 0;
	$account->Status = 0;
	$account->save();

	echo '<html><body>admin account created!</body></html>';
	exit();

}
catch (GonException $e) {
	HandleException($e,'createAdmin');
}
?>
