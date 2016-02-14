<?php
//session_start();
header('Access-Control-Allow-Origin: *');
require_once "../../lib/common.php";
$cn = connectDB();
$qry = "select * from `config` limit 1";
$rs = Sql_exec($cn,$qry);
$data = "";
$i=0;
while($row = Sql_fetch_array($rs)){
    $data .= $row["device_id"];
    $data .="|".  $row["device_ip"];
    $data .="|".  $row["nfqueue_num"];
    $data .="|".  $row["subnet_mask"];
    $data .="|".  $row["log_level"];
    $data .="|".  $row["firewall_enable"];
    $data .="|".  $row["firewall_directory"];
    $data .="|".  $row["firewall_rule_file"];
    $data .="|".  $row["app_id"];
    $data .="|".  $row["app_password"];
    }

ClosedDBConnection($cn);

echo $data;

?>