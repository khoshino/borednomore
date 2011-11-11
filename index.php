<!DOCTYPE html>
<?php
 include 'utility.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"> 
<head><title>Bored no More</title>
	<!--scripts to use JQuery Mobile-->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 
	

<head/> 
<body> 


<div id="fb-root"></div>
<script>
(function() {
    var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
        }());
window.fbAsyncInit = function() {
    FB.init({ appId: '240585475995480', 
      status: true, 
      cookie: true,
      xfbml: true,
      oauth: true});

      FB.Event.subscribe('auth.statusChange', handleStatusChange);  
    };
function handleStatusChange(response) {
   document.body.className = response.authResponse ? 'connected' : 'not_connected';

   if (response.authResponse) {
     console.log(response);
   }
 }
</script>

<!-- data-role = "page" is a Jquery model that keeps events in a page.
	This allows auto formatting of headers and footers-->
<div data-role="page" id = "homeIndex" data-title="homeIndex"> 
	<div data-role="header">
		<h1 class = "pageTitleClass">Bored No More</h1>
		<!-- Navigation Buttons- Change these links to link to different back pages or add links to new pages -->
		<a href = "index.php">Back</a>
		<a href = "index.php" >Home</a>
	</div>
	<div data-role = "content" id = "homeIndexContent"> 				
		<h3>Let's Do Something!</h3>
<?php
 $tokendata  = get_fbtoken($appid, $appsecret);
 $friendlist = get_friendlist($tokendata['access_token'], $tokendata['user_id']);
 foreach ($friendlist as $friend) {
  ;//echo "friend: " . $friend ."<br/>";
 }

?>
<div id="login">
  <p><button onClick="loginUser();">Login</button></p>
</div>
<div id="logout">
  <p><button  onClick="FB.logout();">Logout</button></p>
</div>

<script>
  function loginUser() {
    FB.login(function(response) { }, {scope:'read_friendlists'});     
    }
</script>
<!--<div class="fb-login-button" data-perms="read_friendlists" data-show-faces="false" data-width="200" data-max-rows="1"></div>-->
		<form method="link" action="create/create_event_type.php">
		<input type="submit" value="Create an Event"></form>
		<form method="link" action="mine/myEvents.php">
		<input type="submit" value="My Events"></form>
		<form method="link" action="events/events.php">
		<input type="submit" value="View Events"></form>
	</div>	
	<div data-role= "footer"><a href="/legal.php" rel="external">Legal</a> Footer...</div>
	
</div>

</body>

</html>
<style>
  body.connected #login { display: none; }
  body.connected #logout { display: block; }
  body.not_connected #login { display: block; }
      body.not_connected #logout { display: none; }
</style>
