<?php
include 'db.inc.php';

$resourceTypeId =  $_POST['resourceTypeId'];
$resourceTitle = htmlspecialchars($_POST['resourceTitle']);
$subtext = htmlspecialchars($_POST['subtext']);
$resourceDesc = htmlspecialchars($_POST['resourceDesc']);
$resourceImageUrl = $_POST['resourceImageUrl'];
$resourceUrl = $_POST['resourceUrl'];

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to post an essay.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to post your resource.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

	$st = $app['pdo']->prepare('INSERT INTO resources (resourceTypeId, resourceTitle, subtext, resourceDesc, resourceImageUrl, resourceUrl) VALUES (:resourceTypeId, :resourceTitle, :subtext, :resourceDesc, :resourceImageUrl, :resourceUrl)');

	$array = array(
		'resourceTypeId' => $resourceTypeId, 
		'resourceTitle' => $resourceTitle, 
		'subtext' => $subtext,
		'resourceDesc' => $resourceDesc, 
		'resourceImageUrl' => $resourceImageUrl, 
		'resourceUrl' => $resourceUrl
	);
			
	$isResourceAdded = $st->execute($array);

	if ($isResourceAdded){
		echo "<h2>Your resource was posted.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem posting your resource.</h2>\n";
	}
} 

?>