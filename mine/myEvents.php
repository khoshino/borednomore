<!DOCTYPE html>
<?php
 include "../utility.php";
 /*** Initialize connection with Database here ***/
 $con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
 $success = false;
 $failure_reason = "";
 if (!$con)
 {
  die('Could not connect: ' . mysql_error());
 }
 // Here in this mess of code, we validate the form server-side 
 /*** Initialize all the column variables here ***/
 $title = $_POST["eventTitle"];
 $fbid  = 5525335; // temporary facebook id. I don't know who this is.
 $loc   = $_POST["location"];
 $category = $_POST["eventType"];
 $hour  = intval($_POST["select-hour"]);
 $min   = intval($_POST["select-min"]);
 $ampm  = intval($_POST["select-amPm"]);
 $starthour = -1;
 if (gettype($hour) == "integer" && gettype($ampm) == "integer" && gettype($min) == "integer" && $hour >= 1 && $hour <= 12 && ($min == 0 || $min == 15 || $min == 30 || $min == 45) && ($ampm == 0 || $ampm == 12))
  $starthour = $hour + $ampm;
 $hour_d= intval($_POST["select-hour-dur"]);
 $min_d = intval($_POST["select-min-dur"]);
 $duration = -1;
 if (gettype($hour_d) == "integer" && gettype($min_d) == "integer" && ($hour_d >= 1 && $hour_d <= 12) && ($min_d == 0 || $min_d == 15 || $min_d == 30 || $min_d == 45))
  $duration = $hour_d * 60 + $min_d;
 $public= $_POST["radio"];
 $isPrivate = -1;
 if ($public == "public")
  $isPrivate = 0;
 if ($public == "private")
  $isPrivate = 1;
 $desc  = $_POST["eventDescription"];
 $cur_date = date("Y-m-d");
 $start_time = -1;
 $fbtoken = get_fbtoken($appid, $appsecret);
 $user_id = 0;
 if ($fbtoken != null) {
  $user_id = intval($fbtoken['user_id']);
 }

 /*** Do basic security by checking input server-side here ***/
 if ($starthour > -1)
  $start_time = $cur_date . " " . $starthour . ":" . $min . ":00"; 
 $add_to_database = true;
 $failure_loc = -1;
 if (gettype($title) != "string" || strlen($title) <= 0 || strlen($title) > 40) {
  $add_to_database = false;
  $failure_loc = 0;
 }
 if (gettype($category) != "string" || !($category == 'food' || $category == 'sport' || $category == 'game' || $category == 'watch' || $category == 'study' || $category == 'other')) {
  $add_to_database = false;
  $failure_loc = 8;
 }
 if (gettype($user_id) != 'integer' || $user_id == 0 || $user_id == -1) {
  $add_to_database = false;
  $failure_loc = 9;
 }
 if (gettype($loc) != "string" || strlen($loc) <= 0 || strlen($loc) > 80) {
  $add_to_database = false;
  $failure_loc = 1;
 }
 if (gettype($category) != "string" || strlen($category) <= 0 || strlen($category) > 30)
 {
  $add_to_database = false;
  $failure_loc = 2;
 }
 if ($start_time == -1)
 {
  $add_to_database = false;
  $failure_loc = 3;
 }
 if ($duration == -1)
 {
  $add_to_database = false;
  $failure_loc = 4;
 }
 if ($isPrivate == -1)
 {
  $add_to_database = false; 
  $failure_loc = 5;
 }
 if (gettype($desc) != "string" || strlen($desc) > 255)
 {
  $add_to_database = false;
  $failure_loc = 6;
 }
 if (gettype($fbid) != "integer" || $fbid < 0)
 {
  $add_to_database = false;
  $failure_loc = 7;
 } 

 /*** Add to Database Here ***/
 if ($add_to_database) {
  mysql_select_db("khoshino_mysql", $con);
  $query = "INSERT INTO events (name, creator_fbid, location, category, start_time, duration, private, description) VALUES('". mysqL_real_escape_string($title) ."', '". $user_id ."', '". mysql_real_escape_string($loc) ."', '". mysql_real_escape_string($category) ."', '". $start_time ."', '". $duration ."', '". $isPrivate ."','". mysql_real_escape_string($desc) ."')";
  //$success = mysql_query("INSERT INTO events (name, location, category, start_time, duration, private) VALUES ('" . mysql_real_escape_string($title) . "','" . mysql_real_escape_string($loc) . "','" . mysql_real_escape_string($category) . "','" . $start_time ."','" . $duration . "','" . $isPrivate . "')"); 
  $success = mysql_query($query);
  if (!$success)
   $failure_reason = mysql_error($success);
  //$query = "INSERT INTO participants (e_id, fbid, creator) VALUES('" . 

 }

 /*** Close connection with Database ***/
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
		 echo "category: " . $category . "<br/>";
		 echo "user_id: " . gettype($user_id) . "<br/>";
		 if ($add_to_database)
		  echo "database input was successful!<br/>";
		 else
		  echo "database input failed because: " . $failure_loc . "<br/>";
		 echo "success result: " . $success;
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
