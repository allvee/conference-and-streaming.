<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/4/2016
 * Time: 5:25 PM
 */

$data = $_REQUEST;
//exit( json_encode( array("alamin"=>"one","message"=>"No reasone","status"=>false) ));
exit( json_encode( array($data) ));

require_once "../lib/config.php";
require_once "../lib/common.php";

$cn = connectDB();


$arrayInput = $_REQUEST;
$is_error = 0;



$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));
//$notification_channel = mysql_real_escape_string(htmlspecialchars($_REQUEST['notification_channel']));

$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';
if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
}

$tbl = "tbl_conference";

$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];



if ($action != 'delete') {

    $demo_name = $data['demo_name'];
    $start_time = $data['start_time'];
    $end_time = $data['end_time'];

    $dteStart = new DateTime($start_time);
    $dteEnd   = new DateTime($end_time);
    $dteDiff  = $dteStart->diff($dteEnd);
    //$dteDiff->format("%H:%I:%S");

    $room_number=$data['room_number'];
    $web_link=$data['weblink'];

    $demo_participants = $data['demo_participants'];
    $schedule_conf = $data['schedule_conf_dropdown'];
    $demo_active = $data['demo_active'];
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

    /*=============================== for long number  =====================*/

    $participants_tbl = "tbl_pariticipant";

    $participants_tbl_qry="SELECT  msisdn FROM $participants_tbl WHERE conference_name='$demo_name'" ;


    try {
        $res = Sql_exec($cn, $participants_tbl_qry);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
    }
if($row = Sql_fetch_array($res))
    $long_number=Sql_Result($row, "msisdn");


    /*=============================== for room number and Web Link=====================*/

    if ($action != 'update'){
        $room_tbl = "tbl_conference_room";
        $room_tbl_qry="SELECT room_number, web_link FROM `tbl_conference_room`
	                    WHERE room_status='free' LIMIT 0, 1";

        try {
            $result = Sql_exec($cn, $room_tbl_qry);
            $is_error = 0;
        } catch (Exception $e) {
            $is_error = 1;
        }

        $data = array();

        while($row = Sql_fetch_array($result))
        {

            $web_link=Sql_Result($row, "web_link");
            $room_number=Sql_Result($row, "room_number");

        }
    }


   $user_id= $_SESSION['UserID'];

}

else
{

    /*=============================== for room number and Web Link for Delete =====================*/

    $room_number=$data['room_number'];
    $web_link=$data['weblink'];
}


if ($action == "update") {
    $msg = "Successfully Updated";
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    $qry = "UPDATE $tbl set `Conf_Name`='$demo_name',`USER`='$user_id', `room_number`='$room_number', `weblink`='$web_link',
            `CODE`='1234',`Start_Time`='$start_time',`End_Time`='$end_time',`Participants`='$demo_participants',`Recording`='$demo_recording',
            `STATUS`='$demo_active',`Schedule_Conf`='$schedule_conf',`Notification_Channel`='$notification_channel'";
    $qry .= " WHERE ID='$action_id'";

    $qry_to_room="UPDATE $room_tbl SET room_status='busy',last_update='$last_updated'";
    $qry_to_room .= " WHERE room_number='3002'";

}

else if ($action == "delete") {
    $msg = "Successfully Deleted";
    $action_id = $deleted_id;
    $qry = "DELETE from $tbl";
    $qry .= " where ID='$action_id'";

    $qry_to_room="UPDATE $room_tbl SET room_status='free',last_update='$last_updated'";
    $qry_to_room .= " WHERE room_number='$room_number'";

}

else {
    $msg = "Successfully Saved";
    $qry = "INSERT INTO $tbl (Conf_Name, long_number, USER, room_number, weblink, CODE, Start_Time, End_Time, Participants, Recording, STATUS, Schedule_Conf, Notification_Channel)
	VALUES('$demo_name', '$long_number', '$user_id', '$room_number', '$web_link', '1234', '$start_time', '$end_time', '$demo_participants', '$demo_recording', '$demo_active', '$schedule_conf', '$notification_channel')";

    $qry_to_room="UPDATE $room_tbl SET room_status='busy',last_update='$last_updated'";
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
    $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}



ClosedDBConnection($cn);




if ($is_error == 0) {
    $return_data = array('status' => true,'Name' => $demo_name, 'UserID' => $user_id , 'Long_Number'=>$long_number, 'Web_Link' => $web_link, 'Room_Number' => $room_number,
    'Code' => '1234', 'Start_Time' => $start_time, 'End_Time' => $end_time, 'Conference_Duration' => $dteDiff, 'No_of_Participants' => $demo_participants,'Recording' => $demo_recording,
    'Stats' => $demo_active, 'Notification_Channel' => $notification_channel, 'Schedule_Conf' => $schedule_conf );

} else {
    $return_data = array('status' => false, 'message' => 'Data Not Sennd.');
}

echo json_encode($return_data);

