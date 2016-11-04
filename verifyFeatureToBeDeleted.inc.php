<?php
include 'db.inc.php';
$id=$_POST['id'];

//get resource to edit by id
$st = $app['pdo']->prepare('SELECT featureId,resourceId,featureTitle,featureSubtext,featureDesc,featureUrl from features where featureId = :id' );

$array = array (
		'id' => $id
);

$st->execute ( $array );

$row = $st->fetch (PDO::FETCH_ASSOC);

$featureId = $row ['featureId'];
$resourceId = $row ['resourceId'];
$featureTitle = $row ['featureTitle'];
$featureSubtext = $row ['featureSubtext'];
$featureDesc = $row ['featureDesc'];
$featureUrl = $row ['featureUrl'];

echo "<h1>Feature to be Deleted:</h1>";
echo "<form action=\"index.php\" method=\"post\">";

echo "<input type=\"hidden\" name=\"id\" value=\"";
echo "$id";
echo " \"";
echo "><br>";

echo "<h4>Resource Id:</h4>";
echo "<input type=\"text\" size=\"50\" name=\"resourceId\" value=\"";
echo "$resourceId";
echo " \"";
echo "readonly><br>";

echo "<h3>Feature Title (Author, Artist, Subtitle)</h3>";
echo "<input type=\"text\" size=\"50\" name=\"featureTitle\" value=\"";
echo "$featureTitle";
echo " \"";
echo "readonly><br>";

echo "<h3>Feature Subtext</h3>";
echo "<input type=\"text\" size=\"50\" name=\"featureSubtext\" value=\"";
echo "$featureSubtext";
echo " \"";
echo "readonly><br>";

echo "<h3>Feature Description</h3>";
echo "<input type=\"text\" size=\"50\" name=\"featureDesc\" value=\"";
echo "$featureDesc";
echo " \"";
echo "readonly><br>";

echo "<h3>Feature Url</h3>";
echo "<input type=\"text\" size=\"50\" name=\"featureUrl\" value=\"";
echo "$featureUrl";
echo " \"";
echo "readonly><br>";

echo "<input type=\"submit\" value=\"Delete Feature\">";
echo "<input type=\"hidden\" name=\"content\" value=\"submitFeatureToBeDeleted\">";
echo "</form>";

?>

