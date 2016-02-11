<?php

include_once "../lib/common.php";
include_once "../lib/functions.php";
$connection = connectDB();

$backupFileName = $_POST['info']['backupName'];
$module = $_POST['info']['module'];
$backupTableNames = $_POST['info']['tableNames'];
$tableNameArray = explode(',', $backupTableNames);

$data = array();
$data[$module] = array();

foreach($tableNameArray as $tableName) {
    $query = "SELECT * FROM $tableName";
    $result_gre = Sql_exec($connection, $query);
    while($row = Sql_fetch_assoc($result_gre)) {
        $data[$module][$tableName][] = $row;
    }
}

ClosedDBConnection($connection);

/*$file_name = $backupFileName.'.json';
$file_location = $dir_vpn_backup_file.$file_name;
file_put_contents($file_location, trim(json_encode($data)));
echo 'rcportal/webservices/version_control/download_backup.php?name='.$file_name;
exit;*/


$data_encoded = encrypt_json(json_encode($data));

/*$returnedContent = curlRequest('GET', $apiVPNBaseURL . '?', $vars);
$data['VPN'] = json_decode($returnedContent, true);*/

$file_name = $backupFileName.'.bk';
$file_location = $dir_vpn_backup_file.$file_name;
file_put_contents($file_location, $data_encoded);
echo 'vpn/webservices/version_control/download_backup.php?name='.$file_name;




?>
