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

$tbl = "tbl_group_management";

$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["UserID"];



if ($action == 'save') {

    $group_name = $data['group_name'];
    $group_address = $data['group_address'];
    $group_contact = $data['group_contact'];
    $admin_user_id = $data['admin_user_id'];
    $group_pass = $data['group_pass'];
    $retype_group_pass = $data['retype_group_pass'];
    $email_id = $data['email_id'];
    /*
        if($group_pass!=$retype_group_pass)
        alert("Password not matched ! Enter again");*/

        $qry = "INSERT INTO $tbl(Group_Name, Address, Contact, Admin_User_ID, Password, Email_Address)
        VALUES('$group_name', '$group_address', '$group_contact', '$admin_user_id', '$group_pass', '$email_id')";
}


try {
   $res = Sql_exec($cn, $qry);

} catch (Exception $e) {

}

ClosedDBConnection($cn);




if ($is_error == 0) {
    $return_data = array('action'=>$action,'status' => true, 'message' => 'Successfully get at php.','group_address' =>$group_address,  'group_contact'=>$group_contact,'group_name'=> $group_name);

} else {
    $return_data = array('action'=>$action,'status' => false, 'message' => 'Data Not Sennd.');
}


echo json_encode($return_data);


?>