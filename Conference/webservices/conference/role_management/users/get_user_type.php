<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 25-Nov-15
 * Time: 6:00 PM
 */



include_once "../../../lib/common.php";
$cn = connectDB();
$options = '';
$select_users = "SELECT * FROM `user_types`;";
$rs_users = Sql_exec($cn, $select_users);
while ($dt = Sql_fetch_array($rs_users)) {
    $user_type = $dt['user_type'];
    $options .= '<option value="' . $user_type . '">' . $user_type . '</option>';
}

ClosedDBConnection($cn);
echo $options;
