<?php

header('Access-Control-Allow-Origin: *');
require_once "../../../lib/common.php";
$cn = connectDB();
$options = '';
$select_group = "SELECT DISTINCT name FROM groups WHERE type='ip' AND status='active' ORDER BY name asc";
$rs_group = Sql_exec($cn, $select_group);
while ($dt = Sql_fetch_array($rs_group)) {
    $group_name = $dt['name'];
    $group_name = str_replace("__","",$group_name);
    $options .= '<option value="' . $group_name . '">' . $group_name . '</option>';
}
ClosedDBConnection($cn);
echo $options;
