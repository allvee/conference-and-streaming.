<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 2/1/2016
 * Time: 2:25 PM
 */


require_once "../lib/config.php";
require_once "../lib/common.php";

$cn = connectDB();

$data = $_REQUEST;
$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));


$start_array = array("00:01","00:31","01:01","01:31","02:01","02:31","03:01","03:31","04:01","04:31","05:01","05:31","06:01",
    "06:31","07:01","07:31","08:01","08:31","09:01","09:31","10:01","10:31","11:01","11:31","12:01","12:31",
    "13:01","13:31","14:01","14:31","15:01","15:31","16:01","16:31","17:01","17:31","18:01","18:31","19:01",
    "19:31","20:01","20:31","21:01","21:31","22:01","22:31","23:01","23:31");
//echo print_r($start_array);


$end_array = array("00:30","01:00","01:30","02:00","02:30","03:00","03:30","04:00","04:30","05:00","05:30","06:00","06:30","07:00",
    "07:30","08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00",
    "14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30","19:00","19:30","20:00","20:30",
    "21:00","21:30","22:00","22:30","23:00","23:30","11:59");
//echo print_r($end_array);
$valid_day=30;


$demo_name = $data['demo_name'];
$start_date = $data['start_date'];
$end_date   =$data['end_date'];
$start_time = $data['start_time'];
$end_time = $data['end_time'];

$key1 = array_search($start_time, $start_array);
$key2 = array_search($end_time, $end_array);

$i=0;
$total_column="";

for($i=$key1; $i<=$key2; $i++)
{
    if(isset($total_column))
        $total_column=$total_column." AND "."`".$start_array[$i]."_".$end_array[$i]."`"."="."'Free'";
    else
        $total_column= $total_column."`".$start_array[$i]."_".$end_array[$i]."`"."="."'Free'";

}
//echo print_r($total_column);

$start = $start_date . " ".$start_time;
$end  = $end_date." ".$end_time;

$date_split= explode('-', $start_date);
$sDay = (int) $date_split[2];
$sMonth = (int) $date_split[1];
$sYear = (int) $date_split[0];

$interval= " ";
for($i= (int) $sDay,$j=0;$i<=$valid_day;$i=$i+7)
{
    if($i<24)
        $interval= $interval."'$i'". ",";
    else
        $interval= $interval."'$i'";

}
$day= "`Day`"." "."in"."(".$interval.")";

$schedule_conf = $data['schedule_conf_dropdown'];

/*===================select room number from conference_scheduler DB ==============================*/


if($schedule_conf=='Daily')
{
    $query1="SELECT room_number FROM tbl_conference_scheduler WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  `Day` BETWEEN $sDay AND $valid_day  $total_column LIMIT 0,1 ";
    //echo "query1:".print_r($query1,1);
}
else if($schedule_conf=='Weekly')
{
    $query1="SELECT room_number FROM tbl_conference_scheduler WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND  $day  $total_column LIMIT 0,1 ";
    //echo "query1:".print_r($query1,1);
}
else
{
    $query1="SELECT room_number FROM tbl_conference_scheduler WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`= '$sDay'  $total_column LIMIT 0,1 ";
    //echo "query1:".print_r($query1,1);
}

$result = Sql_exec($cn, $query1);

while ($row = Sql_fetch_array($result)) {
    $is_error == 0;
    $room_number = Sql_Result($row, "room_number");
}

$msg="Free Room for Conference is not found at your given time" . "<br/>Please Try at different Time";

ClosedDBConnection($cn);

if ($is_error == 0 && isset($room_number)) {
    $return_data = array('status' => true,'query1'=>$query1,'Room_Number' => $room_number);

}
else if ($is_error == 0 && !(isset($room_number))) {
    $return_data = array('status' => true,'query1'=>$query1,'Room_Number' => $room_number,'message' => $msg);

}

else {
    $return_data = array('status' => false, 'query1' => $query1, 'message' => $msg);

}

    echo json_encode($return_data);
