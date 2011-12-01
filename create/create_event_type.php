<!DOCTYPE html>
<html>
<head><title>EventCategorySelectionPage</title>
	<?php include("../import/header.php");?>
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
		<a href = "../index.php" class = "headerButton" data-icon="back" data-direction="reverse">Back</a>
		<a href = "../index.php" class = "headerButton" data-icon="home" data-ajax="false">Home</a>
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
	<div data-role = "footer"><h1 class = "pageTitleClass">Bored No More</h1></div>
</div>

</body>

</html> 