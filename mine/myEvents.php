<!DOCTYPE html>
<?php
 $con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
 $success = false;
 if (!$con)
 {
  die('Could not connect: ' . mysql_error());
 }
    
 $title = $_POST["eventTitle"];
 $loc   = $_POST["location"];
 $category = "games";
 $hour  = $_POST["select-hour"];
 $min   = $_POST["select-min"];
 $ampm  = $_POST["select-amPm"];
 $hour_d= $_POST["select-hour-dur"];
 $min_d = $_POST["select-min-dur"];
 $public= $_POST["radio"];
 $desc  = $_POST["eventDescription"];
 
 $add_to_database = true;
 if (gettype($title) != "string" || strlen($title) <= 0 || strlen($title) > 40)
  $add_to_database = false;
 if (gettype($loc) != "string" || strlen($loc) <= 0 || strlen($loc) > 80)
  $add_to_database = false;
 if (gettype($category) != "string" || strlen($category) <= 0 || strlen($category) > 30)
  $add_to_database = false;


    
 //mysql_select_db("khoshino_mysql", $con);
    
 //mysql_query("INSERT INTO events (name, location, category, start_time, duration, private) VALUES ('','','','','','')"); 
    
 mysql_close($con);
    
?>
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

    /*
	function checkForm()
	{
	  var eventTitle = $("#eventTitle").val();
	  var eventName  = $("#eventLocation").val();
	  var checked    = $('input:radio[name=radio]:checked').val();
	  var isPublic   = $("#radio-public").val();
	  var isPrivate  = $("#radio-private").val();
	  var eventDesc  = $("#eventDescription").val();
	  var startHour  = parseInt($("#select-hour").val());
	  var startMin   = parseInt($("#select-min").val());
	  var startAMPM  = parseInt($("#select-amPm").val()); // PM == 12, AM == 0
	  var duration   = parseInt($("#select-hour-dur").val());
	  var durationmin= parseInt($("#select-min-dur").val());
	}
	function insertDatabase()
	{
	}
	function handleSubmit()
	{
	   checkForm();
	}
    */
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
		<?php 
		 echo "title: " . $title . "<br/>";
		 echo "location: " . $loc  . "<br/>";
		 echo "hour, min: " . ($hour + $ampm) . ", " . $min . "<br/>";
		 echo "duration: " . $hour . " hours and " . $min . " minutes<br/>";
		 echo "publicness: " . $public . "<br/>";
		 echo "description: " . $desc . "<br/>";
		 echo "current time: " . date('Y-m-d H:i:s') . "<br/>";
		?>
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
