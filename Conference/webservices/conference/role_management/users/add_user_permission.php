<?php
include_once "../../../lib/common.php";

$firewall_session = $_SESSION['firewall'];
$is_super_admin = false;
if($firewall_session['user_type'] == 'Super User')
    $is_super_admin = true;
$permission_array = json_decode($firewall_session['rules']['Role Management'], true);
$data['add_permission'] = $permission_array['add'];
if($is_super_admin == true)
    $data['add_permission'] = 'yes';
echo json_encode($data);