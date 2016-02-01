
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
$tbl='org_users';


$query = "SELECT * FROM $tbl";

$result = Sql_exec($cn, $query);

if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$data = array();
$i=0;
$result_curl = curlRequest('GET', Marketplace_USER_LIST, array());
$result_array = json_decode($result_curl, true);

while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $org_id = Sql_Result($row, 'org_id');
    $user_id = Sql_Result($row, 'user_id');

    //print_r($result_array); exit;
    $data[$i][$j++] = $result_array[$user_id];


    $role_qry = "SELECT `name`
		FROM `organization`
		WHERE	`id`='$org_id'";
    $role_result = Sql_exec($cn, $role_qry);
    while ($row2 = Sql_fetch_array($role_result)) {
        $data[$i][$j++] = $row2['name'];
    }
    $data[$i][$j++] = '<span onclick="edit_firewall_organization_user(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/pen.png" ></span>'
        . '&nbsp&nbsp' . '<span onclick="delete_firewall_organization_user(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/cancel.png" ></span>';

    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);
