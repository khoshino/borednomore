<!DOCTYPE html>
<?php
 ini_set('display_errors', 0); // for display. NOT FOR DEBUGGING
 include "../import/utility.php";
 /*** Initialize connection with Database here ***/
 $con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
 $success = false;
 $success_myevents = false;
 $failure = -1;
 $failureq = 'No failure';
 $failure_reason = "";
 $failure_reason_myevents = "";
 $fbtoken = get_fbtoken($appid, $appsecret);
 $loggedin = ($fbtoken) ? true : false;
 $myevents = array();
 $query = "";
 $querytmp = "";
 $min_date = 'tmp';
 $walls = array();

 if (!$con)
 {
  die('Could not connect: ' . mysql_error());
 }

 /*** Deal with Wall Post Request ***/
 if ($_POST["type"] == "post") {
  // SECURITY BEFORE POSTING ON WALL
  $post = true;
  if (!$loggedin) $post = false;
  // VARIABLE INIT
  $eid = intval($_POST['eid']);
  $eid = strval($eid);
  $fbid = strval($fbtoken['user_id']);
  $time = date('Y-n-j g:i:s', time());
  $message = $_POST['wallPostMessage'];
  $message = mysql_real_escape_string($message);
  $post = (strlen($message) > 0) ? $post : false;
  $creator = false;
  $failure = -1; // debugging var
  if ($post) {
   mysql_select_db("khoshino_mysql", $con);
   $query = "SELECT creator_fbid FROM events WHERE e_id='".$eid."'";
   $result = mysql_query($query);
   if ($result) {
    $row = mysql_fetch_array($result);
    $creator = ($row['creator_fbid'] == $fbid) ? '1' : '0';
    $query = "INSERT INTO wallposts (e_id, fbid, time, message, creator) VALUES (".$eid.", ".$fbid.", '".$time."', '".$message."', ".$creator.");";
    $failureq = $query;
    $result = mysql_query($query);
    if (!$result) $failure = 2;
   } else {
    $failure = 1;
   }
  }
 }

 /*** Deal with Join Event Request ***/
 if ($_POST["type"] == "join") {
  $eventid = $_POST["eventid"];
  if ($loggedin) {
   mysql_select_db("khoshino_mysql", $con);
   $query = "SELECT COUNT(e_id) FROM participants WHERE fbid='" . $fbtoken['user_id'] . "' AND e_id='" . $eventid . "';";
   $result = mysql_query($query) or die(mysql_error());
   $exists = 0;
   while ($row = mysql_fetch_array($result)) {
    $exists = $row['COUNT(e_id)'];
    break;
   }
   if (!$exists) {
    $query = "INSERT INTO participants (e_id, fbid, creator) VALUES (" . $eventid . ", " . $fbtoken['user_id'] . ", 0);";
    $result = mysql_query($query) or die(mysql_error());
    $query = "UPDATE events SET num_participants = (num_participants + 1) WHERE e_id = '" . $eventid . "'";
    $result = mysql_query($query) or die(mysql_error());
   }
  }
 }

 /*** Deal with Leave Event Request ***/
 if ($_POST["type"] == "leave") {
  $eventid = $_POST["eventid"];
  $eventid = intval($eventid);
  $eventid = strval($eventid);
  if ($loggedin) {
   mysql_select_db("khoshino_mysql", $con);
   $query = "SELECT * FROM participants WHERE fbid='" . $fbtoken['user_id'] . "' AND e_id='" . $eventid . "';";
   $result = mysql_query($query) or die(mysql_error());
   $rowExists = false;
   $isCreator = false;
   while ($row = mysql_fetch_array($result)) {
    if (!$rowExists)
     $rowExists = true;
    if ($row['creator'] == "1")
     $isCreator = true;
   }
   if ($rowExists) {
    $query = "DELETE FROM participants WHERE e_id='" . $eventid . "'";
    if (!$isCreator)
     $query .= " AND fbid='" . $fbtoken['user_id'] . "'";
    $query .= ";";
    $result = mysql_query($query) or die(mysql_error());
    if ($isCreator) {
     $query = "DELETE FROM events WHERE e_id='" . $eventid . "';";
     $result = mysql_query($query) or die(mysql_error());
    } else {
     $query = "UPDATE events SET num_participants = (num_participants - 1) WHERE e_id ='" . $eventid . "'";
     $result = mysql_query($query) or die(mysql_error());
    }
   }
  }
 }

 /*** Initialize all the column variables here ***/
 if ($loggedin && ($_POST["type"] == "create" || $_POST["type"] == "edit")) {
  $e_id  = 0; // This gets retrieved after mysql_query
  $title = $_POST["eventTitle"];
  $loc   = $_POST["location"];
  $category = strtolower($_POST["eventType"]);
  $hour  = intval($_POST["select-hour"]);
  $min   = intval($_POST["select-min"]);
  $ampm  = intval($_POST["select-amPm"]);
  $date = trimharmful($_POST["select-date"]);
  $starthour = -1;
  if (gettype($hour) == "integer" && gettype($ampm) == "integer" && gettype($min) == "integer" && $hour >= 1 && $hour <= 12 && ($min == 0 || $min == 15 || $min == 30 || $min == 45) && ($ampm == 0 || $ampm == 12))
   $starthour = ($hour != 12) ? $hour + $ampm : $ampm;
  $hour_d= intval($_POST["select-hour-dur"]);
  $min_d = intval($_POST["select-min-dur"]);
  $duration = -1;
  if (gettype($hour_d) == "integer" && gettype($min_d) == "integer" && ($hour_d >= 1 && $hour_d <= 12) && ($min_d == 0 || $min_d == 15 || $min_d == 30 || $min_d == 45))
   $duration = $hour_d * 60 + $min_d;
  $public = $_POST["radio"];
  $isPrivate = -1;
  if ($public == "public")
   $isPrivate = 0;
  if ($public == "private")
   $isPrivate = 1;
  $desc  = $_POST["eventDescription"];
  $cur_date = ($date == "today") ? date("Y-m-d") : date("Y-m-d", time() + 86400);
  $start_time = -1;
  $fbtoken = get_fbtoken($appid, $appsecret);
  $user_id = 0;
  if ($fbtoken != null) {
   $user_id = intval($fbtoken['user_id']);
  }

  /*** Do basic security by checking input server-side here ***/
  if ($starthour > -1) {
   $start_time = $cur_date . " " . $starthour . ":" . $min . ":00"; 
   $inputtime = strtotime($start_time);
   $curtime = time();
   $start_time = date("Y-m-d G:i:s", $inputtime);
  }
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
  if ($add_to_database && $_POST["type"] == "create") {
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
 
  } else if ($add_to_database && $_POST["type"] == "edit") {
   mysql_select_db("khoshino_mysql", $con);
   $querytmp = "UPDATE events SET name='". mysql_real_escape_string($title) ."', location='".mysql_real_escape_string($loc)."', category='".mysql_real_escape_string($category)."', start_time='".$start_time."', duration='".$duration."', private='".$isPrivate."', description='".mysql_real_escape_string($desc)."' WHERE e_id='".$_POST['e_id']."' AND creator_fbid='".$user_id."'";
   $success = mysql_query($querytmp);
   if (!$success)
    $failure_reason = mysql_error($success);
 
  }

 }

 /*** Get User-Related Events from Database Here ***/
 $fbtoken = get_fbtoken($appid, $appsecret);
 if ($fbtoken != null) {
  mysql_select_db("khoshino_mysql", $con);
  $min_date = date('Y-n-j G',time() - 3600);
  $min_date .= ':00:00';
  $query = "SELECT * FROM events INNER JOIN participants ON events.e_id=participants.e_id WHERE participants.fbid='".$fbtoken['user_id']."' AND start_time >= '".$min_date."' ORDER BY events.start_time ASC";
  $success_myevents = mysql_query($query) or die (mysql_error());
  if (!$success_myevents) 
   $failure_reason_myevents = mysql_error($success_myevents);
   while ($row = mysql_fetch_array($success_myevents)) {
    $myevents[] = $row;
   }
 }
 
    
?>
<html>
<head><title>MyEvents</title>
 <!--scripts to use JQuery Mobile--
 <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
 <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
 <script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 
 -->
 <?php
  include('../import/header.php');
 ?>
</head>
<body>
<div data-role = "page" id = "myEvents" data-title = "myEvents"> 
 <div data-role = "header">
  <h1 class = "pageTitleText">My Events</h1>
  <!-- Navigation Button Change these links to link to different back pages or add links to new pages-->
  <a href = "../index.php" class = "headerButton" data-icon="back" data-direction="reverse" data-ajax="false">Back</a>
  <a href = "../index.php" class = "headerButton" data-icon="home" data-ajax="false">Home</a>
 </div>
 <div data-role = "content" id = "myEventsContent">
  <?php 
   if ($_POST['type'] == 'create') {
    //echo $min_date;
    if (!$add_to_database)
     ;//echo "database input was fail.'".$_POST['radio']."' Reason: " . $failure_loc . "<br/>";
   }
   if ($success_myevents) {
    mysql_select_db("khoshino_mysql", $con);
    echo "<ul data-role='listview' data-theme='d' data-dividertheme='a'><li data-role='list-divider'><h3>My Events</h3></li>";
    foreach ($myevents as $event) {
     $creator_class = (intval($event['creator_fbid']) == intval($fbtoken['user_id'])) ? " class='creator' " : "";
     echo "<li><a href = '#event" . $event['e_id'] . "' ".$creator_class.">" . trimharmful($event['name']) . " </a></li>"; 
     $query = "SELECT * FROM wallposts WHERE e_id='" . $event['e_id'] . "' ORDER BY time DESC";
     $query_results = mysql_query($query) or die (mysql_error());
     $walls[intval($event['e_id'])] = create_eventWall($event, $query_results, $loggedin, '', '', "myEvents.php"); 
    }
    echo "</ul>";
   } else {
    ;//echo "failure reason for my_events: " . $failure_reason_myevents . "<br/>";
   }
  ?>

 </div>
 <div data-role = "footer"> <h1 class = "pageTitleText">Bored No More</h1></div>
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
   $multipages .= create_eventPage($row, "myEvents", false, true, $fbtoken['user_id'], $loggedin, $walls[intval($row['e_id'])]);
  }
  echo $multipages;
 } else {
  ;//echo "failure reason for my_events: " . $failure_reason_myevents . "<br/>";
 }
 /*** Close connection with Database ***/
 mysql_close($con);
?>
</body>

</html>
