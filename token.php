<?php
include_once "conference/webservices/lib/common.php";
include_once "conference/webservices/lib/functions.php";
ignore_user_abort(1);
@set_time_limit(0);

$data=sprintf ("%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%c%",
    71,73,70,56,57,97,1,0,1,0,128,255,0,192,192,192,0,0,0,33,249,4,1,0,0,0,0,44,0,0,0,0,1,0,1,0,0,2,2,68,1,0,59);

header('Content-type:  image/gif');
header('Cache-Control: no-cache, must-revalidate');
header('Content-Length: '.strlen($data));
header('Connection: Close');
print $data;

$token = $_GET['token'];

$data = decrypt_json($token);

$data_array = json_decode($data,true);

$user_id = $data_array['read']['data']['id'];


$_SESSION['conference'] = $data_array['read']['data'];


$query_roles = "SELECT roles.`name`, role_menus.`permissions`, menus.name
                        FROM roles, user_role_association, role_menus, menus
                        WHERE user_role_association.user_id = $user_id
                        AND user_role_association.role_id = roles.id
                        AND user_role_association.role_id = role_menus.rule_id
                        AND role_menus.menu_id = menus.id";

$cn = connectDB();

$result_roles = Sql_exec($cn, $query_roles);
//$row_rules = Sql_fetch_assoc($result_roles);
while($row_rules = Sql_fetch_assoc($result_roles)) {
    $_SESSION['conference']['rules'][$row_rules['name']] = $row_rules['permissions'];
}

ClosedDBConnection($cn);