<?php

require 'inc/gon.inc.php5';

try {
	Page::init();
	Page::blockDirect();

	Account::logout();
	Page::redirect();
}
catch (GonException $e) {
	HandleException($e,"login");
}

?>