<?php
include 'db.inc.php';

$featureId=$_POST['id'];
$resourceId=$_POST['resourceId'];
$featureTitle=$_POST['featureTitle'];
$featureSubtext=$_POST['featureSubtext'];
$featureDesc=$_POST['featureDesc'];
$featureUrl=$_POST['featureUrl'];

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to update a feature.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to update a feature.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

//get resource to update by id
$st = $app['pdo']->prepare('UPDATE features SET resourceId = :resourceId, featureTitle = :featureTitle, featureSubtext = :featureSubtext, featureDesc = :featureDesc, featureUrl = :featureUrl where featureId = :featureId' );

$array = array(
		'featureId' => $featureId,
		'resourceId' => $resourceId,
		'featureTitle' => $featureTitle,
		'featureSubtext' => $featureSubtext,
		'featureDesc' => $featureDesc,
		'featureUrl' => $featureUrl
);

	$isFeatureAdded = $st->execute($array);
	
	if ($isFeatureAdded){
		echo "<h2>Your feature was updated.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem updating your feature.</h2>\n";
	}
}

?>
