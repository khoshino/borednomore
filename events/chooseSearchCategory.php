<!DOCTYPE html>
<html>
<?php include("../import/utility.php");
$user_data = get_fbtoken($appid, $appsecret);
$user_fbid = ($user_data)? $user_data['user_id'] : 0;
?>
<head><title>EventCategorySelectionPage</title>
	<?php include("../import/header.php");?>
</head>

<body>

<div id="fb-root"></div>
<script>
 (function() {
  var e = document.createElement('script'); e.async = true;
  e.rsc = document.location.protocol + '//connect.facebook.net/en_US/all.js';
  document.getElementById('fb-root').appendChild(e);
 }());
 window.fbAsyncInit = function() {
  FB.init({ appId: '240585475995480',
            status: true,
            cookie: true,
            xfbml:  true,
            oauth:  true});
 };
 window.setTimeout(function() {
  FB.getLoginStatus(function(response) {
   if (response.authResponse) {
    ;
   } else {
    ; // not logged in
   }  
 })}, 500);
 
</script>
<div data-role = "page" id = "categorySelectionPage" data-title = "categorySelectionPage">
	<div data-role = "header">
		<h1 class = "pageTitleText"><b> Select a Type of Event </b></h1>
		<!-- Navigation Buttons- Change these links to link to different back pages or add links to new pages-->
		<a href = "./events.php" class = "headerButton" data-ajax = "false" data-icon="back" data-direction="reverse">Back</a>
		<a href = "../index.php" class = "headerButton" data-icon="home" data-ajax="false">Home</a>
	</div>

	<div data-role = "content" id = "categorySelectionPageContent">
		
		
		<form action="searchListings.php" method="post" data-ajax="false">
		<button name="category" value="food" type="submit" target="searchListings.php " data-ajax="false">
			<img src="../icons/food.png" algin=left>
			Food
		</button>
		<button name="category" value="sport" type="submit" target="searchListings.php" data-ajax="false">Sports</button>
		<button name="category" value="game" type="submit" target="searchListings.php" data-ajax="false">Games</button>
		<button name="category" value="watch" type="submit" target="searchListings.php" data-ajax="false">Film</button>
		<button name="category" value="study" type="submit" target="searchListings.php" data-ajax="false">Study</button>
		<button name="category" value="other" type="submit" target="searchListings.php" data-ajax="false">Other</button>
		<input type="hidden" value="<?php echo $user_fbid;?>" name="fbid"/>
		</form>
		
	</div>
	<div data-role = "footer"><h1 class = "pageTitleText">Bored No More</h1></div>
</div>

</body>

</html> 
