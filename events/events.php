<!DOCTYPE html>
<?
$con = mysql_connect("mysql.cs147.org", "khoshino", "JXDBsbH9");
$success = false;
if (!$con)
    {
        die('Could not connect:' . mysql_error());
    }
mysql_select_db("khoshino_mysql", $con);
$query = "SELECT * FROM `events` WHERE `category` = 'games' ORDER BY `name` ASC";
	
 $result = mysql_query($query, $con);
 

mysql_close($con);

?>

<html>
<head><title>SearchEventsPage</title>
	<?php include("../import/header.php");?>
</head>
<body>


<div data-role = "page" id = "searchEvents" data-title = "searchEvents">
	<div data-role = "header">
		<h1 class = "pageTitleText"> Search Events </h1>
		<!-- Navigation Buttons- Change these links to link to different back pages or add links to new   pages-->
		<a href = "../index.php">Back</a>
		<a href = "../index.php" >Home</a>
	</div>
	
	<div data-role = "content" id = "searchEventsContent">
		<div id="menu" >
		<h1 class = "pageTitleText"><b> Search Menu</b> </h1>
		<p>Search by: </p>
		<!-- trying to send which type of request it was ie, catfinish this later...
		<form action="searchListings.php" method="post" data-ajax="false">
		<button name="searchType" value="category" type="submit" target="searchListings.php " data-ajax="false">View By Category</button>
		<button name="searchType" value="location" type="submit" target="searchListings.php" data-ajax="false">View By Location</button>
		<button name="searchType" value="time" type="submit" target="searchListings.php" data-ajax="false">View By Time</button>
		
		</form>
		
		
		<button onclick = "window.location.href='chooseSearchCategory.php'" value="category"  name="searchOption" type = "submit" >
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Category " />
			Category
		</button>
		
		<button onclick = "window.location.href='searchListings.php'" value="location" name="searchOption" type = "submit">
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Location " />
			Location
		</button>
		
		<button onclick = "window.location.href='searchListings.php'" value="time" name="searchOption" type = "submit">
			<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Time" />
			Time
		</button>
		-->
		<!--we need a seperate form to submit to chooseSearchCategory page when searching by category -->
		<form action = "chooseSearchCategory.php" method = "post" data-ajax = "false"> 
			<button name="searchOption" value="Category"   type = "submit" target="chooseSearchCategory.php">
				<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Category " />
				Category
			</button>
		</form>
		<form action="searchListings.php" method="post" data-ajax="false">
			
			<button name="searchOption" target="searchListings.php" value="Location"  type = "submit">
				<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Location " />
				Location
			</button>
			
			<button name="searchOption" target="searchListings.php" value="Time" type = "submit">
				<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Time" />
				Time
			</button>
		</form>
		</br>
</body>
</html>

