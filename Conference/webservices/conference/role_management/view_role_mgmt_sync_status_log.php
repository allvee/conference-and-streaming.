<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 31-Dec-15
 * Time: 7:18 PM
 */

include_once "../../lib/common.php";

$cn = connectDB();
$tbl = 'role_mgmt_sync_status_log';
$vpn_session = $_SESSION['conference'];
$value = $vpn_session['id'];
$is_super_admin = false;

if ($vpn_session['user_type'] == 'Super User') {
    $is_super_admin = true;
    //$permission_array = json_decode($vpn_session['rules']['Role Management'], true);
    $query = "SELECT * FROM $tbl ORDER BY `id` DESC ;";
    $res = Sql_exec($cn, $query);
} else {
    //$permission_array = json_decode($vpn_session['rules']['Role Management'], true);
    $qry = "SELECT org1.user_id FROM org_users AS org1, org_users AS org2 WHERE org2.user_id='$value' AND org1.org_id = org2.org_id";
    $query = "SELECT * FROM $tbl where last_updated_by IN ($qry)";
    $res = Sql_exec($cn, $query);

}

if (!$res) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$data = array();
$i=0;

while ($row = Sql_fetch_array($res)) {
    $j=0;

    $data[$i][$j++] = Sql_Result($row, "component");
    $data[$i][$j++] = Sql_Result($row, "status");
    $data[$i][$j++] = Sql_Result($row, "remote_host");
    $data[$i][$j++] = Sql_Result($row, "write_time");
    $data[$i][$j++] = Sql_Result($row, "last_updated_by");

    $if_failed = Sql_Result($row, "status");

    if($if_failed == 'Failed'){
        $component = Sql_Result($row, "component");
        if($component == "Organization"){
            $data[$i][$j++] = '<button type="button" class="btn btn-success" onclick="sync_failed_organization('."'".Sql_Result($row, "id")."'".');return false;">Sync</button>';
        } elseif ($component == "Role") {
            $data[$i][$j++] = '<button type="button" class="btn btn-success" onclick="sync_failed_role('."'".Sql_Result($row, "id")."'".');return false;">Sync</button>';
        }elseif ($component == "Role Menus") {
            $data[$i][$j++] = '<button type="button" class="btn btn-success" onclick="sync_failed_role_menus('."'".Sql_Result($row, "id")."'".');return false;">Sync</button>';
        }

    } else {
        $data[$i][$j++] = '';
    }

    $i++;
}
Sql_Free_Result($res);
ClosedDBConnection($cn);
echo json_encode($data);

?>