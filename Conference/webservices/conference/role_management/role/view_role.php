<?php

include_once "../../../lib/common.php";
require_once "../../../lib/functions.php";

$cn = connectDB();
$tbl = 'roles';
$vpn_session = $_SESSION['conference'];
$value = $vpn_session['id'];
$is_super_admin = false;

if ($vpn_session['user_type'] == 'Super User') {
    $is_super_admin = true;
    $permission_array = json_decode($vpn_session['rules']['Role Management'], true);
    $query = "SELECT * FROM $tbl WHERE `status` = 'active' ";
    $result = Sql_exec($cn, $query);
} else {
    $permission_array = json_decode($vpn_session['rules']['Role Management'], true);
    $qry = "SELECT org1.user_id FROM org_users AS org1, org_users AS org2 WHERE org2.user_id='$value' AND org1.org_id = org2.org_id";
    $query = "SELECT * FROM $tbl where last_updated_by IN ($qry) AND status = 'Active'";
    $result = Sql_exec($cn, $query);
}


if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$data = array();
$i = 0;

while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $data[$i][$j++] = Sql_Result($row, "name");
    $org_id = Sql_Result($row, "org_id");

    $name_qry = "SELECT `NAME`
	FROM
	organization WHERE id=$org_id";

    $name_result = Sql_exec($cn, $name_qry);

    while ($row1 = Sql_fetch_array($name_result)) {
        $data[$i][$j++] = $row1['NAME'];
    }



    $action_data = '';
    if ($is_super_admin == false || $permission_array['edit'] == 'yes') {

        $action_data = '<span onclick="edit_firewall_role(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/pen.png" ></span>';
    } else if ($is_super_admin == true) {
        $action_data = '<span onclick="edit_firewall_role(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/pen.png" ></span>';
    }

    if ($is_super_admin == false || $permission_array['delete'] == 'yes') {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_role(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/cancel.png" ></span>';
    } else if ($is_super_admin == true) {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_role(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/cancel.png" ></span>';
    }
    if (empty($action_data))
        $action_data = '';

    $data[$i][$j++] = $action_data;

    /* $data[$i][$j++] = '<span onclick="edit_firewall_role(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="vpn/img/pen.png" ></span>'
      . '&nbsp&nbsp' . '<span onclick="delete_firewall_role(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="vpn/img/cancel.png" ></span>'; */

    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);
