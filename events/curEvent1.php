
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

 </div></body>
</html>


