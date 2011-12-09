<!DOCTYPE html>
<?php
 include '../import/utility.php';
 ini_set('display_errors', 0); // for display. NOT FOR DEBUGGING
 $user_data = get_fbtoken($appid, $appsecret);
 $edit = ($_POST['editing']);
 $time = ($edit) ? strtotime($_POST['start_time']) : time();
 $min_time = time();
 $duration = ($edit) ? $_POST['duration'] : 60;
 $duration = (gettype($duration) == "string") ? intval($duration) : $duration;
 $startHour = intval(date("g", $time));
 $startHour = ($startHour == 0) ? 12 : $startHour;
 $minHour = (intval(date("g", $min_time)));
 $minHour = ($minHour == 0) ? 12 : $minHour;
 $startMin = floor((intval(date("i", $time))) / 15);
 $minMin = floor((intval(date("i", $min_time))) / 15);
 $startAMPM = date("A", $time);
 $minAMPM = date("A", $min_time);
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
		<a href = "<?php echo ($edit) ? $_POST["backloc"] : "./create_event_type.php";?>" class = "headerButton" data-icon="back" data-direction="reverse" <?php echo ($edit) ? 'data-ajax="false"' : "" ;?>>Back</a>
		<a href = "../index.php" class = "headerButton" data-icon="home" data-ajax="false">Home</a>
		<br/>
	</div> 
	
	<div data-role="content" id = "createEventContent">
		<p> Required fields are marked with an '*' </p>
		<form id = "createEventForm" action = "<?php echo ($edit) ? $_POST['backloc'] : '../mine/myEvents.php'; ?>" method="POST" data-ajax = "false" name = "createEventForm">
		<input type="hidden" id="eventEdit" name="type" value="<?php echo ($edit) ? "edit" : "create";?>"/>
<?php 
 echo ($edit) ? '<input type="hidden" id="eventEID" name="e_id" value="' . $_POST["e_id"] . '"/>' : '';
?>
		<legend> <span class = "required">*Title: </span></legend><input type="text" id="eventTitle" name="eventTitle" <?php if ($edit) echo 'value = "' . $_POST["name"] . '"';?>required="required" /><br />
		<legend> <span class = "required">*Location: </span></legend><input type="text" id="eventLocation" name="location" <?php if ($edit) echo 'value = "' . $_POST["location"] . '"';?>required="required" /><br/>
		<legend><span class = "required">*Type:</span> <?php echo ucwords($_POST["type"]); ?></legend><input type="hidden" id="eventType" name="eventType" value="<?echo $_POST["type"]; ?>"/><br/>		
		
		<!--<div class = "ui-block-a">-->
				<legend ><span class = "required">*Start Time:</span></legend>
		<!--</div>-->
		<fieldset data-role = "controlgroup" data-type = "horizontal">
		
		<input type = "radio" name = "select-date" id="select-date-today" value= "today" <?php echo ($_POST['today'] != 'false') ? 'checked = "checked"' : "";?>>
		<label for = "select-date-today"> Today </label>
		<input type="radio" name="select-date" id="select-date-tomorrow" value="tomorrow" <?php echo ($_POST['today'] == 'false') ? 'checked = "checked"' : "";?>>
		<label for = "select-date-tomorrow"> Tomorrow </label>
		</fieldset>
		<div data-role = "fieldcontain" data-type = "horizontal">
			<fieldset data-role = "controlgroup" class = "ui-grid-c" data-type = "horizontal">
				<div class = "ui-block-b">
				<select name = "select-hour" id = "select-hour">
<?php 
 $options = "";
 $options .= '<option value = "-1"> Hour</option>';
 for ($i = 1; $i <= 12; $i++) {
  $options .= ($startHour != $i) ? '<option value = "' . $i . '"> ' . $i . '</option>' : '<option value = "'. $i . '" selected="selected"> ' . $i . '</option>';
 } 
 echo $options;
?>
				</select>
				</div>
				<div class = ui-block-c>  
				<select name = "select-min" id = "select-min">
<?php
 $options = "";
 $options .= '<option value = "-1"> Min</option>';
 for ($i = 0; $i <= 45; $i += 15) {
  $optiondisp = ($i != 0) ? $i : "00";
  $options .= ($startMin * 15 != $i) ? '<option value = "' . $i .'"> '. $optiondisp .'</option>' : '<option value = "' . $i .'" selected="selected"> ' . $optiondisp . '</option>';
 }
 echo $options;
?>
				</select>
				</div>
				
				<select name = "select-amPm" id = "select-amPm">
					<option value = "0" <?php echo ($startAMPM == "AM") ? 'selected="selected"' : "";?>> AM </option>
					<option value = "12" <?php echo ($startAMPM == "PM") ? 'selected="selected"' : "";?>> PM </option>
				</select>
			</fieldset>
		
			<fieldset data-role = "controlgroup" class = "ui-grid-c" data-type = "horizontal">				
				<div class = "ui-block-a">
				<legend ><span class = "required">*Duration:</span></legend>
				</div>
				<div class = "ui-block-b">
				<select name = "select-hour-dur" id = "select-hour-dur" required="required">
<?php
 $options = "";
 $options .= '<option value = "-1"> Hour</option>';
 for ($i = 1; $i <= 12; $i++) {
  $options .= ($durationHour != $i) ? '<option value = "' . $i . '"> ' . $i . '</option>' : '<option value = "' . $i . '" selected="selected"> ' . $i . '</option>';
 }
 echo $options;
?>
				</select>
				</div>
				
				<div class = ui-block-c>  
				<select name = "select-min-dur" id = "select-min-dur">
<?php
 $options = "";
 $options .= '<option value = "-1"> Min</option>';
 for ($i = 0; $i <= 45; $i += 15) {
  $optiondisp = ($i != 0) ? $i : "00";
  $options .= ($durationMin * 15 != $i) ? '<option value = "' . $i . '"> ' . $optiondisp . '</option>' : '<option value = "' . $i . '" selected="selected"> ' . $optiondisp . '</option>';
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
		<legend><span class = "createEventLabel"> Description:</span></legend> <br />
		<textarea id="eventDescription" name="eventDescription" placeholder="A description of your awesome event!"><?php if ($edit) echo $_POST["desc"];?></textarea><br/>
		<a onClick="handleSubmit();" data-role = 'button'><?php echo ($edit) ? "Edit" : "Create";?> Event!</a><br /> <!--onClick="handleSubmit()"-->
		<script>
   function handleSubmit() {
    var title = document.getElementById("eventTitle").value.length;
    var loc = document.getElementById("eventLocation").value.length;
    var ev_type = document.getElementById("eventType").value.length;
    var st_day_today = document.getElementById("select-date-today").checked;
    var st_day_tomorrow = document.getElementById("select-date-tomorrow").checked;
    var st_hour = document.getElementById("select-hour").value;
    var st_min = document.getElementById("select-min").value;
    var st_ampm_pub = document.getElementById("radio-public").checked; // boolean
    var st_ampm_pri = document.getElementById("radio-private").checked; // boolean
    var hour_int = parseInt(st_hour);
    var min_int = parseInt(st_min);
    var ampm = document.getElementById("select-amPm").value;
    var dr_hour = document.getElementById("select-hour-dur").value;
    var dr_min  = document.getElementById("select-min-dur").value;
    var failstrfirst = "Please fill out the following: ";
    var failstr = "";
    var past_fail = false;
    var fail = false;
    var back_ev = false;
    var trueval = true;
    if (st_day_today) {
     if (ampm == 0 && trueval == <?php echo ($minAMPM == "PM")? 'true' : 'false';?>) {
       past_fail = true;
     } else if (ampm == <?php echo ($minAMPM == "AM") ? '0' : '12';?>) {
      if (hour_int < <?php echo $minHour;?> || hour_int == 12 && <?php echo $minHour;?> < 12) {
        past_fail = true;
      } else if (hour_int == <?php echo $minHour;?> && min_int < 15 * <?php echo $minMin;?>) {
        past_fail = true;
      }
     }
    }
    if (title == 0) {
     failstr += "Title";
     fail = true;
    }
    if (loc == 0) {
     failstr += (failstr.length == 0) ? "Location" : ", Location";
     fail = true;
    }
    if (ev_type == 0) {
     back_ev = true;
    } 
    if (!(parseInt(st_hour) >= 1 && parseInt(st_hour) <= 12)) {
     failstr += (failstr.length == 0) ? "Starting Hour" : ", Starting Hour";
     fail = true;
    }
    if (!(parseInt(st_min) == 0 || parseInt(st_min) == 15 || parseInt(st_min) == 30 || parseInt(st_min) == 45)) {
     failstr += (failstr.length == 0) ? "Starting Minute" : ", Starting Minute";
     fail = true;
    }
    if (!st_ampm_pub && !st_ampm_pri) {
     failstr += (failstr.length == 0) ? "AM or PM" : ", AM or PM";
     fail = true;
    }
    if (!(parseInt(dr_hour) >= 1 && parseInt(dr_hour) <= 12)) {
     failstr += (failstr.length == 0) ? "Duration Hours" : ", Duration Hours";
     fail = true;
    }
    if (!(parseInt(dr_min) == 0 || parseInt(dr_min) == 15 || parseInt(dr_min) == 30 || parseInt(dr_min) == 45)) {
     failstr += (failstr.length == 0) ? "Duration Minutes" : ", Duration Mintues";
     fail = true;
    }
    if (back_ev) {
     if(confirm("You must first select a category. Would you like to select a category?")) {
      window.location = "./create_event_type.php";
     }
    } else if (fail || past_fail) {
     if (fail)
      failstr = failstrfirst + failstr + ". ";
     if (past_fail)
      failstr = failstr + "You can't create an event in the past. ";
     alert(failstr);
    } else {
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
   }
		</script>
		</form>
	</div> 
	<div data-role="footer"><h1 class = "pageTitleText">Bored No More</h1></div> 
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
	<div data-role = "footer"></div>
</div>




</body>

</html> 
