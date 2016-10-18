<?php
include 'db.inc.php';
//set values to be posted
$recipeid = $_POST['recipeid'];
$poster = $_POST['poster'];
$comment = htmlspecialchars($_POST['comment']);
$date = date("Y-m-d"); 

//prepare sql statement
$st = $app['pdo']->prepare('INSERT INTO comments (recipeid, poster, date, comment) VALUES (:recipeid, :poster, :date, :comment)');

$array = array(
		'recipeid' => $recipeid,
		'poster' => $poster,
		'date' => $date,
		'comment' => $comment
);

$isCommentAdded = $st->execute($array);

	if ($isCommentAdded){
		echo "<h2>Comment posted</h2>\n";
	} else {
		echo "<h2>Sorry, there was a problem posting your comment</h2>\n";
	}
	echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">Return to recipe</a>\n";

?>