<?php
include 'db.inc.php';

$resourceTitle = $_GET['resourceTitle'];
$resourceTypeName = $_GET['resourceTypeName'];
$resourceImageUrl = $_GET['resourceImageUrl']; 
$essayDate = $_GET['essayDate'];
$essayTitle= $_GET['essayTitle'];
$essayText= $_GET['essayText'];

	echo "
	<div id=\"essayWrapper\">
		<div id=\"essayDescBox\">
			<div id=\"toplineWrapper\">
				<div id=\"title\">$resourceTitle</div>
				<a class=\"button\" href=\"#\">$resourceTypeName</a>
				<div style=\"clear: both\"></div>
		</div>";
	
	echo "<b>$essayTitle</b><br>$essayText";
		
	echo "</div>
	<div id=\"logoBox\"><img src=\"$resourceImageUrl\" alt=\"W3Schools.com\" style=\"width:104px;height:142px;\"></div>
	<div style=\"clear: both\"></div>
	</div>";

?>


