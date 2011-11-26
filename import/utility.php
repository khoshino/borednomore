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

/* get_fbtoken
 * gets the facebook access token given the app id and secret described above.
 * on success, returns an array with:
 * 'access_token' => str,
 * 'expires'      => int,
 * 'algorithm'    => 'HMAC-SHA256',
 * 'code'         => something incomprehensible string,
 * 'issed_at'     => int,
 * 'user_id'      => int
 */
function get_fbtoken($appid, $appsecret) {
 $signed_request = parse_signed_request($_COOKIE['fbsr_' . $appid], $appsecret);
 // This code checks that the facebook cookie can be accessed. It also generates
 // the access token for facebook.
 if ($signed_request != null) {
  try {
   $access_token = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=" . $appid . "&redirect_uri=&client_secret=" . $appsecret . "&code=" . $signed_request['code']);
  } catch (Exception $e) {
   return null;
  }
  parse_str($access_token, $at_response);
  $signed_request['access_token'] = $at_response['access_token'];
  $signed_request['expires'] = $at_response['expires'] + time();
  return $signed_request;
 } else {
  return null;
 }
}

/* get_friendlist
 * gets the list of user's friends. List is an array of facebook_user_ids, which are really big str of ints. 
 */
function get_friendlist($access_token, $user_id) {
 $jsonresult = file_get_contents("https://graph.facebook.com/" . $user_id . "/friends?access_token=" . $access_token);
 $data = json_decode($jsonresult, true);
 $friendlist = array();
 $data_data = $data['data'];
 foreach ($data['data'] as $key => $value) {
  $friendlist[] = $value['id'];
 }
 return $friendlist;
}

/* get_userdata
 * gets the user's data in an array where:
 * 'id' => string of the user's id
 * 'name' => full name of the user
 * 'first_name' => first name of user
 * 'last_name' => last name of user
 */
function get_userdata($user_id) {
 $jsonresult = file_get_contents("https://graph.facebook.com/" . $user_id);
 $data = json_decode($jsonresult, true);
 return $data;

}

function alphanumeric($str) {
 return preg_replace('/^\d\w/', '', $str);
}

function trimharmful($str) {
 return preg_replace('/^\d\w\s\.\?!\(\)/', '', $str);
}

function get_hours($duration) {
 return $duration / 60;
}

function get_minutes($duration) {
 return $duration % 60;
}

function to_minutes($hours, $minutes) {
 return $minutes + $hours * 60;
}
function calc_end_time($startTimeStr, $duration) {
 return strtotime($startTimeStr, $duration * 60);
}

function create_eventPage($row, $backid, $joinable, $leaveable, $loggedin) {
 $pgID = "event" . $row['e_id'];
 $pgIDContent = $pgID . "Content";
 $pgTitle = $pgID . "_" . trimharmful($row['name']);
 $dmin = $row['duration'];
 $duration = floor($dmin / 60) . 'hr  ' . ($dmin % 60) . 'min';
 $location = ($loggedin) ? $row['location'] : "Log in to get Location Info";
 $start = strtotime($row['start_time']);
 $startTime = date("g:i A", $start);
 $startDate = date("M j, Y", $start);
 $end = $start + $dmin * 60;
 $endTime = date("g:i A", $end);
 $endDate = date("M j, Y", $end);
 $category = ucwords($row['category']);
 $name = ucwords($row['name']);
 $num_participants = ($row['num_participants']) ? $row['num_participants'] : 1;
 $join_button = "";
 $leave_button = "";
 $creator = get_userdata($row['creator_fbid']);
 $creator_name = ($loggedin) ? $creator['name'] : "Log in to see Creator";
 $loginstr = '';
 $loginstr2 = '';
 $eventWall = $pgID .  "Wall";
 if (!$loggedin) {
  $loginstr = <<<LOGIN1
   FB.login(function(response) {
    if (response.authResponse) {
LOGIN1;
  $loginstr2 = <<<LOGIN2
    } else {
    window.location = "borednomore.cs147.org";
   }}, {scope: "read_friendlists"});
LOGIN2;
 }
 if ($joinable) {
  $join_button = <<<JOINBUTTON
 <form id = "join$row[e_id]" action = "../mine/myEvents.php" method="POST" data-ajax = "false" name = "join$row[e_id]">
  <input type="hidden" name="join" value="1"/>
  <input type="hidden" name="eventid" value="$row[e_id]"/>
  <a onClick='if (confirm("Are you sure you want to join this event?")) {
   $loginstr
   document.getElementById("join$row[e_id]").submit();
   $loginstr2
  }' data-role = 'button'>Join Event</a>
 </form>

JOINBUTTON;
 }
 if ($leaveable) {
  $leave_button = <<<LEAVEBUTTON
 <form id = "leave$row[e_id]" action = "./myEvents.php" method="POST" data-ajax = "false" name = "leave$row[e_id]">
  <input type="hidden" name="leave" value="1"/>
  <input type="hidden" name="eventid" value="$row[e_id]"/>
  <a onClick='if (confirm("Are you sure you want to leave this event?")) {
  document.getElementById("leave$row[e_id]").submit();
  }' data-role = 'button'>Leave Event</a>
 </form>
LEAVEBUTTON;
 }
 $returnstr = <<<EVENTPAGE
 <div data-role = "page" id = "$pgID" data-title = "$pgTitle" data-url="$pgID">
  <div data-role="header">
   <h1 class = "pageTitleText">$name Event</h1>
   <a href = "#$backid" data-direction="reverse">Back</a>
   <a href = "../index.php" data-ajax="false">Home</a>
  </div>
  <div data-role="content" id="$pgIDContent">
   <p><strong>Title: </strong> $name</p>
   <p><strong>Category: </strong>$category</p>
   <p><strong>Starts: </strong>$startTime $startDate<strong> Ends: </strong> $endTime $endDate</p>
   <p><strong>Duration: </strong>$duration</p>
   <p><strong>Location: </strong>$location</p>
   <p><strong>Creator: </strong>$creator_name</p>
   <p><strong>Number of Participants: </strong>$num_participants</p>
   <p><strong>Details: </strong>$row[description]</p>
   <br/>
   <a href = "#$eventWall">View Wall Posts</a>
   <br/>
   <br/>
   $join_button
   $leave_button
  </div>
  <div data-role="footer"></div>
 </div>
EVENTPAGE;
 return $returnstr;
}

function create_eventWall($row, $wallResults, $loggedin) {
 $pgID = "event" . $row['e_id'] . "Wall";
 $name = ucwords($row['name']);
 $pgIDContent = $pgID . "Content";
 $pgTitle = $pgID . "_" . trimharmful($row['name']);
 $backid = "event" . $row['e_id'];// the page id of the corresponding event page
 /*
 $wallpostId = $row['wallpost_id'];
 $userName = get_userdata($row['fbid'];
 $message = row['message'];
 $creator = row['creator'];
 */

 

 //$time = date("g:i A", $row['time']) ;
 //$date = date("M j, Y", $row['time']);
 
 
 $returnstr = <<<EVENTWALL
 <div data-role = "page" id = "$pgID" data-title = "$pgTitle" data-url="$pgID">
  <div data-role="header">
   <h1 class = "pageTitleText">$name Wall</h1>
   <a href = "#$backid" data-direction="reverse">Back</a>
   <a href = "../index.php" data-ajax="false">Home</a>
  </div>
  <div data-role="content" id="$pgIDContent">
   <p><strong>Title: </strong> $name</p>
	
   <br/>
   <br/>
	 <a href = "#$backid" data-direction="reverse">Back to Event Details</a>
  </div>
  <div data-role="footer"></div>
 </div>
EVENTWALL;
return $returnstr;
}


function getFBJS($appid) {
 $returnstr = <<<FBJS
 <div id="fb-root"></div>
 <script>
  (function() {
   var e = document.createElement("script"); e.async = true;
   e.src = document.location.protocol + "//connect.facebook.net/en_US/all.js";
   document.getElementById('fb-root').appendChild(e);
  }());
  window.fbAsyncInit = function() {
   FB.init({ appId: '$appid',
   status: true,
   cookie: true,
   xfbml: true,
   oauth: true});
  };
 </script>
FBJS;
 return $returnstr;
}

?>
