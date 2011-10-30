<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
     xmlns:fb="https://www.facebook.com/2008/fbml"> 
<head><title>Bored no More</title>
<head/> 
<body> 
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=240585475995480";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
    FB.init({ 
        appId:'YOUR_APP_ID', cookie:true, 
        status:true, xfbml:true, oauth:true
    });
</script>

<h1>Bored No More</h1>
<h3>Let's Do Something!</h3>
<div class="fb-login-button" data-show-faces="false" data-width="200" data-max-rows="1"></div>
<form method="link" action="create/create_event_type.php">
<input type="submit" value="Create an Event"></form>
<form method="link" action="mine/index.php">
<input type="submit" value="My Events"></form>
<form method="link" action="events/events.php">
<input type="submit" value="View Events"></form>

</body>

</html>
