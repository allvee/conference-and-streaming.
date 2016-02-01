<?php
include_once "../../../lib/common.php";
require_once "../../../lib/functions.php";
//$cn = connectDB();
$result = curlRequest('GET', Marketplace_USER_OPTIONS, array());
/*$options = '';
$select_users = "SELECT * FROM `users` WHERE status='active'";
$rs_users = Sql_exec($cn, $select_users);
while ($dt = Sql_fetch_array($rs_users)) {
    $user_id = $dt['id'];
    $user_name = $dt['Name'];
    $options .= '<option value="' . $user_id . '">' . $user_name . '</option>';
}

ClosedDBConnection($cn);*/
echo $result;