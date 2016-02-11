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

$query = "SELECT * FROM $tbl ORDER BY `id` DESC ;";

$result = Sql_exec($cn, $query);

if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$data = array();
$i=0;

while ($row = Sql_fetch_array($result)) {
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
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);

?>