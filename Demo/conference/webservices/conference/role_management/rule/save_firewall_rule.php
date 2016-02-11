<?php

//header('Access-Control-Allow-Origin: *');
//session_start();
require_once "../../../lib/common.php";
require_once "../../../lib/filewriter.php";

$cn = connectDB();
$is_error = 0;

$last_updated = date('Y-m-d H:i:s');
$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];
$created_by = $_SESSION["firewall"]["id"];
$user_type = $_SESSION["firewall"]["user_type"];

if (isset($_REQUEST['info'])) {
    $data = $_REQUEST['info'];
    $action = $data['action'];
    $action_id = $data['action_id'];
} else if (isset($_POST) && isset($_POST['action']) && isset($_POST['action_id'])) {
    $action = mysql_real_escape_string(htmlspecialchars($_POST['action']));
    $action_id = mysql_real_escape_string(htmlspecialchars($_POST['action_id']));
    $rule_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['rule_name']));
    $source_address = mysql_real_escape_string(htmlspecialchars($_REQUEST['source_address']));

    if (isset($_POST['public_checkbox'])) {
        $public = 1;
    }
    else
        $public = 0;

  //  $company_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['company_id']));

    if (isset($_POST['source_checkbox'])) {
        $source_address = "__" . $source_address;
        $src_grp_type = "ip";
    }
    else if(isset($_POST['mac_checkbox'])){
        $source_address = "__" . $source_address;
        $src_grp_type = "mac";
    }else
    {
        $src_grp_type = "none";
    }

    $destination_address = mysql_real_escape_string(htmlspecialchars($_REQUEST['destination_address']));

    if (isset($_POST['destination_checkbox'])) {
       $destination_address = "__" . $destination_address;
        $dst_grp_type = "ip";
    }
    else if(isset($_POST['host_checkbox'])){
        $destination_address = "__" . $destination_address;
        $dst_grp_type = "host";
    }
    else{
        $dst_grp_type = "none";
    }

    $port = mysql_real_escape_string(htmlspecialchars($_REQUEST['port']));
    $protocol = mysql_real_escape_string(htmlspecialchars($_REQUEST['protocol']));
    //$profile_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['profile_id']));
    $start_time = mysql_real_escape_string(htmlspecialchars($_REQUEST['start_time']));
    $end_time = mysql_real_escape_string(htmlspecialchars($_REQUEST['end_time']));
    $rule_action = mysql_real_escape_string(htmlspecialchars($_REQUEST['rule_action']));

}

if ($action == "update") {

    $options['cn'] = $cn;
    $options['page_name'] = "Firewall Rule";
    $options['action_type'] = $action;
    $options['table'] = "rules";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update rules set rule_name='$rule_name',source_address='$source_address',source_group_type='$src_grp_type',destination_address='$destination_address',dest_group_type='$dst_grp_type',port='$port', protocol='$protocol', start_time='$start_time', end_time='$end_time' , action='$rule_action', last_updated='$last_updated', public='$public'";
    $qry .= " where id='$action_id'";
} else if ($action == "delete") {

    $options['cn'] = $cn;
    $options['page_name'] = "Firewall Rule";
    $options['action_type'] = "delete";
    $options['table'] = "rules";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update rules set status='inactive' WHERE id = $action_id";
} else {


    if($user_type == "Super User") {
        $qry = "insert into rules (rule_name, source_address,source_group_type,destination_address,dest_group_type,port,protocol,start_time,end_time,action,last_updated,status,public,created_by)";
        $qry .= " values ('$rule_name','$source_address','$src_grp_type','$destination_address','$dst_grp_type','$port','$protocol','$start_time','$end_time','$rule_action','$last_updated','active','$public','$created_by')";
    }
    else if($user_type=="Administrator"){

        $qry = "insert into rules (rule_name, source_address,source_group_type,destination_address,dest_group_type,port,protocol,start_time,end_time,action,last_updated,status,public,org_id,created_by)";
        $qry .= " values ('$rule_name','$source_address','$src_grp_type','$destination_address','$dst_grp_type','$port','$protocol','$start_time','$end_time','$rule_action','$last_updated','active','$public','$org_id','$created_by')";

    }else
    {
        $qry = "insert into rules (rule_name, source_address,source_group_type,destination_address,dest_group_type,port,protocol,start_time,end_time,action,last_updated,status,public,org_id,user_id,created_by)";
        $qry .= " values ('$rule_name','$source_address','$src_grp_type','$destination_address','$dst_grp_type','$port','$protocol','$start_time','$end_time','$rule_action','$last_updated','active','$public','$org_id','$user_id','$created_by')";

    }

}

try {
    $res = Sql_exec($cn, $qry);

    if($action == "insert") {
        $action_id = Sql_insert_id($cn);
        $action = 'add';
        $options['cn'] = $cn;
        $options['page_name'] = "Firewall Rule";
        $options['action_type'] = $action;
        $options['table'] = "rules";
        $options['id_value'] = $action_id;
        setHistory($options);

    }

    } catch (Exception $e) {
    $is_error = 1;
}

if ($is_error == 0) {

    $is_error = file_writer_firewall_rule($cn);

}

ClosedDBConnection($cn);

echo $is_error;
