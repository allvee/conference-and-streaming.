<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/25/2015
 * Time: 4:49 PM
 */

require_once  "../../lib/common.php";

$cn = connectDB();
$session_id=$_SESSION['firewall']['id'];
$session_type=$_SESSION['firewall']['user_type'];

if($session_type=='Super User') {

    $result_curl = curlRequest('GET', Marketplace_USER_LIST, array());
    $result_array = json_decode($result_curl, true);

    $qry = "SELECT `id`,`login_id`
		FROM `users`
		WHERE `status`='active'";
    $res = Sql_exec($cn, $qry);

    $interface_options = "";
    while ($dt = Sql_fetch_array($res)) {
        $id = $dt['id'];
        $login_id = $dt['login_id'];
        $interface_options .= '<option value="' . $id . '">' . $login_id . '</option>';
    }
}else{

    $org_id=array(); $i=0;

    $qry_fetch="select org_id from org_users WHERE user_id='$session_id'";

    $res_fetch = Sql_exec($cn, $qry_fetch);
    while ($dt = Sql_fetch_array($res_fetch)){
        $org_id[$i]=$dt['org_id'];
        $i++;
    }

    $user_id=array();
    $i=0;
    foreach($org_id as $org){

        $qry_fetch="select user_id from org_users WHERE org_id='$org'";
        $res_fetch = Sql_exec($cn, $qry_fetch);

        while ($dt = Sql_fetch_array($res_fetch)){
            if(sizeof($user_id)==0){
                $user_id[$dt['user_id']] = $dt['user_id'];
            }else if($user_id[$dt['user_id']]=='') {

                $user_id[$dt['user_id']] = $dt['user_id'];
            }

        }

    }
    $interface_options = "";
    $result_curl = curlRequest('GET', Marketplace_USER_LIST, array());
    $result_array = json_decode($result_curl, true);

    foreach($user_id as $login_id) {


    /*    $qry = "SELECT `id`,`login_id`
                FROM `users`
                WHERE id='$login_id' AND `status`='active'";
        $res = Sql_exec($cn, $qry);*/
        $data[$i][$j++] = $result_array[$login_id];
       
        while ($dt = Sql_fetch_array($res)) {
            $id = $dt['id'];
            $login_id = $dt['login_id'];
            $interface_options .= '<option value="' . $id . '">' . $login_id . '</option>';
        }
    }

}
ClosedDBConnection($cn);
echo $interface_options;
