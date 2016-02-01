<?php
include_once "common.php";
require_once "functions.php";
$cn = connectDB();
define('CONSTANT', $_REQUEST['menu_name']);
const var_name = CONSTANT;
$message = constant(var_name);

$data['user'] = $_SESSION['conference']['login_id'];
$data['component'] = $_REQUEST['component'];
$data['message'] = $message;

write_activity_log_data($cn, $data);
ClosedDBConnection($cn);