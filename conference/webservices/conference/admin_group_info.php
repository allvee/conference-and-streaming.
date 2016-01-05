<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/5/2016
 * Time: 5:23 PM
 */

$data = $_REQUEST;

require_once "../lib/config.php";
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



if ($action != 'delete') {

    $group_name = $data['group_name'];
    $group_address = $data['group_address'];
    $group_contact = $data['group_contact'];
    $admin_user_id = $data['admin_user_id'];
    $group_pass = $data['group_pass'];
    $retype_group_pass = $data['retype_group_pass'];

    $email_id = $data['email_id'];


}


else if ($action == 'save') {

    $qry = "insert into $tbl (User_ID, Name, Group_Name,Type, Password, Conference_Create, Conference_Edit, Conference_Delete,
				User_rolr_Management) values ('$user_id','$user_name','$group_name',' $user_type',' $user_pass','$conferene_create','$conferene_edit',
				' $conferene_edit','$conferene_delete','$user_role_management')";
}

//try {
//    $res = Sql_exec($cn, $qry);
//
//} catch (Exception $e) {
//
//
//}

ClosedDBConnection($cn);




if ($is_error == 0) {
    $return_data = array('action'=>$action,'status' => true, 'message' => 'Successfully get at php.','group_address' =>$group_address,  'group_contact'=>$group_contact,'group_name'=> $group_name);

} else {
    $return_data = array('action'=>$action,'status' => false, 'message' => 'Data Not Sennd.');
}


echo json_encode($return_data);


?>