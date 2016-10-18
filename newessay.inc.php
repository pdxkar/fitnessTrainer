<form action="index.php" method="post">
	<h2>Enter your new essay</h2><br>
		Title:<input type="text" size="40" name="essaytitle"><br>
	<h3>Text</h3>
		<textarea rows="10" cols="50" name="essaytext"></textarea><br>
	<h3>Resource Id</h3>
		<textarea rows="5" cols="50" name="resourceid"></textarea><br>
		<input type="submit" value="Submit">
		<input type="hidden" name="content" value="addessay">
</form>