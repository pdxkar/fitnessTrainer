<?php
include 'db.inc.php';

$essayId=$_POST['id'];

if (!isset($_SESSION['valid_recipe_user'])) {
	echo "<h2>Sorry, you must be logged in to delete an essay.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Please login to delete an essay.</a><br>\n";
} else {
	$userid = $_SESSION['valid_recipe_user'];

	//get essay to delete by id
	$st = $app['pdo']->prepare('DELETE from essays where essayId = :essayId' );
	
	$array = array(
			'essayId' => $essayId
	);

	$isEssayAdded = $st->execute($array);

	if ($isEssayAdded){
		echo "<h2>Your essay was deleted.</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem deleting your essay.</h2>\n";
	}
}

?>
