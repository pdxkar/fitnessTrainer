<h2 align="center">The Latest Exercises</h2><br>

<?php
include 'db.inc.php';

// get all resources
// TODO get resourceURL
$st = $app ['pdo']->prepare ( 'SELECT exerciseid,name,type,shortdesc,instructions,url from exercies' );
$st->execute();
echo "<div>This is a test Middle Middle</div>";
//display each exercise
while ( $row = $st->fetch ( PDO::FETCH_ASSOC ) ) {

	$exerciseId = $row ['exerciseid'];
	$name = $row ['name'];
	$type = $row ['type'];
	$shortdesc = $row ['shortdesc'];
	
	$instructions = $row ['instructions'];
	$url = $row ['url'];
	
echo "
<div>$exerciseId</div>
<div>$name</div>
<div>$type</div>
<div>$shortdesc</div>
<div>$instructions</div>
<div>$url</div>
";
	

}
echo "<div>This is a test Very bottom</div>";
?>

