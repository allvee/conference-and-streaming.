<?php
/**
 * Created by PhpStorm.
 * User: L440-User
 * Date: 11/26/2015
 * Time: 5:11 PM
 */

header('Access-Control-Allow-Origin: *');
include_once "../../../lib/common.php";
require_once "../../../lib/filewriter.php";
require_once "../../../lib/functions.php";

$cn = connectDB();

$info = $_REQUEST['info'];
$role_id = $info['role_id'];
$permissions = $info['permissions'];

$del_qry = "DELETE FROM role_menus WHERE `rule_id` = '$role_id'";
Sql_exec($cn, $del_qry);
$is_error = 0;
try {
    foreach ($permissions as $menu_id => $permission_values) {

        $log_data_arr['user'] = $_SESSION['conference']['login_id'];
        $log_data_arr['component'] = 'UPDATE ROLE MENU';
        $log_data_arr['message'] = UPDATE_ROLE_MENU.json_encode($_REQUEST);
        write_activity_log_data($cn, $log_data_arr);

        $permissions_string = json_encode($permission_values);
        $qry = "INSERT INTO `role_menus`( `rule_id`,`menu_id`, `permissions`,`status`,`last_updated`) VALUES ( '$role_id','$menu_id', '$permissions_string','active', NOW())";
        Sql_exec($cn, $qry);
    }
}catch(Exception $e){
    $is_error = 1;
}

echo $is_error;

ClosedDBConnection($cn);