<!DOCTYPE html>
<?php
$message = $_POST["wallPostMessage"];
echo $message;
?>
<html>
<head><title>SearchEventsPage</title>
	<?php include("../import/header.php");?>
</head>
<body>
	<?php echo "1st" .$message ?>
	<p><?php echo $message ?></p>
	<p> Should see post above this </p>
	<a href ="../index.php"  data-icon="home" data-ajax="false" > home </a>
	<?php echo "after" .$message ?>
	
	
	
	<script>
   function handleSubmit() {
    if (confirm("Is the above information correct?")) {
		FB.login(function(response) {
		if (response.authResponse) {
			 document.getElementById('createEventForm').submit();
			 } else {
		window.location = 'borednomore.cs147.org';
	   }}, {scope: 'read_friendlists'});
	}
   }
<?php
 if (!$user_data) {
  $login_str = <<<LOGIN
   FB.login(function(response) {
    if (response.authResponse) {
LOGIN;
  echo $login_str;
 }
?>
     document.getElementById('createEventForm').submit();
<?php
 if (!$user_data) {
  $login_str2 = <<<LOGIN2
    } else {
    window.location = 'borednomore.cs147.org';
   }}, {scope: 'read_friendlists'});
LOGIN2;
  echo $login_str2;
 }
?>
    }
   }
		</script>
</body>
</html>