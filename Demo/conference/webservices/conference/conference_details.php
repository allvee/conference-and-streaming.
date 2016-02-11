<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/27/2016
 * Time: 12:17 PM
 */

include_once "../lib/common.php";
$cn = connectDB();
$data= $_REQUEST;

$conference_id= $data['info'];
//print_r($conference_id);

$query = "SELECT `Conf_Name`, `long_number`, `USER`, `room_number`, `CODE`, `Start_Time`, `End_Time`, `Conference_Duration`, `Participants`, `Recording`, `STATUS`, `Schedule_Conf`, `Notification_Channel`, `weblink` FROM `tbl_conference` where `ID` ='$conference_id'";
$result = Sql_exec($cn, $query);

if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}
//print_r(Sql_fetch_array($result));

while ($row = Sql_fetch_array($result)) {

    $conf_name = Sql_Result($row, "Conf_Name");
    $long_number = Sql_Result($row, "long_number");
    $user = Sql_Result($row, "USER");
    $weblink = Sql_Result($row, "weblink");
    $code = Sql_Result($row, "CODE");
    $Start_Time = Sql_Result($row, "Start_Time");
    $End_Time = Sql_Result($row, "End_Time");
    $Conference_Duration = Sql_Result($row, "Conference_Duration");
    $Recording = Sql_Result($row, "Recording");
    $Notification_Channel = Sql_Result($row, "Notification_Channel");
    $Recording = Sql_Result($row, "Recording");
    $Schedule_Conf = Sql_Result($row, "Schedule_Conf");
    $STATUS = Sql_Result($row, "STATUS");
    $Participants =  Sql_Result($row, "Participants");

    $is_error = 0;
}

/*
$arrayInput = array();
$query = "SELECT  participant_name, msisdn, email FROM `tbl_participant` where conference_ID ='$conference_id'";
$result = Sql_exec($cn, $query);
$data = array();
$i = 0;
while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $data[$i][$j++] = Sql_Result($row, "participant_name");
    $data[$i][$j++] = Sql_Result($row, "msisdn");
    $data[$i][$j++] = Sql_Result($row, "email");
    $i++;
}*/

Sql_Free_Result($result);

ClosedDBConnection($cn);


if ($is_error == 0) {
    $return_data = array('status' => true, 'conference_id' =>$conference_id,"Conf_Name" => $conf_name, "long_number" => $long_number, "USER" => $user, "Notification_Channel" =>$Notification_Channel,
        "weblink" => $weblink, "CODE" => $code, "Start_Time" => $Start_Time, "End_Time" => $End_Time, "Conference_Duration" => $Conference_Duration,
        "STATUS" =>$STATUS, "Participants" =>$Participants, "Recording" =>$Recording, "Schedule_Conf" =>$Schedule_Conf);
} else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.');
}

echo json_encode($return_data);
