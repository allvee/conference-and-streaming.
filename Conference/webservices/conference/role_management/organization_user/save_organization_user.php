<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/30/2015
 * Time: 7:10 PM
 */

require_once "../../../lib/common.php";
require_once "../../../lib/filewriter.php";
require_once "../../../lib/functions.php";

$cn=connectDB();


$tbl='org_users';

$action=mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));
$data_info=isset($_REQUEST['info'])?$_REQUEST['info']:'action';

if($data_info!='action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
}

$user_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['organization_user_name']));
$org_name=mysql_real_escape_string(htmlspecialchars($_REQUEST['organization_user_organization_name']));

$is_error=0;
$action_id=mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));
$last_updated_by = $_SESSION["conference"]['id'];

if($action == 'delete'){


    $vpn_organization_user['user'] = $_SESSION['conference']['login_id'];
    $vpn_organization_user['component'] = 'DELETE VPN ORGANIZATION USER';
    $vpn_organization_user['message'] = DELETE_VPN_ORGANIZATION_USER.json_encode($_REQUEST);
    write_activity_log_data($cn, $vpn_organization_user);

    if ($deleted_id != '') {
        $action_id = $deleted_id;
    }

     $action_id=$deleted_id;
        $msg="Successfully Deleted";


    $qry="DELETE FROM org_users WHERE id = '$action_id'";

} else if($action == 'update'){
    $vpn_organization_user['user'] = $_SESSION['conference']['login_id'];
    $vpn_organization_user['component'] = 'UPDATE VPN ORGANIZATION USER';
    $vpn_organization_user['message'] = UPDATE_VPN_ORGANIZATION_USER.json_encode($_REQUEST);
    write_activity_log_data($cn, $vpn_organization_user);

    $qry="UPDATE `$tbl` SET `org_id` = '$org_name' ,`user_id` = '$user_name', last_updated_by = '$last_updated_by' WHERE `id` = '$action_id'";
 
}
else{
    $vpn_organization_user['user'] = $_SESSION['conference']['login_id'];
    $vpn_organization_user['component'] = 'ADD VPN ORGANIZATION USER';
    $vpn_organization_user['message'] = ADD_VPN_ORGANIZATION_USER.json_encode($_REQUEST);
    write_activity_log_data($cn, $vpn_organization_user);

    $qry="insert into `$tbl` (`org_id`,user_id, last_updated_by)";
    $qry .= " values ('$org_name','$user_name','$last_updated_by')";

    $msg="Successfully Saved";
    
}


try{
    $res = Sql_exec($cn,$qry);

}catch (Exception $e){
    $is_error=1;
}


if($is_error==0){
    $return_data=array('status'=>true, 'message'=>$msg);
}else{
    $return_data = array('status' => false, 'message' => $msg);
}
ClosedDBConnection($cn);

echo json_encode($return_data);

?>