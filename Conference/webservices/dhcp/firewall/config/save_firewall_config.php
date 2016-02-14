<?php
header('Access-Control-Allow-Origin: *');
//session_start();
require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/functions.php";
//$dir = "../../etc/sysconfig/network-scripts/";

//$info = $_POST["info"];

$cn = connectDB();

$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["USER_ID"];

if (isset($_REQUEST['info'])) {
    $data = $_REQUEST['info'];
    $action = $data['action'];
    $action_id = $data['action_id'];
}else if (isset($_POST) && isset($_POST['action']) && isset($_POST['action_id'])){
    $action = mysql_real_escape_string(htmlspecialchars($_POST['action']));
    $action_id = mysql_real_escape_string(htmlspecialchars($_POST['action_id']));
    $device_id= mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_DeviceId']));
    $device_ip = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_DeviceIp']));
    $nfqueue_number = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_NfqueueNumber']));
    $subnet_mask = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_SubnetMask']));
    $log_level = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_LogLevel']));

    $firewall_enable = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_firewallEnable']));
    $firewall_directory = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_FirewallDirectory']));
    $firewall_rule_file = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_FirewallRuleFile']));
    //$app_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_FirewallRuleFile']));
    $app_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_AppId']));
    $app_password = mysql_real_escape_string(htmlspecialchars($_REQUEST['firewall_info_AppPassword']));

}


$select_qry = "SELECT * FROM config";
$res_select = Sql_exec($cn,$select_qry);


 $len = strlen ($firewall_directory) - 1;

if( strcmp($firewall_directory[$len],"/"))
     $firewall_directory = $firewall_directory . '/';


if(Sql_Num_Rows($res_select)>0){
    $raw_result = Sql_fetch_assoc($res_select);
    $options['cn'] = $cn;
    $action = 'update';
    $options['page_name'] = "Firewall Configuration";
    $options['action_type'] = $action;
    $options['table'] = "config";
    $options['id_value'] = $raw_result['id'];
    setHistory($options);

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'UPDATE_CONFIGURE';
    $user_data['message'] = UPDATE_CONFIURE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);


    $qry = "update config
		set device_id='$device_id', device_ip = '$device_ip', nfqueue_num = '$nfqueue_number', subnet_mask='$subnet_mask',log_level='0',firewall_enable = '1',firewall_directory='$firewall_directory',firewall_rule_file='$firewall_rule_file',app_id='$app_id',app_password='$app_password'";
}else {

    $user_data['user'] = $_SESSION['firewall']['login_id'];
    $user_data['component'] = 'ADD_CONFIGURE';
    $user_data['message'] = ADD_CONFIURE . json_encode($_REQUEST);
    write_activity_log_data($cn, $user_data);


    $qry = "insert into config (device_id,device_ip,nfqueue_num,subnet_mask,log_level,firewall_enable,firewall_directory,firewall_rule_file,app_id,app_password)";
    $qry .= " values ('$device_id','$device_ip','$nfqueue_number','$subnet_mask','0','1','$firewall_directory','$firewall_rule_file','$app_id','$app_password')";



}


try {
    $res = Sql_exec($cn, $qry);

    if($action == "insert") {
        $action_id = Sql_insert_id($cn);
        $action = 'add';
        $options['cn'] = $cn;
        $options['page_name'] = "Firewall Configuration";
        $options['action_type'] = $action;
        $options['table'] = "config";
        $options['id_value'] = $action_id;
        setHistory($options);
    }

    
} catch (Exception $e) {
    $is_error = 1;
}
if ($is_error == 0) {
    $is_error = file_writer_firewall_config($cn);
    $is_error =  file_writer_RunbwpSh($cn);
}

ClosedDBConnection($cn);

echo $is_error;

?>