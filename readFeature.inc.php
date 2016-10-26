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

/* test values below */
/* $essayId = 6;
$essayDate = '2016-10-25';
$essayTitle = "testing";
$essayText = "success joseph stalin";
$essayImageUrl = "upload_pic/cropped-1476982117-seaTurtle.jpg"; */



// for the feature, get its essay
$st = $app ['pdo']->prepare ( 'SELECT essayId,essayDate,essayTitle,essayText,resourceId,featureId,essayImageUrl from essays where featureId = :featureId' );

$array = array (
		'featureId' => $featureId
);

$st->execute ( $array );

$row = $st->fetch (PDO::FETCH_ASSOC);

$essayId = $row ['essayId'];
$essayDate = $row ['essayDate'];
$essayTitle = $row ['essayTitle'];
$essayText = $row ['essayText'];
$resourceId = $row ['resourceId'];
$essayImageUrl = $row ['essayImageUrl'];

	echo "<div id=\"featureFullWrapper\">
	<div id=\"featureFullDescBox\">
	<div id=\"toplineWrapper\">
	<div id=\"title\">$featureTitle</div>
	<a class=\"button\" href=\"#\">$resourceTypeName</a>";
	
	echo "<div id=\"subtitle\"><b>$featureSubtext</b><br></div>";
	
	echo "<div style=\"clear: both\"></div>";
	echo "</div>";
	echo "<br>$featureDesc";
	
	echo "<font color=\"blue\">...
	<a href=\"index.php?content=readEssay&essayId=$essayId
	&resourceTitle=$resourceTitle
	&resourceTypeName=$resourceTypeName
	&resourceImageUrl=$resourceImageUrl
	&essayDate=$essayDate
	&essayTitle=$essayTitle
	&essayText=$essayText
	&resourceId=$resourceId
	&essayImageUrl=$essayImageUrl
	&subtext=$subtext
	&resourceDesc=$resourceDesc
	\">read essay</a></font>";
		
	echo "</div>
	<div id=\"logoBox\"><img src=\"$featureImageUrl\" alt=\"W3Schools.com\" style=\"width:104px;height:142px;\"></div>
	<div style=\"clear: both\"></div>
	</div>";


?>


