<!DOCTYPE html>
<?php
 include '../import/utility.php';
 $user_data = get_fbtoken($appid, $appsecret);
?>
<html>
<head><title>CreateEventsPage</title>
	<?php include("../import/header.php");?>
</head>

<body>
<?php if (!$user_data) echo getFBJS($appid); ?>
<div data-role="page" id = "createEvent" data-title="createEvent"> 
	<div data-role="header">
		<h1 class = "pageTitleText"><b> Create an Event </b></h1>
		<!-- Navigation Buttons- Change these links to link to different back pages or add links to new pages -->
		<a href = "./create_event_type.php" data-icon="back" data-direction="reverse">Back</a>
		<a href = "../index.php" data-icon="home" data-ajax="false">Home</a>
		<br/>
	</div> 
	
	<div data-role="content" id = "createEventContent">
		<p> Required fields are marked with an '*' </p>
		<form id = "createEventForm" action = "../mine/myEvents.php" method="POST" data-ajax = "false" name = "createEventForm">
		*Title: <input type="text" id="eventTitle" name="eventTitle" required="required" /><br />
		*Location: <input type="text" id="eventLocation" name="location" required="required" /><br />
		*Type: <?php echo $_POST["type"]; ?><input type="hidden" id="eventType" name="eventType" value="<?echo $_POST["type"]; ?>"/><br /><br />
		
		
		<div data-role = "fieldcontain" data-type = "horizontal">
			<fieldset data-role = "controlgroup" class = "ui-grid-c" data-type = "horizontal">
				
				<div class = "ui-block-a">
				<legend>*Start Time:</legend>
				</div>

				<div class = "ui-block-b">
				<label for = "select-hour" > Hour</label>
				<select name = "select-hour" id = "select-hour">
					<option value = 1> 1</option>
					<option value = 2> 2</option>
					<option value = 3> 3</option>
					<option value = 4> 4</option>
					<option value = 5> 5</option>
					<option value = 6> 6</option>
					<option value = 7> 7</option>
					<option value = 8> 8</option>
					<option value = 9> 9</option>
					<option value = 10> 10</option>
					<option value = 11> 11</option>
					<option value = 12> 12</option>
				</select>
				
				 
				</div>
				<div class = ui-block-c>  
				<label for = "select-min"> Min</label>
				<select name = "select-min" id = "select-min">
					<option value = "00"> 0 </option>
					<option value = "15"> 15 </option>
					<option value = "30"> 30 </option>
					<option value = "45"> 45 </option>
				</select>
				</div>
				
					
				<div class = ui-block-d>  
				<label for = "select-min"> AM/PM </label><!--need this label as a spacing placeholder-->
				<select name = "select-amPm" id = "select-amPm">
					<option value = "0"> AM </option>
					<option value = "12"> PM </option>
				</select>
				</div>
			</fieldset>
		
			<fieldset data-role = "controlgroup" class = "ui-grid-c" data-type = "horizontal">
				
				<div class = "ui-block-a">
				<legend>*Approximate Duration:</legend>
				</div>

				<div class = "ui-block-b">
				<label for = "select-hour_dur" > Hour</label>
				<select name = "select-hour-dur" id = "select-hour-dur" required="required">
					<option value = "1"> 1</option>
					<option value = "2"> 2</option>
					<option value = "3"> 3</option>
					<option value = "4"> 4</option>
					<option value = "5"> 5</option>
					<option value = "6"> 6</option>
					<option value = "7"> 7</option>
					<option value = "8"> 8</option>
					<option value = "9"> 9</option>
					<option value = "10"> 10</option>
					<option value = "11"> 11</option>
					<option value = "12"> 12</option>
				</select>
				</div>
				
				<div class = ui-block-c>  
				<label for = "select-min-dur"> Min</label>
				<select name = "select-min-dur" id = "select-min-dur">
					<option value = "00"> 0 </option>
					<option value = "15"> 15 </option>
					<option value = "30"> 30 </option>
					<option value = "45"> 45 </option>
				</select>
				</div>
			
			</fieldset>
		</div>
		
		<div data-role = "fieldcontain" >
			<fieldset data-role = "controlgroup" data-type = "horizontal">
			<legend>Event Type:</legend>
			<input type = "radio" name = "radio" id="radio-public" value= "public" checked = "checked">
			<label for = "radio-public"> Public </label>
			
         	<input type="radio" name="radio" id="radio-private" value="private" >
			<label for = "radio-private"> Private</label>
			
			</fieldset>
		</div>
		Description: <br />
		<textarea id="eventDescription" name="eventDescription" placeholder="A description of your awesome event!"></textarea><br/>
		<a onClick="handleSubmit();" data-role = 'button'>Create Event!</a><br /> <!--onClick="handleSubmit()"-->
		<script>
   function handleSubmit() {
    if (confirm("Is the above information correct?")) {
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
		</form>
	</div> 
	<div data-role="footer">footer...</div> 
</div> 
<div data-role = "page" id = "nextPage" data-title = "nextPage">
	<div data-role = "header">
		<h1 class = "pageTitleText"><b>Next page </b></h1>
		<a href = "#createEvent" >to create page </a>
		<a href = "../index.php" >toIndex</a>
		<a href = "../index.php " data-direction = "reverse">toIndex reverse</a>
	</div>
	<div data-role = "content">
		<p> testing </p>
	</div>
</div>




</body>

</html> 
