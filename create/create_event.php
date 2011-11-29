<!DOCTYPE html>
<?php
 include '../import/utility.php';
 $user_data = get_fbtoken($appid, $appsecret);
 $edit = ($_POST['editing']);
 $time = ($edit) ? strtotime($_POST['start_time']) : time();
 $duration = ($edit) ? $_POST['duration'] : 60;
 $duration = (gettype($duration) == "string") ? intval($duration) : $duration;
 $startHour = intval(date("g", $time));
 $startHour = ($startHour == 0) ? 12 : $startHour;
 $startMin = (intval(date("i", $time))) / 15;
 $startAMPM = date("A", $time);
 $durationHour = $duration / 60;
 $durationHour = ($duration == 0) ? 1 : $durationHour;
 $durationMin = ($duration % 60) / 15;
?>
<html>
<head><title><?php echo ($edit) ? "EditEventsPage" : "CreateEventsPage";?></title>
	<?php include("../import/header.php");?>
</head>

<body>
<?php if (!$user_data) echo getFBJS($appid); ?>
<div data-role="page" id = "createEvent" data-title="createEvent"> 
	<div data-role="header">
		<h1 class = "pageTitleText"><b> <?php echo ($edit) ? "Edit" : "Create";?> an Event </b></h1>
		<!-- Navigation Buttons- Change these links to link to different back pages or add links to new pages -->
		<a href = "<?php echo ($edit) ? $_POST["backloc"] : "./create_event_type.php";?>" data-icon="back" data-direction="reverse" <?php echo ($edit) ? 'data-ajax="false"' : "" ;?>>Back</a>
		<a href = "../index.php" data-icon="home" data-ajax="false">Home</a>
		<br/>
	</div> 
	
	<div data-role="content" id = "createEventContent">
		<p> Required fields are marked with an '*' </p>
		<form id = "createEventForm" action = "<?php echo ($edit) ? $_POST['backloc'] : '../mine/myEvents.php'; ?>" method="POST" data-ajax = "false" name = "createEventForm">
		<input type="hidden" id="eventEdit" name="type" value="<?php echo ($edit) ? "edit" : "create";?>"/>
<?php 
 echo ($edit) ? '<input type="hidden" id="eventEID" name="e_id" value="' . $_POST["e_id"] . '"/>' : '';
?>
		<legend class = "required">*Title: </legend><input type="text" id="eventTitle" name="eventTitle" <?php if ($edit) echo 'value = "' . $_POST["name"] . '"';?>required="required" /><br />
		<legend class = "required">*Location: </legend><input type="text" id="eventLocation" name="location" <?php if ($edit) echo 'value = "' . $_POST["location"] . '"';?>required="required" /><br />
		<span class = "required">*Type:</span> <?php echo ucwords($_POST["type"]); ?><input type="hidden" id="eventType" name="eventType" value="<?echo $_POST["type"]; ?>"/><br /><br />
		
		
		<div data-role = "fieldcontain" data-type = "horizontal">
			<fieldset data-role = "controlgroup" class = "ui-grid-c" data-type = "horizontal">
				
				<div class = "ui-block-a">
				<legend class = "required">*Start Time:</legend>
				</div>

				<div class = "ui-block-b">
				<label for = "select-hour" > Hour</label>
				<select name = "select-hour" id = "select-hour">
<?php 
 $options = "";
 $options .= '<option value = "-1"> Hour</option>'
 for ($i = 1; $i <= 12; $i++) {
  $options .= ($startHour != $i) ? '<option value = "' . $i . '"> ' . $i . '</option>' : '<option value = "'. $i . '" selected="selected"> ' . $i . '</option>';
 } 
 echo $options;
?>
				</select>
				
				 
				</div>
				<div class = ui-block-c>  
				<label for = "select-min"> Min</label>
				<select name = "select-min" id = "select-min">
<?php
 $options = "";
 $options .= '<option value = "-1"> Min</option>';
 for ($i = 0; $i <= 45; $i += 15) {
  $options .= ($startMin * 15 != $i) ? '<option value = "' . $i .'"> '. $i .'</option>' : '<option value = "' . $i .'" selected="selected"> ' . $i . '</option>';
 }
 echo $options;
?>
				</select>
				</div>
				
				<!--	
				<div class = ui-block-d>  
				<label for = "select-min"> AM/PM </label><!--need this label as a spacing placeholder-->
				<select name = "select-amPm" id = "select-amPm">
					<option value = "0" <?php echo ($startAMPM == "AM") ? 'selected="selected"' : "";?>> AM </option>
					<option value = "12" <?php echo ($startAMPM == "PM") ? 'selected="selected"' : "";?>> PM </option>
				</select>
				</div>
			</fieldset>
		
			<fieldset data-role = "controlgroup" class = "ui-grid-c" data-type = "horizontal">
				
				<div class = "ui-block-a">
				<legend>*Duration:</legend>
				</div>

				<div class = "ui-block-b">
				<label for = "select-hour_dur" > Hour</label>
				<select name = "select-hour-dur" id = "select-hour-dur" required="required">
<?php
 $options = "";
 for ($i = 1; $i <= 12; $i++) {
  $options .= ($durationHour != $i) ? '<option value = "' . $i . '"> ' . $i . '</option>' : '<option value = "' . $i . '" selected="selected"> ' . $i . '</option>';
 }
 echo $options;
?>
				</select>
				</div>
				
				<div class = ui-block-c>  
				<label for = "select-min-dur"> Min</label>
				<select name = "select-min-dur" id = "select-min-dur">
<?php
 $options = "";
 for ($i = 0; $i <= 45; $i += 15) {
  $options .= ($durationMin * 15 != $i) ? '<option value = "' . $i . '"> ' . $i . '</option>' : '<option value = "' . $i . '" selected="selected"> ' . $i . '</option>';
 }
 echo $options;
?>
				</select>
				</div>
			
			</fieldset>
		</div>
		
		<div data-role = "fieldcontain" >
			<fieldset data-role = "controlgroup" data-type = "horizontal">
			<legend>Event Type:</legend>
			<input type = "radio" name = "radio" id="radio-public" value= "public" <?php echo (!$_POST['private']) ? 'checked = "checked"' : "";?>>
			<label for = "radio-public"> Public </label>
			
         	<input type="radio" name="radio" id="radio-private" value="private" <?php echo ($_POST['private']) ? 'checked = "checked"' : "";?>>
			<label for = "radio-private"> Private</label>
			
			</fieldset>
		</div>
		Description: <br />
		<textarea id="eventDescription" name="eventDescription" placeholder="A description of your awesome event!"><?php if ($edit) echo $_POST["desc"];?></textarea><br/>
		<a onClick="handleSubmit();" data-role = 'button'><?php echo ($edit) ? "Edit" : "Create";?> Event!</a><br /> <!--onClick="handleSubmit()"-->
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
