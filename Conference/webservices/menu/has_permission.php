<?php
include_once "../lib/common.php";
$menu_name = $_REQUEST['menu_name'];
$vpn_session = $_SESSION['conference'];
$is_super_admin = false;
if($vpn_session['user_type'] == 'Super User')
    $is_super_admin = true;
$permission_array = json_decode($vpn_session['rules'][trim($menu_name)], true);
$data['add_permission'] = $permission_array['add'];
if($is_super_admin == true)
    $data['add_permission'] = 'yes';
echo json_encode($data);