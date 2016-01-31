<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 31-Dec-15
 * Time: 3:45 PM
 */

require_once "../../lib/common.php";
require_once "../../lib/functions.php";
$cn = connectDB();
$post_data = $_REQUEST;

$last_updated=date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["vpn"]['id'];

$truncate_qry_for_organization = "TRUNCATE `organization`;";
Sql_exec($cn, $truncate_qry_for_organization);

foreach ($post_data['organization'] as $index => $tbl_row) {
    $exclude = array();
    $InsertQuery = generateInsertQuery($tbl_row, 'organization', $cn, $exclude);
    try {
        Sql_exec($cn, $InsertQuery);
        $is_error_organization = 0;
    } catch (Exception $e) {
        $is_error_organization = 1;
    }
}

$truncate_qry_for_org_users = "TRUNCATE `org_users`;";
Sql_exec($cn, $truncate_qry_for_org_users);

foreach ($post_data['org_users'] as $index => $tbl_row) {
    $exclude = array();
    $InsertQuery = generateInsertQuery($tbl_row, 'org_users', $cn, $exclude);
    try {
        Sql_exec($cn, $InsertQuery);
        $is_error_org_users = 0;
    } catch (Exception $e) {
        $is_error_org_users = 1;
    }
}

if($is_error_organization == 0 && $is_error_org_users == 0) {
    $is_error=0;
} else {
    $is_error=1;
}



if ($is_error == 0) {
    $return_data = array('status' => true, 'message' => 'Successful.');
} else {
    $return_data = array('status' => false, 'message' => ' Unsuccessful');
}

echo json_encode($return_data);