<?php

require 'inc/gon.inc.php5';

$ids = Lit::loadAllIds();

header('Content-type: application/xml');
echo("<?xml version=\"1.0\" ?>\n");
echo("<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.9\">\n");
echo("<url><loc>http://www.goniat.org/index.html</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>\n");

foreach($ids as $id){
	echo("<url>\n");
        echo("<loc>".xmlentities("http://www.goniat.org/showLit.html?LitId=".$id)."</loc>\n");
	echo("</url>\n");
}

echo("</urlset>");

?>