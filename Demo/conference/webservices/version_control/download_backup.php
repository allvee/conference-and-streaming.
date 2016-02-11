<?php
$file = $_GET['name'];
include_once "../lib/common.php";
$file_location = $dir_vpn_backup_file.$file;
$data = file_get_contents($file_location);
header('Content-disposition: attachment; filename='.$file.'');
header('Content-type: application/bk');
echo $data;
?>