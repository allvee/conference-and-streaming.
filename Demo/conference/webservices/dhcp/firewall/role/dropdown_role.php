<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/28/2015
 * Time: 4:32 PM
 */

require_once  "../../lib/common.php";

$cn = connectDB();
$session_id=$_SESSION['firewall']['id'];
$session_type=$_SESSION['firewall']['user_type'];

if($session_type!='Super User'){

    $qry_fetch="SELECT `org_id` FROM `org_users` WHERE `user_id`=$session_id";

    $res_fetch=Sql_exec($cn,$qry_fetch);
    $i=0;$org_id="";

    while($dt= Sql_fetch_array($res_fetch)){
        $org_id[$i]=$dt['org_id'];
        $i++;
    }

    $interface_options = "";

    foreach($org_id as $org) {

        $qry = "SELECT 	`id`,`NAME`
        FROM
        `organization` WHERE `id`='$org' AND STATUS='active'";
        $res = Sql_exec($cn, $qry);


        while ($dt = Sql_fetch_array($res)) {
            $id = $dt['id'];
            $name = $dt['NAME'];
            $interface_options .= '<option value="' . $id . '">' . $name . '</option>';
        }
    }
}else{
    $qry = "SELECT 	`id`,`NAME`
        FROM
        `organization` WHERE STATUS='active'";
    $res = Sql_exec($cn, $qry);


    while ($dt = Sql_fetch_array($res)) {
        $id = $dt['id'];
        $name = $dt['NAME'];
        $interface_options .= '<option value="' . $id . '">' . $name . '</option>';
    }
}


ClosedDBConnection($cn);
echo $interface_options;
