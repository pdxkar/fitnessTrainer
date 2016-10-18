<?php
include 'db.inc.php';

$featureId = $_GET['featureId'];
$resourceTitle = $_GET['resourceTitle'];
$resourceTypeName = $_GET['resourceTypeName'];
$resourceImageUrl = $_GET['resourceImageUrl']; 
$featureTitle = $_GET['featureTitle'];
$featureSubtext = $_GET['featureSubtext'];
$featureDesc = $_GET['featureDesc'];
$featureUrl = $_GET['featureUrl'];
$featureImageUrl = $_GET['featureImageUrl'];

	echo "<div id=\"featureFullWrapper\">
	<div id=\"featureFullDescBox\">
	<div id=\"toplineWrapper\">
	<div id=\"title\">$featureTitle</div>
	<a class=\"button\" href=\"#\">$resourceTypeName</a>";
	
	echo "<div id=\"subtitle\"><b>$featureSubtext</b><br></div>";
	
	echo "<div style=\"clear: both\"></div>";
	echo "</div>";
	
	echo "<br>$featureDesc";
		
	echo "</div>
	<div id=\"logoBox\"><img src=\"$featureImageUrl\" alt=\"W3Schools.com\" style=\"width:104px;height:142px;\"></div>
	<div style=\"clear: both\"></div>
	</div>";

?>


