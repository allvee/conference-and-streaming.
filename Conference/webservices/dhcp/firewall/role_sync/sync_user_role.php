<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 31-Dec-15
 * Time: 6:20 PM
 */


require_once "../../lib/common.php";
require_once "../../lib/functions.php";

$post_data = $_REQUEST;

$last_updated_by = $_SESSION["firewall"]['login_id'];
$last_updated = date('Y-m-d H:i:s');

$cn = connectDB();

if(!empty($_REQUEST)){
    $log_id = $post_data['log_id'];
    $log_tbl_qry = "SELECT * FROM role_mgmt_sync_status_log WHERE id='$log_id';";
    $result_log_tbl = Sql_exec($cn, $log_tbl_qry);

    while ($row_log_tbl = Sql_fetch_assoc($result_log_tbl)) {
        $specified_host = Sql_Result($row_log_tbl, "remote_host");
    }
}



$role_query = "SELECT * FROM `roles`  WHERE `status` = 'active';";

$result_role = Sql_exec($cn, $role_query);

$data = array();

$i=0;
while ($row_role = Sql_fetch_assoc($result_role)) {

    $data['roles'][$i]['id'] = Sql_Result($row_role, "id");
    $data['roles'][$i]['name'] = Sql_Result($row_role, "name");
    $data['roles'][$i]['org_id'] = Sql_Result($row_role, "org_id");
    $data['roles'][$i]['status'] = Sql_Result($row_role, "status");
    $data['roles'][$i]['last_updated'] = Sql_Result($row_role, "last_updated");
    $data['roles'][$i]['last_updated_by'] = Sql_Result($row_role, "last_updated_by");;


    $i++;
}


$role_association_query = "SELECT * FROM `user_role_association` WHERE `status` = 'active';";

$result_role_association = Sql_exec($cn, $role_association_query);

$i=0;
while ($row_role_association = Sql_fetch_assoc($result_role_association)) {

    $data['user_role_association'][$i]['id'] = Sql_Result($row_role_association, "id");
    $data['user_role_association'][$i]['user_id'] = Sql_Result($row_role_association, "user_id");
    $data['user_role_association'][$i]['role_id'] = Sql_Result($row_role_association, "role_id");
    $data['user_role_association'][$i]['status'] = Sql_Result($row_role_association, "status");
    $data['user_role_association'][$i]['last_updated_by'] = Sql_Result($row_role_association, "last_updated_by");

    $i++;
}


if(!empty($specified_host)){
    $success = 0;
    $failed = 0;
    $curl_result = curlRequest('POST', 'http://' . $specified_host . Marketplace_Add_ROLE_API, $data);
    if($curl_result == 0) {
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
        $curl_result = curlRequest('POST', 'http://' . $hosts . Marketplace_Add_ROLE_API, $data);
        if($curl_result == 0) {
            $success++;
            $log_qry = "INSERT INTO role_mgmt_sync_status_log
	            (component,`status`,remote_host,write_time,last_updated,last_updated_by)
	            VALUES
	            ('Role','Success','$hosts','$last_updated','$last_updated','$last_updated_by');";
        } else{
            $failed++;
            $log_qry = "INSERT INTO role_mgmt_sync_status_log
	            (component,`status`,remote_host,write_time,last_updated,last_updated_by)
	            VALUES
	            ('Role','Failed','$hosts','$last_updated','$last_updated','$last_updated_by');";
        }

        Sql_exec($cn, $log_qry);
    }


}




$return_data = array('status' => true, 'message' => '<span style="color:#00bc44;">Success: </span>' .$success. ' hosts <span style="color:#f65500;">Failed: </span>' .$failed.' hosts');

ClosedDBConnection($cn);

echo(json_encode($return_data));