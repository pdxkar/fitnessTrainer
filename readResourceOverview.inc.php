<?php
include 'db.inc.php';
$resourceId = $_GET['resourceId'];
$resourceTitle = $_GET['resourceTitle'];
$resourceTypeName = $_GET['resourceTypeName'];
$resourceImageUrl = $_GET['resourceImageUrl'];
$subtext = $_GET ['subtext'];
$resourceDesc = $_GET ['resourceDesc'];  

// for each resource, get all of its features
$st = $app ['pdo']->prepare ( 'SELECT featureId,featureTitle,featureSubtext,featureDesc,featureUrl,featureImageUrl from features where resourceId = :resourceId' );

$array = array (
		'resourceId' => $resourceId
);

$st->execute ( $array );

while ($row = $st->fetch (PDO::FETCH_ASSOC)){

	$featureId = $row ['featureId'];
	$featureTitle = $row ['featureTitle'];
	$featureSubtext = $row ['featureSubtext'];
	$featureDesc = $row ['featureDesc'];
	$featureUrl = $row ['featureUrl'];
	$featureImageUrl = $row ['featureImageUrl'];

	echo "<div id=\"featureWrapper\">
	<div id=\"featureDescBox\">
	<div id=\"toplineWrapper\">
	<div id=\"title\">$featureTitle</div>
	<div id=\"subtitle\"><b>$featureSubtext</b><br></div>
	<a class=\"button\" href=\"#\">$resourceTypeName</a>
	<div style=\"clear: both\"></div>
	</div>";
	
	echo substr ( $featureDesc, 0, 400 );
	echo "<font color=\"blue\">...
	<a href=\"index.php?content=readFeature&featureId=$featureId
	&resourceTitle=$resourceTitle
	&resourceTypeName=$resourceTypeName
	&resourceImageUrl=$resourceImageUrl
	&featureTitle=$featureTitle
	&featureSubtext=$featureSubtext
	&featureDesc=$featureDesc
	&featureUrl=$featureUrl
	&subtext=$subtext
	&resourceDesc=$resourceDesc
	&featureImageUrl=$featureImageUrl
	\">read more</a></font>";
	
	echo "</div>
	<div id=\"logoBox\"><img src=\"$featureImageUrl\" alt=\"W3Schools.com\" style=\"width:104px;height:142px;\"></div>
	<div style=\"clear: both\"></div>
	</div>";
}

?>
















