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

$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];

$data = array();

$email = mysql_real_escape_string(htmlspecialchars($_REQUEST['email_address']));
$password = mysql_real_escape_string(htmlspecialchars($_REQUEST['password']));
$smtp_account = mysql_real_escape_string(htmlspecialchars($_REQUEST['smtp_account']));
$smtp_port = mysql_real_escape_string(htmlspecialchars($_REQUEST['smtp_port']));
$email_subject = mysql_real_escape_string(htmlspecialchars($_REQUEST['email_subject']));

$email_body = mysql_real_escape_string(htmlspecialchars($_REQUEST['email_body']));

$data['email'] = $email;
$data['password'] = $password;
$data['smtp_account'] = $smtp_account;
$data['smtp_port'] = $smtp_port;
$data['email_subject']= $email_subject;
$data['email_body']= $email_body;


$json_data=json_encode($data);

$log_data_arr['user'] = $_SESSION['gcportal']['login_id'];
$log_data_arr['component'] = 'UPDATE EMAIL Config';
$log_data_arr['message'] = UPDATE_EMAIL_CONFIG.json_encode($_REQUEST);
write_activity_log_data($cn, $log_data_arr);

$qry = "update $tbl set `config`='$json_data', last_updated='$last_updated', last_updated_by='$last_updated_by' where id=1";

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