<?php
/**
 * Created by PhpStorm.
 * User: L440-User
 * Date: 11/26/2015
 * Time: 3:17 PM
 */

header('Access-Control-Allow-Origin: *');
require_once "../../lib/common.php";
require_once "../../lib/functions.php";

$cn = connectDB();
$user_id = $_SESSION["firewall"]["id"];
$org_id = $_SESSION["firewall"]["org_ids"];
$user_type = $_SESSION["firewall"]["user_type"];

$options = '';
    if($user_type == "Super User")
        $select_roles = "SELECT `id`, `name` FROM roles WHERE `status`='active'";
    else
        $select_roles = "SELECT `id`, `name` FROM roles WHERE `status` = 'active' AND `org_id` IN (select org_id from org_users where user_id='$user_id') AND `id` NOT IN (SELECT `role_id` FROM `user_role_association` WHERE `user_id` = ".$user_id." )";
$rs_roles = Sql_exec($cn, $select_roles);
$options = '<option value="">--Select--</option>';
while ($dt = Sql_fetch_assoc($rs_roles)) {

    $options .= '<option value="' . $dt['id'] . '">' . $dt['name'] . '</option>';
}
ClosedDBConnection($cn);
echo $options;