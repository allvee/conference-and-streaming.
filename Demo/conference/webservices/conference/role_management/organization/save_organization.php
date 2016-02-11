<?php


require_once "../../../lib/common.php";
require_once "../../../lib/filewriter.php";
require_once "../../../lib/functions.php";

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
$last_updated_by = $_SESSION["vpn"]['id'];
$is_error=0;
$action_id=mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

if($action == 'delete'){


    $vpn_organization['user'] = $_SESSION['conference']['login_id'];
     $vpn_organization['component'] = 'DELETE VPN ORGANIZATION';
    $vpn_organization['message'] = DELETE_VPN_ORGANIZATION.json_encode($_REQUEST);
    write_activity_log_data($cn,  $vpn_organization);


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

    $qry="UPDATE `$tbl`  SET `STATUS`='inactive',`last_updated` = '$last_updated', last_updated_by = '$last_updated_by'  WHERE `id` = '$action_id'";

    } else if($action == 'update'){

    $vpn_organization['user'] = $_SESSION['conference']['login_id'];
    $vpn_organization['component'] = 'UPDATE VPN ORGANIZATION';
    $vpn_organization['message'] = UPDATE_VPN_ORGANIZATION.json_encode($_REQUEST);
    write_activity_log_data($cn,  $vpn_organization);



    $option['cn'] = $cn;
    $option['page_name'] = 'Organization';
    $option['action_type'] = $action;
    $option['table'] = $tbl;
    $option['id_value'] = $action_id;
    setHistory($options);
    $msg="Successfully Updated";

    $qry="UPDATE `$tbl` SET `NAME` = '$name' ,`parent_id` = '$parent_id' ,`master_company_id` = '$master_company_id',`ip_addresses`='$ip',`mac_addresses`='$mac',
    `status` = 'active' , last_updated = '$last_updated', last_updated_by = '$last_updated_by' WHERE `id` = '$action_id'";

}
else{

    $vpn_organization['user'] = $_SESSION['conference']['login_id'];
     $vpn_organization['component'] = 'ADD VPN ORGANIZATION';
    $vpn_organization['message'] = ADD_VPN_ORGANIZATION.json_encode($_REQUEST);
    write_activity_log_data($cn,  $vpn_organization);


$qry="insert into `$tbl` (`NAME`,parent_id,master_company_id,ip_addresses,mac_addresses,`status`,last_updated, last_updated_by)";
$qry .= " values ('$name','$parent_id','$master_company_id','$ip','$mac','active','$last_updated', '$last_updated_by')";

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