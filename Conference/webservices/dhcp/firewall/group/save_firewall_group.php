<?php

header('Access-Control-Allow-Origin: *');
//session_start();
require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/functions.php";


$cn = connectDB();
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
    $group_type = mysql_real_escape_string(htmlspecialchars($_REQUEST['group_type']));
    $group_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['group_name']));

    if (isset($_POST['public_checkbox'])) {
        $public = 1;
    }
    else
        $public = 0;

    $read_only = mysql_real_escape_string(htmlspecialchars($_REQUEST['read_only']));
    $group_content = trim(mysql_real_escape_string(htmlspecialchars($_REQUEST['group_content'])));


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
            $org_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['rule_name']));
        $created_by = mysql_real_escape_string(htmlspecialchars($_REQUEST['created_by']));

        $select_qry = "SELECT * FROM groups WHERE name ='".$group_name."'";
        $select_res = Sql_exec($cn, $select_qry);
        if(Sql_Num_Rows($select_res)>0)
        {
            $action = "update";
            $data_select_action = Sql_fetch_array($select_res);
            $action_id = $data_select_action['id'];
        }
    }

}

$is_error = 0;

$prev_group_name = '';
if ($action == "update" || $action == "delete") {
    $select_qry = "SELECT * FROM groups WHERE id='".$action_id."'";
    $select_res = Sql_exec($cn, $select_qry);

    while ($dt = Sql_fetch_array($select_res)) {
        $prev_group_name = $dt['name'];
    }
}

if ($action == "update") {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'UPDATE_GROUP';
    $user_data['message'] = UPDATE_GROUP . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $options['cn'] = $cn;
    $options['page_name'] = "Firewall Group";
    $options['action_type'] = $action;
    $options['table'] = "groups";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update groups set type='$group_type',name='$group_name',content='$group_content', last_updated='$last_updated',  public='$public',read_only='$read_only'";//",created_by='$created_by',org_id='$org_id',user_id='$user_id'";
    $qry .= " where id='$action_id'";

    $qry_read_fw_grp_dir = "select firewall_directory from config;";
    $rs_read_fw_grp_dir = Sql_exec($cn, $qry_read_fw_grp_dir);

    $data = Sql_fetch_array($rs_read_fw_grp_dir);
    $firewall_test = $data['firewall_directory'];
    unlink($firewall_test.'__' . $prev_group_name . ".txt");

} else if ($action == "delete") {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'DELETE_GROUP';
    $user_data['message'] = DELETE_GROUP . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $options['cn'] = $cn;
    $options['page_name'] = "Firewall Group";
    $options['action_type'] = "delete";
    $options['table'] = "groups";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update groups set status='inactive' WHERE id = $action_id";

    $qry_read_fw_grp_dir = "select firewall_directory from config;";
    $rs_read_fw_grp_dir = Sql_exec($cn, $qry_read_fw_grp_dir);

    $data = Sql_fetch_array($rs_read_fw_grp_dir);
    $firewall_test = $data['firewall_directory'];
    unlink($firewall_test.'__' . $prev_group_name . ".txt");
} else {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'ADD_GROUP';
    $user_data['message'] = ADD_GROUP . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

  if($user_type == "Super User") {
        $qry = "insert into groups (type, name, content, last_updated, created_by, status, public, read_only)";
        $qry .= " values ('$group_type','$group_name','$group_content','$last_updated','$created_by','active','$public','$read_only')";
    }
    else if($user_type=="Administrator"){

        $qry = "insert into groups (type, name, content, last_updated, created_by, status, public, org_id, read_only)";
        $qry .= " values ('$group_type','$group_name','$group_content','$last_updated','$created_by','active','$public','$org_id','$read_only')";

    }else
    {
        $qry = "insert into groups (type, name, content, last_updated, created_by, status, public, org_id, read_only,user_id)";
        $qry .= " values ('$group_type','$group_name','$group_content','$last_updated','$created_by','active','$public','$org_id','$read_only','$user_id')";

    }

  }

try {
    $res = Sql_exec($cn, $qry);


    if($action == "insert") {

        $action_id = Sql_insert_id($cn);
        $action = 'add';
        $options['cn'] = $cn;
        $options['page_name'] = "Firewall Group";
        $options['action_type'] = $action;
        $options['table'] = "groups";
        $options['id_value'] = $action_id;
        setHistory($options);
    }


} catch (Exception $e) {
    $is_error = 1;
}

if ($file_writer_flag == 1) {
   //$is_error = file_writer_firewall_group($cn);
}

ClosedDBConnection($cn);

echo $is_error;
