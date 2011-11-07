<!DOCTYPE html>
<?
$con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
$success = false;
if (!$con)
    {
        die('Could not connect:' . mysql_error());
    }
mysql_select_db("khoshino_mysql", $con);
	$query = "SELECT *\n"
    . "FROM `events`\n"
    . "WHERE `category` = \'games\'\n"
    . "\n"
    . "ORDER BY `name` ASC\n"
    . "LIMIT 0 , 30";
	
 $result = mysql_query(query);
 $sql = "SELECT *\n"
    . "FROM `events`\n"
    . "WHERE `category` = \'games\'\n"
    . "\n"
    . "ORDER BY `name` ASC\n"
    . "LIMIT 0 , 30";
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
</head>
<body>
<div>
<p>
<?php
		while($row = mysql_fetch_row($sql)){
		  echo $row[0] ;
		  echo '<br/>';
		}
?> 
</p>
</div>

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
		<?php
		echo "sql is:" . $sql;
		echo "result is:" . $result;
		
		while($row = mysql_fetch_row($sql)){
		  echo $row[0] ;
		  echo '<br/>';
		}
		?> 
			<ul>
			<li> "event1"
			<li> "event2"
			<li> "event3"
			</ul>
		</div>
	</div>
	<div data-role = "footer">footer...</div>

</body>
</html>