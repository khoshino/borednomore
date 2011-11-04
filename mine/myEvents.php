<!DOCTYPE html>
<html>
<head><title>MyEvents</title>
	<!--scripts to use JQuery Mobile-->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 
</head>
<!--
So the events should be populated based on what you have joined, so some 
sort of script that populates the event name, url, and wall url, yeah?
-->
<body>
<div data-role = "page" id = "myEvents" data-title = "myEvents"> 
	<div data-role = "header">
		<h1 class = "pageTitleText">My Events</h1>
		<!-- Navigation Buttons-- Change these links to link to different back pages or add links to new pages-->
		<a href = "../index.php">Back</a>
		<a href = "../index.php" >Home</a>
	</div>
	<div data-role = "content" id = "myEventsContent">			
		<form method="link" action="../index.php">
		<input type="submit" value="Home"></form>
		<ul>
		<li><a href="???">Event #1</a>'s <a href="???">Wall</a></li>
		<li><a href="???">Event #2</a>'s <a href="???">Wall</a></li>
		<li><a href="???">Event #3</a>'s <a href="???">Wall</a></li>
		<li><a href="???">Event #4</a>'s <a href="???">Wall</a></li>
		<li><a href="???">Event #5</a>'s <a href="???">Wall</a></li>
		<li><a href="???">Event #6</a>'s <a href="???">Wall</a></li>
		</ul>

		<a href="../index.php">Back to Main</a>
	</div>
	</div data-role = "footer"> footer...</div>
</div>

</body>

</html>
