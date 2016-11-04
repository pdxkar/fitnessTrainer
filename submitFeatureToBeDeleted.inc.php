<?php
include 'db.inc.php';

$featureId=$_POST['id'];

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to delete a feature.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to delete a feature.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

//get feature to delete by id
$st = $app['pdo']->prepare('DELETE from features where featureId = :featureId' );
	
$array = array(
		'featureId' => $featureId
);

	$isFeatureDeleted = $st->execute($array);
	
	if ($isFeatureDeleted){
		echo "<h2>Your feature was deleted.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem deleting your feature.</h2>\n";
	}
}

?>
