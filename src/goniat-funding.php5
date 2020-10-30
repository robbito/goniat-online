<?php

require 'inc/gon.inc.php5';

try {
	Page::init();

	require 'tpl/goniat-funding.tpl.php5';
}
catch (GonException $e) {
	HandleException($e,'goniat-funding');
}

?>