<?php
/**
 * Created by PhpStorm.
 * User: L440-User
 * Date: 12/29/2015
 * Time: 1:00 PM
 */

session_start();
//{"UserID":"admin","UserName":"admin","UserType":"Super User","layoutId":7,"fund":0}
//[login_id] => admin
//[password] => 21232f297a57a5a743894a0e4a801fc3
$data = array();
if( isset( $_SESSION['conference'] ) && !empty( $_SESSION['conference'] ) ){

       $data['UserID'] = $_SESSION['conference']['login_id'];
       $data['UserName'] = $_SESSION['conference']['Name'];
       $data['UserType'] = $_SESSION['conference']['user_type'];
       $data['layoutId'] = 7;
       $data['fund'] = 0;
       $result = array( "status"=>true, "UserData"=>$data);
       echo json_encode($result);
} else {
       $result = array("status"=>false, "UserData"=>"conference Session is not Set.");
       echo json_encode($result);
}