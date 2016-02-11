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
    $qry = "SELECT `id`,`name`
		FROM `roles`
		WHERE	`status`='active'";
    $res = Sql_exec($cn,$qry);

    $interface_options = "";
    while($dt = Sql_fetch_array($res)){
        $id=$dt['id'];
        $name=$dt['name'];
        $interface_options  .= '<option value="'.$id.'">'.$name.'</option>';
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

        $qry = "SELECT `id`,`name`
		FROM `roles`
		WHERE org_id='$org' AND	`status`='active'";
        $res = Sql_exec($cn,$qry);

        $interface_options = "";
        while($dt = Sql_fetch_array($res)){
            $id=$dt['id'];
            $name=$dt['name'];
            $interface_options  .= '<option value="'.$id.'">'.$name.'</option>';
        }

    }
   }
ClosedDBConnection($cn);
echo $interface_options;

