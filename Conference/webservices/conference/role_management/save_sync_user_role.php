<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 31-Dec-15
 * Time: 6:33 PM
 */



require_once "../../lib/common.php";
require_once "../../lib/functions.php";
$cn = connectDB();
$post_data = $_REQUEST;

$truncate_qry_for_organization = "TRUNCATE `roles`;";
Sql_exec($cn, $truncate_qry_for_organization);

foreach ($post_data['roles'] as $index => $tbl_row) {
    $exclude = array();
    $InsertQuery = generateInsertQuery($tbl_row, 'roles', $cn, $exclude);
    try {
        Sql_exec($cn, $InsertQuery);
        $is_error_role = 0;
    } catch (Exception $e) {
        $is_error_role = 1;
    }
}

$truncate_qry_for_org_users = "TRUNCATE `user_role_association`;";
Sql_exec($cn, $truncate_qry_for_org_users);

foreach ($post_data['user_role_association'] as $index => $tbl_row) {
    $exclude = array();
    $InsertQuery = generateInsertQuery($tbl_row, 'user_role_association', $cn, $exclude);
    try {
        Sql_exec($cn, $InsertQuery);
        $is_error_role_association = 0;
    } catch (Exception $e) {
        $is_error_role_association = 1;
    }
}

if($is_error_role == 0 && $is_error_role_association == 0) {
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