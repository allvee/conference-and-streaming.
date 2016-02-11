<?php

header('Access-Control-Allow-Origin: *');
//session_start();
require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/global_config.php";

global  $file_dir, $dest_file_dir;

$cn = connectDB();
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];
$is_error = 0;
//$user_org_id = $_SESSION['firewall']['org_ids'];
$user_id = $_SESSION['firewall']['id'];

$user_type = $_SESSION["firewall"]["user_type"];

if (isset($_REQUEST['info'])) {
    $action = $_REQUEST['info'];
}

if($action=="send") {

    if($user_type == 'Super User')
        $select_qry = "select org_id from org_users";
    else
        $select_qry = "select org_id from org_users where user_id='".$user_id."'";

    $rs_user_org_ids = Sql_exec($cn, $select_qry);
    while ($data_user_org_ids = Sql_fetch_array($rs_user_org_ids)) {

        $data_org_ids = $data_user_org_ids['org_id']; // store all org_id for same gateways
        $select_qry = "select mac_addresses from organization where status='active' AND id ='" . $data_user_org_ids['org_id'] . "'";
        $rs_org_mac = Sql_exec($cn, $select_qry);
        $data_org_mac = Sql_fetch_array($rs_org_mac);
        $org_mac_address = $data_org_mac['mac_addresses'];
        if (!$org_mac_address) {
            echo 1;
            exit;
        }

        $org_gateway = file_get_contents($get_gatewayFromMac . $org_mac_address);

        if (!$org_gateway) {
            echo 2;
            exit;
        }

        $org_gateway = trim($org_gateway);

        $select_qry = "select * from devices where status='active' AND ip='" . $org_gateway . "'";
        $rs_device_ip = Sql_exec($cn, $select_qry);
        $data_device_ip = Sql_fetch_array($rs_device_ip);
        $device_ip = $data_device_ip['ip'];
        if (!$device_ip) {
            echo 3;
            exit;
        }

        $select_qry = "select * from organization where status='active' AND id NOT IN('" . $data_user_org_ids['org_id'] . "')";
        $rs_all_org_mac = Sql_exec($cn, $select_qry);

        while ($data_all_org_mac = Sql_fetch_array($rs_all_org_mac)) {
            $org_all_mac_address = $data_all_org_mac['mac_addresses'];

            if ($org_all_mac_address) {
                $check_org_gateway = file_get_contents($get_gatewayFromMac . $org_all_mac_address);

                if ($org_gateway == $check_org_gateway) {
                    $data_org_ids .= ',' . $data_all_org_mac['id'];

                }
            }

        }

        $data_string = "";
        $tok_data_all_org_ids = strtok($data_org_ids, ",");

        while ($tok_data_all_org_ids !== false) {

            $select_qry = "select * from rules where status='active' AND org_id='" . $tok_data_all_org_ids . "'";
            $rs_org_ids = Sql_exec($cn, $select_qry);

            while ($dt = Sql_fetch_array($rs_org_ids)) {

                $select_group_type = "select * from groups where name='" . $dt['destination_address'] . "'";
                $rs_group_type = Sql_exec($cn, $select_group_type);

                $dest = '';
                $host = '';
                if (Sql_Num_Rows($rs_group_type) > 0) {
                    while ($dt_group_type = Sql_fetch_array($rs_group_type)) {
                        if ($dt_group_type == "ip") {
                            $dest = "__" . $dt['destination_address'];
                            $host = 'all';
                        } else {
                            $dest = 'all';
                            $host = "__" . $dt['destination_address'];
                        }
                    }
                } else {
                    $dest_array = explode('.', $dt['destination_address']);
                    if (sizeof($dest_array) > 2) {
                        $dest = $dt['destination_address'];
                        $host = 'all';
                    } else {
                        $dest = 'all';
                        $host = $dt['destination_address'];
                    }
                }


                $select_qry = "select mac_addresses from organization where status='active' AND id IN ('$tok_data_all_org_ids')";
                $rs_src_org_mac = Sql_exec($cn, $select_qry);
                $data_src_org_mac = Sql_fetch_array($rs_src_org_mac);
                $tok_org_mac_address = $data_src_org_mac['mac_addresses'];

                if (strcmp($dt['source_address'], "all") == 0) {

                    $src = $tok_org_mac_address;
                    $data_string .= $src . " " . $dest . " " . $dt['port'] . " " . $dt['protocol'] . " " . $host . " " . $dt['action'] . " " . $dt['start_time'] . " " . $dt['end_time'] . "\n";


                } else {
                    $src = $dt['source_address'];
                    $data_string .= $src . " " . $dest . " " . $dt['port'] . " " . $dt['protocol'] . " " . $host . " " . $dt['action'] . " " . $dt['start_time'] . " " . $dt['end_time'] . "\n";
                }

                if ($device_ip) {
					
                    mkdir($file_dir . $org_gateway.'/', 0777, true);
				   //echo "mkdir -p ".$file_dir . $org_gateway;
				   
				    
					
					
                    $check_src_group = strpos($dt['source_address'], "__");
                    $check_dst_group = strpos($dt['destination_address'], "__");


                    if ($check_src_group !== false) {
                        $pieces = explode("__", $dt['source_address']);

                        $select_qry = "select * from groups where name= '$pieces[1]'";
                        $rs4 = Sql_exec($cn, $select_qry);
                        $data_host = Sql_fetch_array($rs4);
                        $group_name = $data_host['name'];
                        $group_content = $data_host['content'];

                        $group_file_name = $file_dir . $device_ip . '/__' . $group_name . ".txt";
                        file_put_contents($group_file_name, $group_content);
                        chmod($group_file_name, 0777);

                    }
                    if ($check_dst_group !== false) {
                        $pieces = explode("__", $dt['destination_address']);

                        $select_qry = "select * from groups where name = '$pieces[1]'";
                        $rs4 = Sql_exec($cn, $select_qry);
                        $data_host = Sql_fetch_array($rs4);
                        $group_name = $data_host['name'];
                        $group_content = $data_host['content'];

                        $group_file_name = $file_dir . $device_ip . '/__' . $group_name . ".txt";
                        file_put_contents($group_file_name, $group_content);
                        chmod($group_file_name, 0777);

                    }

                }

            } //end while
            $tok_data_all_org_ids = strtok(",");
        }

            if ($device_ip) {

                $password = $data_device_ip['password'];
                $loginId = $data_device_ip['loginId'];

                chmod("$file_dir", 0777);
                $file_name = $file_dir . $org_gateway . "/firewallRule.txt";
                file_put_contents($file_name, $data_string);
                chmod("$file_name", 0777);

                $file_transfer = $file_dir . $org_gateway . "/transfer.sh";
                $string = "";
                $string = "#!/bin/bash" . "\n";
               // $string .= "sudo sshpass -p " . "\"" . $password . "\"" . " scp " . $file_dir . $org_gateway . "/" . "*.txt " . $loginId . "@" . $org_gateway . ":".$dest_file_dir . "\n";
                $string .= "sudo scp " . $file_dir . $org_gateway . "/" . "*.txt " . $loginId . "@" . $org_gateway . ":".$dest_file_dir . "\n";
                // $string .="rm -f ".$file_dir.$device_ip."/"."*.txt". "\n";
                // echo $string;
                file_put_contents($file_transfer, $string);
                chmod("$file_transfer", 0777);

                system($file_transfer);

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
ClosedDBConnection($cn);

?>