<!DOCTYPE html>
<html>
<head>
<title>GONIAT-Online</title>
<?php require 'tpl/meta.tpl.php5'; ?>
<?php require 'tpl/include.tpl.php5'; ?>
</head>
<body>
<div class="main" id="main">

<?php require 'tpl/header.tpl.php5'; ?>
	
<h1>Technical Information</h1>

GONIAT online is meant as a reference implementation of a paleontological database system.
In this context GONIAT online is available as open source. The GONIAT online system is
written in PHP5 and uses MySQL as database backend. The frontend makes use of the mootool
JavaScript library. The system core is designed according to the Model-View-Controller paradigm.

GONIAT has also be carefully designed to achieve the desired performance goals to be suitable as online research tools.
Hierarchical structures such as the taxa and locations are organized according to the 'nested set' model (<a href="http://en.wikipedia.org/wiki/Nested_set_model">see here</a>).
<br /><br />
<h2>Data model</h2>
<br />
<img alt="GONIAT online data model" src="img/goniat/data_model.JPG" style="width:100%"></img>
<br /><br />
Main entity types are <em>tax</em>,<em>lit</em> and <em>loc</em>, representing taxa, references and localities, respectively.
The hierarchical structure of taxa is represented through the <em>cat</em> entitiy type, geographic structure of localities through <em>geo</em>.
The three association entity types <em>taxloc</em>,<em>taxlit</em> and <em>litloc</em> connect the three main entity types.
Taxa, which have morphological descriptions are associated with entities from <em>morpha</em> and optionally <em>morphb</em>.
For more detailed information, please contact info-at-goniat-dot-org.

</div>
</body>
</html>