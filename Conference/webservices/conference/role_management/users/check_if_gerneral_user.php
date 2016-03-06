<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 29-Nov-15
 * Time: 3:52 PM
 */

include_once "../../../lib/common.php";

$firewall_session = $_SESSION['conference'];
$is_super_admin = false;

if($firewall_session['user_type'] == 'General User')
    $is_super_admin = true;

if($is_super_admin == true)
    $data['gereral_user'] = 'yes';
else
    $data['general_user'] = 'no';

echo json_encode($data);