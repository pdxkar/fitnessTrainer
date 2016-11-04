<?php
include 'db.inc.php';

$resourceId=$_POST['id'];

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to delete a resource.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to delete a resource.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

	//get resource to delete by id
	$st = $app['pdo']->prepare('DELETE from resources where resourceId = :resourceId' );

	$array = array(
			'resourceId' => $resourceId
	);

	$isResourceDeleted = $st->execute($array);

	if ($isResourceDeleted){
		echo "<h2>Your resource was deleted.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem deleting your resource.</h2>\n";
	}
}

?>
