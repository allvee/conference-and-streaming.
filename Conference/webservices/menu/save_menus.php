<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 17-Nov-15
 * Time: 2:14 PM
 */

require_once "../lib/common.php";
require_once "../lib/filewriter.php";

$cn = connectDB();

$tbl = 'menus';

$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));


$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';

if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['deleted_id'];
}

$action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

$menu_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['menu_name']));
$url = mysql_real_escape_string(htmlspecialchars($_REQUEST['url']));
$status = mysql_real_escape_string(htmlspecialchars($_REQUEST['status']));

$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
//$created_by = $_SESSION["UserID"];


if ($action == 'delete') {
    if ($deleted_id != '') {
        $action_id = $deleted_id;
    }

    $options['cn'] = $cn;
    $options['page_name'] = "Firewall Menus";
    $options['action_type'] = $action;
    $options['table'] = "menus";
    $options['id_value'] = $action_id;
    setHistory($options);


    $qry = "update  `menus` set `status`='inactive', last_updated='$last_updated'";
    $qry .= " where id='$action_id'";

} else if ($action == 'update') {
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    $options['cn'] = $cn;
    $options['page_name'] = "Firewall Menus";
    $options['action_type'] = $action;
    $options['table'] = "menus";
    $options['id_value'] = $action_id;
    setHistory($options);

    $qry = "update `menus` set `name` = '$menu_name',url = '$url',last_updated='$last_updated', `status`='active'";
    $qry .= " where id='$action_id'";
} else {
    $qry = "insert into `menus` (`name`,url,`status`,last_updated)";
    $qry .= " values ('$menu_name','$url','active','$last_updated')";
}

try {
    $res = Sql_exec($cn, $qry);
    if (($action != 'update') && ($action != 'delete')) {
        $action_id = Sql_insert_id($cn);
        $action = 'add';
        $options['page_name'] = "Firewall Menus";
        $options['action_type'] = $action;
        $options['table'] = "menus";
        $options['id_value'] = $action_id;
        setHistory($options);
    }
} catch (Exception $e) {
    $is_error = 1;
}

if ($is_error == 0) {
    $return_data = array('status' => true, 'message' => 'Successful.');
} else {
    $return_data = array('status' => false, 'message' => ' Unsuccessful');
}

echo json_encode($return_data);
ClosedDBConnection($cn);


