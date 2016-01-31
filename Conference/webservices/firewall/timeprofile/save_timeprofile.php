<?php
//header('Access-Control-Allow-Origin: *');
//session_start();
require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/functions.php";

$cn = connectDB();

$file_writer_flag = 0;
$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];
$created_by = $_SESSION["firewall"]["id"];
$user_type = $_SESSION["firewall"]["user_type"];


if (isset($_REQUEST['info'])) {
    $data = $_REQUEST['info'];
    $action = $data['action'];
    $action_id = $data['action_id'];
}else if (isset($_POST) && isset($_POST['action'])) {
    $action = mysql_real_escape_string(htmlspecialchars($_POST['action']));
    $action_id = mysql_real_escape_string(htmlspecialchars($_POST['action_id']));
    $profile_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['time_package_Name']));
    $startTime = mysql_real_escape_string(htmlspecialchars($_REQUEST['start_time']));
  if(!$startTime)
      $startTime = "all";
    $endTime = mysql_real_escape_string(htmlspecialchars($_REQUEST['end_time']));
    if(!$endTime)
        $endTime = "all";
    if (isset($_POST['public_checkbox'])) {
        $public = 1;
    } else
        $public = 0;

    if ($org_id == 0 && $user_id == 0 && $created_by == 0) {
        $file_writer_flag = 1;
        $public = mysql_real_escape_string(htmlspecialchars($_REQUEST['public']));
        $package_day = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_timepackage']));

        if ($user_type == 'Super User')
            $created_by = mysql_real_escape_string(htmlspecialchars($_REQUEST['created_by']));
        else
            $org_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['org_id']));
        $created_by = mysql_real_escape_string(htmlspecialchars($_REQUEST['created_by']));

        $select_qry = "SELECT * FROM time_profileinfo WHERE name ='" . $profile_name . "'";
        $select_res = Sql_exec($cn, $select_qry);
        if (Sql_Num_Rows($select_res) > 0) {
            $action = "update";
            $data_select_action = Sql_fetch_array($select_res);
            $action_id = $data_select_action['id'];

            $qry = "update time_profileinfo
		set name='$profile_name',start_time='$startTime',end_time='$endTime', days = '$package_day', last_updated='$last_updated', public='$public'
		where id='$action_id'";
            $res = Sql_exec($cn, $qry);
            echo $action_id;
            exit;

        } else {
            $qry = "insert into time_profileinfo (name,start_time,end_time,days,status,last_updated,created_by,public,org_id)";
            $qry .= " values ('$profile_name','$startTime','$endTime','$package_day', 'active', '$last_updated','$created_by','$public','$org_id')";
            $res = Sql_exec($cn, $qry);

            $select_qry = "SELECT id FROM time_profileinfo WHERE name ='" . $profile_name . "'";
            $select_id = Sql_exec($cn, $select_qry);
            $data_select_id = Sql_fetch_array($select_id);
            $action_id = $data_select_id['id'];
            echo $action_id;
            exit;
        }
    } else {
        $package_day = '';
        $track_count = sizeof($_REQUEST['firewall_timepackage']);
        $flag = 0;

        foreach ($_REQUEST['firewall_timepackage'] as $value) {
            $flag++;
            if ($flag == $track_count) {
                $package_day .= $value;


            } else {
                $package_day .= $value . ',';
            }
        }
    }

}

if ($action == "update") {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'UPDATE_TIME_PROFILE';
    $user_data['message'] = UPDATE_TIME_PROFILE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $options['cn'] = $cn;
    $action = 'update';
    $options['page_name'] = "Time Profile Configuration";
    $options['action_type'] = "update";
    $options['id_name'] = 'id';
    $options['table'] = "time_profileinfo";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update time_profileinfo
		set name='$profile_name',start_time='$startTime',end_time='$endTime', days = '$package_day', last_updated='$last_updated', public='$public'
		where id='$action_id'";
} else if ($action == "delete") {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'DELETE_TIME_PROFILE';
    $user_data['message'] = DELETE_TIME_PROFILE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $options['cn'] = $cn;
    $action = 'delete';
    $options['page_name'] = "Time Profile Configuration";
    $options['action_type'] = "delete";
    $options['id_name'] = 'id';
    $options['table'] = "time_profileinfo";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update time_profileinfo set status='inactive'
		where id='$action_id'";
}
else {
    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'ADD_TIME_PROFILE';
    $user_data['message'] = ADD_TIME_PROFILE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);


    if($user_type == "Super User") {
        $qry = "insert into time_profileinfo (name,start_time,end_time,days,status,last_updated,created_by,public)";
        $qry .= " values ('$profile_name','$startTime','$endTime','$package_day', 'active', '$last_updated','$created_by','$public')";
    }
    else if($user_type=="Administrator"){

        $qry = "insert into time_profileinfo (name,start_time,end_time,days,status,last_updated,created_by,public,org_id)";
        $qry .= " values ('$profile_name','$startTime','$endTime','$package_day', 'active', '$last_updated','$created_by','$public','$org_id')";

    }else
    {
        $qry = "insert into time_profileinfo (name,start_time,end_time,days,status,last_updated,created_by,public,org_id)";
        $qry .= " values ('$profile_name','$startTime','$endTime','$package_day', 'active', '$last_updated','$created_by','$public','$org_id')";

    }

}


try {

    $res = Sql_exec($cn, $qry);


    if($action == "insert") {
        $action_id = Sql_insert_id($cn);
        $options['cn'] = $cn;
        $action = 'add';
        $options['page_name'] = "Time Profile Configuration";
        $options['action_type'] = "add";
        $options['id_name'] = 'id';
        $options['table'] = "time_profileinfo";
        $options['id_value'] = $action_id;
        setHistory($options);

    }

} catch (Exception $e) {
    $is_error = 1;
}
if ($file_writer_flag == 1) {
    //  $is_error = file_writer_firewall_timeprofile($cn);
}

ClosedDBConnection($cn);
echo $is_error;

?>
