<?php

require_once "../lib/common.php";
require_once "../lib/functions.php";

$cn = connectDB();

$user_data['user'] = $_SESSION['firewall']['login_id'];
$user_data['component'] = 'CHANGE_PASSWORD';
$user_data['message'] = CHANGE_PASSWORD . json_encode($_REQUEST);
write_activity_log_data($cn, $user_data);

$password = mysql_real_escape_string(htmlspecialchars($_REQUEST['change_password']));
$retype_password = mysql_real_escape_string(htmlspecialchars($_REQUEST['re-type_password']));
$user_name = $_SESSION['firewall']['login_id'];

$URL = Marketplace_CHANGE_PASSWORD."?mdid=UPDATE_USERINFO&cmdparam=$user_name|admin|1|Pwd&cmdvalue=$password";

$result = curlRequest('GET',$URL, array());

if ($result == '+OK') {
    $return_data = array('status' => true, 'message' => 'Password Successfully Changed.');
} else {
    $return_data = array('status' => false, 'message' => 'Failed to change password.');
}
echo json_encode($return_data);