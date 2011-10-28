<!DOCTYPE html>
<html>
<head>
<title>SearchEventsPage</title>
</head>

	<body>
	<button onclick="JavaScript:alert('Going to Previous Page!')">Back</button>
	<button onclick = "JavaScript:alert('Going home!')">Home</button>
	<br/>
	
	<div id="menu" >
		
		<h1 ><b> Search Menu</b> </h1>
		<button onclick = "JavaScript:alert('searching by Category'); window.location.href='eventsbytime.php'">
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Category" />
			Category
		</button>
		
		<button onclick = "JavaScript:alert('searching by Location'); window.location.href='eventsbytime.php'">
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Location" />
			Location
		</button>
		
		<button onclick = "JavaScript:alert('searching by TIME'); window.location.href='eventsbytime.php'">
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Time" />
			Time
		</button>
		</br>
		
	</div>	
	<div id = "searchResults">
		<ul>
		<li> "event1"
		<li> "event2"
		<li> "event3"
		</ul>
	</div>
	</body>
	
</html>