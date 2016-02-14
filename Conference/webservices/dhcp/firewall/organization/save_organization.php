<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/16/2015
 * Time: 12:58 PM
 */


require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/functions.php";

$cn=connectDB();


$tbl='organization';

$action=mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));
$data_info=isset($_REQUEST['info'])?$_REQUEST['info']:'action';

if($data_info!='action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['deleted_id'];
}

$name = mysql_real_escape_string(htmlspecialchars($_REQUEST['organization_name']));
$parent_id=mysql_real_escape_string(htmlspecialchars($_REQUEST['parent_id']));
$master_company_id=mysql_real_escape_string(htmlspecialchars($_REQUEST['master_company_id']));
$ip=mysql_real_escape_string(htmlspecialchars($_REQUEST['organization_ip']));
$mac=mysql_real_escape_string(htmlspecialchars($_REQUEST['organization_mac']));
$last_updated=date('Y-m-d H:i:s');
$is_error=0;
$action_id=mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

if($action == 'delete'){

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'DELETE_ORGANIZATION';
    $user_data['message'] = DELETE_ORGANIZATION . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    if ($deleted_id != '') {
        $action_id = $deleted_id;
    }

   // $action_id=$deleted_id;

    $option['cn']=$cn;
    $option['page_name']='Organization';
    $option['action_type']=$action;
    $option['table']=$tbl;
    $option['id_value']=$action_id;
    setHistory($options);

    $msg="Successfully Deleted";

    $qry="UPDATE `$tbl`  SET `STATUS`='inactive',`last_updated` = '$last_updated'  WHERE `id` = '$action_id'";

    } else if($action == 'update'){

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'UPDATE_ORGANIZATION';
    $user_data['message'] = UPDATE_ORGANIZATION . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $option['cn'] = $cn;
    $option['page_name'] = 'Organization';
    $option['action_type'] = $action;
    $option['table'] = $tbl;
    $option['id_value'] = $action_id;
    setHistory($options);
    $msg="Successfully Updated";

    $qry="UPDATE `$tbl` SET `NAME` = '$name' ,`parent_id` = '$parent_id' ,`master_company_id` = '$master_company_id',`ip_addresses`='$ip',`mac_addresses`='$mac',
    `status` = 'active' , last_updated = '$last_updated' WHERE `id` = '$action_id'";

}
else{

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'DELETE_ORGANIZATION';
    $user_data['message'] = DELETE_ORGANIZATION . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

$qry="insert into `$tbl` (`NAME`,parent_id,master_company_id,ip_addresses,mac_addresses,`status`,last_updated)";
$qry .= " values ('$name','$parent_id','$master_company_id','$ip','$mac','active','$last_updated')";

    $msg="Successfully Saved";
}


try{
    $res = Sql_exec($cn,$qry);

    if (($action != 'update') && ($action != 'delete')) {
        $action_id = Sql_insert_id($cn);
        $action = 'add';
        $option['page_name'] = 'Organization';
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
    $return_data = array('status' => false, 'message' => $msg);
}
ClosedDBConnection($cn);

echo json_encode($return_data);

?>