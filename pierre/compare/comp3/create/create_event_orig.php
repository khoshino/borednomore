<!DOCTYPE html>
<html>
<head>
<title>CreateEventsPage</title>

</head>

<body>
<button onclick="JavaScript:alert('Going to Previous Page!')">Back</button>
<button onclick = "JavaScript:alert('Going home!')">Home</button>
<br/>
<h1><b> Create an Event </b></h1>

<p> Required fields are marked with an '*' </p>
	<form id = "createEventForm" >
	*Title: <input type="text" name="title" required="required" /><br />
	*Location: <input type="text" name="location" required="required" /><br />
	*Creator: <input type="text" name="creator" required="required" /><br /><br/>
	<!--Description:<input type="textarea" name="description" value="Write a description of your event here!" size="30" onfocus="value=''"><br />-->
	Description: <br />
	<textarea id = "description" rows="4" cols="60" > 
		 A description of your awesome event! 
	</textarea><br/>	
	<input type = "submit" value ="Create Event!"<br />
	</form>
</body>

</html> 