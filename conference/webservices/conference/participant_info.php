<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/19/2016
 * Time: 7:01 PM
 */

$data = $_REQUEST;
//exit( json_encode( array("alamin"=>"one","message"=>"No reasone","status"=>false) ));
//echo json_encode( array($data) );
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "../lib/common.php";
require_once "../lib/functions.php";
require_once "../lib/asmp_lib.php";


$log_file_name = "participants_info.txt";
$print_log = 0;
if($print_log==1) file_put_contents("$log_file_name", "***New_Call****\n", FILE_APPEND);
function logcats($parameter) {
    global $log_file_name,$print_log;
    if($print_log==1) file_put_contents($log_file_name, strval($parameter)."\n", FILE_APPEND);
}


$cn = connectDB();


$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));

$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';
if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
}

//exit( json_encode( array($data_info) ));

$tbl = "tbl_participant";

$is_error = 0;
$last_updated = date('Y-m-d H:i');
$last_updated_by = $_SESSION["UserID"];


if ($action != 'delete') {

    $participant_name = $data['participant_name'];
    $participant_msisdn = $data['participant_msisdn'];
    $participant_email = $data['participant_email'];
    $participant_type = $data['participant_type'];
    //$conference_id =$data['conference_id'];
    $participant_organization = 'ssd-tech';

    $long_code = $_SESSION['conference']['room_caller'];
    $participant_conference_name = $_SESSION['conference']['conf_name'];
    $user_id = $_SESSION['conference']['UserID'];
    $conference_id = $_SESSION['conference']['conf_id'];
    $conference_status = $_SESSION['conference']['current_conference_instance']['Status'];
    $conference_start_time = $_SESSION['conference']['current_conference_instance']['Start_Time'];
    $conference_end_time = $_SESSION['conference']['current_conference_instance']['End_Time'];

} else {
    /*=============================== for room number and Web Link for Delete =====================*/
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
    $room_number = $data_info['room_number'];
}


if ($action == "update") {
    $msg = "Successfully Updated";
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    $qry = "UPDATE $tbl set `participant_name`='$participant_name',`msisdn`='$participant_msisdn', `email`='$participant_email',`conference_ID`='$conference_id', `conference_name`='$participant_conference_name',
           `long_code`='$long_code', `organization`='$participant_organization', `participant_type` ='$participant_type', `conference_status`= '$conference_status', `conference_start_time` = '$conference_start_time', `conference_end_time` = '$conference_end_time'";
    $qry .= " WHERE ID='$action_id'";



} else if ($action == "delete") {

    $flag = 'delete';
    $msg = "Successfully Deleted";
    $action_id = $deleted_id;
    $qry = "DELETE from $tbl";
    $qry .= " where ID='$action_id'";

} else {
    $msg = "Successfully Saved";
    $qry = "INSERT INTO `$tbl` (`participant_name`, `msisdn`, `email`,`conference_ID`, `conference_name`, `long_code`,`organization`, `participant_type`, `conference_status`, `conference_start_time`, `conference_end_time`)
	VALUES('$participant_name', '$participant_msisdn', '$participant_email','$conference_id', '$participant_conference_name','$long_code', '$participant_organization', '$participant_type', '$conference_status', '$conference_start_time','$conference_end_time')";
}
//echo __LINE__."</br>";
try {
    $res = Sql_exec($cn, $qry);
    if ($flag == 'delete')
        $is_error = 2;
    else
        $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}

ClosedDBConnection($cn);


if ($is_error == 0) {
    $return_data = array('status' => true, 'admin' => $last_updated_by, 'participant_name' => $participant_name, 'msisdn' => $participant_msisdn, 'participant_email' => $participant_email, 'participant_type' => $participant_type, 'participant_conference_name' => $participant_conference_name, 'participant_organization' => $participant_organization,'IVR_qry'=>$IVR_qry,'notification'=>$get_inside_notification,"SMS_server"=>$SMS_server,'SMS_URL'=>$SMS_URL,'SMS_Data'=>print_r($sms_data,1),'SMS_ret'=>$SMS_ret,'Email'=>$email_ret );

} else if ($is_error == 2) {
    $return_data = array('status' => true, 'message' => $msg);

} else if ($is_error == 3) {
    $return_data = array('status' => true, 'msisdn' => $msisdn, 'email' => $email);

} else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.');
}

echo json_encode($return_data);

