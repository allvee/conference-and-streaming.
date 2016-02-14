<?php
/**
 * Created by PhpStorm.
 * User: Nazibul
 * Date: 5/14/2015
 * Time: 4:37 PM
 */

require_once "../lib/common.php";
require_once "../lib/functions.php";
//require_once "../../Lib/rcportalLib.php";
//require_once "../lib/filewriter.php";


$cn = connectDB();
$is_error = 1;
$msg = "";

$tbl = "tbl_alert_config";

$is_error = 1;
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];

$data = array();

$api_url = mysql_real_escape_string(htmlspecialchars($_REQUEST['api_url']));
$user_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_name']));
$password = mysql_real_escape_string(htmlspecialchars($_REQUEST['password']));
$mask = mysql_real_escape_string(htmlspecialchars($_REQUEST['mask']));
$sms_text = mysql_real_escape_string(htmlspecialchars($_REQUEST['sms_text']));

$data['api_url'] = $api_url;
$data['user_name'] = $user_name;
$data['password'] = $password;
$data['mask'] = $mask;

$data['sms_text'] = $sms_text;



$json_data=json_encode($data);

$log_data_arr['user'] = $_SESSION['gcportal']['login_id'];
$log_data_arr['component'] = 'UPDATE SMS Config';
$log_data_arr['message'] = UPDATE_SMS_CONFIG.json_encode($_REQUEST);
write_activity_log_data($cn, $log_data_arr);

$qry = "update $tbl set `config`='$json_data', last_updated='$last_updated', last_updated_by='$last_updated_by' where id=2";

try {
    $res = Sql_exec($cn, $qry);
	$msg = "Successfully Updated";
	$is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}

ClosedDBConnection($cn);

	if ($is_error) {
   		$return_data = array('status' => false, 'message' => 'Failed');
	} else {
    	$return_data = array('status' => true, 'message' => $msg);
	}
	
	echo json_encode($return_data);
?>