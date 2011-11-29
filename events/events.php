<!DOCTYPE html> <!-- this page is NOT in use -->
<?
include ("../import/utility.php");
$user_token = get_fbtoken($appid, $appsecret);
$user_fbid = ($user_token)? $user_token['user_id'] : 0;
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
		<a href = "../index.php" data-icon="back" data-ajax="false" data-direction="false">Back</a>
		<a href = "../index.php" data-icon="home" data-ajax="false">Home</a>
	</div>
	
	<div data-role = "content" id = "searchEventsContent">
		<div id="menu" >
		<h2>Search by: </h2>
		<!--we need a seperate form to submit to chooseSearchCategory page when searching by category -->
		<form action = "chooseSearchCategory.php" method = "post" data-ajax = "false"> 
			<button name="searchOption" value="category"   type = "submit" target="chooseSearchCategory.php">
				<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Category " />
				Category
			</button>
		</form>
		<form action="searchListings.php" method="post" data-ajax="false">
			
			<button name="searchOption" target="searchListings.php" value="location"  type = "submit">
				<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Location " />
				Location
			</button>
			
			<button name="searchOption" target="searchListings.php" value="time" type = "submit">
				<img src="http://www.garrykelly.ie/wp-content/uploads/2010/05/20061006213300Sports_icon.png	" alt="Time" />
				Time
			</button>
			<input type="hidden" name="fbid" value="<?php echo $user_fbid;?>"/>
		</form>
		</br>
</body>
</html>

