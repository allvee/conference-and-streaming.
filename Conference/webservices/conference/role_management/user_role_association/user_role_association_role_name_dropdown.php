<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/25/2015
 * Time: 4:49 PM
 */

require_once  "../../../lib/common.php";

$cn = connectDB();


$qry = "SELECT `id`,`name`
		FROM `roles`
		WHERE	`status`='active'";
$res = Sql_exec($cn,$qry);

$interface_options = "";
while($dt = Sql_fetch_array($res)){
    $id=$dt['id'];
    $name=$dt['name'];
    $interface_options  .= '<option value="'.$id.'">'.$name.'</option>';
}

ClosedDBConnection($cn);
echo $interface_options;
