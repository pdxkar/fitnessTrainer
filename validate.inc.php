<?php
include 'db.inc.php';

$userid = $_POST['userid'];
$password = $_POST['password'];

$st = $app['pdo']->prepare('SELECT password from users where userid = :userid');

$array = array(
		'userid' => $userid,
);

$st->execute($array);

$row = $st->fetch(PDO::FETCH_ASSOC);

$pwInDatabase = $row['password'];

$passwordsMatch = password_verify($password, $pwInDatabase);

if (!$passwordsMatch) {
	echo "<h2>Sorry, your user account was not validated.</h2><br>\n";
	echo "<a href=\"index.php?content=login\">Try again</a><br>\n";
} else {
	$_SESSION['valid_recipe_user'] = $userid;
	//echo "<h2>Your user account has been validated, you can now post recipes and comments</h2><br>\n";
	header('Location: index.php');
}
?>

