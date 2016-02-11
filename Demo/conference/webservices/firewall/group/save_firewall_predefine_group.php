<?php

header('Access-Control-Allow-Origin: *');
//session_start();
require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/functions.php";


$cn = connectDB();
$last_updated = date('Y-m-d H:i:s');
$org_id = $_SESSION["firewall"]["org_ids"];
$created_by = $_SESSION["firewall"]["id"];

$user_type = $_SESSION["firewall"]["user_type"];


if (isset($_POST) && isset($_POST['action'])) {
    $action = mysql_real_escape_string(htmlspecialchars($_POST['action']));
    $group_name = $_REQUEST['group_name'];

    //$read_only = mysql_real_escape_string(htmlspecialchars($_REQUEST['read_only']));
    //$group_content = trim(mysql_real_escape_string(htmlspecialchars($_REQUEST['group_content'])));
}

$is_error = 0;
$flag = 1;
$public = 0;


        foreach($group_name as $id=>$group)
        {
            $group_content =  file_get_contents($get_group_content.$group);
            $group_description =  file_get_contents($get_group_description .$group);
            $qry_group_exist = "select * from groups";
            $qry_group_exist .= " where name = '$group' AND org_id IN ($org_id)";
            $rs_group_exist = Sql_exec($cn, $qry_group_exist);
            $data_group_exist = Sql_fetch_array($rs_group_exist);
            $exist_group_id = $data_group_exist['id'];

            if($exist_group_id){

                $qry_update = "update groups set content='$group_content', last_updated='$last_updated', description='$group_description'";
                $qry_update .= " where id='$exist_group_id'";

                $result = Sql_exec($cn, $qry_update);
            }
            else {
                    if($flag)
                    {
                     $flag= 0;
                     $qry = "insert into groups (type, name, content, last_updated, created_by, status, public, read_only, org_id,description)  values ";
                     $subqry = array();
                    }

                    $string = $group_content;
                    $group_content_tok = strtok($string, " /\n");
                    $group_content_tok = trim($group_content_tok);

                    if (!filter_var($group_content_tok, FILTER_VALIDATE_IP) === false) {
                        $group_type = "ip";
                    } else {
                        $group_type = "host";
                    }

                    $subqry[] = "('$group_type','$group','$group_content','$last_updated','$created_by','active','$public','1','$org_id','$group_description')";
                }
        }

        $qry =  $qry.implode(",", $subqry);

try {
    if($qry)
    {
        $res = Sql_exec($cn, $qry);
        $user_data['user'] = $_SESSION['firewall']['login_id'];
        $user_data['component'] = 'ADD_PREDEFINE_GROUP';
        $user_data['message'] = ADD_PREDEFINE_GROUP . json_encode($_REQUEST);
        write_activity_log_data($cn, $user_data);

    }

} catch (Exception $e) {
    $is_error = 1;
}

if ($is_error == 0) {
    $is_error = file_writer_firewall_group($cn);
}

ClosedDBConnection($cn);

echo $is_error;
