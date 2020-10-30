<?php

require 'inc/gon.inc.php5';

try {
	Page::init();

	require 'tpl/terms.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'terms');
}

?>