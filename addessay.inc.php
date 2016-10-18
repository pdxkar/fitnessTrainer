<?php
include 'db.inc.php';

$essaytitle = htmlspecialchars($_POST['essaytitle']);
$essaytext = htmlspecialchars($_POST['essaytext']);
$resourceid = $_POST['resourceid'];
$essaydate = date("Y-m-d");

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to post an resource.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to post your essay.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

	$st = $app['pdo']->prepare('INSERT INTO essays (essayTitle, essayText, resourceId, essayDate) VALUES (:essaytitle, :essaytext, :resourceid, :essaydate)');
	
	$array = array(
			'essaytitle' => $essaytitle,
			'essaytext' => $essaytext,
			'resourceid' => $resourceid,
			'essaydate' => $essaydate
	);

	$isEssayAdded = $st->execute($array);

	if ($isEssayAdded){
		echo "<h2>Your essay was posted.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem posting your essay.</h2>\n";
	}
} 

?>