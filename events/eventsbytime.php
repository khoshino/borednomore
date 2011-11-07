<!DOCTYPE html>
<?php
$con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
$success = false;
if (!$con)
    {
        die('Could not connect:' . mysql_error());
    }
mysql_select_db("khoshino_mysql", $con);

 $result = mysql_query("SELECT * FROM khoshino_mysql");
	while($row = mysql_fetch_array($result)){
		echo $row['e_id'] . " " . $row['name'];
		echo "<br />";
	}

mysql_close($con);

?>

<html>
<head><title>SortByTime</title>
	<!--scripts to use JQuery Mobile-->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 
<head/> 
<body>
<div data-role = "page">
	<div data-role = "header">
		<h1 class = "pageTitleText">My Events</h1>
		<!-- Navigation Buttons-- Change these links to link to different back pages or add links to new pages-->
		<a href = "../index.php">Back</a>
		<a href = "../index.php" >Home</a>
	</div>
	<div data-role = "content" id ="SortByTimeContent">
	  <div class="event-block" style="height:200px;width:400px;border-style:groove; border-width:5px; border-color:green">
	  <div class="event-block-title" style="font-size:48px">Brawl in Adelfa</div>
	  <div class="event-block-time" style="font-size:24px">In 30 minutes</div>
	  <div class="event-block-location"></div>
	  <div class="event-block-type"></div>
	 </div>
	 <div class="event-block" style="height:200px;width:400px;border-style:groove; border-width:5px; border-color:green">
	  <div class="event-block-title" style="font-size:48px">Dance Break</div>
	  <div class="event-block-time" style="font-size:24px">In 1 hour</div>
	  <div class="event-block-location"></div>
	  <div class="event-block-type"></div>
	 </div>
	 <div class="event-block" style="height:200px;width:400px;border-style:groove; border-width:5px; border-color:green">
	  <div class="event-block-title" style="font-size:48px">Late Night Break</div>
	  <div class="event-block-time" style="font-size:24px">In 1.5 hours</div>
	  <div class="event-block-location"></div>
	  <div class="event-block-type"></div>
	 </div>
	 <div class="event-block" style="height:200px;width:400px;border-style:groove; border-width:5px; border-color:green">
	  <div class="event-block-title" style="font-size:48px">DDR in Okada</div>
	  <div class="event-block-time" style="font-size:24px">In 1.5 hours</div>
	  <div class="event-block-location"></div>
	  <div class="event-block-type"></div>
	 </div>
	 <div class="event-block" style="height:200px;width:400px;border-style:groove; border-width:5px; border-color:green">
	  <div class="event-block-title" style="font-size:48px">Lan Party</div>
	  <div class="event-block-time" style="font-size:24px">In 4 hours</div>
	  <div class="event-block-location"></div>
	  <div class="event-block-type"></div>
	 </div>
	</div>
	<div data-role = "footer"> footer...</div>
 
</div>
</body>
</html>