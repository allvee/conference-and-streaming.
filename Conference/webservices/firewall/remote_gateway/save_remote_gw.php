<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 29-Dec-15
 * Time: 2:05 PM
 */

require_once "../../lib/common.php";
require_once "../../lib/functions.php";

$cn = connectDB();



$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));

$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';

if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['deleted_id'];
}

$ip = mysql_real_escape_string(htmlspecialchars($_REQUEST['ip_address']));


$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["firewall"]['login_id'];

if ($action == 'delete') {

    $remote_gw['user'] = $_SESSION['firewall']['login_id'];
    $remote_gw['component'] = 'DELETE REMOTE GATEWAY';
    $remote_gw['message'] = DELETE_REMOTE_GATEWAY.json_encode($_REQUEST);
    write_activity_log_data($cn, $remote_gw);


    $action_id = $deleted_id;
    $options['cn'] = $cn;
    $options['page_name'] = "Remote Gateway";
    $options['action_type'] = $action;
    $options['table'] = "tbl_host_ip_address";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update  tbl_host_ip_address set is_active='inactive', last_updated='$last_updated', last_updated_by='$last_updated_by'";
    $qry .= " where id='$action_id'";

} else if ($action == 'update') {
    $remote_gw['user'] = $_SESSION['firewall']['login_id'];
    $remote_gw['component'] = 'UPDATE REMOTE GATEWAY';
    $remote_gw['message'] = UPDATE_REMOTE_GATEWAY.json_encode($_REQUEST);
    write_activity_log_data($cn, $remote_gw);


    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));
    $options['cn'] = $cn;
    $options['page_name'] = "Remote Gateway";
    $options['action_type'] = $action;
    $options['table'] = "tbl_host_ip_address";
    $options['id_value'] = $action_id;
    setHistory($options);


    $qry = "update tbl_host_ip_address set ip_address='$ip',last_updated='$last_updated', last_updated_by='$last_updated_by', is_active='active'";
    $qry .= " where id='$action_id'";
} else {

    $remote_gw['user'] = $_SESSION['firewall']['login_id'];
    $remote_gw['component'] = 'ADD REMOTE GATEWAY';
    $remote_gw['message'] = ADD_REMOTE_GATEWAY.json_encode($_REQUEST);
    write_activity_log_data($cn, $remote_gw);




    $qry = "insert into tbl_host_ip_address (ip_address,last_updated,last_updated_by,is_active)";
    $qry .= " values ('$ip','$last_updated','$last_updated_by','active')";
}

$is_error = 0;

try {
    $res = Sql_exec($cn, $qry);
    if (($action != 'update') && ($action != 'delete')) {
        $action_id = Sql_insert_id($cn);
        $action = 'add';
        $options['page_name'] = "Remote Gateway";
        $options['action_type'] = $action;
        $options['table'] = "tbl_host_ip_address";
        $options['id_value'] = $action_id;
        setHistory($options);
    }

} catch (Exception $e) {
    $is_error = 1;
}

if ($is_error == 0) {
    $return_data = array('status' => true, 'message' => 'Successful.');
} else {
    $return_data = array('status' => false, 'message' => ' Unsuccessful');
}

echo json_encode($return_data);
ClosedDBConnection($cn);