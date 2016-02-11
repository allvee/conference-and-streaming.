<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 31-Dec-15
 * Time: 1:25 PM
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




$org_query = "SELECT * FROM `organization` WHERE `status`='active';";

$result_org = Sql_exec($cn, $org_query);

$data = array();

$i=0;
while ($row_org = Sql_fetch_assoc($result_org)) {

    $data['organization'][$i]['id'] = Sql_Result($row_org, "id");
    $data['organization'][$i]['name'] = Sql_Result($row_org, "name");
    $data['organization'][$i]['parent_id'] = Sql_Result($row_org, "parent_id");
    $data['organization'][$i]['master_company_id'] = Sql_Result($row_org, "master_company_id");
    $data['organization'][$i]['ip_addresses'] = Sql_Result($row_org, "ip_addresses");
    $data['organization'][$i]['mac_addresses'] = Sql_Result($row_org, "mac_addresses");
    $data['organization'][$i]['status'] = Sql_Result($row_org, "status");
    $data['organization'][$i]['last_updated'] = Sql_Result($row_org, "last_updated");;
    $data['organization'][$i]['last_updated_by'] = Sql_Result($row_org, "last_updated_by");;

    //$curl_result = curlRequest('POST', 'http://'.$host.Marketplace_Add_ORG_API, $data);

    $i++;
}


$org_users_query = "SELECT * FROM `org_users`;";

$result_org_users = Sql_exec($cn, $org_users_query);

$i=0;
while ($row_org_users = Sql_fetch_assoc($result_org_users)) {

    $data['org_users'][$i]['id'] = Sql_Result($row_org_users, "id");
    $data['org_users'][$i]['org_id'] = Sql_Result($row_org_users, "org_id");
    $data['org_users'][$i]['user_id'] = Sql_Result($row_org_users, "user_id");
    $data['org_users'][$i]['last_updated_by'] = Sql_Result($row_org_users, "last_updated_by");


    $i++;
}

if(!empty($specified_host)){
    $success = 0;
    $failed = 0;
    $curl_result = curlRequest('POST', 'http://' . $specified_host . Marketplace_Add_ORG_API, $data);
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
        $curl_result = curlRequest('POST', 'http://' . $hosts . Marketplace_Add_ORG_API, $data);
        if($curl_result == 0) {
            $success++;
            $log_qry = "INSERT INTO role_mgmt_sync_status_log
	            (component,`status`,remote_host,write_time,last_updated,last_updated_by)
	            VALUES
	            ('Organization','Success','$hosts','$last_updated','$last_updated','$last_updated_by');";
        } else{
            $failed++;
            $log_qry = "INSERT INTO role_mgmt_sync_status_log
	            (component,`status`,remote_host,write_time,last_updated,last_updated_by)
	            VALUES
	            ('Organization','Failed','$hosts','$last_updated','$last_updated','$last_updated_by');";
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