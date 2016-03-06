<?php
/**
 * Created by PhpStorm.
 * User: L440-User
 * Date: 12/30/2015
 * Time: 4:01 PM
 */

session_start();

if(isset($_SESSION['SSO']) && !empty($_SESSION['SSO'])){
    echo json_encode(array("status"=>true));
}else{
    echo json_encode(array("status"=>false));
}