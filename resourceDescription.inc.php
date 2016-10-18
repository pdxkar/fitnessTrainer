<div class='resourceOverview'>
	<?php
	include 'db.inc.php';
	
	$resourceTitle = $_GET['resourceTitle'];
	$resourceTypeName = $_GET['resourceTypeName'];
	$resourceImageUrl = $_GET['resourceImageUrl'];
	$subtext = $_GET ['subtext'];
	$resourceDesc = $_GET ['resourceDesc'];
	
	echo "<div id=\"resourceWrapper\">
	<div id=\"descBox\">
	<div id=\"toplineWrapper\">
	<div id=\"title\">$resourceTitle</div>
	<a class=\"button\">$resourceTypeName</a>";
	
	/* display the resource's title, subtitle, and description */
	echo "<div id=\"subtitle\"><b>$subtext</b><br></div>";
	echo "<div style=\"clear: both\"></div>";
	echo "</div>";
	echo $resourceDesc;
	echo "</div>
	<div id=\"logoBox\"><img src=\"$resourceImageUrl\" alt=\"W3Schools.com\" style=\"width:104px;height:142px;\"></div>
	<div style=\"clear: both\"></div>
	</div>";
	
	?>
</div>

