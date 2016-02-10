<?php

header('Access-Control-Allow-Origin: *');
require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";;
require_once "../../lib/functions.php";

global  $file_dir, $dest_file_dir;

$cn = connectDB();

$is_error = 0;

$select_checkbox = $_REQUEST["select_checkbox"];
if(!$select_checkbox){
    echo 4;
    exit;
}

    foreach ($select_checkbox as $key => $value) {
        $qry = "update rules set applied='send' WHERE id = $value";

        $rs_qry = Sql_exec($cn, $qry);
    }

    if($is_error == 0)
        file_writer_firewall_rule($cn);

$user_data['user'] = $_SESSION['firewall']['login_id'];
$user_data['component'] = 'PATCH_RULE';
$user_data['message'] = PATCH_RULE . json_encode($_REQUEST);
write_activity_log_data($cn, $user_data);

ClosedDBConnection($cn);

?>