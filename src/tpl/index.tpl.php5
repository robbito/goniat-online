<!DOCTYPE html>
<html>
<head>
<title>GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
<script language="JavaScript" type="text/javascript" src="jsc/goniat/index.js"></script>
</head>
<body>
<div class="main" id="main">

<?php require 'tpl/header.tpl.php5'; ?>

<table>
<tr>
<td style="width:600px;vertical-align:top;">

<div id="intro">
	<h1>GONIAT online</h1>
	GONIAT online is a tool for investigations of the Paleozoic ammonoids. The GONIAT database has been originally built up at the Geological Institute of Tübingen, Germany and is now constantly updated by an international team of paleontological scientists. <a href="general.html"><strong>More...</strong></a>
</div>
<div id="terms">
	<h1>Terms of use</h1>
	<p>The information in the GONIAT database is freely available for non-profit research and educational purposes. 
		For commercial usage, please get in touch with us. <a href="terms.html"><strong>More...</strong></a></p>
</div>

<div id="search" class="tabs">

<ul>
<li id="searchFormTax"><a href="searchFormTax.html">Search Taxa</a></li>
<li id="searchFormLit"><a href="searchFormLit.html">Search Literature</a></li>
<li id="searchFormLoc"><a href="searchFormLoc.html">Search Localities</a></li>
</ul>
</div>

<div id="links" class="tabs">
    <ul>
        <li><a href="#browse">Browse</a></li>
<?php if (Page::isEditor()) : ?>
        <li><a href="#create">Create</a></li>
<?php endif; ?>
   </ul>
    <div id="browse">
	<table>
	<tr>
	<td>
        <form action="taxHierarchy.html" method="get">
            <button type="submit">Browse Taxonomical Hierarchy</button>
        </form>
        <form action="locHierarchy.html" method="get">
            <button type="submit">Browse Geographical Hierarchy</button>
        </form>
	</td>
	<td>
        <form action="browseAut.html" method="get">
            <button type="submit">Browse Authors</button>
        </form>
        <form action="browseBnd.html" method="get">
            <button type="submit">Browse Boundaries</button>
        </form>
	</td>
	</tr>
	</table>
    </div>
<?php if (Page::isEditor()) : ?>
    <div id="create">
        <form action="showBndNew.html" method="get">
            <button type="submit">New Boundary</button>
        </form>
        <form action="showAutNew.html" method="get">
            <button type="submit">New Author</button>
        </form>
        <form action="showLitNew.html" method="get">
            <button type="submit">New Literature</button>
        </form>
	</div>
<?php endif; ?>
</div>

</td>

<td class="col-right">

<div id="stats"  class="box ui-widget ui-widget-content ui-corner-all">
<h2>Statistics</h2>
<table cellspacing="0" cellpadding="0">
<tr>
<td>Taxa:</td><td><?php echo $countTax;?></td>
</tr>
<tr>
<td>Literature:</td><td><?php echo $countLit;?></td>
</tr>
<tr>
<td>Localities:</td><td><?php echo $countLoc;?></td>
</tr>
</table>
</div>
	
<div id="docs" class="box ui-widget ui-widget-content ui-corner-all">
<h2>Documentation</h2>
<a href="general.html">&gt; General information</a><br />
<a href="technical.html">&gt; Technical information</a><br />
<a href="help/HTML/index.html" target="GONIAT_Online_Help">&gt; User manual</a><br />
<a href="goniat_desktop.html">&gt; GONIAT desktop</a><br />
<a href="contact.html">&gt; Contact - Imprint</a><br />
<a href="dataProtection.html">&gt; Privacy policy</a>
</div>

<div id="news" class="box ui-widget ui-widget-content ui-corner-all">
<h2>News</h2>
GONIAT online is being updated continuously. Look out for new features.<br /><br />
<h3>Nov 2020</h3>
<ul style="margin:0;padding-left:18px;">
	<li>The GONIAT online source code is now available on Github.</li>
	<li>The new setup with docker allows for easy installation in a server environment or locally.</li>
</ul>
</div>

</td>

</tr>
</table>

</div>
</body>
</html>