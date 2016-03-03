<?php

header('Access-Control-Allow-Origin: *');
//session_start();

require_once "../lib/common.php";
require_once "../lib/filewriter.php";

/*echo "GET:";
print_r($_GET);
exit;*/


$cn = connectDB();
$last_updated = date('Y-m-d H:i:s');

$user_id = $_GET['user_id'];
$app_name = $_GET['app_name'];
$duration = $_GET['duration'];
$email = $_GET['email_id'];

// call api for get mac address
/*$mac_addresses = "";
$get_device_mac_api = "http://192.168.245.35/SubscriptionServices/services/subscriber/subscriberdevice.php?appid=test&apppass=test&cmdid=SHOW_SubDevice&cmdparam=where+uid='".$email."'";

$get_device_mac  = file_get_contents($get_device_mac_api);
$output_line = explode("\n", $get_device_mac);

    if($output_line[0]=='+OK') {
        for ($x = 3; $x <= $output_line[1] + 2; $x++) {

            $output_mac = explode("|", $output_line[$x]);
            if ($x == 3)
                $mac_addresses .= $output_mac[3];
            else
                $mac_addresses .= ','.$output_mac[3];
        }
    }
    else{
        echo "Wrong Information";
        exit;
    }
*/
$ip_addresses="0.0.0.0";
$org_name= "Org-".$email;

$is_error = 0;

// role_id = 2 for Full Access
$qry_full_access = "select id from roles where UPPER(name) = 'Full-Access'";

$rs_full_access = Sql_exec($cn, $qry_full_access);
$row_full_access = Sql_fetch_array($rs_full_access);
$role_id = $row_full_access['id'];

$qry = "insert into licenses (user_id,app_name,subscribed,duration,last_updated,status)";
$qry .= " values ('$user_id', '$app_name', '$last_updated', '$duration', '$last_updated', 'active')";



$qry_create_org = "insert into organization (name,parent_id,master_company_id,status,last_updated,ip_addresses)";
$qry_create_org .= " values ('$org_name','0','0','active','$last_updated','$ip_addresses')";
$res_create_org = Sql_exec($cn, $qry_create_org);

$org_id = mysql_insert_id() ;

$query_update_org_id = "UPDATE organization SET org_id = '$org_id' WHERE id = '$org_id' ;";
//$res = Sql_exec($cn, $query_update_org_id);

$qry_user_role = "insert into user_role_association (user_id, role_id, status, last_updated_by, org_id)";
$qry_user_role .= " values ('$user_id', '$role_id', 'active', '$user_id', '$org_id')";

$qry_user_org = "insert into org_users (user_id,org_id)";
$qry_user_org .= " values ('$user_id','$org_id')";


try {
    $res = Sql_exec($cn, $qry);
    $res_user_role = Sql_exec($cn, $qry_user_role);
    $res_user_org = Sql_exec($cn, $qry_user_org);

} catch (Exception $e) {
    $is_error = 1;
}

if ($is_error == 0) {
   // $is_error = file_writer_firewall_validity($cn);
}

ClosedDBConnection($cn);

echo $is_error;
