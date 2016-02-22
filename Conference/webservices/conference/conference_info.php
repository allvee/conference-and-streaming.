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
require_once "../conference/conference_scheduler.php";


$cn = connectDB();


$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));

$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';
if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
}

$tbl = "tbl_conference";
$room_tbl = "tbl_conference_room";

$is_error = 0;
$last_updated = date('Y-m-d H:i');

$start_array = array("00:01", "00:31", "01:01", "01:31", "02:01", "02:31", "03:01", "03:31", "04:01", "04:31", "05:01", "05:31", "06:01",
    "06:31", "07:01", "07:31", "08:01", "08:31", "09:01", "09:31", "10:01", "10:31", "11:01", "11:31", "12:01", "12:31",
    "13:01", "13:31", "14:01", "14:31", "15:01", "15:31", "16:01", "16:31", "17:01", "17:31", "18:01", "18:31", "19:01",
    "19:31", "20:01", "20:31", "21:01", "21:31", "22:01", "22:31", "23:01", "23:31");

$end_array = array("00:30", "01:00", "01:30", "02:00", "02:30", "03:00", "03:30", "04:00", "04:30", "05:00", "05:30", "06:00", "06:30", "07:00",
    "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00",
    "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30",
    "21:00", "21:30", "22:00", "22:30", "23:00", "23:30", "11:59");

$valid_day = 30;
//echo __LINE__."</br>";
if ($action != 'delete') {
//echo __LINE__."</br>";
    $demo_name = $data['demo_name'];
    $_SESSION['conference']['conf_name'] = $demo_name;
    $user_id = $_SESSION['conference']['id'];

    $start_date = $data['start_date'];
    $_SESSION['conference']['start_date'] = $start_date;
    $end_date = $data['start_date'];
    $_SESSION['conference']['end_date'] = $end_date;
    $start_time = $data['start_time'];
    $end_time = $data['end_time'];

    $key1 = array_search($start_time, $start_array);
    $key2 = array_search($end_time, $end_array);

    $i = 0;
    $total_column = "";
//echo __LINE__."</br>";
    for ($i = $key1; $i <= $key2; $i++) {
        if (isset($total_column))
            $total_column = $total_column . " AND " . "`" . $start_array[$i] . "_" . $end_array[$i] . "`" . "=" . "'Free'";
        else
            $total_column = $total_column . "`" . $start_array[$i] . "_" . $end_array[$i] . "`" . "=" . "'Free'";

    }
//echo __LINE__."</br>";
    $start = $start_date . " " . $start_time;
    $end = $end_date . " " . $end_time;

    $date_split = explode('-', $start_date);
    $sDay =  (int) $date_split[2];
    $sMonth = (int) $date_split[1];
    $sYear = (int) $date_split[0];

    $date_split = explode('-', $end_date);
    $eDay = (int) $date_split[2];
    $eMonth = (int) $date_split[1];
    $eYear = (int) $date_split[0];
//echo __LINE__."</br>";
    $interval = " ";
    for ($i = (int)$sDay, $j = 0; $i <= $valid_day; $i = $i + 7) {
        if ($i < 24)
            $interval = $interval . "'$i'" . ",";
        else
            $interval = $interval . "'$i'";

    }
    $day = "`Day`" . " " . "in" . "(" . $interval . ")";
//echo __LINE__."</br>";
	date_default_timezone_set('Asia/Dhaka');
    $dteStart = new DateTime($start);//echo __LINE__."</br>";
    $dteEnd = new DateTime($end);//echo __LINE__."</br>";
    $dteDiff = $dteStart->diff($dteEnd);//echo __LINE__."</br>";
    $duration = (string)$dteDiff->format("%H:%I");//echo __LINE__."</br>";

    $conference_code = $data['conf_code'];//echo __LINE__."</br>";
    /*
    $response = check_scheduler($start_time, $end_time, $cn);

    $status = $response["status"];
    $long_code = $response["long_code"];
    $web_link = $response["web_link"];
    $_SESSION['conference']['long_code'] = $long_code;
    $_SESSION['conference']['Start_time']*/

    $schedule_conf = $data['schedule_conf_dropdown'];

//echo __LINE__."</br>";
    /*===================select room number from conference_scheduler DB ==============================*/

    if ($schedule_conf == 'Daily') {
        $query1 = "SELECT room_number FROM tbl_conference_scheduler WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  `Day` BETWEEN $sDay AND $valid_day  $total_column LIMIT 0,1 ";
        //echo "query1:".print_r($query1,1);
    } else if ($schedule_conf == 'Weekly') {
        $query1 = "SELECT room_number FROM tbl_conference_scheduler WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  $day  $total_column LIMIT 0,1 ";
        //echo "query1:".print_r($query1,1);
    } else {
        $query1 = "SELECT room_number FROM tbl_conference_scheduler WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`= '$sDay'  $total_column LIMIT 0,1 ";
        //echo "query1:".print_r($query1,1);
    }
//echo __LINE__."</br>";
    $result = Sql_exec($cn, $query1);
//echo __LINE__."</br>";
    while ($row = Sql_fetch_array($result)) {
        $room_number = Sql_Result($row, "room_number");
        $_SESSION['conference']['room_number'] = $room_number;
    }

    $qry = "Select `room_caller`, `web_link` from tbl_conference_room WHERE `room_number`='$room_number'";
//echo __LINE__."</br>";
    $result = Sql_exec($cn,$qry);
//echo __LINE__."</br>";
    while ($row = Sql_fetch_array($result)) {
        $_SESSION['conference']['web_link'] = $row['web_link'];
        $_SESSION['conference']['room_caller'] = $row['room_caller'];
    }
//echo __LINE__."</br>";
    $web_link = $_SESSION['conference']['web_link'];
    $long_number = $_SESSION['conference']['room_caller'];

    $demo_participants = $data['demo_participants'];
    /*$demo_active = $data['demo_active'];*/
    $demo_active = "active";
    /*if (isset($demo_active)) {

    } else {
        $demo_active = "done";
    }*/

    $demo_recording = $data['demo_recording'];
//echo __LINE__."</br>";
    if (isset($data['demo_recording']) && ($data['demo_recording']== "yes" )) {
        $demo_recording = "yes";
    }
    else if(isset($data['demo_recording']) && ($data['demo_recording']== "no" )){
        $demo_recording = "no";
    }
    else {
        $demo_recording = "no";
    }
//echo __LINE__."</br>";
    $track_count = sizeof($_REQUEST['notification_channel']);
    $flag = 0;

	$_SESSION['conference']['notification']['SMS'] = false;
	$_SESSION['conference']['notification']['IVR'] = false;
	$_SESSION['conference']['notification']['EMAIL'] = false;
	
    foreach ($_REQUEST['notification_channel'] as $value) {
        $flag++;
        if ($flag == $track_count) {
            $notification_channel .= $value;
        } else {
            $notification_channel .= $value . ',';
        }
		
        if ($value == "IVR") {
            $_SESSION['conference']['notification']['IVR'] = true;           
        }
		
        if ($value == "SMS") {
            $_SESSION['conference']['notification']['SMS'] = true;
        }

        if ($value == "EMAIL") {
            $_SESSION['conference']['notification']['EMAIL'] = true;
        }
    }
	$email_body = $data['email_body'];
	$sms_body = $data['sms_body'];
	$UserOrg = $_SESSION['conference']['org_ids'];	
//echo __LINE__."</br>";
} else {
    /*===============================  for Delete =====================*/
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
    $room_number = $data_info['room_number'];
    $start_date_time = $data_info['start_date'];
    $end_date_time = $data_info['end_date'];
    $Schedule_Conf = $data_info['Schedule_Conf'];

    $date_time_split = explode(' ', $start_date_time);
    $date_split = explode('-', $date_time_split[0]);
    $sDay = (int)$date_split[2];
    $sMonth = (int)$date_split[1];
    $sYear = (int)$date_split[0];

    $time_split = explode(':', $date_time_split[1]);
    $start_time = $time_split[0] . ":" . $time_split[1];

    $date_time_split = explode(' ', $end_date_time);
    $time_split = explode(':', $date_time_split[1]);
    $end_time = $time_split[0] . ":" . $time_split[1];

    $key1 = array_search($start_time, $start_array);
    $key2 = array_search($end_time, $end_array);


    $interval = " ";
    for ($i = (int)$sDay, $j = 0; $i <= $valid_day; $i = $i + 7) {
        if ($i < 24)
            $interval = $interval . "'$i'" . ",";
        else
            $interval = $interval . "'$i'";

    }
    $day = "`Day`" . " " . "in" . "(" . $interval . ")";

    // echo json_encode( array("action"=>$action,"deleted_id"=>$deleted_id,"room_number"=>$room_number) );
}

$run_record_qry = false;
//echo __LINE__."</br>";


if ($action == "update") {
//echo __LINE__ ."</br>";
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    $qry = "UPDATE $tbl set `Conf_Name`='$demo_name',`USER`='$user_id', `room_number`='$room_number', `weblink`='$web_link',
            `CODE`='$conference_code',`Start_Time`='$start',`End_Time`='$end',`Conference_Duration`='$duration',`Participants`='$demo_participants',`Recording`='$demo_recording', `email_body` = '$email_body',`sms_body` = '$sms_body',
            `STATUS`='$demo_active',`Schedule_Conf`='$schedule_conf',`Notification_Channel`='$notification_channel' WHERE ID='$action_id'";
    //echo __LINE__.$qry;
    $conf_id = $action_id;
    $_SESSION['conference']['conf_id'] = $action_id;

    $qry_to_room = "UPDATE $room_tbl SET `room_pass`='$conference_code',`last_update` ='$last_updated', `conference_name` = '$demo_name' WHERE `room_number` ='$room_number'";
//echo __LINE__."</br>";
$total_column_set = "";
    for ($i = $key1; $i <= $key2; $i++) {
        $column = $start_array[$i] . "_" . $end_array[$i];
        if ($i < $key2)
            $total_column_set = $total_column_set . "`" . $column . "`" . "=" . "'$action_id'" . " , ";
        else
            $total_column_set = $total_column_set . "`" . $column . "`" . "=" . "'$action_id'";
    }

    if ($schedule_conf == 'Daily') {
        $query2 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  `Day` BETWEEN $sDay AND $valid_day  $total_column AND  `room_number`='$room_number' ";
        //echo "query2:".print_r($query2,1);
    } else if ($schedule_conf == 'Weekly') {
        $query2 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  $day  $total_column AND  `room_number`='$room_number' ";
        //echo "query2:".print_r($query2,1);
    } else {
        $query2 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`= '$sDay'  $total_column AND  `room_number`='$room_number' ";
        //echo "query2:".print_r($query2,1);
    }
    //echo __LINE__."</br>";
    try {
        $update_result = Sql_exec($cn, $query2);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
    }
//echo __LINE__."</br>";
    if ($demo_recording == 'no') {
        $record_qry = "Delete from $Call_Handler_DB.outdialque where UserId = $conf_id";
        $run_record_qry = true;
        // echo $record_qry ."line: ". __LINE__;
    }

    $msg = "Successfully Updated";
} 
else if ($action == "delete") {

    $flag = 'delete';

    $action_id = $deleted_id;
    $qry = "DELETE from $tbl where ID ='$action_id'";

    $qry_participant = "DELETE from tbl_participant WHERE conference_ID ='$action_id'";

    $qry_to_room = "UPDATE $room_tbl SET last_update ='$last_updated',`conference_name` = ' ' WHERE room_number='$room_number'";


    $total_column_set = "";
    $total_column_was = "";
    for ($i = $key1; $i <= $key2; $i++) {
        $column = $start_array[$i] . "_" . $end_array[$i];
        if ($i < $key2) {
            $total_column_set = $total_column_set . "`" . $column . "`" . "=" . "'Free'" . " , ";
            $total_column_was = $total_column_was . "`" . $column . "`" . "=" . "'$action_id'" . " AND ";
        } else {
            $total_column_set = $total_column_set . "`" . $column . "`" . "=" . "'Free'";
            $total_column_was = $total_column_was . "`" . $column . "`" . "=" . "'$action_id'";
        }


    }
    if ($Schedule_Conf == 'Daily') {
        $query3 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  `Day` BETWEEN $sDay AND $valid_day AND $total_column_was AND  `room_number`='$room_number' ";
        //echo "query3:".print_r($query3,1);
    } else if ($Schedule_Conf == 'Weekly') {
        $query3 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND $day AND $total_column_was AND  `room_number`='$room_number' ";
        //echo "query3:".print_r($query3,1);
    } else {
        $query3 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`= '$sDay' AND $total_column_was AND  `room_number`='$room_number' ";
        //echo "query3:".print_r($query3,1);

    }

    try {
        $update_result = Sql_exec($cn, $query3);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
    }

    $record_qry = "Delete from $Call_Handler_DB.outdialque where UserId = $conf_id";

    $msg = "Successfully Deleted";
} else {

    $qry = "INSERT INTO $tbl (Conf_Name, long_number, USER, room_number, weblink, CODE, Start_Time, End_Time, Conference_Duration, Participants, Recording, STATUS, Schedule_Conf, Notification_Channel, email_body, sms_body,UserOrg)
	VALUES('$demo_name', '$long_number', '$user_id', '$room_number', '$web_link', '$conference_code', '$start', '$end', '$duration' ,'$demo_participants', '$demo_recording', '$demo_active', '$schedule_conf', '$notification_channel', '$email_body','$sms_body','$UserOrg')";

    $qry_to_room = "UPDATE $room_tbl SET last_update='$last_updated',conference_name= '$demo_name' WHERE room_number='$room_number'";
//echo __LINE__."qry: ".$qry."</br>";
//echo __LINE__."</br>";

    $msg = "Successfully Saved";
}

//echo __LINE__."</br>";
try {
    $update_result = Sql_exec($cn, $qry_to_room);
    $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}
//echo __LINE__."</br>";
try {
    $res = Sql_exec($cn, $qry);
    if ($flag == 'delete') {
        $res = Sql_exec($cn, $qry_participant);
        $is_error = 2;
    } else
        $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}
//echo __LINE__."</br>";
if ($run_record_qry) {
    try {
        //echo __LINE__."qry: ".$record_qry."</br>";
		$ret = Sql_exec($cn, $record_qry);
		
        //logcats("Query: " . $record_qry);
        //logcats("Result: " . $ret);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
        $msg = $e;
    }
}
//echo __LINE__."</br>";
/*================================== for conference id ======================================================*/
if ($action == "save") {
    $qry_for_id = "SELECT ID FROM `tbl_conference` WHERE `Conf_Name`='$demo_name' and `long_number`= '$long_number' and `USER`='$user_id' and `room_number`='$room_number' and `weblink`='$web_link' and
                  `CODE`='$conference_code'and `Start_Time`='$start' and `End_Time`='$end' and `Participants`='$demo_participants' and `Recording`='$demo_recording' and
                 `STATUS`='$demo_active' and  `Schedule_Conf`='$schedule_conf' and `Notification_Channel`='$notification_channel'";

    $result = Sql_exec($cn, $qry_for_id);

    while ($row = Sql_fetch_array($result)) {
        $conf_id = Sql_Result($row, "ID");
    }

    /*================================== Set conference id to Scheduler table ======================================================*/
    $_SESSION['conference']['conf_id'] = $conf_id;
    $total_column_set = "";
    for ($i = $key1; $i <= $key2; $i++) {
        $column = $start_array[$i] . "_" . $end_array[$i];
        if ($i < $key2)
            $total_column_set = $total_column_set . "`" . $column . "`" . "=" . "'$conf_id'" . " , ";
        else
            $total_column_set = $total_column_set . "`" . $column . "`" . "=" . "'$conf_id'";
    }

    if ($schedule_conf == 'Daily') {
        $query2 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  `Day` BETWEEN $sDay AND $valid_day  $total_column AND  `room_number`='$room_number' ";
        //echo "query2:".print_r($query2,1);
    } else if ($schedule_conf == 'Weekly') {
        $query2 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  $day  $total_column AND  `room_number`='$room_number' ";
        //echo "query2:".print_r($query2,1);
    } else {
        $query2 = "UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`= '$sDay'  $total_column AND  `room_number`='$room_number' ";
        //echo "query2:".print_r($query2,1);
    }

    /*
	if ($demo_recording == 'yes') {
        $record_qry = "insert into $Call_Handler_DB.outdialque set MSISDN = '$room_number',DisplayAno = '$long_code',OriginalAno = '2008',
ServiceId = 'record_conference', OutDialStatus = 'QUE', RetTryCount='1',UserId = '$conference_id', OutDialTime = '$start_date_time'";
        $run_record_qry = true;
    }

    if ($run_record_qry) {
        try {
            $ret = Sql_exec($cn, $record_qry);
            //logcats("Query: " . $record_qry);
            //logcats("Result: " . $ret);
            $is_error = 0;
        } catch (Exception $e) {
            $is_error = 1;
            $msg = $e;
        }
    }*/

    try {
        $update_result = Sql_exec($cn, $query2);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
    }

}

ClosedDBConnection($cn);

$_SESSION['conference']['current_conference_instance']['ID'] = $conf_id;
$_SESSION['conference']['current_conference_instance']['Conf_Name'] = $demo_name;
$_SESSION['conference']['current_conference_instance']['long_number'] = $long_number;
$_SESSION['conference']['current_conference_instance']['room_number'] = $room_number;
$_SESSION['conference']['current_conference_instance']['Code'] = $conference_code;
$_SESSION['conference']['current_conference_instance']['Start_Time'] = $start;
$_SESSION['conference']['current_conference_instance']['End_Time'] = $end;
$_SESSION['conference']['current_conference_instance']['Conference_Duration'] = $dteDiff;
$_SESSION['conference']['current_conference_instance']['Participants'] = $demo_participants;
$_SESSION['conference']['current_conference_instance']['Recording'] = $demo_recording;
$_SESSION['conference']['current_conference_instance']['Status'] = $demo_active;
$_SESSION['conference']['current_conference_instance']['Schedule_Conf'] =$schedule_conf;
$_SESSION['conference']['current_conference_instance']['Notification_Channel'] = $notification_channel;
$_SESSION['conference']['current_conference_instance']['weblink'] = $web_link;
$_SESSION['conference']['current_conference_instance']['action'] = $action;
$_SESSION['conference']['current_conference_instance']['email_body'] = $email_body;
$_SESSION['conference']['current_conference_instance']['sms_body'] = $sms_body;


if ($is_error == 0) {
    $return_data = array('status' => true, 'UserOrg'=>$UserOrg,'query1' => $query1, 'query2' => $query2, 'conf_id' => $conf_id, 'Name' => $demo_name, 'UserID' => $user_id, 'Long_Number' => $long_number, 'Web_Link' => $web_link, 'Room_Number' => $room_number,
        'Code' => $conference_code, 'Start_Time' => $start, 'End_Time' => $end, 'Conference_Duration' => $dteDiff, 'No_of_Participants' => $demo_participants, 'Recording' => $demo_recording,
        'Stats' => $demo_active, 'Notification_Channel' => $notification_channel, 'Schedule_Conf' => $schedule_conf,'notifications'=>$flag,'email_body'=>$email_body,'sms_body'=>$sms_body);

} else if ($is_error == 2) {
    $return_data = array('status' => true, 'query3' => $query3, 'message' => $msg);

} else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.Error: ' . $msg);
}
//echo __LINE__."</br>";
echo json_encode($return_data);
