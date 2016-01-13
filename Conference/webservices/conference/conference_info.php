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

$tbl = "tbl_conference";

$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];



if ($action != 'delete') {

    $demo_name = $data['demo_name'];
    $start_time = $data['start_time'];
    $end_time = $data['end_time'];
    $demo_participants = $data['demo_participants'];
    $schedule_conf = $data['schedule_conf_dropdown'];
    $demo_active = $data['demo_active'];
    $demo_recording = $data['demo_recording'];
    $notification_channel= $data['notification_channel'];

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
    
    $room_tbl = "tbl_conference_room";
    $room_tbl_qry="SELECT room_number, web_link FROM $room_tbl
	WHERE room_status='free' LIMIT 0, 1";

    try {
        $result = Sql_exec($cn, $room_tbl_qry);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
    }
    $data = array();
    $i=0;
    while($row = Sql_fetch_array($result))
    {
        //$data[i]=
        $web_link=Sql_Result($row, "web_link");

       // $data[i]=
        $room_number=Sql_Result($row, "room_number");
        //  $i++;
    }




}


if ($action == "update") {
    $msg = "Successfully Updated";
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    $qry = "update $tbl set `Name`='$user_name',`Group_Name`='$group_name', `Create_Date`='$current_date', `Status`='$status', `Type`='$user_type'";
    $qry .= " where ID='$action_id'";


}

else if ($action == "delete") {

    $action_id = $deleted_id;
    $qry = "DELETE from $tbl";
    $qry .= " where ID='$action_id'";

    $msg = "Successfully Deleted";

}

else {
    $msg = "Successfully Saved";
    $qry = "INSERT INTO $tbl (Conf_Name, long_number, USER, room_number, weblink, CODE, Start_Time, End_Time, Participants, Recording, STATUS, Schedule_Conf, Notification_Channel)
	VALUES('$demo_name', '$long_number', 'admin', '$room_number', '$web_link', '1234', '$start_time', '$end_time', '$demo_participants', '$demo_recording', '$demo_active', '$schedule_conf', '$notification_channel')";
}


try {
    $res = Sql_exec($cn, $qry);
    $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}



ClosedDBConnection($cn);




if ($is_error == 0) {
    $return_data = array('status' => true, 'message' => $msg , $room_number, $web_link );

} else {
    $return_data = array('status' => false, 'message' => 'Data Not Sennd.');
}


echo json_encode($return_data);


?>