<div id="uploadImageDiv">
       <?php include("upload_crop.php"); ?>
</div>
<form action="index.php" method="post">
	<h2>Enter your new resource</h2><br>
	<h3>Title:</h3>
		<input type="text" size="40" name="resourceTitle"><br>	
	<h3>Subtext (Author, Artist, Subtitle)</h3>
		<textarea rows="10" cols="50" name="subtext"></textarea><br>
	<h3>Description</h3>
		<textarea rows="10" cols="50" name="resourceDesc"></textarea><br>
	<h3>Image location</h3>
		<textarea rows="1" cols="50" name="resourceImageUrl"><?php echo($_SESSION['largeImageLocation']); ?></textarea><br>
	<h3>Resource Url</h3>
		<textarea rows="1" cols="50" name="resourceUrl"></textarea><br>
	<h3>Resource Type Id</h3>
		<textarea rows="1" cols="50" name="resourceTypeId"></textarea><br>
		<input type="submit" value="Submit">
		<input type="hidden" name="content" value="addresource">
</form>



