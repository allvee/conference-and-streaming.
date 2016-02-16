<?php
	require_once "../lib/common.php";
	require_once "../lib/functions.php";
	require_once "../lib/asmp_lib.php";

	$cn = connectDB();
	$sms_data = array();
	$sms_data['username'] = "sakil@ssd-tech.com";
	$sms_data['password'] = "Nopass1234";
	$sms_data['mask '] = "conferenceInvitation";
	$sms_data['destination'] = "8801911200762".;
	$sms_data['body'] = "You have got a conference invitation. Room No: ".$_SESSION['conference']['room_caller']." Start Time: " . $_SESSION['conference']['start_date'] . " End Time: " . $_SESSION['conference']['end_date'];
	$SMS_URL = "http://sms.doze.my/send.php";
	$SMS_ret = curlRequest('GET', $SMS_URL, $sms_data);
	echo "SMS: ".$SMS_ret."</br>";
	
	$mail = new PHPMailer(true);
	$config_details = array("email"=>"support","password"=>"Nopass1234","smtp_account"=>"monitor.dozeinternet.com","smtp_port"=>"25");
	$mail_receiver = array("shiam.ssd-tech.com","alamin@ssd-tech.com");
	//array_push($mail_receiver,$participant_email);
	$email_ret = sendEmail($cn,$mail,"Test Mail","This is a conference mail",$mail_receiver,$config_details);
	echo "Email: ".$email_ret."</br>";
	
	
	