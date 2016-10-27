<?php
include 'db.inc.php';
$id=$_POST['id'];

//get resource to edit by id
$st = $app['pdo']->prepare('SELECT resourceId,resourceTitle,subtext,resourceImageUrl,resourceTypeId,resourceDesc,resourceUrl from resources where resourceId = :id' );

$array = array (
		'id' => $id
);

$st->execute ( $array );

$row = $st->fetch (PDO::FETCH_ASSOC);

$resourceId = $row ['resourceId'];
$resourceTitle = $row ['resourceTitle'];
$subtext = $row ['subtext'];
$resourceImageUrl = $row ['resourceImageUrl'];
$resourceTypeId = $row ['resourceTypeId'];
$resourceDesc = $row ['resourceDesc'];
$resourceUrl = $row ['resourceUrl'];
				
echo "<h1>Update Resource</h1>";
echo "<h3>Edit and Submit</h3>";
echo "<form action=\"index.php\" method=\"post\">";

echo "<input type=\"hidden\" name=\"id\" value=\"";
echo "$id";
echo " \"";
echo "><br>";

echo "<h4>Testing:</h4>";
echo "<input type=\"text\" size=\"50\" name=\"id\" value=\"";
echo "$id";	
echo " \"";
echo "><br>";

echo "<h4>Title:</h4>";
echo "<input type=\"text\" size=\"50\" name=\"resourceTitle\" value=\"";
echo "$resourceTitle";	
echo " \"";
echo "><br>";

echo "<h3>Subtext (Author, Artist, Subtitle)</h3>";
echo "<input type=\"text\" size=\"50\" name=\"subtext\" value=\"";
echo "$subtext";
echo " \"";
echo "><br>";

echo "<h3>Description</h3>";
echo "<input type=\"text\" size=\"50\" name=\"resourceDesc\" value=\"";
echo "$resourceDesc";
echo " \"";
echo "><br>";

echo "<h3>Resource Url</h3>";
echo "<input type=\"text\" size=\"50\" name=\"resourceUrl\" value=\"";
echo "$resourceUrl";
echo " \"";
echo "><br>";

echo "<h3>Resource Type Id</h3>";
echo "<input type=\"text\" size=\"50\" name=\"resourceTypeId\" value=\"";
echo "$resourceTypeId";
echo " \"";
echo "><br>";

echo "<input type=\"submit\" value=\"Submit\">";
echo "<input type=\"hidden\" name=\"content\" value=\"submitUpdatedResourceToDb\">";
echo "</form>";

?>

