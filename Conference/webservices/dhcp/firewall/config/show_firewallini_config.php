<?php
////session_start();
header('Access-Control-Allow-Origin: *');
require_once "../../lib/common.php";
global $dir_firewall_config;

$file_name = "/ocmp/app/bwp/"."bwp".".ini";

$myfile = fopen($file_name, "r") or die("Unable to open file!");
echo '<pre>';
echo fread($myfile,filesize($file_name));
echo '</pre>';
fclose($myfile);
?>



