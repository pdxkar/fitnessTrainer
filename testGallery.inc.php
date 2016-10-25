<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="generator" content="WebMotionUK" />
<title>WebMotionUK - PHP &amp; Jquery image upload &amp; crop</title>

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript"></script>

<script type="text/javascript" src="js/image_slider.js"></script>
<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="gallery.css">
		<script>
var sliderMax = sliderWidth = sliderLeft = 0;
function addImages(){
  var images = ["bigBear", "eagleFishBench", "benchFishCloseup", 
	  "eaglesInTheCity2", "heron", "bearsInTheCity", "goAwayBear", "bears", "raccoonbutt", "turtle", 
                "smallBear", "gnome", "bearsInTheCity4", "eagleInTheCity", "woodDeer", 
                "bearsInTheCityToo", "eagle", "bearsAndChild",
                "monster", "turtleBack", "bearsInTheCity3"];
  for (i in images){ 
    $("#imageSlide").append('<img src="images/'+ 
                            images[i] + '.jpg" />'); }
  setTimeout(function() {
      $("#imageSlide img").each(function(){ 
        sliderWidth += $(this).width() + 26; });
      sliderWidth += 40; 
      $("#imageSlide").width(sliderWidth);
      sliderMax = $("#selector").width() - sliderWidth;
    }, 1000);
}
function slide(value){
  var oldLeft = sliderLeft; 
  sliderLeft = sliderLeft + value;
  if (sliderLeft >= 0) { sliderLeft = 0; }
  if (sliderLeft <= sliderMax) { sliderLeft = sliderMax; }
  if(oldLeft != sliderLeft) { 
    $("#imageSlide").animate({left:sliderLeft}, 300, 'linear', 
        function(){ 
          slide(value); });
  }
  return false;
}

/* set the photo as the featured image of the slider */
function setPhoto(){
  var newPhoto = $(this).attr("src");
  $("#photo img").stop(true).fadeTo(500, .1, "linear", 
    function (){
      $("#photo img").attr("src", newPhoto); 
    });
   $("#photo img").css({width:"91%",height:"auto"}); 

	
   
  $("#photo img").fadeTo(500, 1);
  return false;
}





/* function myFunction(){
  var maxHeight = Math.max($(document).height(), $(window).height());
  alert(maxHeight); 
  $(".tempWelcome").css({height:maxHeight}); 
} */

/* $('#topGallery img').each(function() {
	if( this.complete ) {
	    imageLoaded.call( this );
	} else {
	    $(this).one('load', imageLoaded);
	}
	}); */

/* 	$("#photo img").load(function(){
		  alert("ginko!");
	/* 		  var maxHeight = Math.max($(document).height(), $(window).height());
		  alert(maxHeight); 
		  $(".tempWelcome").css({height:maxHeight});  */
	//}); */

$(document).ready(function(){
  addImages();
  $("#left").mouseenter(function(){ 
    slide(50); });
  $("#left").mouseleave(function(){ 
    $("#imageSlide").stop(true); return false; });
  $("#right").mouseenter(function(){ 
    slide(-50); });
  $("#right").mouseleave(function(){ 
    $("#imageSlide").stop(true); return false; });
  $("#imageSlide img").mouseenter(function(){ 
    $(this).stop(true).animate({height:120, opacity:1},500); 
                               return false; });
  $("#imageSlide img").mouseleave(function(){ 
    $(this).stop(true).animate({height:"100%", opacity:.5},500); 
                               return false; });
  $("#imageSlide img").click(setPhoto);

  $("#imageSlide img:first").click();
});
    </script>

</head>
<body>
	<div id="tempHeading">
		<h1>Knot Just a Bear Chainsaw Carvings</h1>
	</div>
	<!-- wrapper containing welcome box and viewer box -->
	<div id="#welcomeAndViewerWrapper">
		<div class='tempWelcome'>
	  		<?php
				echo "<p><span>Welcome to</span><span style=\"font-size:30px\"> Knot Just a Bear</span>";
				echo "<span>, a collection of wildlife carvings to 
				brighten your yards and homes.  In addition to the items in the gallery,
				We offer on-site carving services, custom orders, and stump-grinding services.  
				Local estimates are free.  Our carvings are found in many of our neighbors' backyards and
				in front of local businesses, as well as sites in Utah, Hawaii, and California.  Artist Robert 
				Tidwell participates and wins national wood and ice carving competitions, and has participated in many
				carving exhibitions for grand-openings, festivals, and other celebrations. ";
				echo "<br /><br />";
				echo "For more information or to see our current inventory, please come and visit Knot
				Just a Bear at 29203 Washington Way in Ranier OR or give us a call at 503.438.5385.  We are open
				most days except Sundays.
				</span></p> ";
			?>
  		</div>
  		<!-- viewer = entire image box containing the slider and featured image area -->
		<div id="viewer">
			<div id="left">
				<img src="images/left.png" />
			</div>
			<!--  selector is the slider box container -->
			<div id="selector">
				<div id="imageSlide"></div>
			</div>
			<div id="right">
				<img src="images/right.png" />
			</div>
			<!-- photo = featured photo -->
			<div id="photo">
				<img src="" />
				<script>
				$("#photo img").load(function(){
				  //var maxHeight = Math.max($(document).height(), $(window).height());
				 // alert(maxHeight); 
				//  $(".tempWelcome").css({height:maxHeight});  
					var myHeight = $("#photo img").height();
					alert(myHeight);
					$(".tempWelcome").css({height:myHeight+180});  
				}); 
				</script>
			</div>
		</div>
	</div>
	<div id="footer">
		<h2>&#169; 2016 Thistledown Software Company</h2>
	</div>
</body>
</html>
