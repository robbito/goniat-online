<?php

require 'inc/gon.inc.php5';

$password = Page::getString('password');
$mode = Page::getString('mode');
$file = Page::getString('file');

$maxVersions = 14;

try {
	if ($password != "go587ni128at986") {
		throw new GonInvalidArgumentException;
	}
	if ($mode !== 'restore') {
		$now = date("Y-m-d-H-i-s");
		$outputfilename = "bak/goniat-".$now.".sql";

		exec('mysqldump -h'. DEFAULT_DBHOST .' -u'. DEFAULT_DBUSER .' -p'. DEFAULT_DBPASSWORD .' '. DEFAULT_DBNAME .' | gzip > '. $outputfilename .'.gz');

		$files = glob('bak/*.sql.gz');
		echo ("Found " . count($files) . " matches.<br />");
		usort($files, function($a, $b) {
			return filemtime($a) > filemtime($b);
		});

		$toDelete = count($files) - $maxVersions;
		for ($i = 0; $i < $toDelete; $i++) {
			echo ("Unlink ".$files[$i]."<br />");
			unlink($files[$i]);
		}
	}
	else {
		exec('gunzip < ' . $file . ' | mysql -u'. DEFAULT_DBUSER . ' -p'. DEFAULT_DBPASSWORD);
	}
	
	echo "Done.";
}
catch (Exception $e) {
	HandleError($e);
}

?>