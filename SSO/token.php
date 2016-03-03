<?php
session_start();

include_once "common.php";
include_once "functions.php";
include_once "../conference/webservices/lib/config.php";


ignore_user_abort(1);
@set_time_limit(0);



$data=sprintf ("%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%",
    71,73,70,56,57,97,1,0,1,0,128,255,0,192,192,192,0,0,0,33,249,4,1,0,0,0,0,44,0,0,0,0,1,0,1,0,0,2,2,68,1,0,59);


header('Content-type:  image/gif');
header('Cache-Control: no-cache, must-revalidate');
header('Content-Length: '.strlen($data));
header('Connection: Close');

//print $data;

$token = $_GET['token'];


$data = decrypt_json($token);

$data_str = json_decode($data,true); 


$user_info =array();
$user_info = explode("|", $data_str);

$user_id = $user_info[0];
$username = $user_info[1];
$name = $user_info[2];
$password = $user_info[3];
$role_id = $user_info[4];

$info= array();
$info['user_id'] = $user_id;
$info['username'] = $username;
$info['name'] = $name;
$info['password'] = $password;
$info['role_id'] = $role_id;
$_SESSION['CSSSO'] = $info;

$cn = connectDB();
$org_query = "SELECT * FROM org_users WHERE user_id = '$user_id' limit 1";
$result_org = Sql_exec($cn, $org_query);
$row_data = Sql_fetch_assoc($result_org);

$org_id = $row_data['org_id'];

$_SESSION['conference'] = $info;
$_SESSION['conference']['org_ids'] = $org_id;

$query_roles = "SELECT roles.`name`, role_menus.`permissions`, menus.name
                        FROM roles, user_role_association, role_menus, menus
                        WHERE user_role_association.user_id = '$user_id'
                        AND user_role_association.role_id = roles.id
                        AND user_role_association.role_id = role_menus.rule_id
                        AND role_menus.menu_id = menus.id";



$result_roles = Sql_exec($cn, $query_roles);
//$row_rules = Sql_fetch_assoc($result_roles);
while($row_rules = Sql_fetch_assoc($result_roles)) {
    $_SESSION['conference']['rules'][$row_rules['name']] = $row_rules['permissions'];
}


ClosedDBConnection($cn);