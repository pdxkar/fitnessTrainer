<h1><br>&nbsp;&nbsp;Fitness Trainer</h1>
<h4><em> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"xxx"</em></h4>
<br />
<br />
<div class='container'>
	<?php 
		
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

		//if logged in
		if (isset($_SESSION['valid_recipe_user'])) {
			echo "<ul class=\"nav nav-pills\">";
			echo "<li class=\"active\"><a href=\"index.php?\">Home</a></li>";
			echo "<li class=\"dropdown\">";
			echo "<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Posts <b class=\"caret\"></b></a>";
			echo "<ul class=\"dropdown-menu\">";
			echo "<li><a href=\"newresource.inc.php?\">Add Resource</a></li>";
			echo "<li><a href=\"selectResourceToEdit.inc.php?\">Edit Resource</a></li>";
			echo "<li><a href=\"selectResourceToDelete.inc.php?\">Delete Resource</a></li>";
			echo "<li><a href=\"newfeature.inc.php?\">Add Feature</a></li>";
			echo "<li><a href=\"selectFeatureToEdit.inc.php?\">Edit Feature</a></li>";
			echo "<li><a href=\"selectFeatureToDelete.inc.php?\">Delete Feature</a></li>";
			echo "<li><a href=\"newessay.inc.php?\">Add Essay</a></li>";
			echo "<li><a href=\"selectEssayToEdit.inc.php?\">Edit Essay</a></li>";
			echo "<li><a href=\"selectEssayToDelete.inc.php?\">Delete Essay</a></li>";
			echo "<li><a href=\"testGallery.inc.php?\">Test Gallery</a></li>";
			echo "<li class=\"divider\"></li>";
			echo "<li><a href=\"thistledownSoftwareCompany.inc.php\">Thistledown Software Company</a></li>";
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
			echo "<li><a href=\"thistledownSoftwareCompany.inc.php\">Thistledown Software Company</a></li>";
			echo "</ul>";
			echo "</li>";
			echo "</ul>";
		} else {
		//if not logged in	
			echo "<ul class=\"nav nav-pills\">";
			echo "<li class=\"active\"><a href=\"index.php?\">Home</a></li>";
			echo "<li class=\"dropdown\">";
			echo "<a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\">Posts <b class=\"caret\"></b></a>";
			echo "<ul class=\"dropdown-menu\">";
			echo "<li><a href=\"testGallery.inc.php?\">Test Gallery</a></li>";
			echo "<li class=\"divider\"></li>";
			echo "<li><a href=\"thistledownSoftwareCompany.inc.php\">Thistledown Software Company</a></li>";
			echo "</ul>";
			echo "</li>";
			echo "<ul class=\"nav navbar-nav navbar-right\">";
			echo "<li><a href=\"login.inc.php?\">Login</a></li>";
			echo "<li><a href=\"register.inc.php?\">Register</a></li>";
			echo "</ul>";
			echo "</ul>";
		}
	?>

</div>
