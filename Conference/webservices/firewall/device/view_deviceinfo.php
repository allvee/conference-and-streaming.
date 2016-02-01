<?php
//session_start();
header('Access-Control-Allow-Origin: *');
require_once "../../lib/common.php";

$cn = connectDB();

// $user_type = $_SESSION["firewall"]["user_type"];
$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];


$query = "SELECT * FROM devices where status='active' AND created_by IN ($user_id) ";

//echo $query;

$rs = Sql_exec($cn,$query);

$firewall_session = $_SESSION['firewall'];
$is_super_admin = false;
if($firewall_session['user_type'] == 'Super User')
    $is_super_admin = true;
$permission_array = json_decode($firewall_session['rules']['Device'], true);


$data = array();
$i=0;

while($row = Sql_fetch_array($rs)){

    $j=0;
    $data[$i][$j++] = Sql_Result($row, "name");
    $data[$i][$j++] = Sql_Result($row, "ip");
    $data[$i][$j++] = Sql_Result($row, "loginId");
    $data[$i][$j++] = Sql_Result($row, "password");
   // $org_id = Sql_Result($row, "organizations");


        /*$qry = "SELECT name FROM organization where id IN ($org_id)";
        $rslt = Sql_exec($cn, $qry);
        $org_name="";
        $flag =0;
        while($rw = Sql_fetch_array($rslt))
        {
            if($flag) {
                $org_name .=",".Sql_Result($rw, "name");

            } else
            $org_name.=Sql_Result($rw,"name");

            if($flag == 0)
                $flag=1;
        }

    $data[$i][$j++] = $org_name;*/

    //$data[$i][$j++] = '<span onclick="edit_input_form_firewall_device(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>'.'&nbsp&nbsp'.'<span onclick="delete_firewall_device(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';


    $action_data = '';
    if($is_super_admin == false && $permission_array['edit'] == 'yes') {
        $action_data = '<span onclick="edit_input_form_firewall_device(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data = '<span onclick="edit_input_form_firewall_device(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>';

    }

    if($is_super_admin == false && $permission_array['delete'] == 'yes') {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_device(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_device(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';
        //echo $action_data;
    }
    if(empty($action_data))
        $action_data = '';

    $data[$i][$j++] = $action_data;


    $i++;
}

echo json_encode($data);
ClosedDBConnection($cn);


?>