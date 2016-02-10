<?php

header('Access-Control-Allow-Origin: *');
//session_start();

require_once "../lib/common.php";
require_once "../lib/filewriter.php";
require_once "../lib/functions.php";
require_once "../lib/global_config.php";

$cn = connectDB();
$last_updated = date('Y-m-d H:i:s');
define('GET_MAC', 'http://'.$localhost.'/firewall_as_service/rcportal/webservices/api/get_mac_validity_rule.php');
/*$user_id = $_SESSION['firewall']['id'];
$user_type = $_SESSION["firewall"]["user_type"];
$org_id = $_SESSION["firewall"]["org_ids"];
$created_by = $_SESSION["firewall"]["id"];
*/
$user_id = "1563";
$created_by = "1563";
$org_id = "5";
$user_type = "";

$is_error = 0;

$qry = "select * from licenses where duration='0'and status='active'";
$res = Sql_exec($cn, $qry);
while($data = Sql_fetch_array($res)) {

    // $qry_invalid = "update licenses set status='inactive' where id='".$data['id']."'";
    // $res_invalid = Sql_exec($cn, $qry_invalid);

    $user = $data['user_id'];
    $qry_rule_name = "select * from rules where created_by='$user'";
    $res_rule_name = Sql_exec($cn, $qry_rule_name);

    while ($dt = Sql_fetch_array($res_rule_name)) {
        $rule_name = $dt['rule_name'];

        $post_data = array('user_type' => $user_type, 'user_id' => $user_id);
        $get_macs = curlRequest('POST', GET_MAC, $post_data);
        $macadresses = array_filter(explode(",", $get_macs));
        foreach ($macadresses as $mac) {

           $org_gateway = file_get_contents($get_gatewayFromMac . $mac);

            define('Patch_Rule_Format', 'http://' . $org_gateway . '/firewall/rcportal/webservices/firewall/rule/save_firewall_rule.php');
            $post_data = array('action' => "update",'rule_name' => $rule_name, 'created_by' => $created_by, 'org_id' => $org_id,'user_type' => $user_type);
            curlRequest('POST', Patch_Rule_Format, $post_data);

            $command = "fw reload";
//Create Socket
            $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
//Connect to server
            $result = socket_connect($socket, $org_gateway, "$firewall_app_port") or die("Could not connect to server\n");
//Sending message to Server
            socket_write($socket, $command, strlen($command)) or die("Could not send data to server\n");
//Receiving reply from server
            $result = socket_read($socket, 2048, PHP_BINARY_READ) or die("Could not read server response\n");
        }
    }
}


try {



} catch (Exception $e) {
    $is_error = 1;
}

if ($is_error == 0) {
    // $is_error = file_writer_firewall_validity($cn);
}

ClosedDBConnection($cn);

echo $is_error;
