<!DOCTYPE html>
<html>
<head><title>EventCategorySelectionPage</title>
	<!--scripts to use JQuery Mobile-->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 
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
		
		
		<form action="searchListings.php" method="post">
		<button name="category" value="food" type="submit" target="searchListings.php " rel = "external">Let's Eat</button>
		<button name="category" value="sport" type="submit" target="searchListings.php" rel = "external">Let's Play a Sport</button>
		<button name="category" value="games" type="submit" target="searchListings.php" rel = "external">Let's Play a Game</button>
		<button name="category" value="watch" type="submit" target="searchListings.php" rel = "external">Let's Watch Something</button>
		<button name="category" value="study" type="submit" target="searchListings.php" rel = "external">Let's Study</button>
		<button name="category" value="other" type="submit" target="searchListings.php" rel = "external">Let's Do Something Else</button>
		
		</form>
		
	</div>
	<div data-role = "footer">footer...</div>
</div>

</body>

</html> 