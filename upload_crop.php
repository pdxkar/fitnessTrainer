<?php
/*
 * Copyright (c) 2008 http://www.webmotionuk.com / http://www.webmotionuk.co.uk
 * "PHP & Jquery image upload & crop"
 * Date: 2008-11-21
 * Ver 1.2
 * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
 * STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF
 * THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */
require_once('ImageManipulator.php');
error_reporting ( E_ALL ^ E_NOTICE );
session_start(); // Do not remove this

// only assign a new timestamp if the session variable is empty
if (! isset ( $_SESSION ['random_key'] ) || strlen ( $_SESSION ['random_key'] ) == 0) {
	$_SESSION ['random_key'] = strtotime ( date ( 'Y-m-d H:i:s' ) ); // assign the timestamp to the session variable
	$_SESSION ['user_file_ext'] = "";
}
// ########################################################################################################
// CONSTANTS #
// You can alter the options below #
// ########################################################################################################
$upload_dir = "upload_pic"; // The directory for the images to be saved in
$upload_path = $upload_dir . "/"; // The path to where the image will be saved
$large_image_prefix = "cropped-"; // The prefix name to cropped image
$large_image_name = $large_image_prefix . $_FILES ['image'] ['name']; // New name of the large image (append the timestamp to the filename)
$max_file = "3"; // Maximum file size in MB
$max_width = "500"; // Max width allowed for the large image
// Only one of these image types should be allowed for upload
$allowed_image_types = array (
		'image/pjpeg' => "jpg",
		'image/jpeg' => "jpg",
		'image/jpg' => "jpg",
		'image/png' => "png",
		'image/x-png' => "png",
		'image/gif' => "gif" 
);
$allowed_image_ext = array_unique ( $allowed_image_types ); // do not change this
$image_ext = ""; // initialise variable, do not change this.
foreach ( $allowed_image_ext as $mime_type => $ext ) {
	$image_ext .= strtoupper ( $ext ) . " ";
}

// #########################################################################################################
// IMAGE FUNCTIONS #
// You do not need to alter these functions #
// #########################################################################################################
function resizeImage($image, $width, $height, $scale) {
	list ( $imagewidth, $imageheight, $imageType ) = getimagesize ( $image );
	$imageType = image_type_to_mime_type ( $imageType );
	$newImageWidth = ceil ( $width * $scale );
	$newImageHeight = ceil ( $height * $scale );
	$newImage = imagecreatetruecolor ( $newImageWidth, $newImageHeight );
	switch ($imageType) {
		case "image/gif" :
			$source = imagecreatefromgif ( $image );
			break;
		case "image/pjpeg" :
		case "image/jpeg" :
		case "image/jpg" :
			$source = imagecreatefromjpeg ( $image );
			break;
		case "image/png" :
		case "image/x-png" :
			$source = imagecreatefrompng ( $image );
			break;
	}
	imagecopyresampled ( $newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height );
	
	switch ($imageType) {
		case "image/gif" :
			imagegif ( $newImage, $image );
			break;
		case "image/pjpeg" :
		case "image/jpeg" :
		case "image/jpg" :
			imagejpeg ( $newImage, $image, 90 );
			break;
		case "image/png" :
		case "image/x-png" :
			imagepng ( $newImage, $image );
			break;
	}
	
	chmod ( $image, 0777 );
	return $image;
}

// You do not need to alter these functions
function getHeight($image) {
	$size = getimagesize ( $image );
	$height = $size [1];
	return $height;
}
// You do not need to alter these functions
function getWidth($image) {
	$size = getimagesize ( $image );
	$width = $size [0];
	return $width;
}

// Image Locations
$large_image_location = $upload_path . $large_image_name . $_SESSION ['user_file_ext'];

// Create the upload directory with the right permissions if it doesn't exist
if (! is_dir ( $upload_dir )) {
	mkdir ( $upload_dir, 0777 );
	chmod ( $upload_dir, 0777 );
}

// Check to see if any images with the same name already exist
if (file_exists ( $large_image_location )) {
	$large_photo_exists = "<img src=\"" . $upload_path . $large_image_name . $_SESSION ['user_file_ext'] . "\" alt=\"Large Image\"/>";
} else {
	$large_photo_exists = "";
}

if (isset ( $_POST ["upload"] )) {
	
	// Get the new coordinates to crop the image.
	$x1 = $_POST ["x1"];
	$y1 = $_POST ["y1"];
	$x2 = $_POST ["x2"];
	$y2 = $_POST ["y2"];
	$w = $_POST ["w"];  //I don't think this is used
	$h = $_POST ["h"];  //I don't think this is used
	
	//When a file is uploaded (by pushing the "upload" button on the form), it gets stored in
	//a temporary area on the server until it is moved. The file has to be moved from that area,
	//or it will be destroyed. In the meantime, the $_FILES[] superglobal array is filled up with
	//data about the uploaded file.
	// Get the file information from the server:
	$userfile_name = $_FILES ['image'] ['name'];
	$userfile_tmp = $_FILES ['image'] ['tmp_name'];
	$userfile_size = $_FILES ['image'] ['size'];
	$userfile_type = $_FILES ['image'] ['type'];
	$filename = basename ( $_FILES ['image'] ['name'] );
	$file_ext = strtolower ( substr ( $filename, strrpos ( $filename, '.' ) + 1 ) );
	
	// Only process if the file is a JPG, PNG or GIF and below the allowed limit
	if ((! empty ( $_FILES ["image"] )) && ($_FILES ['image'] ['error'] == 0)) {
		
		foreach ( $allowed_image_types as $mime_type => $ext ) {
			// loop through the specified image types and if they match the extension then break out
			// everything is ok so go and check file size
			if ($file_ext == $ext && $userfile_type == $mime_type) {
				$error = "";
				break;
			} else {
				$error = "Only <strong>" . $image_ext . "</strong> images accepted for upload<br />";
			}
		}
		// check if the file size is above the allowed limit
		if ($userfile_size > ($max_file * 1048576)) {
			$error .= "Images must be under " . $max_file . "MB in size";
		}
	} else {
		$error = "Select an image for upload";
	}
	// Everything is ok, so we can upload the image.
	if (strlen ( $error ) == 0) {

		if (isset ( $_FILES ['image'] ['name'] )) {
			
			//Use the ImageManipulator class to crop (and save?) the image
			$manipulator = new ImageManipulator( $_FILES ['image'] ['tmp_name']);
			$newImage = $manipulator->crop($x1, $y1, $x2, $y2);
			$manipulator->save($upload_path . 'cropped-' . $userfile_name);
			
			$large_image_location = $upload_path . $large_image_name . $_SESSION ['user_file_ext'];

			// put the file ext in the session so we know what file to look for once its uploaded
			$_SESSION ['user_file_ext'] = "." . $file_ext;
			$_SESSION["largeImageLocation"]=$large_image_location;

			chmod ( $large_image_location, 0777 );
			
			$width = getWidth ( $large_image_location );
			$height = getHeight ( $large_image_location );
			
			$_SESSION["height"]=$height;
			$_SESSION["width"]=$width;
			
			// Scale the image if it is greater than the width set above
			//is this used?
			if ($width > $max_width) {
				$scale = $max_width / $width;
				$uploaded = resizeImage ( $large_image_location, $width, $height, $scale );
			} else {
				$scale = 1;
				$uploaded = resizeImage ( $large_image_location, $width, $height, $scale );
			}
		}
		// Refresh the page to show the new uploaded image (?) 
		header ( "location:" . $_SERVER ["PHP_SELF"] );
		exit ();
	}
}

if ($_GET ['a'] == "delete" && strlen ( $_GET ['t'] ) > 0) {
	// get the file locations
	$large_image_location = $upload_path . $large_image_prefix . $_GET ['t'];

	if (file_exists ( $large_image_location )) {
		unlink ( $large_image_location );
	}

	header ( "location:" . $_SERVER ["PHP_SELF"] );
	exit ();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="generator" content="WebMotionUK" />
<title>WebMotionUK - PHP &amp; Jquery image upload &amp; crop</title>
<link rel="stylesheet" type="text/css"
	href="css/imgareaselect-default.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="jquery.imgareaselect.pack.js"></script>
<script type="text/javascript">
	function readURL(input) {
         if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            	//set blah's src to e.target.result
                $('#blah').attr('src', e.target.result);
                //see http://odyniec.net/projects/imgareaselect/examples.html 
                //for how to dictate a max height and width for the cropped image (maxWidth: 200, max height: 150, x1....
                $('#blah').imgAreaSelect({ aspectRatio: '5:8', x1: 22, y1: 33, x2: 100, y2: 145,
                    onSelectEnd: function (img, selection) {
                        $('#x1').val(selection.x1);
                        $('#y1').val(selection.y1);
                        $('#x2').val(selection.x2);
                        $('#y2').val(selection.y2);           
                    }
                })
            }

			//readAsDataURL returns the file as a data url
            reader.readAsDataURL(input.files[0]); 
        } 
    }
    </script>
</head>
<body>
	<!-- 
* Copyright (c) 2008 http://www.webmotionuk.com / http://www.webmotionuk.co.uk
* Date: 2008-11-21
* "PHP & Jquery image upload & crop"
* Ver 1.2
* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
* ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
* IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, 
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, 
* PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
* INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, 
* STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF 
* THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*
-->
	<!-- <ul>
	<li><a href="http://www.webmotionuk.com/php-jquery-image-upload-and-crop/">Back to project page & download</a></li>
</ul> -->
<?php
// Only display the javacript if an image has been uploaded
if (strlen ( $large_photo_exists ) > 0) {
	$current_large_image_width = getWidth ( $large_image_location );
	$current_large_image_height = getHeight ( $large_image_location );
	?>

<?php }?>
<?php
// Display message if there are any errors
if (strlen ( $error ) > 0) {
	echo "<ul><li><strong>Error!</strong></li><li>" . $error . "</li></ul>";
}
?>
	<form name="photo" enctype="multipart/form-data"
		action="" method="post">
		<h2>Enter your new Resource</h2>
		<h3>Resource Image:</h3>
		<input type="file" name="image" size="30" onchange="readURL(this);" /> 
		<br />
		<img id="blah" src="#" alt="" />
			<input type="hidden" name="x1" value="" id="x1" /> 
			<input type="hidden" name="y1" value="" id="y1" /> 
			<input type="hidden" name="x2" value="" id="x2" /> 
			<input type="hidden" name="y2" value="" id="y2" /> 
		<br />
		<input type="submit" name="upload" value="Upload" />
		<?php 
		if(isset($_SESSION['largeImageLocation'])){			
			echo("<div>Image \"");
			echo($_SESSION['largeImageLocation']);
			echo("\" was successfully uploaded.");
			echo("</div>");
			echo "<div><image src=\"";
			echo($_SESSION['largeImageLocation']);
			echo "\" alt=\"sucker!\" height=\"200\" width=\"144\"/></div>";
		} 
		?>
	</form>
  <!-- TODO - incorporate cropped image's height and width into above code so proportions aren't lost -->
<!-- Copyright (c) 2008 http://www.webmotionuk.com -->
</body>
</html>
