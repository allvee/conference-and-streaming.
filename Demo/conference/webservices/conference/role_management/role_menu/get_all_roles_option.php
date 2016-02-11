<?php
header('Access-Control-Allow-Origin: *');
require_once "../../../lib/common.php";

$cn = connectDB();
$vpn_session = $_SESSION['conference'];
$value = $vpn_session['id'];
$options = '';
$is_super_admin = false;

if ($vpn_session['user_type'] == 'Super User') {
    $is_super_admin = true;
    //$permission_array = json_decode($vpn_session['rules']['Role Management'], true);
    $query = "SELECT `id`, `name` FROM roles WHERE `status`='active'";
    $res = Sql_exec($cn, $query);
} else {
    //$permission_array = json_decode($vpn_session['rules']['Role Management'], true);
    $qry = "SELECT org1.user_id FROM org_users AS org1, org_users AS org2 WHERE org2.user_id='$value' AND org1.org_id = org2.org_id";
    $query = "SELECT `id`, `name` FROM roles where last_updated_by IN ($qry) AND `status` = 'active'";
    $res = Sql_exec($cn, $query);
}

$options = '<option value="">--Select--</option>';
while ($dt = Sql_fetch_assoc($res)) {

    $options .= '<option value="' . $dt['id'] . '">' . $dt['name'] . '</option>';
}
ClosedDBConnection($cn);
echo $options;