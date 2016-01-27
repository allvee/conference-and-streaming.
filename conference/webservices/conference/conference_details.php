<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/27/2016
 * Time: 12:17 PM
 */

include_once "../lib/common.php";
$cn = connectDB();

$participant_conference_name = $_SESSION['conf_name'];
$conference_id = $_SESSION['conf_id'];

$query = "SELECT `Conf_Name`, `USER`, `Start_Time`, `End_Time`, `Conference_Duration`, `Participants`, `Recording`, `Notification_Channel`, `STATUS`, `room_number`, `weblink` FROM `tbl_conference` where `ID` ='$conference_id'";
$result = Sql_exec($cn, $query);
if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$data = array();

$i=0;
while ($row = Sql_fetch_array($result)) {
    $j=0;
    $data[$i][$j++] = Sql_Result($row, "ID");
    // $data[$i][$j++] = Sql_Result($row, "Conf_Name");
    $data[$i][$j++] = '<span onclick="conference_details(this,  \'' . Sql_Result($row, "ID") .'\'); return false;"> \'' . Sql_Result($row, "Conf_Name") .'\'</span>';
    $data[$i][$j++] = Sql_Result($row, "USER");
    $data[$i][$j++] = Sql_Result($row, "Start_Time");
    $data[$i][$j++] = Sql_Result($row, "End_Time");
    $data[$i][$j++] = Sql_Result($row, "Participants");
    $data[$i][$j++] = Sql_Result($row, "Recording");
    $data[$i][$j++] = Sql_Result($row, "Notification_Channel");
    $data[$i][$j++] = Sql_Result($row, "STATUS");
    //$a= Sql_Result($row, "room_number");
    // $b= Sql_Result($row, "weblink");

    $data[$i][$j++] = '<span onclick="edit_conference_list(this,  \'' . Sql_Result($row, "ID") .'\',\''.Sql_Result($row, "room_number") .'\',\''.Sql_Result($row, "weblink") .'\'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/pen.png" ></span>'
        . '&nbsp&nbsp' . '<span onclick="delete_conference_list(this, \'' . Sql_Result($row, "ID") .'\', \''.Sql_Result($row, "room_number") .'\'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/cancel.png" ></span>';


    $i++;
}

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
}
Sql_Free_Result($result);





ClosedDBConnection($cn);


if ($is_error == 0) {
    $return_data = array('status' => true, "data" => $data);
} else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.');
}

echo json_encode($return_data);