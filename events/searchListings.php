<!DOCTYPE html>
<?
$con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
$success = false;
if (!$con)
    {
        die('Could not connect:' . mysql_error());
    }
mysql_select_db("khoshino_mysql", $con);
	$queryType = "location";
	$category = $_POST["category"];
	$query = "SELECT * FROM `events` WHERE `category` = '". $category . "' ORDER BY `name` ASC";
	
 $result = mysql_query($query, $con);
 

	

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
		<a href = "./events.php">Back</a>
		<a href = "../index.php" >Home</a>
	</div>
	
	<div data-role = "content" id = "searchEventsContent">
		<div id="menu" >
		
		<h1 class = "pageTitleText"><b> Search Results</b> </h1>
		
		</br>
			
		</div>	
		<div id = "searchResults">
		<?php
		
		echo 'sql is:' . $query. '<br/>';
		echo "category is: " . $category ."<br/>";
		echo 'result is:' . $result . '<br/>';
		$numRows =  mysql_num_rows($result);
		echo 'numRows:' . $numRows . '<br/>';
		$newPagesHtml = '';
		$test2 = '';
		
		for( $i = 0; $i < $numRows; $i++){
			$eventArray = mysql_fetch_array($result);
			//print_r($eventArray);
			
			#$test = "test";
			#$test2 .= $test;
			$name  = $eventArray['name'];
			$pgId = "event" . $eventArray['e_id'];
			$pgTitle = $pgId . "_" . $name;
			$startTime = $eventArray['start_time']; //TODO: convert this to human readable format
			$dmin = $eventArray['duration'];
			$duration = (int)($eventArray['duration']/60) . 'hr ' . ($dmin % 60) . 'min'; //TODO: convert this to human readable format ie. _hr_min
			
			
			echo '<a href = "searchListings.php#'. $pgId . '"> ' . $name . '</a><br/>';
			
			/*$eventPage is a string holding all the html need to display an event for this page*/
//***************BEGIN CREATING CODE FOR EVENT PAGE (for a single event)****************************************
			$eventPage = 
			' <div data-role = "page" id = "'. $pgId . '" data-title = "' . $pgTitle . '">
					<div data-role = "header">
						<h1 class = "pageTitleText">' . $name .' Event</h1>
						<!-- Navigation Buttons-- Change these links to link to different back pages or add links to new pages-->
						<a href = "searchListings.php#searchEventsContent">Back</a>
						<a href = "../index.php" >Home</a>
					</div>
					<div data-role = "content" id = "' . $pgId . 'Content"> 
						<p><strong>Title: </strong> ' . $name . '  <strong>Category:</strong> ' . $eventArray['category'] . '</p>
						<p><strong>Start:</strong> ' . $startTime . ' 	<strong>Duration: </strong>'. $duration .'</p>						
						<p><strong>Location:</strong> ' . $eventArray['location'] . '</p>						
						<p><strong>Creator: </strong>' . $eventArray['creator_fbid'] .'</p>
						<p><strong>Details: </strong>' . $eventArray['description'] . '</p> 
					</div>
					<div data-role = "footer" >footer...</div>
					</div>';

			$pagesArray[$i] =$eventPage;
			$newPagesHtml .= $eventPage;
//***************End Creating CODE FOR EVENT PAGE (for a single event)****************************************
			/*
			echo 'eventPage:' . $eventPage . '<br/>';
			echo 'eventArray["name"]:' . $eventArray['name'];
			echo $test;
			#$eventPages.apppend("PHP Test append <br/>");
			 #CreateEventPage($eventArray);
		  
		  echo "<br/>";
		  */
		}
//***************End CODE FOR EVENT PAGE (for a single event)***************************************
		//echo 'newPagesHtml:' . $newPagesHtml;
		//echo $test2;
		/*
		while($row = mysql_fetch_row($result)){
		  echo " Row:" . $row . "<br/> $row[0]:" . $row[0] . "<br/>$row[1]:" . $row[1] . "<br/>event id:" . $row["e_id"] . "<br/> name:" . $row["name"] . "<br/> category:".  $row["category"] . "<br/>
			description:" . $row["description"] . "<br/>";
		  print_r(mysql_fetch_assoc($result));
		  echo '<br/>';
		}
		*/
		#echoing this Html so I can keep using php and still have access to my info from database
		 echo '
			<ul>
			<li> "TEST"
			
			<li> "event1"
			<li> "event2"
			<li> "event3"
			</ul>
			<div id = "eventPages">
			</div>
		</div>
	</div>
	
	<div data-role = "footer">footer...</div>
</div>
';
//ECHO OUT code for event pages
echo "outside searchEvents page <br/>";  
	for($i = 0; $i < $numRows; $i++){
		echo $pagesArray[$i];
		echo '<br/>';
	}
?>
</body>
</html>
