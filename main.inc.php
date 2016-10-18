<?php
include 'db.inc.php';

// get all resources
// TODO get resourceURL
$st = $app ['pdo']->prepare ( 'SELECT resourceId,resourceTitle,subtext,resourceImageUrl,resourceTypeId,resourceDesc from resources' );
$st->execute ();

//display each resource's info with a link to read more
while ( $row = $st->fetch ( PDO::FETCH_ASSOC ) ) {
	
	$resourceId = $row ['resourceId'];
	$resourceTitle = $row ['resourceTitle'];
	$resourceImageUrl = $row ['resourceImageUrl'];
	$resourceTypeId = $row ['resourceTypeId'];
	
	$subtext = $row ['subtext'];
	$resourceDesc = $row ['resourceDesc'];
	
	// get the resource type name (i.e. "podcast") for each resource
	$stmt = $app ['pdo']->prepare ( 'SELECT resourceTypeName from resourceTypes where resourceTypeId = :resourceTypeId' );
	
	$array = array (
			'resourceTypeId' => $resourceTypeId 
	);
	
	$stmt->execute ( $array );
	
	$row = $stmt->fetch ( PDO::FETCH_ASSOC );
	
	$resourceTypeName = $row ['resourceTypeName'];
	
/* 	// for each resource, get its essay
	$stEssay = $app ['pdo']->prepare ( 'SELECT essayDate, essayTitle, essayText from essays where resourceId = :resourceId' );
	
	$array = array (
			'resourceId' => $resourceId 
	);
	
	$success = $stEssay->execute ( $array );
	
	$resourceRowHasEssay = $stEssay->fetch ( PDO::FETCH_ASSOC );
	
	$essayDate = $resourceRowHasEssay ['essayDate'];
	$essayTitle = $resourceRowHasEssay ['essayTitle'];
	$essayText = $resourceRowHasEssay ['essayText'];
	
	// for each resource, get all of its features
	$stmtx = $app ['pdo']->prepare ( 'SELECT featureId,featureTitle,featureDesc,featureUrl from features where resourceId = :resourceId' );
	
	$array = array (
			'resourceId' => $resourceId 
	);
	
	$success = $stmtx->execute ( $array );
	
	$resourceRowHasFeatures = $stmtx->fetch ( PDO::FETCH_ASSOC );
	
	$featureId = $resourceRowHasFeatures ['featureId'];
	$featureTitle = $resourceRowHasFeatures ['featureTitle'];
	$featureDesc = $resourceRowHasFeatures ['featureDesc'];
	$featureUrl = $resourceRowHasFeatures ['featureUrl']; */
	
	echo "<div id=\"resourceWrapper\">
	<div id=\"descBox\">
	<div id=\"toplineWrapper\">
	<div id=\"title\">$resourceTitle</div>
	<a class=\"button\">$resourceTypeName</a>";
	
	/* display the resource's title, subtitle, and description */
	echo "<div id=\"subtitle\"><b>$subtext</b><br></div>";
	echo "<div style=\"clear: both\"></div>";
	echo "</div>";
	echo substr ( $resourceDesc, 0, 400 );
	echo "<font color=\"blue\">...
		  <a href=\"index.php?content=readResourceOverview&subtext=$subtext
		  		&resourceId=$resourceId
				&resourceDesc=$resourceDesc
				&resourceTitle=$resourceTitle
				&resourceTypeName=$resourceTypeName
				&resourceImageUrl=$resourceImageUrl
				\">read more</a></font>";
	
	echo "</div>
	<div id=\"logoBox\"><img src=\"$resourceImageUrl\" alt=\"W3Schools.com\" style=\"width:104px;height:142px;\"></div>
	<div style=\"clear: both\"></div>
	</div>";
}
?>