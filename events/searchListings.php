<!DOCTYPE html>
<?
$con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
$success = false;
if (!$con)
    {
        die('Could not connect:' . mysql_error());
    }
mysql_select_db("khoshino_mysql", $con);
	$queryType = $_POST["searchType"];
	$category = $_POST["category"];
	if($queryType == $("category"){
	  $query = "SELECT * FROM `events` WHERE `category` = '". $category . "' ORDER BY `name` ASC";
	}
	if($queryType == $("location"){
	  $query = "SELECT * FROM `events` ORDER BY `location` ASC";
	}
	if($queryType == $("time"){
	  $query = "SELECT * FROM `events` ORDER BY `time` ASC";
	}
	
 $result = mysql_query($query, $con);
	

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


<div data-role = "page" id = "searchEventsCategory" data-title = "searchEvents">
	<div data-role = "header">
		<h1 class = "pageTitleText"> Search Events </h1>
		<!-- Navigation Buttons Change these links to link to different back pages or add links to new pages-->
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
			
			//$test = "test";
			//$test2 .= $test;
			$name  = $eventArray['name'];
			$pgId = "event" . $eventArray['e_id'];
			$pgTitle = $pgId . "_" . $name;
			$startTime = $eventArray['start_time']; //TODO: convert this to human readable format
			$dmin = $eventArray['duration'];
			$duration = (int)($eventArray['duration']/60) . 'hr ' . ($dmin % 60) . 'min'; //TODO: convert this to human readable format ie. _hr_min
			
			
			echo '<a href = "#'. $pgId . '"  > ' . $name . '</a><br/>';
			
			$eventPage = 
			' <div data-role = "page" id = "'. $pgId . '" data-title = "' . $pgTitle . '" data-url="'.$pgId.'">
					<div data-role = "header">
						<h1 class = "pageTitleText">' . $name .' Event</h1>
						
						<a href = "#searchEventsCategory">Back</a>
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

		}
		
		?>
		</div>
	</div>
	
	<div data-role = "footer">footer...<!-- <?php //echo $newPagesHtml; ?> --></div>
</div>

<?php 
 echo $newPagesHtml;
?>
</body>
</html>

