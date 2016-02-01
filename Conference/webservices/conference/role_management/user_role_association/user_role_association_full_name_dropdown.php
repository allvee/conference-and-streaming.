<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/25/2015
 * Time: 4:49 PM
 */

require_once  "../../../lib/common.php";

$cn = connectDB();


$qry = "SELECT `id`,`login_id`
		FROM `users`
		WHERE `status`='active'";
$res = Sql_exec($cn,$qry);

$interface_options = "";
while($dt = Sql_fetch_array($res)){
    $id=$dt['id'];
    $login_id=$dt['login_id'];
    $interface_options  .= '<option value="'.$id.'">'.$login_id.'</option>';
}

ClosedDBConnection($cn);
echo $interface_options;
