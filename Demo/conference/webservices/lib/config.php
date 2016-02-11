<?php

session_start();

include_once("utils.php");
include_once("audit.php");
include_once("global_config.php");
error_reporting(0);
$dbtype = 'mysql';
$UserID = 'root';
$Password = 'nopass';
$Server = '45.125.222.163';
$SMS_server = '103.239.252.163';
$Database = 'conference_demo';
$Call_Handler_DB = 'vsdp_2_1_1';

$salt = 'DjhG83b0QyJfIxfs2gsVoUubWwVniR2G0FgaC9ny';
$temp_dbtype = '';
$temp_UserID = '';
$temp_Password = '';
$temp_Server = '';
$temp_Database = '';

/*
$log_file_name = "Enterprise_conference.txt";
$print_log = 1;
if($print_log==1) file_put_contents("$log_file_name", "***New_Call****\n", FILE_APPEND);
function logcats($parameter) {
    global $log_file_name,$print_log;
    if($print_log==1) file_put_contents($log_file_name, strval($parameter)."\n", FILE_APPEND);
}*/