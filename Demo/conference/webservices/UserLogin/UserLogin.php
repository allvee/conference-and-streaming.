<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shiam
 * Date: 1/12/2016
 * Time: 7:13 PM
 */
require_once "../lib/common.php";

require_once "../lib/functions.php";



$log_file_name = "logs_User_login".date("Y-m-d H:i:s").".txt";
$print_log = 0;
if($print_log==1) file_put_contents("$log_file_name", "***New_Call****\n", FILE_APPEND);

function logcats($parameter) {
    global $log_file_name,$print_log;
    if($print_log==1) file_put_contents($log_file_name, strval($parameter) . "\n", FILE_APPEND);
}


$cn = connectDB();
$arrayInput = $_REQUEST;

if (!isset($arrayInput['uid']) || !isset($arrayInput['pass'])) {
    $returnValue['msg'] = 'User name and password are required';
} else {
    $username = $arrayInput['uid'];
    $password = $arrayInput['pass'];
    $post_data = $_REQUEST;
    /*exit(Marketplace_Login_USER);*/
    $result = curlRequest('POST', Marketplace_Login_USER, $post_data);
    /*logcats(Marketplace_Login_USER);
    logcats(__FILE__.__LINE__.":".print_r($result,1));*/
    $result_array = json_decode($result, true);


    if($result_array['status'] == false) {
        /*Failed LOGIN */
        echo $result;
        exit;
    }
    $data['read'] = array();
    $data['read']['UserID'] = $result_array['read']['UserID'];
    $data['read']['UserName'] = $result_array['read']['UserName'];
    $data['read']['UserType'] = $result_array['read']['UserType'];
    $data['read']['layoutId']=7;
    $data['read']['fund'] = 0;
    $return_data = array( 'status' => true, 'msg' => "You have been logged in successfully.",'read'=>$data['read']);

    $_SESSION['conference']['username'] = $result_array['read']['UserName'];
    $_SESSION['UserType'] = $result_array['read']['UserType'];
    $_SESSION['UserID'] = $result_array['read']['UserID'];
    $_SESSION['UserName'] = $result_array['read']['UserName'];
    $_SESSION['conference'] = $result_array['read']['data'];
    $_SESSION['conference']['user_type'] = $result_array['read']['UserType'];
    $_SESSION['role']='admin';

    $user_id = $result_array['read']['data']['id'];

    $query_roles = "SELECT roles.`name`, role_menus.`permissions`, menus.name
                        FROM roles, user_role_association, role_menus, menus
                        WHERE user_role_association.user_id = $user_id
                        AND user_role_association.role_id = roles.id
                        AND user_role_association.role_id = role_menus.rule_id
                        AND role_menus.menu_id = menus.id";

    $result_roles = Sql_exec($cn, $query_roles);
    //$row_rules = Sql_fetch_assoc($result_roles);
    while($row_rules = Sql_fetch_assoc($result_roles)) {
        $_SESSION['conference']['rules'][$row_rules['name']] = $row_rules['permissions'];
    }

    Sql_Free_Result($result_roles);
    ClosedDBConnection($cn);

    $cn = connectDB();
    $org_query = "SELECT GROUP_CONCAT(org_id) orgs FROM org_users WHERE user_id='$user_id' GROUP BY user_id";

    $result_orgs = Sql_exec($cn, $org_query);

    $orgs = Sql_fetch_array($result_orgs);
    $_SESSION['conference']['org_ids'] = $orgs['orgs'];

    Sql_Free_Result($result_roles);
    // ClosedDBConnection($cn);

    /*$query = "SELECT * FROM `tbl_user` WHERE UserID='$username' AND `Password`=md5('$password')";
    $result = Sql_exec($cn, $query);

    $row = Sql_fetch_array($result);

    $return_data = array();
    if (!empty($row)) {
        $data['read'] = array();
        $data['read']['UserID'] = $row['UserID'];
        $data['read']['UserName'] =$row['UserName'];
        $data['read']['UserType'] = $row['UserType'];
        $data['read']['layoutId']=7;
        $data['read']['fund'] = 0;

        $return_data = array( 'status' => true, 'msg' => "You have been logged in successfully.",'read'=>$data['read']);

        $_SESSION['UserType'] =$row['UserType'];
        $_SESSION['UserID'] = $row['UserID'];
	$_SESSION['UserName'] = $row['UserName'];
        $_SESSION['role']='admin';
    } else {
        $return_data = array('status' => false, 'message' => "Username and password does not match.");

    }*/
}

/*Sql_Free_Result($result);
ClosedDBConnection($cn);*/
echo json_encode($return_data);
ClosedDBConnection($cn);
