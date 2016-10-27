<?php
include 'db.inc.php';

$resourceId=$_POST['id'];
$resourceTitle=$_POST['resourceTitle'];
$subtext=$_POST['subtext'];
$resourceDesc=$_POST['resourceDesc'];
$resourceUrl=$_POST['resourceUrl'];
$resourceTypeId=$_POST['resourceTypeId'];

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to update a resource.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to update a resource.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

//get resource to update by id
$st = $app['pdo']->prepare('UPDATE resources SET resourceTitle = :resourceTitle, subtext = :subtext, resourceTypeId = :resourceTypeId, resourceDesc = :resourceDesc, resourceUrl = :resourceUrl where resourceId = :resourceId' );

$array = array(
		'resourceId' => $resourceId,
		'resourceTypeId' => $resourceTypeId,
		'resourceTitle' => $resourceTitle,
		'subtext' => $subtext,
		'resourceDesc' => $resourceDesc,
		'resourceUrl' => $resourceUrl
);

	$isResourceAdded = $st->execute($array);
	
	if ($isResourceAdded){
		echo "<h2>Your resource was updated.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem updating your resource.</h2>\n";
	}
}

?>
