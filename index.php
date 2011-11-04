<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"
     xmlns:fb="https://www.facebook.com/2008/fbml"> 
<head><title>Bored no More</title>
	<!--scripts to use JQuery Mobile-->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script> 
	
	<!--kotaro's facebook integration scripts. I moved them here. IB-->
	<div id="fb-root"></div>	
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=240585475995480";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
<head/> 
<body> 

<!-- data-role = "page" is a Jquery model that keeps events in a page.
	This allows auto formatting of headers and footers-->
<div data-role="page" id = "homeIndex" data-title="homeIndex"> 
	<div data-role="header">
		<h1 class = "pageTitleClass">Bored No More</h1>
		<!-- Navigation Buttons-- Change these links to link to different back pages or add links to new pages-->
		<a href = "./create/create_event_type.php">Back</a>
		<a href = "index.php" >Home</a>
	</div>
	<div data-role = "content" id = "homeIndexContent"> 				
		<h3>Let's Do Something!</h3>
		<div class="fb-login-button" data-perms="read_friendlists" data-show-faces="false" data-width="200" data-max-rows="1"></div>
		<form method="link" action="create/create_event_type.php">
		<input type="submit" value="Create an Event"></form>
		<form method="link" action="mine/myEvents.php">
		<input type="submit" value="My Events"></form>
		<form method="link" action="events/events.php">
		<input type="submit" value="View Events"></form>
	</div>	
	<div data-role= "footer">footer...</div>
	
</div>



</body>

</html>
