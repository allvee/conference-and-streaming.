<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/21/2016
 * Time: 4:47 PM
 */

include_once "../lib/common.php";
include_once "../lib/asmp_lib.php";
include_once "../lib/functions.php";
$cn = connectDB();

$tbl = "tbl_participant";
$participant_conference_name = $_SESSION['conference']['conf_name'];
$sms_config_object = null;
$email_config_object = null;

$conference_id = null;
$send_sms_email =  false;
if (isset($_REQUEST['info'])) {
    $conference_id = $_REQUEST['info'];
} else {
    $conference_id = $_SESSION['conference']['current_conference_instance']['ID'];
    $sms_config_object = retrive_configuration($cn,"sms");
    $email_config_object = retrive_configuration($cn,"email");
    $send_sms_email = true;
}

//$sms_url = $sms_config_object->api_url;
//$user_name = $sms_config_object->user_name;
//$password = $sms_config_object->password;
//$mask = $sms_config_object->mask;
//$sms_text = $sms_config_object->sms_text;

$conf_user_name = $_SESSION['conference']['Name'];		
$conf_name = $_SESSION['conference']['current_conference_instance']['Conf_Name'];
$start_time = $_SESSION['conference']['current_conference_instance']['Start_Time'];
$end_time = $_SESSION['conference']['current_conference_instance']['End_Time'];
$long_number = $_SESSION['conference']['current_conference_instance']['long_number'];

//$data_value = array( "conf_name"=>$conf_name,"long_number"=>$long_number,"start_time"=>$start_time,"end_time"=>$end_time );

//$sms_text = Parse_field($sms_text,$data_value);

$arrayInput = array();
$query = "SELECT  participant_name, msisdn, email FROM $tbl where conference_ID ='$conference_id'";
$result = Sql_exec($cn, $query);

$data = array();
$i = 0;
$participant_msisdn = array();
$mail_receivers = array();

while ( $row = Sql_fetch_array($result) ) {
    $j = 0;
    $data[$i][$j++] = Sql_Result($row, "participant_name");
    $data[$i][$j++] = Sql_Result($row, "msisdn");
    $participant_msisdn[$i] = Sql_Result($row, "msisdn");
    $mail_receivers[$i] = Sql_Result($row, "email");
    $data[$i][$j++] = Sql_Result($row, "email");
    $i++;
    if ($_SESSION['conference']['notification']['IVR'] == true) {
        $participant_name = $row['participant_name'];
        $msisdn = $row['msisdn'];
        $long_code = $_SESSION['conference']['long_code'];

       // $qry = "insert into $Call_Handler_DB.outdialque set MSISDN = '$msisdn',DisplayAno = '$long_code',OriginalAno = '2008',
       // ServiceId = 'OBD_Test', OutDialStatus = 'QUE', RetTryCount='1',UserId = '$conference_id', OutDialTime = NOW()";
        //echo $qry.__LINE__.__FILE__."\n";
        //logcats("Query: ".$qry);
       // $ret = Sql_exec($cn,$qry);
        //logcats("Insert: ".$ret);
        //echo $ret.__LINE__.__FILE__."\n";
        //Sql_Free_Result($ret);

    }


}
//echo "receiver Mail:";
//print_r($mail_receivers); 

$total_sent = array();
$total_sent_email = array();
if($send_sms_email == true){

    if ($_SESSION['conference']['notification']['SMS']) {

        $sms_data = array();
        $sms_data['username'] = $sms_config_object->user_name;
        $sms_data['password'] =  $sms_config_object->password;
        $sms_data['mask'] =  trim($sms_config_object->mask);

        $sms_text = $sms_config_object->sms_text;

        $data_value = array( "conf_name"=>$conf_name,"long_number"=>$long_number,"start_time"=>$start_time,"end_time"=>$end_time );

        $sms_text = Parse_field($sms_text,$data_value);

        $sms_data['body'] = $sms_text;
        $SMS_URL = $sms_config_object->api_url;

        // mobile number with country code
        foreach( $participant_msisdn as $number ){

            $sms_data['destination'] = "88".$number;
            $SMS_ret = curlRequest('GET', $SMS_URL, $sms_data);
            //echo "SMS_ret:";
			//print_r($SMS_ret);
			
            array_push($total_sent, $sms_data);
        }
    }
	
if ($_SESSION['conference']['notification']['EMAIL']) {
	/*
		
		$mail = new PHPMailer(true);
		$email_subject_string = $email_config_object->email_subject;
        $email_body_string = $email_config_object->email_body;
		
        $email_body_main = trim( $_SESSION['conference']['current_conference_instance']['email_body'] );

        $data_info = array(
                       "conf_name"=>$conf_name,
					   "long_number"=>$long_number,
					   "start_time"=>$start_time,
					   "end_time"=>$end_time,
					   "email_body"=>$email_body_main,
                       "conf_user_name"=> $conf_user_name
        );
		
        $email_subject_string = Parse_field( $email_subject_string, $data_info );
		$email_body_string  = Parse_field( $email_body_string, $data_info );
		
		
        if( !empty($email_body_main) ) {
            $email_body_string = $email_body_main ." <br/>".$email_body_string;
        }
		
		$send_status = SendEmails($mail,$email_config_object,$mail_receivers,$email_subject_string,$email_body_string);
    */
	}	

}

Sql_Free_Result($result);
ClosedDBConnection($cn);
//$json_data = json_encode($data);
//echo __FILE__.__LINE__;
if ($is_error == 0) {
    $return_data = array('status' => true, 'data' => $data, 'SMS_ret'=>$SMS_ret, 'email_status'=>$send_status, 'email_Send_status' =>$send_status, 'sms_data_sent'=>$total_sent);
} else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.');
}

echo json_encode($return_data);
