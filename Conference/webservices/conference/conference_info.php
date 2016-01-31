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


if ($action != 'delete') {

    $demo_name = $data['demo_name'];
    $_SESSION['conf_name'] = $demo_name;
    $user_id= $_SESSION['UserID'];

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
    $sDay = $date_split[2];
    $sMonth = $date_split[1];
    $sYear = $date_split[0];

    $date_split= explode('-', $end_date);
    $eDay = $date_split[2];
    $eMonth = $date_split[1];
    $eYear = $date_split[0];



   /* $to_time = strtotime($start_time);
    $from_time = strtotime($end_time);
    $minute= round(abs($to_time - $from_time) / 60,2);
    $slot=($minute+1)/30;

    $start_q = array();
    $end_q = array();
    $total_column= "";
    $total_column_set= "";
    $i=1;
    array_push($start_q,"alamin");
    array_push($end_q,"alamin");
    array_push($start_q,$start_time);

    // echo "start: ".print_r($start_q,1)."End:".print_r($end_q,1);
     for($i=1; $i<=$slot; $i++)
     {
         $temp = "";
         $start_time_split=explode(':', $start_q[$i]);
          $start_time_split[1]= (int) $start_time_split[1]+29;
         if((int) $start_time_split[1]>59)
          {

           $start_time_split[0]= (int) $start_time_split[0]+1;
           if($start_time_split[0]<10)
             $start_time_split[0]="0".(string) $start_time_split[0];
             $start_time_split[1]="00";
             $temp =  $start_time_split[0].":". $start_time_split[1];

          }
         else
         {

             $temp= $start_time_split[0].":". $start_time_split[1];

         }

         $end_q[$i] = $temp;
         $end_time_split= explode(':', $end_q[$i]);
         $end_time_split[1]= (int) $end_time_split[1]+1;

         if((int)$end_time_split[1]<10 )
             $end_time_split[1]="0".$end_time_split[1];

         $start_q[$i+1] = $end_time_split[0]. ":".$end_time_split[1];
         $column=$start_q[$i]."_" .$end_q[$i] ;

         if(isset($total_column))
            $total_column= $total_column. " AND "."`".$column."`" ."=". "'Free'";
         else
             $total_column= $total_column."`".$column."`" ."=". "'Free'";

     }*/

    $dteStart = new DateTime($start);
    $dteEnd   = new DateTime($end);
    $dteDiff  = $dteStart->diff($dteEnd);
    $duration= (string) $dteDiff->format("%H:%I");

    $conference_code= $data['conf_code'];
    $response = check_scheduler($start_time, $end_time, $cn);

    $status= $response["status"];
    $long_code = $response["long_code"];
    $web_link = $response["web_link"];
    //$room_pass = $response["room_pass"];
    //$room_number = $response['room_number'];


    $_SESSION['long_code'] = $long_code;

    $schedule_conf = $data['schedule_conf_dropdown'];

    /*===================select room number from conference_scheduler DB ==============================*/

    $valid_day=30;
    if($schedule_conf=='Daily')
    {
        $query1="SELECT room_number FROM tbl_conference_scheduler WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`>= '$sDay' AND  `Day`<='$valid_day'  $total_column LIMIT 0,1 ";
        //echo "query1:".print_r($query1,1);
    }

    else
    $query1="SELECT room_number FROM tbl_conference_scheduler WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`= '$sDay'  $total_column LIMIT 0,1 ";
    //echo "query1:".print_r($query1,1);

    $result = Sql_exec($cn, $query1);

    while ($row = Sql_fetch_array($result)) {
        $room_number = Sql_Result($row, "room_number");
        $_SESSION['room_number'] = $room_number;
        }


    $demo_participants = $data['demo_participants'];


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

}

else
{

    /*=============================== for room number  for Delete =====================*/
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
    $room_number = $data_info['room_number'];
    $start_date_time = $data_info['start_date'];
    $end_date_time = $data_info['end_date'];
    $Schedule_Conf = $data_info['Schedule_Conf'];

    $date_time_split= explode(' ', $start_date_time);
    $date_split = explode('-', $date_time_split[0]);
    $sDay =(int) $date_split[2];
    $sMonth = (int) $date_split[1];
    $sYear = (int) $date_split[0];
    $time_split = explode(':', $date_time_split[1]);
    $start_time= $time_split[0].":".$time_split[1];

    $date_time_split= explode(' ', $end_date_time);

    $time_split = explode(':', $date_time_split[1]);
    $end_time= $time_split[0].":".$time_split[1];

    $key1 = array_search($start_time, $start_array);
    $key2 = array_search($end_time, $end_array);



    // echo json_encode( array("action"=>$action,"deleted_id"=>$deleted_id,"room_number"=>$room_number) );
}


if ($action == "update") {
    $msg = "Successfully Updated";
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    $qry = "UPDATE $tbl set `Conf_Name`='$demo_name',`USER`='$user_id', `room_number`='$room_number', `weblink`='$web_link',
            `CODE`='$conference_code',`Start_Time`='$start',`End_Time`='$end',`Conference_Duration`='$duration',`Participants`='$demo_participants',`Recording`='$demo_recording',
            `STATUS`='$demo_active',`Schedule_Conf`='$schedule_conf',`Notification_Channel`='$notification_channel' WHERE ID='$action_id'";

    $conf_id =$action_id;
    $_SESSION['conf_id']=$action_id;

    $qry_to_room="UPDATE $room_tbl SET `room_pass`='$conference_code',`last_update` ='$last_updated', `conference_name` = '$demo_name' WHERE `room_number` ='$room_number'";

}

else if ($action == "delete") {

    $flag='delete';

    $action_id = $deleted_id;
    $qry = "DELETE from $tbl where ID ='$action_id'";

    $qry_participant="DELETE from tbl_participant WHERE conference_ID ='$action_id'";

    $qry_to_room="UPDATE $room_tbl SET last_update ='$last_updated',`conference_name` = ' ' WHERE room_number='$room_number'";


    $total_column_set="";
    $total_column_was="";
    for($i=$key1; $i<=$key2; $i++)
    {
        $column=$start_array[$i]."_".$end_array[$i] ;
        if($i<$key2)
        {
            $total_column_set= $total_column_set."`".$column."`" ."=". "'Free'"." , ";
            $total_column_was = $total_column_was."`".$column."`" ."=". "'$action_id'"." AND ";
        }

        else
        {
            $total_column_set= $total_column_set."`".$column."`" ."=". "'Free'";
            $total_column_was = $total_column_was."`".$column."`" ."=". "'$action_id'";
        }


    }
    if($Schedule_Conf=='Daily')
    $query3="UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`>= '$sDay' AND  `Day`<='$valid_day' AND $total_column_was AND  `room_number`='$room_number' ";
    //echo "query3:".print_r($query3,1);
    else
    $query3="UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`= '$sDay' AND $total_column_was AND  `room_number`='$room_number' ";
    //echo "query3:".print_r($query3,1);

    try {
        $update_result = Sql_exec($cn, $query3);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
    }

    $msg = "Successfully Deleted";
}

else {

    $qry = "INSERT INTO $tbl (Conf_Name, long_number, USER, room_number, weblink, CODE, Start_Time, End_Time, Conference_Duration, Participants, Recording, STATUS, Schedule_Conf, Notification_Channel)
	VALUES('$demo_name', '$long_code', '$user_id', '$room_number', '$web_link', '$conference_code', '$start', '$end', '$duration' ,'$demo_participants', '$demo_recording', '$demo_active', '$schedule_conf', '$notification_channel')";

    $qry_to_room="UPDATE $room_tbl SET last_update='$last_updated',conference_name= '$demo_name' WHERE room_number='$room_number'";

    $msg = "Successfully Saved";
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
    {
        $res = Sql_exec($cn, $qry_participant);
        $is_error = 2;
    }

    else
    $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}

/*================================== for conference id ======================================================*/

if ($action == "save") {
    $qry_for_id = "SELECT ID FROM `tbl_conference` WHERE `Conf_Name`='$demo_name' and `long_number`= '$long_code' and `USER`='$user_id' and `room_number`='$room_number' and `weblink`='$web_link' and
                  `CODE`='$conference_code'and `Start_Time`='$start' and `End_Time`='$end' and `Participants`='$demo_participants' and `Recording`='$demo_recording' and
                 `STATUS`='$demo_active' and  `Schedule_Conf`='$schedule_conf' and `Notification_Channel`='$notification_channel'";

    $result = Sql_exec($cn, $qry_for_id);

    while ($row = Sql_fetch_array($result)) {
        $conf_id = Sql_Result($row, "ID");
    }

    $_SESSION['conf_id'] = $conf_id;
    $total_column_set="";

    for($i=$key1; $i<=$key2; $i++)
    {
        $column=$start_array[$i]."_".$end_array[$i] ;
        if($i<$key2)
             $total_column_set= $total_column_set."`".$column."`" ."=". "'$conf_id'"." , ";
        else
            $total_column_set= $total_column_set."`".$column."`" ."=". "'$conf_id'";

    }
    if($schedule_conf=='Daily')
    {
    $query2="UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`>= '$sDay' AND  `Day`<='$valid_day'  $total_column AND  `room_number`='$room_number' ";
    //echo "query2:".print_r($query2,1);
     }
    else
    $query2="UPDATE tbl_conference_scheduler set  $total_column_set WHERE `Year` = '$sYear' AND `Month` = '$sMonth' AND `Day`= '$sDay'  $total_column AND  `room_number`='$room_number' ";
    //echo "query2:".print_r($query2,1);

    try {
        $update_result = Sql_exec($cn, $query2);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
    }

}

ClosedDBConnection($cn);

if ($is_error == 0) {
    $return_data = array('status' => true,'query1'=>$query1,'query2'=>$query2, 'conf_id' => $conf_id,'Name' => $demo_name, 'UserID' => $user_id , 'Long_Number'=>$long_code, 'Web_Link' => $web_link, 'Room_Number' => $room_number,
    'Code' => '$conference_code', 'Start_Time' => $start, 'End_Time' => $end, 'Conference_Duration' => $dteDiff, 'No_of_Participants' => $demo_participants,'Recording' => $demo_recording,
    'Stats' => $demo_active, 'Notification_Channel' => $notification_channel, 'Schedule_Conf' => $schedule_conf );

}
else if ($is_error == 2){
    $return_data = array('status' => true, 'message' => $msg);

}

else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.');
}

echo json_encode($return_data);

