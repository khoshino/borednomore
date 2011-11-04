<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"> 
<head>
  <title>Bored no More</title>
  <meta name="viewport" 
        content="initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
</head>
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

<h1>Bored No More</h1>
<h3>Let's Do Something!</h3>
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
<div class="fb-login-button" data-perms="read_friendlists" data-show-faces="false" data-width="200" data-max-rows="1"></div>
<form method="link" action="create/create_event_type.php">
<input type="submit" value="Create an Event"></form>
<form method="link" action="mine/index.php">
<input type="submit" value="My Events"></form>
<form method="link" action="events/events.php">
<input type="submit" value="View Events"></form>

</body>

</html>
<style>
  body.connected #login { display: none; }
  body.connected #logout { display: block; }
  body.not_connected #login { display: block; }
      body.not_connected #logout { display: none; }
</style>