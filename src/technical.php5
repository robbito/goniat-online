<?php

require 'inc/gon.inc.php5';

try {
	Page::init();

	require 'tpl/technical.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'technical');
}

?>