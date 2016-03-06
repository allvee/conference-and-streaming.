<?php
/**
 * Created by PhpStorm.
 * User: L440-User
 * Date: 12/29/2015
 * Time: 1:00 PM
 */

session_start();

$data = array();
if( isset( $_SESSION['SSO'] ) && !empty( $_SESSION['SSO'] ) ){

       $data['user_id'] = $_SESSION['SSO']['user_id'];
       $data['username'] = $_SESSION['SSO']['username'];
       $data['name'] = $_SESSION['SSO']['name'];
       $data['password'] = $_SESSION['SSO']['password'];       
	$data['role_id'] = $_SESSION['SSO']['role_id'];

       $result = array( "status"=>true, "user_data"=>$data);
       echo json_encode($result);
}else{
       $result = array("status"=>false, "user_data"=>"SSO Session is not Set.");
       echo json_encode($result);
}