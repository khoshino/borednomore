<!DOCTYPE html>
<?
$con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
$success = false;
if (!$con)
    {
        die('Could not connect:' . mysql_error());
    }
mysql_select_db("khoshino_mysql", $con);
	$queryType = $_POST["searchOption"];
	$category = $_POST["category"];
	if($queryType == ""){ 		  //note that the query type is the empty string if the user selects type "category" because the form 
		$queryType = "category"; //redirects to the chooseSearchCategory which will NOT post a "searchOption" value.
	}
	
	$typeCat = "category";
	$typeLoc = "location";
	$typeTime = "time";
	$query = "";
	echo "querytype is: " . $queryType;
	
	if($queryType == $typeLoc){
	  $query = "SELECT * FROM `events` ORDER BY `location` ASC"; //sort alphebetically by location
	}elseif($queryType == $typeTime){
	  $query = "SELECT * FROM `events` ORDER BY `start_time` DESC"; //sort by starting time, most recent first
	}else{  // if the type is category,  then query is coming from the "chooseSearchCategory.php" and there is no queryType option .
		$query = "SELECT * FROM `events` WHERE `category` = '". $category . "' ORDER BY `name` ASC";
	}
	
	//$query = "SELECT * FROM `events` WHERE `category` = '". $category . "' ORDER BY `name`  ASC";
	
	
 $result = mysql_query($query, $con);
	

mysql_close($con);

?>

<html>
<head><title>SearchEventsPage</title>
	<?php include("../import/header.php");?>
</head>
<body>


<div data-role = "page" id = "searchEventsCategory" data-title = "searchEvents">
	<div data-role = "header">
		<h1 class = "pageTitleText"> Search Events </h1>
		<!-- Navigation Buttons Change these links to link to different back pages or add links to new pages-->
		<?php
		$prevPage = "./events.php"; //previous page defaults to the search option page
		if ($queryType == $typeCat){ //if searching by "category" change the previous page to be the category selection page 
			$prevPage = "./chooseSearchCategory.php";
		}
		?>
		<a href = "<?php echo $prevPage ?>">Back</a>
		<a href = "../index.php" >Home</a>
		
	</div>
	
	<div data-role = "content" id = "searchEventsContent">
		<div id="menu" >
		
		<!--<h3 class = "pageTitleText"><b> Listing Search Results by <?php //echo $queryType ?> ...</b> </h3></br>-->
		
		</div>	
		<div id = "searchResults">
		<ul data-role="listview" data-theme="d" data-dividertheme="a"> <!--starts listing all the events returned from the search-->
			<li data-role="list-divider"><h3>Listing search results by <?php echo ucfirst($queryType) . ' '. ucfirst($category)?>...</h3></li>
			
		<?php
		$numRows =  mysql_num_rows($result);
		$newPagesHtml = '';
		
		for( $i = 0; $i < $numRows; $i++){
			$eventArray = mysql_fetch_array($result);
			$name  = $eventArray['name'];
			$pgId = "event" . $eventArray['e_id'];
			$pgTitle = $pgId . "_" . $name;
			$startTime = $eventArray['start_time']; //TODO: convert this to human readable format 
			$dmin = $eventArray['duration'];
			$duration = ((int)$eventArray['duration']/60) . 'hr ' . ($dmin % 60) . 'min'; //TODO: convert this to human readable format ie. _hr_min
			$eventButton = '<li><a href = "#'. $pgId . '"> ' . $name . '</a><br/></li>';
			//$eventButton = '<li><a href = "#'. $pgId . '"  data-role="button" data-icon="arrow-r" data-iconpos="right"> ' . $name . '</a><br/></li>';
			
			echo $eventButton;
			
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
		</ul> <!--closes the unordered list of all the events -->
		</div>
	</div>
	
	<div data-role = "footer">footer...<!-- <?php // echo $newPagesHtml; ?> --></div>
</div>

<?php 
 echo $newPagesHtml;
?>
</body>
</html>

