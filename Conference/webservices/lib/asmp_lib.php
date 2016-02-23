<?php

include_once "class.phpmailer.php";

function SendEmails($mailer,$config_object,$receivers = array(),$subject,$body ){
    $MAIL_FROM = "support@monitor.dozeinternet.com";
    $MAIL_FROM_USER_NAME = "SSD-Tech Conference";
    $MAIL_SUBJECT = "Notification ssd-tech Conference Controller";

    $MAIL_USER = trim($config_object->email);
    $MAIL_PASS = trim($config_object->password);
    $MAIL_HOST = trim($config_object->smtp_account);
    $MAIL_Port = intval($config_object->smtp_port);
    // echo $config_arr->email.":".$config_arr->password.":".$config_arr->smtp_account.":".$config_arr->smtp_port."\n";
   // echo $MAIL_USER . ":" . $MAIL_PASS . ":" . $MAIL_HOST . ":" . $MAIL_Port . "\n";
    foreach ($receivers as $user_email) {
        $mailer->AddAddress($user_email);
        //echo "mail:" . $user_email . "\n";
    }
    $body = preg_replace('/\\\\/', '', $body); //Strip backslashes
    try {
        $mailer->IsSMTP();                      // tell the class to use SMTP
        //$mail->SMTPSecure = 'ssl';
        $mailer->SMTPDebug = 1;
        $mailer->SMTPAuth = true;               // enable SMTP authentication
        $mailer->AuthType = 'CRAM-MD5';
        $mailer->Port = $MAIL_Port;             // set the SMTP server port
        $mailer->Host = $MAIL_HOST;             // SMTP server
        $mailer->Username = $MAIL_USER;         // SMTP server username
        $mailer->Password = $MAIL_PASS;         // SMTP server password
        //$mail->IsSendmail();  // tell the class to use Sendmail
        $mailer->AddReplyTo("no-reply@noreply.com", "NO REPLY");
        $mailer->From = $MAIL_FROM;
        $mailer->FromName = $MAIL_FROM_USER_NAME;
        $mailer->Subject = !empty($subject) ? $subject : $MAIL_SUBJECT;
        $mailer->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mailer->WordWrap = 80; // set word wrap
        $body = htmlspecialchars_decode($body);
        $mailer->MsgHTML($body);
        $mailer->IsHTML(TRUE); // send as HTML
        if ($mailer->Send()) {
            //echo "Mail Sent" . "\n";
            return true;
        } else {
            return false;
        }
    }catch (Exception $e ){

    }
}

function retrive_configuration($cn, $type = "email")
{
    $qry = "Select `config` from `tbl_alert_config` where type='$type' and is_active='active' ";
    $rs = Sql_fetch_assoc(Sql_exec($cn, $qry));
    return json_decode($rs['config']);
}

function Parse_field( $str_raw, $dt_values )
{
    //$map_field = array( 'conf_name', 'long_number', 'start_time', 'end_time' );
    //$map_key = array( 0 => "[ConferenceName]", 1 => "[LongNumber]", 2 => "[StartTime]", 3 => "[EndTime]" );
	$map_field = array( 'conf_name', 'long_number', 'start_time', 'end_time', 'email_body', 'conf_user_name' );
    $map_key = array( 0 => "[ConferenceName]", 1 => "[LongNumber]", 2 => "[StartTime]", 3 => "[EndTime]", 4 => "[EmailBody]", 5 => "[UserName]" );

    foreach ($map_key as $key => $val) {
        $pos = FALSE;
        $pos = strpos($str_raw, $val);
        if ($pos !== FALSE) {
            $str_raw = str_replace($val, $dt_values[$map_field[$key]], $str_raw);
        }
    }
    return $str_raw;
}

