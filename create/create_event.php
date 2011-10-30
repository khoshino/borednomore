<!DOCTYPE html>
<html>
<head>
<title>CreateEventsPage</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 	
</head>

<body>



<div data-role="page" id = "createEvent" data-title="createEvent"> 
	<div data-role="header">
		<h1 class = "pageTitleText"><b> Create an Event </b></h1>
		<button onclick="JavaScript:alert('Going to Previous Page!')">Back</button>
		<button onclick = "JavaScript:alert('Going home!')">Home</button>
		<button data-direction = "reverse">Back2</button>
		<a href = "#nextPage" >to next page </a>
		<a href = "../index.php" >to Index</a>
		<br/>
	</div> 
	
	<div data-role="content">
		<p> Required fields are marked with an '*' </p>
		<form id = "createEventForm" >
		*Title: <input type="text" name="eventTitle" required="required" /><br />
		*Location: <input type="text" name="location" required="required" /><br />
		*Creator: <input type="text" name="creator" required="required" /><br /><br/>
		<!--Description:<input type="textarea" name="description" value="Write a description of your event here!" size="30" onfocus="value=''"><br />-->
		Description: <br />
		<textarea id = "description" rows="4" cols="60" > 
			 A description of your awesome event! 
		</textarea><br/>	
		<input type = "submit" value ="Create Event!"<br />
		</form>
	</div> 
	<div data-role="footer">...</div> 
</div> 

<div data-role = "page" id = "nextPage" data-title = "nextPage">
	<div data-role = "header">
		<h1 class = "pageTitleText"><b>Next page </b></h1>
		<a href = "#createEvent" >to create page </a>
		<a href = "../index.php" >toIndex</a>
		<a href = "../index.php " data-direction = "reverse">toIndex reverse</a>
	</div>
	<div data-role = "content">
		<p> testing </p>
	</div>
</div>




</body>

</html> 