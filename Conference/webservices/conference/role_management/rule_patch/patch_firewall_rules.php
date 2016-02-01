<?php
/*
function check_ip($string) {

    $count = 0;
    $token = strtok($string, ".");

    while ($token !== false)
    {
        $count++;
        $token = strtok(".");
    }

return $count;
}*/

header('Access-Control-Allow-Origin: *');
//session_start();
require_once "../../../lib/common.php";
require_once "../../../lib/filewriter.php";

$cn = connectDB();
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];
$is_error = 0;


if (isset($_REQUEST['info'])) {
    $action = $_REQUEST['info'];
   // $action = $data['send_button'];
   // $rule_id = $data['rule_id'];
}// else if (isset($_POST) && isset($_POST['send_button'])) {
   // $action = mysql_real_escape_string(htmlspecialchars($_POST['send_button']));
 //   $rule_id = mysql_real_escape_string(htmlspecialchars($_POST['rule_id']));

//}

if($action=="send") {

    $file_dir = "/ocmp/app/firewall_as_service/";

    $select_qry = "select * from devices where status='active'";
    $rs1 = Sql_exec($cn, $select_qry);
    while($dv = Sql_fetch_array($rs1))
    {

        $data_string = "";
        $device_id = $dv['id'];
        $device_ip = $dv['ip'];
        $password = $dv['password'];
        $loginId = $dv['loginId'];
        mkdir($file_dir .$device_ip);
        $select_qry = "select organizations from devices where id='$device_id'";
        $rs2 = Sql_exec($cn, $select_qry);
        while ($org = Sql_fetch_array($rs2)) {

            $tok = strtok($org['organizations'], ",");
            while ($tok !== false) {
                $select_qry = "select * from rules where org_id='$tok' AND status='active'";
                $rs3 = Sql_exec($cn, $select_qry);

                while($dt = Sql_fetch_array($rs3))
                {
                    $select_group_type = "select * from groups where name='" . $dt['destination_address'] . "'";
                    $rs_group_type = Sql_exec($cn, $select_group_type);

                    $dest = '';
                    $host = '';
                    if (Sql_Num_Rows($rs_group_type) > 0) {
                        while ($dt_group_type = Sql_fetch_array($rs_group_type)) {
                            if ($dt_group_type == "ip") {
                                $dest = "__".$dt['destination_address'];
                                $host = 'all';
                            } else {
                                $dest = 'all';
                                $host = "__".$dt['destination_address'];
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
                    if(strcmp($dt['source_address'],"all")==0){
                        $qry_org_address = "select ip_addresses,mac_addresses from organization where id='$tok';";
                      //  $qry_org_address = "select ip_addresses from organization where id='1';";
                        $rs_org_address = Sql_exec($cn, $qry_org_address);

                        $data = Sql_fetch_array($rs_org_address);
                        $org_mac_address = $data['mac_addresses'];
                        $org_ip_address = $data['ip_addresses'];

                        if($org_mac_address)
                        $src = $org_mac_address;
                        else if($org_ip_address)
                        $src = $org_ip_address;
                        else
                            $src = "all";
                    }else{
                        $src = $dt['source_address'];
                    }

                    $check_src_group = strpos($dt['source_address'], "__");
                    $check_dst_group = strpos($dt['destination_address'], "__");


                    if ($check_src_group !== false) {
                        $pieces = explode("__", $dt['source_address']);

                     $select_qry = "select * from groups where name= '$pieces[1]'";
                     $rs4 = Sql_exec($cn, $select_qry);
                     $data_host = Sql_fetch_array($rs4);
                     $group_name = $data_host['name'];
                     $group_content = $data_host['content'];

                     $group_file_name = $file_dir .$device_ip . '/__' . $group_name . ".txt";
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

                    $group_file_name = $file_dir .$device_ip . '/__' . $group_name . ".txt";
                    file_put_contents($group_file_name, $group_content);
                    chmod($group_file_name, 0777);

                }
                    $data_string .=$src . " " . $dest . " " . $dt['port'] . " " . $dt['protocol'] . " " . $host . " " .$dt['start_time']. " " .$dt['end_time']. " " . $dt['action']. "\n";

            }

                $tok = strtok(",");
            }
        }


        chmod("$file_dir", 0777);
        $file_name = $file_dir .$device_ip."/firewallRule.txt";
        file_put_contents($file_name, $data_string);
        chmod("$file_name", 0777);

        $file_transfer=$file_dir.$device_ip."/transfer.sh";
        $string ="";
        $string="#!/bin/bash"."\n";
        $string.="sudo sshpass -p "."\"".$password."\"". " scp ".$file_dir.$device_ip."/"."*.txt " .$loginId."@".$device_ip.":/ocmp/app/firewall_as_service/". "\n";
       // $string .="rm -f ".$file_dir.$device_ip."/"."*.txt". "\n";
       // echo $string;
        file_put_contents($file_transfer, $string);
        chmod("$file_transfer", 0777);

        system($file_transfer);
        }


}

ClosedDBConnection($cn);

?>