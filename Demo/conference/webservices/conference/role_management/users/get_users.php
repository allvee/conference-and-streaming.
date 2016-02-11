<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 25-Nov-15
 * Time: 5:45 PM
 */



include_once "../../../lib/common.php";
$cn = connectDB();
$options = '';
$select_users = "SELECT * FROM `users` WHERE status='active'";
$rs_users = Sql_exec($cn, $select_users);
while ($dt = Sql_fetch_array($rs_users)) {
    $user_id = $dt['id'];
    $user_name = $dt['Name'];
    $options .= '<option value="' . $user_id . '">' . $user_name . '</option>';
}

ClosedDBConnection($cn);
echo $options;
