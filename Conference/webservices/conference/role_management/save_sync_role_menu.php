<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 03-Jan-16
 * Time: 7:43 PM
 */


require_once "../../lib/common.php";
require_once "../../lib/functions.php";
$cn = connectDB();
$post_data = $_REQUEST;

$truncate_qry_for_role_menus = "TRUNCATE `role_menus`;";
Sql_exec($cn, $truncate_qry_for_role_menus);

foreach ($post_data['role_menus'] as $index => $tbl_row) {
    $exclude = array();
    $InsertQuery = generateInsertQuery($tbl_row, 'role_menus', $cn, $exclude);
    try {
        Sql_exec($cn, $InsertQuery);
        $is_error = 0;
    } catch (Exception $e) {
        $is_error = 1;
    }
}


if ($is_error == 0) {
    $return_data = array('status' => true, 'message' => 'Successful.');
} else {
    $return_data = array('status' => false, 'message' => ' Unsuccessful');
}

echo json_encode($return_data);