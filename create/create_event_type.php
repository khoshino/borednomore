<!DOCTYPE html>
<html>
<head><title>EventCategorySelectionPage</title>
	<!--scripts to use JQuery Mobile-->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 
</head>
<!--
function redirectToCreate( category){
	console.log("category is" + category);
	window.location.href='create_event.php';
	
}
-->
<body>
<div data-role = "page" id = "categorySelectionPage" data-title = "categorySelectionPage">
	<div data-role = "header">
		<h1 class = "pageTitleText"><b> Select a Type of Event </b></h1>
		<!-- Navigation Buttons- Change these links to link to different back pages or add links to new pages-->
		<a href = "../index.php">Back</a>
		<a href = "../index.php" >Home</a>
	</div>

	<div data-role = "content" id = "categorySelectionPageContent">
		<!--
			<button onclick=" window.location.href='create_event.php'">
		<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Sports" />
		<br />Sports
		</button>
		<br/>
		<button onclick=" window.location.href='create_event.php'">
		<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Games" />
		<br />Games
		</button>
		<br/>
		<button onclick="window.location.href='create_event.php'">
		<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Study" />
		<br />Study
		</button>
		<br/>
		<button onclick=" window.location.href='create_event.php'">
		<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Other" />
		<br />Other
		</button>
		<br/>
		-->
		
		
		<form action="create_event.php" method="post">
		<button name="type" value="food" type="submit" target="create_event.php">Let's Eat</button>
		<button name="type" value="sport" type="submit" target="create_event.php">Let's Play a Sport</button>
		<button name="type" value="game" type="submit" target="create_event.php">Let's Play a Game</button>
		<button name="type" value="watch" type="submit" target="create_event.php">Let's Watch Something</button>
		<button name="type" value="study" type="submit" target="create_event.php">Let's Study</button>
		<button name="type" value="other" type="submit" target="create_event.php">Let's Do Something Else</button>
		
		<!--src="http://borednomore.cs147.org/icons/food.png" -->
		</form>
		
	</div>
	<div data-role = "footer">footer...</div>
</div>

</body>

</html> 