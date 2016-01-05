<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/4/2016
 * Time: 5:25 PM
 */

$data = $_REQUEST;

require_once "../lib/config.php";
require_once "../lib/common.php";

$cn = connectDB();


$arrayInput = $_REQUEST;
$is_error = 0;



$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));


$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';
if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
}

//echo "action= $action";

$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];



if ($action== 'update') {

    $demo_name = $data['demo_name'];
    $date_picker_test = $data['date_picker_test'];
    $start_time = $data['start_time'];
    $end_time = $data['end_time'];
    $demo_participants = $data['demo_participants'];


    $emo_code = $data['emo_code'];
    $schedule_conf = $data['schedule_conf'];
    $end_date = $data['end_date'];
    $demo_active = $data['demo_active'];
    $demo_recording = $data['demo_recording'];

}




ClosedDBConnection($cn);




if ($is_error == 0) {
    $return_data = array('status' => true, 'message' => 'Successfully get at php.','$demo_name' =>$demo_name,  'date_picker_test'=>$date_picker_test,'start_time'=> $start_time, ' schedule_conf'=> $schedule_conf, 'demo_recording' => $demo_recording);

} else {
    $return_data = array('status' => false, 'message' => 'Data Not Sennd.');
}


echo json_encode($return_data);


?>