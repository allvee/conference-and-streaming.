<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/17/2015
 * Time: 1:22 PM
 */

require_once "../../../lib/common.php";
require_once "../../../lib/filewriter.php";
require_once "../../../lib/functions.php";

$cn=connectDB();


$tbl='roles';

$action=mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));
$data_info=isset($_REQUEST['info'])?$_REQUEST['info']:'action';

if($data_info!='action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['deleted_id'];
}

$name=mysql_real_escape_string(htmlspecialchars($_REQUEST['role_full_name']));
$org_id=mysql_real_escape_string(htmlspecialchars($_REQUEST['org_id']));

$last_updated=date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["vpn"]['id'];
$is_error=0;
$action_id=mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));


if($action == 'delete'){
    $vpn_role['user'] = $_SESSION['conference']['login_id'];
    $vpn_role['component'] = 'DELETE VPN ROLE';
    $vpn_role['message'] = DELETE_VPN_ROLE.json_encode($_REQUEST);
    write_activity_log_data($cn, $vpn_role);

     $action_id=$deleted_id;

    $option['cn']=$cn;
    $option['page_name']='Roles';
    $option['action_type']=$action;
    $option['table']=$tbl;
    $option['id_value']=$action_id;
    setHistory($options);
    $msg="Successfully Deleted";
    $qry="UPDATE `$tbl`  SET `STATUS`='inactive',`last_updated` = '$last_updated', last_updated_by = '$last_updated_by'  WHERE `id` = '$action_id'";

} else if($action == 'update'){
    $vpn_role['user'] = $_SESSION['conference']['login_id'];
    $vpn_role['component'] = 'UPDATE VPN ROLE';
    $vpn_role['message'] = UPDATE_VPN_ROLE.json_encode($_REQUEST);
    write_activity_log_data($cn, $vpn_role);


    $option['cn'] = $cn;
    $option['page_name']='Roles';
    $option['action_type'] = $action;
    $option['table'] = $tbl;
    $option['id_value'] = $action_id;
    setHistory($options);
    $msg="Successfully Updated";
    $qry="UPDATE `$tbl` SET `NAME` = '$name' ,`org_id` = '$org_id', last_updated_by = '$last_updated_by',
    STATUS = 'active' ,
    last_updated = '$last_updated' WHERE `id` = '$action_id'";

} else{
    $vpn_role['user'] = $_SESSION['conference']['login_id'];
    $vpn_role['component'] = 'ADD VPN ROLE';
    $vpn_role['message'] = ADD_VPN_ROLE.json_encode($_REQUEST);
    write_activity_log_data($cn, $vpn_role);
    $qry="insert into `$tbl` (NAME,org_id,STATUS,last_updated, last_updated_by)";
    $qry .= " values ('$name','$org_id','active','$last_updated','$last_updated_by')";
    $msg="Successfully Saved";
}
try{
    $res = Sql_exec($cn,$qry);

    if (($action != 'update') && ($action != 'delete')) {
        $action_id = Sql_insert_id($cn);
        $action = 'add';
        $option['page_name']='Roles';
        $options['action_type'] = $action;
        $option['table'] = $tbl;
        $option['id_value'] = $action_id;
        setHistory($options);

    }
}catch (Exception $e){
    $is_error=1;
}

if($is_error==0){
    $return_data=array('status'=>true, 'message'=>$msg);
}else{
    $return_data=array('status'=>fasle, 'message'=>$msg);
}
ClosedDBConnection($cn);


echo json_encode($return_data);


?>