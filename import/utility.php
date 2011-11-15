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
  $access_token = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=" . $appid . "&redirect_uri=&client_secret=" . $appsecret . "&code=" . $signed_request['code']);
  parse_str($access_token, $at_response);
  $signed_request['access_token'] = $at_response['access_token'];
  $signed_request['expires'] = $at_response['expires'] + time();
  return $signed_request;
 } else {
  return null;
 }
}

/* get_friendlist
 * gets the list of user's friends. List is an array of facebook_user_ids, which are really big ints. 
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



?>
