<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/16/2015
 * Time: 12:59 PM
 */

include_once "../../lib/common.php";


$user_type = $_SESSION["firewall"]["user_type"];
$user_id = $_SESSION["firewall"]["id"];

$cn = connectDB();
$tbl='organization';


$query = "SELECT * FROM $tbl WHERE `status` = 'active' ";

if($user_type == "Administrator")
    $query = "SELECT * FROM $tbl WHERE `status` = 'active' and id in (select org_id from org_users where user_id='$user_id')";


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
    $parent_id = Sql_Result($row, "parent_id");

    if(!empty($parent_id)){
        $qry = "SELECT * FROM `organization` WHERE `id`='$parent_id';";
        $res = Sql_exec($cn, $qry);
        while ($rows = Sql_fetch_assoc($res)) {
            $parent_name = Sql_Result($rows, "name");
        }
    }


    $data[$i][$j++] = $parent_name;

    if(Sql_Result($row, "master_company_id")=="1") {
        $data[$i][$j++] = "SSD-Tech";
    } else {
        $data[$i][$j++] = "Unknown";
    }
    $data[$i][$j++] = Sql_Result($row, "ip_addresses");
    $data[$i][$j++] = Sql_Result($row, "mac_addresses");


    $data[$i][$j++] = '<span onclick="edit_firewall_organization(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/pen.png" ></span>'
            . '&nbsp&nbsp' . '<span onclick="delete_firewall_organization(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/cancel.png" ></span>';

    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);