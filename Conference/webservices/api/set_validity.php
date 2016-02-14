<?php
require_once "../lib/common.php";
require_once "../lib/global_config.php";

global $get_device_mac_api;
$cn = connectDB();
$last_updated = date('Y-m-d H:i:s');
$is_error = 0;

$user_id = $_GET['user_id'];
$app_name = $_GET['app_name'];
$duration = $_GET['duration'];
$email = $_GET['email_id'];
$org_name = "Org-" . $email;
$get_device_mac_api .= $email . "'";
$get_device_mac = file_get_contents($get_device_mac_api);

$qry_create_org = "insert into organization (name,status,last_updated)";
$qry_create_org .= " values ('$org_name','active','$last_updated')";
$res_create_org = Sql_exec($cn, $qry_create_org);
$org_id = mysql_insert_id();

$output_line = explode("\n", $get_device_mac);
if ($output_line[0] == '+OK') {
    $qry_create_device = "insert into devices (name,mac,status,org_id,last_updated) values ";
    $subqry = array();
    for ($x = 3; $x <= $output_line[1] + 2; $x++) {
        $output_mac = explode("|", $output_line[$x]);
        $device_name = $output_mac[2];
        $mac_addresses = $output_mac[3];

        $subqry[] = "('$device_name','$mac_addresses','active','$org_id','$last_updated')";
    }
    $qry_create_device = $qry_create_device . implode(",", $subqry);
    $res_create_device = Sql_exec($cn, $qry_create_device);
} else {
    exit("Wrong Information");
}

$qry_full_access = "select id from roles where UPPER(name) = 'FULL ACCESS'";
$rs_full_access = Sql_exec($cn, $qry_full_access);
$row_full_access = Sql_fetch_array($rs_full_access);
$role_id = $row_full_access['id'];

$qry = "insert into licenses (user_id,app_name,subscribed,duration,last_updated,status)";
$qry .= " values ('$user_id','$app_name','$last_updated','$duration','$last_updated','active')";

$qry_user_role = "insert into user_roles (user_id,role_id,status)";
$qry_user_role .= " values ('$user_id','$role_id','active')";

$qry_user_org = "insert into org_users (user_id,org_id)";
$qry_user_org .= " values ('$user_id','$org_id')";


try {
    $res = Sql_exec($cn, $qry);
    $res_user_role = Sql_exec($cn, $qry_user_role);
    $res_user_org = Sql_exec($cn, $qry_user_org);

} catch (Exception $e) {
    $is_error = 1;
}

ClosedDBConnection($cn);

echo $is_error;
