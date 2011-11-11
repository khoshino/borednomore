<!DOCTYPE html>
<html>
<head><title>EventCategorySelectionPage</title>
	<?php include("../import/header.php");?>
</head>

<body>
<div data-role = "page" id = "categorySelectionPage" data-title = "categorySelectionPage">
	<div data-role = "header">
		<h1 class = "pageTitleText"><b> Select a Type of Event </b></h1>
		<!-- Navigation Buttons- Change these links to link to different back pages or add links to new pages-->
		<a href = "/searchListings.php" rel = "external" >Back</a>
		<a href = "../index.php" >Home</a>
	</div>

	<div data-role = "content" id = "categorySelectionPageContent">
		
		
		<form action="searchListings.php" method="post" data-ajax="false">
		<button name="category" value="food" type="submit" target="searchListings.php " data-ajax="false">Let's Eat</button>
		<button name="category" value="sport" type="submit" target="searchListings.php" data-ajax="false">Let's Play a Sport</button>
		<button name="category" value="games" type="submit" target="searchListings.php" data-ajax="false">Let's Play a Game</button>
		<button name="category" value="watch" type="submit" target="searchListings.php" data-ajax="false">Let's Watch Something</button>
		<button name="category" value="study" type="submit" target="searchListings.php" data-ajax="false">Let's Study</button>
		<button name="category" value="other" type="submit" target="searchListings.php" data-ajax="false">Let's Do Something Else</button>
		
		</form>
		
	</div>
	<div data-role = "footer">footer...</div>
</div>

</body>

</html> 
