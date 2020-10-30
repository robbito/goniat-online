<?php

require 'inc/gon.inc.php5';

try {
	Page::init();

	require 'tpl/contact.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'contact');
}

?>