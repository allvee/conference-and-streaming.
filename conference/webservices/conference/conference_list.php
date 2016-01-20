<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/12/2016
 * Time: 11:47 AM
 */

include_once "../lib/common.php";
$cn = connectDB();

$tbl = "tbl_conference";

$arrayInput = array();
$query = "SELECT ID, Conf_Name, USER, Start_Time, End_Time, Participants, Recording, Notification_Channel, STATUS,room_number, weblink FROM $tbl";
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
    $data[$i][$j++] = Sql_Result($row, "Conf_Name");
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
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);

?>
