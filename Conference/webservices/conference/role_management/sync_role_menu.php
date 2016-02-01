<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 03-Jan-16
 * Time: 6:57 PM
 */

require_once "../../lib/common.php";
require_once "../../lib/functions.php";

$post_data = $_REQUEST;

$last_updated=date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["vpn"]['id'];

$cn = connectDB();
if(!empty($_REQUEST)){
    $log_id = $post_data['log_id'];
    $log_tbl_qry = "SELECT * FROM role_mgmt_sync_status_log WHERE id='$log_id';";
    $result_log_tbl = Sql_exec($cn, $log_tbl_qry);

    while ($row_log_tbl = Sql_fetch_assoc($result_log_tbl)) {
        $specified_host = Sql_Result($row_log_tbl, "remote_host");
    }
}




$role_menus_query = "SELECT * FROM `role_menus` WHERE `status`='active';";

$result_role_menus = Sql_exec($cn, $role_menus_query);

$data = array();

$i=0;
while ($row_role_menus = Sql_fetch_assoc($result_role_menus)) {

    $data['role_menus'][$i]['id'] = Sql_Result($row_role_menus, "id");
    $data['role_menus'][$i]['rule_id'] = Sql_Result($row_role_menus, "rule_id");
    $data['role_menus'][$i]['menu_id'] = Sql_Result($row_role_menus, "menu_id");
    $data['role_menus'][$i]['permissions'] = Sql_Result($row_role_menus, "permissions");
    $data['role_menus'][$i]['status'] = Sql_Result($row_role_menus, "status");
    $data['role_menus'][$i]['last_updated'] = Sql_Result($row_role_menus, "last_updated");;
    $data['role_menus'][$i]['last_updated_by'] = Sql_Result($row_role_menus, "last_updated_by");;

    //$curl_result = curlRequest('POST', 'http://'.$host.Marketplace_Add_ROLE_MENUS_API, $data);

    $i++;
}



if(!empty($specified_host)){
    $success = 0;
    $failed = 0;
    $curl_result = curlRequest('POST', 'http://' . $specified_host . Marketplace_Add_ROLE_MENUS_API, $data);
    $result_array = json_decode($curl_result, 1);
    if($result_array['status'] == true) {
        $success++;
        $log_qry = "UPDATE `role_mgmt_sync_status_log` SET `status`= 'Success',write_time= '$last_updated',last_updated='$last_updated',last_updated_by='$last_updated_by' ";
        $log_qry.= "WHERE `id`= '$log_id';";
    } else{
        $failed++;
        $log_qry = "UPDATE `role_mgmt_sync_status_log` SET `write_time`= '$last_updated',last_updated='$last_updated',last_updated_by='$last_updated_by' ";
        $log_qry.= "WHERE `id`= '$log_id';";
    }

    Sql_exec($cn, $log_qry);

} else {

    $query_for_host = "SELECT * FROM tbl_host_ip_address WHERE `is_active`='active';";

    $qry_host_result = Sql_exec($cn,$query_for_host);
    $i=0;
    while($rows_of_hosts = Sql_fetch_assoc($qry_host_result)) {
        $host_address[$i] = Sql_Result($rows_of_hosts, "ip_address");
        $i++;
    }

//$count = 0;
    $success = 0;
    $failed = 0;
    foreach($host_address as $hosts) {
        $curl_result = curlRequest('POST', 'http://' . $hosts . Marketplace_Add_ROLE_MENUS_API, $data);
        $result_array = json_decode($curl_result, 1);
        if($result_array['status'] == true) {
            $success++;
            $log_qry = "INSERT INTO role_mgmt_sync_status_log
	            (component,`status`,remote_host,write_time,last_updated,last_updated_by)
	            VALUES
	            ('Role Menus','Success','$hosts','$last_updated','$last_updated','$last_updated_by');";
        } else{
            $failed++;
            $log_qry = "INSERT INTO role_mgmt_sync_status_log
	            (component,`status`,remote_host,write_time,last_updated,last_updated_by)
	            VALUES
	            ('Role Menus','Failed','$hosts','$last_updated','$last_updated','$last_updated_by');";
        }

        Sql_exec($cn, $log_qry);
    }


}



/*if($count == 0){
    $return_data = array('status' => true, 'message' => 'Successful.');
} else {
    $return_data = array('status' => false, 'message' => ' Unsuccessful');
}*/

$return_data = array('status' => true, 'message' => '<span style="color:#00bc44;">Success: </span>' .$success. ' hosts <span style="color:#f65500;">Failed: </span>' .$failed.' hosts');

ClosedDBConnection($cn);

echo(json_encode($return_data));