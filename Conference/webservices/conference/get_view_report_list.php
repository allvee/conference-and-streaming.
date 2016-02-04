<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shiam
 * Date: 2/2/2016
 * Time: 5:38 PM
 */
include_once "../lib/common.php";

$cn = connectDB();
$vpn_session = $_SESSION['conference'];
$value = $vpn_session['id'];
$options = '';
$is_super_admin = false;

if ($vpn_session['user_type'] == 'Super User') {
    $is_super_admin = true;
    //$permission_array = json_decode($vpn_session['rules']['Role Management'], true);
    $query = "SELECT id, Conf_name FROM tbl_conference";
    $res = Sql_exec($cn, $query);
} else {
    //$permission_array = json_decode($vpn_session['rules']['Role Management'], true);
    $query = "SELECT id,Conf_name FROM tbl_conference where USER = '$value'";
    $res = Sql_exec($cn, $query);
}

$options = '<option value="">--Select--</option>';
while ($dt = Sql_fetch_assoc($res)) {

    $options .= '<option value="' . $dt['id'] . '">' . $dt['Conf_name'] . '</option>';
}
ClosedDBConnection($cn);
echo $options;