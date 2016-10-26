<?php
include 'db.inc.php';

$essayId = $_GET['essayId'];
$essayDate = $_GET['essayDate'];
$essayTitle = $_GET['essayTitle']; 
$essayText = $_GET['essayText'];
$resourceId= $_GET['resourceId'];
$resourceImageUrl= $_GET['resourceImageUrl'];
$resourceTitle= $_GET['resourceTitle'];
$resourceTypeName= $_GET['resourceTypeName'];
$essayImageUrl= $_GET['essayImageUrl'];

echo "
<div id=\"essayFullWrapper\">
<div id=\"essayFullDescBox\">
<div id=\"toplineWrapper\">
<div id=\"title\">$essayTitle</div>
<a class=\"button\" href=\"#\">$resourceTypeName</a>
<div style=\"clear: both\"></div>
</div>";

echo "<br>$essayText";

echo "</div>
<div id=\"logoBox\"><img src=\"$essayImageUrl\" alt=\"W3Schools.com\" style=\"width:104px;height:142px;\"></div>
<div style=\"clear: both\"></div>
</div>";

?>


