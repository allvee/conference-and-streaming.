<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/4/2016
 * Time: 5:25 PM
 */

$data = $_REQUEST;
//exit( json_encode( array("alamin"=>"one","message"=>"No reasone","status"=>false) ));
//echo json_encode( array($data) );

require_once "../lib/config.php";
require_once "../lib/common.php";
require_once "../conference/conference_scheduler.php";


$cn = connectDB();


$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));
//$notification_channel = mysql_real_escape_string(htmlspecialchars($_REQUEST['notification_channel']));

$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';
if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
}

//exit( json_encode( array($data_info) ));

$tbl = "tbl_conference";
$room_tbl = "tbl_conference_room";

$is_error = 0;
$last_updated = date('Y-m-d H:i');
$last_updated_by = $_SESSION["UserID"];



if ($action != 'delete') {

    $demo_name = $data['demo_name'];

    $_SESSION['conf_name'] = $demo_name;

    $start_time = $data['start_time'];
    $end_time = $data['end_time'];

    $response = check_scheduler($start_time, $end_time, $cn);

   // print_r($response) ;

    $status= $response["status"];
    print_r( "status:"+$status);

    $long_code = $response["long_code"];
    $web_link = $response["web_link"];
    $room_pass = $response["room_pass"];
    $room_number = $response['room_number'];

    $dteStart = new DateTime($start_time);
    $dteEnd   = new DateTime($end_time);
    $dteDiff  = $dteStart->diff($dteEnd);

    //$dteDiff->format("%H:%I:%S");
    //$web_link=$data['weblink'];

    $demo_participants = $data['demo_participants'];
    $schedule_conf = $data['schedule_conf_dropdown'];
    $demo_active = $data['demo_active'];
    $demo_active = "active";

    $demo_recording = $data['demo_recording'];

    $track_count = sizeof($_REQUEST['notification_channel']);
    $flag = 0;

    foreach ($_REQUEST['notification_channel'] as $value) {
        $flag++;
        if ($flag == $track_count) {
            $notification_channel .= $value;


        } else {
            $notification_channel .= $value . ',';
        }
    }


    if (isset($demo_active)) {  }
    else {
        $demo_active= "done";
    }
    if (isset($demo_recording)) {  }
    else {
        $demo_recording= "no";
    }


   $user_id= $_SESSION['UserID'];

}

else
{

    /*=============================== for room number and Web Link for Delete =====================*/
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
    $room_number = $data_info['room_number'];

   // echo json_encode( array("action"=>$action,"deleted_id"=>$deleted_id,"room_number"=>$room_number) );
}


if ($action == "update") {
    $msg = "Successfully Updated";
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    $qry = "UPDATE $tbl set `Conf_Name`='$demo_name',`USER`='$user_id', `room_number`='$room_number', `weblink`='$web_link',
            `CODE`='1234',`Start_Time`='$start_time',`End_Time`='$end_time',`Participants`='$demo_participants',`Recording`='$demo_recording',
            `STATUS`='$demo_active',`Schedule_Conf`='$schedule_conf',`Notification_Channel`='$notification_channel'";
    $qry .= " WHERE ID='$action_id'";

    $qry_to_room="UPDATE $room_tbl SET `room_pass`='$room_pass',`last_update` ='$last_updated', `conference_name` = '$demo_name'";
    $qry_to_room .= " WHERE `room_number` ='$room_number'";

}

else if ($action == "delete") {

    $flag='delete';
    $msg = "Successfully Deleted";
    $action_id = $deleted_id;
    $qry = "DELETE from $tbl";
    $qry .= " where ID='$action_id'";

    $qry_to_room="UPDATE $room_tbl SET last_update ='$last_updated',`conference_name` = ' '";
    $qry_to_room .= " WHERE room_number='$room_number'";

}

else {
    $msg = "Successfully Saved";
    $qry = "INSERT INTO $tbl (Conf_Name, long_number, USER, room_number, weblink, CODE, Start_Time, End_Time, Participants, Recording, STATUS, Schedule_Conf, Notification_Channel)
	VALUES('$demo_name', '$long_code', '$user_id', '$room_number', '$web_link', '$room_pass', '$start_time', '$end_time', '$demo_participants', '$demo_recording', '$demo_active', '$schedule_conf', '$notification_channel')";

    $qry_to_room="UPDATE $room_tbl SET last_update='$last_updated',conference_name= '$demo_name'";
    $qry_to_room .= " WHERE room_number='$room_number'";
}


try {
    $update_result = Sql_exec($cn, $qry_to_room);
    $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}

try {
    $res = Sql_exec($cn, $qry);
    if($flag == 'delete')
        $is_error = 2;
    else
    $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}



ClosedDBConnection($cn);




if ($is_error == 0) {
    $return_data = array('status' => true,'Name' => $demo_name, 'UserID' => $user_id , 'Long_Number'=>$long_code, 'Web_Link' => $web_link, 'Room_Number' => $room_number,
    'Code' => '$room_pass', 'Start_Time' => $start_time, 'End_Time' => $end_time, 'Conference_Duration' => $dteDiff, 'No_of_Participants' => $demo_participants,'Recording' => $demo_recording,
    'Stats' => $demo_active, 'Notification_Channel' => $notification_channel, 'Schedule_Conf' => $schedule_conf );

}
else if ($is_error == 2){
    $return_data = array('status' => true, 'message' => $msg);

}

else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.');
}

echo json_encode($return_data);

