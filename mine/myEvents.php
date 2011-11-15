<!DOCTYPE html>
<?php
 include "../import/utility.php";
 /*** Initialize connection with Database here ***/
 $con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
 $success = false;
 $success_myevents = false;
 $failure_reason = "";
 $failure_reason_myevents = "";
 $myevents = array();
 if (!$con)
 {
  die('Could not connect: ' . mysql_error());
 }

 /*** Initialize all the column variables here ***/
 $e_id  = 0; // This gets retrieved after mysql_query
 $title = $_POST["eventTitle"];
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

 /*** Add to Database Here ***/
 if ($add_to_database) {
  mysql_select_db("khoshino_mysql", $con);
  $query = "INSERT INTO events (name, creator_fbid, location, category, start_time, duration, private, description) VALUES('". mysqL_real_escape_string($title) ."', '". $user_id ."', '". mysql_real_escape_string($loc) ."', '". mysql_real_escape_string($category) ."', '". $start_time ."', '". $duration ."', '". $isPrivate ."','". mysql_real_escape_string($desc) ."')";
  $success = mysql_query($query);
  $e_id = mysql_insert_id();

  if (!$success)
   $failure_reason = mysql_error($success);
  $query = "INSERT INTO participants (e_id, fbid, creator) VALUES('". $e_id ."', '". $user_id ."', '1')";
  $success = mysql_query($query);
  if (!$success)
   $failure_reason = mysql_error($success);

 }

 /*** Get User-Related Events from Database Here ***/
 $fbtoken = get_fbtoken($appid, $appsecret);
 if ($fbtoken != null) {
  mysql_select_db("khoshino_mysql", $con);
  $query = "SELECT events.*, participants.fbid FROM events, participants WHERE participants.fbid='".$fbtoken['user_id']."' AND participants.e_id = events.e_id ORDER BY events.start_time ASC";
  $success_myevents = mysql_query($query); 
  if (!$success_myevents) 
   $failure_reason_myevents = mysql_error($success_myevents);
   while ($row = mysql_fetch_array($success_myevents)) {
    $myevents[] = $row;
   }
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
<body>
<div data-role = "page" id = "myEvents" data-title = "myEvents"> 
 <div data-role = "header">
  <h1 class = "pageTitleText">My Events</h1>
  <!-- Navigation Button Change these links to link to different back pages or add links to new pages-->
  <a href = "../index.php">Back</a>
  <a href = "../index.php" >Home</a>
 </div>
 <div data-role = "content" id = "myEventsContent">
  <?php 
   if ($add_to_database)
    ;//echo "database input was successful!<br/>";
   //if (!$success)
   // echo "failure reason: " . $failure_reason . "<br/>";
   if ($success_myevents) {
    foreach ($myevents as $event) {
     echo "<a href = '#event_" . $event['e_id'] . "' data-role='button' data-icon='arrow-r' data-iconpos='right'>" . alphanumeric($event['name']) . " </a>"; 
    }
   } else {
    ;//echo "failure reason for my_events: " . $failure_reason_myevents . "<br/>";
   }
  ?>

 </div>
 <div data-role = "footer"> footer...</div>
</div>
<?php
 if ($success_myevents) {
  $multipages = '';
  foreach ($myevents as $row) {
   $name_safe = alphanumeric($row['name']);
   $loc_safe  = alphanumeric($row['location']);
   $desc_safe = trimharmful($row['description']);
   $hours     = get_hours($row['duration']);
   $hourstr   = ($hours == 1) ? 'hour' : 'hours';
   $minutes   = get_minutes($row['duration']);
   $minutesstr= (!$minutes) ? '' : 'and ' . $minutes . ' minutes';
   $privatestr= ($private) ? 'Private Event' : 'Public Event';
   $multipages .= <<<MULTI
<div data-role = "page" id = "event_$row[e_id]" data-title = "$name_safe">
 <div data-role = "header">
  <h1 class = "pageTitleText">$name_safe</h1>
  <a href = "#myEvents" data-direction = "reverse">Back</a>
  <a href = "../index.php">Home</a>
 </div>
 <div data-role = "content">
  <strong>$name_safe</strong>
  From $row[start_time] for $hours $hourstr $minutesstr<br/> 
  At $loc_safe<br/>
  $privatestr<br/>
  <br/>
  $desc_safe
 </div>
 <div data-role = "footer"></div> 
</div>
MULTI;
  }
  echo $multipages;
 } else {
  ;//echo "failure reason for my_events: " . $failure_reason_myevents . "<br/>";
 }
?>
</body>

</html>
