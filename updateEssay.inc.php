<?php
include 'db.inc.php';
$id=$_POST['id'];

//get resource to edit by id
$st = $app['pdo']->prepare('SELECT essayId,essayDate,essayTitle,essayText,resourceId,featureId from essays where essayId = :id' );

$array = array (
		'id' => $id
);

$st->execute ( $array );

$row = $st->fetch (PDO::FETCH_ASSOC);

$essayId = $row ['essayId'];
$essayDate = $row ['essayDate'];
$essayTitle = $row ['essayTitle'];
$essayText = $row ['essayText'];
$resourceId = $row ['resourceId'];
$featureId = $row ['featureId'];
				
echo "<h1>Update Essay</h1>";
echo "<h3>Edit and Submit</h3>";
echo "<form action=\"index.php\" method=\"post\">";

echo "<input type=\"hidden\" name=\"id\" value=\"";
echo "$id";
echo " \"";
echo "><br>";

echo "<h4>Resource Id:</h4>";
echo "<input type=\"text\" size=\"50\" name=\"essayDate\" value=\"";
echo "$essayDate";	
echo " \"";
echo "><br>";

echo "<h3>Feature Title (Author, Artist, Subtitle)</h3>";
echo "<input type=\"text\" size=\"50\" name=\"essayTitle\" value=\"";
echo "$essayTitle";
echo " \"";
echo "><br>";

echo "<h3>Feature Subtext</h3>";
echo "<input type=\"text\" size=\"50\" name=\"essayText\" value=\"";
echo "$essayText";
echo " \"";
echo "><br>";

echo "<h3>Feature Description</h3>";
echo "<input type=\"text\" size=\"50\" name=\"resourceId\" value=\"";
echo "$resourceId";
echo " \"";
echo "><br>";

echo "<h3>Feature Url</h3>";
echo "<input type=\"text\" size=\"50\" name=\"featureId\" value=\"";
echo "$featureId";
echo " \"";
echo "><br>";

echo "<input type=\"submit\" value=\"Submit\">";
echo "<input type=\"hidden\" name=\"content\" value=\"submitUpdatedEssayToDb\">";
echo "</form>";

?>

