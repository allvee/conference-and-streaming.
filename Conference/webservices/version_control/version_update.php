<?php
require_once "../lib/common.php";
require_once "../lib/functions.php";
$cn = connectDB();
$result = curlRequest('GET', VERSION_CHECK_URL, array('app' => 'vpn'));
$result_array = json_decode($result, true);
$path = $result_array['path'];
$file_array = parse_url($path);
$temp_path = $file_array['path'];
$file_name_array = explode('/', $temp_path);
$file_name = array_pop($file_name_array);
$folder_name = str_replace(".tar.gz", "", $file_name);
$command = "./update_shell.sh $path $file_name ".CP_DIR_FOR_UPDATE." ".DB_FILE_NAME." ".DB_NAME;
shell_exec($command);
$version = $result_array['version'];
$last_updated = date("Y-m-d H:i:s");
$insert_query = "INSERT INTO `version` (`version_no`, `last_updated`) VALUES ('$version', '$last_updated');";
$status = Sql_exec($cn, $insert_query);

if($status) {
    $status = array(
        'status' => 'true'
    );
} else {
    $status = array(
        'status' => 'false'
    );
}

echo json_encode($status);
?>