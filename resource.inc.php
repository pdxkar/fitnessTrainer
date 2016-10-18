<?php
	include 'db.inc.php';	
	
	//get all resources
	$st = $app['pdo']->prepare('SELECT resourceId,resourceTitle,subtext,resourceImageUrl,resourceTypeId,resourceDesc from resources');
	$st->execute();
	
	while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
		
		$resourceId = $row['resourceId'];
		$resourceTitle = $row['resourceTitle'];
		$resourceImageUrl = $row['resourceImageUrl'];
		$resourceTypeId = $row['resourceTypeId'];
		
		$subtext = $row['subtext'];
		$resourceDesc = $row['resourceDesc'];
		
		//get the resource type name (i.e. "podcast") for each resource
		$stmt = $app['pdo']->prepare('SELECT resourceTypeName from resourceTypes where resourceTypeId = :resourceTypeId');

		$array = array(
				'resourceTypeId' => $resourceTypeId
		);

		$stmt->execute($array);

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$resourceTypeName = $row['resourceTypeName'];
		
		//for each resource, get all of its features
		$stmtx = $app['pdo']->prepare('SELECT featureTitle,featureDesc,featureUrl from features where resourceId = :resourceId');
		
		$array = array(
				'resourceId' => $resourceId
		);
		
		$success = $stmtx->execute($array);
		
		$row = $stmtx->fetch(PDO::FETCH_ASSOC);
		
			$featureTitle = $row['featureTitle'];
			$featureDesc = $row['featureDesc'];
			$featureUrl = $row['featureUrl'];
				
			echo "<div id=\"resourceWrapper\">
			<div id=\"descBox\">
			<div id=\"toplineWrapper\">
			<div id=\"title\">$resourceTitle</div>
			<a class=\"button\" href=\"#\">$resourceTypeName</a>
			<div style=\"clear: both\"></div>
			</div>";
			
			if($row){
				echo "<b>$featureTitle</b><br>";
				echo "$featureDesc<font color=\"blue\">&nbsp;...read more</font>";
			} else {
				echo "<b>$subtext</b><br>";
				echo "$resourceDesc<a href=\"http://www.purple.com\">...read more</a>";
			}
			
 			echo "</div>
			<div id=\"logoBox\"><img src=\"$resourceImageUrl\" alt=\"W3Schools.com\" style=\"width:104px;height:142px;\"></div>
			<div style=\"clear: both\"></div>
			</div>"; 
	}
?>