<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/5/2016
 * Time: 3:01 PM
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



if ($action== 'save') {

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


else {

    $qry = "insert into $tbl (udp_bind_ip, udp_signaling_port,udp_signaling_protocol,
				udp_media_port,udp_media_protocol,tcp_bind_ip, tcp_signaling_port, tcp_signaling_protocol,
				tcp_media_port, tcp_media_protocol,log_level, log_destination, rcportal_control_udp_port,
				log_tcp_port,last_updated,last_updated_by,is_active) values ('$udp_bind_ip','$udp_signaling_port','$udp_signaling_protocol',
				'$udp_media_port','$udp_media_protocol','$tcp_bind_ip','$tcp_signaling_port',
				'$tcp_signaling_protocol','$tcp_media_port','$tcp_media_protocol','$log_level',
				'$log_destination','$rcportal_control_udp_port','$log_tcp_port','$last_updated','$last_updated_by','active')";
}

try {
    $res = Sql_exec($cn, $qry);
    $is_error = 1;
    /*

if($action!="delete"){
    if($action == "update"){
                        $options['cn'] = $cn;
            $options['page_name'] = "Softswitch IPPBX Configuration";
            $options['action_type'] = $action;
            $options['table'] = "tbl_ippbx_configuration";
            $options['id_value'] = $action_id;
            setHistory($options);
        }else{

            $action_id = Sql_insert_id($cn);
            $action = 'add';
            $options['cn'] = $cn;
            $options['page_name'] = "Softswitch IPPBX Configuration";
            $options['action_type'] = $action;
            $options['table'] = "tbl_ippbx_configuration";
            $options['id_value'] = $action_id;
            setHistory($options);
            }
}
*/
} catch (Exception $e) {


}



ClosedDBConnection($cn);




if ($is_error == 0) {
    $return_data = array('action'=>$action,'status' => true, 'message' => 'Successfully get at php.','user_name' =>$user_name,  'user_id'=>$user_id,'group_name'=> $group_name, 'user_type'=> $user_type, 'user_role_management' => $user_role_management);

} else {
    $return_data = array('action'=>$action,'status' => false, 'message' => 'Data Not Sennd.');
}


echo json_encode($return_data);


?>