<h1><br>The Distillery</h1>
<h4><em> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Things to take into your day"</em></h4>
<br />
<br />
<div class='container'>
	<?php 
		session_start();
		//if logged in
		if (isset($_SESSION['valid_recipe_user'])) {
			echo "<ul class=\"nav nav-pills\">";
			echo "<li class=\"active\"><a href=\"index.php?\">Home</a></li>";
			echo "<li class=\"dropdown\">";
			echo "<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Posts <b class=\"caret\"></b></a>";
			echo "<ul class=\"dropdown-menu\">";
			echo "<li><a href=\"testGallery.inc.php?\">See Test Gallery</a></li>";
			echo "<li><a href=\"newresource.inc.php?\">Add Resource</a></li>";
			echo "<li><a href=\"newfeature.inc.php?\">Add Feature</a></li>";
			echo "<li><a href=\"newessay.inc.php?\">Add Essay</a></li>";
			echo "<li><a href=\"upload_crop.inc.php?\">upload photo demo</a></li>";
			echo "<li><a href=\"form.inc.php?\">Image Form</a></li>";
			echo "<li class=\"divider\"></li>";
			echo "<li><a href=\"#\">Trash</a></li>";
			echo "</ul>";
			echo "</li>";
			echo "<li class=\"dropdown pull-right\">";
			echo "<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">";
			echo "signed is as: ";
			echo $_SESSION['valid_recipe_user'];
			echo "<b class=\"caret\"></b></a>";
			echo "<ul class=\"dropdown-menu\">";
			echo "<li><a href=\"logout.inc.php?\">Logout</a></li>";
			echo "<li class=\"divider\"></li>";
			echo "<li><a href=\"#\">SettingsXXX</a></li>";
			echo "</ul>";
			echo "</li>";
			echo "</ul>";
		} else {
		//if not logged in	
			echo "<ul class=\"nav nav-pills\">";
			echo "<li class=\"active\"><a href=\"index.php?\">Home</a></li>";
			echo "<ul class=\"nav navbar-nav navbar-right\">";
			echo "<li><a href=\"login.inc.php?\">Login</a></li>";
			echo "<li><a href=\"register.inc.php?\">Register</a></li>";
			echo "</ul>";
			echo "</ul>";
		}
	?>

</div>
