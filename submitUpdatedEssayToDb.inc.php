<?php
include 'db.inc.php';

$essayId=$_POST['id'];
$essayDate=$_POST['essayDate'];
$essayTitle=$_POST['essayTitle'];
$essayText=$_POST['essayText'];
$resourceId=$_POST['resourceId'];
$featureId=$_POST['featureId'];

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to update a feature.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to update a feature.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

//get resource to update by id
$st = $app['pdo']->prepare('UPDATE essays SET essayDate = :essayDate, essayTitle = :essayTitle, essayText = :essayText, resourceId = :resourceId, featureId = :featureId where essayId = :essayId' );

$array = array(
		'essayDate' => $essayDate,
		'essayTitle' => $essayTitle,
		'essayText' => $essayText,
		'resourceId' => $resourceId,
		'featureId' => $featureId,
		'essayId' => $essayId
);

	$isEssayAdded = $st->execute($array);
	
	if ($isEssayAdded){
		echo "<h2>Your essay was updated.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem updating your essay.</h2>\n";
	}
}

?>
