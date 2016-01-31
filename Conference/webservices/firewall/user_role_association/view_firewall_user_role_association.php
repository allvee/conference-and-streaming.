<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/25/2015
 * Time: 5:55 PM
 */



include_once "../../lib/common.php";
require_once "../../lib/functions.php";

$cn = connectDB();
$tbl='user_role_association';
$user_id = $_SESSION["firewall"]["id"];
$user_type = $_SESSION["firewall"]["user_type"];


if($user_type == 'Super User')
    $query = "SELECT * FROM $tbl WHERE `status` = 'active' ";
else if($user_type == 'Administrator')
	$query = "SELECT * FROM $tbl WHERE `status` = 'active' AND `role_id` in (select id from roles where org_id in (select org_id from org_users where user_id='$user_id')) ";
else{
    echo json_encode([]);
    exit;
}
$result = Sql_exec($cn, $query);

if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$data = array();
$i=0;
$result_curl = curlRequest('GET', Marketplace_USER_LIST, array());
$result_array = json_decode($result_curl, true);
//print_r($result_array);

while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $user_id = Sql_Result($row, 'user_id');
    $role = Sql_Result($row, 'role_id');

    $data[$i][$j++] = $result_array[$user_id];

    $role_qry = "SELECT `name`
		FROM `roles`
		WHERE	`id`='$role'";
    $role_result = Sql_exec($cn, $role_qry);
    while ($row2 = Sql_fetch_array($role_result)) {
        $data[$i][$j++] = $row2['name'];
    }
    $data[$i][$j++] = '<span onclick="edit_firewall_user_role_association(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>'
        . '&nbsp&nbsp' . '<span onclick="delete_firewall_user_role_association(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';

    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);
