<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 2/4/2016
 * Time: 6:40 PM
 */
include_once "../lib/common.php";

$data= $_REQUEST;
$conference_id= $data['info'];
//echo print_r($conference_id);

$start_array = array("00:01", "00:31", "01:01", "01:31", "02:01", "02:31", "03:01", "03:31", "04:01", "04:31", "05:01", "05:31", "06:01",
    "06:31", "07:01", "07:31", "08:01", "08:31", "09:01", "09:31", "10:01", "10:31", "11:01", "11:31", "12:01", "12:31",
    "13:01", "13:31", "14:01", "14:31", "15:01", "15:31", "16:01", "16:31", "17:01", "17:31", "18:01", "18:31", "19:01",
    "19:31", "20:01", "20:31", "21:01", "21:31", "22:01", "22:31", "23:01", "23:31");

$end_array = array("00:30", "01:00", "01:30", "02:00", "02:30", "03:00", "03:30", "04:00", "04:30", "05:00", "05:30", "06:00", "06:30", "07:00",
    "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00",
    "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30",
    "21:00", "21:30", "22:00", "22:30", "23:00", "23:30", "11:59");

$valid_day = 30;

$cn = connectDB();
$Start_Time=" ";
$End_Time =" ";

 $query = "SELECT Start_Time, End_Time FROM tbl_conference WHERE `ID` = '$conference_id'";
$result = Sql_exec($cn, $query);
$data = array();

while ($row = Sql_fetch_array($result)) {
    $Start_Time = Sql_Result($row, "Start_Time");
    $End_Time = Sql_Result($row, "End_Time");
}
Sql_Free_Result($result);

echo print_r($Start_Time);
echo print_r($End_Time);
/*================================== Set conference id to Scheduler table ======================================================*/


$date_split = explode(" ", $Start_Time);
$start_date = $date_split[0];

echo print_r($start_date);

$str_time = $date_split[1];
$start_time =$str_time[0].":".$str_time[1];

echo print_r($start_time);
echo print_r("/and/");

$date_split = explode('-', $start_date);
$sDay = $date_split[2];
$sMonth = $date_split[1];
$sYear = $date_split[0];


$edate_split = explode(" ", $End_Time);
$end_date = $edate_split[0];
echo print_r($end_date);

echo print_r("/and/");

$e_time = $edate_split[1];
$end_time =$e_time[0].":".$e_time[1];
echo print_r($end_time);
echo print_r("/and/");
$date_split = explode('-', $end_date);
$eDay = $date_split[2];
$eMonth = $date_split[1];
$eYear = $date_split[0];

$key1 = array_search($start_time, $start_array);
$key2 = array_search($end_time, $end_array);

echo print_r($start_time);
echo print_r("and");
echo print_r($end_time);

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

echo "query3:".print_r($query3,1);

ClosedDBConnection($cn);