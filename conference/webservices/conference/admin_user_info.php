<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/5/2016
 * Time: 3:01 PM
 */

$data = $_REQUEST;

//require_once "../lib/config.php";
require_once "../lib/common.php";

$cn = connectDB();


$arrayInput = $_REQUEST;
$is_error = 0;



$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));
$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';
if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
}

$tbl = "tbl_user_management";
$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];

$current_date =date("Y/m/d ");

if ($action != 'delete') {

    $user_name = $data['user_name'];
    $user_id = $data['user_id'];
    $group_name = $data['group_name'];
    $user_type = $data['user_type'];
    $user_pass = $data['user_pass'];
    $retype_user_pass = $data['retype_user_pass'];
    $conferene_create = $data['conferene_create'];
    $conferene_edit = $data['conferene_edit'];
    $conferene_delete = $data['conferene_delete'];
    $user_role_management = $data['user_role_management'];

}


if ($action == "update") {
    $msg = "Successfully Updated";
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    $qry = "update $tbl set `Name`='$user_name',`Group_Name`='$group_name', `Create_Date`='$create_date', `Status`='$status', `Type`='$user_type'";
    $qry .= " where ID='$action_id'";


}

else if ($action == "delete") {

    $action_id = $deleted_id;
    $qry = "DELETE from $tbl";
    $qry .= " where ID='$action_id'";

    $msg = "Successfully Deleted";

}

else {

    $qry = "insert into $tbl (User_ID, Name, Group_Name,Type, Password, Conference_Create, Conference_Edit, Conference_Delete,
				User_role_Management, Create_Date, Status) values ('$user_id','$user_name','$group_name',' $user_type',' $user_pass','$conferene_create','$conferene_edit',
				'$conferene_delete','$user_role_management','$current_date', 'active')";
}


try {
   $res = Sql_exec($cn, $qry);
    $is_error = 0;
} catch (Exception $e) {
    $is_error = 1;
}

ClosedDBConnection($cn);


if ($is_error == 1) {
    $return_data = array('status' => false, 'message' => 'Submission Failed');
} else {
    $return_data = array('status' => true, 'message' => $msg);
}


echo json_encode($return_data);


?>