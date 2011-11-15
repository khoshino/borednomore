<!DOCTYPE html>
<?php
 include './import/utility.php';
 include_once './import/php-sdk/src/facebook.php';
 $config = array();
 $config['appId']  = strval($appid);
 $config['secret'] = $appsecret;
 $config['fileupload'] = false;
 $facebook = new Facebook($config);
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"> 
<head><title>Bored no More</title>
	<!--scripts to use JQuery Mobile-->
	<?php include("./import/header.php");?>
	

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
		<a href = "index.php" data-icon="back" data-direction="reverse" data-ajax="false">Back</a>
		<a href = "index.php" data-icon="home" data-ajax="false">Home</a>
	</div>
	<div data-role = "content" id = "homeIndexContent"> 				
		<h3>Let's Do Something!</h3>
<?php
 $tokendata  = get_fbtoken($appid, $appsecret);
 $friendlist = ($tokendata) ? get_friendlist($tokendata['access_token'], $tokendata['user_id']) : null;

?>
<div id="login">
  <p><a onClick="loginUser();" id="loginbutton" data-role='button'>Login</a></p>
</div>
<div id="logout">
  <p><a onClick="logoutUser();" id="logoutbutton" data-role='button'>Logout</a></p>
</div>

<script>
  function loginUser() {
    FB.login(function(response) {window.location.reload();}, {scope:'read_friendlists'});     
    //window.location.reload();
  }
  function logoutUser() {
    FB.logout(function(response) {window.location.reload();});
  }
window.setTimeout(function() {
 FB.getLoginStatus(function(response) {
  if (response.authResponse) {
   $('#loginbutton').addClass('ui-disabled');
  } else {
   $('#logoutbutton').addClass('ui-disabled');
  }
 })}, 500);
</script>
<!--<div class="fb-login-button" data-perms="read_friendlists" data-show-faces="false" data-width="200" data-max-rows="1"></div>-->
		<form method="link" action="create/create_event_type.php">
		<input type="submit" value="Create an Event"></form>
		<form method="link" action="mine/myEvents.php" data-ajax="false">
		<input type="submit" value="My Events"></form>
		<form method="link" action="events/events.php">
		<input type="submit" value="View Events"></form>
	</div>	
	<div data-role= "footer"><a href="/legal.php" rel="external">Legal</a> Footer...</div>
	
</div>

</body>

</html>
<style>
/*body.connected #login { display: none; }
  body.connected #logout { display: block; }
  body.not_connected #login { display: block; }
  body.not_connected #logout { display: none; }
 */
</style>
