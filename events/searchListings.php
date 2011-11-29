<!DOCTYPE html>
<?
include '../import/utility.php';
$con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
if (!$con)
    {
        die('Could not connect:' . mysql_error());
    }
$user_data = get_fbtoken($appid, $appsecret);
$loggedin = ($user_data) ? true : false;
if ($_POST['type'] == "post") {
 // SECURITY BEFORE POSTING ON WALL
 $post = true;
 if (!$loggedin) $post = false;
 // VARIABLE INIT
 $eid = intval($_POST['eid']);          // dangerous
 $eid = strval($eid);                   // now safe
 $fbid = strval($user_data['user_id']); // safe
 $time = date('Y-n-j g:i:s', time());   // safe
 $message = $_POST['wallPostMessage'];  // dangerous
 $message = mysql_real_escape_string($message); // safe
 $creator = false;                      // safe
 $failure = -1; // debugging variable
 if ($post) {
  mysql_select_db("khoshino_mysql", $con);
  $query = "SELECT creator_fbid FROM events WHERE e_id='".$eid."'";
  $result = mysql_query($query);
  if ($result) {
   $row = mysql_fetch_array($result);
   $creator = ($row['creator_fbid'] == $fbid) ? '1' : '0';
   $query = "INSERT INTO wallposts (e_id, fbid, time, message, creator) VALUES (".$eid.", ".$fbid.", '".$time."', '".$message."', ".$creator.");";
   $result = mysql_query($query);
   if (!$result) $failure = 2;
  } else {
   $failure = 1;
  }
 }
}


$user_fbid = ($user_data) ? $user_data['user_id'] : 0;
$friendlist = ($user_data) ? get_friendlist($user_data['access_token'], $user_data['user_id']) : array();
$query_start  = " WHERE ";
$query_append = " AND (";
$query_clause = "private='0' ";
if (count($friendlist)) {
 $query_clause .= "OR (creator_fbid IN (";
 $first = 1;
 foreach ($friendlist as $friend) {
  if (!$first)
   $query_clause .= ", ";
  else
   $first = 0;
  $query_clause .= $friend;
 }
 $query_clause .= ($loggedin) ? ", " . $user_data['user_id'] : '';
 $query_clause .= ")) ";
}
$query_appendend = ") ";

$success = false;
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
	  $query = "SELECT * FROM `events` " . $query_start .  $query_clause . " ORDER BY `location` ASC"; //sort alphebetically by location
	}elseif($queryType == $typeTime){
	  $query = "SELECT * FROM `events` " . $query_start . $query_clause . " ORDER BY `start_time` DESC"; //sort by starting time, most recent first
	}else{  // if the type is category,  then query is coming from the "chooseSearchCategory.php" and there is no queryType option .
		$query = "SELECT * FROM `events` WHERE `category` = '". $category . "' " . $query_append . $query_clause . $query_appendend . "ORDER BY `name` ASC";
	}
	
	//$query = "SELECT * FROM `events` WHERE `category` = '". $category . "' ORDER BY `name`  ASC";
	
	
 $result = mysql_query($query, $con) or die (mysql_error());
	

//mysql_close($con); 
//since we need to query the data base for the wallposts for each event, close later

?>

<html>
<head><title>SearchEventsPage</title>
	<?php include("../import/header.php");?>
</head>
<body>
<?php if (!$user_data) echo getFBJS($appid);?>

<div data-role = "page" id = "searchEventsCategory" data-title = "searchEvents">
	<div data-role = "header" >
		<h1 class = "pageTitleText"> Search Events </h1>
		<!-- Navigation Buttons Change these links to link to different back pages or add links to new pages-->
		<?php
		$prevPage = "./events.php"; //previous page defaults to the search option page
		if ($queryType == $typeCat){ //if searching by "category" change the previous page to be the category selection page 
			$prevPage = "./chooseSearchCategory.php";
		}
		?>
		<a href = "<?php echo $prevPage ?>" data-icon="back" data-direction="reverse">Back</a>
		<a href = "../index.php"  data-icon="home" data-ajax="false" >Home</a>
		<div data-role="navbar">
		<!-- nav bar class="ui-btn-active"-->
			<ul>
				<li>
					<form action = "searchListings.php" method = "post" data-ajax = "false"> 
					<button name="searchOption" target="searchListings.php" value="time" type = "submit">
						<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Time" />
						Time
					</button>
					</form>
			</li>
				<li>
					<form action = "searchListings.php" method = "post" data-ajax = "false"> 
						<button name="searchOption" target="searchListings.php" value="location" type = "submit" data-icon="star">
							Location
						</button>
					</form>
				</li>
				<li>
					<form action = "chooseSearchCategory.php" method = "post" data-ajax = "false" data-icon="gear"> 
						<button name="searchOption" value="category"   type = "submit" target="chooseSearchCategory.php">
							<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Category " />
							Category
						</button>
					</form>
				</li>
			</ul>

		</div><!-- /navbar -->
	</div>
	
	<div data-role = "content" id = "searchEventsContent">
		<div id="menu" >
		
		<!--<h3 class = "pageTitleText"><b> Listing Search Results by <?php //echo $queryType ?> ...</b> </h3></br>-->
		
		</div>	
		<div id = "searchResults">
		<ul data-role="listview" data-theme="d" data-dividertheme="a"> <!--starts listing all the events returned from the search-->
			<li data-role="list-divider"><h3>Listing search results by <?php echo ucfirst($queryType) . ' '. ucfirst($category)?>...</h3></li>
			
		<?php
		//need to query all the wall posts for each event
		
		
		$numRows =  mysql_num_rows($result);
		$newPagesHtml = '';
		
		for( $i = 0; $i < $numRows; $i++){
			$eventArray = mysql_fetch_array($result);
			$name  = $eventArray['name'];
			$pgId = "event" . $eventArray['e_id'];
			$pgTitle = $pgId . "_" . $name;
			//$startTime = $eventArray['start_time']; //TODO:convert this to human readable format
			$start = strtotime($eventArray['start_time']);
			$startTime = date("g:i A", $start);
			$startDate = date("M j, Y", $start);
			$dmin = $eventArray['duration'];
			$duration = floor($eventArray['duration']/60) . 'hr ' . ($dmin % 60) . 'min'; 
			$location = $eventArray['location'];
			
			$eventButton = '<li><a href = "#'. $pgId . '"> ' . $name . '</a><br/></li>';
			if($queryType == $typeTime){
				$eventButton = '<li><a href = "#'. $pgId . '"> ' . $startTime . "		-" . $name . '</a><br/></li>';
			}
			if($queryType == $typeLoc){
				$eventButton = '<li><a href = "#'. $pgId . '"> ' . $location . "	-" . $name . '</a><br/></li>';
			}
			
			
			echo $eventButton;			
			$eventPage = ($loggedin) ? create_eventPage($eventArray, "searchEventsCategory", false, true, $user_fbid) : create_eventPage($eventArray, "searchEventsCategory", true, false, $user_fbid);
			
			//creating event wall
			$wallQuery = "SELECT * FROM `wallposts` " . "WHERE e_id=". $eventArray['e_id']. " ORDER BY `time` DESC";
			$wallResults = mysql_query($wallQuery, $con) or die (mysql_error());
			
			$eventWall = create_eventWall($eventArray, $wallResults, $loggedin, $_POST['searchOption'], $_POST['category']);
			
			$pagesArray[$i] =$eventPage;
			$newPagesHtml .= $eventPage;
			$newPagesHtml.= $eventWall;
		}	
			mysql_close($con);//closes the connection to the database
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

