<?php
require_once "../lib/common.php";
require_once "../lib/functions.php";
$is_available = 0;
$cn = connectDB();
$query = "SELECT `version_no` FROM `version` ORDER BY last_updated DESC LIMIT 1";
$rs = Sql_fetch_assoc(Sql_exec($cn, $query));
$curr_version = str_replace(".","",$rs['version_no']);
$result = curlRequest('GET', VERSION_CHECK_URL, array('app' => 'vpn'));
$result_array = json_decode($result, true);

$available_version = str_replace(".","",$result_array['version']);
if($available_version > $curr_version) {
    $is_available = 1;
} else {
    $is_available = 0;
}
ClosedDBConnection($cn);
echo $is_available . "|" . $result_array['version'] . "|" . $curr_version . "|" . $available_version;
?>