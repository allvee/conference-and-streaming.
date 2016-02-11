<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/25/2015
 * Time: 5:54 PM

 */
require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/functions.php";

$cn = connectDB();

$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));


$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';

if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['action_id'];
   // echo "yap".' '.$action.' '.$deleted_id ;
}

$action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

$is_error = 0;$check=0;
if($action=='insert') {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'ADD_USER_ROLE';
    $user_data['message'] = ADD_USER_ROLE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    if (isset($_REQUEST['user_role_association_full_name'])) {
        $full_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_role_association_full_name']));
    }


    if (isset($_REQUEST['user_role_association_role_name'])) {
        $i = 0;

        foreach ($_REQUEST['user_role_association_role_name'] as $role) {
            $role_name[$i++] = $role;
        }

    }
    $i = 0;
$role_length=sizeof($role_name);
    foreach ($role_name as $distinct_role_name) {
        $qry_check="SELECT user_id,role_id FROM user_role_association WHERE user_id='$full_name' AND role_id='$distinct_role_name' AND STATUS='active'";
        $res_check=Sql_exec($cn, $qry_check);

        while($dt=Sql_fetch_array($res_check)){
            $name=$dt['user_id'];
            $role=$dt['role_id'];
        }



        if($name=='' || $role=='') {
            $qry[$i] = "INSERT INTO user_role_association (user_id,role_id,STATUS) VALUES ('$full_name','$distinct_role_name','active');";
            $i++;
        }else {
            $qry_show_msg="SELECT `login_id` FROM `users` WHERE id='$full_name'AND `status`='active'";
            $res_show_msg=Sql_exec($cn, $qry_show_msg);
            while($dt=Sql_fetch_array($res_show_msg)){
                $full_name=$dt['login_id'];
            }



            $qry_show_msg="SELECT `name` FROM `roles` WHERE id='$distinct_role_name'AND `status`='active'";
            $res_show_msg=Sql_exec($cn, $qry_show_msg);
            while($dt=Sql_fetch_array($res_show_msg)){
                $distinct_role_name=$dt['name'];
            }


            $msg.="Duplicate Data !!! For ".$full_name." And ".$distinct_role_name."<br>";
            $check++;
            $is_error = 1;
        }
    }

    $i = 0;

    if($check==0) {
        try {
            foreach ($qry as $q) {
                $res[$i] = Sql_exec($cn, $q);
                $i++;
                $msg .= "Successfully Insert";
                $is_error = 0;
            }
        } catch (Exception $e) {
            $is_error = 1;
    }
    }
}else if($action=='update'){
    $msg="Successfully Updated";

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'UPDATE_USER_ROLE';
    $user_data['message'] = UPDATE_USER_ROLE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $full_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_role_association_full_name']));

    foreach ($_REQUEST['user_role_association_role_name'] as $role) {
        $role_name = $role;
    }

    $qry_check="SELECT user_id,role_id FROM user_role_association WHERE user_id='$full_name' AND role_id='$role_name' AND STATUS='active'";
    $res_check=Sql_exec($cn, $qry_check);
    while($dt=Sql_fetch_array($res_check)){
        $name=$dt['user_id'];
        $role=$dt['role_id'];
    }
    if($name=='' || $role=='') {
        $qry = " UPDATE `user_role_association` SET `user_id` = '$full_name' ,`role_id` = '$role_name',
    STATUS = 'active' WHERE `id` = '$action_id'";
    }else {

        $qry_show_msg="SELECT `login_id` FROM `users` WHERE id='$full_name'AND `status`='active'";
        $res_show_msg=Sql_exec($cn, $qry_show_msg);
        while($dt=Sql_fetch_array($res_show_msg)){
            $full_name=$dt['login_id'];
        }



        $qry_show_msg="SELECT `name` FROM `roles` WHERE id='$distinct_role_name'AND `status`='active'";
        $res_show_msg=Sql_exec($cn, $qry_show_msg);
        while($dt=Sql_fetch_array($res_show_msg)){
            $distinct_role_name=$dt['name'];
        }



        $msg="";
        $msg.="Duplicate Data !!! For ".$full_name." And ".$distinct_role_name."<br>";
        $check++;
        $is_error = 1;
    }
if( $check==0) {
    try {
        Sql_exec($cn, $qry);
    } catch (Exception $e) {
        $is_error = 1;
    }
}

}else {

    $msg="Successfully Deleted";
    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'DELETE_USER_ROLE';
    $user_data['message'] = DELETE_USER_ROLE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);

    $action_id=$deleted_id;
    echo $msg.'  '.$action_id;
    $qry=" UPDATE `user_role_association` SET
    STATUS = 'inactive'  WHERE `id` = '$action_id'";

    try{
        Sql_exec($cn, $qry);
    }catch (Exception $e){
        $is_error = 1;
    }
}


if($is_error==0){

    $return_data=array('status'=>true, 'message'=>$msg);
}else{
    $return_data=array('status'=>false, 'message'=>$msg);
}
ClosedDBConnection($cn);

echo json_encode($return_data);
