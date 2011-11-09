<!DOCTYPE html>
<?php
/* get_facebook_cookie
 * authenticates user's cookie server-side. Code from:
 * developers.facebook.com/docs/guides/web
*/
function get_facebook_cookie($app_id, $app_secret) {
  $args = array();
  parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
  ksort($args);
  $payload = '';
  foreach ($args as $key => $value) {
    if ($key != 'sig') {
      $payload .= $key . '=' . $value;
    }
  }
  if (md5($payload . $app_secret) != $args['sig']) {
    return null;
  }
  return $args;
}
function parse_signed_request($signed_request, $secret) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    return null;
  }

  // check sig
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}

$appid     = 240585475995480;
$appsecret = "1107e44f761f958af687e126f9428ed3";

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
		<a href = "./create/create_event_type.php">Back</a>
		<a href = "index.php" >Home</a>
	</div>
	<div data-role = "content" id = "homeIndexContent"> 				
		<h3>Let's Do Something!</h3>
<?php
 $signed_request = parse_signed_request($_COOKIE['fbsr_' . $appid], $appsecret);
 // This code checks that the facebook cookie can be accessed
 /*if ($signed_request != null) {
  foreach ($signed_request as $key => $value) {
   echo $key . ": " . $value . "<br/>";
  }
 } else {
  echo "fail";
 }*/

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
	<div data-role= "footer"><a href="/legal.php">Legal</a> Footer...</div>
	
</div>

</body>

</html>
<style>
  body.connected #login { display: none; }
  body.connected #logout { display: block; }
  body.not_connected #login { display: block; }
      body.not_connected #logout { display: none; }
</style>
