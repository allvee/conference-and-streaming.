<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 25-Nov-15
 * Time: 2:00 PM
 */

include_once "../../lib/common.php";
$cn = connectDB();
$options = '';
$select_org = "SELECT * FROM `organization` WHERE status='active'";
$rs_org = Sql_exec($cn, $select_org);
while ($dt = Sql_fetch_array($rs_org)) {
    $org_id = $dt['id'];
    $org_name = $dt['name'];
    $options .= '<option value="' . $org_id . '">' . $org_name . '</option>';
}

ClosedDBConnection($cn);
echo $options;
