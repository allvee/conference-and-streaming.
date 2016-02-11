<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shiam
 * Date: 2/8/2016
 * Time: 2:14 PM
 */
require_once "../lib/asmp_lib.php";
require_once "../lib/common.php";

$cn = connectDB();
//print_r(array("ABC","DEF"));
$mail = new PHPMailer(true);
$config_details = array("email"=>"support","password"=>"Nopass1234","smtp_account"=>"monitor.dozeinternet.com","smtp_port"=>"25");
/*
echo $config_details["email"]."-";
echo $config_details["password"]."-";
echo $config_details["smtp_account"]."-";
echo $config_details["smtp_port"]."-";
*/

sendEmail($cn,$mail,"Test Mail","This is a conference mail",array("shiam@ssd-tech.com","alamin@ssd-tech.com"),$config_details);
