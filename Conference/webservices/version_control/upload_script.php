<?php
include_once "../lib/common.php";
require_once "../lib/filewriter.php";
require_once "../lib/functions.php";
$module = 'VPN';



$target_file = $dir_vpn_upload_dir.$_FILES["uploadFile"]["name"];
$connection = connectDB();


$status = false;
if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
    $data = file_get_contents($target_file);
    $data_decoded = decrypt_json($data);

    if(is_object(json_decode($data_decoded))) {
        $dataArray = json_decode($data_decoded, 1);
        if(is_array($dataArray[$module])) {
            foreach($dataArray[$module] as $key => $value) {
                if(count($dataArray[$module][$key]) > 0) {
                    $query = 'TRUNCATE '.$key.';';
                    $result = Sql_exec($connection, $query);

                    $exclude = array();

                    foreach ($dataArray[$module][$key] as $val) {
                        $InsertQuery = generateInsertQuery($val, $key, $connection, $exclude);
                        $res = Sql_exec($connection, $InsertQuery);
                        if($res) {
                            $status = true;
                        }
                    }


                    if($key == 'tbl_vpn_ipsec') {
                        file_writer_vpn_ipsec($connection);
                    } else if($key == 'tbl_pptp_server') {
                        file_writer_vpn_pptp_server($connection);
                    } else if($key == 'tbl_vpn_pptp_client') {
                        file_writer_vpn_pptp_client($connection);
                    } else if($key == 'tbl_gre') {
                        file_writer_vpn_gre($connection);
                    }

                }
            }

            if($status) {
                echo '{"status":true,"message":"Data Restored Successfully."}';
            }

        } else {
            echo '{"status":false,"message":"No Config Data found."}';
        }
    } else {
        echo '{"status":false,"message":"Invalid Backup File."}';
    }

} else {
    echo '{"status":false,"message":"Sorry, there was an error uploading your file."}';
}


// added by anik
Global $virtual_network_config_dir;
Global $virtual_network_config_dir_backup;
file_put_contents($virtual_network_config_dir,"");
$data_from_file=file($virtual_network_config_dir_backup);
file_put_contents($virtual_network_config_dir,$data_from_file);
//*****////


$qry="SELECT * FROM tbl_network_virtual_hub WHERE is_active='active'";
$res= Sql_exec($connection,$qry);
while($dt=Sql_fetch_array($res)){
    vpn_network_settings_virtual_hub_insert($connection);
}



$qry = "SELECT * FROM tbl_network_group WHERE is_active='active'";
$res = Sql_exec($connection, $qry);
while ($dt = Sql_fetch_array($res)){
    group_list_insert($connection);
}




$qry="SELECT * FROM tbl_network_user WHERE is_active='active'";
$res = Sql_exec($connection, $qry);
while ($dt = Sql_fetch_array($res)){
    user_list_insert($connection);
}


$qry="SELECT * FROM tbl_network_dhcp WHERE is_active='active'";
$res = Sql_exec($connection, $qry);
while ($dt = Sql_fetch_array($res)){
    $action_id=$dt['id'];
//    echo $action_id;
    ssl_vpn_subnet_edit($connection,$action_id);

}



$qry="SELECT * FROM tbl_network_access_list WHERE is_active='active'";
$res = Sql_exec($connection, $qry);
while ($dt = Sql_fetch_array($res)){
    $virtual_hub=$dt['virtual_hub'];
    ssl_vpn_access_control_list($connection,$virtual_hub);
}


