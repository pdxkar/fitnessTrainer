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

echo "<h1>Delete Essay</h1>";
echo "<form action=\"index.php\" method=\"post\">";

echo "<input type=\"hidden\" name=\"id\" value=\"";
echo "$id";
echo " \"";
echo "><br>";

echo "<h4>Essay Date</h4>";
echo "<input type=\"text\" size=\"50\" name=\"essayDate\" value=\"";
echo "$essayDate";
echo " \"";
echo "readonly><br>";

echo "<h3>Essay Title</h3>";
echo "<input type=\"text\" size=\"50\" name=\"essayTitle\" value=\"";
echo "$essayTitle";
echo " \"";
echo "readonly><br>";

echo "<h3>Essay Text</h3>";
echo "<input type=\"text\" size=\"50\" name=\"essayText\" value=\"";
echo "$essayText";
echo " \"";
echo "readonly><br>";

echo "<h3>Resource Id</h3>";
echo "<input type=\"text\" size=\"50\" name=\"resourceId\" value=\"";
echo "$resourceId";
echo " \"";
echo "readonly><br>";

echo "<h3>Feature Id</h3>";
echo "<input type=\"text\" size=\"50\" name=\"featureId\" value=\"";
echo "$featureId";
echo " \"";
echo "readonly><br>";

echo "<input type=\"submit\" value=\"Delete Essay\">";
echo "<input type=\"hidden\" name=\"content\" value=\"submitEssayToBeDeleted\">";
echo "</form>";

?>

