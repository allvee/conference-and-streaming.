<?php

include_once "class.phpmailer.php";

function update_memcache_for_application( $server, $port, $key, $current_status ){

    $memcacheD = new Memcache();
    $memcacheD->connect($server, $port);
    $memory_datas = $memcacheD->get($key);
    $is_found = false;
    $is_found_index = -1;
    foreach ( $memory_datas as $k => $data ) {

        if ( trim($data['status']) === $current_status ) {

            $is_found = true;
            if( empty($data['date_time']) ){
                $is_found_index = $k;
            }
            break;
        }

    }

    if( $is_found ){

        if( $is_found_index !== -1 ){

            foreach( $memory_datas as $k=>$data ){

                if( $k === $is_found_index ){
                    // set timer
                    $memory_datas[$k]['date_time'] = strtotime('now') +  intval($memory_datas[$k]['interval']) * 60;
                    $memory_datas[$k]['is_alarm'] = 0;
                    if( $data['is_multilevel'] === "yes" ) {
                        $memory_datas[$k]['is_alarm_level_1'] = 0;
                        $memory_datas[$k]['is_alarm_level_2'] = 0;
                    }

                }else{
                    $memory_datas[$k]['date_time'] = 0;
                    $memory_datas[$k]['is_alarm'] = 0;
                    if( $data['is_multilevel'] === "yes" ){
                        $memory_datas[$k]['is_alarm_level_1'] = 0;
                        $memory_datas[$k]['is_alarm_level_2'] = 0;
                    }
                }
            }
        }

    }else{

        foreach( $memory_datas as $k=>$data ){

            $memory_datas[$k]['date_time'] =  0;
            $memory_datas[$k]['is_alarm']  =  0;
            if( $data['is_multilevel'] === "yes" ){

                $memory_datas[$k]['is_alarm_level_1'] = 0;
                $memory_datas[$k]['is_alarm_level_2'] = 0;
            }
        }
    }


    $memcacheD->replace($key, $memory_datas, false, 0);
    $memcacheD->close();

}




function update_application_status($cn, $data, $status ){

    $component = trim($data['network_component']);
    $network = trim($data['nt_name']);
    $component_level = trim($data['component_level']);
    $device_ip = trim($data['device_ip']);

    $if_exist_qry = "SELECT COUNT(id) AS 'count' FROM `tbl_asmp_status` WHERE `network_component`='$component' AND `nt_name`='$network'";
    $result = Sql_exec($cn, $if_exist_qry);
    $dt = Sql_fetch_assoc($result);

    if( intval($dt['count']) > 0 ){
        $update_qry = "UPDATE `tbl_asmp_status` SET `nt_name` = '$network' , `component_level` = '$component_level' ,`destination_ip` = '$device_ip' , `status` = '$status'
                        WHERE `network_component`='$component'";
        Sql_exec($cn, $update_qry);
    }else{
        $inser_qry = "INSERT INTO `tbl_asmp_status`(`nt_name`,`network_component`,`component_level`,`destination_ip`,`status`)
                      VALUES( '$network', '$component', '$component_level', '$device_ip', '$status' )";
        Sql_exec($cn, $inser_qry);
    }

}


function write_application_log($cn, $data, $current_status)
{
    $qry = "SELECT `id`,`status`
            FROM `tbl_app_log_status`
            WHERE `network_component`='" . $data['network_component'] . "'
            ORDER BY `last_updated_time` DESC LIMIT 1";

    $result = Sql_exec($cn, $qry);
    $dt = Sql_fetch_assoc($result);
    $db_last_status = $dt['status'];

    if (!empty($db_last_status) && $db_last_status === $current_status) {
        echo 'Updating'."\n";
        $update_qry = "UPDATE `tbl_app_log_status` SET `last_updated_time` = NOW()
                       WHERE `id` = '" . $dt['id'] . "'";
        Sql_exec($cn, $update_qry);
    } else {
        $insert_qry = "INSERT INTO `tbl_app_log_status`(network_name,network_component,component_level,device_ip,app_name,app_port, `status`,write_time,last_updated_time )
                      VALUES(   '" . $data['nt_name'] . "',
                                '" . $data['network_component'] . "',
                                '" . $data['component_level'] . "',
                                '" . $data['device_ip'] . "',
                                '" . $data['app_name'] . "',
                                '" . $data['app_port'] . "',
                                '" . $current_status . "',
                                NOW(),
                                NOW()
                      )";

        Sql_exec($cn, $insert_qry);
    }

}

function refresh_updated_memcache_data( $memcacheD,$cn ){

    $qry = "SELECT `network_name` FROM `tbl_networks` WHERE `is_mem_updated`='yes'";
    $rs = Sql_exec($cn, $qry);
    $changed_networks = array();
    while ( $dt = Sql_fetch_assoc($rs) ){
        $changed_networks[] = $dt['network_name'];
    }


    $keys = array();

    foreach( $changed_networks as $network ){

        $qry_settings = "SELECT  alt.`alert_component`,alt.`alert_id`, alt.`status`,config.`interval`,alt.`is_multilevel` " .
            "FROM `tbl_asmp_configuration` config INNER JOIN `tbl_alert` alt " .
            "ON  config.`network_component` = alt.`alert_component`  WHERE config.`nt_name`='$network'";
        $rs = Sql_exec($cn, $qry_settings);


        while ( $dt = Sql_fetch_assoc($rs) ) {

            $component      = trim($dt['alert_component']);
            $is_multilevel  = $dt['is_multilevel'];
            $status_str     = trim($dt['status']);
            $interval       = intval($dt['interval']);
            $alart_id       = intval($dt['alert_id']);
            $status_arr     = explode( ",", $status_str );



            $level_1_id = "";
            $level_2_id = "";

            $level_1_interval = "";
            $level_2_interval = "";

            if( $is_multilevel === "yes" ) {

                $qry_multi_level =  " SELECT `id`,`interval` FROM `tbl_multi_level_alert` WHERE `alert_id`='$alart_id' " .
                    " ORDER BY `level` LIMIT 2";
                $rs_m = Sql_exec($cn, $qry_multi_level);
                $dt_1 = Sql_fetch_assoc($rs_m);
                $dt_2 = Sql_fetch_assoc($rs_m);

                $level_1_id = $dt_1['id'];
                $level_2_id = $dt_2['id'];

                $level_1_interval = $dt_1['interval'];
                $level_2_interval = $dt_2['interval'];

            }

            $datas = array();
            foreach ($status_arr as $status) {

                $status_corresponding_setting = array(
                    "status" => $status,
                    "date_time" => 0,
                    "is_alarm" => 0,
                    "is_multilevel" => $is_multilevel,
                    "interval" => $interval
                );
                if(  $is_multilevel === "yes"  ){

                    $status_corresponding_setting['is_alarm_level_1'] = 0;
                    $status_corresponding_setting['is_alarm_level_2'] = 0;
                    $status_corresponding_setting['level_1_interval'] = $level_1_interval;
                    $status_corresponding_setting['level_2_interval'] = $level_2_interval;
                    $status_corresponding_setting['level_1_id'] = $level_1_id;
                    $status_corresponding_setting['level_2_id'] = $level_2_id;

                }

                array_push($datas,$status_corresponding_setting);

            }

            if( $memcacheD->get($component) ) {

                $memcacheD->replace($component, $datas, false, 0);

            }else{
                $memcacheD->set($component, $datas, false, 0);
                if ( !in_array( $component,  $keys) ) {
                    array_push($keys, $component);
                }

            }

        }
    }


    if( count($changed_networks) > 0 ){
        $qry_update = "UPDATE `tbl_networks` SET `is_mem_updated` = 'no'  WHERE `is_mem_updated`='yes'";
        Sql_exec($cn, $qry_update);
    }

    return $keys;






}


function initialize_memcache_data($cn, $mem_server, $mem_port)
{

    $memcacheD = new Memcache();
    $memcacheD->connect($mem_server, $mem_port);
    $qry_settings = "SELECT  alt.`alert_component`,alt.`alert_id`, alt.`status`,config.`interval`,alt.`is_multilevel` " .
        "FROM `tbl_asmp_configuration` config INNER JOIN `tbl_alert` alt " .
        "ON  config.`network_component` = alt.`alert_component`";

    $rs = Sql_exec($cn, $qry_settings);
    $memcacheD->flush();
    $keys = array();

    while ( $dt = Sql_fetch_assoc($rs) ) {

        $component      = trim($dt['alert_component']);
        $is_multilevel  = $dt['is_multilevel'];
        $status_str     = trim($dt['status']);
        $interval       = intval($dt['interval']);
        $alart_id       = intval($dt['alert_id']);
        $status_arr     = explode( ",", $status_str );

        if ( !in_array( $component,  $keys) ) {
            array_push($keys, $component);
        }

        $level_1_id = "";
        $level_2_id = "";

        $level_1_interval = "";
        $level_2_interval = "";

        if( $is_multilevel === "yes" ) {

            $qry_multi_level =  " SELECT `id`,`interval` FROM `tbl_multi_level_alert` WHERE `alert_id`='$alart_id' " .
                " ORDER BY `level` LIMIT 2";
            $rs_m = Sql_exec($cn, $qry_multi_level);
            $dt_1 = Sql_fetch_assoc($rs_m);
            $dt_2 = Sql_fetch_assoc($rs_m);

            $level_1_id = $dt_1['id'];
            $level_2_id = $dt_2['id'];

            $level_1_interval = $dt_1['interval'];
            $level_2_interval = $dt_2['interval'];

        }

        $datas = array();
        foreach ($status_arr as $status) {

            $status_corresponding_setting = array(
                "status" => $status,
                "date_time" => 0,
                "is_alarm" => 0,
                "is_multilevel" => $is_multilevel,
                "interval" => $interval
            );
            if(  $is_multilevel === "yes"  ){

                $status_corresponding_setting['is_alarm_level_1'] = 0;
                $status_corresponding_setting['is_alarm_level_2'] = 0;
                $status_corresponding_setting['level_1_interval'] = $level_1_interval;
                $status_corresponding_setting['level_2_interval'] = $level_2_interval;
                $status_corresponding_setting['level_1_id'] = $level_1_id;
                $status_corresponding_setting['level_2_id'] = $level_2_id;

            }

            array_push($datas,$status_corresponding_setting);

        }

        $memcacheD->set($component, $datas, false, 0);
    }

    $memcacheD->close();

    return $keys;

}

function ping_output_parser($content_array, $th = 200)
{

    $output = array();

    if (!is_array($content_array)) {
        $output = explode("\n", $content_array);
    } else {
        $output = $content_array;
    }

    $percent_string = $output[count($output) - 2];
    $percent_arr = explode(",", $percent_string);
    //$loss_string_arr = explode("%",$percent_arr[2]);
    $percent_arr = array_reverse($percent_arr);
    $loss = strtok(trim($percent_arr[1]), "%");
    $loss = intval(trim($loss));

    $th_check = "";
    if ($loss < 100) {
        $rtt_string = $output[count($output) - 1];
        $temp_arr = explode("=", $rtt_string);
        $avg_arr = explode("/", $temp_arr[1]);
        $avg_value_round_trip_time = floatval($avg_arr[1]);
        $th = floatval($th);
        if ($avg_value_round_trip_time >= $th) {
            $th_check = true;
        } else {
            $th_check = false;
        }
    }

    $link_status = "unknown";

    if ($loss > 50 && $loss <= 100) {
        $link_status = "down";
    } elseif (($loss >= 0 && $loss <= 2)) {
        $link_status = "smooth";  // Packet Loss between 0 and 5 and Threshold not exceeded
    } elseif (($loss > 2 && $loss <= 50) && $th_check === true) {
        $link_status = "congested"; // Packet Loss between 0 and 5 and Threshold exceeded
    } elseif (($loss > 2 && $loss <= 50) && $th_check === false) {
        $link_status = "flapped"; // Packet Loss greater than 5 and upto 70 and Threshold exceeded
    }

    return $link_status;
}

function cisco_ping_output_parser($content_array, $th = 200)
{
    $output = $content_array;
    $percent_string = $output[count($output) - 2];

    $percent_arr = explode(",", $percent_string);


    $loss_string_arr = explode(" ", $percent_arr[0]);
    $success = trim($loss_string_arr[3]);
    $loss = 100 - $success;
    $th_check = "";

    if ($loss < 100) {
        $th_arr = explode("=", $percent_arr[1]);
        $avg_arr = explode("/", $th_arr[1]);
        $avg_value_round_trip_time = floatval($avg_arr[1]);
        $th = floatval($th);
        if ($avg_value_round_trip_time >= $th) {
            $th_check = true;
        } else {
            $th_check = false;
        }
    }

    $link_status = "unknown";

    if ($loss > 50 && $loss <= 100) {
        $link_status = "down";
    } elseif (($loss >= 0 && $loss <= 5)) {
        $link_status = "smooth";  // Packet Loss between 0 and 5 and Threshold not exceeded
    } elseif (($loss > 5 && $loss <= 50) && $th_check === true) {
        $link_status = "congested"; // Packet Loss between 0 and 5 and Threshold exceeded
    } elseif (($loss > 5 && $loss <= 50) && $th_check === false) {
        $link_status = "flapped"; // Packet Loss greater than 5 and upto 70 and Threshold exceeded
    }

    return $link_status;
}


function ping($ip, $count = 2, $th = 200)
{

    if (!isset($ip) || $ip === "") {
        return "";
    }

    $output = array();
    $cmd = escapeshellcmd("ping " . $ip . " -c " . $count);
    exec($cmd, $output, $return_val);
    $percent_string = $output[count($output) - 2];
    $percent_arr = explode(",", $percent_string);
    //$loss_string_arr = explode("%",$percent_arr[2]);
    $loss = strtok(trim($percent_arr[2]), "%");
    $loss = intval(trim($loss));

    $th_check = "";
    if ($loss < 100) {
        $rtt_string = $output[count($output) - 1];
        $temp_arr = explode("=", $rtt_string);
        $avg_arr = explode("/", $temp_arr[1]);
        $avg_value_round_trip_time = floatval($avg_arr[1]);
        $th = floatval($th);
        if ($avg_value_round_trip_time >= $th) {
            $th_check = true;
        } else {
            $th_check = false;
        }
    }

    $link_status = "unknown";

    if ($loss > 50 && $loss <= 100) {
        $link_status = "down";
    } elseif (($loss >= 0 && $loss <= 2)) {
        $link_status = "smooth";  // Packet Loss between 0 and 5 and Threshold not exceeded
    } elseif (($loss > 2 && $loss <= 50) && $th_check === true) {
        $link_status = "congested"; // Packet Loss between 0 and 5 and Threshold exceeded
    } elseif (($loss > 2 && $loss <= 50) && $th_check === false) {
        $link_status = "flapped"; // Packet Loss greater than 5 and upto 70 and Threshold exceeded
    }

    return $link_status;
}


/*
 * This function update $key corresponding memcache data
 * if timer is already set for $action_type(set), then ignore
 * otherwise set the timer
 * if $action_type = reset then timer is reset(off)
 * $server: memcache server
 * $port: memcache port
 * $key: 32 character unique id
 * $type: (disk|ram|process)
 * $action_type:(set|reset)
 */


function update_memcache_for_device( $server, $port, $key, $type, $action_type ){

    $memcacheD = new Memcache();
    $memcacheD->connect($server, $port);
    $memory_datas = $memcacheD->get($key);

    foreach ( $memory_datas as $k => $data ) {

        if ( trim($data['status']) === $type ) {

            if( $action_type === "set"  ){

                if( empty($data['date_time']) ){

                    $memory_datas[$k]['date_time'] = strtotime('now') +  intval($memory_datas[$k]['interval']) * 60;
                }
            }else if( $action_type === "reset" ){

                $memory_datas[$k]['date_time'] = 0;
            }

            break;

        }

    }

    $memcacheD->replace($key, $memory_datas, false, 0);
    $memcacheD->close();

}


function update_memcache_data($mem_server, $mem_port, $key, $status)
{

    $memcacheD = new Memcache();
    $memcacheD->connect($mem_server, $mem_port);
    $memory_datas = $memcacheD->get($key);

    $tracker = -1;
    $is_found = false;
    foreach ($memory_datas as $k => $data) {

        if (trim($data['status']) === $status) {
            $is_found = true;
            if (empty($data['date_time'])) {
                $tracker = $k;
            }
            break;
        }

    }


    if ($is_found) {

        if ( $tracker !== -1 ) {
            foreach ($memory_datas as $k => $data) {

                if ($k === $tracker) {
                    $memory_datas[$k]['date_time'] = strtotime('now') + (intval($memory_datas[$k]['interval']) * 60);
                    $memory_datas[$k]['is_alarm'] = 0;
                    if( $data['is_multilevel'] === "yes" ){

                        $memory_datas[$k]['is_alarm_level_1'] = 0;
                        $memory_datas[$k]['is_alarm_level_2'] = 0;
                    }

                } else {
                    $memory_datas[$k]['date_time'] = 0;
                    $memory_datas[$k]['is_alarm'] = 0;
                    if( $data['is_multilevel'] === "yes" ){

                        $memory_datas[$k]['is_alarm_level_1'] = 0;
                        $memory_datas[$k]['is_alarm_level_2'] = 0;
                    }
                }

            }
        }else{


        }
    } else {

        foreach ($memory_datas as $k => $data) {
            $memory_datas[$k]['date_time'] = 0;
            $memory_datas[$k]['is_alarm'] = 0;
            if( $data['is_multilevel'] === "yes" ){

                $memory_datas[$k]['is_alarm_level_1'] = 0;
                $memory_datas[$k]['is_alarm_level_2'] = 0;
            }
        }

    }

    $memcacheD->replace($key, $memory_datas, false, 0);
    $memcacheD->close();
}



function write_current_status($connection, $status_data)
{
    $query_if_exists = "Select count(*) as cnt from tbl_asmp_status where network_component = '" . $status_data['id'] . "' limit 1;";
    $res_if_exists = Sql_exec($connection, $query_if_exists);
    $result_if_exists = Sql_fetch_assoc($res_if_exists);
    $status_write_query = '';

    if ($result_if_exists['cnt'] > 0) {

        $status_write_query = "UPDATE `tbl_asmp_status` SET `bw_limit` = '".$status_data['bw_limit']."', `bandwidth`='".$status_data['current_bandwidth']."', `status`='" . $status_data['status'] . "', source_ip = '" . $status_data['src_ip'] . "', destination_ip = '" . $status_data['dest_ip'] . "' WHERE network_component = '" . $status_data['id'] . "';";

    } else {

        $status_write_query = "INSERT INTO `tbl_asmp_status` (nt_name, network_component, `component_level`, source_ip, destination_ip, bw_limit, bandwidth, `status`)
                                VALUES ('" . $status_data['nt_name'] . "', '" . $status_data['id'] . "', '" . $status_data['component_level'] . "', '" . $status_data['src_ip'] . "', '" . $status_data['dest_ip'] . "', '".$status_data['bw_limit']."', '".$status_data['current_bandwidth']."', '" . $status_data['status'] . "');";
    }

    Sql_exec($connection, $status_write_query);
}

function write_log_status($connection, $log_data)
{
    $last_link_qry = "SELECT * FROM `tbl_link_status_log` WHERE `network_name`='" . $log_data['nt_name'] . "' AND `network_component`='" . $log_data['id'] . "' ORDER BY `last_updated` DESC LIMIT 0,1";
    $res = Sql_exec($connection, $last_link_qry);
    $dt = Sql_fetch_array($res);
    $last_update_time = trim($dt['last_updated']);
    $uniq_row_id = $dt['id'];
    $last_db_link_status = trim($dt['current_status']);
    $last_db_link_status = (isset($last_db_link_status) && !is_null($last_db_link_status) && !empty($last_db_link_status)) ? $last_db_link_status : false;
    if ($last_db_link_status && $last_db_link_status === $log_data['current_status']) {

        $qry_update = "UPDATE `tbl_link_status_log`
									SET
										`last_updated`= NOW()
									WHERE 	`id`=$uniq_row_id AND
											`network_name`='" . $log_data['nt_name'] . "' AND
											`network_component`='" . $log_data['id'] . "'";
        Sql_exec($connection, $qry_update);

    } else {

        $qry = "INSERT INTO `tbl_link_status_log` (`network_name`,`network_component`,`component_level`,`source_ip`,`destination_ip`,`bw_limit`,`bandwidth`,`link_status`,`from_status`,`current_status`,`write_time`,`last_updated`)
							   VALUES(
										'" . $log_data['nt_name'] . "',
										'" . $log_data['id'] . "',
										'" . $log_data['component_level'] . "',
										'" . $log_data['src_ip'] . "',
										'" . $log_data['dest_ip'] . "',
										'',
										'',
										'" . $log_data['current_status'] . "',
										'" . $log_data['from_status'] . "',
										'" . $log_data['current_status'] . "',
										NOW(),
										NOW()
								)";

        Sql_exec($connection, $qry);
    }
}

function write_snmp_log_status($connection, $log_data)
{
    $qry = "INSERT INTO tbl_asmp_snmp_log
	(nt_name,
	network_component,
	device_type,
	component_level,
	device_ip,
	object_type,
	disk_usage,
	oid_used,
	bandwidth,
	cpu_usage,
	`memory`,
	sys_up_time,
	write_time
	)
	VALUES
	('" . $log_data['nt_name'] . "',
	'" . $log_data['network_component'] . "',
	'" . $log_data['device_type'] . "',
	'" . $log_data['component_level'] . "',
	'" . $log_data['device_ip'] . "',
	'',
	'" . $log_data['disk'] . "',
	'',
	'',
	'',
	'" . $log_data['memory'] . "',
	'',
	'" . date('Y-m-d H:i:s') . "'
	);";

    Sql_exec($connection, $qry);
}


function SendEmail($cn,$mail, $subject, $body, $receiver = array(), $config_arr = array())
{
    //print_r($config_arr);

    /*  
	$MAIL_HOST = "monitor.dozeinternet.com";
   $MAIL_Port = 25;
   $MAIL_USER = "support";
   $MAIL_PASS = "Nopass1234";
   $MAIL_FROM = "support@monitor.dozeinternet.com";
   $MAIL_FROM_USER_NAME = "DOZE";
   $MAIL_SUBJECT = "Notification From ONUBHA Gateway Controller"; 
   */

    $MAIL_FROM = "support@monitor.dozeinternet.com";
    $MAIL_FROM_USER_NAME = "Onubha Team";
    $MAIL_SUBJECT = "Notification From ONUBHA Gateway Controller";

    $MAIL_USER = trim($config_arr["email"]);
    $MAIL_PASS = trim($config_arr["password"]);
    $MAIL_HOST = trim($config_arr["smtp_account"]);
    $MAIL_Port = $config_arr["smtp_port"];

    // echo $config_arr->email.":".$config_arr->password.":".$config_arr->smtp_account.":".$config_arr->smtp_port."\n";
    echo $MAIL_USER . ":" . $MAIL_PASS . ":" . $MAIL_HOST . ":" . $MAIL_Port . "\n";

    foreach ($receiver as $user_email) {
        $mail->AddAddress($user_email);
        echo "</br>mail:" . $user_email . "\n";
    }

    $body = preg_replace('/\\\\/', '', $body); //Strip backslashes

    try {
        $mail->IsSMTP(); // tell the class to use SMTP
        //$mail->SMTPSecure = 'ssl';
        $mail->SMTPDebug  = 1;
        $mail->SMTPAuth = true;  // enable SMTP authentication

        $mail->AuthType = 'CRAM-MD5';
        $mail->Port = $MAIL_Port;                    // set the SMTP server port
        $mail->Host = $MAIL_HOST; // SMTP server
        $mail->Username = $MAIL_USER;     // SMTP server username
        $mail->Password = $MAIL_PASS;            // SMTP server password

        //$mail->IsSendmail();  // tell the class to use Sendmail

        $mail->AddReplyTo("no-reply@noreply.com", "NO REPLY");

        $mail->From = $MAIL_FROM;
        $mail->FromName = $MAIL_FROM_USER_NAME;


        //$mail->AddAddress("atanu21000@yahoo.com");

        $mail->Subject = $subject ? $subject : $MAIL_SUBJECT;

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->WordWrap = 80; // set word wrap
        $body = htmlspecialchars_decode($body);
        $mail->MsgHTML($body);

        $mail->IsHTML(TRUE); // send as HTML


        if ( $mail->Send() ) {

            echo "Mail Sent" . "\n";

            $msg = ($subject ? $subject : $MAIL_SUBJECT). " ".$body;
            $receivers = implode(",",$receiver);
            $qry =  " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                " VALUES ( '$msg', '$receivers',NOW(),'SENT' )";
            /*Sql_exec($cn, $qry);*/
        } else {
            echo "Mail Sending Failed" . "\n";
            $err_msg = $mail->ErrorInfo;
            $receivers = implode(",",$receiver);
            $qry =  " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                " VALUES ( '$err_msg', '$receivers',NOW(),'FAILED' )";
            /*Sql_exec($cn, $qry);*/

        }

    } catch (phpmailerException $e) {
        $msg = $e->errorMessage(); //Pretty error messages from PHPMailer
        echo $msg;
        $receivers = implode(",",$receiver);
        $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
            " VALUES ( '$msg', '$receivers',NOW(),'FAILED' )";
        /*Sql_exec($cn, $qry);*/

    } catch (Exception $e) {
        $msg = $e->getMessage(); //Boring error messages from anything else!
        echo $msg;
        $receivers = implode(",",$receiver);
        $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
            " VALUES ( '$msg', '$receivers',NOW(),'FAILED' )";
        /*Sql_exec($cn, $qry);*/
    }

}


function SendSMS($cn,$sms_config_arr, $mobile_numbers, $message)
{
    $bulk_sms_url = $sms_config_arr->api_url . '?UserName=' . $sms_config_arr->user_name . '&Password=' . $sms_config_arr->password . '&Sender=' . $sms_config_arr->mask;
    $encodedMsg = rawurlencode(htmlspecialchars($message));
    $encodedMsg = str_replace('.', '%2E', $encodedMsg);
    $msg_string = "";
    $count = 0;
    foreach ($mobile_numbers as $m_no) {
        if (!empty($m_no)) {

            if ($msg_string != "") $msg_string .= "|";

            $msg_string .= $m_no . "|" . $encodedMsg;

            $count++;
        }
    }
    //$count = count($mobile_numbers);

    $bulk_sms_url .= "&text=" . $msg_string . "&NO=" . $count;
    echo $bulk_sms_url . "\n";
    if ( $count > 0 ) {
        $response = file_get_contents($bulk_sms_url);
        echo $response . "\n";
        $receivers = implode(",",$mobile_numbers);
        $qry =  " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
            " VALUES ( '$response', '$receivers',NOW(),'SMS')";
        Sql_exec($cn, $qry);
    }
}

function retrive_configuration($cn, $type = "email")
{
    $qry = "Select `config` from `tbl_alert_config` where type='$type' and is_active='active' ";
    $rs = Sql_fetch_array(Sql_exec($cn, $qry));

    $config_arr = array();
    $config_obj = json_decode($rs['config']);
    return $config_obj;
}


function Parse_field($str_raw, $dt_values)
{

    $map_field = array('nt_name', 'component_level', 'nt_status');
    $map_key = array(0 => "[NetworkName]", 1 => "[ComponentLevel]", 2 => "[Status]");
    foreach ($map_key as $key => $val) {
        $pos = FALSE;
        $pos = strpos($str_raw, $val);
        if ($pos !== FALSE) {
            $str_raw = str_replace($val, $dt_values[$map_field[$key]], $str_raw);
        }
    }

    return $str_raw;


}

function send_notification($cn, $key, $status)
{
    if($status == 'disk') {
        $status = 'Low Disk Space';
    }
    if($status == 'ram' || $status == 'memory') {
        $status = 'Risk';
    }
    $key = trim($key);
    echo $key."\n";
    $email_config_object = retrive_configuration($cn, "email");
    $sms_config_object = retrive_configuration($cn, "sms");

    $email_subject_string = $email_config_object->email_subject;
    $email_body_string = $email_config_object->email_body;
    $sms_body_string = $sms_config_object->sms_text;

    $group_qry = "SELECT alert.`time_slot_id`, alert.`group`,  alert.nt_type, alert.email_subject, alert.email_body, alert.sms_text, config.nt_name, config.component_level " .
        "FROM `tbl_alert` alert INNER JOIN `tbl_asmp_configuration` config ON alert.alert_component = config.network_component " .
        "WHERE alert.`alert_component`='$key'";

    $rs = Sql_exec($cn, $group_qry);
    $dt = Sql_fetch_assoc($rs);
    $groups_string = $dt['group'];
    $nt_type = $dt['nt_type'];
    $time_slot_id = intval($dt['time_slot_id']);


    $values = array(
        'nt_name' => $dt['nt_name'],
        'component_level' => $dt['component_level'],
        'nt_status' => $status
    );

    //print_r($values);

    $db_email_subject = $dt['email_subject'];
    $db_email_body = $dt['email_body'];
    $db_sms_text = $dt['sms_text'];

    echo 'echo $db_email_body::'.$db_email_body."\n";

    $email_subject_string = Parse_field($email_subject_string, $values);
    $email_body_string = Parse_field($email_body_string, $values);
    //echo 'Email Body:: '.$email_body_string."\n";

    $sms_body_string = Parse_field($sms_body_string, $values);

    $groups = explode(",", $groups_string);

    $emails = array();
    $mobile_numbers = array();
    foreach ($groups as $group) {

        $qry = "SELECT `email`,`mobile_no` FROM `tbl_alert_group_detail` WHERE `is_active`='active' and `group`='$group'";
        $rs = Sql_exec($cn, $qry);
        //$dt = Sql_fetch_assoc($rs);
        while($dt = Sql_fetch_assoc($rs)) {
            if(!empty($dt['email']))
                array_push($emails, $dt['email']);
            if(!empty($dt['mobile_no']))
                array_push($mobile_numbers, $dt['mobile_no']);
        }
    }


    if (isset($time_slot_id) && !empty($time_slot_id)) {
        $d_qry = "SELECT `start_day`,`start_time`, `end_day`, `end_time`, `is_active` FROM `tbl_time_slot` WHERE `id`='$time_slot_id' AND `is_active`='active'";
        $rs = Sql_exec($cn, $d_qry);
        $dt = Sql_fetch_assoc($rs);
        if (count($dt) > 0) {

            $start_d = $dt['start_day'];
            $start_t = $dt['start_time'];
            $end_d = $dt['end_day'];
            $end_t = $dt['end_time'];

            $days = array();
            $days_indx = array(
                0 => "Sunday",
                1 => "Monday",
                2 => "Tuesday",
                3 => "Wednesday",
                4 => "Thursday",
                5 => "Friday",
                6 => "Saturday"
            );
            if (isset($start_d) && isset($start_t) && isset($end_d) && isset($end_t)) {

                $key = array_search($start_d, $days_indx);
                array_push($days, $key);

                while (count($days) <= 7) {
                    $key = ($key + 1) % 7;
                    array_push($days, $key);
                    if ($days_indx[$key] === $end_d) {
                        break;
                    }
                }

                $week_number = date("w"); // week number of current timestamp (0=sunday,.....,6=saturday)
                $week_number = intval($week_number);
                if (in_array($week_number, $days)) {
                    $Hour = date("G");
                    $Hour = intval($Hour);
                    if ($Hour >= $start_t && $Hour <= $end_t) {

                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            } else {
                echo "Invalid Time Slot in tbl_time_slot database table " . "\n";
            }


        }


    }


    $mail = new PHPMailer(true);


    $email_subject = "";
    $email_body = "";
    if (isset($db_email_subject) && !empty($db_email_subject)) {

        $email_subject = $db_email_subject;
    } else {
        $email_subject = $email_subject_string;
    }

    if (isset($db_email_body) && !empty($db_email_body)) {

        $email_body = $db_email_body;
    } else {
        $email_body = $email_body_string;
    }

    $sms_txt = "";

    if (isset($db_sms_text) && !empty($db_sms_text)) {
        $sms_txt = $db_sms_text;
    } else {
        $sms_txt = $sms_body_string;
    }
    if (strlen($sms_txt) > 159) {
        $sms_txt = substr($sms_txt, 0, 159);
    }

    if ( $nt_type === "email" ) {
        echo $email_body."\n";

        $e_mails = array();
        $is_send = true;
        $msg = "";
        if( count($emails)>0 ){
            foreach( $emails as $email ){
                if( $m = filter_var($email,FILTER_VALIDATE_EMAIL) ){
                    array_push($e_mails,$m);
                }else{
                    $is_send = false;
                    $receivers = implode(",",$emails);
                    $msg = "Invalid Email Address \"".$email."\" in ".$receivers;
                    $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                        " VALUES ( '$msg', '$receivers',NOW(),'FAILED' )";
                    Sql_exec($cn, $qry);
                    break;
                }
            }

        }else{
            $is_send = false;
            $msg = "No Email Address Configured";
            $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                " VALUES ( '$msg', 'No emails',NOW(),'FAILED' )";
            Sql_exec($cn, $qry);
        }

        if( $is_send ){
            SendEmail($cn,$mail, $email_subject, $email_body, $e_mails, $email_config_object);
        }



    } else if ($nt_type === "sms") {

        SendSMS($cn,$sms_config_object, $mobile_numbers, $sms_txt);

    } else if ( $nt_type === "both" ) {

        SendSMS($cn,$sms_config_object, $mobile_numbers, $sms_txt);

        // echo $email_body."\n";
        $e_mails = array();
        $is_send = true;
        $msg = "";
        if( count($emails)>0 ){
            foreach( $emails as $email ){
                if( $m = filter_var($email,FILTER_VALIDATE_EMAIL) ){
                    array_push($e_mails,$m);
                }else{
                    $is_send = false;
                    $receivers = implode(",",$emails);
                    $msg = "Invalid Email Address \"".$email."\" in ".$receivers;
                    $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                        " VALUES ( '$msg', '$receivers',NOW(),'FAILED' )";
                    Sql_exec($cn, $qry);
                    break;
                }
            }

        }else{
            $is_send = false;
            $msg = "No Email Address Configured";
            $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                " VALUES ( '$msg', 'No emails',NOW(),'FAILED' )";
            Sql_exec($cn, $qry);
        }

        if( $is_send ){
            SendEmail($cn,$mail, $email_subject, $email_body, $e_mails, $email_config_object);
        }

    }


}

function send_notification_for_multilevel( $cn, $key, $status, $level_1_id ){
    if($status == 'disk') {
        $status = 'Low Disk Space';
    }
    if($status == 'ram' || $status == 'memory') {
        $status = 'Risk';
    }
    $key = trim($key);
    $email_config_object = retrive_configuration($cn, "email");
    $sms_config_object = retrive_configuration($cn, "sms");

    $email_subject_string = $email_config_object->email_subject;
    $email_body_string = $email_config_object->email_body;
    $sms_body_string = $sms_config_object->sms_text;

    $group_qry = "SELECT  config.`nt_name`,config.`component_level`,config.`device_type`, ".
        " ma.`nt_type`, ma.`email_subject`,ma.`email_body`,ma.`sms_text`,ma.`time_slot_id`,ma.`group`  ".
        " FROM `tbl_multi_level_alert` ma INNER JOIN `tbl_alert` alart ON ma.alert_id = alart.alert_id  ".
        " INNER JOIN `tbl_asmp_configuration` config ON config.`network_component` = alart.`alert_component` ".
        " WHERE ma.id = '$level_1_id'";

    $rs = Sql_exec($cn, $group_qry);
    $dt = Sql_fetch_assoc($rs);
    $groups_string = $dt['group'];
    $nt_type = $dt['nt_type'];
    $time_slot_id = intval($dt['time_slot_id']);


    $values = array(
        'nt_name' => $dt['nt_name'],
        'component_level' => $dt['component_level'],
        'nt_status' => $status
    );

    //print_r($values);

    $db_email_subject = $dt['email_subject'];
    $db_email_body = $dt['email_body'];
    $db_sms_text = $dt['sms_text'];

    $email_subject_string = Parse_field($email_subject_string, $values);
    $email_body_string = Parse_field($email_body_string, $values);
    //echo 'Email Body:: '.$email_body_string."\n";

    $sms_body_string = Parse_field($sms_body_string, $values);

    $groups = explode(",", $groups_string);

    $emails = array();
    $mobile_numbers = array();
    foreach ($groups as $group) {

        $qry = "SELECT `email`,`mobile_no` FROM `tbl_alert_group_detail` WHERE `is_active`='active' and `group`='$group'";
        $rs = Sql_exec($cn, $qry);
        //$dt = Sql_fetch_assoc($rs);
        while($dt = Sql_fetch_assoc($rs)) {
            if(!empty($dt['email']))
                array_push($emails, $dt['email']);
            if(!empty($dt['mobile_no']))
                array_push($mobile_numbers, $dt['mobile_no']);
        }
    }

    if (isset($time_slot_id) && !empty($time_slot_id)) {
        $d_qry = "SELECT `start_day`,`start_time`, `end_day`, `end_time`, `is_active` FROM `tbl_time_slot` WHERE `id`='$time_slot_id' AND `is_active`='active'";
        $rs = Sql_exec($cn, $d_qry);
        $dt = Sql_fetch_assoc($rs);
        if (count($dt) > 0) {

            $start_d = $dt['start_day'];
            $start_t = $dt['start_time'];
            $end_d = $dt['end_day'];
            $end_t = $dt['end_time'];

            $days = array();
            $days_indx = array(
                0 => "Sunday",
                1 => "Monday",
                2 => "Tuesday",
                3 => "Wednesday",
                4 => "Thursday",
                5 => "Friday",
                6 => "Saturday"
            );
            if (isset($start_d) && isset($start_t) && isset($end_d) && isset($end_t)) {

                $key = array_search($start_d, $days_indx);
                array_push($days, $key);

                while (count($days) <= 7) {
                    $key = ($key + 1) % 7;
                    array_push($days, $key);
                    if ($days_indx[$key] === $end_d) {
                        break;
                    }
                }

                $week_number = date("w"); // week number of current timestamp (0=sunday,.....,6=saturday)
                $week_number = intval($week_number);
                if (in_array($week_number, $days)) {
                    $Hour = date("G");
                    $Hour = intval($Hour);
                    if ($Hour >= $start_t && $Hour <= $end_t) {

                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            } else {
                echo "Invalid Time Slot in tbl_time_slot database table " . "\n";
            }


        }


    }


    $mail = new PHPMailer(true);


    $email_subject = "";
    $email_body = "";
    if (isset($db_email_subject) && !empty($db_email_subject)) {

        $email_subject = $db_email_subject;
    } else {
        $email_subject = $email_subject_string;
    }

    if (isset($db_email_body) && !empty($db_email_body)) {

        $email_body = $db_email_body;
    } else {
        $email_body = $email_body_string;
    }

    $sms_txt = "";

    if (isset($db_sms_text) && !empty($db_sms_text)) {
        $sms_txt = $db_sms_text;
    } else {
        $sms_txt = $sms_body_string;
    }
    if (strlen($sms_txt) > 159) {
        $sms_txt = substr($sms_txt, 0, 159);
    }

    if ($nt_type === "email") {

        $e_mails = array();
        $is_send = true;
        $msg = "";
        if( count($emails)>0 ){
            foreach( $emails as $email ){
                if( $m = filter_var($email,FILTER_VALIDATE_EMAIL) ){
                    array_push($e_mails,$m);
                }else{
                    $is_send = false;
                    $receivers = implode(",",$emails);
                    $msg = "Invalid Email Address \"".$email."\" in ".$receivers;
                    $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                        " VALUES ( '$msg', '$receivers',NOW(),'FAILED' )";
                    Sql_exec($cn, $qry);
                    break;
                }
            }

        }else{
            $is_send = false;
            $msg = "No Email Address Configured";
            $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                " VALUES ( '$msg', 'No emails',NOW(),'FAILED' )";
            Sql_exec($cn, $qry);
        }

        if( $is_send ){
            SendEmail($cn,$mail, $email_subject, $email_body, $e_mails, $email_config_object);
        }
        //SendEmail($mail, $email_subject, $email_body, $emails, $email_config_object);
    } else if ($nt_type === "sms") {
        SendSMS($cn,$sms_config_object, $mobile_numbers, $sms_txt);
    } else if ($nt_type === "both") {

        SendSMS($cn,$sms_config_object, $mobile_numbers, $sms_txt);

        $e_mails = array();
        $is_send = true;
        $msg = "";
        if( count($emails)>0 ){
            foreach( $emails as $email ){
                if( $m = filter_var($email,FILTER_VALIDATE_EMAIL) ){
                    array_push($e_mails,$m);
                }else{
                    $is_send = false;
                    $receivers = implode(",",$emails);
                    $msg = "Invalid Email Address \"".$email."\" in ".$receivers;
                    $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                        " VALUES ( '$msg', '$receivers',NOW(),'FAILED' )";
                    Sql_exec($cn, $qry);
                    break;
                }
            }

        }else{
            $is_send = false;
            $msg = "No Email Address Configured";
            $qry = " INSERT INTO `tbl_notification_log` (`log_message`,`receivers`,`write_time`,`sent_status`) ".
                " VALUES ( '$msg', 'No emails',NOW(),'FAILED' )";
            Sql_exec($cn, $qry);
        }

        if( $is_send ){
            SendEmail($cn,$mail, $email_subject, $email_body, $e_mails, $email_config_object);
        }

        //SendEmail($mail, $email_subject, $email_body, $emails, $email_config_object);
    }


}
