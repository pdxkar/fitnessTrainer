<h1>Enter New Feature</h1>
<div id="uploadImageDiv">
    <?php include("upload_crop.php"); ?>
</div>
<form action="index.php" method="post">
		Title:<input type="text" size="40" name="featureTitle"><br>
	<h3>Description</h3>
		<textarea rows="2" cols="50" name="featureDesc"></textarea><br>
	<h3>Image Location</h3>
		<textarea readonly="readonly" rows="1" cols="50" name="featureImageUrl"><?php echo($_SESSION['largeImageLocation']); ?></textarea><br>
	<h3>Feature Url</h3>
		<textarea rows="1" cols="50" name="featureUrl"></textarea><br>
	<h3>Resource Id</h3>
		<textarea rows="1" cols="50" name="resourceId"></textarea><br>
		<input type="submit" value="Submit">
		<input type="hidden" name="content" value="addfeature">
</form>



