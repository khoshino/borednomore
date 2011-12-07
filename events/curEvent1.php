
<!DOCTYPE html>
querytype is: time
<html>
<head><title>SearchEventsPage</title>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> 

<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
<link rel= "stylesheet" href="http://borednomore.cs147.org/recent/import/main.css"/>
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 

</head>
<body>

<div data-role = "page" id = "searchListings" data-title = "searchListings">
	<div data-role = "header" >
		<h1 class = "pageTitleText"> Search Events </h1>
		<!-- Navigation Buttons Change these links to link to different back pages or add links to new pages-->
		
		<a href = "../index.php" class = "headerButton" data-icon="back" data-direction="reverse">Back</a>
		<a href = "../index.php"  class = "headerButton" data-icon="home" data-ajax="false" >Home</a>
		<div data-role="navbar">
		<!-- nav bar class="ui-btn-active"-->
			<form action = "searchListings.php" id = "searchByTimeForm" method = "post" data-ajax = "false"> 
				<input type="hidden" name="searchOption" id="searchByTime"  target="searchListings.php" value="time"  type = "submit" />
			</form>
			<form action = "searchListings.php" id = "searchByLocationForm" method = "post" data-ajax = "false"> 
				<input type="hidden" name="searchOption" id="searchByLoc"  value="location" target="searchListings.php"  type = "submit" />
			</form>
			<form action = "chooseSearchCategory.php" id = "searchByCategoryForm" method = "post" data-ajax = "false"> 
				<input type="hidden" name="searchOption" id="searchByCat"  value="category" target="chooseSearchCategory.php"  type = "submit" />
			</form>
			<script>
				function searchByTime(){document.getElementById('searchByTimeForm').submit();}
				function searchByLoc(){document.getElementById('searchByLocationForm').submit();}
				function searchByCat(){document.getElementById('searchByCategoryForm').submit();}
			</script>
			<ul>
				<li><a onClick = "searchByTime();" class = "headerButton ui-btn-active"> Time </a></li>
				<li><a onClick = "searchByLoc();" class = "headerButton "> Location </a></li>
				<li><a onClick = "searchByCat();" class = "headerButton "> Category </a></li>
			<!--
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
				-->
			</ul>

		</div><!-- /navbar -->
	</div>
	
	<div data-role = "content" id = "searchEventsContent">
		<div id="menu" >
		
		<!--<h3 class = "pageTitleText"><b> Listing Search Results by  ...</b> </h3></br>-->
		
		</div>	
		<div id = "searchResults">
		<ul data-role="listview" data-theme="d" data-dividertheme="a"> <!--starts listing all the events returned from the search-->
			<li data-role="list-divider"><h3>Listing search results by Time ...</h3></li>
			
		<li><a href = "#event112" > 2:00 PM		-Pick up Basketball</a><br/></li><li><a href = "#event113" > 11:00 PM		-Movie Night! :)</a><br/></li><li><a href = "#event111" > 10:45 PM		-Snack Attack!</a><br/></li>		</ul> <!--closes the unordered list of all the events -->
		</div>
	</div>
	
	<div data-role = "footer"><h1 class = "pageTitleText">Bored No More</h1><!--  --></div>
</div>

 <div data-role = "page" id = "event112" data-title = "event112_Pick up Basketball" data-url="event112">
  <div data-role="header">
   <h1 class = "pageTitleText">Pick Up Basketball Event</h1>
   <a href = "#searchListings" class = "headerButton" data-icon="back" data-direction="reverse">Back</a>
   <a href = "../index.php" class = "headerButton" data-icon="home" data-ajax="false">Home</a>
  </div>
  <div data-role="content" id="event112Content">
   
   <p><strong style="float:left">Title: </strong> Pick up Basketball</p>
   <p><strong>Public</strong> Event</p>
   <p><strong style="float:left">Category: </strong>Sport</p>
   <p><strong style="float:left">Starts: </strong><div style="float:left">2:00 PM <br/>Dec 7, 2011</div><strong style="float:left"> Ends: </strong> <div>8:00 PM <br/>Dec 7, 2011</div></p>
   <p><strong style="float:left">Duration: </strong>6hr  0min</p>
   <p><strong style="float:left">Location: </strong>That court near manzanita</p>
   <p><strong>Creator: </strong>Tiph Gammon</p>
   <p><strong>Number of Participants: </strong>1</p>
   <p><strong style="float:left">Details: </strong>pickup bball. be there or get a faceful of orange next time i see you.</p>
   <br/>
   <a href = "#event112Wall">View Wall Posts</a>
   <br/>
   <br/>
    <form id = "join112" action = "../mine/myEvents.php" method="POST" data-ajax = "false" name = "join112">
  <input type="hidden" name="type" value="join"/>
  <input type="hidden" name="eventid" value="112"/>
  <a onClick='if (confirm("Are you sure you want to join this event?")) {
   
   document.getElementById("join112").submit();
   
  }' data-role = 'button'>Join Event</a>
 </form>

   
   
  </div>
  <div data-role="footer"><h1 class = "pageTitleText">Bored No More</h1></div>
 </div> <div data-role = "page" id = "event112Wall" data-title = "event112Wall_Pick up Basketball" data-url="event112Wall">
  <div data-role="header">
   <h1 class = "pageTitleText">Pick Up Basketball Wall</h1>
   <a href = "#event112"  class = "headerButton" data-icon="back" data-direction="reverse">Back</a>
   <a href = "../index.php"  class = "headerButton" data-icon="home" data-ajax="false">Home</a>
  </div>
  <div data-role="content" id="event112WallContent">
   <!--<p><strong>Title: </strong> Pick Up Basketball</p>-->
   <!--<p><strong>Posts: </strong> <br/></p>-->
   <form id = "postCommentForm112" action = "searchListings.php#event112Wall" method="POST" data-ajax = "false" name = "wallPostForm">
   <input type="hidden" name="searchOption" value="time"/>
   <input type="hidden" name="category" value=""/>
   <input type="hidden" name="type" value="post"/>
   <input type="hidden" name="eid" value="112"/>
   <textarea id="wallPostMessage" name="wallPostMessage" placeholder="type a message here!"></textarea><br/>
    <a onClick="document.getElementById('postCommentForm112').submit();" data-role = 'button'>Post!</a><br />
   </form>
   <p></p>
  </div>
  <div data-role="footer"><h1 class = "pageTitleText">Bored No More</h1></div>
 </div> <div data-role = "page" id = "event113" data-title = "event113_Movie Night! :)" data-url="event113">
  <div data-role="header">
   <h1 class = "pageTitleText">Movie Night! :) Event</h1>
   <a href = "#searchListings" class = "headerButton" data-icon="back" data-direction="reverse">Back</a>
   <a href = "../index.php" class = "headerButton" data-icon="home" data-ajax="false">Home</a>
  </div>
  <div data-role="content" id="event113Content">
   
   <p><strong style="float:left">Title: </strong> Movie Night! :)</p>
   <p><strong>Public</strong> Event</p>
   <p><strong style="float:left">Category: </strong>Watch</p>
   <p><strong style="float:left">Starts: </strong><div style="float:left">11:00 PM <br/>Dec 6, 2011</div><strong style="float:left"> Ends: </strong> <div>1:00 AM <br/>Dec 7, 2011</div></p>
   <p><strong style="float:left">Duration: </strong>2hr  0min</p>
   <p><strong style="float:left">Location: </strong>Adelfa Lounge</p>
   <p><strong>Creator: </strong>Tiph Gammon</p>
   <p><strong>Number of Participants: </strong>1</p>
   <p><strong style="float:left">Details: </strong>Con Air. The best of the best (when the best in Nic Cage)</p>
   <br/>
   <a href = "#event113Wall">View Wall Posts</a>
   <br/>
   <br/>
    <form id = "join113" action = "../mine/myEvents.php" method="POST" data-ajax = "false" name = "join113">
  <input type="hidden" name="type" value="join"/>
  <input type="hidden" name="eventid" value="113"/>
  <a onClick='if (confirm("Are you sure you want to join this event?")) {
   
   document.getElementById("join113").submit();
   
  }' data-role = 'button'>Join Event</a>
 </form>

   
   
  </div>
  <div data-role="footer"><h1 class = "pageTitleText">Bored No More</h1></div>
 </div> <div data-role = "page" id = "event113Wall" data-title = "event113Wall_Movie Night! :)" data-url="event113Wall">
  <div data-role="header">
   <h1 class = "pageTitleText">Movie Night! :) Wall</h1>
   <a href = "#event113"  class = "headerButton" data-icon="back" data-direction="reverse">Back</a>
   <a href = "../index.php"  class = "headerButton" data-icon="home" data-ajax="false">Home</a>
  </div>
  <div data-role="content" id="event113WallContent">
   <!--<p><strong>Title: </strong> Movie Night! :)</p>-->
   <!--<p><strong>Posts: </strong> <br/></p>-->
   <form id = "postCommentForm113" action = "searchListings.php#event113Wall" method="POST" data-ajax = "false" name = "wallPostForm">
   <input type="hidden" name="searchOption" value="time"/>
   <input type="hidden" name="category" value=""/>
   <input type="hidden" name="type" value="post"/>
   <input type="hidden" name="eid" value="113"/>
   <textarea id="wallPostMessage" name="wallPostMessage" placeholder="type a message here!"></textarea><br/>
    <a onClick="document.getElementById('postCommentForm113').submit();" data-role = 'button'>Post!</a><br />
   </form>
   <p></p>
  </div>
  <div data-role="footer"><h1 class = "pageTitleText">Bored No More</h1></div>
 </div> <div data-role = "page" id = "event111" data-title = "event111_Snack Attack!" data-url="event111">
  <div data-role="header">
   <h1 class = "pageTitleText">Snack Attack! Event</h1>
   <a href = "#searchListings" class = "headerButton" data-icon="back" data-direction="reverse">Back</a>
   <a href = "../index.php" class = "headerButton" data-icon="home" data-ajax="false">Home</a>
  </div>
  <div data-role="content" id="event111Content">
   
   <p><strong style="float:left">Title: </strong> Snack Attack!</p>
   <p><strong>Public</strong> Event</p>
   <p><strong style="float:left">Category: </strong>Food</p>
   <p><strong style="float:left">Starts: </strong><div style="float:left">10:45 PM <br/>Dec 6, 2011</div><strong style="float:left"> Ends: </strong> <div>2:45 AM <br/>Dec 7, 2011</div></p>
   <p><strong style="float:left">Duration: </strong>4hr  0min</p>
   <p><strong style="float:left">Location: </strong>Lagunita</p>
   <p><strong>Creator: </strong>Tiph Gammon</p>
   <p><strong>Number of Participants: </strong>1</p>
   <p><strong style="float:left">Details: </strong>Let's all grab some late night munchies as we work on insane projects, and papers, and psets, oh my!</p>
   <br/>
   <a href = "#event111Wall">View Wall Posts</a>
   <br/>
   <br/>
    <form id = "join111" action = "../mine/myEvents.php" method="POST" data-ajax = "false" name = "join111">
  <input type="hidden" name="type" value="join"/>
  <input type="hidden" name="eventid" value="111"/>
  <a onClick='if (confirm("Are you sure you want to join this event?")) {
   
   document.getElementById("join111").submit();
   
  }' data-role = 'button'>Join Event</a>
 </form>

   
   
  </div>
  <div data-role="footer"><h1 class = "pageTitleText">Bored No More</h1></div>
 </div> <div data-role = "page" id = "event111Wall" data-title = "event111Wall_Snack Attack!" data-url="event111Wall">
  <div data-role="header">
   <h1 class = "pageTitleText">Snack Attack! Wall</h1>
   <a href = "#event111"  class = "headerButton" data-icon="back" data-direction="reverse">Back</a>
   <a href = "../index.php"  class = "headerButton" data-icon="home" data-ajax="false">Home</a>
  </div>
  <div data-role="content" id="event111WallContent">
   <!--<p><strong>Title: </strong> Snack Attack!</p>-->
   <!--<p><strong>Posts: </strong> <br/></p>-->
   <form id = "postCommentForm111" action = "searchListings.php#event111Wall" method="POST" data-ajax = "false" name = "wallPostForm">
   <input type="hidden" name="searchOption" value="time"/>
   <input type="hidden" name="category" value=""/>
   <input type="hidden" name="type" value="post"/>
   <input type="hidden" name="eid" value="111"/>
   <textarea id="wallPostMessage" name="wallPostMessage" placeholder="type a message here!"></textarea><br/>
    <a onClick="document.getElementById('postCommentForm111').submit();" data-role = 'button'>Post!</a><br />
   </form>
   <p></p>
  </div>
  <div data-role="footer"><h1 class = "pageTitleText">Bored No More</h1></div>
 </div></body>
</html>


