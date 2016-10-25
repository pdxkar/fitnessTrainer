<?php
include 'db.inc.php';

$resourceId =  $_POST['resourceId'];
$featureTitle = htmlspecialchars($_POST['featureTitle']);
$featureDesc = htmlspecialchars($_POST['featureDesc']);
$featureUrl = $_POST['featureUrl'];
$featureImageUrl = $_POST['featureImageUrl'];

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to post an essay.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to post your feature.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

	$st = $app['pdo']->prepare('INSERT INTO features (resourceId, featureTitle, featureDesc, featureUrl, featureImageUrl) VALUES (:resourceId, :featureTitle, :featureDesc, :featureUrl, :featureImageUrl)');
	
	$array = array(
		'resourceId' => $resourceId, 
		'featureTitle' => $featureTitle, 
		'featureDesc' => $featureDesc, 
		'featureUrl' => $featureUrl,
		'featureImageUrl' => $featureImageUrl
	);
			
	$isFeatureAdded = $st->execute($array);

	if ($isFeatureAdded){
		echo "<h2>Your feature was posted.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem posting your feature.</h2>\n";
	}
} 

?>