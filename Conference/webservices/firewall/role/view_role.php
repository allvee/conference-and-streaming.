<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/17/2015
 * Time: 1:21 PM
 */


include_once "../../lib/common.php";

$cn = connectDB();
$tbl='roles';

$user_type = $_SESSION["firewall"]["user_type"];
$user_id = $_SESSION["firewall"]["id"];

if($user_type=='Super User')
	$query = "SELECT * FROM $tbl WHERE `status` = 'active' ";
else if ($user_type=='Administrator')
	$query = "SELECT * FROM $tbl WHERE `status` = 'active' and org_id IN (select org_id from org_users where user_id='$user_id')";
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

while ($row = Sql_fetch_array($result)) {
    $j=0;
    $data[$i][$j++] = Sql_Result($row, "name");
    $org_id=Sql_Result($row, "org_id");

        $name_qry = "SELECT `NAME`
	FROM
	organization WHERE id=$org_id";

    $name_result = Sql_exec($cn, $name_qry);

    while ($row1 = Sql_fetch_array($name_result)) {
        $data[$i][$j++] = $row1['NAME'];
    }
    
    $data[$i][$j++] = '<span onclick="edit_firewall_role(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>'
        . '&nbsp&nbsp' . '<span onclick="delete_firewall_role(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';

    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);