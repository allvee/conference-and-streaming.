<?php

header('Access-Control-Allow-Origin: *');
include_once "../../lib/common.php";
$cn = connectDB();
$user_type = $_SESSION["firewall"]["user_type"];
$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];

$arrayInput = array();

if($user_type == "Super User")
    $query = "SELECT * FROM rules where status='active'";
else if($user_type == "Administrator")
    $query = "SELECT * FROM rules where status='active' AND(org_id IN ($org_id)) ";
else
    $query = "SELECT * FROM rules where status='active' AND (user_id ='$user_id')";
// $query = "SELECT * FROM rules where status='active' AND( public = '1' OR org_id IN ($org_id)) ";
//$query = "SELECT * FROM rules where status='active' AND (public = '1' OR user_id ='$user_id')";

$result = Sql_exec($cn, $query);
if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$firewall_session = $_SESSION['firewall'];
$is_super_admin = false;
if($firewall_session['user_type'] == 'Super User')
    $is_super_admin = true;
$permission_array = json_decode($firewall_session['rules']['Rules'], true);


$data = array();
//$val=array();
$i = 0;
while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $id = "select_".$i."_checkbox";

    if((Sql_Result($row, "status")=="active") && (Sql_Result($row, "applied")=="send"))
        $data[$i][$j++] =  '<input type="checkbox" id='.$id.' name="select_checkbox[]" value='.Sql_Result($row, "id").' checked>';
    else
        $data[$i][$j++] =  '<input type="checkbox" id='.$id.' name="select_checkbox[]" value='.Sql_Result($row, "id").'>';

    $data[$i][$j++] = Sql_Result($row, "rule_name");
    $source_address = Sql_Result($row, "source_address");
    $source_address = str_replace("__", "", $source_address);
    $data[$i][$j++] = $source_address;
    $destination_address = Sql_Result($row, "destination_address");
    $destination_address = str_replace("__", "", $destination_address);
    $data[$i][$j++] = $destination_address;
    $data[$i][$j++] = Sql_Result($row, "port");
    $data[$i][$j++] = Sql_Result($row, "protocol");

    $profile_id = Sql_Result($row, "profile_id");
    $qry = "SELECT name FROM time_profileinfo where id='$profile_id'";
    $rslt = Sql_exec($cn, $qry);
    $rw = Sql_fetch_array($rslt);
    $data[$i][$j++] = Sql_Result($rw, "name");

    $action = Sql_Result($row, "action");
    if($action == 1)
        $data[$i][$j++] = "Accept";
    else
        $data[$i][$j++] = "Reject";

    $action_data = '';
    if($is_super_admin == false && $permission_array['edit'] == 'yes') {
        $action_data = '<span onclick="edit_input_form_firewall_rule(this,' . "'" . Sql_Result($row, "id") . "'".","."'".Sql_Result($row, "public")."'".","."'".Sql_Result($row, "source_group_type")."'".","."'".Sql_Result($row, "dest_group_type")."'" .","."'".Sql_Result($row, "action")."'" .","."'".Sql_Result($row, "profile_id")."'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data = '<span onclick="edit_input_form_firewall_rule(this,' . "'" . Sql_Result($row, "id") . "'".","."'".Sql_Result($row, "public")."'".","."'".Sql_Result($row, "source_group_type")."'".","."'".Sql_Result($row, "dest_group_type")."'" .","."'".Sql_Result($row, "action")."'" .","."'".Sql_Result($row, "profile_id")."'". '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>';
    }

    if($is_super_admin == false && $permission_array['delete'] == 'yes') {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_rule(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_rule(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';
    }
    if(empty($action_data))
        $action_data = '';

    $data[$i][$j++] = $action_data;

    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);
?>