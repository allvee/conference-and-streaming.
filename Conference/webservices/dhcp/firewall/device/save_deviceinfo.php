<?php
//header('Access-Control-Allow-Origin: *');
//session_start();
require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";

$cn = connectDB();

$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
//$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];
$created_by = $_SESSION["firewall"]["id"];

$user_type = $_SESSION["firewall"]["user_type"];

if (isset($_REQUEST['info'])) {
    $data = $_REQUEST['info'];
    $action = $data['action'];
    $action_id = $data['action_id'];
}else if (isset($_POST) && isset($_POST['action']) && isset($_POST['action_id'])){
    $action = mysql_real_escape_string(htmlspecialchars($_POST['action']));
    $action_id = mysql_real_escape_string(htmlspecialchars($_POST['action_id']));

    $device_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['name']));
    $ip = mysql_real_escape_string(htmlspecialchars($_REQUEST['ip']));
    $loginId = mysql_real_escape_string(htmlspecialchars($_REQUEST['login_id']));
    $password = mysql_real_escape_string(htmlspecialchars($_REQUEST['password']));
   // $organization_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['org_name']));

    $organizations = '';
    $track_count = sizeof($_REQUEST['org_name']);
    $flag = 0;

    foreach ($_REQUEST['org_name'] as $value) {
        $flag++;
        if ($flag == $track_count) {
            $organizations .= $value;


        } else {
            $organizations .= $value . ',';
        }
    }

}


if ($action == "update") {

    $options['cn'] = $cn;
    $action = 'update';
    $options['page_name'] = "Divice Configuration";
    $options['action_type'] = "update";
    $options['id_name'] = 'id';
    $options['table'] = "devices";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update devices
		set name='$device_name',ip='$ip',loginId='$loginId', password = '$password', last_updated='$last_updated'
		where id='$action_id'";
} else if ($action == "delete") {

    $options['cn'] = $cn;
    $action = 'delete';
    $options['page_name'] = "Divice Configuration";
    $options['action_type'] = "delete";
    $options['id_name'] = 'id';
    $options['table'] = "devices";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update devices set status='inactive'
		where id='$action_id'";
}
else {

    if($user_type == "Super User") {
        $qry = "insert into devices (name,ip,loginId,password,status,last_updated, created_by)";
        $qry .= " values ('$device_name','$ip','$loginId','$password', 'active',  '$last_updated','$created_by')";
    }
    else if($user_type=="Administrator"){

        $qry = "insert into devices (name,ip,loginId,password,status,last_updated, created_by)";
        $qry .= " values ('$device_name','$ip','$loginId','$password', 'active', '$last_updated','$created_by')";

    }else
    {
        $qry = "insert into devices (name,ip,loginId,password,status,last_updated, created_by,user_id)";
        $qry .= " values ('$device_name','$ip','$loginId','$password', 'active', '$last_updated','$created_by','$user_id')";

    }


  }
//echo $qry;


try {
    $res = Sql_exec($cn, $qry);


    if($action == "insert") {
        $action_id = Sql_insert_id($cn);
        $options['cn'] = $cn;
        $action = 'add';
        $options['page_name'] = "Divice Configuration";
        $options['action_type'] = "add";
        $options['id_name'] = 'id';
        $options['table'] = "devices";
        $options['id_value'] = $action_id;
    setHistory($options);

    }

} catch (Exception $e) {
    $is_error = 1;
}
if ($is_error == 0) {
  //  $is_error = file_writer_timepackage($cn);
}

ClosedDBConnection($cn);

echo $is_error;

?>
