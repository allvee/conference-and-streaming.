<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 29-Nov-15
 * Time: 3:52 PM
 */

include_once "../../lib/common.php";

$firewall_session = $_SESSION['conference'];
$is_super_admin = false;

if($firewall_session['user_type'] == 'Super User')
    $is_super_admin = true;

$data = array();
if($is_super_admin == true)
    $data['super_user'] = 'yes';
else
    $data['super_user'] = 'no';

$data['UserType'] = $firewall_session['user_type'];
echo json_encode($data);