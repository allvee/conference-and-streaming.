<?php
include_once "../../lib/common.php";
require_once "../../lib/functions.php";
//$cn = connectDB();
//$result = curlRequest('GET', Marketplace_USER_OPTIONS, array());
$result = curlRequest('GET', Marketplace_USER_LIST, array());
$option = '';
$decoded_result = json_decode($result);
foreach ($decoded_result as $user_id => $user_name ) {
    $options .= '<option value="' . $user_id . '">' . $user_name . '</option>';
}

echo $options;