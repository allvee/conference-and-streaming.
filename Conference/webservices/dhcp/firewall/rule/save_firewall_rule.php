<?php

require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/functions.php";

$cn = connectDB();
$is_error = 0;

$file_writer_flag = 0;
$last_updated = date('Y-m-d H:i:s');
$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];
$created_by = $_SESSION["firewall"]["id"];
$user_type = $_SESSION["firewall"]["user_type"];

if (isset($_REQUEST['info'])) {
    $data = $_REQUEST['info'];
    $action = $data['action'];
    $action_id = $data['action_id'];
} else if (isset($_POST) && isset($_POST['action'])) {
    $action = mysql_real_escape_string(htmlspecialchars($_POST['action']));
    $action_id = mysql_real_escape_string(htmlspecialchars($_POST['action_id']));
    $rule_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['rule_name']));
    $source_address = mysql_real_escape_string(htmlspecialchars($_REQUEST['source_address']));

    if(!$source_address)
        $source_address= "all";

    if (isset($_POST['public_checkbox'])) {
        $public = 1;
    }
    else
        $public = 0;

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

    if(!$destination_address)
        $destination_address= "all";

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
    if(!$port)
        $port= "all";

    $protocol = mysql_real_escape_string(htmlspecialchars($_REQUEST['protocol']));
    $profile_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['time_profile_name']));


    $rule_action = mysql_real_escape_string(htmlspecialchars($_REQUEST['rule_action']));
    $applied = "not_send";


    if($org_id == 0 && $user_id == 0 && $created_by == 0) {

        $file_writer_flag = 1;
        $public = mysql_real_escape_string(htmlspecialchars($_REQUEST['public']));
        $user_type = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_type']));

        $src_grp_type = mysql_real_escape_string(htmlspecialchars($_REQUEST['source_group_type']));
        if(!$src_grp_type == 'none')
        $source_address = "__" . $source_address;

        $dst_grp_type = mysql_real_escape_string(htmlspecialchars($_REQUEST['dest_group_type']));
        if(!$dst_grp_type == 'none')
        $destination_address = "__" . $destination_address;

          if($user_type == 'Super User')
            $created_by = mysql_real_escape_string(htmlspecialchars($_REQUEST['created_by']));
        else
            $org_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['org_id']));
        $created_by = mysql_real_escape_string(htmlspecialchars($_REQUEST['created_by']));

        if ($action == 'delete') {
            $select_qry = "SELECT * FROM rules WHERE rule_name ='" . $rule_name . "' AND org_id ='" . $org_id . "' AND created_by ='".$created_by."'" ;
            $select_res = Sql_exec($cn, $select_qry);
            $applied = "send";
            while ($data_select_action = Sql_fetch_array($select_res)){
                $action_id = $data_select_action['id'];
                $qry = "update rules set status='inactive',applied='not_send' WHERE id = $action_id";
                $res = Sql_exec($cn, $qry);
            }
            file_writer_firewall_rule($cn);
            echo 0;
            exit;

        } else if ($action == 'insert') {
            $select_qry = "SELECT * FROM rules WHERE rule_name ='" . $rule_name . "' AND org_id ='" . $org_id . "' AND created_by ='".$created_by."' AND source_address='".$source_address."'";
            $select_res = Sql_exec($cn, $select_qry);
            $applied = "send";
            if (Sql_Num_Rows($select_res) > 0) {
                while ($data_select_action = Sql_fetch_array($select_res)){
                    $action_id = $data_select_action['id'];
                    $qry = "update rules set profile_id='$profile_id',rule_name='$rule_name',source_address='$source_address',source_group_type='$src_grp_type',destination_address='$destination_address',dest_group_type='$dst_grp_type',port='$port', protocol='$protocol', start_time='$start_time', end_time='$end_time' , action='$rule_action', last_updated='$last_updated', public='$public',status='active',applied='send'";
                    $qry .= " where id='$action_id'";
                    $res = Sql_exec($cn, $qry);
                }
                file_writer_firewall_rule($cn);
                echo 0;
                exit;
            }
        } else if ($action == 'update') {
            $select_qry = "SELECT * FROM rules WHERE rule_name ='" . $rule_name . "' AND org_id ='" . $org_id . "' AND created_by ='".$created_by."'";
            $select_res = Sql_exec($cn, $select_qry);
                while ($data_select_action = Sql_fetch_array($select_res)){
                    $action_id = $data_select_action['id'];
                    $qry = "update rules set status='inactive',applied='not_send'";
                    $qry .= " where id='$action_id'";
                    $res = Sql_exec($cn, $qry);
                }
                file_writer_firewall_rule($cn);
                echo 0;
                exit;
        }

    }

}

if ($action == "update") {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'UPDATE_RULE';
    $user_data['message'] = UPDATE_RULE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $options['cn'] = $cn;
    $options['page_name'] = "Firewall Rule";
    $options['action_type'] = $action;
    $options['table'] = "rules";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update rules set profile_id='$profile_id',rule_name='$rule_name',source_address='$source_address',source_group_type='$src_grp_type',destination_address='$destination_address',dest_group_type='$dst_grp_type',port='$port', protocol='$protocol', start_time='$start_time', end_time='$end_time' , action='$rule_action', last_updated='$last_updated', public='$public'";
    $qry .= " where id='$action_id'";

} else if ($action == "delete") {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'DELETE_RULE';
    $user_data['message'] = DELETE_RULE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $options['cn'] = $cn;
    $options['page_name'] = "Firewall Rule";
    $options['action_type'] = "delete";
    $options['table'] = "rules";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update rules set status='inactive',applied='not_send' WHERE id = $action_id";

} else {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'ADD_RULE';
    $user_data['message'] = ADD_RULE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    if($user_type == "Super User") {
        $qry = "insert into rules (profile_id,rule_name, source_address,source_group_type,destination_address,dest_group_type,port,protocol,start_time,end_time,action,last_updated,status,public,created_by,applied)";
        $qry .= " values ('$profile_id','$rule_name','$source_address','$src_grp_type','$destination_address','$dst_grp_type','$port','$protocol','$start_time','$end_time','$rule_action','$last_updated','active','$public','$created_by','$applied')";
    }
    else if($user_type=="Administrator"){

        $qry = "insert into rules (profile_id,rule_name, source_address,source_group_type,destination_address,dest_group_type,port,protocol,start_time,end_time,action,last_updated,status,public,org_id,created_by,applied)";
        $qry .= " values ('$profile_id','$rule_name','$source_address','$src_grp_type','$destination_address','$dst_grp_type','$port','$protocol','$start_time','$end_time','$rule_action','$last_updated','active','$public','$org_id','$created_by','$applied')";

    }else
    {
        $qry = "insert into rules (profile_id,rule_name, source_address,source_group_type,destination_address,dest_group_type,port,protocol,start_time,end_time,action,last_updated,status,public,org_id,user_id,created_by,applied)";
        $qry .= " values ('$profile_id','$rule_name','$source_address','$src_grp_type','$destination_address','$dst_grp_type','$port','$protocol','$start_time','$end_time','$rule_action','$last_updated','active','$public','$org_id','$user_id','$created_by','$applied')";

    }


}

try {
    $res = Sql_exec($cn, $qry);
    if($action=="delete")
        file_writer_firewall_rule($cn);
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

if ($file_writer_flag == 1) {

   $is_error = file_writer_firewall_rule($cn);

}

ClosedDBConnection($cn);

echo $is_error;
