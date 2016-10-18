	<script>
		function fileSelect(evt) {
		    var files = evt.target.files;
		 
		    var result = '';
		    var file;
		    for (var i = 0; file = files[i]; i++) {
		        result += '<li>' + file.name + ' ' + file.size + ' bytes</li>';
		    }
		    document.getElementById('filesInfo').innerHTML = '<ul>' + result + '</ul>';
		}
	 	document.getElementById('filesToUpload').addEventListener('change', fileSelect, false);
	</script>
<form enctype="multipart/form-data" method="post" action="upload.inc.php">
    <div class="row">
      <label for="fileToUpload">Select a File to Upload</label><br />
      <input type="file" name="fileToUpload" id="fileToUpload" />
       <output id="filesInfo"></output>
    </div>
    <div class="row">
      <input type="submit" value="Upload" />
    </div>
  </form>
  


