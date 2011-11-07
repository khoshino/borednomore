<!DOCTYPE html>
<?
$con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
$success = false;
if (!$con)
    {
        die('Could not connect:' . mysql_error());
    }
mysql_select_db("khoshino_mysql", $con);
	$query = "SELECT * FROM `events` WHERE `category` = 'games' ORDER BY `name` ASC";
	
 $result = mysql_query($query, $con);
 
 $title = $_POST["eventTitle"];
 $fbid  = 5525335; // temporary facebook id. I don't know who this is.
 $loc   = $_POST["location"];
 $category = "games";
 $hour  = intval($_POST["select-hour"]);
 $min   = intval($_POST["select-min"]);
 $ampm  = intval($_POST["select-amPm"]);
 $starthour = -1;
	

mysql_close($con);

?>

<html>
<head><title>SearchEventsPage</title>
	<!--scripts to use JQuery Mobile-->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 
	<script>
		function CreateEventPage(eventArray){
			$($eventPages).append("testing javascript function");
			alert("entered javascript EcreateEventPage funciton!");
		}
	</script>
</head>
<body>


<div data-role = "page" id = "searchEvents" data-title = "searchEvents">
	<div data-role = "header">
		<h1 class = "pageTitleText"> Search Events </h1>
		<!-- Navigation Buttons-- Change these links to link to different back pages or add links to new pages-->
		<a href = "../index.php">Back</a>
		<a href = "../index.php" >Home</a>
	</div>
	
	<div data-role = "content" id = "searchEventsContent">
		<div id="menu" >
		
		<h1 class = "pageTitleText"><b> Search Menu</b> </h1>
		<button onclick = "window.location.href='eventsbytime.php'">
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Category" />
			Category
		</button>
		
		<button onclick = " window.location.href='eventsbytime.php'">
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Location" />
			Location
		</button>
		
		<button onclick = " window.location.href='eventsbytime.php'">
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Time" />
			Time
		</button>
		</br>
			
		</div>	
		<div id = "searchResults">
		<?php
		echo 'sql is:' . $query. '<br/>';
		echo 'result is:' . $result . '<br/>';
		$numRows =  mysql_num_rows($result);
		echo 'numRows:' . $numRows;
		
		for( $i = 0; $i < $numRows; $i++){
		  $eventArray = mysql_fetch_array($result);
		  print_r($eventArray);
		 
			$eventPages.apppend("PHP Test append <br/>");
			 CreateEventPage($eventArray);
		  
		  echo "<br/>";
		}
		/*
		while($row = mysql_fetch_row($result)){
		  echo " Row:" . $row . "<br/> $row[0]:" . $row[0] . "<br/>$row[1]:" . $row[1] . "<br/>event id:" . $row["e_id"] . "<br/> name:" . $row["name"] . "<br/> category:".  $row["category"] . "<br/>
			description:" . $row["description"] . "<br/>";
		  print_r(mysql_fetch_assoc($result));
		  echo '<br/>';
		}
		*/
		?> 
			<ul>
			<li> "TEST"
			
			<li> "event1"
			<li> "event2"
			<li> "event3"
			</ul>
			<div id = "eventPages"> </div>
		</div>
	</div>
	<div 
	<div data-role = "footer">footer...</div>

</body>
</html>