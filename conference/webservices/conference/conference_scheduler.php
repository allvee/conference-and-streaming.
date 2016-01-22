<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shiam
 * Date: 1/21/2016
 * Time: 2:11 PM
 */



require_once "../lib/common.php";
require_once "../lib/config.php";

function check_scheduler($param_start_time,$para_end_time,$cn)
{
    $request_start_time = new DateTime($param_start_time);
    $request_end_time = new DateTime($para_end_time);
    //echo $request_start_time->format('Y-m-d H:i:s')." : : ".$request_end_time->format('Y-m-d H:i:s')."</br>";

    //echo __LINE__."</br>";
    $qry = "Select room_number,room_pass,web_link from tbl_conference_room";
//    echo $qry."</br>";
    $result = Sql_exec($cn,$qry);

    while ($row = Sql_fetch_array($result)) {
        $room_number = $row['room_number'];
        $room_password = $row['room_pass'];
        $web_link = $row['web_link'];
       // echo __LINE__."</br>";
        $qry = "select Start_Time, End_Time from tbl_conference where room_number='$room_number'";
        $ret = Sql_exec($cn,$qry);

        if( Sql_num_rows($ret) < 1) {
            return array("status"=>true,"long_code"=>$room_number,"room_pass"=>$room_password,"web_link"=>$web_link);
        }

        while ($row2 = sql_fetch_array($ret)) {
            $start_time = new DateTime($row2['Start_Time']);
            $end_time = new DateTime($row2['End_Time']);
           // echo $start_time->format('Y-m-d H:i:s') .":---:".$end_time->format('Y-m-d H:i:s')."</br>";
            if ($start_time > $request_end_time or $end_time < $request_start_time) {
                return array("status"=>true,"long_code"=>$room_number,"room_pass"=>$room_password,"web_link"=>$web_link);
            }
        }
    }
    return array("status"=>false);
}
//$date = '2016-01-21 14:59:00';
// End date
//$end_date = '2016-01-21 15:29:00';
//echo __LINE__."</br>";
//echo mktime(0,0,0,date("m"),date("d")+1,date("Y") );

$cn = connectDB();
//print_r( check_scheduler($date,$end_date,$cn) );
ClosedDBConnection($cn);


/*while (strtotime($date) <= strtotime($end_date)) {
    echo "$date"."</br>";
    $date = date ("Y-m-d H:i:s", strtotime("+1 second", strtotime($date)));
}*/