
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
 <div data-role = "page" id = "event111" data-title = "event111_Snack Attack!" data-url="event111">
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


